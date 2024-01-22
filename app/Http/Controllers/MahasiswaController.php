<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Prodi;
use App\Models\Mahasiswa;
use App\Models\Konsentrasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class MahasiswaController extends Controller
{
    public function index()
    {
        if (auth()->user()->role_id == 2) {            
            return view('mahasiswa.index', [
                'mahasiswas' => Mahasiswa::where('prodi_id', 1)->get(),                
            ]);
        }
        if (auth()->user()->role_id == 3) {            
            return view('mahasiswa.index', [
                'mahasiswas' => Mahasiswa::where('prodi_id', 2)->get(),                
            ]);
        }
        if (auth()->user()->role_id == 4) {            
            return view('mahasiswa.index', [
                'mahasiswas' => Mahasiswa::where('prodi_id', 3)->get(),                
            ]);
        }
    }

    public function create()
    {
        return view('mahasiswa.create', [
            'roles' => Role::all(),
            'prodis' => Prodi::all(),
            'konsentrasis' => Konsentrasi::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'prodi_id' => ['required'],
            'nim' => ['required', 'unique:mahasiswa'],
            'password' => ['required', 'min:3', 'max:255'],
            // 'gambar' => ['image', 'file', 'max:1024'],
            'nama' => ['required'],
            'email' => ['required', 'unique:dosen', 'email'],
            'angkatan' => ['required'],
        ]);

        Mahasiswa::create([
            'role_id' => $request->role_id,
            'prodi_id' => $request->prodi_id,
            'konsentrasi_id' => $request->konsentrasi_id,
            'nim' => $request->nim,
            'password' => Hash::make($request->password),
            // 'gambar' => $request->file('gambar')->store('gambar'),
            'nama' => $request->nama,
            'email' => $request->email,
            'angkatan' => $request->angkatan,
        ]);

        return redirect('/mahasiswa')->with('message', 'Data Berhasil Ditambahkan!');
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        return view('mahasiswa.edit', [
            'mahasiswa' => $mahasiswa,
            'prodis' => Prodi::all(),
            'konsentrasis' => Konsentrasi::all(),
        ]);
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $rules = [
            'prodi_id' => ['required'],
            'nama' => ['required'],
            'angkatan' => ['required'],
        ];

        if ($mahasiswa->nim != $request->nim) {
            $rules['nim'] = 'required|unique:mahasiswa';
        } elseif ($mahasiswa->email != $request->email) {
            $rules['email'] = 'required|unique:mahasiswa';
        }

        $validated = $request->validate($rules);

        Mahasiswa::where('id', $mahasiswa->id)
            ->update($validated);

        Alert::success('Berhasil!', 'Data berhasill diubah')->showConfirmButton('Ok', '#28a745');
        return redirect('/mahasiswa');
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        // if ($mahasiswa->gambar) {
        //     Storage::delete($mahasiswa->gambar);
        // }

        Mahasiswa::destroy($mahasiswa->id);
        return redirect('/mahasiswa')->with('message', 'Data Berhasil Dihapus!');
    }

    public function reset_password(Request $request, $id)
    {

        $mhs = Mahasiswa::find($id);

        $newPassword = $mhs->nim;
        $mhs->password = Hash::make($newPassword);
        $mhs->save();

        Alert::success('Berhasil!', 'Password berhasil direset ke NIM Mahasiswa bersangkutan')->showConfirmButton('Ok', '#28a745');
        return  back();

    }
}
