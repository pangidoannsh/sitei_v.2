<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\MataKuliah;
use Illuminate\Http\Request;

class MataKuliahApiController extends Controller
{
    public function matakuliah()
    {
        $mataKuliah = MataKuliah::all();

        return response()->json($mataKuliah);
    }
}