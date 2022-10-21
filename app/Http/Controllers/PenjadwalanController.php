<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PenjadwalanKP;
use App\Models\PenjadwalanSempro;
use App\Models\PenjadwalanSkripsi;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PenjadwalanController extends Controller
{
    public function index()
    {
        if (auth()->user()->role_id == 1) {            
            return view('penjadwalan.index', [
                'role' => Role::all(),
                'penjadwalan_kps' => PenjadwalanKP::where('status_seminar', 0)->get(),
                'penjadwalan_sempros' => PenjadwalanSempro::where('status_seminar', 0)->get(),
                'penjadwalan_skripsis' => PenjadwalanSkripsi::where('status_seminar', 0)->get(),
            ]);
        }
        if (auth()->user()->role_id == 2) {            
            return view('penjadwalan.index', [
                'role' => Role::all(),
                'penjadwalan_kps' => PenjadwalanKP::where('status_seminar', 0)->where('prodi_id', 1)->get(),
                'penjadwalan_sempros' => PenjadwalanSempro::where('status_seminar', 0)->where('prodi_id', 1)->get(),
                'penjadwalan_skripsis' => PenjadwalanSkripsi::where('status_seminar', 0)->where('prodi_id', 1)->get(),
            ]);
        }
        if (auth()->user()->role_id == 3) {            
            return view('penjadwalan.index', [
                'role' => Role::all(),
                'penjadwalan_kps' => PenjadwalanKP::where('status_seminar', 0)->where('prodi_id', 2)->get(),
                'penjadwalan_sempros' => PenjadwalanSempro::where('status_seminar', 0)->where('prodi_id', 2)->get(),
                'penjadwalan_skripsis' => PenjadwalanSkripsi::where('status_seminar', 0)->where('prodi_id', 2)->get(),
            ]);
        }
        if (auth()->user()->role_id == 4) {            
            return view('penjadwalan.index', [
                'role' => Role::all(),
                'penjadwalan_kps' => PenjadwalanKP::where('status_seminar', 0)->where('prodi_id', 3)->get(),
                'penjadwalan_sempros' => PenjadwalanSempro::where('status_seminar', 0)->where('prodi_id', 3)->get(),
                'penjadwalan_skripsis' => PenjadwalanSkripsi::where('status_seminar', 0)->where('prodi_id', 3)->get(),
            ]);
        }
    }

    public function riwayat()
    {       
        if (auth()->user()->role_id == 1) {            
            return view('penjadwalan.riwayat-penjadwalan', [
                'role' => Role::all(),
                'penjadwalan_kps' => PenjadwalanKP::where('status_seminar', 3)->get(),
                'penjadwalan_sempros' => PenjadwalanSempro::where('status_seminar', 3)->get(),
                'penjadwalan_skripsis' => PenjadwalanSkripsi::where('status_seminar', 3)->get(),
            ]);
        }
        if (auth()->user()->role_id == 2) {            
            return view('penjadwalan.riwayat-penjadwalan', [
                'role' => Role::all(),
                'penjadwalan_kps' => PenjadwalanKP::where('status_seminar', 3)->where('prodi_id', 1)->get(),
                'penjadwalan_sempros' => PenjadwalanSempro::where('status_seminar', 3)->where('prodi_id', 1)->get(),
                'penjadwalan_skripsis' => PenjadwalanSkripsi::where('status_seminar', 3)->where('prodi_id', 1)->get(),
            ]);
        }
        if (auth()->user()->role_id == 3) {            
            return view('penjadwalan.riwayat-penjadwalan', [
                'role' => Role::all(),
                'penjadwalan_kps' => PenjadwalanKP::where('status_seminar', 3)->where('prodi_id', 2)->get(),
                'penjadwalan_sempros' => PenjadwalanSempro::where('status_seminar', 3)->where('prodi_id', 2)->get(),
                'penjadwalan_skripsis' => PenjadwalanSkripsi::where('status_seminar', 3)->where('prodi_id', 2)->get(),
            ]);
        }
        if (auth()->user()->role_id == 4) {            
            return view('penjadwalan.riwayat-penjadwalan', [
                'role' => Role::all(),
                'penjadwalan_kps' => PenjadwalanKP::where('status_seminar', 3)->where('prodi_id', 3)->get(),
                'penjadwalan_sempros' => PenjadwalanSempro::where('status_seminar', 3)->where('prodi_id', 3)->get(),
                'penjadwalan_skripsis' => PenjadwalanSkripsi::where('status_seminar', 3)->where('prodi_id', 3)->get(),
            ]);
        }
    }

    public function persetujuan_koordinator()
    {       
        if (auth()->user()->role_id == 9) {            
            return view('persetujuan.persetujuan-koordinator', [
                'penjadwalan_kps' => PenjadwalanKP::where('status_seminar', 1)->where('prodi_id', 1)->get(),
                'penjadwalan_sempros' => PenjadwalanSempro::where('status_seminar', 1)->where('prodi_id', 1)->get(),
                'penjadwalan_skripsis' => PenjadwalanSkripsi::where('status_seminar', 1)->where('prodi_id', 1)->get(),
            ]);
        }
        if (auth()->user()->role_id == 10) {            
            return view('persetujuan.persetujuan-koordinator', [
                'penjadwalan_kps' => PenjadwalanKP::where('status_seminar', 1)->where('prodi_id', 2)->get(),
                'penjadwalan_sempros' => PenjadwalanSempro::where('status_seminar', 1)->where('prodi_id', 2)->get(),
                'penjadwalan_skripsis' => PenjadwalanSkripsi::where('status_seminar', 1)->where('prodi_id', 2)->get(),
            ]);
        }
        if (auth()->user()->role_id == 11) {            
            return view('persetujuan.persetujuan-koordinator', [
                'penjadwalan_kps' => PenjadwalanKP::where('status_seminar', 1)->where('prodi_id', 3)->get(),
                'penjadwalan_sempros' => PenjadwalanSempro::where('status_seminar', 1)->where('prodi_id', 3)->get(),
                'penjadwalan_skripsis' => PenjadwalanSkripsi::where('status_seminar', 1)->where('prodi_id', 3)->get(),
            ]);
        }
    }

    public function persetujuan_kaprodi()
    {       
        if (auth()->user()->role_id == 6) {            
            return view('persetujuan.persetujuan-kaprodi', [
                'penjadwalan_kps' => PenjadwalanKP::where('status_seminar', 2)->where('prodi_id', 1)->get(),
                'penjadwalan_sempros' => PenjadwalanSempro::where('status_seminar', 2)->where('prodi_id', 1)->get(),
                'penjadwalan_skripsis' => PenjadwalanSkripsi::where('status_seminar', 2)->where('prodi_id', 1)->get(),
            ]);
        }
        if (auth()->user()->role_id == 7) {            
            return view('persetujuan.persetujuan-kaprodi', [
                'penjadwalan_kps' => PenjadwalanKP::where('status_seminar', 2)->where('prodi_id', 2)->get(),
                'penjadwalan_sempros' => PenjadwalanSempro::where('status_seminar', 2)->where('prodi_id', 2)->get(),
                'penjadwalan_skripsis' => PenjadwalanSkripsi::where('status_seminar', 2)->where('prodi_id', 2)->get(),
            ]);
        }
        if (auth()->user()->role_id == 8) {            
            return view('persetujuan.persetujuan-kaprodi', [
                'penjadwalan_kps' => PenjadwalanKP::where('status_seminar', 2)->where('prodi_id', 3)->get(),
                'penjadwalan_sempros' => PenjadwalanSempro::where('status_seminar', 2)->where('prodi_id', 3)->get(),
                'penjadwalan_skripsis' => PenjadwalanSkripsi::where('status_seminar', 2)->where('prodi_id', 3)->get(),
            ]);
        }
    }

    public function riwayat_mahasiswa()
    {       
        return view('penjadwalan.riwayat-mahasiswa', [
            'penjadwalan_kps' => PenjadwalanKP::where('status_seminar', 3)->where('mahasiswa_nim', Auth::user()->nim)->get(),
            'penjadwalan_sempros' => PenjadwalanSempro::where('status_seminar', 3)->where('mahasiswa_nim', Auth::user()->nim)->get(),
        ]);
    }

    public function riwayat_koordinator()
    {       
        if (auth()->user()->role_id == 9) {            
            return view('persetujuan.riwayat-koordinator', [
                'penjadwalan_kps' => PenjadwalanKP::where('status_seminar', 3)->where('prodi_id', 1)->get(),
                'penjadwalan_sempros' => PenjadwalanSempro::where('status_seminar', 3)->where('prodi_id', 1)->get(),
                'penjadwalan_skripsis' => PenjadwalanSkripsi::where('status_seminar', 3)->where('prodi_id', 1)->get(),
            ]);
        }
        if (auth()->user()->role_id == 10) {            
            return view('persetujuan.riwayat-koordinator', [
                'penjadwalan_kps' => PenjadwalanKP::where('status_seminar', 3)->where('prodi_id', 2)->get(),
                'penjadwalan_sempros' => PenjadwalanSempro::where('status_seminar', 3)->where('prodi_id', 2)->get(),
                'penjadwalan_skripsis' => PenjadwalanSkripsi::where('status_seminar', 3)->where('prodi_id', 2)->get(),
            ]);
        }
        if (auth()->user()->role_id == 11) {            
            return view('persetujuan.riwayat-koordinator', [
                'penjadwalan_kps' => PenjadwalanKP::where('status_seminar', 3)->where('prodi_id', 3)->get(),
                'penjadwalan_sempros' => PenjadwalanSempro::where('status_seminar', 3)->where('prodi_id', 3)->get(),
                'penjadwalan_skripsis' => PenjadwalanSkripsi::where('status_seminar', 3)->where('prodi_id', 3)->get(),
            ]);
        }
    }

    public function riwayat_kaprodi()
    {       
        if (auth()->user()->role_id == 6) {            
            return view('persetujuan.riwayat-kaprodi', [
                'penjadwalan_kps' => PenjadwalanKP::where('status_seminar', 3)->where('prodi_id', 1)->get(),
                'penjadwalan_sempros' => PenjadwalanSempro::where('status_seminar', 3)->where('prodi_id', 1)->get(),
                'penjadwalan_skripsis' => PenjadwalanSkripsi::where('status_seminar', 3)->where('prodi_id', 1)->get(),
            ]);
        }
        if (auth()->user()->role_id == 7) {            
            return view('persetujuan.riwayat-kaprodi', [
                'penjadwalan_kps' => PenjadwalanKP::where('status_seminar', 3)->where('prodi_id', 2)->get(),
                'penjadwalan_sempros' => PenjadwalanSempro::where('status_seminar', 3)->where('prodi_id', 2)->get(),
                'penjadwalan_skripsis' => PenjadwalanSkripsi::where('status_seminar', 3)->where('prodi_id', 2)->get(),
            ]);
        }
        if (auth()->user()->role_id == 8) {            
            return view('persetujuan.riwayat-kaprodi', [
                'penjadwalan_kps' => PenjadwalanKP::where('status_seminar', 3)->where('prodi_id', 3)->get(),
                'penjadwalan_sempros' => PenjadwalanSempro::where('status_seminar', 3)->where('prodi_id', 3)->get(),
                'penjadwalan_skripsis' => PenjadwalanSkripsi::where('status_seminar', 3)->where('prodi_id', 3)->get(),
            ]);
        }
    }
}
