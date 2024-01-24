<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class MahasiswaProfilController extends Controller
{
    public function editpswmhs(Mahasiswa $mahasiswa)
    {
        return view('mahasiswa.profil-editpsw', [
            'mahasiswa' => $mahasiswa,
        ]);
    }

    public function updatepswmhs()
    {
        request()->validate([
            'password_lama' => ['required'],
            'password' => ['required', 'min:5', 'max:255', 'confirmed'],
        ]);

        $current_password = auth()->user()->password;
        $old_password = request('password_lama');
        $mahasiswa_id = auth()->user()->id;

        if (Hash::check($old_password, $current_password)) {

            $mahasiswa = Mahasiswa::find($mahasiswa_id);

            $mahasiswa->password = Hash::make(request('password'));

            if ($mahasiswa->save()) {
                Alert::success('Berhasil!', 'Password diperbarui!')->showConfirmButton('Ok', '#28a745');
                return redirect('/kp-skripsi');
            } else {
                // return back()->with('message', 'Password Salah!');
                 Alert::error('Gagal!', 'Password Salah!')->showConfirmButton('Ok', '#dc3545');
                 return  back();
            }        
        } else {
            // return back()->with('message', 'Password Salah!');
            Alert::error('Gagal!', 'Password Salah!')->showConfirmButton('Ok', '#dc3545');
            return  back();
        }
    }
}