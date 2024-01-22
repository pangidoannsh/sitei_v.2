<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Prodi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index', [
            'users' => User::all(),
            'roles' => Role::all(),
            'prodis' => Prodi::all(),
        ]);
    }

    public function create()
    {
        return view('user.create', [
            'roles' => Role::all(),
            'prodis' => Prodi::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'role_id' => ['required'],
            'username' => ['required', 'unique:users'],
            'password' => ['required', 'min:3', 'max:255'],
            'nama' => ['required'],
            'email' => ['required', 'unique:users', 'email'],
        ]);

        User::create([
            'role_id' => $request->role_id,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'nama' => $request->nama,
            'email' => $request->email,
        ]);

        return redirect('/user')->with('message', 'Data Berhasil Ditambahkan!');
    }

    public function edit(User $user)
    {
        return view('user.edit', [
            'user' => $user,
            'roles' => Role::all()
        ]);
    }

    public function update(Request $request, User $user)
    {
        $rules = [
            'role_id' => ['required'],
            'nama' => ['required'],
        ];

        if ($request->username != $user->username) {
            $rules['username'] = 'required|unique:users';
        } elseif ($request->email != $user->email) {
            $rules['email'] = 'required|unique:users|email';
        }

        $validated = $request->validate($rules);

        User::where('id', $user->id)
            ->update($validated);

        return redirect('/user')->with('message', 'Data Berhasil Diubah!');
    }

    public function destroy(User $user)
    {
        User::destroy($user->id);
        return redirect('/user')->with('message', 'Data Berhasil Dihapus!');
    }

    public function reset_password(Request $request, $id)
    {
        $user = User::find($id);

        $newPassword = $user->username;
        $user->password = Hash::make($newPassword);
        $user->save();

        Alert::success('Berhasil!', 'Password berhasil direset ke username Staff bersangkutan')->showConfirmButton('Ok', '#28a745');
        return  back();

    }
}
