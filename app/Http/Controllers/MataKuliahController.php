<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use App\Models\Dosen;
use App\Models\Ruangan;
use App\Models\Kelas;
use App\Models\Role;
use App\Models\Attendance; // Import the Attendance model
use App\Models\Location;
use App\Models\Prodi;
use Illuminate\Http\Request;
use App\Models\Semester;
use App\Models\AbRuangan;
use App\Models\JenisPerkuliahan;
use App\Models\Absensi;
use App\Models\AbPerkuliahan as Perkuliahan;
use Dompdf\Dompdf;
use Carbon\Carbon;



class MataKuliahController extends Controller
{
    public function index()
    {
        if (auth()->user()->role_id == 1) {
            $matakuliah = MataKuliah::whereHas('semester', function ($query) {
                $query->whereDate('tanggal_selesai', '>', Carbon::now());
            })->with('perkuliahann')->get();

            $count = $matakuliah->count();

            $matakuliahNow = MataKuliah::whereHas('semester', function ($query) {
                $query->whereDate('tanggal_selesai', '<', Carbon::now());
            })->with('perkuliahann')->get();

            $countMatakuliah = $matakuliahNow->count();
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
            $nipDosen = auth()->user()->nip_dosen;
            $jumlah_absensi = MataKuliah::where('nip_dosen', $nipDosen)->count();
            $riwayatAbsensi = MataKuliah::where('nip_dosen', $nipDosen)
                ->whereHas('semester', function ($query) {
                    $query->whereDate('tanggal_selesai', '<=', now());
                })
                ->with('perkuliahann')
                ->get();
            $jumlah_riwayat = $riwayatAbsensi->count();

            return view('absensi_menu.matakuliah.index', compact('matakuliah', 'count', 'countMatakuliah', 'jumlah_ruangan', 'jumlah_absensi'));
        }
        if (auth()->user()->role_id == 2) {
            $matakuliah = MataKuliah::where('prodi_id', 1)
                ->whereHas('semester', function ($query) {
                    $query->whereDate('tanggal_selesai', '>', Carbon::now());
                })->with('perkuliahann')->get();
            $count = $matakuliah->count();
            $matakuliahNow = MataKuliah::where('prodi_id', 1)
                ->whereHas('semester', function ($query) {
                    $query->whereDate('tanggal_selesai', '<', Carbon::now());
                })->with('perkuliahann')->get();

            $countMatakuliah = $matakuliahNow->count();

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

            return view('absensi_menu.matakuliah.index', compact('matakuliah', 'count', 'countMatakuliah', 'jumlah_ruangan'));
        }
        if (auth()->user()->role_id == 3) {
            $matakuliah = MataKuliah::where('prodi_id', 2)
                ->whereHas('semester', function ($query) {
                    $query->whereDate('tanggal_selesai', '>', Carbon::now());
                })->with('perkuliahann')->get();

            $count = $matakuliah->count();

            $matakuliahNow = MataKuliah::where('prodi_id', 2)
                ->whereHas('semester', function ($query) {
                    $query->whereDate('tanggal_selesai', '<', Carbon::now());
                })->with('perkuliahann')->get();

            $countMatakuliah = $matakuliahNow->count();

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

            return view('absensi_menu.matakuliah.index', compact('matakuliah', 'count', 'countMatakuliah', 'jumlah_ruangan'));
        }
        if (auth()->user()->role_id == 4) {
            $matakuliah = MataKuliah::where('prodi_id', 3)
                ->whereHas('semester', function ($query) {
                    $query->whereDate('tanggal_selesai', '>', Carbon::now());
                })->with('perkuliahann')->get();

            $count = $matakuliah->count();

            $matakuliahNow = MataKuliah::where('prodi_id', 3)
                ->whereHas('semester', function ($query) {
                    $query->whereDate('tanggal_selesai', '<', Carbon::now());
                })->with('perkuliahann')->get();

            $countMatakuliah = $matakuliahNow->count();

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

            return view('absensi_menu.matakuliah.index', compact('matakuliah', 'count', 'countMatakuliah', 'jumlah_ruangan'));
        }
        if (auth()->user()->role_id == 5) {
            $matakuliah = MataKuliah::whereHas('semester', function ($query) {
                $query->whereDate('tanggal_selesai', '>', Carbon::now());
            })->with('perkuliahann')->get();

            $count = $matakuliah->count();
            $matakuliah = MataKuliah::whereHas('semester', function ($query) {
                $query->whereDate('tanggal_selesai', '>', Carbon::now());
            })->with('perkuliahann')->get();

            $count = $matakuliah->count();

            $matakuliahNow = MataKuliah::whereHas('semester', function ($query) {
                $query->whereDate('tanggal_selesai', '<', Carbon::now());
            })->with('perkuliahann')->get();

            $countMatakuliah = $matakuliahNow->count();
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
            $nipDosen = auth()->user()->nama;

            $jumlah_absensi = MataKuliah::where('nip_dosen', $nipDosen)
                ->whereHas('semester', function ($query) {
                    $query->whereDate('tanggal_selesai', '>=', now());
                })->with('perkuliahann')->count();

            $riwayatAbsensi = MataKuliah::where('nip_dosen', $nipDosen)
                ->whereHas('semester', function ($query) {
                    $query->whereDate('tanggal_selesai', '<=', now());
                })
                ->with('perkuliahann')
                ->get();

            $jumlah_riwayat = $riwayatAbsensi->count();

            return view('absensi_menu.matakuliah.index', compact('matakuliah', 'count', 'countMatakuliah', 'jumlah_ruangan', 'jumlah_absensi', 'jumlah_riwayat'));
        }
        if (auth()->user()->role_id == 6) {
            $matakuliah = MataKuliah::where('prodi_id', 1)
                ->whereHas('semester', function ($query) {
                    $query->whereDate('tanggal_selesai', '>', Carbon::now());
                })->with('perkuliahann')->get();

            $count = $matakuliah->count();

            $matakuliahNow = MataKuliah::where('prodi_id', 1)
                ->whereHas('semester', function ($query) {
                    $query->whereDate('tanggal_selesai', '<', Carbon::now());
                })->with('perkuliahann')->get();

            $countMatakuliah = $matakuliahNow->count();

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
            $nipDosen = auth()->user()->nama;

            $jumlah_absensi = MataKuliah::where('nip_dosen', $nipDosen)
                ->whereHas('semester', function ($query) {
                    $query->whereDate('tanggal_selesai', '>=', now());
                })->with('perkuliahann')->count();

            $riwayatAbsensi = MataKuliah::where('nip_dosen', $nipDosen)
                ->whereHas('semester', function ($query) {
                    $query->whereDate('tanggal_selesai', '<=', now());
                })
                ->with('perkuliahann')
                ->get();

            $jumlah_riwayat = $riwayatAbsensi->count();

            return view('absensi_menu.matakuliah.index', compact('matakuliah', 'count', 'countMatakuliah', 'jumlah_ruangan', 'jumlah_absensi', 'jumlah_riwayat'));
        }
        if (auth()->user()->role_id == 7) {
            $matakuliah = MataKuliah::where('prodi_id', 2)
                ->whereHas('semester', function ($query) {
                    $query->whereDate('tanggal_selesai', '>', Carbon::now());
                })->with('perkuliahann')->get();

            $count = $matakuliah->count();

            $matakuliahNow = MataKuliah::where('prodi_id', 2)
                ->whereHas('semester', function ($query) {
                    $query->whereDate('tanggal_selesai', '<', Carbon::now());
                })->with('perkuliahann')->get();

            $countMatakuliah = $matakuliahNow->count();

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
            $nipDosen = auth()->user()->nama;

            $jumlah_absensi = MataKuliah::where('nip_dosen', $nipDosen)
                ->whereHas('semester', function ($query) {
                    $query->whereDate('tanggal_selesai', '>=', now());
                })->with('perkuliahann')->count();

            $riwayatAbsensi = MataKuliah::where('nip_dosen', $nipDosen)
                ->whereHas('semester', function ($query) {
                    $query->whereDate('tanggal_selesai', '<=', now());
                })
                ->with('perkuliahann')
                ->get();

            $jumlah_riwayat = $riwayatAbsensi->count();

            return view('absensi_menu.matakuliah.index', compact('matakuliah', 'count', 'countMatakuliah', 'jumlah_ruangan', 'jumlah_absensi', 'jumlah_riwayat'));
        }
        if (auth()->user()->role_id == 8) {
            $matakuliah = MataKuliah::where('prodi_id', 3)
                ->whereHas('semester', function ($query) {
                    $query->whereDate('tanggal_selesai', '>', Carbon::now());
                })->with('perkuliahann')->get();

            $count = $matakuliah->count();

            $matakuliahNow = MataKuliah::where('prodi_id', 3)
                ->whereHas('semester', function ($query) {
                    $query->whereDate('tanggal_selesai', '<', Carbon::now());
                })->with('perkuliahann')->get();

            $countMatakuliah = $matakuliahNow->count();

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
            $nipDosen = auth()->user()->nama;

            $jumlah_absensi = MataKuliah::where('nip_dosen', $nipDosen)
                ->whereHas('semester', function ($query) {
                    $query->whereDate('tanggal_selesai', '>=', now());
                })->with('perkuliahann')->count();

            $riwayatAbsensi = MataKuliah::where('nip_dosen', $nipDosen)
                ->whereHas('semester', function ($query) {
                    $query->whereDate('tanggal_selesai', '<=', now());
                })
                ->with('perkuliahann')
                ->get();

            $jumlah_riwayat = $riwayatAbsensi->count();

            return view('absensi_menu.matakuliah.index', compact('matakuliah', 'count', 'countMatakuliah', 'jumlah_ruangan', 'jumlah_absensi', 'jumlah_riwayat'));
        }
    }

    public function detailstatistik($matakuliah_id)
    {
        $attendances = Absensi::whereHas('perkuliahan', function ($query) use ($matakuliah_id) {
            $query->where('class_id', $matakuliah_id);
        })->get();

        $groupedAttendances = $attendances->groupBy('perkuliahan_id');

        $perkuliahan = Perkuliahan::find($matakuliah_id);

        return view('absensi_menu.absensistatistik.detail-statistik', compact('groupedAttendances', 'perkuliahan', 'attendances', 'matakuliah_id'));
    }

    public function daftarhadir($perkuliahan_id)
    {
        $attendances = Absensi::where('perkuliahan_id', $perkuliahan_id)->get();

        return view('absensi_menu.absensi.daftar-hadir', compact('attendances'));
    }


    public function download_pdf($matakuliah_id)
    {
        $perkuliahan = Perkuliahan::find($matakuliah_id);

        $attendances = Absensi::whereHas('perkuliahan', function ($query) use ($matakuliah_id) {
            $query->where('class_id', $matakuliah_id);
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
        $htmlPage1 = view('absensi_menu.absensistatistik.file')->with(compact('groupedAttendances', 'perkuliahan', 'created_at', 'materi'))->render();
        $htmlPage2 = $htmlPage1;
        $html = $htmlPage1 . $htmlPage2;
        $dompdf->loadHtml($html);

        // Set ukuran dan orientasi halaman
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF
        $dompdf->render();
        return $dompdf->stream('perkuliahan.pdf');
    }

    public function create()
    {

        return view('absensi_menu.matakuliah.create', [
            'roles' => Role::all(),
            'kelass' => Kelas::all(),
            'prodis' => Prodi::all(),
            'dosens' => Dosen::all()->sortBy('nama'),
            'semesters' => Semester::all(),
            'abruangans' => AbRuangan::all()->sortBy('nama_ruangan'),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_mk' => ['required'],
            'mk' => ['required'],
            'kelas_id' => ['required'],
            'prodi_id' => ['required'],
            'sks' => ['required'],
            'semester_id' => ['required'],
            'nip_dosen' => ['required'],
            'hari' => ['required'],
            'jam' => ['required'],
            'ruangan_id' => ['required'],
            'kuota' => ['required'],
            'rps_pertemuan_1' => ['required'],
            'rps_pertemuan_2' => ['required'],
            'rps_pertemuan_3' => ['required'],
            'rps_pertemuan_4' => ['required'],
            'rps_pertemuan_5' => ['required'],
            'rps_pertemuan_6' => ['required'],
            'rps_pertemuan_7' => ['required'],
            'rps_pertemuan_8' => ['required'],
            'rps_pertemuan_9' => ['required'],
            'rps_pertemuan_10' => ['required'],
            'rps_pertemuan_11' => ['required'],
            'rps_pertemuan_12' => ['required'],
            'rps_pertemuan_13' => ['required'],
            'rps_pertemuan_14' => ['required'],
            'rps_pertemuan_15' => ['required'],
            'rps_pertemuan_16' => ['required'],
        ]);

        MataKuliah::create($request->all());

        return redirect('/matakuliah')->with('message', 'Data berhasil ditambahkan');
    }

    public function edit(Matakuliah $matakuliah)
    {

        return view('absensi_menu.matakuliah.edit', [
            'matakuliah' => $matakuliah,
            'dosens' => Dosen::all()->sortBy('nama'),
            'semesters' => Semester::all(),
            'kelass' => Kelas::all(),
            'prodis' => Prodi::all(),
            'abruangans' => AbRuangan::all()->sortBy('nama_ruangan'),
        ]);
    }

    public function show(MataKuliah $matakuliah)
    {
        // Assuming you have a relationship between MataKuliah and Attendance
        $attendanceList = $matakuliah->attendance;

        return view('absensi_menu.absensi.open-absensi', [
            'matakuliah' => $matakuliah,
            'kelass' => Kelas::all()->sortBy('nama_kelas'),
            'prodis' => Prodi::all()->sortBy('nama_prodi'),
            'semesters' => Semester::all(),
            'attendanceList' => $attendanceList,
        ]);
    }

    public function update(Request $request, MataKuliah $matakuliah)
    {
        $validated = $request->validate([
            'kode_mk' => ['required'],
            'mk' => ['required'],
            'kelas_id' => ['required'],
            'prodi_id' => ['required'],
            'sks' => ['required'],
            'semester_id' => ['required'],
            'nip_dosen' => ['required'],
            'hari' => ['required'],
            'jam' => ['required'],
            'ruangan_id' => ['required'],
            'kuota' => ['required'],
        ]);

        MataKuliah::where('id', $matakuliah->id)
            ->update($validated);

        return redirect('/matakuliah')->with('message', 'Data Berhasil Diedit!');
    }

    public function destroy(Request $request)
    {
        $matakuliah = MataKuliah::find($request->matkul_deleted_category);
        $matakuliah->delete();
        return redirect()->back();
    }

    public function riwayat(Request $request)
    {
        if (auth()->user()->role_id == 1) {
            $matakuliah = MataKuliah::whereHas('semester', function ($query) {
                $query->whereDate('tanggal_selesai', '<', Carbon::now());
            })->with('perkuliahann')->get();

            $count = $matakuliah->count();

            $matakuliahNow = MataKuliah::whereHas('semester', function ($query) {
                $query->whereDate('tanggal_selesai', '>', Carbon::now());
            })->with('perkuliahann')->get();

            $countMatakuliah = $matakuliahNow->count();

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

            return view('absensi_menu.matakuliah.riwayat', compact('matakuliah', 'count', 'countMatakuliah', 'jumlah_ruangan'));
        }
        if (auth()->user()->role_id == 2) {
            $matakuliah = MataKuliah::where('prodi_id', 1)
                ->whereHas('semester', function ($query) {
                    $query->whereDate('tanggal_selesai', '<', Carbon::now());
                })->with('perkuliahann')->get();

            $count = $matakuliah->count();

            $matakuliahNow = MataKuliah::where('prodi_id', 1)
                ->whereHas('semester', function ($query) {
                    $query->whereDate('tanggal_selesai', '>', Carbon::now());
                })->with('perkuliahann')->get();

            $count = $matakuliah->count();
            $countMatakuliah = $matakuliahNow->count();

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

            return view('absensi_menu.matakuliah.riwayat', compact('matakuliah', 'count', 'countMatakuliah', 'jumlah_ruangan'));
        }
        if (auth()->user()->role_id == 3) {
            $matakuliah = MataKuliah::where('prodi_id', 2)
                ->whereHas('semester', function ($query) {
                    $query->whereDate('tanggal_selesai', '<', Carbon::now());
                })->with('perkuliahann')->get();

            $count = $matakuliah->count();

            $matakuliahNow = MataKuliah::where('prodi_id', 2)
                ->whereHas('semester', function ($query) {
                    $query->whereDate('tanggal_selesai', '>', Carbon::now());
                })->with('perkuliahann')->get();

            $count = $matakuliah->count();
            $countMatakuliah = $matakuliahNow->count();

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

            return view('absensi_menu.matakuliah.riwayat', compact('matakuliah', 'count', 'countMatakuliah', 'jumlah_ruangan'));
        }
        if (auth()->user()->role_id == 4) {
            $matakuliah = MataKuliah::where('prodi_id', 3)
                ->whereHas('semester', function ($query) {
                    $query->whereDate('tanggal_selesai', '<', Carbon::now());
                })->with('perkuliahann')->get();

            $matakuliahNow = MataKuliah::where('prodi_id', 3)
                ->whereHas('semester', function ($query) {
                    $query->whereDate('tanggal_selesai', '>', Carbon::now());
                })->with('perkuliahann')->get();

            $count = $matakuliah->count();
            $countMatakuliah = $matakuliahNow->count();

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

            return view('absensi_menu.matakuliah.riwayat', compact('matakuliah', 'count', 'countMatakuliah', 'jumlah_ruangan'));
        }
        if (auth()->user()->role_id == 5) {
            $matakuliah = MataKuliah::whereHas('semester', function ($query) {
                $query->whereDate('tanggal_selesai', '<', Carbon::now());
            })->with('perkuliahann')->get();

            $count = $matakuliah->count();

            $matakuliahNow = MataKuliah::whereHas('semester', function ($query) {
                $query->whereDate('tanggal_selesai', '>', Carbon::now());
            })->with('perkuliahann')->get();

            $countMatakuliah = $matakuliahNow->count();

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

            $nipDosen = auth()->user()->nama;

            $jumlah_absensi = MataKuliah::where('nip_dosen', $nipDosen)
                ->whereHas('semester', function ($query) {
                    $query->whereDate('tanggal_selesai', '>=', now());
                })->with('perkuliahann')->count();

            $riwayatAbsensi = MataKuliah::where('nip_dosen', $nipDosen)
                ->whereHas('semester', function ($query) {
                    $query->whereDate('tanggal_selesai', '<=', now());
                })
                ->with('perkuliahann')
                ->get();

            $jumlah_riwayat = $riwayatAbsensi->count();

            return view('absensi_menu.matakuliah.riwayat', compact('matakuliah', 'count', 'countMatakuliah', 'jumlah_ruangan', 'jumlah_absensi', 'jumlah_riwayat'));
        }
        if (auth()->user()->role_id == 6) {
            $matakuliah = MataKuliah::where('prodi_id', 1)
                ->whereHas('semester', function ($query) {
                    $query->whereDate('tanggal_selesai', '<', Carbon::now());
                })->with('perkuliahann')->get();

            $count = $matakuliah->count();

            $matakuliahNow = MataKuliah::where('prodi_id', 1)
                ->whereHas('semester', function ($query) {
                    $query->whereDate('tanggal_selesai', '>', Carbon::now());
                })->with('perkuliahann')->get();

            $count = $matakuliah->count();
            $countMatakuliah = $matakuliahNow->count();

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

            $nipDosen = auth()->user()->nama;

            $jumlah_absensi = MataKuliah::where('nip_dosen', $nipDosen)
                ->whereHas('semester', function ($query) {
                    $query->whereDate('tanggal_selesai', '>=', now());
                })->with('perkuliahann')->count();

            $riwayatAbsensi = MataKuliah::where('nip_dosen', $nipDosen)
                ->whereHas('semester', function ($query) {
                    $query->whereDate('tanggal_selesai', '<=', now());
                })
                ->with('perkuliahann')
                ->get();

            $jumlah_riwayat = $riwayatAbsensi->count();

            return view('absensi_menu.matakuliah.riwayat', compact('matakuliah', 'count', 'countMatakuliah', 'jumlah_ruangan', 'jumlah_absensi', 'jumlah_riwayat'));
        }
        if (auth()->user()->role_id == 7) {
            $matakuliah = MataKuliah::where('prodi_id', 2)
                ->whereHas('semester', function ($query) {
                    $query->whereDate('tanggal_selesai', '<', Carbon::now());
                })->with('perkuliahann')->get();

            $count = $matakuliah->count();

            $matakuliahNow = MataKuliah::where('prodi_id', 2)
                ->whereHas('semester', function ($query) {
                    $query->whereDate('tanggal_selesai', '>', Carbon::now());
                })->with('perkuliahann')->get();

            $count = $matakuliah->count();
            $countMatakuliah = $matakuliahNow->count();

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

            $nipDosen = auth()->user()->nama;

            $jumlah_absensi = MataKuliah::where('nip_dosen', $nipDosen)
                ->whereHas('semester', function ($query) {
                    $query->whereDate('tanggal_selesai', '>=', now());
                })->with('perkuliahann')->count();

            $riwayatAbsensi = MataKuliah::where('nip_dosen', $nipDosen)
                ->whereHas('semester', function ($query) {
                    $query->whereDate('tanggal_selesai', '<=', now());
                })
                ->with('perkuliahann')
                ->get();

            $jumlah_riwayat = $riwayatAbsensi->count();

            return view('absensi_menu.matakuliah.riwayat', compact('matakuliah', 'count', 'countMatakuliah', 'jumlah_ruangan', 'jumlah_absensi', 'jumlah_riwayat'));
        }
        if (auth()->user()->role_id == 8) {
            $matakuliah = MataKuliah::where('prodi_id', 3)
                ->whereHas('semester', function ($query) {
                    $query->whereDate('tanggal_selesai', '<', Carbon::now());
                })->with('perkuliahann')->get();

            $count = $matakuliah->count();

            $matakuliahNow = MataKuliah::where('prodi_id', 3)
                ->whereHas('semester', function ($query) {
                    $query->whereDate('tanggal_selesai', '>', Carbon::now());
                })->with('perkuliahann')->get();

            $countMatakuliah = $matakuliahNow->count();

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

            $nipDosen = auth()->user()->nama;

            $jumlah_absensi = MataKuliah::where('nip_dosen', $nipDosen)
                ->whereHas('semester', function ($query) {
                    $query->whereDate('tanggal_selesai', '>=', now());
                })->with('perkuliahann')->count();

            $riwayatAbsensi = MataKuliah::where('nip_dosen', $nipDosen)
                ->whereHas('semester', function ($query) {
                    $query->whereDate('tanggal_selesai', '<=', now());
                })
                ->with('perkuliahann')
                ->get();

            $jumlah_riwayat = $riwayatAbsensi->count();

            return view('absensi_menu.matakuliah.riwayat', compact('matakuliah', 'count', 'countMatakuliah', 'jumlah_ruangan', 'jumlah_absensi', 'jumlah_riwayat'));
        }
    }
}
