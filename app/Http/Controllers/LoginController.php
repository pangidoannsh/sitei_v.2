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
            return redirect('/kp-skripsi/persetujuan');
        } elseif (Auth::guard('web')->attempt(['username' => $request->username, 'password' => $request->password])) {
            return redirect('/persetujuan/admin/index');
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
