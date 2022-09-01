<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PenjadwalanKP;
use App\Models\PenjadwalanSempro;
use App\Models\PenjadwalanSkripsi;

class PenjadwalanController extends Controller
{
    public function index()
    {
        if (auth()->user()->role_id == 2) {            
            return view('penjadwalan.index', [
                'penjadwalan_kps' => PenjadwalanKP::where('status_seminar', 0)->where('prodi_id', 1)->get(),
                'penjadwalan_sempros' => PenjadwalanSempro::where('status_seminar', 0)->where('prodi_id', 1)->get(),
                'penjadwalan_skripsis' => PenjadwalanSkripsi::where('status_seminar', 0)->where('prodi_id', 1)->get(),
            ]);
        }
        if (auth()->user()->role_id == 3) {            
            return view('penjadwalan.index', [
                'penjadwalan_kps' => PenjadwalanKP::where('status_seminar', 0)->where('prodi_id', 2)->get(),
                'penjadwalan_sempros' => PenjadwalanSempro::where('status_seminar', 0)->where('prodi_id', 2)->get(),
                'penjadwalan_skripsis' => PenjadwalanSkripsi::where('status_seminar', 0)->where('prodi_id', 2)->get(),
            ]);
        }
        if (auth()->user()->role_id == 4) {            
            return view('penjadwalan.index', [
                'penjadwalan_kps' => PenjadwalanKP::where('status_seminar', 0)->where('prodi_id', 3)->get(),
                'penjadwalan_sempros' => PenjadwalanSempro::where('status_seminar', 0)->where('prodi_id', 3)->get(),
                'penjadwalan_skripsis' => PenjadwalanSkripsi::where('status_seminar', 0)->where('prodi_id', 3)->get(),
            ]);
        }
    }

    public function riwayat()
    {       
        if (auth()->user()->role_id == 2) {            
            return view('penjadwalan.riwayat-penjadwalan', [
                'penjadwalan_kps' => PenjadwalanKP::where('status_seminar', 1)->where('prodi_id', 1)->get(),
                'penjadwalan_sempros' => PenjadwalanSempro::where('status_seminar', 1)->where('prodi_id', 1)->get(),
                'penjadwalan_skripsis' => PenjadwalanSkripsi::where('status_seminar', 1)->where('prodi_id', 1)->get(),
            ]);
        }
        if (auth()->user()->role_id == 3) {            
            return view('penjadwalan.riwayat-penjadwalan', [
                'penjadwalan_kps' => PenjadwalanKP::where('status_seminar', 1)->where('prodi_id', 2)->get(),
                'penjadwalan_sempros' => PenjadwalanSempro::where('status_seminar', 1)->where('prodi_id', 2)->get(),
                'penjadwalan_skripsis' => PenjadwalanSkripsi::where('status_seminar', 1)->where('prodi_id', 2)->get(),
            ]);
        }
        if (auth()->user()->role_id == 4) {            
            return view('penjadwalan.riwayat-penjadwalan', [
                'penjadwalan_kps' => PenjadwalanKP::where('status_seminar', 1)->where('prodi_id', 3)->get(),
                'penjadwalan_sempros' => PenjadwalanSempro::where('status_seminar', 1)->where('prodi_id', 3)->get(),
                'penjadwalan_skripsis' => PenjadwalanSkripsi::where('status_seminar', 1)->where('prodi_id', 3)->get(),
            ]);
        }
    }
}
