<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\JamKPKam;
use Illuminate\Http\Request;


class JamKPKamController extends Controller
{
    public function index()
    {
        return view('jamkpkam.index', [
            'jamkpkams' => JamKPKam::all(),
        ]);
    }

    public function create()
    {
        return view('jamkpkam.create', [
            'jamkpkams' => JamKPKam::all(),
            'roles' => Role::all(),
        
        ]);
        
    }

    public function store(Request $request)
    {
        $request->validate([
            'jam_tersedia' => ['required', 'unique:jam_tersedia'],
        ]);

        JamKPKam::create([
            'jam_tersedia' => $request->jam_tersedia,
        ]);
        return redirect('/jamkpkam')->with('message', 'Data Berhasil Ditambahkan!');
    }

    public function edit(JamKPKam $jamkpkam)
    {
        return view('jamkpkam.edit', [
            'jamkpkam' => $jamkpkam,
        ]);
    }

    public function update(Request $request, JamKPKam $jamkpkam)
    {
        if ($request->jam_tersedia != $jamkpkam->jam_tersedia) {
            $validated = $request->validate([
                'jamkpkam' => ['required', 'unique:jamkpkam'],
            ]);

            JamKPKam::where('id', $jamkpkam->id)
                ->update($validated);

            return redirect('/jamkpkam')->with('message', 'Data Berhasil Diubah!');
        } else {
            return redirect('/jamkpkam')->with('message', 'Data Berhasil Diubah!');
        }
    }

    public function destroy(JamKPKam $jamkpkam)
    {
        JamKPKam::destroy($jamkpkam->id);
        return redirect('/jamkpkam')->with('message', 'Data Berhasil Dihapus!');
    }
}
