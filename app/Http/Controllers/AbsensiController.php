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
use App\Models\AbRekapitulasiRps;
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
use App\Jobs\UbahStatusPerkuliahanJob; 


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

            $riwayatAbsensi = MataKuliah::where('nip_dosen', $namaDosen)
                ->whereHas('semester', function ($query) {
                    $query->whereDate('tanggal_selesai', '<=', now());
                })
                ->with('perkuliahann')
                ->get();
            $jumlah_riwayat = $riwayatAbsensi->count();

            $ruangan = AbRuangan::all();
            foreach ($ruangan as $rgn) {
                $perkuliahan = Perkuliahan::whereHas('mataKuliah.ruangan', function ($query) use ($rgn) {
                    $query->where('id', $rgn->id);
                })->where('status', '!=', 'Perkuliahan Selesai')->first(); // Menambahkan kondisi where untuk memastikan perkuliahan belum selesai

                if ($perkuliahan) { // Check if $perkuliahan exists
                    $rgn->status = 'Sedang Digunakan';
                    $rgn->mata_kuliah = $perkuliahan->mataKuliah->mk;
                    $rgn->dosen_pengampu = $perkuliahan->mataKuliah->nip_dosen;
                    $rgn->mata_kuliah_id = $perkuliahan->mataKuliah->id;
                } else {
                    $rgn->status = 'Tidak Digunakan';
                    $rgn->mata_kuliah = '-';
                    $rgn->dosen_pengampu = '-';
                    $rgn->mata_kuliah_id = '-';
                }
            }

            $jumlah_ruangan = $ruangan->count();
            $countMatakuliah = null;
            $count = null;
            if ($user->role_id == 5) {
                $countMatakuliah = MataKuliah::whereHas('semester', function ($query) 
                {
                    $query->whereDate('tanggal_selesai', '>=', now());
                })
                ->count();
                $matakuliah = MataKuliah::whereHas('semester', function ($query) 
                {
                    $query->whereDate('tanggal_selesai', '<', Carbon::now());
                })->with('perkuliahann')->get();

                $count = $matakuliah->count();
            }
            elseif ($user->role_id == 6) {
                $countMatakuliah = MataKuliah::where('prodi_id', 1)
                ->whereHas('semester', function ($query) {
                    $query->whereDate('tanggal_selesai', '>=', now());
                })
                ->count();
                $matakuliah = MataKuliah::where('prodi_id', 1)
                ->whereHas('semester', function ($query) {
                    $query->whereDate('tanggal_selesai', '<', Carbon::now());
                })->with('perkuliahann')->get();

                $count = $matakuliah->count();
            } 
            elseif($user->role_id == 7) {
                $countMatakuliah = MataKuliah::where('prodi_id', 2)
                ->whereHas('semester', function ($query) {
                    $query->whereDate('tanggal_selesai', '>=', now());
                })
                ->count();
                $matakuliah = MataKuliah::where('prodi_id', 2)
                ->whereHas('semester', function ($query) {
                    $query->whereDate('tanggal_selesai', '<', Carbon::now());
                })->with('perkuliahann')->get();

                $count = $matakuliah->count();
            } 
            elseif($user->role_id == 8) {
                $countMatakuliah = MataKuliah::where('prodi_id', 3)
                ->whereHas('semester', function ($query) {
                    $query->whereDate('tanggal_selesai', '>=', now());
                })
                ->count();
                $matakuliah = MataKuliah::where('prodi_id', 3)
                ->whereHas('semester', function ($query) {
                    $query->whereDate('tanggal_selesai', '<', Carbon::now());
                })->with('perkuliahann')->get();

                $count = $matakuliah->count();
            }

            return view('absensi_menu.absensi.index', compact('absensi', 'nextPertemuans', 'jumlah_abseni', 'jumlah_riwayat', 'jumlah_ruangan', 'countMatakuliah', 'count'));
        } else {
            // Tindakan jika user tidak ditemukan
        }
    }



    public function showOpenAbsensi($id)
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
        $expiredTime8 = Carbon::now()->addSeconds(120)->format('Y-m-d H:i:s');
        $qrCodeContent8 = $coordinates . '  |  ' . $additionalInfo . ' | ' . $expiredTime8;
        $expiredTime9 = Carbon::now()->addSeconds(135)->format('Y-m-d H:i:s');
        $qrCodeContent9 = $coordinates . '  |  ' . $additionalInfo . ' | ' . $expiredTime9;
        $expiredTime10 = Carbon::now()->addSeconds(150)->format('Y-m-d H:i:s');
        $qrCodeContent10 = $coordinates . '  |  ' . $additionalInfo . ' | ' . $expiredTime10;
        $qrCode = QrCode::size(350)
            ->backgroundColor(0, 0, 255)
            ->margin(1)
            ->generate($qrCodeContent);

        $qrCode2 = QrCode::size(350)
            ->backgroundColor(0, 255, 0)
            ->color(0, 0, 255)
            ->margin(1)
            ->generate($qrCodeContent2);

        $qrCode3 = QrCode::size(350)
            ->backgroundColor(0, 255, 255)
            ->color(255, 0, 255)
            ->margin(1)
            ->generate($qrCodeContent3);

        $qrCode4 = QrCode::size(350)
            ->margin(1)
            ->generate($qrCodeContent4);

        $qrCode5 = QrCode::size(350)
            ->color(255, 0, 0)
            ->margin(1)
            ->generate($qrCodeContent5);

        $qrCode6 = QrCode::size(350)
            ->color(0, 255, 0)
            ->margin(1)
            ->generate($qrCodeContent6);

        $qrCode7 = QrCode::size(350)
            ->backgroundColor(0, 0, 255)
            ->color(255, 255, 0)
            ->margin(1)
            ->generate($qrCodeContent7);

        $qrCode8 = QrCode::size(350)
            ->backgroundColor(255, 0, 255)
            ->color(255, 0, 0)
            ->margin(1)
            ->generate($qrCodeContent8);

        $qrCode9 = QrCode::size(350)
            ->backgroundColor(0, 0, 255)
            ->margin(1)
            ->generate($qrCodeContent9);

        $qrCode10 = QrCode::size(350)
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


        $qrCodeOnline = QrCode::size(350)
            ->margin(1)
            ->generate($additionalInfo);

        return view('absensi_menu.absensi.open-absensi', compact('mataKuliah', 'attendance', 'perkuliahan', 'waktuPerkuliahan', 'hariPerkuliahan', 'mahasiswas', 'qrCode', 'qrCode2', 'qrCode3', 'qrCode4', 'qrCode5', 'qrCode6', 'qrCodeOnline', 'qrCode7', 'qrCode8', 'qrCode9', 'qrCode10'));
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
        // Count existing Daring sessions for the mata_kuliah_id
        $daringCount = Perkuliahan::where('mata_kuliah_id', $request->mata_kuliah_id)
            ->where('jenis_perkuliahan', 'Daring')
            ->count();

        if ($request->jenis_perkuliahan === 'Daring' && $daringCount >= 8) {
            return redirect()->back()->with('error', 'Kelas daring sudah mencapai batas maksimal 8 kali.');
        }

        $lastPerkuliahan = Perkuliahan::where('mata_kuliah_id', $request->mata_kuliah_id)->latest()->first();

        $nomorPertemuan = $lastPerkuliahan ? $lastPerkuliahan->nomor_pertemuan + 1 : 1;

        $waktu = $lastPerkuliahan ? $lastPerkuliahan->created_at : now();
        $mataKuliah = MataKuliah::find($request->mata_kuliah_id);
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
        return redirect()->route('absensi.index');
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
        // Validasi input
        $request->validate([
            'student_id' => 'required', // Mahasiswa ID harus terisi
            'class_id' => 'required', // ID kelas harus terisi
            'perkuliahan_id' => 'required', // ID perkuliahan harus terisi
            'nama_dosen' => 'required', // Nama dosen harus terisi
            'mata_kuliah' => 'required', // Mata kuliah harus terisi
            'keterangan' => 'required', // Keterangan harus terisi
            'attended_at' => 'required', // Waktu hadir harus terisi
        ]);

        // Memeriksa apakah mahasiswa sudah melakukan absensi untuk perkuliahan tertentu
        $existingAbsensi = Absensi::where('student_id', $request->input('student_id'))
            ->where('perkuliahan_id', $request->input('perkuliahan_id'))
            ->exists();

        // Jika sudah ada data absensi untuk mahasiswa dan perkuliahan tersebut
        if ($existingAbsensi) {
            // Redirect kembali dengan pesan error
            return redirect()->back()->with('error', 'Maaf, Mahasiswa sudah melakukan absensi untuk perkuliahan ini.');
        }

        // Jika belum ada data absensi untuk mahasiswa dan perkuliahan tersebut, tambahkan data absensi manual
        Absensi::create([
            'student_id' => $request->input('student_id'),
            'class_id' => $request->input('class_id'),
            'perkuliahan_id' => $request->input('perkuliahan_id'),
            'nama_dosen' => $request->input('nama_dosen'),
            'mata_kuliah' => $request->input('mata_kuliah'),
            'keterangan' => $request->input('keterangan'),
            'attended_at' => $request->input('attended_at'),
        ]);

        // Mendapatkan nama mahasiswa yang melakukan absensi
        $mahasiswa = Mahasiswa::find($request->input('student_id'));

        // Membuat pesan sukses
        $successMessage = "Absensi manual untuk mahasiswa dengan NIM {$mahasiswa->nim} - {$mahasiswa->nama} berhasil ditambahkan.";

        // Redirect kembali ke halaman absensi dengan pesan sukses
        return redirect('/absensi/open-absensi/' . $request->input('class_id') . $request->input('perkuliahan_id') . '?success=true')
            ->with('success', $successMessage);
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
        $perkuliahan = Perkuliahan::with('rekapitulasiRps', 'class.mataKuliah')->find($class_id);

        return view('absensi_menu.absensistatistik.detail-statistik', compact('groupedAttendances', 'perkuliahan', 'attendances', 'class_id'));
    }


    public function download_pdf($class_id)
    {
        $mata_kuliah = MataKuliah::find($class_id);
        $perkuliahan = Perkuliahan::find($class_id);

        $attendances = Absensi::whereHas('perkuliahan', function ($query) use ($class_id) {
            $query->where('class_id', $class_id);
        })->orderBy('created_at')->get();

        $students = $attendances->pluck('student')->unique();

        // Hitung total pertemuan
        $totalMeetings = $perkuliahan ? $perkuliahan->count() : 0;

        $presentAttendances = Absensi::whereHas('perkuliahan', function ($query) use ($class_id) {
            $query->where('class_id', $class_id);
        })
            ->where('keterangan', 'Hadir') // Hanya ambil absensi dengan status 'Hadir'
            ->get();
        // Hitung kehadiran setiap mahasiswa
        $attendanceCounts = $presentAttendances->groupBy('student_id')->map->count();

        // Filter mahasiswa yang kehadirannya kurang dari 80% dari total pertemuan
        $studentsUnderEightyPercent = $attendanceCounts->filter(function ($attendanceCount) use ($totalMeetings) {
            $attendancePercentage = ($attendanceCount / 15) * 100;
            return $attendancePercentage < 80;
        });

        // Mahasiswa yang kehadirannya kurang dari 80%
        $studentsUnderEightyPercent = Mahasiswa::whereIn('id', $studentsUnderEightyPercent->keys())->get();
        $sortedUnder = $studentsUnderEightyPercent->sortBy('nim');

        // Urutkan mahasiswa berdasarkan NIM
        $sortedStudents = $students->sortBy('nim');
        $groupedAttendances = $attendances->groupBy('perkuliahan_id')->take(4);
        $groupedAttendances2 = $attendances->groupBy('perkuliahan_id')->slice(4, 4); // Ambil data pertemuan 5 sampai 8
        $groupedAttendances3 = $attendances->groupBy('perkuliahan_id')->slice(8, 4); // Ambil data pertemuan 5 sampai 8
        $groupedAttendances4 = $attendances->groupBy('perkuliahan_id')->slice(12, 4); // Ambil data pertemuan 5 sampai 8

        $created_at = [];
        $materi = [];

        foreach ($groupedAttendances as $perkuliahanId => $attendances) {
            $firstAttendance = $attendances->first();

            $created_at[$perkuliahanId] = $firstAttendance->perkuliahan->created_at ? $firstAttendance->perkuliahan->created_at->format('d-m-Y') : '';
            $materi[$perkuliahanId] = $firstAttendance->perkuliahan->materi ?? '';
        }

        $tanggal = [];
        $materi2 = [];

        foreach ($groupedAttendances2 as $perkuliahanId => $attendances) {
            $firstAttendance = $attendances->first();

            $tanggal[$perkuliahanId] = $firstAttendance->perkuliahan->created_at ? $firstAttendance->perkuliahan->created_at->format('d-m-Y') : '';
            $materi2[$perkuliahanId] = $firstAttendance->perkuliahan->materi ?? '';
        }

        //file3
        $tanggal3 = [];
        $materi3 = [];

        foreach ($groupedAttendances3 as $perkuliahanId => $attendances) {
            $firstAttendance = $attendances->first();

            $tanggal3[$perkuliahanId] = $firstAttendance->perkuliahan->created_at ? $firstAttendance->perkuliahan->created_at->format('d-m-Y') : '';
            $materi3[$perkuliahanId] = $firstAttendance->perkuliahan->materi ?? '';
        }

        //file4
        $tanggal4 = [];
        $materi4 = [];

        foreach ($groupedAttendances4 as $perkuliahanId => $attendances) {
            $firstAttendance = $attendances->first();

            $tanggal4[$perkuliahanId] = $firstAttendance->perkuliahan->created_at ? $firstAttendance->perkuliahan->created_at->format('d-m-Y') : '';
            $materi4[$perkuliahanId] = $firstAttendance->perkuliahan->materi ?? '';
        }

        $dompdf = new Dompdf();
        $htmlPage1 = view('absensi_menu.absensistatistik.file')->with(compact('groupedAttendances', 'perkuliahan', 'created_at', 'materi', 'sortedStudents', 'mata_kuliah'))->render();
        $htmlPage2 = view('absensi_menu.absensistatistik.file2')->with(compact('groupedAttendances2', 'perkuliahan', 'tanggal', 'materi2', 'sortedStudents', 'mata_kuliah'))->render();
        $htmlPage3 = view('absensi_menu.absensistatistik.file3')->with(compact('groupedAttendances3', 'perkuliahan', 'tanggal3', 'materi3', 'sortedStudents', 'mata_kuliah'))->render();
        $htmlPage4 = view('absensi_menu.absensistatistik.file4')->with(compact('groupedAttendances4', 'perkuliahan', 'tanggal4', 'materi4', 'sortedStudents', 'mata_kuliah'))->render();
        $htmlPage5 = view('absensi_menu.absensistatistik.file5')->with(compact('studentsUnderEightyPercent', 'mata_kuliah', 'attendanceCounts', 'totalMeetings'))->render();


        $html = $htmlPage1 . $htmlPage2 . $htmlPage3 . $htmlPage4 . $htmlPage5;
        $dompdf->loadHtml($html);

        // Set ukuran dan orientasi halaman
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF
        $dompdf->render();
        return $dompdf->stream('Daftar Presensi Kuliah.pdf');
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

        $matkul_absensi = MataKuliah::where('nip_dosen', $namaDosen)
            ->whereHas('semester', function ($query) {
                $query->whereDate('tanggal_selesai', '>=', now());
            })
            ->with('perkuliahann')
            ->get();
        $jumlah_absensi = $matkul_absensi->count();

        $ruangan = AbRuangan::all();
        foreach ($ruangan as $rgn) {
            $perkuliahan = Perkuliahan::whereHas('mataKuliah.ruangan', function ($query) use ($rgn) {
                $query->where('id', $rgn->id);
            })->where('status', '!=', 'Perkuliahan Selesai')->first(); // Menambahkan kondisi where untuk memastikan perkuliahan belum selesai

            if ($perkuliahan) { // Check if $perkuliahan exists
                $rgn->status = 'Sedang Digunakan';
                $rgn->mata_kuliah = $perkuliahan->mataKuliah->mk;
                $rgn->dosen_pengampu = $perkuliahan->mataKuliah->nip_dosen;
                $rgn->mata_kuliah_id = $perkuliahan->mataKuliah->id;
            } else {
                $rgn->status = 'Tidak Digunakan';
                $rgn->mata_kuliah = '-';
                $rgn->dosen_pengampu = '-';
                $rgn->mata_kuliah_id = '-';
            }
        }

        $jumlah_ruangan = $ruangan->count();
        $countMatakuliah = null;
        $count = null;
        if ($user->role_id == 5) {
            $countMatakuliah = MataKuliah::whereHas('semester', function ($query) 
            {
                $query->whereDate('tanggal_selesai', '>=', now());
            })
            ->count();
            $matakuliah = MataKuliah::whereHas('semester', function ($query) 
            {
                $query->whereDate('tanggal_selesai', '<', Carbon::now());
            })->with('perkuliahann')->get();

            $count = $matakuliah->count();
        }
        elseif ($user->role_id == 6) {
            $countMatakuliah = MataKuliah::where('prodi_id', 1)
            ->whereHas('semester', function ($query) {
                $query->whereDate('tanggal_selesai', '>=', now());
            })
            ->count();
            $matakuliah = MataKuliah::where('prodi_id', 1)
            ->whereHas('semester', function ($query) {
                $query->whereDate('tanggal_selesai', '<', Carbon::now());
            })->with('perkuliahann')->get();

            $count = $matakuliah->count();
        } 
        elseif ($user->role_id == 7) {
            $countMatakuliah = MataKuliah::where('prodi_id', 2)
            ->whereHas('semester', function ($query) {
                $query->whereDate('tanggal_selesai', '>=', now());
            })
            ->count();
            $matakuliah = MataKuliah::where('prodi_id', 2)
            ->whereHas('semester', function ($query) {
                $query->whereDate('tanggal_selesai', '<', Carbon::now());
            })->with('perkuliahann')->get();

            $count = $matakuliah->count();
        }
        elseif($user->role_id == 8) {
            $countMatakuliah = MataKuliah::where('prodi_id', 3)
            ->whereHas('semester', function ($query) {
                $query->whereDate('tanggal_selesai', '>=', now());
            })
                ->count();
            $matakuliah = MataKuliah::where('prodi_id', 3)
            ->whereHas('semester', function ($query) {
                $query->whereDate('tanggal_selesai', '<', Carbon::now());
            })->with('perkuliahann')->get();

            $count = $matakuliah->count();
        }

        return view('absensi_menu.absensi.riwayat-absensi', compact('riwayatPerkuliahanGroupedFinal', 'riwayatAbsensi', 'semesters', 'jumlah_riwayat', 'jumlah_absensi', 'jumlah_ruangan', 'countMatakuliah', 'count'));
    }

    public function detailriwayat($id)
    {
        $perkuliahan = Perkuliahan::where('status', 'Perkuliahan Selesai')
            ->findOrFail($id);

        return view('absensi_menu.absensi.detail-riwayat', compact('perkuliahan'));
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

    public function detailabsensi($class_id)
    {
        $mahasiswa_id = Auth::user()->id;
        $detailabsensimahasiswa = Absensi::where('student_id', $mahasiswa_id)
            ->where('class_id', $class_id) // Sesuaikan dengan kolom yang sesuai dengan mata kuliah
            ->with(['class', 'perkuliahan'])
            ->get();


        return view('absensi_menu.mahasiswa.detail-riwayat', compact('detailabsensimahasiswa'));
    }

    public function riwayatabsensimahasiswa()
    {
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
            $total_absensi = count($riwayatAbsensiGroupedFinal);

            $riwayatAbsensi = [];


            $riwayatAbsensii = Absensi::where('student_id', $mahasiswa_id)
                ->with(['class', 'perkuliahan'])
                ->get();

            $riwayatMatkulGrouped = $riwayatAbsensii->groupBy('mata_kuliah_id');

            $riwayatMatkulGroupedFinal = [];

            foreach ($riwayatMatkulGrouped as $mataKuliahId => $riwayat) {
                $riwayatPerkuliahanGroupedMataKuliah = $riwayat->groupBy('class_id');

                foreach ($riwayatPerkuliahanGroupedMataKuliah as $classId => $riwayatByClasss) {
                    $latestAbsensi = $riwayatByClasss->sortByDesc('attended_at')->first();

                    $tanggalFinish = $latestAbsensi->class->semester->tanggal_selesai;

                    if ($tanggalFinish > now()) {
                        $riwayatMatkulGroupedFinal[] = $latestAbsensi;
                    }
                }
            }
            $total_matkul = count($riwayatMatkulGroupedFinal);
        }

        $ruangan = AbRuangan::all();
        foreach ($ruangan as $rgn) {
            $perkuliahan = Perkuliahan::whereHas('mataKuliah.ruangan', function ($query) use ($rgn) {
                $query->where('id', $rgn->id);
            })->where('status', '!=', 'Perkuliahan Selesai')->first(); // Menambahkan kondisi where untuk memastikan perkuliahan belum selesai

            if ($perkuliahan) { // Check if $perkuliahan exists
                $rgn->status = 'Sedang Digunakan';
                $rgn->mata_kuliah = $perkuliahan->mataKuliah->mk;
                $rgn->dosen_pengampu = $perkuliahan->mataKuliah->nip_dosen;
                $rgn->mata_kuliah_id = $perkuliahan->mataKuliah->id;
            } else {
                $rgn->status = 'Tidak Digunakan';
                $rgn->mata_kuliah = '-';
                $rgn->dosen_pengampu = '-';
                $rgn->mata_kuliah_id = '-';
            }
        }

        $jumlah_ruangan = $ruangan->count();
        return view('absensi_menu.mahasiswa.riwayat-absensi', compact('riwayatAbsensiGroupedFinal', 'total_absensi', 'total_matkul', 'jumlah_ruangan'));
    }
}
