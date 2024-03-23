<?php

namespace App\Http\Controllers;

use App\Events\NewAttendanceAdded;
use App\Models\MataKuliah;
use App\Models\Dosen;
use App\Models\Attendance;
use App\Models\Perkuliahan; // Pastikan untuk mengimpor model Perkuliahan
use App\Models\Mahasiswa;
use App\Models\Location;
use App\Models\AbRuangan;
use App\Models\AbGedung;
use App\Models\Absensi;
use App\Models\AttendanceResult;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Pusher\Pusher;
use App\Models\Semester;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AbsensiController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user) {
            $namaDosen = $user->nama;

            $absensi = MataKuliah::where('nip_dosen', $namaDosen)
                ->whereHas('semester', function ($query) {
                    $query->whereDate('tanggal_selesai', '>=', now());
                })
                ->with('perkuliahann')
                ->get();
            $jumlah_abseni = $absensi->count();

            $nextPertemuans = [];
            foreach ($absensi as $mk) {
                $lastPerkuliahan = Perkuliahan::where('mata_kuliah_id', $mk->id)->latest()->first();
                $nowPerkuliahan = Perkuliahan::where('mata_kuliah_id', $mk->id)
                    ->where('status', 'Perkuliahan Dimulai') // Filter hanya kelas yang sedang berlangsung
                    ->latest('id')
                    ->first();

                if (!$lastPerkuliahan) {
                    // Jika belum ada pertemuan sebelumnya, atur nomor pertemuan pertama menjadi 1
                    $nextPertemuans[$mk->id] = 1;
                } else {
                    $status = $lastPerkuliahan->status;
                    if ($status == 'Perkuliahan Selesai') {
                        $nextPertemuan = $lastPerkuliahan->nomor_pertemuan + 1;
                        $nextPertemuans[$mk->id] = $nextPertemuan;
                    } elseif ($status == 'Perkuliahan Dimulai') {
                        $nextPertemuans[$mk->id] = 'Masuk';
                        session()->put('idPerkuliahan', $lastPerkuliahan->id); // Simpan ID perkuliahan yang sedang berlangsung
                    } else {
                        $nextPertemuans[$mk->id] = null;
                    }
                }
            }

            return view('absensi_menu.absensi.index', compact('absensi', 'nextPertemuans', 'jumlah_abseni'));
        } else {
            // Tindakan jika user tidak ditemukan
        }
    }



    public function showOpenAbsensi($id)
    {
        $perkuliahan = Perkuliahan::find($id);

        if (!$perkuliahan) {
            return redirect()->back()->with('error', 'Data Perkuliahan tidak ditemukan');
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

        $mahasiswas = Mahasiswa::get()->sortBy('nama');


        $location = \App\Models\AbRuangan::find($mataKuliah->ruangan_id); 
        $coordinates = "{$location->gedung->koordinat_longitude},{$location->gedung->koordinat_latitude}"; // Gabungkan latitude dan longitude
        $additionalInfo = "{$mataKuliah->id},{$perkuliahan->id},{$mataKuliah->mk}, {$mataKuliah->nip_dosen}"; // Informasi tambahan
        $qrCodeContent = $coordinates . '  |  ' . $additionalInfo; // Gabungkan koordinat dengan informasi tambahan
        $qrCodeUrl = '/generate-qr-code?data=' . urlencode($qrCodeContent);
        $qrCode = QrCode::size(320)
            ->backgroundColor(255, 255, 0)
            ->color(0, 0, 255)
            ->margin(1)
            ->generate($qrCodeContent);

        $qrCode2 = QrCode::size(320)
        ->backgroundColor(255, 0, 0)
        ->color(0, 255, 0)
        ->margin(1)
        ->generate($qrCodeContent);

        $qrCode3 = QrCode::size(320)
            ->backgroundColor(0, 255, 255)
            ->color(255, 0, 255)
            ->margin(1)
            ->generate($qrCodeContent);

        $qrCode4 = QrCode::size(320)
            ->margin(1)
            ->generate($qrCodeContent);

        return view('absensi_menu.absensi.open-absensi', compact('mataKuliah', 'attendance', 'perkuliahan', 'waktuPerkuliahan', 'hariPerkuliahan', 'mahasiswas', 'qrCode', 'qrCode2', 'qrCode3', 'qrCode4'));
    }

    public function showLastAbsensiDetail()
    {
        // Mendapatkan ID perkuliahan terakhir yang dihadiri oleh mahasiswa
        $lastAttendance = Absensi::latest()->first();

        if (!$lastAttendance) {
            return redirect()->back()->with('error', 'Tidak ada data absensi yang tersedia');
        }

        $lastPerkuliahan = Perkuliahan::find($lastAttendance->perkuliahan_id);

        if (!$lastPerkuliahan) {
            return redirect()->back()->with('error', 'Data Perkuliahan tidak ditemukan');
        }

        $mataKuliah = MataKuliah::find($lastPerkuliahan->mata_kuliah_id);

        if (!$mataKuliah) {
            return redirect()->back()->with('error', 'Data Mata Kuliah tidak ditemukan');
        }

        // Ekstrak hari dari timestamp created_at
        $hariPerkuliahan = \Carbon\Carbon::parse($lastPerkuliahan->created_at)->locale('id')->isoFormat('dddd');

        // Mengambil data absensi berdasarkan perkuliahan_id terakhir yang dihadiri oleh mahasiswa
        $attendance = Absensi::where('perkuliahan_id', $lastPerkuliahan->id)
            ->whereDate('attended_at', now())
            ->get();
        $mahasiswas = Mahasiswa::get()->sortBy('nama');
        $perkuliahan = $lastPerkuliahan; // Assign $lastPerkuliahan to $perkuliahan

        // Menampilkan halaman open-absensi dengan data yang diperlukan
        return view('absensi_menu.absensi.open-absensi', compact('lastPerkuliahan', 'mataKuliah', 'attendance', 'hariPerkuliahan', 'mahasiswas', 'perkuliahan'));
    }

    public function bukaKelas(Request $request)
    {
        $lastPerkuliahan = Perkuliahan::where('mata_kuliah_id', $request->mata_kuliah_id)->latest()->first();

        $nomorPertemuan = $lastPerkuliahan ? $lastPerkuliahan->nomor_pertemuan + 1 : 1;

        $waktu = $lastPerkuliahan ? $lastPerkuliahan->created_at : now();

        $perkuliahan = Perkuliahan::create([
            'mata_kuliah_id' => $request->mata_kuliah_id,
            'nomor_pertemuan' => $nomorPertemuan,
            'materi' => $request->materi,
            'jenis_perkuliahan' => $request->jenis_perkuliahan,
            'status' => 'Perkuliahan Dimulai',
            'waktu' => $waktu,
        ]);

        // $nextPertemuan = $lastPerkuliahan ? $lastPerkuliahan->nomor_pertemuan + 2 : 2;

        return redirect()->route('showQrCode', ['id' => $perkuliahan->id])->with('success', 'Kelas berhasil dibuka.');
    }

    public function perkuliahan($id)
    {
        $perkuliahan = Perkuliahan::findOrFail($id);

        if (!$perkuliahan) {
            return redirect()->back()->with('error', 'Data Perkuliahan tidak ditemukan');
        }

        $perkuliahan->status = 'Perkuliahan Selesai';
        $perkuliahan->update();
        // Jika waktu perkuliahan belum berakhir, berikan pesan bahwa waktu perkuliahan masih berlangsung
        return redirect()->back()->with('error', 'Waktu perkuliahan masih berlangsung');

    }


    public function destroy($id)
    {
        $attendance = Absensi::find($id);
        $attendance->delete();
        return redirect()->back();
    }

    public function create()
    {
        $mahasiswas = Mahasiswa::get()->sortBy('nama');
        return view('absensi.open-absensi', compact('mahasiswas'));
    }

    public function tambahAbsensiManual(Request $request)
    {

        Absensi::create([
            'student_id' => $request->input('student_id'),
            'class_id' => $request->input('class_id'),
            'perkuliahan_id' => $request->input('perkuliahan_id'),
            'nama_dosen' => $request->input('nama_dosen'), // Menggunakan 'nip_dosen' karena nama Dosen tidak tersedia di form
            'mata_kuliah' => $request->input('mata_kuliah'),
            'keterangan' => $request->input('keterangan'),
            'attended_at' => $request->input('attended_at'), // Menggunakan 'attended_at' yang diperoleh dari form
        ]);

        return redirect('/absensi/open-absensi/' . $request->input('class_id') . $request->input('perkuliahan_id') . '?success=true')->with('success', 'Absensi manual berhasil ditambahkan');
    }

    // public function absensistatistik()
    // {
    //     $attendance = Attendance::with('class', 'perkuliahan')->get();

    //     // Lakukan apapun yang perlu dilakukan dengan data absensi yang telah diambil
    //     // Misalnya, kembalikan data ini ke view untuk ditampilkan
    //     return view('absensistatistik.index', compact('attendance'));
    // }

    public function absensistatistik()
    {
        $user = Auth::user();

        $query = Absensi::query()->with('class', 'perkuliahan');

        if ($user->role_id  == 5) { // Dosen
            $attendances = $query->get();
        } elseif ($user->role_id  == 6 || $user->role_id  == 7 || $user->role_id  == 8) { // Role_user 6, 7, atau 8
            $query->whereHas('class', function ($query) use ($user) {
                if ($user->role_id  == 6) {
                    $query->where('prodi_id', 1);
                } elseif ($user->role_id  == 7 || $user->role_id  == 8) {
                    $query->where('prodi_id', $user->role_id  - 5);
                }
            });

            $attendances = $query->get();
        }

        $groupedAttendances = $attendances->groupBy('class_id');

        $latestAttendances = [];

        foreach ($groupedAttendances as $classId => $attendances) {
            $sortedAttendances = $attendances->sortByDesc('created_at');
            $latestAttendance = $sortedAttendances->first();
            $latestAttendances[] = $latestAttendance;
        }

        return view('absensi_menu.absensistatistik.index', compact('latestAttendances'));
    }

    public function detailstatistik($class_id)
    {
        $attendances = Absensi::whereHas('perkuliahan', function ($query) use ($class_id) {
            $query->where('class_id', $class_id);
        })->get();

        $groupedAttendances = $attendances->groupBy('perkuliahan_id');

        $perkuliahan = Perkuliahan::find($class_id);

        return view('absensi_menu.absensistatistik.detail-statistik', compact('groupedAttendances', 'perkuliahan', 'attendances', 'class_id'));
    }
    

    public function download_pdf($class_id)
    {
        $perkuliahan = Perkuliahan::find($class_id);

        $attendances = Absensi::whereHas('perkuliahan', function ($query) use ($class_id) {
            $query->where('class_id', $class_id);
        })->get();
        $groupedAttendances = $attendances->groupBy('perkuliahan_id');

        $created_at = [];
        $materi = [];

        foreach ($groupedAttendances as $perkuliahanId => $attendances) {
            $firstAttendance = $attendances->first();

            $created_at[$perkuliahanId] = $firstAttendance->perkuliahan->created_at ? $firstAttendance->perkuliahan->created_at->format('d-m-Y') : '';
            $materi[$perkuliahanId] = $firstAttendance->perkuliahan->materi ?? '';
        }


        $dompdf = new Dompdf();
        $htmlPage1 = view('absensistatistik.file')->with(compact('groupedAttendances', 'perkuliahan', 'created_at', 'materi'))->render();
        $htmlPage2 = $htmlPage1;
        $html = $htmlPage1 . $htmlPage2;
        $dompdf->loadHtml($html);

        // Set ukuran dan orientasi halaman
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF
        $dompdf->render();
        return $dompdf->stream('perkuliahan.pdf');
    }

    public function absensistatistikadmin()
    {
        $user = Auth::user();

        $query = Absensi::query()->with('class', 'perkuliahan');

        if ($user->role_id  == 1) { // Dosen
            $attendances = $query->get();
        } elseif ($user->role_id  == 2 || $user->role_id  == 3 || $user->role_id  == 4) { // Role_user 6, 7, atau 8
            $query->whereHas('class', function ($query) use ($user) {
                if ($user->role_id  == 2) {
                    $query->where('prodi_id', 1);
                } elseif ($user->role_id  == 3 || $user->role_id  == 4) {
                    $query->where('prodi_id', $user->role_id  - 1);
                }
            });

            $attendances = $query->get();
        }

        $groupedAttendances = $attendances->groupBy('class_id');

        $latestAttendances = [];

        foreach ($groupedAttendances as $classId => $attendances) {
            $sortedAttendances = $attendances->sortByDesc('created_at');
            $latestAttendance = $sortedAttendances->first();
            $latestAttendances[] = $latestAttendance;
        }

        return view('absensi_menu.absensistatistik.admin-absensistat', compact('latestAttendances'));
    }

    public function riwayat()
    {
        $user = Auth::user();

        $riwayatPerkuliahanSelesai = [];

        if ($user) {
            $namaDosen = $user->nama;

            $riwayatPerkuliahanSelesai = Perkuliahan::where('status', 'Perkuliahan Selesai')
                ->whereHas('mataKuliah', function ($query) use ($namaDosen) {
                    $query->where('nip_dosen', $namaDosen);
                })
                ->with('mataKuliah')
                ->get();

            $riwayatPerkuliahanGrouped = $riwayatPerkuliahanSelesai->groupBy('mata_kuliah_id');

            $riwayatPerkuliahanGroupedFinal = [];

            foreach ($riwayatPerkuliahanGrouped as $mataKuliahId => $riwayat) {
                $riwayatPerkuliahanGroupedByClass = $riwayat->groupBy('class_id');

                foreach ($riwayatPerkuliahanGroupedByClass as $classId => $riwayatByClass) {
                    $latestAttendance = $riwayatByClass->sortByDesc('created_at')->first();

                    $riwayatPerkuliahanGroupedFinal[] = $latestAttendance;
                }
            }
        }

        $semesters = Semester::all();

        $riwayatAbsensi = MataKuliah::where('nip_dosen', $namaDosen)
            ->whereHas('semester', function ($query) {
                $query->whereDate('tanggal_selesai', '<=', now());
            })
            ->with('perkuliahann')
            ->get();
        $jumlah_riwayat = $riwayatAbsensi->count();

        return view('absensi.riwayat-absensi', compact('riwayatPerkuliahanGroupedFinal', 'riwayatAbsensi', 'semesters', 'jumlah_riwayat'));
    }

    public function detailriwayat($id)
    {
        $perkuliahan = Perkuliahan::where('status', 'Perkuliahan Selesai')
        ->findOrFail($id);

        return view('absensi.detail-riwayat', compact('perkuliahan'));
    }

    public function statistikruangan()
    {
        $ruangan = AbRuangan::all();

        $statistikRuangan = [];

        foreach ($ruangan as $r) {
            $statusRuangan = 'Tidak Digunakan';

            $perkuliahan = Perkuliahan::whereHas('mataKuliah.ruangan', function ($query) use ($r) {
                $query->where('id', $r->id);
            })->get();

            if ($perkuliahan->isNotEmpty()) {
                foreach ($perkuliahan as $p) {
                    if ($p->status === 'Perkuliahan Selesai') {
                        $statusRuangan = 'Tidak Digunakan';
                    } else {
                        $statusRuangan = 'Sedang Digunakan';
                        break;
                    }
                }
            }

            $statistikRuangan[] = [
                'gedung' => $r->nama_gedung,
                'ruangan' => $r->nama_ruangan,
                'status' => $statusRuangan,
            ];
        }

        return view('absensi_menu.absensistatistik.statistik-ruangan', compact('statistikRuangan'));
    }

    public function absensimahasiswa()
    {
        $mahasiswa_id = Auth::user()->id; // Sesuaikan dengan cara Anda mendapatkan ID mahasiswa

        $riwayatAbsensi = [];

        $riwayatAbsensi = Absensi::where('student_id', $mahasiswa_id)
            ->with(['class', 'perkuliahan'])
            ->get();

        $riwayatAbsensiGrouped = $riwayatAbsensi->groupBy('mata_kuliah_id');

        $riwayatAbsensiGroupedFinal = [];

        foreach ($riwayatAbsensiGrouped as $mataKuliahId => $riwayat) {
            $riwayatPerkuliahanGroupedByClass = $riwayat->groupBy('class_id');

            foreach ($riwayatPerkuliahanGroupedByClass as $classId => $riwayatByClass) {
                $latestAttendance = $riwayatByClass->sortByDesc('created_at')->first();

                $tanggalSelesai = $latestAttendance->class->semester->tanggal_selesai;
                if ($tanggalSelesai > now()) {
                    $riwayatAbsensiGroupedFinal[] = $latestAttendance;
                }
            }
        }
        return view('absensi_menu.absensi-mahasiswa.index', compact('riwayatAbsensiGroupedFinal'));
    }

    public function detailabsensi($class_id)
    {
        $mahasiswa_id = Auth::user()->id;
        $detailabsensimahasiswa = Absensi::where('student_id', $mahasiswa_id)
        ->where('class_id', $class_id) // Sesuaikan dengan kolom yang sesuai dengan mata kuliah
            ->with(['class', 'perkuliahan'])
            ->get();


        return view('absensi_menu.absensi-mahasiswa.detail-riwayat', compact('detailabsensimahasiswa'));
    }

    public function riwayatabsensimahasiswa(){
        $user = Auth::user();

        $riwayatAbsensi = [];

        if ($user) {
            $mahasiswa_id = $user->id;

            $riwayatAbsensi = Absensi::where('student_id', $mahasiswa_id)
                ->with(['class', 'perkuliahan'])
                ->get();

            $riwayatAbsensiGrouped = $riwayatAbsensi->groupBy('mata_kuliah_id');

            $riwayatAbsensiGroupedFinal = [];

            foreach ($riwayatAbsensiGrouped as $mataKuliahId => $riwayat) {
                $riwayatPerkuliahanGroupedByClass = $riwayat->groupBy('class_id');

                foreach ($riwayatPerkuliahanGroupedByClass as $classId => $riwayatByClass) {
                    $latestAttendance = $riwayatByClass->sortByDesc('attended_at')->first();

                    $tanggalSelesai = $latestAttendance->class->semester->tanggal_selesai;

                    if ($tanggalSelesai < now()) {
                        $riwayatAbsensiGroupedFinal[] = $latestAttendance;
                    }
                }
            }
        }
        return view('absensi_menu.absensi-mahasiswa.riwayat-absensi', compact('riwayatAbsensiGroupedFinal'));
    }


}
