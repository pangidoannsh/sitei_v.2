<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    public function index()
    {
        return view('prodi.index', [
            'prodis' => Prodi::all(),
        ]);
    }

    public function create()
    {
        return view('prodi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_prodi' => ['required', 'unique:prodi'],
        ]);

        Prodi::create([
            'nama_prodi' => $request->nama_prodi,
        ]);
        return redirect('/prodi')->with('message', 'Data Berhasil Ditambahkan!');
    }

    public function edit(Prodi $prodi)
    {
        return view('prodi.edit', [
            'prodi' => $prodi,
        ]);
    }

    public function update(Request $request, Prodi $prodi)
    {
        if ($request->nama_prodi != $prodi->nama_prodi) {
            $validated = $request->validate([
                'nama_prodi' => ['required', 'unique:prodi'],
            ]);

            Prodi::where('id', $prodi->id)
                ->update($validated);

            return redirect('/prodi')->with('message', 'Data Berhasil Diubah!');
        } else {
            return redirect('/prodi')->with('message', 'Data Berhasil Diubah!');
        }
    }

    public function destroy(Prodi $prodi)
    {
        Prodi::destroy($prodi->id);
        return redirect('/prodi')->with('message', 'Data Berhasil Dihapus!');
    }
}
