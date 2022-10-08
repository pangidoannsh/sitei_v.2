<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StaffProfilController extends Controller
{
    public function editpswstaff(User $user)
    {
        return view('user.profil-editpsw', [
            'user' => $user,
        ]);
    }

    public function updatepswstaff()
    {
        request()->validate([
            'password_lama' => ['required'],
            'password' => ['required', 'min:5', 'max:255', 'confirmed'],
        ]);

        $current_password = auth()->user()->password;
        $old_password = request('password_lama');
        $user_id = auth()->user()->id;

        if (Hash::check($old_password, $current_password)) {

            $user = User::find($user_id);

            $user->password = Hash::make(request('password'));

            if ($user->save()) {
                return redirect('/form')->with('message', 'Password Berhasil Diedit!');
            } else {
                return back()->with('message', 'Password Salah!');
            }            
        } else {
            return back()->with('message', 'Password Salah!');
        }
    }
}
