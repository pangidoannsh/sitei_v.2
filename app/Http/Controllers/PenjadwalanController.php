<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\PendaftaranKP;
use App\Models\PenjadwalanKP;
use App\Models\PenjadwalanSempro;
use App\Models\PendaftaranSkripsi;
use App\Models\PenjadwalanSkripsi;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PenjadwalanController extends Controller
{
    public function index()
    {
        

        if (auth()->user()->role_id == 1) {            
            return view('penjadwalan.index', [
                'role' => Role::all(),
                'penjadwalan_kps' => PenjadwalanKP::where('status_seminar', '0')->orWhere('tanggal', NULL)->orderBy('tanggal', 'ASC')->get(),
                'penjadwalan_sempros' => PenjadwalanSempro::where('status_seminar', '0')->orWhere('tanggal', NULL)->orderBy('tanggal', 'ASC')->get(),
                'penjadwalan_skripsis' => PenjadwalanSkripsi::where('status_seminar', '0')->orderBy('tanggal', 'ASC')->get(),
                // 'penjadwalan_skripsis' => PenjadwalanSkripsi::where('tanggal', '>=', Carbon::today())->orWhere('tanggal', NULL)->orderBy('tanggal', 'ASC')->get(),

                //JUMLAH SEMINAR
                'jml_seminar_kp' => PenjadwalanKP::where('status_seminar', '0')->count(),
                'jml_sempro' => PenjadwalanSempro::where('status_seminar', '0')->count(),
                'jml_sidang' => PenjadwalanSkripsi::where('status_seminar', '0')->count(),

                //JUMLAH RIWAYAT SEMINAR
                'jml_riwayat_seminar_kp' => PenjadwalanKP::where('status_seminar', '1')->count(),
                'jml_riwayat_sempro' => PenjadwalanSempro::where('status_seminar', '1')->count(),
                'jml_riwayat_sidang' => PenjadwalanSkripsi::where('status_seminar', '3')->count(),
                
            ]);
        }
        if (auth()->user()->role_id == 2) {            
            return view('penjadwalan.index', [
                'role' => Role::all(),
                
                'penjadwalan_kps' => PenjadwalanKP::where('status_seminar', '0')->where('prodi_id', 1)->orderBy('tanggal', 'ASC')->get(),

                'penjadwalan_sempros' => PenjadwalanSempro::where('status_seminar', '0')->where('prodi_id', 1)->orderBy('tanggal', 'ASC')->get(),

                'penjadwalan_skripsis' => PenjadwalanSkripsi::where('status_seminar', '0')->where('prodi_id', 1)->orderBy('tanggal', 'ASC')->get(),
                
                //JUMLAH SEMINAR
                'jml_seminar_kp' => PenjadwalanKP::where('status_seminar', '0')->where('prodi_id', 1)->count(),
                'jml_sempro' => PenjadwalanSempro::where('status_seminar', '0')->where('prodi_id', 1)->count(),
                'jml_sidang' => PenjadwalanSkripsi::where('status_seminar', '0')->where('prodi_id', 1)->count(),

                //JUMLAH RIWAYAT SEMINAR
                'jml_riwayat_seminar_kp' => PenjadwalanKP::where('status_seminar', '1')->where('prodi_id', 1)->count(),
                'jml_riwayat_sempro' => PenjadwalanSempro::where('status_seminar', '1')->where('prodi_id', 1)->count(),
                'jml_riwayat_sidang' => PenjadwalanSkripsi::where('status_seminar', '3')->where('prodi_id', 1)->count(),

            ]);
        }
        if (auth()->user()->role_id == 3) {            
            return view('penjadwalan.index', [
                'role' => Role::all(),
                
                'penjadwalan_kps' => PenjadwalanKP::where('status_seminar', '0')->where('prodi_id', 2)->orderBy('tanggal', 'ASC')->get(),

                'penjadwalan_sempros' => PenjadwalanSempro::where('status_seminar', '0')->where('prodi_id', 2)->orderBy('tanggal', 'ASC')->get(),

                'penjadwalan_skripsis' => PenjadwalanSkripsi::where('status_seminar', '0')->where('prodi_id', 2)->orderBy('tanggal', 'ASC')->get(),
                
                //JUMLAH SEMINAR
                'jml_seminar_kp' => PenjadwalanKP::where('status_seminar', '0')->where('prodi_id', 2)->count(),
                'jml_sempro' => PenjadwalanSempro::where('status_seminar', '0')->where('prodi_id', 2)->count(),
                'jml_sidang' => PenjadwalanSkripsi::where('status_seminar', '0')->where('prodi_id', 2)->count(),

                //JUMLAH RIWAYAT SEMINAR
                'jml_riwayat_seminar_kp' => PenjadwalanKP::where('status_seminar', '1')->where('prodi_id', 2)->count(),
                'jml_riwayat_sempro' => PenjadwalanSempro::where('status_seminar', '1')->where('prodi_id', 2)->count(),
                'jml_riwayat_sidang' => PenjadwalanSkripsi::where('status_seminar', '3')->where('prodi_id', 2)->count(),
            ]);
        }
        if (auth()->user()->role_id == 4) {   
        
            return view('penjadwalan.index', [
                'role' => Role::all(),
                
                'penjadwalan_kps' => PenjadwalanKP::where('status_seminar', '0')->where('prodi_id', 3)->orderBy('tanggal', 'ASC')->get(),

                'penjadwalan_sempros' => PenjadwalanSempro::where('status_seminar', '0')->where('prodi_id', 3)->orderBy('tanggal', 'ASC')->get(),

                'penjadwalan_skripsis' => PenjadwalanSkripsi::where('status_seminar', '0')->where('prodi_id', 3)->orderBy('tanggal', 'ASC')->get(),
                
                //JUMLAH SEMINAR
                'jml_seminar_kp' => PenjadwalanKP::where('status_seminar', '0')->where('prodi_id', 3)->count(),
                'jml_sempro' => PenjadwalanSempro::where('status_seminar', '0')->where('prodi_id', 3)->count(),
                'jml_sidang' => PenjadwalanSkripsi::where('status_seminar', '0')->where('prodi_id', 3)->count(),

                //JUMLAH RIWAYAT SEMINAR
                'jml_riwayat_seminar_kp' => PenjadwalanKP::where('status_seminar', '1')->where('prodi_id', 3)->count(),
                'jml_riwayat_sempro' => PenjadwalanSempro::where('status_seminar', '1')->where('prodi_id', 3)->count(),
                'jml_riwayat_sidang' => PenjadwalanSkripsi::where('status_seminar', '3')->where('prodi_id', 3)->count(),
                
                //JUMLAH RIWAYAT SEMINAR
                'jml_menunggu_seminar_kp' => PenjadwalanKP::where('waktu', null)->where('prodi_id', 3)->count(),
                'jml_menunggu_sempro' => PenjadwalanSempro::where('waktu', null)->where('prodi_id', 3)->count(),
                'jml_menunggu_sidang' => PenjadwalanSkripsi::where('waktu', null)->where('prodi_id', 3)->count(),

            ]);
        }
    }

    public function riwayat()
    {       
        if (auth()->user()->role_id == 1) {            
            return view('penjadwalan.riwayat-penjadwalan', [
                'role' => Role::all(),
                'penjadwalan_kps' => PenjadwalanKP::where('status_seminar', '1')->get(),
                'penjadwalan_sempros' => PenjadwalanSempro::where('status_seminar', '1')->get(),
                'penjadwalan_skripsis' => PenjadwalanSkripsi::where('status_seminar', '3')->get(),

                //JUMLAH SEMINAR
                'jml_seminar_kp' => PenjadwalanKP::where('status_seminar', '0')->count(),
                'jml_sempro' => PenjadwalanSempro::where('status_seminar', '0')->count(),
                'jml_sidang' => PenjadwalanSkripsi::where('status_seminar', '0')->count(),

                //JUMLAH RIWAYAT SEMINAR
                'jml_riwayat_seminar_kp' => PenjadwalanKP::where('status_seminar', '1')->count(),
                'jml_riwayat_sempro' => PenjadwalanSempro::where('status_seminar', '1')->count(),
                'jml_riwayat_sidang' => PenjadwalanSkripsi::where('status_seminar', '3')->count(),
            ]);
        }
        if (auth()->user()->role_id == 2) {            
            return view('penjadwalan.riwayat-penjadwalan', [
                'role' => Role::all(),
                'penjadwalan_kps' => PenjadwalanKP::where('status_seminar', '1')->where('prodi_id', 1)->get(),
                'penjadwalan_sempros' => PenjadwalanSempro::where('status_seminar', '1')->where('prodi_id', 1)->get(),
                'penjadwalan_skripsis' => PenjadwalanSkripsi::where('status_seminar', '3')->where('prodi_id', 1)->get(),

                //JUMLAH SEMINAR
                'jml_seminar_kp' => PenjadwalanKP::where('status_seminar', '0')->where('prodi_id', 1)->count(),
                'jml_sempro' => PenjadwalanSempro::where('status_seminar', '0')->where('prodi_id', 1)->count(),
                'jml_sidang' => PenjadwalanSkripsi::where('status_seminar', '0')->where('prodi_id', 1)->count(),

                //JUMLAH RIWAYAT SEMINAR
                'jml_riwayat_seminar_kp' => PenjadwalanKP::where('status_seminar', '1')->where('prodi_id', 1)->count(),
                'jml_riwayat_sempro' => PenjadwalanSempro::where('status_seminar', '1')->where('prodi_id', 1)->count(),
                'jml_riwayat_sidang' => PenjadwalanSkripsi::where('status_seminar', '3')->where('prodi_id', 1)->count(),
            ]);
        }
        if (auth()->user()->role_id == 3) {            
            return view('penjadwalan.riwayat-penjadwalan', [
                'role' => Role::all(),
                'penjadwalan_kps' => PenjadwalanKP::where('status_seminar', '1')->where('prodi_id', 2)->get(),
                'penjadwalan_sempros' => PenjadwalanSempro::where('status_seminar', '1')->where('prodi_id', 2)->get(),
                'penjadwalan_skripsis' => PenjadwalanSkripsi::where('status_seminar', '3')->where('prodi_id', 2)->get(),

                //JUMLAH SEMINAR
                'jml_seminar_kp' => PenjadwalanKP::where('status_seminar', '0')->where('prodi_id', 2)->count(),
                'jml_sempro' => PenjadwalanSempro::where('status_seminar', '0')->where('prodi_id', 2)->count(),
                'jml_sidang' => PenjadwalanSkripsi::where('status_seminar', '0')->where('prodi_id', 2)->count(),

                //JUMLAH RIWAYAT SEMINAR
                'jml_riwayat_seminar_kp' => PenjadwalanKP::where('status_seminar', '1')->where('prodi_id', 2)->count(),
                'jml_riwayat_sempro' => PenjadwalanSempro::where('status_seminar', '1')->where('prodi_id', 2)->count(),
                'jml_riwayat_sidang' => PenjadwalanSkripsi::where('status_seminar', '3')->where('prodi_id', 2)->count(),
            ]);
        }
        if (auth()->user()->role_id == 4) {            
            return view('penjadwalan.riwayat-penjadwalan', [
                'role' => Role::all(),
                'penjadwalan_kps' => PenjadwalanKP::where('status_seminar', '1')->where('prodi_id', 3)->get(),
                'penjadwalan_sempros' => PenjadwalanSempro::where('status_seminar', '1')->where('prodi_id', 3)->get(),
                'penjadwalan_skripsis' => PenjadwalanSkripsi::where('status_seminar', '3')->where('prodi_id', 3)->get(),

                //JUMLAH SEMINAR
                'jml_seminar_kp' => PenjadwalanKP::where('status_seminar', '0')->where('prodi_id', 3)->count(),
                'jml_sempro' => PenjadwalanSempro::where('status_seminar', '0')->where('prodi_id', 3)->count(),
                'jml_sidang' => PenjadwalanSkripsi::where('status_seminar', '0')->where('prodi_id', 3)->count(),

                //JUMLAH RIWAYAT SEMINAR
                'jml_riwayat_seminar_kp' => PenjadwalanKP::where('status_seminar', '1')->where('prodi_id', 3)->count(),
                'jml_riwayat_sempro' => PenjadwalanSempro::where('status_seminar', '1')->where('prodi_id', 3)->count(),
                'jml_riwayat_sidang' => PenjadwalanSkripsi::where('status_seminar', '3')->where('prodi_id', 3)->count(),
            ]);
        }
    }    

    public function persetujuan_koordinator()
    {       
        if (auth()->user()->role_id == 9) {            
            return view('persetujuan.persetujuan-koordinator', [                    
                'penjadwalan_skripsis' => PenjadwalanSkripsi::where('status_seminar', 1)->where('prodi_id', 1)->get(),
            ]);
        }
        if (auth()->user()->role_id == 10) {            
            return view('persetujuan.persetujuan-koordinator', [                
                'penjadwalan_skripsis' => PenjadwalanSkripsi::where('status_seminar', 1)->where('prodi_id', 2)->get(),
            ]);
        }
        if (auth()->user()->role_id == 11) {            
            return view('persetujuan.persetujuan-koordinator', [                
                'penjadwalan_skripsis' => PenjadwalanSkripsi::where('status_seminar', 1)->where('prodi_id', 3)->get(),
            ]);
        }
    }

    public function detail_persetujuan_koordinator($id)
    {       
        if (auth()->user()->role_id == 9) {            
            return view('persetujuan.detail-persetujuan-koordinator', [                    
                'penjadwalan_skripsis' => PenjadwalanSkripsi::where('id', $id)->where('status_seminar', 1)->where('prodi_id', 1)->get(),
            ]);
        }
        if (auth()->user()->role_id == 10) {            
            return view('persetujuan.detail-persetujuan-koordinator', [                
                'penjadwalan_skripsis' => PenjadwalanSkripsi::where('id', $id)->where('status_seminar', 1)->where('prodi_id', 2)->get(),
            ]);
        }
        if (auth()->user()->role_id == 11) {            
            return view('persetujuan.detail-persetujuan-koordinator', [                
                'penjadwalan_skripsis' => PenjadwalanSkripsi::where('id', $id)->where('status_seminar', 1)->where('prodi_id', 3)->get(),
            ]);
        }
    }
    public function detail_persetujuan_kaprodi($id)
    {       
        if (auth()->user()->role_id == 6) {            
            return view('persetujuan.detail-persetujuan-kaprodi', [                    
                'penjadwalan_skripsis' => PenjadwalanSkripsi::where('id', $id)->where('status_seminar', 2)->where('prodi_id', 1)->get(),
            ]);
        }
        if (auth()->user()->role_id == 7) {            
            return view('persetujuan.detail-persetujuan-kaprodi', [                
                'penjadwalan_skripsis' => PenjadwalanSkripsi::where('id', $id)->where('status_seminar', 2)->where('prodi_id', 2)->get(),
            ]);
        }
        if (auth()->user()->role_id == 8) {            
            return view('persetujuan.detail-persetujuan-kaprodi', [                
                'penjadwalan_skripsis' => PenjadwalanSkripsi::where('id', $id)->where('status_seminar', 2)->where('prodi_id', 3)->get(),
            ]);
        }
    }


    public function persetujuan_kaprodi()
    {       
        if (auth()->user()->role_id == 6) {            
            return view('persetujuan.persetujuan-kaprodi', [                
                'penjadwalan_skripsis' => PenjadwalanSkripsi::where('status_seminar', 2)->where('prodi_id', 1)->get(),
            ]);
        }
        if (auth()->user()->role_id == 7) {            
            return view('persetujuan.persetujuan-kaprodi', [                
                'penjadwalan_skripsis' => PenjadwalanSkripsi::where('status_seminar', 2)->where('prodi_id', 2)->get(),
            ]);
        }
        if (auth()->user()->role_id == 8) {            
            return view('persetujuan.persetujuan-kaprodi', [                
                'penjadwalan_skripsis' => PenjadwalanSkripsi::where('status_seminar', 2)->where('prodi_id', 3)->get(),
            ]);
        }
    }

    public function jadwal_mahasiswa()
    {       
        return view('penjadwalan.jadwal-mahasiswa', [
            'penjadwalan_kps' => PenjadwalanKP::where('status_seminar', 0)->where('mahasiswa_nim', Auth::user()->nim)->get(),
            'penjadwalan_sempros' => PenjadwalanSempro::where('status_seminar', 0)->where('mahasiswa_nim', Auth::user()->nim)->get(),
            'penjadwalan_skripsis' => PenjadwalanSkripsi::where('status_seminar', 0)->where('mahasiswa_nim', Auth::user()->nim)->get(),
        ]);
    }

    public function riwayat_mahasiswa()
    {       
        return view('penjadwalan.riwayat-mahasiswa', [
            'penjadwalan_kps' => PenjadwalanKP::where('status_seminar', 1)->where('mahasiswa_nim', Auth::user()->nim)->get(),
            'penjadwalan_sempros' => PenjadwalanSempro::where('status_seminar', 1)->where('mahasiswa_nim', Auth::user()->nim)->get(),
            'penjadwalan_skripsis' => PenjadwalanSkripsi::where('status_seminar', 3)->where('mahasiswa_nim', Auth::user()->nim)->get(),
        ]);
    }

    public function riwayat_koordinator()
    {       
        if (auth()->user()->role_id == 9) {            
            return view('persetujuan.riwayat-koordinator', [                
                'penjadwalan_skripsis' => PenjadwalanSkripsi::where('status_seminar', 3)->where('prodi_id', 1)->get(),

                //JUMLAH PERSETUJUAN KP
                'jml_persetujuan_kp' => PendaftaranKP::where('prodi_id', '1')->where('keterangan', 'Menunggu persetujuan Koordinator KP')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing')
                ->orderBy('status_kp', 'desc')->count(),
                //JUMLAH PERSETUJUAN SKRIPSI
                 'jml_persetujuan_skripsi' => PendaftaranSkripsi::where('prodi_id', '1')->where('keterangan', 'Menunggu persetujuan Koordinator Skripsi')
                ->orWhere('pembimbing_1_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing 1')
                ->orWhere('pembimbing_2_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing 2')
                ->orderBy('status_skripsi', 'desc')->count(),
                //JUMLAH PERSETUJUAN SEMINAR SKRIPSI
                'jml_persetujuan_seminar' => PenjadwalanSkripsi::where('status_seminar', 1)->where('prodi_id', 1)->count(),
                //JUMLAH RIWAYAT PERSETUJUAN SEMINAR
                'jml_riwayat_persetujuan_seminar' => PenjadwalanSkripsi::where('status_seminar', 3)->where('prodi_id', 1)->count(),

            ]);
        }
        if (auth()->user()->role_id == 10) {            
            return view('persetujuan.riwayat-koordinator', [                
                'penjadwalan_skripsis' => PenjadwalanSkripsi::where('status_seminar', 3)->where('prodi_id', 2)->get(),

                //JUMLAH PERSETUJUAN KP
                'jml_persetujuan_kp' => PendaftaranKP::where('prodi_id', '2')->where('keterangan', 'Menunggu persetujuan Koordinator KP')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing')
                ->orderBy('status_kp', 'desc')->count(),
                //JUMLAH PERSETUJUAN SKRIPSI
                 'jml_persetujuan_skripsi' => PendaftaranSkripsi::where('prodi_id', '2')->where('keterangan', 'Menunggu persetujuan Koordinator Skripsi')
                ->orWhere('pembimbing_1_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing 1')
                ->orWhere('pembimbing_2_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing 2')
                ->orderBy('status_skripsi', 'desc')->count(),
                //JUMLAH PERSETUJUAN SEMINAR SKRIPSI
                'jml_persetujuan_seminar' => PenjadwalanSkripsi::where('status_seminar', 1)->where('prodi_id', 2)->count(),
                //JUMLAH RIWAYAT PERSETUJUAN SEMINAR
                'jml_riwayat_persetujuan_seminar' => PenjadwalanSkripsi::where('status_seminar', 3)->where('prodi_id', 2)->count(),
            ]);
        }
        if (auth()->user()->role_id == 11) {            
            return view('persetujuan.riwayat-koordinator', [                
                'penjadwalan_skripsis' => PenjadwalanSkripsi::where('status_seminar', 3)->where('prodi_id', 3)->get(),

                //JUMLAH PERSETUJUAN KP
                'jml_persetujuan_kp' => PendaftaranKP::where('prodi_id', '3')->where('keterangan', 'Menunggu persetujuan Koordinator KP')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing')
                ->orderBy('status_kp', 'desc')->count(),
                //JUMLAH PERSETUJUAN SKRIPSI
                 'jml_persetujuan_skripsi' => PendaftaranSkripsi::where('prodi_id', '3')->where('keterangan', 'Menunggu persetujuan Koordinator Skripsi')
                ->orWhere('pembimbing_1_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing 1')
                ->orWhere('pembimbing_2_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing 2')
                ->orderBy('status_skripsi', 'desc')->count(),
                //JUMLAH PERSETUJUAN SEMINAR SKRIPSI
                'jml_persetujuan_seminar' => PenjadwalanSkripsi::where('status_seminar', 1)->where('prodi_id', 3)->count(),
                //JUMLAH RIWAYAT PERSETUJUAN SEMINAR
                'jml_riwayat_persetujuan_seminar' => PenjadwalanSkripsi::where('status_seminar', 3)->where('prodi_id', 3)->count(),

            ]);
        }
    }

    public function riwayat_kaprodi()
    {       
        if (auth()->user()->role_id == 6) {            
            return view('persetujuan.riwayat-kaprodi', [                
                'penjadwalan_skripsis' => PenjadwalanSkripsi::where('status_seminar', 3)->where('prodi_id', 1)->get(),

                //JUMLAH PERSETUJUAN KP
                'jml_persetujuan_kp' => PendaftaranKP::where('prodi_id', '1')->where('keterangan', 'Menunggu persetujuan Koordinator Program Studi')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing')
                ->orderBy('status_kp', 'desc')->count(),
                //JUMLAH PERSETUJUAN SKRIPSI
                 'jml_persetujuan_skripsi' => PendaftaranSkripsi::where('prodi_id', '1')->where('keterangan', 'Menunggu persetujuan Koordinator Program Studi')
                ->orWhere('pembimbing_1_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing 1')
                ->orWhere('pembimbing_2_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing 2')
                ->orderBy('status_skripsi', 'desc')->count(),
                //JUMLAH PERSETUJUAN SEMINAR SKRIPSI
                'jml_persetujuan_seminar' => PenjadwalanSkripsi::where('status_seminar', 1)->where('prodi_id', 1)->count(),
                //JUMLAH RIWAYAT PERSETUJUAN SEMINAR
                'jml_riwayat_persetujuan_seminar' => PenjadwalanSkripsi::where('status_seminar', 3)->where('prodi_id', 1)->count(),
            ]);
        }
        if (auth()->user()->role_id == 7) {            
            return view('persetujuan.riwayat-kaprodi', [                
                'penjadwalan_skripsis' => PenjadwalanSkripsi::where('status_seminar', 3)->where('prodi_id', 2)->get(),

                //JUMLAH PERSETUJUAN KP
                'jml_persetujuan_kp' => PendaftaranKP::where('prodi_id', '2')->where('keterangan', 'Menunggu persetujuan Koordinator Program Studi')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing')
                ->orderBy('status_kp', 'desc')->count(),
                //JUMLAH PERSETUJUAN SKRIPSI
                 'jml_persetujuan_skripsi' => PendaftaranSkripsi::where('prodi_id', '2')->where('keterangan', 'Menunggu persetujuan Koordinator Program Studi')
                ->orWhere('pembimbing_1_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing 1')
                ->orWhere('pembimbing_2_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing 2')
                ->orderBy('status_skripsi', 'desc')->count(),
                //JUMLAH PERSETUJUAN SEMINAR SKRIPSI
                'jml_persetujuan_seminar' => PenjadwalanSkripsi::where('status_seminar', 1)->where('prodi_id', 2)->count(),
                //JUMLAH RIWAYAT PERSETUJUAN SEMINAR
                'jml_riwayat_persetujuan_seminar' => PenjadwalanSkripsi::where('status_seminar', 3)->where('prodi_id', 2)->count(),
            ]);
        }
        if (auth()->user()->role_id == 8) {            
            return view('persetujuan.riwayat-kaprodi', [                
                'penjadwalan_skripsis' => PenjadwalanSkripsi::where('status_seminar', 3)->where('prodi_id', 3)->get(),

                //JUMLAH PERSETUJUAN KP
                'jml_persetujuan_kp' => PendaftaranKP::where('prodi_id', '3')->where('keterangan', 'Menunggu persetujuan Koordinator Program Studi')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing')
                ->orderBy('status_kp', 'desc')->count(),
                //JUMLAH PERSETUJUAN SKRIPSI
                 'jml_persetujuan_skripsi' => PendaftaranSkripsi::where('prodi_id', '3')->where('keterangan', 'Menunggu persetujuan Koordinator Program Studi')
                ->orWhere('pembimbing_1_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing 1')
                ->orWhere('pembimbing_2_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing 2')
                ->orderBy('status_skripsi', 'desc')->count(),
                //JUMLAH PERSETUJUAN SEMINAR SKRIPSI
                'jml_persetujuan_seminar' => PenjadwalanSkripsi::where('status_seminar', 1)->where('prodi_id', 3)->count(),
                //JUMLAH RIWAYAT PERSETUJUAN SEMINAR
                'jml_riwayat_persetujuan_seminar' => PenjadwalanSkripsi::where('status_seminar', 3)->where('prodi_id', 3)->count(),
            ]);
        }
    }

    public function clear(){
        try {
            $jadwal_skripsi = PenjadwalanSkripsi::where('tanggal', '>=', Carbon::today())->get();
            $jadwal_sempro = PenjadwalanSempro::where('tanggal', '>=', Carbon::today())->get();
            $jadwal_kp = PenjadwalanKP::where('tanggal', '>=', Carbon::today())->get();

            DB::beginTransaction();

            foreach ($jadwal_skripsi as $skripsi){
                $skripsi->update([
                    'tanggal' => NULL,
                    'waktu' => NULL,
                    'lokasi' => NULL,
                ]);
            }

            foreach ($jadwal_sempro as $sempro){
                $sempro->update([
                    'tanggal' => NULL,
                    'waktu' => NULL,
                    'lokasi' => NULL,
                ]);
            }

            foreach ($jadwal_kp as $kp){
                $kp->update([
                    'tanggal' => NULL,
                    'waktu' => NULL,
                    'lokasi' => NULL,
                ]);
            }

            DB::commit();
            return redirect()->route('form');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back();
        }
    }
}
