<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Dosen;
use App\Models\Prodi;
use App\Models\Developer;
use Illuminate\Http\Request;
use App\Models\PendaftaranKP;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class DeveloperController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fahril()
    {
        return view('developer.fahril');
    }
    public function naldi()
    {
        return view('developer.naldi');
    }
    public function rahul()
    {
        return view('developer.rahul');
    }

    public function index(){
        return view('developer.index', [
            'developer' => Developer::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('developer.create', [
            'prodis' => Prodi::all(),
            'roles' => Role::all(),
            'dosen' => Dosen::all(),
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
            'nama' => 'required',
            'nim' => 'required',
            'email' => 'required',
            'nama_aplikasi' => 'required',
            'deskripsi_peran' => 'required',
            'peran' => 'required',
            'foto' => 'required|mimes:jpeg,png,jpeg|max:200',
                         
        ]);

         Developer::create([
            'nama' => $request->nama,              
            'nim' => $request->nim,                        
            'email' => $request->email,                        
            'nama_aplikasi' => $request->nama_aplikasi,                        
            'deskripsi_peran' => $request->deskripsi_peran,                        
            'peran' => $request->peran,                        
            'foto' =>$request->file('foto')->store('gambar'),                       
        ]);

        
        return redirect('/developer');
        Alert::success('Berhasil!', 'Data Berhasil disimpan')->showConfirmButton('Ok', '#28a745');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\developer  $developer
     * @return \Illuminate\Http\Response
     */
    
}