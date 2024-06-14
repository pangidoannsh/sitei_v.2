<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\PendaftaranMataKuliah;
use Illuminate\Http\Request;

class PendaftaranMataKuliahApiController extends Controller
{
    public function daftarmatkul(Request $request)
    {
        $request->validate([
            'mahasiswa_id' => ['required', 'exists:mahasiswa,id'],
            'mata_kuliah_id' => ['required', 'exists:mata_kuliah,id',]
        ]);

        $pendaftaran = PendaftaranMataKuliah::create([
            'mahasiswa_id' => $request->input('mahasiswa_id'),
            'mata_kuliah_id' => $request->input('mata_kuliah_id'),
        ]);

        return response([
            'error' => false,
            'message' => 'berhasil memilih mata kuliah',
            'pendagtaran' => $pendaftaran
        ], 200);
    }


    public function mataKuliahMahasiswa($mahasiswaId)
    {
        $mataKuliahMahasiswa = PendaftaranMataKuliah::where('mahasiswa_id', $mahasiswaId)
            ->with('mataKuliah')
            ->get();

        return response()->json($mataKuliahMahasiswa);
    }
}