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
            'visi' => ['required'],
        ]);

        Prodi::create([
            'nama_prodi' => $request->nama_prodi,
            'visi' => $request->visi,
        ]);
        return redirect('/prodi')->with('message', 'Data Berhasil Ditambahkan!');
    }

    public function edit(Prodi $prodi)
    {
        return view('prodi.edit', [
            'prodi' => $prodi,
        ]);
    }

    public function update(Request $request, $id)
    {
        Prodi::findOrFail($id)->update([
            'nama_prodi' => $request->nama_prodi,
            'visi' => $request->visi,
        ]);
        
        return redirect('/prodi')->with('message', 'Data Berhasil Diubah!');

        // if ($request->nama_prodi != $prodi->nama_prodi) {
        //     $validated = $request->validate([
        //         'nama_prodi' => ['required', 'unique:prodi'],
        //         'visi' => ['required'],
        //     ]);

        //     Prodi::where('id', $prodi->id)
        //         ->update($validated);

        //     return redirect('/prodi')->with('message', 'Data Berhasil Diubah!');
        // } else {
        //     return redirect('/prodi')->with('message', 'Data Berhasil Diubah!');
        // }
    }

    public function destroy(Prodi $prodi)
    {
        Prodi::destroy($prodi->id);
        return redirect('/prodi')->with('message', 'Data Berhasil Dihapus!');
    }
}
