<?php

namespace App\Http\Controllers;

use App\Models\JamSel;
use App\Models\Role;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class JamSelController extends Controller
{
    public function index()
    {
        return view('jamsel.index', [
            'jamsels' => JamSel::all(),
        ]);
    }

    public function create()
    {
        return view('jamsel.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jam_tersedia' => ['required', 'unique:jam_tersedia'],
        ]);

        JamSel::create([
            'jam_tersedia' => $request->jam_tersedia,
        ]);
        return redirect('/jamsel')->with('message', 'Data Berhasil Ditambahkan!');
    }

    public function edit(JamSel $jamsel)
    {
        return view('jamsel.edit', [
            'jamsel' => $jamsel,
        ]);
    }

    public function update(Request $request, JamSel $jamsel)
    {
        if ($request->jam_tersedia != $jamsel->jam_tersedia) {
            $validated = $request->validate([
                'jam_tersedia' => ['required', 'unique:jamsel'],
            ]);

            JamSel::where('id', $jamsel->id)
                ->update($validated);

            return redirect('/jamsel')->with('message', 'Data Berhasil Diubah!');
        } else {
            return redirect('/jamsel')->with('message', 'Data Berhasil Diubah!');
        }
    }

    public function destroy(JamSel $jamsel)
    {
        JamSel::destroy($jamsel->id);
        return redirect('/jamsel')->with('message', 'Data Berhasil Dihapus!');
    }
}
