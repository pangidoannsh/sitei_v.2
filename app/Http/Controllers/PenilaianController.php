<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PenjadwalanSempro;
use App\Models\PenjadwalanSkripsi;
use Illuminate\Support\Facades\Auth;

class PenilaianController extends Controller
{
    public function index()
    {
        $dosen = PenjadwalanSempro::where('pembimbingsatu_nip', Auth::user()->nip)->where('status_seminar', 0)->orWhere('pembimbingdua_nip', Auth::user()->nip)->where('status_seminar', 0)->orWhere('pengujisatu_nip', Auth::user()->nip)->where('status_seminar', 0)->orWhere('pengujidua_nip', Auth::user()->nip)->where('status_seminar', 0)->orWhere('pengujitiga_nip', Auth::user()->nip)->where('status_seminar', 0)->get();

        $dosens = PenjadwalanSkripsi::where('pembimbingsatu_nip', Auth::user()->nip)->where('status_seminar', 0)->orWhere('pembimbingdua_nip', Auth::user()->nip)->where('status_seminar', 0)->orWhere('pengujisatu_nip', Auth::user()->nip)->where('status_seminar', 0)->orWhere('pengujidua_nip', Auth::user()->nip)->where('status_seminar', 0)->orWhere('pengujitiga_nip', Auth::user()->nip)->where('status_seminar', 0)->get();

        return view('penilaian.index', [
            'penjadwalan_sempros' => $dosen,
            'penjadwalan_skripsis' => $dosens,
        ]);
    }
}
