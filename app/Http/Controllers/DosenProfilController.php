<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;


class DosenProfilController extends Controller
{
    public function index()
    {
        return view('dosen.profil', [
            'dosens' => Dosen::where('id', auth()->user()->id)->get(),
        ]);
    }

    public function editfotodsn(Dosen $dosen)
    {
        return view('dosen.profil-editfoto', [
            'dosen' => $dosen,
        ]);
    }

    public function updatefotodsn(Request $request, Dosen $dosen)
    {
        $rules = [
            'gambar' => ['image', 'file', 'max:1024'],
        ];

        $validated = $request->validate($rules);

        if ($request->file('gambar')) {

            if ($request->oldImagedsn) {
                Storage::delete($request->oldImagedsn);
            }

            $validated['gambar'] = $request->file('gambar')->store('gambar');
        }

        Dosen::where('id', $dosen->id)
            ->update($validated);

        return redirect('/profil-dosen')->with('message', 'Gambar Berhasil Diedit!');
    }

    public function editpswdsn(Dosen $dosen)
    {
        return view('dosen.profil-editpsw', [
            'dosen' => $dosen,
        ]);
    }

    public function updatepswdsn()
    {
        request()->validate([
            'password_lama' => ['required'],
            'password' => ['required', 'min:5', 'max:255', 'confirmed'],
        ]);

        $current_password = auth()->user()->password;
        $old_password = request('password_lama');
        $dosen_id = auth()->user()->id;

        if (Hash::check($old_password, $current_password)) {

            $dosen = Dosen::find($dosen_id);

            $dosen->password = Hash::make(request('password'));

            if ($dosen->save()) {
                // return redirect('/penilaian')->with('message', 'Password Berhasil Diedit!');
                Alert::success('Berhasil!', 'Password diperbarui!')->showConfirmButton('Ok', '#28a745');
                return redirect('/persetujuan-kp-skripsi');
            } else {
                // return back()->with('message', 'Password Salah!');
                Alert::error('Gagal!', 'Password Salah!')->showConfirmButton('Ok', '#dc3545');
                 return  back();
            }            
        } else {
            return back()->with('message', 'Password Salah!');
            Alert::error('Gagal!', 'Password Salah!')->showConfirmButton('Ok', '#dc3545');
                 return  back();
        }
    }
}
