<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\JamKPSel;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class JamKPSelController extends Controller
{
    public function index()
    {
        return view('jamkpsel.index', [
            'jamkpsels' => JamKPSel::all(),
        ]);
    }

    public function create()
    {
        return view('jamkpsel.create', [
            'jamkpsels' => JamKPSel::all(),
            'roles' => Role::all(),
        
        ]);
        
    }

    public function store(Request $request)
    {
        $request->validate([
            'jam_tersedia' => ['required', 'unique:jam_tersedia'],
        ]);

        JamKPSel::create([
            'jam_tersedia' => $request->jam_tersedia,
        ]);
        return redirect('/jamkpsel')->with('message', 'Data Berhasil Ditambahkan!');
    }

    public function edit(JamKPSel $jamkpsel)
    {
        return view('jamkpsel.edit', [
            'jamkpsel' => $jamkpsel,
        ]);
    }

    public function update(Request $request, JamKPSel $jamkpsel)
    {
        if ($request->jamkpsel != $jamkpsel->jam_tersedia) {
            $validated = $request->validate([
                'jam_tersedia' => ['required', 'unique:jam_tersedia'],
            ]);

            JamKPSel::where('id', $jamkpsel->id)
                ->update($validated);

            return redirect('/jamkpsel')->with('message', 'Data Berhasil Diubah!');
        } else {
            return redirect('/jamkpsel')->with('message', 'Data Berhasil Diubah!');
        }
    }

    public function destroy(JamKPSel $jamkpsel)
    {
        JamKPSel::destroy($jamkpsel->id);
        return redirect('/jamkpsel')->with('message', 'Data Berhasil Dihapus!');
    }
}
