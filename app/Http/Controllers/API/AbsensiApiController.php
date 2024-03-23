<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Attendance;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use Illuminate\Support\Facades\Validator;
use App\Events\NewAttendanceAdded;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\StreamedResponse;


class AbsensiApiController extends Controller
{

    public function apistore(Request $request)
    {
        $request->validate([
            'student_id' => ['required', 'exists:mahasiswa,id'],
            'class_id' => ['required', 'exists:mata_kuliah,id'],
            'perkuliahan_id' => ['required', 'exists:perkuliahan,id'],
            'nama_dosen' => ['required'],
            'mata_kuliah' => ['required'],
            'keterangan' => ['required']
        ]);

        $existingAttendance = Attendance::where('student_id', $request->input('student_id'))
        ->where('perkuliahan_id', $request->input('perkuliahan_id'))
        ->exists();

        // If the student has already attended the class, return error response
        if ($existingAttendance) {
            return response()->json([
                'error' => true,
                'message' => 'Mahasiswa sudah melakukan absensi pada perkuliahan ini sebelumnya.'
            ], 400);
        }

        $attendance = Attendance::create([
            'student_id' => $request->input('student_id'),
            'class_id' => $request->input('class_id'),
            'perkuliahan_id' => $request->input('perkuliahan_id'),
            'attended_at' => now(),
            'nama_dosen' => $request->input('nama_dosen'),
            'mata_kuliah' => $request->input('mata_kuliah'),
            'keterangan' => $request->input('keterangan')
        ]);

        $mahasiswa = Mahasiswa::findOrFail($attendance->student_id);

        $attendanceSend = [
            'id' => $attendance->id,
            'student_id' => $attendance->student_id,
            'class_id' => $attendance->class_id,
            'tanggal' => $attendance->attended_at->format('Y-m-d'),
            'nim' => $mahasiswa->nim,
            'nama' => $mahasiswa->nama, // Masukkan nama mahasiswa ke dalam array
            'waktu' => $attendance->attended_at->format('H:i:s'),
            'keterangan' => $attendance->keterangan,
            'message' => $mahasiswa->nama.' baru saja absen'

        ];

        event(new NewAttendanceAdded($attendanceSend));
        // broadcast(new NewAttendanceAdded($attendance))->toOthers();

        return response([
            'error' => false,
            'message' => 'Absensi berhasil direkam',
            'attendance' => $attendance
        ],200);
    }


    public function show()
    {
        // Ambil daftar absensi berdasarkan class_id
        $attendanceList = Attendance::all();

        return response()->json([
            'error' => false,
            'message' => 'Data absensi ditemukan',
            'attendance' => $attendanceList
        ], 200);
    }

    public function showByStudentId($studentId)
    {
        // Ambil riwayat absensi berdasarkan ID mahasiswa dengan detail class_id dan perkuliahan_id
        $attendanceList = Attendance::where('student_id', $studentId)
            ->join('mata_kuliah', 'attendances.class_id', '=', 'mata_kuliah.id')
            ->join('perkuliahan', 'attendances.perkuliahan_id', '=', 'perkuliahan.id')
            ->join('locations', 'mata_kuliah.ruangan_id', '=', 'locations.id')
            ->select('attendances.*', 'mata_kuliah.ruangan_id', 'perkuliahan.nomor_pertemuan', 'locations.nama_ruangan')
            ->get();


        return response()->json(
            [
                'error' => false,
                'message' => 'Riwayat absensi ditemukan',
                'listAttendance' => $attendanceList
            ],
            200
        );
    }

    // riwayat absensi
    public function showAttendanceByToken(Request $request)
    {
        $mahasiswa = Auth::user();

        $studentId = $mahasiswa->id;

        $attendanceList = Attendance::where('student_id', $studentId)
            ->join('mata_kuliah', 'attendances.class_id', '=', 'mata_kuliah.id')
            ->join('perkuliahan', 'attendances.perkuliahan_id', '=', 'perkuliahan.id')
            ->join('ab_ruangan', 'mata_kuliah.ruangan_id', '=', 'ab_ruangan.id')
            ->join('semester', 'mata_kuliah.semester_id', '=', 'semester.id')
            ->select('attendances.*', 'mata_kuliah.ruangan_id', 'perkuliahan.nomor_pertemuan', 'ab_ruangan.nama_ruangan', 'semester.semester', 'semester.tahun_ajaran')
            ->get();

        return response()->json([
            'error' => false,
            'message' => 'Daftar absensi berhasil ditemukan',
            'listAttendance' => $attendanceList,
        ], 200);
    }

    // detail absensi untuk riwayat absensi
    public function showDetail($id)
    {
        $mahasiswa = Auth::user();

        $studentId = $mahasiswa->id;

        $absensi = Attendance::whereHas('student', function ($query) use ($studentId) {
            $query->where('id', $studentId);
        })->join('mata_kuliah', 'attendances.class_id', '=', 'mata_kuliah.id')
        ->join('perkuliahan', 'attendances.perkuliahan_id', '=', 'perkuliahan.id')
        ->join('ab_ruangan', 'mata_kuliah.ruangan_id', '=', 'ab_ruangan.id')
        ->join('kelas', 'mata_kuliah.kelas_id', '=', 'kelas.id')
        ->select('attendances.*', 'mata_kuliah.ruangan_id', 'perkuliahan.nomor_pertemuan', 'perkuliahan.materi', 'ab_ruangan.nama_ruangan', 'kelas.nama_kelas')
        ->findOrFail($id);

        return response()->json([
            'error' => false,
            'message' => 'Detail absensi berhasil ditemukan',
            'detailAbsensi' => $absensi,
        ], Response::HTTP_OK);
    }

    // matakuliah yg udah absensi semester ini
    public function showAttendanceMatakuliah(Request $request)
    {
        $mahasiswa = Auth::user();

        $studentId = $mahasiswa->id;

        $attendanceList = Attendance::where('student_id', $studentId)
            ->join('mata_kuliah', 'attendances.class_id', '=', 'mata_kuliah.id')
            ->join('perkuliahan', 'attendances.perkuliahan_id', '=', 'perkuliahan.id')
            ->join('ab_ruangan', 'mata_kuliah.ruangan_id', '=', 'ab_ruangan.id')
            ->select('attendances.*', 'mata_kuliah.ruangan_id', 'perkuliahan.nomor_pertemuan', 'ab_ruangan.nama_ruangan')
            ->get();

        $groupedAttendance = $attendanceList->groupBy('mata_kuliah');

        $filteredAttendance = [];
        foreach ($groupedAttendance as $mataKuliahId => $attendances) {
            $sortedAttendances = $attendances->sortByDesc('attended_at');
            $latestAttendance = $sortedAttendances->first();

            // Periksa apakah pertemuan ini masih dalam semester saat ini
            $semesterEndDate = $latestAttendance->class->semester->tanggal_selesai;
            if ($semesterEndDate > now()) {
                $filteredAttendance[] = [
                    'mata_kuliah' => $latestAttendance->mata_kuliah,
                    'riwayat_absensi' => $latestAttendance
                ];
            }
        }

        return response()->json([
            'error' => false,
            'message' => 'Daftar absensi untuk semester saat ini berhasil ditemukan',
            'groupedAttendance' => $filteredAttendance,
        ],
            200
        );
    }

    // detail untuk matakuliah yg udah absensi semester berjalan
    public function showDetailAttendance($id)
    {
        $mahasiswa_id = Auth::user()->id;
        $class_id = $id;

        $detailAttendance = Attendance::where('student_id', $mahasiswa_id)
            ->where('class_id', $class_id)
            ->join('mata_kuliah', 'attendances.class_id', '=', 'mata_kuliah.id')
            ->join('ab_ruangan', 'mata_kuliah.ruangan_id', '=', 'ab_ruangan.id')
            ->select('attendances.*', 'mata_kuliah.ruangan_id', 'ab_ruangan.nama_ruangan')
            ->with(['class', 'perkuliahan', 'ruangan'])
            ->get();

        return response()->json([
            'error' => false,
            'message' => 'Riwayat absensi berhasil ditemukan',
            'detailAttendance' => $detailAttendance,
        ], 200);
    }

    // matakuliah yg udah absensi semester yang lewat
    public function showAttendanceThen(Request $request)
    {
        $mahasiswa = Auth::user();

        $studentId = $mahasiswa->id;

        $attendanceList = Attendance::where('student_id', $studentId)
            ->join('mata_kuliah', 'attendances.class_id', '=', 'mata_kuliah.id')
            ->join('perkuliahan', 'attendances.perkuliahan_id', '=', 'perkuliahan.id')
            ->join('ab_ruangan', 'mata_kuliah.ruangan_id', '=', 'ab_ruangan.id')
            ->select('attendances.*', 'mata_kuliah.ruangan_id', 'perkuliahan.nomor_pertemuan', 'ab_ruangan.nama_ruangan')
            ->get();

        $groupedAttendance = $attendanceList->groupBy('mata_kuliah');

        $filteredAttendance = [];
        foreach ($groupedAttendance as $mataKuliahId => $attendances) {
            $sortedAttendances = $attendances->sortByDesc('attended_at');
            $latestAttendance = $sortedAttendances->first();

            // Periksa apakah pertemuan ini masih dalam semester saat ini
            $semesterEndDate = $latestAttendance->class->semester->tanggal_selesai;
            if ($semesterEndDate < now()) {
                $filteredAttendance[] = [
                    'mata_kuliah' => $latestAttendance->mata_kuliah,
                    'riwayat_then' => $latestAttendance
                ];
            }
        }

        return response()->json(
            [
                'error' => false,
                'message' => 'Daftar absensi untuk semester saat ini berhasil ditemukan',
                'groupedAttendance' => $filteredAttendance,
            ],
            200
        );
    }

    public function showDetailThen($id)
    {
        $mahasiswa_id = Auth::user()->id;
        $class_id = $id;

        $detailThen = Attendance::where('student_id', $mahasiswa_id)
            ->where('class_id', $class_id)
            ->join('mata_kuliah', 'attendances.class_id', '=', 'mata_kuliah.id')
            ->join('ab_ruangan', 'mata_kuliah.ruangan_id', '=', 'ab_ruangan.id')
            ->join('semester', 'mata_kuliah.semester_id', '=', 'semester.id')
            ->select('attendances.*', 'mata_kuliah.ruangan_id', 'ab_ruangan.nama_ruangan', 'semester.semester', 'semester.tahun_ajaran')
            ->with(['class', 'perkuliahan', 'ruangan'])
            ->get();


        return response()->json([
            'error' => false,
            'message' => 'Riwayat absensi berhasil ditemukan',
            'detailAttendance' => $detailThen,
        ], 200);
    }

    public function countAttendanceStatus()
    {
        $mahasiswa = Auth::user();
        $studentId = $mahasiswa->id;

        $attendanceCounts = Attendance::where('student_id', $studentId)
            ->selectRaw('keterangan, count(*) as total')
            ->groupBy('keterangan')
            ->get();

        $attendanceStatus = [
            'sakit' => 0,
            'izin' => 0,
            'hadir' => 0,
            'alpha' => 0,
        ];

        foreach ($attendanceCounts as $count) {
            switch ($count->keterangan) {
                case 'Sakit':
                    $attendanceStatus['sakit'] = $count->total;
                    break;
                case 'Izin':
                    $attendanceStatus['izin'] = $count->total;
                    break;
                case 'Hadir':
                    $attendanceStatus['hadir'] = $count->total;
                    break;
                case 'Alpha':
                    $attendanceStatus['alpha'] = $count->total;
                    break;
            }
        }

        return response()->json(
            [
                'error' => false,
                'message' => 'Jumlah absensi berdasarkan status berhasil ditemukan',
                'attendanceStatus' => $attendanceStatus,
            ],
            Response::HTTP_OK
        );
    }
    
    public function showBasedId($studentId){
        $attendance = Attendance::where('student_id', $studentId)->get();
        return response()->json(['attendances'=>$attendance], 200);
    }

}
