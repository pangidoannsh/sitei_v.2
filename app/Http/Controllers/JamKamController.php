<?php

namespace App\Http\Controllers;

use App\Models\JamKam;
use App\Models\Role;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class JamKamController extends Controller
{
    public function index()
    {
        return view('jamkam.index', [
            'jamkams' => JamKam::all(),
        ]);
    }

    public function create()
    {
        return view('jamkam.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jam_tersedia' => ['required', 'unique:jam_tersedia'],
        ]);

        JamKam::create([
            'jam_tersedia' => $request->jam_tersedia,
        ]);
        return redirect('/jamkam')->with('message', 'Data Berhasil Ditambahkan!');
    }

    public function edit(JamKam $jamkam)
    {
        return view('jamkam.edit', [
            'jamkam' => $jamkam,
        ]);
    }

    public function update(Request $request, JamKam $jamkam)
    {
        if ($request->jam_tersedia != $jamkam->jam_tersedia) {
            $validated = $request->validate([
                'jam_tersedia' => ['required', 'unique:jamkam'],
            ]);

            JamKam::where('id', $jamkam->id)
                ->update($validated);

            return redirect('/jamkam')->with('message', 'Data Berhasil Diubah!');
        } else {
            return redirect('/jamkam')->with('message', 'Data Berhasil Diubah!');
        }
    }

    public function destroy(JamKam $jamkam)
    {
        JamKam::destroy($jamkam->id);
        return redirect('/jamkam')->with('message', 'Data Berhasil Dihapus!');
    }
}
