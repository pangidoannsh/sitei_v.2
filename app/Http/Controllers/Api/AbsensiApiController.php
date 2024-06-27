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
use App\Models\Absensi;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Carbon\Carbon;
use App\Models\Perkuliahan;
use Symfony\Component\HttpFoundation\StreamedResponse;


class AbsensiApiController extends Controller
{

    public function apistore(Request $request)
    {
        $request->validate([
            'student_id' => ['required', 'exists:mahasiswa,id'],
            'class_id' => ['required', 'exists:ab_matakuliah,id'],
            'perkuliahan_id' => ['required', 'exists:ab_perkuliahan,id'],
            'nama_dosen' => ['required'],
            'mata_kuliah' => ['required'],
            'keterangan' => ['required']
        ]);

        $existingAttendance = Absensi::where('student_id', $request->input('student_id'))
        ->where('perkuliahan_id', $request->input('perkuliahan_id'))
        ->exists();

        if ($existingAttendance) {
            return response()->json([
                'error' => true,
                'message' => 'Mahasiswa sudah melakukan absensi pada perkuliahan ini sebelumnya.'
            ], 400);
        }

        $attendance = Absensi::create([
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
            'nama' => $mahasiswa->nama,
            'waktu' => $attendance->attended_at->format('H:i:s'),
            'keterangan' => $attendance->keterangan,
            'message' => $mahasiswa->nama . ' baru saja absen'
        ];

        return response()->json([
            'error' => false,
            'message' => 'Absensi berhasil direkam',
            'attendance' => $attendanceSend // Kirim attendanceSend dengan nama mahasiswa
        ],
            200
        );
    }
    public function show()
    {
        // Ambil daftar absensi berdasarkan class_id
        $attendanceList = Absensi::all();

        return response()->json([
            'error' => false,
            'message' => 'Data absensi ditemukan',
            'attendance' => $attendanceList
        ], 200);
    }

    public function showByStudentId($studentId)
    {
        // Ambil riwayat absensi berdasarkan ID mahasiswa dengan detail class_id dan perkuliahan_id
        $attendanceList = Absensi::where('student_id', $studentId)
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

        $attendanceList = Absensi::where('student_id', $studentId)
            ->join('ab_matakuliah', 'ab_absensi.class_id', '=', 'ab_matakuliah.id')
            ->join('ab_perkuliahan', 'ab_absensi.perkuliahan_id', '=', 'ab_perkuliahan.id')
            ->join('ab_ruangan', 'ab_matakuliah.ruangan_id', '=', 'ab_ruangan.id')
            ->join('semester', 'ab_matakuliah.semester_id', '=', 'semester.id')
            ->select('ab_absensi.*', 'ab_matakuliah.ruangan_id', 'ab_perkuliahan.nomor_pertemuan', 'ab_ruangan.nama_ruangan', 'semester.semester', 'semester.tahun_ajaran')
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

        $absensi = Absensi::whereHas('student', function ($query) use ($studentId) {
            $query->where('id', $studentId);
        })->join('ab_matakuliah', 'ab_absensi.class_id', '=', 'ab_matakuliah.id')
        ->join('ab_perkuliahan', 'ab_absensi.perkuliahan_id', '=', 'ab_perkuliahan.id')
        ->join('ab_ruangan', 'ab_matakuliah.ruangan_id', '=', 'ab_ruangan.id')
        ->join('ab_kelas', 'ab_matakuliah.kelas_id', '=', 'ab_kelas.id')
        ->select('ab_absensi.*', 'ab_matakuliah.ruangan_id', 'ab_perkuliahan.nomor_pertemuan', 'ab_perkuliahan.materi', 'ab_ruangan.nama_ruangan', 'ab_kelas.nama_kelas')
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

        $attendanceList = Absensi::where('student_id', $studentId)
            ->join('ab_matakuliah', 'ab_absensi.class_id', '=', 'ab_matakuliah.id')
            ->join('ab_perkuliahan', 'ab_absensi.perkuliahan_id', '=', 'ab_perkuliahan.id')
            ->join('ab_ruangan', 'ab_matakuliah.ruangan_id', '=', 'ab_ruangan.id')
            ->select('ab_absensi.*', 'ab_matakuliah.ruangan_id', 'ab_perkuliahan.nomor_pertemuan', 'ab_ruangan.nama_ruangan')
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

        $detailAttendance = Absensi::where('student_id', $mahasiswa_id)
            ->where('class_id', $class_id)
            ->join('ab_matakuliah', 'ab_absensi.class_id', '=', 'ab_matakuliah.id')
            ->join('ab_ruangan', 'ab_matakuliah.ruangan_id', '=', 'ab_ruangan.id')
            ->select('ab_absensi.*', 'ab_matakuliah.ruangan_id', 'ab_ruangan.nama_ruangan')
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

        $attendanceList = Absensi::where('student_id', $studentId)
            ->join('ab_matakuliah', 'ab_absensi.class_id', '=', 'ab_matakuliah.id')
            ->join('ab_perkuliahan', 'ab_absensi.perkuliahan_id', '=', 'ab_perkuliahan.id')
            ->join('ab_ruangan', 'ab_matakuliah.ruangan_id', '=', 'ab_ruangan.id')
            ->select('ab_absensi.*', 'ab_matakuliah.ruangan_id', 'ab_perkuliahan.nomor_pertemuan', 'ab_ruangan.nama_ruangan')
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

        $detailThen = Absensi::where('student_id', $mahasiswa_id)
            ->where('class_id', $class_id)
            ->join('ab_matakuliah', 'ab_absensi.class_id', '=', 'ab_matakuliah.id')
            ->join('ab_ruangan', 'ab_matakuliah.ruangan_id', '=', 'ab_ruangan.id')
            ->join('semester', 'ab_matakuliah.semester_id', '=', 'semester.id')
            ->select('ab_absensi.*', 'ab_matakuliah.ruangan_id', 'ab_ruangan.nama_ruangan', 'semester.semester', 'semester.tahun_ajaran')
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

        $attendanceCounts = Absensi::where('student_id', $studentId)
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
        $attendance = Absensi::where('student_id', $studentId)->get();
        return response()->json(['attendances'=>$attendance], 200);
    }

    // Controller untuk mengambil data absensi
    public function getAttendanceData($id)
    {
        $attendance = Absensi::with('student')
        ->where('perkuliahan_id', $id)
            ->get();

        return response()->json($attendance);
    }

    public function getQRCode($id)
    {
        $perkuliahan = Perkuliahan::find($id);

        if (!$perkuliahan) {
            return redirect()->back();
        }

        // $this->perkuliahan($id);

        $mataKuliah = MataKuliah::find($perkuliahan->mata_kuliah_id);

        if (!$mataKuliah) {
            return redirect()->back()->with('error', 'Data Mata Kuliah tidak ditemukan');
        }

        $attendance = Absensi::with('student')
        ->where('perkuliahan_id', $id) // tambahkan kondisi ini
        // ->whereDate('attended_at', now())
        ->get();

        $waktuPerkuliahan = \Carbon\Carbon::parse($perkuliahan->created_at)->format('H:i:s');
        $hariPerkuliahan = \Carbon\Carbon::parse($perkuliahan->created_at)->locale('id')->isoFormat('dddd');

        $mahasiswas = Mahasiswa::where('prodi_id', $mataKuliah->prodi_id)->get()->sortBy('nama');


        $location = \App\Models\AbRuangan::find($mataKuliah->ruangan_id);
        $coordinates = "{$location->gedung->koordinat_longitude},{$location->gedung->koordinat_latitude}"; // Gabungkan latitude dan longitude
        $additionalInfo = "{$mataKuliah->id},{$perkuliahan->id},{$mataKuliah->mk}, {$mataKuliah->nip_dosen}"; // Informasi tambahan
        // $expiredTime = Carbon::now()->addMinutes(2) ->toString();
        $expiredTime = Carbon::now()->addSeconds(15)->format('Y-m-d H:i:s'); // Tambah 1 menit dari created_at
        $qrCodeContent = $coordinates . '  |  ' . $additionalInfo . ' | ' . $expiredTime;
        $expiredTime2 = Carbon::now()->addSeconds(30)->format('Y-m-d H:i:s');
        $qrCodeContent2 = $coordinates . '  |  ' . $additionalInfo . ' | ' . $expiredTime2;
        $expiredTime3 = Carbon::now()->addSeconds(45)->format('Y-m-d H:i:s');
        $qrCodeContent3 = $coordinates . '  |  ' . $additionalInfo . ' | ' . $expiredTime3;
        $expiredTime4 = Carbon::now()->addSeconds(60)->format('Y-m-d H:i:s');
        $qrCodeContent4 = $coordinates . '  |  ' . $additionalInfo . ' | ' . $expiredTime4;
        $expiredTime5 = Carbon::now()->addSeconds(75)->format('Y-m-d H:i:s');
        $qrCodeContent5 = $coordinates . '  |  ' . $additionalInfo . ' | ' . $expiredTime5;
        $expiredTime6 = Carbon::now()->addSeconds(90)->format('Y-m-d H:i:s');
        $qrCodeContent6 = $coordinates . '  |  ' . $additionalInfo . ' | ' . $expiredTime6;
        $expiredTime7 = Carbon::now()->addSeconds(105)->format('Y-m-d H:i:s');
        $qrCodeContent7 = $coordinates . '  |  ' . $additionalInfo . ' | ' . $expiredTime7;
        $expiredTime8 = Carbon::now()->addSeconds(130)->format('Y-m-d H:i:s');
        $qrCodeContent8 = $coordinates . '  |  ' . $additionalInfo . ' | ' . $expiredTime8;
        $expiredTime9 = Carbon::now()->addSeconds(145)->format('Y-m-d H:i:s');
        $qrCodeContent9 = $coordinates . '  |  ' . $additionalInfo . ' | ' . $expiredTime9;
        $expiredTime10 = Carbon::now()->addSeconds(160)->format('Y-m-d H:i:s');
        $qrCodeContent10 = $coordinates . '  |  ' . $additionalInfo . ' | ' . $expiredTime10;
        $qrCode = QrCode::size(320)
            ->backgroundColor(0, 0, 255)
            ->margin(1)
            ->generate($qrCodeContent);

        $qrCode2 = QrCode::size(320)
            ->backgroundColor(0, 255, 0)
            ->color(0, 0, 255)
            ->margin(1)
            ->generate($qrCodeContent2);

        $qrCode3 = QrCode::size(320)
            ->backgroundColor(0, 255, 255)
            ->color(255, 0, 255)
            ->margin(1)
            ->generate($qrCodeContent3);

        $qrCode4 = QrCode::size(320)
            ->margin(1)
            ->generate($qrCodeContent4);

        $qrCode5 = QrCode::size(320)
            ->color(255, 0, 0)
            ->margin(1)
            ->generate($qrCodeContent5);

        $qrCode6 = QrCode::size(320)
        ->color(0, 255, 0)
        ->margin(1)
        ->generate($qrCodeContent6);

        $qrCode7 = QrCode::size(320)
            ->backgroundColor(0, 0, 255)
            ->color(255, 255, 0)
            ->margin(1)
            ->generate($qrCodeContent7);

        $qrCode8 = QrCode::size(320)
            ->backgroundColor(255, 0, 255)
            ->color(255, 0, 0)
            ->margin(1)
            ->generate($qrCodeContent8);

        $qrCode9 = QrCode::size(320)
            ->backgroundColor(0, 0, 255)
            ->margin(1)
            ->generate($qrCodeContent9);

        $qrCode10 = QrCode::size(320)
        ->margin(1)
        ->generate($qrCodeContent10);

        // $expireds = $expiredTime;
        // $qrCodes[$i] = QrCode::size(320)

        // $qrCodes = [];
        // $expireds=[];
        // for($i=0;$i<5;$i++){
        //     $expiredTime = Carbon::now()->addMinutes(10*($i+1));
        //     // dd($expiredTime);
        //     $qrCodeContent = $coordinates . '  |  ' . $additionalInfo; // Gabungkan koordinat dengan informasi tambahan
        //     $qrCodeUrl = '/generate-qr-code?data=' . urlencode($qrCodeContent);
        //     $expireds[$i]=$expiredTime;
        //     $qrCodes[$i] = QrCode::size(320)
        //     ->backgroundColor(255, 255, 0)
        //     ->color(0, 0, 255)
        //     ->margin(1)
        //     ->generate($qrCodeContent);
        // }
        // dd($expireds);
        
        // Simpan gambar QR code ke dalam file
        $path = public_path('qr_codes/');
        $fileName = 'qr_code_' . time() . '.png';
        $qrCode->saveDataUri($path . $fileName);

        // Konstruksi URL gambar QR code
        $qrCodeUrl = asset('qr_codes/' . $fileName);

        return response()->json(['qr_code_url' => $qrCodeUrl]);
    }


}
