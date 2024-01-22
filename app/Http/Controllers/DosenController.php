<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Dosen;
use App\Models\Prodi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class DosenController extends Controller
{
    public function index()
    {
        return view('dosen.index', [
            'dosens' => Dosen::all()
        ]);
    }

    public function create()
    {
        return view('dosen.create', [
            'prodis' => Prodi::all(),
            'roles' => Role::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nip' => ['required', 'unique:dosen'],
            'password' => ['required', 'min:3', 'max:255'],
            // 'gambar' => ['image', 'file', 'max:1024'],
            'nama' => ['required'],
            'nama_singkat' => ['required'],
            'email' => ['required', 'unique:dosen', 'email'],
            // 'role_id' => ['unique:dosen']
        ]);

        if ($request->role_id === null) {
            Dosen::create([
                'role_id' => null,
                'prodi_id' => $request->prodi_id,
                'nip' => $request->nip,
                'password' => Hash::make($request->password),
                // 'gambar' => $request->file('gambar')->store('gambar'),
                'nama' => $request->nama,
                'nama_singkat' => $request->nama_singkat,
                'email' => $request->email,
            ]);

            return redirect('/dosen')->with('message', 'Data Berhasil Ditambahkan!');
        } else {
            $cari = Dosen::where('role_id', $request->role_id)->get();
            if ($cari->count() > 0) {
                return redirect('/dosen')->with('loginError', 'Jabatan Sudah Ada!');
            } else {
                Dosen::create([
                    'role_id' => $request->role_id,
                    'prodi_id' => $request->prodi_id,
                    'nip' => $request->nip,
                    'password' => Hash::make($request->password),
                    'nama' => $request->nama,
                    'nama_singkat' => $request->nama_singkat,
                    'email' => $request->email,
                ]);

                return redirect('/dosen')->with('message', 'Data Berhasil Ditambahkan!');
            }
        }
    }

    public function edit(Dosen $dosen)
    {
        return view('dosen.edit', [
            'dosen' => $dosen,
            'roles' => Role::all(),
            'prodis' => Prodi::all(),
        ]);
    }

    public function update(Request $request, Dosen $dosen)
    {
        $rules = [
            'nama' => ['required'],
            'nama_singkat' => ['required'],
            // 'password' => ['required', 'min:3', 'max:255'],
        ];

        if ($dosen->nip != $request->nip) {
            $rules['nip'] = 'required|unique:dosen';
        } elseif ($dosen->email != $request->email) {
            $rules['email'] = 'required|unique:dosen';
        } elseif ($dosen->role_id != $request->role_id) {
            $rules['role_id'] = 'nullable';
        }

        $validated = $request->validate($rules);

        Dosen::where('id', $dosen->id)
            ->update($validated);

        return redirect('/dosen')->with('message', 'Data Berhasil Diubah!');
    }

    public function destroy(Dosen $dosen)
    {
        if ($dosen->gambar) {
            Storage::delete($dosen->gambar);
        }

        Dosen::destroy($dosen->id);
        return redirect('/dosen')->with('message', 'Data Berhasil Dihapus!');
    }

    public function reset_password(Request $request, $id)
    {
        $dosen = Dosen::find($id);

        $newPassword = $dosen->nip;
        $dosen->password = Hash::make($newPassword);
        $dosen->save();

        Alert::success('Berhasil!', 'Password berhasil direset ke NIP Dosen bersangkutan')->showConfirmButton('Ok', '#28a745');
        return  back();

    }
}
