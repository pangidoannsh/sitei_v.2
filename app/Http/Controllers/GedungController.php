<?php

namespace App\Http\Controllers;

use App\Models\AbGedung;
use App\Models\AbRuangan;
use App\Models\Role;
use Illuminate\Http\Request;

class GedungController extends Controller
{
    public function index()
    {
        $gedung = AbGedung::all();
        $jumlah_gedung = $gedung->count();
        $ruangan = AbRuangan::all();
        $jumlah_ruangan = $ruangan->count();
        return view('absensi_menu.ab-gedung.index', compact('gedung', 'jumlah_gedung', 'jumlah_ruangan'));
    }

    public function create()
    {
        return view('absensi_menu.ab-gedung.create', [
            'roles' => Role::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_gedung' => ['required'],
            'koordinat_longitude' => ['required'],
            'koordinat_latitude' => ['required']
        ]);

        AbGedung::create($request->all());

        return redirect('/gedung')->with('message', 'Data berhasil ditambahkan');
    }

    public function edit(AbGedung $gedung)
    {
        return view('absensi_menu.ab-gedung.edit', [
            'gedung' => $gedung,
        ]);
    }

    public function update(Request $request, AbGedung $gedung)
    {
        $validated = $request->validate([
            'nama_gedung' => ['required'],
            'koordinat_longitude' => ['required'],
            'koordinat_latitude' => ['required'],
        ]);

        AbGedung::where('id', $gedung->id)
            ->update($validated);

        return redirect('/gedung')->with('message', 'Data Berhasil Diedit!');
    }

    public function destroy(Request $request)
    {
        $gedung = AbGedung::find($request->gedung_deleted_category);
        $gedung->delete();
        return redirect('/gedung');
    }
}
