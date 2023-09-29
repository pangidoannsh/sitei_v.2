<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    public function index()
    {
        return view('ruangan.index', [
            'ruangans' => Ruangan::all(),
        ]);
    }

    public function create()
    {
        return view('ruangan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_ruangan' => ['required', 'unique:ruangan'],
        ]);

        Ruangan::create([
            'nama_ruangan' => $request->nama_ruangan,
        ]);
        return redirect('/ruangan')->with('message', 'Data Berhasil Ditambahkan!');
    }

    public function edit(Ruangan $ruangan)
    {
        return view('ruangan.edit', [
            'ruangan' => $ruangan,
        ]);
    }

    public function update(Request $request, Ruangan $ruangan)
    {
        if ($request->nama_ruangan != $ruangan->nama_ruangan) {
            $validated = $request->validate([
                'nama_ruangan' => ['required', 'unique:ruangan'],
            ]);

            Ruangan::where('id', $ruangan->id)
                ->update($validated);

            return redirect('/ruangan')->with('message', 'Data Berhasil Diubah!');
        } else {
            return redirect('/ruangan')->with('message', 'Data Berhasil Diubah!');
        }
    }

    public function destroy(Ruangan $ruangan)
    {
        Ruangan::destroy($ruangan->id);
        return redirect('/ruangan')->with('message', 'Data Berhasil Dihapus!');
    }
}
