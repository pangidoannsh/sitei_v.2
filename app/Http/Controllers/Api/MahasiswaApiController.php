<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Konsentrasi;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class MahasiswaApiController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $mahasiswa = Mahasiswa::all();

        return response()->json([
            'status' => true,
            'message' => 'Data ditemukan',
            'mahasiswa' => $mahasiswa
        ], 200);
        // return response()->json($mahasiswa, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *

     */
    public function store(Request $request)
    {
        $request->validate([
            'prodi_id' => ['required'],
            'nim' => ['required', 'unique:mahasiswa'],
            'password' => ['required', 'min:3', 'max:255'],
            'nama' => ['required'],
            'email' => ['required', 'unique:mahasiswa', 'email'],
            'angkatan' => ['required'],
        ]);

        $mahasiswa = Mahasiswa::create([
            'prodi_id' => $request->prodi_id,
            'nim' => $request->nim,
            'password' => bcrypt($request->password),
            'nama' => $request->nama,
            'email' => $request->email,
            'angkatan' => $request->angkatan,
        ]);

        return response()->json($mahasiswa, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.

     */
    public function show($id)
    {
        $mahasiswa = Mahasiswa::find($id);

        if (!$mahasiswa) {
            return response()->json(['message' => 'Mahasiswa not found'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($mahasiswa, Response::HTTP_OK);
    }

    public function getUserDetails(Request $request)
    {
        $mahasiswa = Auth::user();

        if (!$mahasiswa) {
            return response()->json(['message' => 'Mahasiswa not found'], Response::HTTP_NOT_FOUND);
        }

        // Access program studi name based on prodi_id
        $prodi = Prodi::find($mahasiswa->prodi_id);
        $prodiName = $prodi ? $prodi->nama_prodi : null;
        $konsentrasi = Konsentrasi::find($mahasiswa->konsentrasi_id);
        $konsentrasiName = $konsentrasi ? $konsentrasi->nama_konsentrasi : null;

        return response()->json([
            'error' => false,
            'message' => 'Mahasiswa found',
            'profilMahasiswa' => [
                'id' => $mahasiswa->id,
                'role_id' => $mahasiswa->role_id,
                'prodi_id' => $mahasiswa->prodi_id,
                'konsentrasi_id' => $mahasiswa->konsentrasi_id,
                'nim' => $mahasiswa->nim,
                'nama' => $mahasiswa->nama,
                'angkatan' => $mahasiswa->angkatan,
                'email' => $mahasiswa->email,
                'created_at' => $mahasiswa->created_at,
                'updated_at' => $mahasiswa->updated_at,
                'nama_prodi' => $prodiName,
                'nama_konsentrasi' => $konsentrasiName,
            ],
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::find($id);

        if (!$mahasiswa) {
            return response()->json(['message' => 'Mahasiswa not found'], Response::HTTP_NOT_FOUND);
        }

        $request->validate([
            'prodi_id' => ['required'],
            'nama' => ['required'],
            'angkatan' => ['required'],
        ]);

        $mahasiswa->update($request->all());

        return response()->json($mahasiswa, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *

     */
    public function destroy($id)
    {
         $mahasiswa = Mahasiswa::find($id);

        if (!$mahasiswa) {
            return response()->json(['message' => 'Mahasiswa not found'], Response::HTTP_NOT_FOUND);
        }

        $mahasiswa->delete();

        return response()->json(['message' => 'Mahasiswa deleted successfully'], Response::HTTP_OK);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'prodi_id' => ['required'],
            'nim' => ['required', 'unique:mahasiswa'],
            'password' => ['required', 'min:3', 'max:255'],
            'nama' => ['required'],
            'email' => ['required', 'unique:mahasiswa', 'email'],
            'angkatan' => ['required'],
        ]
    );

        if ($validator->fails()) 
        {
            return response()->json(['status' => false, 'message' => $validator->errors()], 400);
        }

        $mahasiswa = Mahasiswa::create([
            'prodi_id' => $request->prodi_id,
            'nim' => $request->nim,
            'password' => Hash::make($request->password),
            'nama' => $request->nama,
            'email' => $request->email,
            'angkatan' => $request->angkatan,
        ]);

        return response()->json(['status' => true, 'message' => 'Registrasi berhasil', 'mahasiswa' => $mahasiswa], 201);
        
    }

    // public function login(Request $request){

    //     $validator = Validator::make($request->all(), [
    //         'nim' => ['required'],
    //         'password' => ['required'],
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json(['error' => true, 'message' => $validator->errors()], 400);
    //     }

    //     $mahasiswa = Mahasiswa::where('nim', $request->nim)->first();
    //     $token = $mahasiswa->createToken('authToken')->plainTextToken;

    //     if(!$mahasiswa || !Hash::check($request->password, $mahasiswa->password)){
    //         return response([
    //             'error' => true,
    //             'message' => 'Login gagal. Nim atau password salah.',
    //         ], 401);
    //     } else{
    //         return response(['error' => false,
    //         'message' => 'Login berhasil',
    //         'data' => [
    //             'token' => $token,
    //             'id' => $mahasiswa->id,
    //             'role_id' => $mahasiswa->role_id,
    //             'prodi_id' => $mahasiswa->prodi_id,
    //             'konsentrasi_id' => $mahasiswa->konsentrasi_id,
    //             'nim' => $mahasiswa->nim,
    //             'nama' => $mahasiswa->nama,
    //             'angkatan' => $mahasiswa->angkatan,
    //             'email' => $mahasiswa->email,
    //             'created_at' => $mahasiswa->created_at,
    //             'updated_at' => $mahasiswa->updated_at,
    //         ],
    //     ], 200);
    //     }
    // }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nim' => ['required'],
            'password' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => true, 'message' => 'NIM atau password harus diisi.'], 400);
        }

        $mahasiswa = Mahasiswa::where('nim', $request->nim)->first();

        if (!$mahasiswa || !Hash::check($request->password, $mahasiswa->password)) {
            return response([
                'error' => true,
                'message' => 'Login gagal. Nim atau password salah.',
            ], 401);
        }

        // Generate and return auth token
        $token = $mahasiswa->createToken('authToken')->plainTextToken;

        return response([
            'error' => false,
            'message' => 'Login berhasil',
            'data' => [
                'token' => $token,
                'id' => $mahasiswa->id,
                'role_id' => $mahasiswa->role_id,
                'prodi_id' => $mahasiswa->prodi_id,
                'konsentrasi_id' => $mahasiswa->konsentrasi_id,
                'nim' => $mahasiswa->nim,
                'nama' => $mahasiswa->nama,
                'angkatan' => $mahasiswa->angkatan,
                'email' => $mahasiswa->email,
                'created_at' => $mahasiswa->created_at,
                'updated_at' => $mahasiswa->updated_at,
            ],
        ], 200);
    }

    public function searchMahasiswa(Request $request)
    {
        $query = $request->input('q');
        $mahasiswa = Mahasiswa::where('nama', 'like', '%' . $query . '%')->get();
        $results = [];

        foreach ($mahasiswa as $mhs) {
            $results[] = [
                'id' => $mhs->id,
                'text' => $mhs->nama,
                'nim' => $mhs->nim,
            ];
        }
        return response()->json($results);
    }

}
