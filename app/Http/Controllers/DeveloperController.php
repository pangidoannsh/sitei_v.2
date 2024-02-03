<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Dosen;
use App\Models\Prodi;
use App\Models\Developer;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Models\PendaftaranKP;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class DeveloperController extends Controller
{

    public function halamanbaru()
    {
        // $pendaftaran_kp = PendaftaranKP::find($id);
        // $mahasiswa_kp = PendaftaranKP::where('mahasiswa_nim', $pendaftaran_kp->mahasiswa_nim);
        return view('developer.halamanbaru'
        );
    }

    // public function store(Request $request)
    // {
    //     $validatedData = validate([
    //         'nama' => 'required',
                         
    //     ]);

    //     Developer::create([
    //         'nama' => $request->nama,                                          
    //     ]);


    //     Alert::success('Berhasil!', 'Data Berhasil disimpan')->showConfirmButton('Ok', '#28a745');
    //     return redirect('/developer');
    // }


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
    
    public function ahmad()
    {
        return view('developer.ahmad');
    }
    public function yasmine()
    {
        return view('developer.yasmine');
    }
    
    public function yabes()
    {
        return view('developer.yabes');
    }

    public function index(){
        // $developers = Developer::all();
        return view('developer.index');
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
        $validatedData = $request->validate([
            'nama' => 'required',
            'nim' => 'required',
            'email' => 'required',
            'nama_aplikasi' => 'required',
            'deskripsi_peran' => 'required',
            'peran' => 'required',
            'foto' => 'required|mimes:jpeg,png,jpeg|max:200',
                         
        ]);

        $foto = $request->file('foto');

        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($foto->getClientOriginalExtension());
        $img_name = $name_gen.'.'.$img_ext;
        $up_location = 'img/developer/';
        $last_img = $up_location.$img_name;
        $foto->move($up_location,$img_name);

        Developer::insert([
            'nama' => $request->nama,              
            'nim' => $request->nim,                        
            'email' => $request->email,                        
            'nama_aplikasi' => $request->nama_aplikasi,                        
            'deskripsi_peran' => $request->deskripsi_peran,                        
            'peran' => $request->peran,
            'linkedin' => $request->linkedin,                        
            'github' => $request->github,                        
            'foto' => $last_img,                      
        ]);

        Alert::success('Berhasil!', 'Data Berhasil disimpan')->showConfirmButton('Ok', '#28a745');
        return redirect('/developer');
    }

    public function edit(Request $request, $id)
    {
        return view('developer.edit', [
            'dev' => Developer::where('id', $id)->first(),
        ]);
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([                                           
            'nama' => 'required',
            'nim' => 'required',
            'email' => 'required',
            'nama_aplikasi' => 'required',
            'deskripsi_peran' => 'required',
            // 'foto' => 'required|mimes:jpg, jpeg, png|max:200',
                         
        ]);

        $dev = Developer::find($id);
        $dev->nama = $request->nama;
        $dev->nim = $request->nim;
        $dev->email = $request->email;
        $dev->nama_aplikasi = $request->nama_aplikasi;
        $dev->deskripsi_peran = $request->deskripsi_peran;
        $dev->linkedin = $request->linkedin;
        $dev->github = $request->github;
        // $dev->foto = str_replace('public/file/', 'img/developer/', $request->file('foto')->store('public/file'));

        $dev->update();

        Alert::success('Berhasil!', 'Data berhasil diubah')->showConfirmButton('Ok', '#28a745');
        // return redirect('/developer');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\developer  $developer
     * @return \Illuminate\Http\Response
     */
    
}