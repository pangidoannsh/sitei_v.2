<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PenjadwalanKP;
use App\Models\PenjadwalanSempro;
use App\Models\PenjadwalanSkripsi;
use Illuminate\Support\Facades\Auth;

class PenilaianController extends Controller
{
    public function index()
    {        
        
        $dosen = PenjadwalanSempro::where('pembimbingsatu_nip', Auth::user()->nip)->where('status_seminar', 0)->
        orWhere('pembimbingdua_nip', Auth::user()->nip)->where('status_seminar', 0)->
        orWhere('pengujisatu_nip', Auth::user()->nip)->where('status_seminar', 0)->
        orWhere('pengujidua_nip', Auth::user()->nip)->where('status_seminar', 0)->
        orWhere('pengujitiga_nip', Auth::user()->nip)->where('status_seminar', 0)->get();

        $dosens = PenjadwalanSkripsi::where('pembimbingsatu_nip', Auth::user()->nip)->where('status_seminar', 0)->
        orWhere('pembimbingdua_nip', Auth::user()->nip)->where('status_seminar', 0)->
        orWhere('pengujisatu_nip', Auth::user()->nip)->where('status_seminar', 0)->
        orWhere('pengujidua_nip', Auth::user()->nip)->where('status_seminar', 0)->
        orWhere('pengujitiga_nip', Auth::user()->nip)->where('status_seminar', 0)->get();

        $dosenss = PenjadwalanKP::where('penguji_nip', Auth::user()->nip)->where('status_seminar', 0)->
        orWhere('pembimbing_nip', Auth::user()->nip)->where('status_seminar', 0)->get();

        return view('penilaian.index', [
            'penjadwalan_sempros' => $dosen,
            'penjadwalan_skripsis' => $dosens,
            'penjadwalan_kps' => $dosenss,
        ]);
    }

    public function riwayat()
    {
        $riwayat = PenjadwalanSempro::where('pembimbingsatu_nip', Auth::user()->nip)->where('status_seminar', 1)->orWhere('pembimbingdua_nip', Auth::user()->nip)->where('status_seminar', 1)->orWhere('pengujisatu_nip', Auth::user()->nip)->where('status_seminar', 1)->orWhere('pengujidua_nip', Auth::user()->nip)->where('status_seminar', 1)->orWhere('pengujitiga_nip', Auth::user()->nip)->where('status_seminar', 1)->get();        

        $riwayatt = PenjadwalanSkripsi::where('pembimbingsatu_nip', Auth::user()->nip)->where('status_seminar', 3)->orWhere('pembimbingdua_nip', Auth::user()->nip)->where('status_seminar', 3)->orWhere('pengujisatu_nip', Auth::user()->nip)->where('status_seminar', 3)->orWhere('pengujidua_nip', Auth::user()->nip)->where('status_seminar', 3)->orWhere('pengujitiga_nip', Auth::user()->nip)->where('status_seminar', 3)->get();

        $draf = PenjadwalanSkripsi::where('pengujisatu_nip', Auth::user()->nip)->where('status_seminar', 1)->get();

        $draff = PenjadwalanSkripsi::where('pengujisatu_nip', Auth::user()->nip)->where('status_seminar', 2)->get();

        $riwayattt = PenjadwalanKP::where('penguji_nip', Auth::user()->nip)->where('status_seminar', 1)->orWhere('pembimbing_nip', Auth::user()->nip)->where('status_seminar', 1)->get();

        return view('penilaian.riwayat-penilaian', [
            'penjadwalan_sempros' => $riwayat,
            'penjadwalan_skripsis' => $riwayatt,
            'penjadwalan_skripsis_draf' => $draf,
            'penjadwalan_skripsis_draff' => $draff,
            'penjadwalan_kps' => $riwayattt,
        ]);
    }
}
