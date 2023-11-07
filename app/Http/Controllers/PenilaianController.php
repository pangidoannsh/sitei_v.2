<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PenjadwalanKP;
use App\Models\PendaftaranKP;
use App\Models\PenjadwalanSempro;
use App\Models\PenjadwalanSkripsi;
use Illuminate\Support\Facades\Auth;

class PenilaianController extends Controller
{
    public function index()
    {        
        
        // $dosen = PenjadwalanSempro::where('pembimbingsatu_nip', Auth::user()->nip)->where('status_seminar', 0)->
        // orWhere('pembimbingdua_nip', Auth::user()->nip)->where('status_seminar', 0)->
        // orWhere('pengujisatu_nip', Auth::user()->nip)->where('status_seminar', 0)->
        // orWhere('pengujidua_nip', Auth::user()->nip)->where('status_seminar', 0)->
        // orWhere('pengujitiga_nip', Auth::user()->nip)->where('status_seminar', 0)->get();

        // $dosens = PenjadwalanSkripsi::where('pembimbingsatu_nip', Auth::user()->nip)->where('status_seminar', 0)->
        // orWhere('pembimbingdua_nip', Auth::user()->nip)->where('status_seminar', 0)->
        // orWhere('pengujisatu_nip', Auth::user()->nip)->where('status_seminar', 0)->s
        // orWhere('pengujidua_nip', Auth::user()->nip)->where('status_seminar', 0)->
        // orWhere('pengujitiga_nip', Auth::user()->nip)->where('status_seminar', 0)->get();

        // $dosenss = PenjadwalanKP::where('penguji_nip', Auth::user()->nip)->where('status_seminar', 0)->
        // orWhere('pembimbing_nip', Auth::user()->nip)->where('status_seminar', 0)->get();

            if (auth()->user()->role_id == 5 ) {            
            return view('penilaian.index', [
                'jml_prodikp' => PendaftaranKP::where('keterangan','<>', 'Nilai KP Telah Keluar')->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->orderBy('status_kp', 'desc')->get(),

                'jml_persetujuankp' =>  PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Seminar KP Dijadwalkan')
                ->orderBy('status_kp', 'desc')->get(),

                'jml_bimbingankp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->where('keterangan','<>', 'Nilai KP Telah Keluar')->orderBy('status_kp', 'desc')->get(),

               'penjadwalan_kps' => PenjadwalanKP::where('status_seminar', 0)->get(),
               'penjadwalan_sempros' => PenjadwalanSempro::where('status_seminar', 0)->get(),
               'penjadwalan_skripsis' => PenjadwalanSkripsi::where('status_seminar', 0)->get(),
            ]);
        }
        if (auth()->user()->role_id == 6) {            
            return view('penilaian.index', [
                'jml_prodikp' => PendaftaranKP::where('prodi_id', '1')->where('keterangan','<>', 'Nilai KP Telah Keluar')->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->orderBy('status_kp', 'desc')->get(),

                'jml_persetujuankp' =>  PendaftaranKP::where('prodi_id', '1')->where('keterangan', 'Menunggu persetujuan Koordinator Program Studi')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Seminar KP Dijadwalkan')
                ->orderBy('status_kp', 'desc')->get(),

                'jml_bimbingankp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->where('keterangan','<>', 'Nilai KP Telah Keluar')->orderBy('status_kp', 'desc')->get(),

               'penjadwalan_kps' => PenjadwalanKP::where('prodi_id', '1')->where('status_seminar', 0)->get(),
               'penjadwalan_sempros' => PenjadwalanSempro::where('prodi_id', '1')->where('status_seminar', 0)->get(),
               'penjadwalan_skripsis' => PenjadwalanSkripsi::where('prodi_id', '1')->where('status_seminar', 0)->get(),
            ]);
        }
        if (auth()->user()->role_id == 7) {            
            return view('penilaian.index', [
                'jml_prodikp' => PendaftaranKP::where('prodi_id', '2')->where('keterangan','<>', 'Nilai KP Telah Keluar')->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->orderBy('status_kp', 'desc')->get(),

                'jml_persetujuankp' =>  PendaftaranKP::where('prodi_id', '2')->where('keterangan', 'Menunggu persetujuan Koordinator Program Studi')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Seminar KP Dijadwalkan')
                ->orderBy('status_kp', 'desc')->get(),

                'jml_bimbingankp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->where('keterangan','<>', 'Nilai KP Telah Keluar')->orderBy('status_kp', 'desc')->get(),

               'penjadwalan_kps' => PenjadwalanKP::where('prodi_id', '2')->where('status_seminar', 0)->get(),
               'penjadwalan_sempros' => PenjadwalanSempro::where('prodi_id', '2')->where('status_seminar', 0)->get(),
               'penjadwalan_skripsis' => PenjadwalanSkripsi::where('prodi_id', '2')->where('status_seminar', 0)->get(),
            ]);
        }
        if (auth()->user()->role_id == 8) {            
            return view('penilaian.index', [
                'jml_prodikp' => PendaftaranKP::where('prodi_id', '3')->where('keterangan','<>', 'Nilai KP Telah Keluar')->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->orderBy('status_kp', 'desc')->get(),

                'jml_persetujuankp' =>  PendaftaranKP::where('prodi_id', '3')->where('keterangan', 'Menunggu persetujuan Koordinator Program Studi')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Seminar KP Dijadwalkan')
                ->orderBy('status_kp', 'desc')->get(),

                'jml_bimbingankp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->where('keterangan','<>', 'Nilai KP Telah Keluar')->orderBy('status_kp', 'desc')->get(),

              'penjadwalan_kps' => PenjadwalanKP::where('prodi_id', '3')->where('status_seminar', 0)->get(),
               'penjadwalan_sempros' => PenjadwalanSempro::where('prodi_id', '3')->where('status_seminar', 0)->get(),
               'penjadwalan_skripsis' => PenjadwalanSkripsi::where('prodi_id', '3')->where('status_seminar', 0)->get(),
            ]);
        }  

        if (auth()->user()->role_id == 9) {            
            return view('penilaian.index', [
                'jml_prodikp' => PendaftaranKP::where('prodi_id', '1')->where('keterangan','<>', 'Nilai KP Telah Keluar')->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->orderBy('status_kp', 'desc')->get(),

                'jml_persetujuankp' => PendaftaranKP::where('prodi_id', '1')->where('keterangan', 'Menunggu persetujuan Koordinator KP')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Seminar KP Dijadwalkan')
                ->orWhere('prodi_id', '1')->where('keterangan', 'Proses Kerja Praktek Selesai')
                ->orWhere('prodi_id', '2')->where('status_kp', 'DAFTAR SEMINAR KP')->where('keterangan', 'Menunggu Jadwal Seminar KP')
                ->orderBy('status_kp', 'desc')->get(),

                'jml_bimbingankp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->where('keterangan','<>', 'Nilai KP Telah Keluar')->orderBy('status_kp', 'desc')->get(),

               'penjadwalan_kps' => PenjadwalanKP::where('prodi_id', '1')->where('status_seminar', 0)->get(),
               'penjadwalan_sempros' => PenjadwalanSempro::where('prodi_id', '1')->where('status_seminar', 0)->get(),
               'penjadwalan_skripsis' => PenjadwalanSkripsi::where('prodi_id', '1')->where('status_seminar', 0)->get(),
            ]);
        }
        if (auth()->user()->role_id == 10) {            
            return view('penilaian.index', [
                'jml_prodikp' => PendaftaranKP::where('prodi_id', '2')->where('keterangan','<>', 'Nilai KP Telah Keluar')->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->orderBy('status_kp', 'desc')->get(),

                'jml_persetujuankp' => PendaftaranKP::where('prodi_id', '2')->where('keterangan', 'Menunggu persetujuan Koordinator KP')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Seminar KP Dijadwalkan')
                ->orWhere('prodi_id', '2')->where('keterangan', 'Proses Kerja Praktek Selesai')
                ->orWhere('prodi_id', '2')->where('status_kp', 'DAFTAR SEMINAR KP')->where('keterangan', 'Menunggu Jadwal Seminar KP')
                ->orderBy('status_kp', 'desc')->get(),

                'jml_bimbingankp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->where('keterangan','<>', 'Nilai KP Telah Keluar')->orderBy('status_kp', 'desc')->get(),

              'penjadwalan_kps' => PenjadwalanKP::where('prodi_id', '2')->where('status_seminar', 0)->get(),
               'penjadwalan_sempros' => PenjadwalanSempro::where('prodi_id', '2')->where('status_seminar', 0)->get(),
               'penjadwalan_skripsis' => PenjadwalanSkripsi::where('prodi_id', '2')->where('status_seminar', 0)->get(),
            ]);
        }
        if (auth()->user()->role_id == 11) {            
            return view('penilaian.index', [
                'jml_prodikp' => PendaftaranKP::where('prodi_id', '3')->where('keterangan','<>', 'Nilai KP Telah Keluar')->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->orderBy('status_kp', 'desc')->get(),

                'jml_persetujuankp' => PendaftaranKP::where('prodi_id', '3')->where('keterangan', 'Menunggu persetujuan Koordinator KP')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Seminar KP Dijadwalkan')
                ->orWhere('prodi_id', '3')->where('keterangan', 'Proses Kerja Praktek Selesai')
                ->orWhere('prodi_id', '3')->where('status_kp', 'DAFTAR SEMINAR KP')->where('keterangan', 'Menunggu Jadwal Seminar KP')
                ->orderBy('status_kp', 'desc')->get(),

                'jml_bimbingankp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->where('keterangan','<>', 'Nilai KP Telah Keluar')->orderBy('status_kp', 'desc')->get(),

              'penjadwalan_kps' => PenjadwalanKP::where('prodi_id', '3')->where('status_seminar', 0)->get(),
               'penjadwalan_sempros' => PenjadwalanSempro::where('prodi_id', '3')->where('status_seminar', 0)->get(),
               'penjadwalan_skripsis' => PenjadwalanSkripsi::where('prodi_id', '3')->where('status_seminar', 0)->get(),

            ]);
        }  
        
         // DOSEN PEMBIMBING
        // if (auth()->user()->nip > 0) {  
        //     return view('penilaian.index', [
        //         'jml_prodikp' => PendaftaranKP::where('keterangan','<>', 'Nilai KP Telah Keluar')->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->orderBy('status_kp', 'desc')->get(),

        //         'jml_persetujuankp' =>  PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing')
        //         ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Seminar KP Dijadwalkan')
        //         ->orderBy('status_kp', 'desc')->get(),

        //         'jml_bimbingankp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->where('keterangan','<>', 'Nilai KP Telah Keluar')->orderBy('status_kp', 'desc')->get(),

        //        'penjadwalan_kps' => PenjadwalanKP::where('penguji_nip', Auth::user()->nip)->where('status_seminar', 0)->orWhere('pembimbing_nip', Auth::user()->nip)->where('status_seminar', 0)->get(),

        //     ]);
        // } 

    }

    public function indexpembimbing()
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

        return view('penilaian.index-pembimbing', [
            'penjadwalan_sempros' => $dosen,
            'penjadwalan_skripsis' => $dosens,
            'penjadwalan_kps' => $dosenss,
        ]);
    }


    public function riwayatkp()
    {
        // $riwayat = PenjadwalanSempro::where('pembimbingsatu_nip', Auth::user()->nip)->where('status_seminar', 1)->orWhere('pembimbingdua_nip', Auth::user()->nip)->where('status_seminar', 1)->orWhere('pengujisatu_nip', Auth::user()->nip)->where('status_seminar', 1)->orWhere('pengujidua_nip', Auth::user()->nip)->where('status_seminar', 1)->orWhere('pengujitiga_nip', Auth::user()->nip)->where('status_seminar', 1)->get();        

        // $riwayatt = PenjadwalanSkripsi::where('pembimbingsatu_nip', Auth::user()->nip)->where('status_seminar', 3)->orWhere('pembimbingdua_nip', Auth::user()->nip)->where('status_seminar', 3)->orWhere('pengujisatu_nip', Auth::user()->nip)->where('status_seminar', 3)->orWhere('pengujidua_nip', Auth::user()->nip)->where('status_seminar', 3)->orWhere('pengujitiga_nip', Auth::user()->nip)->where('status_seminar', 3)->get();

        // $draf = PenjadwalanSkripsi::where('pengujisatu_nip', Auth::user()->nip)->where('status_seminar', 1)->get();

        // $draff = PenjadwalanSkripsi::where('pengujisatu_nip', Auth::user()->nip)->where('status_seminar', 2)->get();

        // $riwayattt = PenjadwalanKP::where('penguji_nip', Auth::user()->nip)->where('status_seminar', 1)->orWhere('pembimbing_nip', Auth::user()->nip)->where('status_seminar', 1)->get();



         if (auth()->user()->role_id == 5 ) {            
            return view('penilaian.riwayat-penilaian', [
                'jml_prodikp' => PendaftaranKP::where('keterangan','<>', 'Nilai KP Telah Keluar')->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->orderBy('status_kp', 'desc')->get(),

                'jml_persetujuankp' =>  PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Seminar KP Dijadwalkan')
                ->orderBy('status_kp', 'desc')->get(),

                'jml_bimbingankp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->where('keterangan','<>', 'Nilai KP Telah Keluar')->orderBy('status_kp', 'desc')->get(),

                'jml_seminarkp' => PenjadwalanKP::where('penguji_nip', Auth::user()->nip)->where('status_seminar', 0)->orWhere('pembimbing_nip', Auth::user()->nip)->where('status_seminar', 0)->get(),

               'penjadwalan_kps' => PenjadwalanKP::where('penguji_nip', Auth::user()->nip)->where('status_seminar', 1)->orWhere('pembimbing_nip', Auth::user()->nip)->where('status_seminar', 1)->get(),
            ]);
        }
        if (auth()->user()->role_id == 6) {            
            return view('penilaian.riwayat-penilaian', [
                'jml_prodikp' => PendaftaranKP::where('prodi_id', '1')->where('keterangan','<>', 'Nilai KP Telah Keluar')->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->orderBy('status_kp', 'desc')->get(),

                'jml_persetujuankp' =>  PendaftaranKP::where('prodi_id', '1')->where('keterangan', 'Menunggu persetujuan Koordinator Program Studi')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Seminar KP Dijadwalkan')
                ->orderBy('status_kp', 'desc')->get(),

                'jml_bimbingankp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->where('keterangan','<>', 'Nilai KP Telah Keluar')->orderBy('status_kp', 'desc')->get(),

                'jml_seminarkp' => PenjadwalanKP::where('penguji_nip', Auth::user()->nip)->where('status_seminar', 0)->orWhere('pembimbing_nip', Auth::user()->nip)->where('status_seminar', 0)->get(),

               'penjadwalan_kps' => PenjadwalanKP::where('penguji_nip', Auth::user()->nip)->where('status_seminar', 1)->orWhere('pembimbing_nip', Auth::user()->nip)->where('status_seminar', 1)->get(),
            ]);
        }
        if (auth()->user()->role_id == 7) {            
            return view('penilaian.riwayat-penilaian', [
                'jml_prodikp' => PendaftaranKP::where('prodi_id', '2')->where('keterangan','<>', 'Nilai KP Telah Keluar')->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->orderBy('status_kp', 'desc')->get(),

                'jml_persetujuankp' =>  PendaftaranKP::where('prodi_id', '2')->where('keterangan', 'Menunggu persetujuan Koordinator Program Studi')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Seminar KP Dijadwalkan')
                ->orderBy('status_kp', 'desc')->get(),

                'jml_bimbingankp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->where('keterangan','<>', 'Nilai KP Telah Keluar')->orderBy('status_kp', 'desc')->get(),

                'jml_seminarkp' => PenjadwalanKP::where('penguji_nip', Auth::user()->nip)->where('status_seminar', 0)->orWhere('pembimbing_nip', Auth::user()->nip)->where('status_seminar', 0)->get(),

               'penjadwalan_kps' => PenjadwalanKP::where('penguji_nip', Auth::user()->nip)->where('status_seminar', 1)->orWhere('pembimbing_nip', Auth::user()->nip)->where('status_seminar', 1)->get(),
            ]);
        }
        if (auth()->user()->role_id == 8) {            
            return view('penilaian.riwayat-penilaian', [
                'jml_prodikp' => PendaftaranKP::where('prodi_id', '3')->where('keterangan','<>', 'Nilai KP Telah Keluar')->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->orderBy('status_kp', 'desc')->get(),

                'jml_persetujuankp' =>  PendaftaranKP::where('prodi_id', '3')->where('keterangan', 'Menunggu persetujuan Koordinator Program Studi')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Seminar KP Dijadwalkan')
                ->orderBy('status_kp', 'desc')->get(),

                'jml_bimbingankp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->where('keterangan','<>', 'Nilai KP Telah Keluar')->orderBy('status_kp', 'desc')->get(),

                'jml_seminarkp' => PenjadwalanKP::where('penguji_nip', Auth::user()->nip)->where('status_seminar', 0)->orWhere('pembimbing_nip', Auth::user()->nip)->where('status_seminar', 0)->get(),

               'penjadwalan_kps' => PenjadwalanKP::where('penguji_nip', Auth::user()->nip)->where('status_seminar', 1)->orWhere('pembimbing_nip', Auth::user()->nip)->where('status_seminar', 1)->get(),
            ]);
        }  

        if (auth()->user()->role_id == 9) {            
            return view('penilaian.riwayat-penilaian', [
                'jml_prodikp' => PendaftaranKP::where('prodi_id', '1')->where('keterangan','<>', 'Nilai KP Telah Keluar')->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->orderBy('status_kp', 'desc')->get(),

                'jml_persetujuankp' => PendaftaranKP::where('prodi_id', '1')->where('keterangan', 'Menunggu persetujuan Koordinator KP')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Seminar KP Dijadwalkan')
                ->orWhere('prodi_id', '1')->where('keterangan', 'Proses Kerja Praktek Selesai')
                ->orWhere('prodi_id', '2')->where('status_kp', 'DAFTAR SEMINAR KP')->where('keterangan', 'Menunggu Jadwal Seminar KP')
                ->orderBy('status_kp', 'desc')->get(),

                'jml_bimbingankp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->where('keterangan','<>', 'Nilai KP Telah Keluar')->orderBy('status_kp', 'desc')->get(),

                'jml_seminarkp' => PenjadwalanKP::where('penguji_nip', Auth::user()->nip)->where('status_seminar', 0)->orWhere('pembimbing_nip', Auth::user()->nip)->where('status_seminar', 0)->get(),

               'penjadwalan_kps' => PenjadwalanKP::where('penguji_nip', Auth::user()->nip)->where('status_seminar', 1)->orWhere('pembimbing_nip', Auth::user()->nip)->where('status_seminar', 1)->get(),
            ]);
        }
        if (auth()->user()->role_id == 10) {            
            return view('penilaian.riwayat-penilaian', [
                'jml_prodikp' => PendaftaranKP::where('prodi_id', '2')->where('keterangan','<>', 'Nilai KP Telah Keluar')->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->orderBy('status_kp', 'desc')->get(),

                'jml_persetujuankp' => PendaftaranKP::where('prodi_id', '2')->where('keterangan', 'Menunggu persetujuan Koordinator KP')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Seminar KP Dijadwalkan')
                ->orWhere('prodi_id', '2')->where('keterangan', 'Proses Kerja Praktek Selesai')
                ->orWhere('prodi_id', '2')->where('status_kp', 'DAFTAR SEMINAR KP')->where('keterangan', 'Menunggu Jadwal Seminar KP')
                ->orderBy('status_kp', 'desc')->get(),

                'jml_bimbingankp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->where('keterangan','<>', 'Nilai KP Telah Keluar')->orderBy('status_kp', 'desc')->get(),

                'jml_seminarkp' => PenjadwalanKP::where('penguji_nip', Auth::user()->nip)->where('status_seminar', 0)->orWhere('pembimbing_nip', Auth::user()->nip)->where('status_seminar', 0)->get(),

               'penjadwalan_kps' => PenjadwalanKP::where('penguji_nip', Auth::user()->nip)->where('status_seminar', 1)->orWhere('pembimbing_nip', Auth::user()->nip)->where('status_seminar', 1)->get(),
            ]);
        }
        if (auth()->user()->role_id == 11) {            
            return view('penilaian.riwayat-penilaian', [
                'jml_prodikp' => PendaftaranKP::where('prodi_id', '3')->where('keterangan','<>', 'Nilai KP Telah Keluar')->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->orderBy('status_kp', 'desc')->get(),

                'jml_persetujuankp' => PendaftaranKP::where('prodi_id', '3')->where('keterangan', 'Menunggu persetujuan Koordinator KP')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Seminar KP Dijadwalkan')
                ->orWhere('prodi_id', '3')->where('keterangan', 'Proses Kerja Praktek Selesai')
                ->orWhere('prodi_id', '3')->where('status_kp', 'DAFTAR SEMINAR KP')->where('keterangan', 'Menunggu Jadwal Seminar KP')
                ->orderBy('status_kp', 'desc')->get(),

                'jml_bimbingankp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->where('keterangan','<>', 'Nilai KP Telah Keluar')->orderBy('status_kp', 'desc')->get(),

                'jml_seminarkp' => PenjadwalanKP::where('penguji_nip', Auth::user()->nip)->where('status_seminar', 0)->orWhere('pembimbing_nip', Auth::user()->nip)->where('status_seminar', 0)->get(),

               'penjadwalan_kps' => PenjadwalanKP::where('penguji_nip', Auth::user()->nip)->where('status_seminar', 1)->orWhere('pembimbing_nip', Auth::user()->nip)->where('status_seminar', 1)->get(),

            ]);
        }  
        
         // DOSEN PEMBIMBING
        if (auth()->user()->nip > 0) {  
            return view('penilaian.riwayat-penilaian', [
                  'jml_prodikp' => PendaftaranKP::where('keterangan','<>', 'Nilai KP Telah Keluar')->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->orderBy('status_kp', 'desc')->get(),

                'jml_persetujuankp' =>  PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Seminar KP Dijadwalkan')
                ->orderBy('status_kp', 'desc')->get(),

                'jml_bimbingankp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->where('keterangan','<>', 'Nilai KP Telah Keluar')->orderBy('status_kp', 'desc')->get(),

                'jml_seminarkp' => PenjadwalanKP::where('penguji_nip', Auth::user()->nip)->where('status_seminar', 0)->orWhere('pembimbing_nip', Auth::user()->nip)->where('status_seminar', 0)->get(),

               'penjadwalan_kps' => PenjadwalanKP::where('penguji_nip', Auth::user()->nip)->where('status_seminar', 1)->orWhere('pembimbing_nip', Auth::user()->nip)->where('status_seminar', 1)->get(),

            ]);
        } 


    }

    public function riwayatskripsi()
    {
        $riwayat = PenjadwalanSempro::where('pembimbingsatu_nip', Auth::user()->nip)->where('status_seminar', 1)->orWhere('pembimbingdua_nip', Auth::user()->nip)->where('status_seminar', 1)->orWhere('pengujisatu_nip', Auth::user()->nip)->where('status_seminar', 1)->orWhere('pengujidua_nip', Auth::user()->nip)->where('status_seminar', 1)->orWhere('pengujitiga_nip', Auth::user()->nip)->where('status_seminar', 1)->get();        

        $riwayatt = PenjadwalanSkripsi::where('pembimbingsatu_nip', Auth::user()->nip)->where('status_seminar', 3)->orWhere('pembimbingdua_nip', Auth::user()->nip)->where('status_seminar', 3)->orWhere('pengujisatu_nip', Auth::user()->nip)->where('status_seminar', 3)->orWhere('pengujidua_nip', Auth::user()->nip)->where('status_seminar', 3)->orWhere('pengujitiga_nip', Auth::user()->nip)->where('status_seminar', 3)->get();

        $draf = PenjadwalanSkripsi::where('pengujisatu_nip', Auth::user()->nip)->where('status_seminar', 1)->get();

        $draff = PenjadwalanSkripsi::where('pengujisatu_nip', Auth::user()->nip)->where('status_seminar', 2)->get();

        // $riwayattt = PenjadwalanKP::where('penguji_nip', Auth::user()->nip)->where('status_seminar', 1)->orWhere('pembimbing_nip', Auth::user()->nip)->where('status_seminar', 1)->get();

        return view('penilaian.riwayat-penilaian-skripsi', [
            'penjadwalan_sempros' => $riwayat,
            'penjadwalan_skripsis' => $riwayatt,
            'penjadwalan_skripsis_draf' => $draf,
            'penjadwalan_skripsis_draff' => $draff,
            // 'penjadwalan_kps' => $riwayattt,
        ]);
    }
}
