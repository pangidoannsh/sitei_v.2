<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Jam;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class JamController extends Controller
{
    public function index()
    {
        return view('jam.index', [
            'jams' => Jam::all(),
        ]);
    }

    public function create()
    {
        return view('jam.create', [
            'jams' => Jam::all(),
            'roles' => Role::all(),
        
        ]);
        
    }

    public function store(Request $request)
    {
        $request->validate([
            'jam_tersedia' => ['required', 'unique:jam'],
        ]);

        Jam::create([
            'jam_tersedia' => $request->jam_tersedia,
        ]);
        return redirect('/jam')->with('message', 'Data Berhasil Ditambahkan!');
    }

    public function edit(Jam $jam)
    {
        return view('jam.edit', [
            'jam' => $jam,
        ]);
    }

    public function update(Request $request, Jam $jam)
    {
        if ($request->jam_tersedia != $jam->jam_tersedia) {
            $validated = $request->validate([
                'jam_tersedia' => ['required', 'unique:jam'],
            ]);

            Jam::where('id', $jam->id)
                ->update($validated);

            return redirect('/jam')->with('message', 'Data Berhasil Diubah!');
        } else {
            return redirect('/jam')->with('message', 'Data Berhasil Diubah!');
        }
    }

    public function destroy(Jam $jam)
    {
        Jam::destroy($jam->id);
        return redirect('/jam')->with('message', 'Data Berhasil Dihapus!');
    }
}
