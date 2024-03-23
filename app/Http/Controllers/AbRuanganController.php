<?php

namespace App\Http\Controllers;

use App\Models\AbGedung;
use App\Models\AbRuangan;
use App\Models\Perkuliahan;
use App\Models\Role;

use Illuminate\Http\Request;

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
        return view('absensi_menu.ab-gedung.ruangan', compact('ruangan'));
    }

    public function ruanganabsensi()
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
                $rgn->mata_kuliah_id ='-';
            }
        }

        $jumlah_ruangan = $ruangan->count();
        return view('absensi_menu.absensi.ruangan', compact('ruangan', 'jumlah_ruangan'));
    }

    public function ruanganabsensiadmin()
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
        return view('absensi_menu.matakuliah.ruangan', compact('ruangan', 'jumlah_ruangan'));
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
        return view('ab-gedung.edit-ruangan', [
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
}
