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
            'users' => User::where('id', '<', 5)->get(),
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

        // return redirect('/user')->with('message', 'Data Berhasil Ditambahkan!');
        Alert::success('Berhasil!', 'Data Berhasil Ditambahkan!')->showConfirmButton('Ok', '#28a745');
        return  back();
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

        // return redirect('/user')->with('message', 'Data Berhasil Diubah!');
        Alert::success('Berhasil!', 'Data Berhasil Diubah!')->showConfirmButton('Ok', '#28a745');
        return  back();
    }

    public function destroy(User $user)
    {
        User::destroy($user->id);
        // return redirect('/user')->with('message', 'Data Berhasil Dihapus!');
        Alert::success('Berhasil!', 'Data Berhasil Dihapus!')->showConfirmButton('Ok', '#28a745');
        return  back();
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

    //PLP

    public function plp_index()
    {
        return view('plp.index', [
            'plp' => User::where('role_id',12)->get(),
            'roles' => Role::all(),
            'prodis' => Prodi::all(),
        ]);
    }
    public function plp_create()
    {
        return view('plp.create', [
            'roles' => Role::where('id', 12)->get(),
            'prodis' => Prodi::all(),
        ]);
    }

    public function plp_store(Request $request)
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

        // return redirect('/plp')->with('message', 'Data Berhasil Ditambahkan!');
        Alert::success('Berhasil!', 'Data Berhasil Ditambahkan!')->showConfirmButton('Ok', '#28a745');
        return  back();
    }

    public function plp_edit(User $user)
    {
        return view('plp.edit', [
            'user' => $user,
            'roles' => Role::all()
        ]);
    }

    public function plp_update(Request $request, User $user)
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

        // return redirect('/user')->with('message', 'Data Berhasil Diubah!');

        Alert::success('Berhasil!', 'Data Berhasil Diubah!')->showConfirmButton('Ok', '#28a745');
        return  back();
    }




}
