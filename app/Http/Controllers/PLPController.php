<?php

namespace App\Http\Controllers;

use App\Models\plp;
use App\Models\Role;
use App\Models\User;
use App\Models\Prodi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class PLPController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('plp.index', [
            'plp' => User::where('role_id',12)->get(),
            'roles' => Role::all(),
            'prodis' => Prodi::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('plp.create', [
            'roles' => Role::all(),
            'prodis' => Prodi::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $request->validate([
            'role_id' => ['required'],
            'username' => ['required', 'unique:users'],
            'password' => ['required', 'min:3', 'max:255'],
            'nama' => ['required'],
            'email' => ['required', 'unique:users', 'email'],
        ]);

        PLP::create([
            'role_id' => $request->role_id,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'nama' => $request->nama,
            'email' => $request->email,
        ]);

        return redirect('/plp')->with('message', 'Data Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\plp  $plp
     * @return \Illuminate\Http\Response
     */
    public function show(plp $plp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\plp  $plp
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $plp = User::find($id);
        $roles = Role::where('id', 12)->get(); // Adjust with your actual Role model

        return view('plp.edit', compact('plp', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\plp  $plp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $plp = User::find($id)->update([
            'role_id' => $request->role_id,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'nama' => $request->nama,
            'email' => $request->email,
        ]);

        Alert::success('Berhasil!', 'Data berhasil diubah')->showConfirmButton('Ok', '#28a745');
        return redirect('/plp');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\plp  $plp
     * @return \Illuminate\Http\Response
     */
    public function destroy(plp $plp)
    {
        //
    }

     public function reset_password(Request $request, $id)
    {
        $plp = PLP::find($id);

        $newPassword = $plp->username;
        $plp->password = Hash::make($newPassword);
        $plp->save();

        Alert::success('Berhasil!', 'Password berhasil direset ke username PLP bersangkutan')->showConfirmButton('Ok', '#28a745');
        return  back();

    }
}
