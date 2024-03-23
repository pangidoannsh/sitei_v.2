<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MataKuliah; // Sesuaikan namespace model MataKuliah jika diperlukan

class LocationApiController extends Controller
{
    public function getLocationByRuanganId($ruangan_id)
    {
        // Mendapatkan informasi lokasi berdasarkan ruangan_id dari tabel mata_kuliah
        $mataKuliah = MataKuliah::where('ruangan_id', $ruangan_id)->first();

        // Jika ditemukan mata kuliah dengan ruangan_id tersebut, dapatkan informasi lokasi dari tabel locations
        if ($mataKuliah) {
            $ruangan = $mataKuliah->ruangan; // Pastikan relasi antara MataKuliah dan Location didefinisikan dengan benar
            if ($ruangan) {
                $latitude = $ruangan->latitude;
                $longitude = $ruangan->longitude;
                return response()->json(['latitude' => $latitude, 'longitude' => $longitude]);
            } else {
                return response()->json(['error' => 'Informasi lokasi tidak ditemukan'], 404);
            }
        } else {
            return response()->json(['error' => 'Mata kuliah dengan ruangan tersebut tidak ditemukan'], 404);
        }
    }
}
