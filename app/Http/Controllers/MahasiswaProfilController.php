<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
                return redirect('/seminar')->with('message', 'Password Berhasil Diedit!');
            } else {
                return back()->with('message', 'Password Salah!');
            }        
        } else {
            return back()->with('message', 'Password Salah!');
        }
    }
}