<?php

namespace App\Http\Controllers;

use App\Models\AbGedung;
use App\Models\AbRuangan;
use App\Models\Perkuliahan;
use App\Models\Role;
use Carbon\Carbon;
use App\Models\MataKuliah;
use App\Models\Absensi;
use Illuminate\Support\Facades\DB; // Tambahkan ini di atas file
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AbRuanganController extends Controller
{
    public function ruangan()
    {
        $ruangan = AbRuangan::all();
        foreach ($ruangan as $rgn) {
            $perkuliahan = Perkuliahan::whereHas('mataKuliah.ruangan', function ($query) use ($rgn) {
                $query->where('id', $rgn->id);
            })->get();

            if ($perkuliahan->isNotEmpty()) {
                foreach ($perkuliahan as $p) {
                    if ($p->status === 'Perkuliahan Selesai') {
                        $rgn->status = 'Tidak Digunakan';
                    } else {
                        $rgn->status = 'Sedang Digunakan';
                        break;
                    }
                }
            } else {
                $rgn->status = 'Tidak Digunakan';
            }
        }
        $jumlah_ruangan = $ruangan->count();
        $gedung = AbGedung::all();
        $jumlah_gedung = $gedung->count();
        return view('absensi_menu.ab-gedung.ruangan', compact('ruangan', 'jumlah_ruangan', 'jumlah_gedung'));
    }

    public function ruanganabsensi()
    {
        $ruanganData = DB::select(DB::raw("SELECT r.id AS ruangan_id, r.nama_ruangan AS nama_ruangan, p.id AS perkuliahan_id, p.created_at AS waktu_mulai, p.jenis_perkuliahan, p.mata_kuliah_id, mk.mk AS mata_kuliah, mk.nip_dosen 
                                       FROM ab_ruangan r 
                                       JOIN ab_matakuliah mk ON r.id = mk.ruangan_id 
                                       JOIN ab_perkuliahan p ON mk.id = p.mata_kuliah_id 
                                       WHERE p.status = 'Perkuliahan Dimulai'"));

        $ruangan = AbRuangan::all();

        foreach ($ruangan as $rgn) {
            $ruanganDetail = collect($ruanganData)->firstWhere('ruangan_id', (int)$rgn->id);

            if ($ruanganDetail) {
                $rgn->status = 'Sedang Digunakan';
                $rgn->mata_kuliah = $ruanganDetail->mata_kuliah;
                $rgn->dosen_pengampu = $ruanganDetail->nip_dosen;
                $rgn->mata_kuliah_id = $ruanganDetail->mata_kuliah_id;
                $carbonDate = Carbon::parse($ruanganDetail->waktu_mulai);
                $rgn->waktu_mulai = $carbonDate->translatedFormat('l');            
            } else {
                $rgn->status = 'Tidak Digunakan';
                $rgn->mata_kuliah = '-';
                $rgn->dosen_pengampu = '-';
                $rgn->mata_kuliah_id = '-';
                $rgn->waktu_mulai = '-';
            }
        }

        $jumlah_ruangan = $ruangan->count();
        $user = Auth::user();
        $namaDosen = $user->nama;

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
        $countMatakuliah = null;
        $count = null;
        if ($user->role_id == 5) {
            $countMatakuliah = MataKuliah::whereHas('semester', function ($query) {
                $query->whereDate('tanggal_selesai', '>=', now());
            })
            ->count();
            $matakuliah = MataKuliah::whereHas('semester', function ($query) 
            {
                $query->whereDate('tanggal_selesai', '<', Carbon::now());
            })->with('perkuliahann')->get();

            $count = $matakuliah->count();
        }
        elseif($user->role_id == 6) {
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

        return view('absensi_menu.absensi.ruangan', compact('ruangan', 'jumlah_ruangan', 'jumlah_riwayat', 'jumlah_absensi', 'countMatakuliah', 'count'));
   
    }



    public function matakuliah($id)
    {
        $ruangan = AbRuangan::findOrFail($id);
        $matakuliah = MataKuliah::where('ruangan_id', $id)
            ->whereHas('semester', function ($query) {
                $query->whereDate('tanggal_selesai', '>=', now());
            })->get();

        return view('absensi_menu.absensi.daftar-matakuliah', compact('ruangan', 'matakuliah'));
    }

    public function ruanganabsensiadmin()
    {
        $ruanganData = DB::select(DB::raw("SELECT r.id AS ruangan_id, r.nama_ruangan AS nama_ruangan, p.id AS perkuliahan_id, p.created_at AS waktu_mulai, p.jenis_perkuliahan, p.mata_kuliah_id, mk.mk AS mata_kuliah, mk.nip_dosen 
                                       FROM ab_ruangan r 
                                       JOIN ab_matakuliah mk ON r.id = mk.ruangan_id 
                                       JOIN ab_perkuliahan p ON mk.id = p.mata_kuliah_id 
                                       WHERE p.status = 'Perkuliahan Dimulai'"));
        $ruangan = AbRuangan::all();
        foreach ($ruangan as $rgn) {
            $ruanganDetail = collect($ruanganData)->firstWhere('ruangan_id', (int)$rgn->id);

            if ($ruanganDetail) {
                $rgn->status = 'Sedang Digunakan';
                $rgn->mata_kuliah = $ruanganDetail->mata_kuliah;
                $rgn->dosen_pengampu = $ruanganDetail->nip_dosen;
                $rgn->mata_kuliah_id = $ruanganDetail->mata_kuliah_id;
                $carbonDate = Carbon::parse($ruanganDetail->waktu_mulai);
                $rgn->waktu_mulai = $carbonDate->translatedFormat('l');
            } else {
                $rgn->status = 'Tidak Digunakan';
                $rgn->mata_kuliah = '-';
                $rgn->dosen_pengampu = '-';
                $rgn->mata_kuliah_id = '-';
                $rgn->waktu_mulai = '-';
            }
        }

        if (auth()->user()->role_id == 1) {
            $matakuliah = MataKuliah::whereHas('semester', function ($query) {
                $query->whereDate('tanggal_selesai', '>', Carbon::now());
            })->with('perkuliahann')->get();

            $count = $matakuliah->count();

            $matakuliahNow = MataKuliah::whereHas('semester', function ($query) {
                $query->whereDate('tanggal_selesai', '<', Carbon::now());
            })->with('perkuliahann')->get();

            $countMatakuliah = $matakuliahNow->count();
        }
        if (auth()->user()->role_id == 2) {
            $matakuliah = MataKuliah::where('prodi_id', 1)
            ->whereHas('semester', function ($query) {
                $query->whereDate('tanggal_selesai', '>', Carbon::now());
            })->with('perkuliahann')->get();

            $matakuliahNow = MataKuliah::where('prodi_id', 3)
            ->whereHas('semester', function ($query) {
                $query->whereDate('tanggal_selesai', '<', Carbon::now());
            })->with('perkuliahann')->get();

            $count = $matakuliah->count();
            $countMatakuliah = $matakuliahNow->count();
        }
        if (auth()->user()->role_id == 3) {
            $matakuliah = MataKuliah::where('prodi_id', 2)
            ->whereHas('semester', function ($query) {
                $query->whereDate('tanggal_selesai', '>', Carbon::now());
            })->with('perkuliahann')->get();

            $matakuliahNow = MataKuliah::where('prodi_id', 3)
            ->whereHas('semester', function ($query) {
                $query->whereDate('tanggal_selesai', '<', Carbon::now());
            })->with('perkuliahann')->get();

            $count = $matakuliah->count();
            $countMatakuliah = $matakuliahNow->count();
        }

        if (auth()->user()->role_id == 4) {
            $matakuliah = MataKuliah::where('prodi_id', 3)
            ->whereHas('semester', function ($query) {
                $query->whereDate('tanggal_selesai', '>', Carbon::now());
            })->with('perkuliahann')->get();

            $matakuliahNow = MataKuliah::where('prodi_id', 3)
            ->whereHas('semester', function ($query) {
                $query->whereDate('tanggal_selesai', '<', Carbon::now());
            })->with('perkuliahann')->get();

            $count = $matakuliah->count();
            $countMatakuliah = $matakuliahNow->count();
        }
        if (auth()->user()->role_id == 5) {
            $matakuliah = MataKuliah::whereHas('semester', function ($query) {
                $query->whereDate('tanggal_selesai', '>', Carbon::now());
            })->with('perkuliahann')->get();

            $count = $matakuliah->count();

            $matakuliahNow = MataKuliah::whereHas('semester', function ($query) {
                $query->whereDate('tanggal_selesai', '<', Carbon::now());
            })->with('perkuliahann')->get();

            $countMatakuliah = $matakuliahNow->count();
        }
        if (auth()->user()->role_id == 6) {
            $matakuliah = MataKuliah::where('prodi_id', 1)
            ->whereHas('semester', function ($query) {
                $query->whereDate('tanggal_selesai', '>', Carbon::now());
            })->with('perkuliahann')->get();

            $matakuliahNow = MataKuliah::where('prodi_id', 3)
            ->whereHas('semester', function ($query) {
                $query->whereDate('tanggal_selesai', '<', Carbon::now());
            })->with('perkuliahann')->get();

            $count = $matakuliah->count();
            $countMatakuliah = $matakuliahNow->count();
        }
        if (auth()->user()->role_id == 7) {
            $matakuliah = MataKuliah::where('prodi_id', 2)
            ->whereHas('semester', function ($query) {
                $query->whereDate('tanggal_selesai', '>', Carbon::now());
            })->with('perkuliahann')->get();

            $matakuliahNow = MataKuliah::where('prodi_id', 3)
            ->whereHas('semester', function ($query) {
                $query->whereDate('tanggal_selesai', '<', Carbon::now());
            })->with('perkuliahann')->get();

            $count = $matakuliah->count();
            $countMatakuliah = $matakuliahNow->count();
        }
        if (auth()->user()->role_id == 8) {
            $matakuliah = MataKuliah::where('prodi_id', 3)
            ->whereHas('semester', function ($query) {
                $query->whereDate('tanggal_selesai', '>', Carbon::now());
            })->with('perkuliahann')->get();

            $matakuliahNow = MataKuliah::where('prodi_id', 3)
            ->whereHas('semester', function ($query) {
                $query->whereDate('tanggal_selesai', '<', Carbon::now());
            })->with('perkuliahann')->get();

            $count = $matakuliah->count();
            $countMatakuliah = $matakuliahNow->count();
        }

        $jumlah_ruangan = $ruangan->count();
        return view('absensi_menu.matakuliah.ruangan', compact('ruangan', 'jumlah_ruangan', 'count', 'countMatakuliah'));
    }


    public function create()
    {
        return view('absensi_menu.ab-gedung.create-ruangan', [
            'roles' => Role::all(),
            'gedungs' => AbGedung::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_ruangan' => ['required'],
            'gedung_id' => ['required'],
        ]);

        AbRuangan::create($request->all());

        return redirect('/gedung/ruangan')->with('message', 'Data berhasil ditambahkan');
    }

    public function edit(AbRuangan $ruangan)
    {
        return view('absensi_menu.ab-gedung.edit-ruangan', [
            'ruangan' => $ruangan,
            'gedungs' => AbGedung::all()
        ]);
    }

    public function update(Request $request, AbRuangan $ruangan)
    {
        $validated = $request->validate([
            'nama_ruangan' => ['required'],
            'gedung_id' => ['required'],
        ]);

        AbRuangan::where('id', $ruangan->id)
            ->update($validated);

        return redirect('/gedung/ruangan')->with('message', 'Data Berhasil Diedit!');
    }

    public function destroy(Request $request)
    {
        $ruangan = AbRuangan::find($request->ruangan_deleted_category);
        $ruangan->delete();
        return redirect('/gedung/ruangan');
    }

    public function absensimahasiswa()
    {
        $mahasiswa_id = Auth::user()->id; // Sesuaikan dengan cara Anda mendapatkan ID mahasiswa

        // Ambil riwayat absensi mahasiswa
        $riwayatAbsensi = Absensi::where('student_id', $mahasiswa_id)
            ->with(['class', 'perkuliahan', 'mataKuliah'])
            ->get();

        // Kelompokkan absensi berdasarkan mata kuliah
        $riwayatAbsensiGrouped = $riwayatAbsensi->groupBy('mata_kuliah_id');

        // Inisialisasi array untuk menyimpan jumlah kehadiran per mata kuliah
        $jumlah_kehadiran = [];
        foreach ($riwayatAbsensiGrouped as $mataKuliahId => $riwayat) {
            // Hitung jumlah kehadiran untuk mata kuliah tertentu
            $jumlah_kehadiran[$mataKuliahId] = $riwayat->where('keterangan', 'Hadir')->count();
        }

        // Membuat array untuk riwayat absensi yang difilter
        $riwayatAbsensiGroupedFinal = [];
        foreach ($riwayatAbsensiGrouped as $mataKuliahId => $riwayat) {
            $riwayatPerkuliahanGroupedByClass = $riwayat->groupBy('class_id');

            foreach ($riwayatPerkuliahanGroupedByClass as $classId => $riwayatByClass) {
                $latestAttendance = $riwayatByClass->sortByDesc('created_at')->first();

                $tanggalSelesai = $latestAttendance->class->semester->tanggal_selesai;
                if ($tanggalSelesai > now()) {
                    $latestAttendance->jumlah_kehadiran = $jumlah_kehadiran[$mataKuliahId] ?? 0;
                    $riwayatAbsensiGroupedFinal[] = $latestAttendance;
                }
            }
        }
        $total_absensi = count($riwayatAbsensiGroupedFinal);
        // Menghitung total absensi per mata kuliah
        foreach ($riwayatAbsensi as $absensi) {
            if ($absensi->keterangan === 'Hadir') {
                $mataKuliah = $absensi->mata_kuliah;
                $jumlah_kehadiran[$mataKuliah] = ($jumlah_kehadiran[$mataKuliah] ?? 0) + 1;
            }
        }

        // dd($jumlah_kehadiran);
        // Menghitung total riwayat matkul
        $riwayatMatkulGroupedFinal = [];
        foreach ($riwayatAbsensiGrouped as $mataKuliahId => $riwayat) {
            $riwayatPerkuliahanGroupedMataKuliah = $riwayat->groupBy('class_id');

            foreach ($riwayatPerkuliahanGroupedMataKuliah as $classId => $riwayatByClass) {
                $latestAbsensi = $riwayatByClass->sortByDesc('attended_at')->first();

                $tanggalFinish = $latestAbsensi->class->semester->tanggal_selesai;

                if ($tanggalFinish < now()) {
                    $latestAbsensi->jumlah_kehadiran = $jumlah_kehadiran[$mataKuliahId] ?? 0;
                    $riwayatMatkulGroupedFinal[] = $latestAbsensi;
                }
            }
        }

        $total_matkul = count($riwayatMatkulGroupedFinal);

        // Menghitung jumlah ruangan yang digunakan
        $ruangan = AbRuangan::all();
        foreach ($ruangan as $rgn) {
            $perkuliahan = Perkuliahan::whereHas('mataKuliah.ruangan', function ($query) use ($rgn) {
                $query->where('id', $rgn->id);
            })->where('status', '!=', 'Perkuliahan Selesai')->first();

            if ($perkuliahan) {
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

        return view('absensi_menu.mahasiswa.index', compact('riwayatAbsensiGroupedFinal', 'total_absensi', 'total_matkul', 'jumlah_ruangan', 'jumlah_kehadiran'));
    }


    public function ruanganabsensimahasiswa()
    {

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

                if ($tanggalFinish < now()) {
                    $riwayatMatkulGroupedFinal[] = $latestAbsensi;
                }
            }
        }


        $total_matkul = count($riwayatMatkulGroupedFinal);
        return view('absensi_menu.mahasiswa.ruangan', compact('ruangan', 'jumlah_ruangan', 'total_absensi', 'total_matkul'));
    }

}
