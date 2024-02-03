<?php

namespace App\Http\Controllers;

use App\Models\Konsentrasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class KonsentrasiController extends Controller
{
    public function index()
    {
        return view('konsentrasi.index', [
            'konsentrasis' => Konsentrasi::all(),
        ]);
    }

    public function create()
    {
        return view('konsentrasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_konsentrasi' => ['required', 'unique:konsentrasi'],
        ]);

        Konsentrasi::create([
            'nama_konsentrasi' => $request->nama_konsentrasi,
        ]);
        // return redirect('/konsentrasi')->with('message', 'Data Berhasil Ditambahkan!');
        Alert::success('Berhasil!', 'Data Berhasil Ditambahkan!')->showConfirmButton('Ok', '#28a745');
        return  redirect('/konsentrasi');
    }

    public function edit(Konsentrasi $konsentrasi)
    {
        return view('konsentrasi.edit', [
            'konsentrasi' => $konsentrasi,
        ]);
    }

    public function update(Request $request, Konsentrasi $konsentrasi)
    {
        if ($request->nama_konsentrasi != $konsentrasi->nama_konsentrasi) {
            $validated = $request->validate([
                'nama_konsentrasi' => ['required', 'unique:konsentrasi'],
            ]);

            Konsentrasi::where('id', $konsentrasi->id)
                ->update($validated);

            // return redirect('/konsentrasi')->with('message', 'Data Berhasil Diubah!');
            Alert::success('Berhasil!', 'Data Berhasil Diubah!')->showConfirmButton('Ok', '#28a745');
        return  redirect('/konsentrasi');
        } else {
            // return redirect('/konsentrasi')->with('message', 'Data Berhasil Diubah!');
            Alert::success('Berhasil!', 'Data Berhasil diubah!')->showConfirmButton('Ok', '#28a745');
        return  redirect('/konsentrasi');
        }
    }

    public function destroy(Konsentrasi $konsentrasi)
    {
        Konsentrasi::destroy($konsentrasi->id);
        return redirect('/konsentrasi')->with('message', 'Data Berhasil Dihapus!');
    }
}
