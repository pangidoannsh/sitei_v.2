<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index');
    }

    public function postlogin(Request $request)
{
    if (Auth::guard('dosen')->attempt(['nip' => $request->username, 'password' => $request->password])) {
         $user = Auth::guard('dosen')->user();
        if ($user->role_id == 5) {
            return redirect('/kp-skripsi');
        }elseif ($user->role_id == 6) {
            return redirect('persetujuan-kp-skripsi');
        }elseif ($user->role_id == 7) {
            return redirect('persetujuan-kp-skripsi');
        }elseif ($user->role_id == 8) {
            return redirect('persetujuan-kp-skripsi');
        }elseif ($user->role_id == 9) {
            return redirect('persetujuan-kp-skripsi');
        }elseif ($user->role_id == 10) {
            return redirect('persetujuan-kp-skripsi');
        }elseif ($user->role_id == 11) {
            return redirect('persetujuan-kp-skripsi');
        }
         else {
            return redirect('/kp-skripsi/seminar');
        }
        
    } elseif (Auth::guard('web')->attempt(['username' => $request->username, 'password' => $request->password])) {
        $user = Auth::guard('web')->user();
        if ($user->role_id == 1) {
            return redirect('/form');
        } else {
            return redirect('/persetujuan/admin/index');
        }
    } elseif (Auth::guard('mahasiswa')->attempt(['nim' => $request->username, 'password' => $request->password])) {
        return redirect('/kp-skripsi');
    }

    return redirect('/')->with('loginError', 'Login Gagal!');
}

    public function logout()
    {
        if (Auth::guard('dosen')->check()) {
            Auth::guard('dosen')->logout();
        } elseif (Auth::guard('mahasiswa')->check()) {
            Auth::guard('mahasiswa')->logout();
        } elseif (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        }
        return redirect('/');
    }
}
