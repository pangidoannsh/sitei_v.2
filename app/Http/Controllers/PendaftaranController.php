<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Dosen;
use App\Models\UsulanKP;
use App\Models\Mahasiswa;
use App\Models\PermohonanKP;
use Illuminate\Http\Request;
use App\Models\PendaftaranKP;
use App\Models\PenjadwalanSempro;
use App\Models\PenjadwalanKP;
use App\Models\PendaftaranSkripsi;

use App\Models\PenjadwalanSkripsi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Crypt;


class PendaftaranController extends Controller
{

    public function home ()
    {
        return view('pendaftaran.indexdosen', [
            // 'mahasiswa' => Mahasiswa::where('nim', Auth::user()->nim)->get(),
            // 'dosen' => Dosen::where('nip', Auth::user()->nip)->get(),
            // 'pendaftaran_kps' => PendaftaranKP::where('dosen_pembimbing', Auth::user()->nip)->get(),
            // 'pendaftaran_kp' =>PendaftaranKP::all(),
        ]);

        
    }
    public function pendaftaran_kp_pembimbing ()
    {
        // return view('pendaftaran.dosen.indexpembimbingkp', [
        //             'pendaftaran_kp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->where('keterangan','<>', 'Nilai KP Telah Keluar')->orderBy('status_kp', 'desc')->get(),
        //         ]);


                 if (auth()->user()->role_id == 6) {            
            return view('pendaftaran.dosen.indexpembimbingkp', [

                'pendaftaran_kp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->where('keterangan','<>', 'Nilai KP Telah Keluar')->orderBy('status_kp', 'desc')->get(),

                'jml_persetujuankp' => PendaftaranKP::where('prodi_id', '1')->where('keterangan', 'Menunggu persetujuan Koordinator Program Studi')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Seminar KP Dijadwalkan')
                ->orderBy('status_kp', 'desc')->get(),

                'jml_prodikp' => PendaftaranKP::where('prodi_id', '1')->where('keterangan','<>', 'Nilai KP Telah Keluar')->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->orderBy('status_kp', 'desc')->get(),

                'jml_bimbingankp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->where('keterangan','<>', 'Nilai KP Telah Keluar')->orderBy('status_kp', 'desc')->get(),

                'jml_seminarkp' => PenjadwalanKP::where('penguji_nip', Auth::user()->nip)->where('status_seminar', 0)->orWhere('pembimbing_nip', Auth::user()->nip)->where('status_seminar', 0)->get(),

            ]);
        }
        if (auth()->user()->role_id == 7) {            
            return view('pendaftaran.dosen.indexpembimbingkp', [
                'pendaftaran_kp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->where('keterangan','<>', 'Nilai KP Telah Keluar')->orderBy('status_kp', 'desc')->get(),

                'jml_persetujuankp' => PendaftaranKP::where('prodi_id', '2')->where('keterangan', 'Menunggu persetujuan Koordinator Program Studi')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Seminar KP Dijadwalkan')
                ->orderBy('status_kp', 'desc')->get(),

                'jml_prodikp' => PendaftaranKP::where('prodi_id', '2')->where('keterangan','<>', 'Nilai KP Telah Keluar')->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->orderBy('status_kp', 'desc')->get(),

                'jml_bimbingankp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->where('keterangan','<>', 'Nilai KP Telah Keluar')->orderBy('status_kp', 'desc')->get(),

                'jml_seminarkp' => PenjadwalanKP::where('penguji_nip', Auth::user()->nip)->where('status_seminar', 0)->orWhere('pembimbing_nip', Auth::user()->nip)->where('status_seminar', 0)->get(),
            ]);
        }
        if (auth()->user()->role_id == 8) {            
            return view('pendaftaran.dosen.indexpembimbingkp', [
                'pendaftaran_kp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->where('keterangan','<>', 'Nilai KP Telah Keluar')->orderBy('status_kp', 'desc')->get(),

                'jml_persetujuankp' => PendaftaranKP::where('prodi_id', '3')->where('keterangan', 'Menunggu persetujuan Koordinator Program Studi')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Seminar KP Dijadwalkan')
                ->orderBy('status_kp', 'desc')->get(),

                'jml_prodikp' => PendaftaranKP::where('prodi_id', '3')->where('keterangan','<>', 'Nilai KP Telah Keluar')->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->orderBy('status_kp', 'desc')->get(),

                'jml_bimbingankp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->where('keterangan','<>', 'Nilai KP Telah Keluar')->orderBy('status_kp', 'desc')->get(),

                'jml_seminarkp' => PenjadwalanKP::where('penguji_nip', Auth::user()->nip)->where('status_seminar', 0)->orWhere('pembimbing_nip', Auth::user()->nip)->where('status_seminar', 0)->get(),
            ]);
        }  

        if (auth()->user()->role_id == 9) {            
            return view('pendaftaran.dosen.indexpembimbingkp', [
                'pendaftaran_kp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->where('keterangan','<>', 'Nilai KP Telah Keluar')->orderBy('status_kp', 'desc')->get(),

                'jml_persetujuankp' => PendaftaranKP::where('prodi_id', '1')->where('keterangan', 'Menunggu persetujuan Koordinator KP')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Seminar KP Dijadwalkan')
                ->orWhere('prodi_id', '1')->where('keterangan', 'Proses Kerja Praktek Selesai')
                ->orWhere('prodi_id', '1')->where('status_kp', 'DAFTAR SEMINAR KP')->where('keterangan', 'Menunggu Jadwal Seminar KP')
                ->orderBy('status_kp', 'desc')->get(),

                'jml_prodikp' => PendaftaranKP::where('prodi_id', '1')->where('keterangan','<>', 'Nilai KP Telah Keluar')->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->orderBy('status_kp', 'desc')->get(),

                'jml_bimbingankp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->where('keterangan','<>', 'Nilai KP Telah Keluar')->orderBy('status_kp', 'desc')->get(),

                'jml_seminarkp' => PenjadwalanKP::where('penguji_nip', Auth::user()->nip)->where('status_seminar', 0)->orWhere('pembimbing_nip', Auth::user()->nip)->where('status_seminar', 0)->get(),
            ]);
        }
        if (auth()->user()->role_id == 10) {            
            return view('pendaftaran.dosen.indexpembimbingkp', [

                'pendaftaran_kp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->where('keterangan','<>', 'Nilai KP Telah Keluar')->orderBy('status_kp', 'desc')->get(),

                'jml_persetujuankp' => PendaftaranKP::where('prodi_id', '2')->where('keterangan', 'Menunggu persetujuan Koordinator KP')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Seminar KP Dijadwalkan')
                ->orWhere('prodi_id', '2')->where('keterangan', 'Proses Kerja Praktek Selesai')
                ->orWhere('prodi_id', '2')->where('status_kp', 'DAFTAR SEMINAR KP')->where('keterangan', 'Menunggu Jadwal Seminar KP')
                ->orderBy('status_kp', 'desc')->get(),

                'jml_prodikp' => PendaftaranKP::where('prodi_id', '2')->where('keterangan','<>', 'Nilai KP Telah Keluar')->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->orderBy('status_kp', 'desc')->get(),

                'jml_bimbingankp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->where('keterangan','<>', 'Nilai KP Telah Keluar')->orderBy('status_kp', 'desc')->get(),

                'jml_seminarkp' => PenjadwalanKP::where('penguji_nip', Auth::user()->nip)->where('status_seminar', 0)->orWhere('pembimbing_nip', Auth::user()->nip)->where('status_seminar', 0)->get(),
            ]);
        }
        if (auth()->user()->role_id == 11) {            
            return view('pendaftaran.dosen.indexpembimbingkp', [

                'pendaftaran_kp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->where('keterangan','<>', 'Nilai KP Telah Keluar')->orderBy('status_kp', 'desc')->get(),

                'jml_persetujuankp' => PendaftaranKP::where('prodi_id', '3')->where('keterangan', 'Menunggu persetujuan Koordinator KP')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Seminar KP Dijadwalkan')
                ->orWhere('prodi_id', '3')->where('keterangan', 'Proses Kerja Praktek Selesai')
                ->orWhere('prodi_id', '3')->where('status_kp', 'DAFTAR SEMINAR KP')->where('keterangan', 'Menunggu Jadwal Seminar KP')
                ->orderBy('status_kp', 'desc')->get(),

                'jml_prodikp' => PendaftaranKP::where('prodi_id', '3')->where('keterangan','<>', 'Nilai KP Telah Keluar')->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->orderBy('status_kp', 'desc')->get(),

                'jml_bimbingankp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->where('keterangan','<>', 'Nilai KP Telah Keluar')->orderBy('status_kp', 'desc')->get(),

                'jml_seminarkp' => PenjadwalanKP::where('penguji_nip', Auth::user()->nip)->where('status_seminar', 0)->orWhere('pembimbing_nip', Auth::user()->nip)->where('status_seminar', 0)->get(),
            ]);
        } 
        // DOSEN PEMBIMBING
        if (auth()->user()->nip > 0) {  
            return view('pendaftaran.dosen.indexpembimbingkp', [

                'jml_prodikp' => PendaftaranKP::where('prodi_id', '1')->where('keterangan','<>', 'Nilai KP Telah Keluar')->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->orderBy('status_kp', 'desc')->get(),

                'pendaftaran_kp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->where('keterangan','<>', 'Nilai KP Telah Keluar')->orderBy('status_kp', 'desc')->get(),

                'jml_persetujuankp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing')->orderBy('created_at', 'desc')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Seminar KP Dijadwalkan')->orderBy('updated_at', 'desc')
                ->orderBy('updated_at', 'desc')->get(),

                'jml_seminarkp' => PenjadwalanKP::where('penguji_nip', Auth::user()->nip)->where('status_seminar', 0)->orWhere('pembimbing_nip', Auth::user()->nip)->where('status_seminar', 0)->get(),

            ]);
        } 

    }
    public function pendaftaran_skripsi_pembimbing ()
    {
        return view('pendaftaran.dosen.indexpembimbingskripsi', [
                    'pendaftaran_skripsi' => PendaftaranSkripsi::where('pembimbing_1_nip', Auth::user()->nip)->where('status_skripsi','<>', 'USULAN JUDUL DITOLAK')->where('status_skripsi','<>', 'LULUS')->where('status_skripsi','<>', 'USULKAN JUDUL ULANG')->orderBy('status_skripsi', 'desc')
                    ->orWhere('pembimbing_2_nip', Auth::user()->nip)->where('status_skripsi','<>', 'USULAN JUDUL DITOLAK')->where('status_skripsi','<>', 'USULKAN JUDUL ULANG')->where('status_skripsi','<>', 'LULUS')->orderBy('status_skripsi', 'desc')->get(),
                ]);
    }
    // public function pendaftaran_skripsi_pembimbing2 ()
    // {
    //     return view('pendaftaran.dosen.indexpembimbing2skripsi', [
    //                 'pendaftaran_skripsi' => PendaftaranSkripsi::where('pembimbing_2', Auth::user()->nama)->get(),
    //             ]);
    // }

    public function detailusulan_pembimbing ($id)
    {
        
        //ADMIN
        if (auth()->user()->role_id == 1) {     
            return view('pendaftaran.dosen.detailusulan-pemb', [
                'pendaftaran_kp' => PendaftaranKP::where('id', $id)->get(),
            ]);
        } 
       
        if (auth()->user()->role_id == 2) {            
            return view('pendaftaran.dosen.detailusulan-pemb', [
                'pendaftaran_kp' => PendaftaranKP::where('id', $id)->where('prodi_id', '1')->get(),
            ]);
        }
        if (auth()->user()->role_id == 3) {            
            return view('pendaftaran.dosen.detailusulan-pemb', [
                'pendaftaran_kp' => PendaftaranKP::where('id', $id)->where('prodi_id', '2')->get(),
            ]);
        }
        if (auth()->user()->role_id == 4) {  
            
            return view('pendaftaran.dosen.detailusulan-pemb', [
                'pendaftaran_kp' =>  PendaftaranKP::where('id', $id)->where('prodi_id', '3')->get(),
            ]);
        } 
        //DOSEN
        if (auth()->user()->nip >0) {  
            return view('pendaftaran.dosen.detailusulan-pemb', [
                'pendaftaran_kp' => PendaftaranKP::where('id', $id)->where('dosen_pembimbing_nip', Auth::user()->nip)->get(),
            ]);
        } 
    }
    public function detailkpti10_pembimbing ($id)
    {
        
        //ADMIN
        if (auth()->user()->role_id == 1) {     
            return view('pendaftaran.dosen.detailkpti-10-pemb', [
                'pendaftaran_kp' => PendaftaranKP::where('id', $id)->get(),
            ]);
        } 
       
        if (auth()->user()->role_id == 2) {            
            return view('pendaftaran.dosen.detailkpti-10-pemb', [
                'pendaftaran_kp' => PendaftaranKP::where('id', $id)->where('prodi_id', '1')->get(),
            ]);
        }
        if (auth()->user()->role_id == 3) {            
            return view('pendaftaran.dosen.detailkpti-10-pemb', [
                'pendaftaran_kp' => PendaftaranKP::where('id', $id)->where('prodi_id', '2')->get(),
            ]);
        }
        if (auth()->user()->role_id == 4) {  
            
            return view('pendaftaran.dosen.detailkpti-10-pemb', [
                'pendaftaran_kp' =>  PendaftaranKP::where('id', $id)->where('prodi_id', '3')->get(),
            ]);
        } 
        //DOSEN
        if (auth()->user()->nip >0) {  
            return view('pendaftaran.dosen.detailkpti-10-pemb', [
                'pendaftaran_kp' => PendaftaranKP::where('id', $id)->where('dosen_pembimbing_nip', Auth::user()->nip)->get(),
            ]);
        } 
    }
    public function detailbalasan_pembimbing ($id)
    {
        
        //ADMIN
        if (auth()->user()->role_id == 1) {     
            return view('pendaftaran.dosen.detailbalasan-pemb', [
                'pendaftaran_kp' => PendaftaranKP::where('id', $id)->get(),
            ]);
        } 
       
        if (auth()->user()->role_id == 2) {            
            return view('pendaftaran.dosen.detailbalasan-pemb', [
                'pendaftaran_kp' => PendaftaranKP::where('id', $id)->where('prodi_id', '1')->get(),
            ]);
        }
        if (auth()->user()->role_id == 3) {            
            return view('pendaftaran.dosen.detailbalasan-pemb', [
                'pendaftaran_kp' => PendaftaranKP::where('id', $id)->where('prodi_id', '2')->get(),
            ]);
        }
        if (auth()->user()->role_id == 4) {  
            
            return view('pendaftaran.dosen.detailbalasan-pemb', [
                'pendaftaran_kp' =>  PendaftaranKP::where('id', $id)->where('prodi_id', '3')->get(),
            ]);
        } 
        //DOSEN
        if (auth()->user()->nip >0) {  
            return view('pendaftaran.dosen.detailbalasan-pemb', [
                'pendaftaran_kp' => PendaftaranKP::where('id', $id)->where('dosen_pembimbing_nip', Auth::user()->nip)->get(),
            ]);
        } 
    }


    public function detail_persetujuan_kpti10_admin ($id)
    {
        //ADMIN
        
        // if (auth()->user()->role_id == 1) {     
        //     return view('pendaftaran.admin.detail-persetujuan-usulankp', [
        //         'pendaftaran_kp' => PendaftaranKP::where('id', $id)->get(),
        //     ]);
        // } 
       
        if (auth()->user()->role_id == 2) {            
            return view('pendaftaran.admin.detail-persetujuan-kpti-10', [
                'pendaftaran_kp' => PendaftaranKP::where('id', $id)->where('prodi_id', '1')->get(),
            ]);
        }
        if (auth()->user()->role_id == 3) {            
            return view('pendaftaran.admin.detail-persetujuan-kpti-10', [
                'pendaftaran_kp' => PendaftaranKP::where('id', $id)->where('prodi_id', '2')->get(),
            ]);
        }
        if (auth()->user()->role_id == 4) {  
            
            return view('pendaftaran.admin.detail-persetujuan-kpti-10', [
                'pendaftaran_kp' =>  PendaftaranKP::where('id', $id)->where('prodi_id', '3')->get(),
            ]);
        } 
    }
    public function detail_persetujuan_usulanjudul_admin ($id)
    {
        //ADMIN
        
        // if (auth()->user()->role_id == 1) {     
        //     return view('pendaftaran.admin.detail-persetujuan-usulankp', [
        //         'pendaftaran_kp' => PendaftaranKP::where('id', $id)->get(),
        //     ]);
        // } 
       
        if (auth()->user()->role_id == 2) {            
            return view('pendaftaran.admin.detail-persetujuan-usuljudul', [
                'pendaftaran_skripsi' => PendaftaranSkripsi::where('id', $id)->where('prodi_id', '1')->get(),
            ]);
        }
        if (auth()->user()->role_id == 3) {            
            return view('pendaftaran.admin.detail-persetujuan-usuljudul', [
                'pendaftaran_skripsi' => PendaftaranSkripsi::where('id', $id)->where('prodi_id', '2')->get(),
            ]);
        }
        if (auth()->user()->role_id == 4) {  
            
            return view('pendaftaran.admin.detail-persetujuan-usuljudul', [
                'pendaftaran_skripsi' =>  PendaftaranSkripsi::where('id', $id)->where('prodi_id', '3')->get(),
            ]);
        } 
    }
    public function detail_persetujuan_sempro_admin ($id)
    {
        //ADMIN
        
        // if (auth()->user()->role_id == 1) {     
        //     return view('pendaftaran.admin.detail-persetujuan-usulankp', [
        //         'pendaftaran_kp' => PendaftaranKP::where('id', $id)->get(),
        //     ]);
        // } 
       
        if (auth()->user()->role_id == 2) {            
            return view('pendaftaran.admin.detail-persetujuan-sempro', [
                'pendaftaran_skripsi' => PendaftaranSkripsi::where('id', $id)->where('prodi_id', '1')->get(),
            ]);
        }
        if (auth()->user()->role_id == 3) {            
            return view('pendaftaran.admin.detail-persetujuan-sempro', [
                'pendaftaran_skripsi' => PendaftaranSkripsi::where('id', $id)->where('prodi_id', '2')->get(),
            ]);
        }
        if (auth()->user()->role_id == 4) {  
            
            return view('pendaftaran.admin.detail-persetujuan-sempro', [
                'pendaftaran_skripsi' =>  PendaftaranSkripsi::where('id', $id)->where('prodi_id', '3')->get(),
            ]);
        } 
    }
    public function detail_persetujuan_sidang_admin ($id)
    {
        if (auth()->user()->role_id == 2) {            
            return view('pendaftaran.admin.detail-persetujuan-sidang', [
                'pendaftaran_skripsi' => PendaftaranSkripsi::where('id', $id)->where('prodi_id', '1')->get(),
            ]);
        }
        if (auth()->user()->role_id == 3) {            
            return view('pendaftaran.admin.detail-persetujuan-sidang', [
                'pendaftaran_skripsi' => PendaftaranSkripsi::where('id', $id)->where('prodi_id', '2')->get(),
            ]);
        }
        if (auth()->user()->role_id == 4) {  
            
            return view('pendaftaran.admin.detail-persetujuan-sidang', [
                'pendaftaran_skripsi' =>  PendaftaranSkripsi::where('id', $id)->where('prodi_id', '3')->get(),
            ]);
        } 
    }
    public function detail_perpanjangan_1_admin ($id)
    {
        if (auth()->user()->role_id == 2) {            
            return view('pendaftaran.admin.detail-perpanjangan-1', [
                'pendaftaran_skripsi' => PendaftaranSkripsi::where('id', $id)->where('prodi_id', '1')->get(),
            ]);
        }
        if (auth()->user()->role_id == 3) {            
            return view('pendaftaran.admin.detail-perpanjangan-1', [
                'pendaftaran_skripsi' => PendaftaranSkripsi::where('id', $id)->where('prodi_id', '2')->get(),
            ]);
        }
        if (auth()->user()->role_id == 4) {  
            
            return view('pendaftaran.admin.detail-perpanjangan-1', [
                'pendaftaran_skripsi' =>  PendaftaranSkripsi::where('id', $id)->where('prodi_id', '3')->get(),
            ]);
        } 
    }
    public function detail_perpanjangan_2_admin ($id)
    {
        if (auth()->user()->role_id == 2) {            
            return view('pendaftaran.admin.detail-perpanjangan-2', [
                'pendaftaran_skripsi' => PendaftaranSkripsi::where('id', $id)->where('prodi_id', '1')->get(),
            ]);
        }
        if (auth()->user()->role_id == 3) {            
            return view('pendaftaran.admin.detail-perpanjangan-2', [
                'pendaftaran_skripsi' => PendaftaranSkripsi::where('id', $id)->where('prodi_id', '2')->get(),
            ]);
        }
        if (auth()->user()->role_id == 4) {  
            
            return view('pendaftaran.admin.detail-perpanjangan-2', [
                'pendaftaran_skripsi' =>  PendaftaranSkripsi::where('id', $id)->where('prodi_id', '3')->get(),
            ]);
        } 
    }




    public function detailpermohonankp_pembimbing($id)
    
    {
        return view('pendaftaran.dosen.detailpermohonankp-pemb', [
            'pendaftaran_kp' => PendaftaranKP::where('id', $id)->where('dosen_pembimbing_nip', Auth::user()->nip)->get(),
        ]);

    }
    public function detailusulan_semkp_pembimbing($id)
    
    {
        return view('pendaftaran.dosen.detailusulan-semkp-pemb', [
            'pendaftaran_kp' => PendaftaranKP::where('id', $id)->where('dosen_pembimbing_nip', Auth::user()->nip)->get(),
        ]);

    }

    //ADMIN PRODI

    public function pendaftaran_kp_admin ()
    {
        
        if (auth()->user()->role_id == 1) {            
            return view('pendaftaran.admin.kerja-praktek', [
                'pendaftaran_kp' => PendaftaranKP::where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->orderBy('updated_at', 'desc')->get(),
            ]);
        }
        if (auth()->user()->role_id == 2) {            
            return view('pendaftaran.admin.kerja-praktek', [
                'pendaftaran_kp' => PendaftaranKP::where('prodi_id', '1')->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->orderBy('updated_at', 'desc')->get(),
            ]);
        }
        if (auth()->user()->role_id == 3) {            
            return view('pendaftaran.admin.kerja-praktek', [
                'pendaftaran_kp' => PendaftaranKP::where('prodi_id', '2')->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->orderBy('updated_at', 'desc')->get(),
            ]);
        }  

        if (auth()->user()->role_id == 4) {            
            return view('pendaftaran.admin.kerja-praktek', [
                'pendaftaran_kp' => PendaftaranKP::where('prodi_id', '3')->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->orderBy('updated_at', 'desc')->get(),
            ]);
        } 
    }
    
    public function pendaftaran_sempro_admin ()
    {
        
        if (auth()->user()->role_id == 1) {            
            return view('pendaftaran.admin.sempro', [
                'pendaftaran_skripsi' => PendaftaranSkripsi::where('status_skripsi', 'SEMPRO DISETUJUI')->get()->sortBy('update_at'),
            ]);
        }
        if (auth()->user()->role_id == 2) {            
            return view('pendaftaran.admin.sempro', [
                'pendaftaran_skripsi' => PendaftaranSkripsi::where('prodi_id', '1')->where('status_skripsi', 'SEMPRO DISETUJUI')->get()->sortBy('update_at'),
            ]);
        }
        if (auth()->user()->role_id == 3) {            
            return view('pendaftaran.admin.sempro', [
                'pendaftaran_skripsi' => PendaftaranSkripsi::where('prodi_id', '2')->where('status_skripsi', 'SEMPRO DISETUJUI')->get()->sortBy('update_at'),
            ]);
        }  

        if (auth()->user()->role_id == 4) {            
            return view('pendaftaran.admin.sempro', [
                'pendaftaran_skripsi' => PendaftaranSkripsi::where('prodi_id', '3')->where('status_skripsi', 'SEMPRO DISETUJUI')->get()->sortBy('update_at'),
            ]);
        } 
    }
    public function pendaftaran_sidang_admin ()
    {
        
        if (auth()->user()->role_id == 1) {            
            return view('pendaftaran.admin.skripsi', [
                'pendaftaran_skripsi' => PendaftaranSkripsi::where('status_skripsi','<>', 'USULAN JUDUL DITOLAK')->where('status_skripsi','<>', 'USULKAN JUDUL ULANG')->where('status_skripsi','<>', 'LULUS')->orderBy('updated_at', 'desc')->get(),
            ]);
        }
        if (auth()->user()->role_id == 2) {            
            return view('pendaftaran.admin.skripsi', [
                'pendaftaran_skripsi' => PendaftaranSkripsi::where('prodi_id', '1')->where('status_skripsi','<>', 'USULAN JUDUL DITOLAK')->where('status_skripsi','<>', 'USULKAN JUDUL ULANG')->where('status_skripsi','<>', 'LULUS')->orderBy('updated_at', 'desc')->get(),
            ]);
        }
        if (auth()->user()->role_id == 3) {            
            return view('pendaftaran.admin.skripsi', [
                'pendaftaran_skripsi' => PendaftaranSkripsi::where('prodi_id', '2')->where('status_skripsi','<>', 'USULAN JUDUL DITOLAK')->where('status_skripsi','<>', 'USULKAN JUDUL ULANG')->where('status_skripsi','<>', 'LULUS')->orderBy('updated_at', 'desc')->get(),
            ]);
        }  

        if (auth()->user()->role_id == 4) {            
            return view('pendaftaran.admin.skripsi', [
                'pendaftaran_skripsi' => PendaftaranSkripsi::where('prodi_id', '3')->where('status_skripsi','<>', 'USULAN JUDUL DITOLAK')->where('status_skripsi','<>', 'USULKAN JUDUL ULANG')->where('status_skripsi','<>', 'LULUS')->orderBy('updated_at', 'desc')->get(),
            ]);
        } 
    }
    public function persetujuan_admin ()
    {
        
        // if (auth()->user()->role_id == 1) {            
        //     return view('pendaftaran.admin.persetujuan', [
        //         'pendaftaran_kp' => PendaftaranKP::where('status_kp', 'DAFTAR SIDANG DISETUJUI')->get()->sortBy('update_at'),
        //     ]);
        // }Menunggu Jadwal Seminar KP
        if (auth()->user()->role_id == 2) {            
            return view('pendaftaran.admin.persetujuan', [
                'pendaftaran_kp' => PendaftaranKP::where('keterangan', 'Menunggu persetujuan Admin Prodi')->where('prodi_id', '1')
                ->orWhere('keterangan', 'Menunggu Jadwal Seminar KP')->where('prodi_id', '1')
                ->get()->sortBy('update_at'),

                 'pendaftaran_skripsi' => PendaftaranSkripsi::where('keterangan', 'Menunggu persetujuan Admin Prodi')->where('prodi_id', '1')->get()->sortBy('update_at'),
            ]);
        }
        if (auth()->user()->role_id == 3) {            
            return view('pendaftaran.admin.persetujuan', [
                'pendaftaran_kp' => PendaftaranKP::where('prodi_id', '2')->where('keterangan', 'Menunggu persetujuan Admin Prodi')
                ->orWhere('keterangan', 'Menunggu Jadwal Seminar KP')->where('prodi_id', '2')->get()->sortBy('update_at'),

                 'pendaftaran_skripsi' => PendaftaranSkripsi::where('keterangan', 'Menunggu persetujuan Admin Prodi')->where('prodi_id', '2')->get()->sortBy('update_at'),
            ]);
        }  

        if (auth()->user()->role_id == 4) {            
            return view('pendaftaran.admin.persetujuan', [
                'pendaftaran_kp' => PendaftaranKP::where('keterangan', 'Menunggu persetujuan Admin Prodi')->where('prodi_id', '3')
                ->orWhere('keterangan', 'Menunggu Jadwal Seminar KP')->where('prodi_id', '3')->get()->sortBy('update_at'),

                'pendaftaran_skripsi' => PendaftaranSkripsi::where('keterangan', 'Menunggu persetujuan Admin Prodi')->where('prodi_id', '3')->get()->sortBy('update_at'),
            ]);
        } 
    }


    
    public function detailusuljudul_pembimbing ($id)
    {
        //ADMIN
        if (auth()->user()->role_id == 1) {     
            return view('pendaftaran.dosen.detailusuljudul-pemb', [
                'pendaftaran_skripsi' => PendaftaranSkripsi::where('id', $id)->get(),
            ]);
        } 
       
        if (auth()->user()->role_id == 2) {            
            return view('pendaftaran.dosen.detailusuljudul-pemb', [
                'pendaftaran_skripsi' => PendaftaranSkripsi::where('id', $id)->where('prodi_id', '1')->get(),
            ]);
        }
        if (auth()->user()->role_id == 3) {            
            return view('pendaftaran.dosen.detailusuljudul-pemb', [
                'pendaftaran_skripsi' => PendaftaranSkripsi::where('id', $id)->where('prodi_id', '2')->get(),
            ]);
        }
        if (auth()->user()->role_id == 4) {  
            
            return view('pendaftaran.dosen.detailusuljudul-pemb', [
                'pendaftaran_skripsi' => PendaftaranSkripsi::where('id', $id)->where('prodi_id', '3')->get(),
            ]);
        } 
        //DOSEN
        if (auth()->user()->nip >0) {  
            return view('pendaftaran.dosen.detailusuljudul-pemb', [
            'pendaftaran_skripsi' => PendaftaranSkripsi::where('id', $id)->where('pembimbing_1_nip', Auth::user()->nip)
            ->orWhere('pembimbing_2_nip', Auth::user()->nip)->where('id', $id)->get(),
        ]);
        } 

    }
    public function detailsempro_pemb ($id)
    {
         if (auth()->user()->role_id == 1) {     
            return view('pendaftaran.dosen.detaildaftarsempro-pemb', [
                'pendaftaran_skripsi' => PendaftaranSkripsi::where('id', $id)->get(),
            ]);
        } 
       
        if (auth()->user()->role_id == 2) {            
            return view('pendaftaran.dosen.detaildaftarsempro-pemb', [
                'pendaftaran_skripsi' => PendaftaranSkripsi::where('id', $id)->where('prodi_id', '1')->get(),
            ]);
        }
        if (auth()->user()->role_id == 3) {            
            return view('pendaftaran.dosen.detaildaftarsempro-pemb', [
                'pendaftaran_skripsi' => PendaftaranSkripsi::where('id', $id)->where('prodi_id', '2')->get(),
            ]);
        }
        if (auth()->user()->role_id == 4) {  
            
            return view('pendaftaran.dosen.detaildaftarsempro-pemb', [
                'pendaftaran_skripsi' => PendaftaranSkripsi::where('id', $id)->where('prodi_id', '3')->get(),
            ]);
        } 
        //DOSEN
        if (auth()->user()->nip >0) {  
            return view('pendaftaran.dosen.detaildaftarsempro-pemb', [
            'pendaftaran_skripsi' => PendaftaranSkripsi::where('id', $id)->where('pembimbing_1_nip', Auth::user()->nip)
            ->orWhere('pembimbing_2_nip', Auth::user()->nip)->where('id', $id)->get(),
        ]);
        } 
        return view('pendaftaran.dosen.detaildaftarsempro-pemb', [
            'pendaftaran_skripsi' => PendaftaranSkripsi::where('id', $id)->where('pembimbing_1_nip', Auth::user()->nip)->orWhere('pembimbing_2_nip', Auth::user()->nip)->where('id', $id)->get(),
        ]);

    }
    public function detailsidang_pemb ($id)
    {
         if (auth()->user()->role_id == 1) {     
            return view('pendaftaran.dosen.detaildaftarsidang-pemb', [
                'pendaftaran_skripsi' => PendaftaranSkripsi::where('id', $id)->get(),
            ]);
        } 
       
        if (auth()->user()->role_id == 2) {            
            return view('pendaftaran.dosen.detaildaftarsidang-pemb', [
                'pendaftaran_skripsi' => PendaftaranSkripsi::where('id', $id)->where('prodi_id', '1')->get(),
            ]);
        }
        if (auth()->user()->role_id == 3) {            
            return view('pendaftaran.dosen.detaildaftarsidang-pemb', [
                'pendaftaran_skripsi' => PendaftaranSkripsi::where('id', $id)->where('prodi_id', '2')->get(),
            ]);
        }
        if (auth()->user()->role_id == 4) {  
            
            return view('pendaftaran.dosen.detaildaftarsidang-pemb', [
                'pendaftaran_skripsi' => PendaftaranSkripsi::where('id', $id)->where('prodi_id', '3')->get(),
            ]);
        } 
        //DOSEN
        if (auth()->user()->nip >0) {  
            return view('pendaftaran.dosen.detaildaftarsidang-pemb', [
            'pendaftaran_skripsi' => PendaftaranSkripsi::where('id', $id)->where('pembimbing_1_nip', Auth::user()->nip)
            ->orWhere('pembimbing_2_nip', Auth::user()->nip)->where('id', $id)->get(),
        ]);
        } 


    }

    public function pendaftaran_kp ()
    {
        if (auth()->user()->role_id == 5 ) {            
            return view('pendaftaran.dosen.indexkp', [
                'pendaftaran_kp' => PendaftaranKP::where('keterangan','<>', 'Nilai KP Telah Keluar')->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->orderBy('status_kp', 'desc')->get(),

                'jml_persetujuankp' =>  PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Seminar KP Dijadwalkan')
                ->orderBy('status_kp', 'desc')->get(),

                'jml_bimbingankp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->where('keterangan','<>', 'Nilai KP Telah Keluar')->orderBy('status_kp', 'desc')->get(),

               'jml_seminarkp' => PenjadwalanKP::where('penguji_nip', Auth::user()->nip)->where('status_seminar', 0)->orWhere('pembimbing_nip', Auth::user()->nip)->where('status_seminar', 0)->get(),
            ]);
        }
        if (auth()->user()->role_id == 6) {            
            return view('pendaftaran.dosen.indexkp', [
                'pendaftaran_kp' => PendaftaranKP::where('prodi_id', '1')->where('keterangan','<>', 'Nilai KP Telah Keluar')->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->orderBy('status_kp', 'desc')->get(),

                'jml_persetujuankp' =>  PendaftaranKP::where('prodi_id', '1')->where('keterangan', 'Menunggu persetujuan Koordinator Program Studi')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Seminar KP Dijadwalkan')
                ->orderBy('status_kp', 'desc')->get(),

                'jml_bimbingankp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->where('keterangan','<>', 'Nilai KP Telah Keluar')->orderBy('status_kp', 'desc')->get(),

               'jml_seminarkp' => PenjadwalanKP::where('penguji_nip', Auth::user()->nip)->where('status_seminar', 0)->orWhere('pembimbing_nip', Auth::user()->nip)->where('status_seminar', 0)->get(),
            ]);
        }
        if (auth()->user()->role_id == 7) {            
            return view('pendaftaran.dosen.indexkp', [
                'pendaftaran_kp' => PendaftaranKP::where('prodi_id', '2')->where('keterangan','<>', 'Nilai KP Telah Keluar')->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->orderBy('status_kp', 'desc')->get(),

                'jml_persetujuankp' =>  PendaftaranKP::where('prodi_id', '2')->where('keterangan', 'Menunggu persetujuan Koordinator Program Studi')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Seminar KP Dijadwalkan')
                ->orderBy('status_kp', 'desc')->get(),

                'jml_bimbingankp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->where('keterangan','<>', 'Nilai KP Telah Keluar')->orderBy('status_kp', 'desc')->get(),

               'jml_seminarkp' => PenjadwalanKP::where('penguji_nip', Auth::user()->nip)->where('status_seminar', 0)->orWhere('pembimbing_nip', Auth::user()->nip)->where('status_seminar', 0)->get(),
            ]);
        }
        if (auth()->user()->role_id == 8) {            
            return view('pendaftaran.dosen.indexkp', [
                'pendaftaran_kp' => PendaftaranKP::where('prodi_id', '3')->where('keterangan','<>', 'Nilai KP Telah Keluar')->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->orderBy('status_kp', 'desc')->get(),

                'jml_persetujuankp' =>  PendaftaranKP::where('prodi_id', '3')->where('keterangan', 'Menunggu persetujuan Koordinator Program Studi')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Seminar KP Dijadwalkan')
                ->orderBy('status_kp', 'desc')->get(),

                'jml_bimbingankp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->where('keterangan','<>', 'Nilai KP Telah Keluar')->orderBy('status_kp', 'desc')->get(),

               'jml_seminarkp' => PenjadwalanKP::where('penguji_nip', Auth::user()->nip)->where('status_seminar', 0)->orWhere('pembimbing_nip', Auth::user()->nip)->where('status_seminar', 0)->get(),
            ]);
        }  

        if (auth()->user()->role_id == 9) {            
            return view('pendaftaran.dosen.indexkp', [
                'pendaftaran_kp' => PendaftaranKP::where('prodi_id', '1')->where('keterangan','<>', 'Nilai KP Telah Keluar')->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->orderBy('status_kp', 'desc')->get(),

                'jml_persetujuankp' => PendaftaranKP::where('prodi_id', '1')->where('keterangan', 'Menunggu persetujuan Koordinator KP')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Seminar KP Dijadwalkan')
                ->orWhere('prodi_id', '1')->where('keterangan', 'Proses Kerja Praktek Selesai')
                ->orWhere('prodi_id', '2')->where('status_kp', 'DAFTAR SEMINAR KP')->where('keterangan', 'Menunggu Jadwal Seminar KP')
                ->orderBy('status_kp', 'desc')->get(),

                'jml_bimbingankp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->where('keterangan','<>', 'Nilai KP Telah Keluar')->orderBy('status_kp', 'desc')->get(),

               'jml_seminarkp' => PenjadwalanKP::where('penguji_nip', Auth::user()->nip)->where('status_seminar', 0)->orWhere('pembimbing_nip', Auth::user()->nip)->where('status_seminar', 0)->get(),
            ]);
        }
        if (auth()->user()->role_id == 10) {            
            return view('pendaftaran.dosen.indexkp', [
                'pendaftaran_kp' => PendaftaranKP::where('prodi_id', '2')->where('keterangan','<>', 'Nilai KP Telah Keluar')->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->orderBy('status_kp', 'desc')->get(),

                'jml_persetujuankp' => PendaftaranKP::where('prodi_id', '2')->where('keterangan', 'Menunggu persetujuan Koordinator KP')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Seminar KP Dijadwalkan')
                ->orWhere('prodi_id', '2')->where('keterangan', 'Proses Kerja Praktek Selesai')
                ->orWhere('prodi_id', '2')->where('status_kp', 'DAFTAR SEMINAR KP')->where('keterangan', 'Menunggu Jadwal Seminar KP')
                ->orderBy('status_kp', 'desc')->get(),

                'jml_bimbingankp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->where('keterangan','<>', 'Nilai KP Telah Keluar')->orderBy('status_kp', 'desc')->get(),

               'jml_seminarkp' => PenjadwalanKP::where('penguji_nip', Auth::user()->nip)->where('status_seminar', 0)->orWhere('pembimbing_nip', Auth::user()->nip)->where('status_seminar', 0)->get(),
            ]);
        }
        if (auth()->user()->role_id == 11) {            
            return view('pendaftaran.dosen.indexkp', [
                'pendaftaran_kp' => PendaftaranKP::where('prodi_id', '3')->where('keterangan','<>', 'Nilai KP Telah Keluar')->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->orderBy('status_kp', 'desc')->get(),

                'jml_persetujuankp' => PendaftaranKP::where('prodi_id', '3')->where('keterangan', 'Menunggu persetujuan Koordinator KP')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Seminar KP Dijadwalkan')
                ->orWhere('prodi_id', '3')->where('keterangan', 'Proses Kerja Praktek Selesai')
                ->orWhere('prodi_id', '3')->where('status_kp', 'DAFTAR SEMINAR KP')->where('keterangan', 'Menunggu Jadwal Seminar KP')
                ->orderBy('status_kp', 'desc')->get(),

                'jml_bimbingankp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->where('keterangan','<>', 'Nilai KP Telah Keluar')->orderBy('status_kp', 'desc')->get(),

               'jml_seminarkp' => PenjadwalanKP::where('penguji_nip', Auth::user()->nip)->where('status_seminar', 0)->orWhere('pembimbing_nip', Auth::user()->nip)->where('status_seminar', 0)->get(),

            ]);
        }   
    }


    public function riwayat_prodi ()
    {
        if (auth()->user()->role_id == 1) {     
            return view('pendaftaran.dosen.riwayat-prodi', [
                'pendaftaran_kp' => PendaftaranKP::where('keterangan', 'Nilai KP Telah Keluar')->orderBy('updated_at', 'desc')->get(),

                'pendaftaran_skripsi' => PendaftaranSkripsi::all(),

                'penjadwalan_kps' => PenjadwalanKP::all(),
               'penjadwalan_sempros' => PenjadwalanSempro::all(),
               'penjadwalan_skripsis' => PenjadwalanSkripsi::all(),

               'penjadwalan_skripsis_draf' => PenjadwalanSkripsi::all(),
            'penjadwalan_skripsis_draff' => PenjadwalanSkripsi::all(),


            'jml_persetujuankp' => PendaftaranKP::where('keterangan', 'Menunggu persetujuan Koordinator Program Studi')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Seminar KP Dijadwalkan')
                ->orderBy('status_kp', 'desc')->get(),

                'jml_prodikp' => PendaftaranKP::where('keterangan','<>', 'Nilai KP Telah Keluar')->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->orderBy('status_kp', 'desc')->get(),

                'jml_bimbingankp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->where('keterangan','<>', 'Nilai KP Telah Keluar')->orderBy('status_kp', 'desc')->get(),

                'jml_seminarkp' => PenjadwalanKP::where('penguji_nip', Auth::user()->nip)->where('status_seminar', 0)->orWhere('pembimbing_nip', Auth::user()->nip)->where('status_seminar', 0)->get(),
                
            ]);
        } 
       
        if (auth()->user()->role_id == 2) {            
            return view('pendaftaran.dosen.riwayat-prodi', [
                'pendaftaran_kp' => PendaftaranKP::where('prodi_id', '1')->where('keterangan', 'Nilai KP Telah Keluar')->orderBy('updated_at', 'desc')->get(),

                 'pendaftaran_skripsi' => PendaftaranSkripsi::where('prodi_id', '1')->where('keterangan', 'Nilai Skripsi Telah Keluar')->orderBy('updated_at', 'desc')->get(),

                'penjadwalan_kps' => PenjadwalanKP::where('prodi_id', '1')->where('status_seminar', 1)->get(),
               'penjadwalan_sempros' => PenjadwalanSempro::where('prodi_id', '1')->where('status_seminar', 1)->get(),
               'penjadwalan_skripsis' => PenjadwalanSkripsi::where('prodi_id', '1')->where('status_seminar', 3)->get(),

               'penjadwalan_skripsis_draf' => PenjadwalanSkripsi::where('prodi_id', '1')->where('status_seminar', 1)->get(),
            'penjadwalan_skripsis_draff' => PenjadwalanSkripsi::where('prodi_id', '1')->where('status_seminar', 2)->get(),


            'jml_persetujuankp' => PendaftaranKP::where('prodi_id', '1')->where('keterangan', 'Menunggu persetujuan Koordinator Program Studi')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Seminar KP Dijadwalkan')
                ->orderBy('status_kp', 'desc')->get(),

                'jml_prodikp' => PendaftaranKP::where('prodi_id', '1')->where('keterangan','<>', 'Nilai KP Telah Keluar')->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->orderBy('status_kp', 'desc')->get(),

                'jml_bimbingankp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->where('keterangan','<>', 'Nilai KP Telah Keluar')->orderBy('status_kp', 'desc')->get(),

                'jml_seminarkp' => PenjadwalanKP::where('penguji_nip', Auth::user()->nip)->where('status_seminar', 0)->orWhere('pembimbing_nip', Auth::user()->nip)->where('status_seminar', 0)->get(),
            ]);
        }
        if (auth()->user()->role_id == 3) {            
            return view('pendaftaran.dosen.riwayat-prodi', [
                'pendaftaran_kp' => PendaftaranKP::where('prodi_id', '2')->where('keterangan', 'Nilai KP Telah Keluar')->orderBy('updated_at', 'desc')->get(),

                 'pendaftaran_skripsi' => PendaftaranSkripsi::where('prodi_id', '2')->where('keterangan', 'Nilai Skripsi Telah Keluar')->orderBy('updated_at', 'desc')->get(),

                'penjadwalan_kps' => PenjadwalanKP::where('prodi_id', '2')->where('status_seminar', 1)->get(),
               'penjadwalan_sempros' => PenjadwalanSempro::where('prodi_id', '2')->where('status_seminar', 1)->get(),
               'penjadwalan_skripsis' => PenjadwalanSkripsi::where('prodi_id', '2')->where('status_seminar', 3)->get(),

               'penjadwalan_skripsis_draf' => PenjadwalanSkripsi::where('prodi_id', '2')->where('status_seminar', 1)->get(),
            'penjadwalan_skripsis_draff' => PenjadwalanSkripsi::where('prodi_id', '2')->where('status_seminar', 2)->get(),

            'jml_persetujuankp' => PendaftaranKP::where('prodi_id', '2')->where('keterangan', 'Menunggu persetujuan Koordinator Program Studi')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Seminar KP Dijadwalkan')
                ->orderBy('status_kp', 'desc')->get(),

                'jml_prodikp' => PendaftaranKP::where('prodi_id', '2')->where('keterangan','<>', 'Nilai KP Telah Keluar')->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->orderBy('status_kp', 'desc')->get(),

                'jml_bimbingankp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->where('keterangan','<>', 'Nilai KP Telah Keluar')->orderBy('status_kp', 'desc')->get(),

                'jml_seminarkp' => PenjadwalanKP::where('penguji_nip', Auth::user()->nip)->where('status_seminar', 0)->orWhere('pembimbing_nip', Auth::user()->nip)->where('status_seminar', 0)->get(),
            ]);
        }
        if (auth()->user()->role_id == 4) {  
            
            return view('pendaftaran.dosen.riwayat-prodi', [
                'pendaftaran_kp' => PendaftaranKP::where('prodi_id', '3')->where('keterangan', 'Nilai KP Telah Keluar')->orderBy('updated_at', 'desc')->get(),

                 'pendaftaran_skripsi' => PendaftaranSkripsi::where('prodi_id', '3')->where('keterangan', 'Nilai Skripsi Telah Keluar')->orderBy('updated_at', 'desc')->get(),

                'penjadwalan_kps' => PenjadwalanKP::where('prodi_id', '3')->where('status_seminar', 1)->get(),
               'penjadwalan_sempros' => PenjadwalanSempro::where('prodi_id', '3')->where('status_seminar', 1)->get(),
               'penjadwalan_skripsis' => PenjadwalanSkripsi::where('prodi_id', '3')->where('status_seminar', 3)->get(),

               'penjadwalan_skripsis_draf' => PenjadwalanSkripsi::where('prodi_id', '3')->where('status_seminar', 1)->get(),
            'penjadwalan_skripsis_draff' => PenjadwalanSkripsi::where('prodi_id', '3')->where('status_seminar', 2)->get(),

            'jml_persetujuankp' => PendaftaranKP::where('prodi_id', '3')->where('keterangan', 'Menunggu persetujuan Koordinator Program Studi')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Seminar KP Dijadwalkan')
                ->orderBy('status_kp', 'desc')->get(),

                'jml_prodikp' => PendaftaranKP::where('prodi_id', '3')->where('keterangan','<>', 'Nilai KP Telah Keluar')->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->orderBy('status_kp', 'desc')->get(),

                'jml_bimbingankp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->where('keterangan','<>', 'Nilai KP Telah Keluar')->orderBy('status_kp', 'desc')->get(),

                'jml_seminarkp' => PenjadwalanKP::where('penguji_nip', Auth::user()->nip)->where('status_seminar', 0)->orWhere('pembimbing_nip', Auth::user()->nip)->where('status_seminar', 0)->get(),
            ]);
        } 
        if (auth()->user()->role_id == 5 ) {            
            return view('pendaftaran.dosen.riwayat-prodi', [
                'pendaftaran_kp' => PendaftaranKP::all(),

                 'pendaftaran_skripsi' => PendaftaranSkripsi::all(),

                'penjadwalan_kps' => PenjadwalanKP::all(),
               'penjadwalan_sempros' => PenjadwalanSempro::all(),
               'penjadwalan_skripsis' => PenjadwalanSkripsi::all(),

               'penjadwalan_skripsis_draf' => PenjadwalanSkripsi::all(),
            'penjadwalan_skripsis_draff' => PenjadwalanSkripsi::all(),

            'jml_persetujuankp' => PendaftaranKP::where('keterangan', 'Menunggu persetujuan Koordinator Program Studi')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Seminar KP Dijadwalkan')
                ->orderBy('status_kp', 'desc')->get(),

                'jml_prodikp' => PendaftaranKP::where('keterangan','<>', 'Nilai KP Telah Keluar')->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->orderBy('status_kp', 'desc')->get(),

                'jml_bimbingankp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->where('keterangan','<>', 'Nilai KP Telah Keluar')->orderBy('status_kp', 'desc')->get(),

                'jml_seminarkp' => PenjadwalanKP::where('penguji_nip', Auth::user()->nip)->where('status_seminar', 0)->orWhere('pembimbing_nip', Auth::user()->nip)->where('status_seminar', 0)->get(),
            
            ]);
        }
        if (auth()->user()->role_id == 6) {            
            return view('pendaftaran.dosen.riwayat-prodi', [
                'pendaftaran_kp' => PendaftaranKP::where('prodi_id', '1')->where('keterangan', 'Nilai KP Telah Keluar')->orderBy('updated_at', 'desc')->get(),

                'pendaftaran_skripsi' => PendaftaranSkripsi::where('prodi_id', '1')->where('keterangan', 'Nilai Skripsi Telah Keluar')->orderBy('updated_at', 'desc')->get(),

                'penjadwalan_kps' => PenjadwalanKP::where('prodi_id', '1')->where('status_seminar', 1)->get(),
               'penjadwalan_sempros' => PenjadwalanSempro::where('prodi_id', '1')->where('status_seminar', 1)->get(),
               'penjadwalan_skripsis' => PenjadwalanSkripsi::where('prodi_id', '1')->where('status_seminar', 3)->get(),

               'penjadwalan_skripsis_draf' => PenjadwalanSkripsi::where('prodi_id', '1')->where('status_seminar', 1)->get(),
            'penjadwalan_skripsis_draff' => PenjadwalanSkripsi::where('prodi_id', '1')->where('status_seminar', 2)->get(),

                'jml_persetujuankp' => PendaftaranKP::where('prodi_id', '1')->where('keterangan', 'Menunggu persetujuan Koordinator Program Studi')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Seminar KP Dijadwalkan')
                ->orderBy('status_kp', 'desc')->get(),

                'jml_prodikp' => PendaftaranKP::where('prodi_id', '1')->where('keterangan','<>', 'Nilai KP Telah Keluar')->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->orderBy('status_kp', 'desc')->get(),

                'jml_bimbingankp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->where('keterangan','<>', 'Nilai KP Telah Keluar')->orderBy('status_kp', 'desc')->get(),

                'jml_seminarkp' => PenjadwalanKP::where('penguji_nip', Auth::user()->nip)->where('status_seminar', 0)->orWhere('pembimbing_nip', Auth::user()->nip)->where('status_seminar', 0)->get(),

            ]);
        }
        if (auth()->user()->role_id == 7) {            
            return view('pendaftaran.dosen.riwayat-prodi', [
                'pendaftaran_kp' => PendaftaranKP::where('prodi_id', '2')->where('keterangan', 'Nilai KP Telah Keluar')->orderBy('updated_at', 'desc')->get(),

                'pendaftaran_skripsi' => PendaftaranSkripsi::where('prodi_id', '2')->where('keterangan', 'Nilai Skripsi Telah Keluar')->orderBy('updated_at', 'desc')->get(),

                'penjadwalan_kps' => PenjadwalanKP::where('prodi_id', '2')->where('status_seminar', 1)->get(),
               'penjadwalan_sempros' => PenjadwalanSempro::where('prodi_id', '2')->where('status_seminar', 1)->get(),
               'penjadwalan_skripsis' => PenjadwalanSkripsi::where('prodi_id', '2')->where('status_seminar', 3)->get(),

               'penjadwalan_skripsis_draf' => PenjadwalanSkripsi::where('prodi_id', '2')->where('status_seminar', 1)->get(),
            'penjadwalan_skripsis_draff' => PenjadwalanSkripsi::where('prodi_id', '2')->where('status_seminar', 2)->get(),

                'jml_persetujuankp' => PendaftaranKP::where('prodi_id', '2')->where('keterangan', 'Menunggu persetujuan Koordinator Program Studi')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Seminar KP Dijadwalkan')
                ->orderBy('status_kp', 'desc')->get(),

                'jml_prodikp' => PendaftaranKP::where('prodi_id', '2')->where('keterangan','<>', 'Nilai KP Telah Keluar')->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->orderBy('status_kp', 'desc')->get(),

                'jml_bimbingankp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->where('keterangan','<>', 'Nilai KP Telah Keluar')->orderBy('status_kp', 'desc')->get(),

                'jml_seminarkp' => PenjadwalanKP::where('penguji_nip', Auth::user()->nip)->where('status_seminar', 0)->orWhere('pembimbing_nip', Auth::user()->nip)->where('status_seminar', 0)->get(),
            ]);
        }
        if (auth()->user()->role_id == 8) {            
            return view('pendaftaran.dosen.riwayat-prodi', [
                'pendaftaran_kp' => PendaftaranKP::where('prodi_id', '3')->where('keterangan', 'Nilai KP Telah Keluar')->orderBy('updated_at', 'desc')->get(),

                'pendaftaran_skripsi' => PendaftaranSkripsi::where('prodi_id', '3')->where('keterangan', 'Nilai Skripsi Telah Keluar')->orderBy('updated_at', 'desc')->get(),

                'penjadwalan_kps' => PenjadwalanKP::where('prodi_id', '3')->where('status_seminar', 1)->get(),
               'penjadwalan_sempros' => PenjadwalanSempro::where('prodi_id', '3')->where('status_seminar', 1)->get(),
               'penjadwalan_skripsis' => PenjadwalanSkripsi::where('prodi_id', '3')->where('status_seminar', 3)->get(),

               'penjadwalan_skripsis_draf' => PenjadwalanSkripsi::where('prodi_id', '3')->where('status_seminar', 1)->get(),
            'penjadwalan_skripsis_draff' => PenjadwalanSkripsi::where('prodi_id', '3')->where('status_seminar', 2)->get(),

                'jml_persetujuankp' => PendaftaranKP::where('prodi_id', '3')->where('keterangan', 'Menunggu persetujuan Koordinator Program Studi')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Seminar KP Dijadwalkan')
                ->orderBy('status_kp', 'desc')->get(),

                'jml_prodikp' => PendaftaranKP::where('prodi_id', '3')->where('keterangan','<>', 'Nilai KP Telah Keluar')->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->orderBy('status_kp', 'desc')->get(),

                'jml_bimbingankp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->where('keterangan','<>', 'Nilai KP Telah Keluar')->orderBy('status_kp', 'desc')->get(),

                'jml_seminarkp' => PenjadwalanKP::where('penguji_nip', Auth::user()->nip)->where('status_seminar', 0)->orWhere('pembimbing_nip', Auth::user()->nip)->where('status_seminar', 0)->get(),
            ]);
        }  

        if (auth()->user()->role_id == 9) {            
            return view('pendaftaran.dosen.riwayat-prodi', [
                'pendaftaran_kp' => PendaftaranKP::where('prodi_id', '1')->where('keterangan', 'Nilai KP Telah Keluar')->orderBy('updated_at', 'desc')->get(),

                 'pendaftaran_skripsi' => PendaftaranSkripsi::where('prodi_id', '1')->where('keterangan', 'Nilai Skripsi Telah Keluar')->orderBy('updated_at', 'desc')->get(),

                 'penjadwalan_kps' => PenjadwalanKP::where('prodi_id', '1')->where('status_seminar', 1)->get(),
               'penjadwalan_sempros' => PenjadwalanSempro::where('prodi_id', '1')->where('status_seminar', 1)->get(),
               'penjadwalan_skripsis' => PenjadwalanSkripsi::where('prodi_id', '1')->where('status_seminar', 3)->get(),

               'penjadwalan_skripsis_draf' => PenjadwalanSkripsi::where('prodi_id', '1')->where('status_seminar', 1)->get(),
            'penjadwalan_skripsis_draff' => PenjadwalanSkripsi::where('prodi_id', '1')->where('status_seminar', 2)->get(),

                'jml_persetujuankp' => PendaftaranKP::where('prodi_id', '1')->where('keterangan', 'Menunggu persetujuan Koordinator KP')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Seminar KP Dijadwalkan')
                ->orWhere('prodi_id', '1')->where('keterangan', 'Proses Kerja Praktek Selesai')
                ->orWhere('prodi_id', '1')->where('status_kp', 'DAFTAR SEMINAR KP')->where('keterangan', 'Menunggu Jadwal Seminar KP')
                ->orderBy('status_kp', 'desc')->get(),

                'jml_prodikp' => PendaftaranKP::where('prodi_id', '1')->where('keterangan','<>', 'Nilai KP Telah Keluar')->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->orderBy('status_kp', 'desc')->get(),

                'jml_bimbingankp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->where('keterangan','<>', 'Nilai KP Telah Keluar')->orderBy('status_kp', 'desc')->get(),

                'jml_seminarkp' => PenjadwalanKP::where('penguji_nip', Auth::user()->nip)->where('status_seminar', 0)->orWhere('pembimbing_nip', Auth::user()->nip)->where('status_seminar', 0)->get(),
            ]);
        }
        if (auth()->user()->role_id == 10) {            
            return view('pendaftaran.dosen.riwayat-prodi', [
                'pendaftaran_kp' => PendaftaranKP::where('prodi_id', '2')->where('keterangan', 'Nilai KP Telah Keluar')->orderBy('updated_at', 'desc')->get(),

                 'pendaftaran_skripsi' => PendaftaranSkripsi::where('prodi_id', '2')->where('keterangan', 'Nilai Skripsi Telah Keluar')->orderBy('updated_at', 'desc')->get(),

                 'penjadwalan_kps' => PenjadwalanKP::where('prodi_id', '2')->where('status_seminar', 1)->get(),
               'penjadwalan_sempros' => PenjadwalanSempro::where('prodi_id', '2')->where('status_seminar', 1)->get(),
               'penjadwalan_skripsis' => PenjadwalanSkripsi::where('prodi_id', '2')->where('status_seminar', 3)->get(),

               'penjadwalan_skripsis_draf' => PenjadwalanSkripsi::where('prodi_id', '2')->where('status_seminar', 1)->get(),
            'penjadwalan_skripsis_draff' => PenjadwalanSkripsi::where('prodi_id', '2')->where('status_seminar', 2)->get(),

                'jml_persetujuankp' => PendaftaranKP::where('prodi_id', '2')->where('keterangan', 'Menunggu persetujuan Koordinator KP')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Seminar KP Dijadwalkan')
                ->orWhere('prodi_id', '2')->where('keterangan', 'Proses Kerja Praktek Selesai')
                ->orWhere('prodi_id', '2')->where('status_kp', 'DAFTAR SEMINAR KP')->where('keterangan', 'Menunggu Jadwal Seminar KP')
                ->orderBy('status_kp', 'desc')->get(),

                'jml_prodikp' => PendaftaranKP::where('prodi_id', '2')->where('keterangan','<>', 'Nilai KP Telah Keluar')->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->orderBy('status_kp', 'desc')->get(),

                'jml_bimbingankp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->where('keterangan','<>', 'Nilai KP Telah Keluar')->orderBy('status_kp', 'desc')->get(),

                'jml_seminarkp' => PenjadwalanKP::where('penguji_nip', Auth::user()->nip)->where('status_seminar', 0)->orWhere('pembimbing_nip', Auth::user()->nip)->where('status_seminar', 0)->get(),
            ]);
        }
        if (auth()->user()->role_id == 11) {            
            return view('pendaftaran.dosen.riwayat-prodi', [
                'pendaftaran_kp' => PendaftaranKP::where('prodi_id', '3')->where('keterangan', 'Nilai KP Telah Keluar')->orderBy('updated_at', 'desc')->get(),

                 'pendaftaran_skripsi' => PendaftaranSkripsi::where('prodi_id', '3')->where('keterangan', 'Nilai Skripsi Telah Keluar')->orderBy('updated_at', 'desc')->get(),

                 'penjadwalan_kps' => PenjadwalanKP::where('prodi_id', '3')->where('status_seminar', 1)->get(),
                 
               'penjadwalan_sempros' => PenjadwalanSempro::where('prodi_id', '3')->where('status_seminar', 1)->get(),
               'penjadwalan_skripsis' => PenjadwalanSkripsi::where('prodi_id', '3')->where('status_seminar', 3)->get(),

               'penjadwalan_skripsis_draf' => PenjadwalanSkripsi::where('prodi_id', '3')->where('status_seminar', 1)->get(),
            'penjadwalan_skripsis_draff' => PenjadwalanSkripsi::where('prodi_id', '3')->where('status_seminar', 2)->get(),

                'jml_persetujuankp' => PendaftaranKP::where('prodi_id', '3')->where('keterangan', 'Menunggu persetujuan Koordinator KP')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Seminar KP Dijadwalkan')
                ->orWhere('prodi_id', '3')->where('keterangan', 'Proses Kerja Praktek Selesai')
                ->orWhere('prodi_id', '3')->where('status_kp', 'DAFTAR SEMINAR KP')->where('keterangan', 'Menunggu Jadwal Seminar KP')
                ->orderBy('status_kp', 'desc')->get(),

                'jml_prodikp' => PendaftaranKP::where('prodi_id', '3')->where('keterangan','<>', 'Nilai KP Telah Keluar')->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->orderBy('status_kp', 'desc')->get(),

                'jml_bimbingankp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->where('keterangan','<>', 'Nilai KP Telah Keluar')->orderBy('status_kp', 'desc')->get(),

                'jml_seminarkp' => PenjadwalanKP::where('penguji_nip', Auth::user()->nip)->where('status_seminar', 0)->orWhere('pembimbing_nip', Auth::user()->nip)->where('status_seminar', 0)->get(),
            ]);
        }   
    }


    public function riwayat_pembimbing_penguji ()
    {

        $riwayat = PenjadwalanSempro::where('pembimbingsatu_nip', Auth::user()->nip)->where('status_seminar', 1)->orWhere('pembimbingdua_nip', Auth::user()->nip)->where('status_seminar', 1)->orWhere('pengujisatu_nip', Auth::user()->nip)->where('status_seminar', 1)->orWhere('pengujidua_nip', Auth::user()->nip)->where('status_seminar', 1)->orWhere('pengujitiga_nip', Auth::user()->nip)->where('status_seminar', 1)->get();        

        $riwayatt = PenjadwalanSkripsi::where('pembimbingsatu_nip', Auth::user()->nip)->where('status_seminar', 3)->orWhere('pembimbingdua_nip', Auth::user()->nip)->where('status_seminar', 3)->orWhere('pengujisatu_nip', Auth::user()->nip)->where('status_seminar', 3)->orWhere('pengujidua_nip', Auth::user()->nip)->where('status_seminar', 3)->orWhere('pengujitiga_nip', Auth::user()->nip)->where('status_seminar', 3)->get();

        $draf = PenjadwalanSkripsi::where('pengujisatu_nip', Auth::user()->nip)->where('status_seminar', 1)->get();

        $draff = PenjadwalanSkripsi::where('pengujisatu_nip', Auth::user()->nip)->where('status_seminar', 2)->get();

        if (auth()->user()->role_id == 6) {            
            return view('pendaftaran.dosen.riwayat-pembimbing', [
                'pendaftaran_kp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Nilai KP Telah Keluar')->orderBy('updated_at', 'desc')->get(),

                'pendaftaran_skripsi' => PendaftaranSkripsi::where('prodi_id', '1')->where('keterangan', 'Nilai Skripsi Telah Keluar')->orderBy('updated_at', 'desc')->get(),


                'pendaftaran_skripsi' => PendaftaranSkripsi::where('pembimbing_1_nip', Auth::user()->nip)->where('keterangan', 'Nilai Skripsi Telah Keluar')
            ->orWhere('pembimbing_2_nip', Auth::user()->nip)->where('keterangan', 'Nilai Skripsi Telah Keluar')->orderBy('updated_at', 'desc')->get(),


            'penjadwalan_sempros' => $riwayat,
            'penjadwalan_skripsis' => $riwayatt,
            'penjadwalan_skripsis_draf' => $draf,
            'penjadwalan_skripsis_draff' => $draff,
                

                'jml_persetujuankp' => PendaftaranKP::where('prodi_id', '1')->where('keterangan', 'Menunggu persetujuan Koordinator Program Studi')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Seminar KP Dijadwalkan')
                ->orderBy('status_kp', 'desc')->get(),

                'jml_prodikp' => PendaftaranKP::where('prodi_id', '1')->where('keterangan','<>', 'Nilai KP Telah Keluar')->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->orderBy('status_kp', 'desc')->get(),

                'jml_bimbingankp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->where('keterangan','<>', 'Nilai KP Telah Keluar')->orderBy('status_kp', 'desc')->get(),

                'jml_seminarkp' => PenjadwalanKP::where('penguji_nip', Auth::user()->nip)->where('status_seminar', 0)->orWhere('pembimbing_nip', Auth::user()->nip)->where('status_seminar', 0)->get(),

            ]);
        }
        if (auth()->user()->role_id == 7) {            
            return view('pendaftaran.dosen.riwayat-pembimbing', [
                'pendaftaran_kp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Nilai KP Telah Keluar')->orderBy('updated_at', 'desc')->get(),

                'pendaftaran_skripsi' => PendaftaranSkripsi::where('prodi_id', '2')->where('keterangan', 'Nilai Skripsi Telah Keluar')->orderBy('updated_at', 'desc')->get(),

                'pendaftaran_skripsi' => PendaftaranSkripsi::where('pembimbing_1_nip', Auth::user()->nip)->where('keterangan', 'Nilai Skripsi Telah Keluar')
            ->orWhere('pembimbing_2_nip', Auth::user()->nip)->where('keterangan', 'Nilai Skripsi Telah Keluar')->orderBy('updated_at', 'desc')->get(),

            'penjadwalan_sempros' => $riwayat,
            'penjadwalan_skripsis' => $riwayatt,
            'penjadwalan_skripsis_draf' => $draf,
            'penjadwalan_skripsis_draff' => $draff,

                'jml_persetujuankp' => PendaftaranKP::where('prodi_id', '2')->where('keterangan', 'Menunggu persetujuan Koordinator Program Studi')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Seminar KP Dijadwalkan')
                ->orderBy('status_kp', 'desc')->get(),

                'jml_prodikp' => PendaftaranKP::where('prodi_id', '2')->where('keterangan','<>', 'Nilai KP Telah Keluar')->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->orderBy('status_kp', 'desc')->get(),

                'jml_bimbingankp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->where('keterangan','<>', 'Nilai KP Telah Keluar')->orderBy('status_kp', 'desc')->get(),

                'jml_seminarkp' => PenjadwalanKP::where('penguji_nip', Auth::user()->nip)->where('status_seminar', 0)->orWhere('pembimbing_nip', Auth::user()->nip)->where('status_seminar', 0)->get(),
            ]);
        }
        if (auth()->user()->role_id == 8) {            
            return view('pendaftaran.dosen.riwayat-pembimbing', [
                'pendaftaran_kp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Nilai KP Telah Keluar')->orderBy('updated_at', 'desc')->get(),

                'pendaftaran_skripsi' => PendaftaranSkripsi::where('prodi_id', '3')->where('keterangan', 'Nilai Skripsi Telah Keluar')->orderBy('updated_at', 'desc')->get(),

                'pendaftaran_skripsi' => PendaftaranSkripsi::where('pembimbing_1_nip', Auth::user()->nip)->where('keterangan', 'Nilai Skripsi Telah Keluar')
            ->orWhere('pembimbing_2_nip', Auth::user()->nip)->where('keterangan', 'Nilai Skripsi Telah Keluar')->orderBy('updated_at', 'desc')->get(),

            'penjadwalan_sempros' => $riwayat,
            'penjadwalan_skripsis' => $riwayatt,
            'penjadwalan_skripsis_draf' => $draf,
            'penjadwalan_skripsis_draff' => $draff,

                'jml_persetujuankp' => PendaftaranKP::where('prodi_id', '3')->where('keterangan', 'Menunggu persetujuan Koordinator Program Studi')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Seminar KP Dijadwalkan')
                ->orderBy('status_kp', 'desc')->get(),

                'jml_prodikp' => PendaftaranKP::where('prodi_id', '3')->where('keterangan','<>', 'Nilai KP Telah Keluar')->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->orderBy('status_kp', 'desc')->get(),

                'jml_bimbingankp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->where('keterangan','<>', 'Nilai KP Telah Keluar')->orderBy('status_kp', 'desc')->get(),

                'jml_seminarkp' => PenjadwalanKP::where('penguji_nip', Auth::user()->nip)->where('status_seminar', 0)->orWhere('pembimbing_nip', Auth::user()->nip)->where('status_seminar', 0)->get(),
            ]);
        }  

        if (auth()->user()->role_id == 9) {            
            return view('pendaftaran.dosen.riwayat-pembimbing', [
                'pendaftaran_kp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Nilai KP Telah Keluar')->orderBy('updated_at', 'desc')->get(),

                'pendaftaran_skripsi' => PendaftaranSkripsi::where('pembimbing_1_nip', Auth::user()->nip)->where('keterangan', 'Nilai Skripsi Telah Keluar')
            ->orWhere('pembimbing_2_nip', Auth::user()->nip)->where('keterangan', 'Nilai Skripsi Telah Keluar')->orderBy('updated_at', 'desc')->get(),


            'penjadwalan_sempros' => $riwayat,
            'penjadwalan_skripsis' => $riwayatt,
            'penjadwalan_skripsis_draf' => $draf,
            'penjadwalan_skripsis_draff' => $draff,

                'jml_persetujuankp' => PendaftaranKP::where('prodi_id', '1')->where('keterangan', 'Menunggu persetujuan Koordinator KP')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Seminar KP Dijadwalkan')
                ->orWhere('prodi_id', '1')->where('keterangan', 'Proses Kerja Praktek Selesai')
                ->orWhere('prodi_id', '1')->where('status_kp', 'DAFTAR SEMINAR KP')->where('keterangan', 'Menunggu Jadwal Seminar KP')
                ->orderBy('status_kp', 'desc')->get(),

                'jml_prodikp' => PendaftaranKP::where('prodi_id', '1')->where('keterangan','<>', 'Nilai KP Telah Keluar')->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->orderBy('status_kp', 'desc')->get(),

                'jml_bimbingankp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->where('keterangan','<>', 'Nilai KP Telah Keluar')->orderBy('status_kp', 'desc')->get(),

                'jml_seminarkp' => PenjadwalanKP::where('penguji_nip', Auth::user()->nip)->where('status_seminar', 0)->orWhere('pembimbing_nip', Auth::user()->nip)->where('status_seminar', 0)->get(),
            ]);
        }
        if (auth()->user()->role_id == 10) {            
            return view('pendaftaran.dosen.riwayat-pembimbing', [
                'pendaftaran_kp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Nilai KP Telah Keluar')->orderBy('updated_at', 'desc')->get(),

                'pendaftaran_skripsi' => PendaftaranSkripsi::where('pembimbing_1_nip', Auth::user()->nip)->where('keterangan', 'Nilai Skripsi Telah Keluar')
            ->orWhere('pembimbing_2_nip', Auth::user()->nip)->where('keterangan', 'Nilai Skripsi Telah Keluar')->orderBy('updated_at', 'desc')->get(),

            'penjadwalan_sempros' => $riwayat,
            'penjadwalan_skripsis' => $riwayatt,
            'penjadwalan_skripsis_draf' => $draf,
            'penjadwalan_skripsis_draff' => $draff,

                'jml_persetujuankp' => PendaftaranKP::where('prodi_id', '2')->where('keterangan', 'Menunggu persetujuan Koordinator KP')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Seminar KP Dijadwalkan')
                ->orWhere('prodi_id', '2')->where('keterangan', 'Proses Kerja Praktek Selesai')
                ->orWhere('prodi_id', '2')->where('status_kp', 'DAFTAR SEMINAR KP')->where('keterangan', 'Menunggu Jadwal Seminar KP')
                ->orderBy('status_kp', 'desc')->get(),

                'jml_prodikp' => PendaftaranKP::where('prodi_id', '2')->where('keterangan','<>', 'Nilai KP Telah Keluar')->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->orderBy('status_kp', 'desc')->get(),

                'jml_bimbingankp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->where('keterangan','<>', 'Nilai KP Telah Keluar')->orderBy('status_kp', 'desc')->get(),

                'jml_seminarkp' => PenjadwalanKP::where('penguji_nip', Auth::user()->nip)->where('status_seminar', 0)->orWhere('pembimbing_nip', Auth::user()->nip)->where('status_seminar', 0)->get(),
            ]);
        }
        if (auth()->user()->role_id == 11) {            
            return view('pendaftaran.dosen.riwayat-pembimbing', [
                'pendaftaran_kp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Nilai KP Telah Keluar')->orderBy('updated_at', 'desc')->get(),

                'pendaftaran_skripsi' => PendaftaranSkripsi::where('pembimbing_1_nip', Auth::user()->nip)->where('keterangan', 'Nilai Skripsi Telah Keluar')
            ->orWhere('pembimbing_2_nip', Auth::user()->nip)->where('keterangan', 'Nilai Skripsi Telah Keluar')->orderBy('updated_at', 'desc')->get(),

            'penjadwalan_sempros' => $riwayat,
            'penjadwalan_skripsis' => $riwayatt,
            'penjadwalan_skripsis_draf' => $draf,
            'penjadwalan_skripsis_draff' => $draff,

                'jml_persetujuankp' => PendaftaranKP::where('prodi_id', '3')->where('keterangan', 'Menunggu persetujuan Koordinator KP')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Seminar KP Dijadwalkan')
                ->orWhere('prodi_id', '3')->where('keterangan', 'Proses Kerja Praktek Selesai')
                ->orWhere('prodi_id', '3')->where('status_kp', 'DAFTAR SEMINAR KP')->where('keterangan', 'Menunggu Jadwal Seminar KP')
                ->orderBy('status_kp', 'desc')->get(),

                'jml_prodikp' => PendaftaranKP::where('prodi_id', '3')->where('keterangan','<>', 'Nilai KP Telah Keluar')->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->orderBy('status_kp', 'desc')->get(),

                'jml_bimbingankp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->where('keterangan','<>', 'Nilai KP Telah Keluar')->orderBy('status_kp', 'desc')->get(),

                'jml_seminarkp' => PenjadwalanKP::where('penguji_nip', Auth::user()->nip)->where('status_seminar', 0)->orWhere('pembimbing_nip', Auth::user()->nip)->where('status_seminar', 0)->get(),
            ]);
        }  

          // DOSEN PEMBIMBING
        if (auth()->user()->nip > 0) {  
            return view('pendaftaran.dosen.riwayat-pembimbing', [

                'pendaftaran_kp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Nilai KP Telah Keluar')->orderBy('updated_at', 'desc')->get(),

                'pendaftaran_skripsi' => PendaftaranSkripsi::where('pembimbing_1_nip', Auth::user()->nip)->where('keterangan', 'Nilai Skripsi Telah Keluar')
            ->orWhere('pembimbing_2_nip', Auth::user()->nip)->where('keterangan', 'Nilai Skripsi Telah Keluar')->orderBy('updated_at', 'desc')->get(),

            'penjadwalan_sempros' => $riwayat,
            'penjadwalan_skripsis' => $riwayatt,
            'penjadwalan_skripsis_draf' => $draf,
            'penjadwalan_skripsis_draff' => $draff,

                'jml_prodikp' => PendaftaranKP::where('keterangan','<>', 'Nilai KP Telah Keluar')->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->orderBy('status_kp', 'desc')->get(),

                'jml_bimbingankp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->where('keterangan','<>', 'Nilai KP Telah Keluar')->orderBy('status_kp', 'desc')->get(),

                'jml_persetujuankp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing')->orderBy('created_at', 'desc')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Seminar KP Dijadwalkan')->orderBy('updated_at', 'desc')
                ->orderBy('updated_at', 'desc')->get(),

                'jml_seminarkp' => PenjadwalanKP::where('penguji_nip', Auth::user()->nip)->where('status_seminar', 0)->orWhere('pembimbing_nip', Auth::user()->nip)->where('status_seminar', 0)->get(),

            ]);
        } 

    }

    public function lulus_pembimbing ()
    {
        return view('pendaftaran.dosen.lulus-pembimbing', [
            'pendaftaran_skripsi' => PendaftaranSkripsi::where('pembimbing_1_nip', Auth::user()->nip)->where('keterangan', 'Nilai Skripsi Telah Keluar')
            ->orWhere('pembimbing_2_nip', Auth::user()->nip)->where('keterangan', 'Nilai Skripsi Telah Keluar')->orderBy('updated_at', 'desc')->get(),
        ]);

    }
    public function lulus ()
    {
         if (auth()->user()->role_id == 1) {     
            return view('pendaftaran.dosen.lulus', [
                'pendaftaran_skripsi' => PendaftaranSkripsi::where('keterangan', 'Nilai Skripsi Telah Keluar')->orderBy('updated_at', 'desc')->get(),
            ]);
        } 
       
        if (auth()->user()->role_id == 2) {            
            return view('pendaftaran.dosen.lulus', [
                'pendaftaran_skripsi' => PendaftaranSkripsi::where('prodi_id', '1')->where('keterangan', 'Nilai Skripsi Telah Keluar')->orderBy('updated_at', 'desc')->get(),
            ]);
        }
        if (auth()->user()->role_id == 3) {            
            return view('pendaftaran.dosen.lulus', [
                'pendaftaran_skripsi' => PendaftaranSkripsi::where('prodi_id', '2')->where('keterangan', 'Nilai Skripsi Telah Keluar')->orderBy('updated_at', 'desc')->get(),
            ]);
        }
        if (auth()->user()->role_id == 4) {  
            
            return view('pendaftaran.dosen.lulus', [
                'pendaftaran_skripsi' => PendaftaranSkripsi::where('prodi_id', '3')->where('keterangan', 'Nilai Skripsi Telah Keluar')->orderBy('updated_at', 'desc')->get(),
            ]);
        } 
        if (auth()->user()->role_id == 5 ) {            
            return view('pendaftaran.dosen.lulus', [
                'pendaftaran_skripsi' => PendaftaranSkripsi::all(),
            ]);
        }
        if (auth()->user()->role_id == 6) {            
            return view('pendaftaran.dosen.lulus', [
                'pendaftaran_skripsi' => PendaftaranSkripsi::where('prodi_id', '1')->where('keterangan', 'Nilai Skripsi Telah Keluar')->orderBy('updated_at', 'desc')->get(),
            ]);
        }
        if (auth()->user()->role_id == 7) {            
            return view('pendaftaran.dosen.lulus', [
                'pendaftaran_skripsi' => PendaftaranSkripsi::where('prodi_id', '2')->where('keterangan', 'Nilai Skripsi Telah Keluar')->orderBy('updated_at', 'desc')->get(),
            ]);
        }
        if (auth()->user()->role_id == 8) {            
            return view('pendaftaran.dosen.lulus', [
                'pendaftaran_skripsi' => PendaftaranSkripsi::where('prodi_id', '3')->where('keterangan', 'Nilai Skripsi Telah Keluar')->orderBy('updated_at', 'desc')->get(),
            ]);
        }  

        if (auth()->user()->role_id == 9) {            
            return view('pendaftaran.dosen.lulus', [
                'pendaftaran_skripsi' => PendaftaranSkripsi::where('prodi_id', '1')->where('keterangan', 'Nilai Skripsi Telah Keluar')->orderBy('updated_at', 'desc')->get(),
            ]);
        }
        if (auth()->user()->role_id == 10) {            
            return view('pendaftaran.dosen.lulus', [
                'pendaftaran_skripsi' => PendaftaranSkripsi::where('prodi_id', '2')->where('keterangan', 'Nilai Skripsi Telah Keluar')->orderBy('updated_at', 'desc')->get(),
            ]);
        }
        if (auth()->user()->role_id == 11) {            
            return view('pendaftaran.dosen.lulus', [
                'pendaftaran_skripsi' => PendaftaranSkripsi::where('prodi_id', '3')->where('keterangan', 'Nilai Skripsi Telah Keluar')->orderBy('updated_at', 'desc')->get(),
            ]);
        }   
    }

    public function pendaftaran_skripsi ()
    {
        if (auth()->user()->role_id == 5 ) {            
            return view('pendaftaran.dosen.indexskripsi', [
                'pendaftaran_skripsi' => PendaftaranSkripsi::where('status_skripsi','<>', 'LULUS')->where('status_skripsi','<>', 'USULAN JUDUL DITOLAK')->where('status_skripsi','<>', 'USULKAN JUDUL ULANG')->orderByRaw("FIELD(status_skripsi, 'USULAN JUDUL', 'JUDUL DISETUJUI', 'DAFTAR SEMPRO', 'PERPANJANGAN 1', 'PERPANJANGAN 2', 'DAFTAR SIDANG', 'SIDANG SELESAI','SKRIPSI SELESAI')")->get(),
            ]);
        }
        if (auth()->user()->role_id == 6) {            
            return view('pendaftaran.dosen.indexskripsi', [
                'pendaftaran_skripsi' => PendaftaranSkripsi::where('status_skripsi','<>', 'LULUS')->where('status_skripsi','<>', 'USULAN JUDUL DITOLAK')->where('status_skripsi','<>', 'USULKAN JUDUL ULANG')->where('prodi_id', '1')->orderBy('status_skripsi', 'desc')->get(),
            ]);
        }
        if (auth()->user()->role_id == 7) {            
            return view('pendaftaran.dosen.indexskripsi', [
                'pendaftaran_skripsi' => PendaftaranSkripsi::where('status_skripsi','<>', 'LULUS')->where('status_skripsi','<>', 'USULAN JUDUL DITOLAK')->where('status_skripsi','<>', 'USULKAN JUDUL ULANG')->where('prodi_id', '2')->orderBy('status_skripsi', 'desc')->get(),
            ]);
        }
        if (auth()->user()->role_id == 8) {            
            return view('pendaftaran.dosen.indexskripsi', [
                'pendaftaran_skripsi' => PendaftaranSkripsi::where('status_skripsi','<>', 'LULUS')->where('status_skripsi','<>', 'USULAN JUDUL DITOLAK')->where('status_skripsi','<>', 'USULKAN JUDUL ULANG')->where('prodi_id', '3')->orderBy('status_skripsi', 'desc')->get(),
            ]);
        }  

        if (auth()->user()->role_id == 9) {            
            return view('pendaftaran.dosen.indexskripsi', [
                'pendaftaran_skripsi' => PendaftaranSkripsi::where('status_skripsi','<>', 'LULUS')->where('status_skripsi','<>', 'USULAN JUDUL DITOLAK')->where('status_skripsi','<>', 'USULKAN JUDUL ULANG')->where('prodi_id', '1')->orderBy('status_skripsi', 'desc')->get(),
            ]);
        }
        if (auth()->user()->role_id == 10) {            
            return view('pendaftaran.dosen.indexskripsi', [
                'pendaftaran_skripsi' => PendaftaranSkripsi::where('status_skripsi','<>', 'LULUS')->where('status_skripsi','<>', 'USULAN JUDUL DITOLAK')->where('status_skripsi','<>', 'USULKAN JUDUL ULANG')->where('prodi_id', '2')->orderBy('status_skripsi', 'desc')->get(),
            ]);
        }
        if (auth()->user()->role_id == 11) {            
            return view('pendaftaran.dosen.indexskripsi', [
                'pendaftaran_skripsi' => PendaftaranSkripsi::where('status_skripsi','<>', 'LULUS')->where('status_skripsi','<>', 'USULAN JUDUL DITOLAK')->where('status_skripsi','<>', 'USULKAN JUDUL ULANG')->where('prodi_id', '3')->orderBy('status_skripsi', 'desc')->get(),
            ]);
        }   
    }



    public function persetujuankpskripsi_dosen (PendaftaranKP $kp, PendaftaranSkripsi $skripsi , Request $id)
    {

        //KAPRODI
        if (auth()->user()->role_id == 6) {            
            return view('pendaftaran.dosen.persetujuankp-skripsi', [
            // KP
                'pendaftaran_kp' => PendaftaranKP::where('prodi_id', '1')->where('keterangan', 'Menunggu persetujuan Koordinator Program Studi')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Seminar KP Dijadwalkan')
                ->orderBy('status_kp', 'desc')->get(),

                'jml_prodikp' => PendaftaranKP::where('prodi_id', '1')->where('keterangan','<>', 'Nilai KP Telah Keluar')->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->orderBy('status_kp', 'desc')->get(),

                'jml_bimbingankp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->where('keterangan','<>', 'Nilai KP Telah Keluar')->orderBy('status_kp', 'desc')->get(),

                'jml_seminarkp' => PenjadwalanKP::where('penguji_nip', Auth::user()->nip)->where('status_seminar', 0)->orWhere('pembimbing_nip', Auth::user()->nip)->where('status_seminar', 0)->get(),

            // SKRIPSI
                  'pendaftaran_skripsi' => PendaftaranSkripsi::where('prodi_id', '1')->where('keterangan', 'Menunggu persetujuan Koordinator Program Studi')
                ->orWhere('pembimbing_1_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing 1')
                ->orWhere('pembimbing_2_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing 2')
                ->orWhere('pembimbing_1_nip', Auth::user()->nip)->where('keterangan', 'Seminar Proposal Dijadwalkan')
                ->orWhere('pembimbing_1_nip', Auth::user()->nip)->where('keterangan', 'Sidang Skripsi Dijadwalkan')
                ->orderBy('status_skripsi', 'desc')->get(),
            ]);
        }
        if (auth()->user()->role_id == 7) {            
            return view('pendaftaran.dosen.persetujuankp-skripsi', [
                'pendaftaran_kp' => PendaftaranKP::where('prodi_id', '2')->where('keterangan', 'Menunggu persetujuan Koordinator Program Studi')->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Seminar KP Dijadwalkan')
                ->orderBy('status_kp', 'desc')->get(),

                'jml_prodikp' => PendaftaranKP::where('prodi_id', '2')->where('keterangan','<>', 'Nilai KP Telah Keluar')->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->orderBy('status_kp', 'desc')->get(),

                'jml_bimbingankp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->where('keterangan','<>', 'Nilai KP Telah Keluar')->orderBy('status_kp', 'desc')->get(),

                'jml_seminarkp' => PenjadwalanKP::where('penguji_nip', Auth::user()->nip)->where('status_seminar', 0)->orWhere('pembimbing_nip', Auth::user()->nip)->where('status_seminar', 0)->get(),

                // SKRIPSI
                'pendaftaran_skripsi' => PendaftaranSkripsi::where('prodi_id', '2')->where('keterangan', 'Menunggu persetujuan Koordinator Program Studi')
                ->orWhere('pembimbing_1_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing 1')
                ->orWhere('pembimbing_2_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing 2')
                ->orWhere('pembimbing_1_nip', Auth::user()->nip)->where('keterangan', 'Seminar Proposal Dijadwalkan')
                ->orWhere('pembimbing_1_nip', Auth::user()->nip)->where('keterangan', 'Sidang Skripsi Dijadwalkan')
                ->orderBy('status_skripsi', 'desc')->get(),

            ]);
        }
        if (auth()->user()->role_id == 8) {            
            return view('pendaftaran.dosen.persetujuankp-skripsi', [
                'pendaftaran_kp' => PendaftaranKP::where('prodi_id', '3')->where('keterangan', 'Menunggu persetujuan Koordinator Program Studi')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Seminar KP Dijadwalkan')
                ->orderBy('status_kp', 'desc')->get(),

                'jml_prodikp' => PendaftaranKP::where('prodi_id', '3')->where('keterangan','<>', 'Nilai KP Telah Keluar')->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->orderBy('status_kp', 'desc')->get(),

                'jml_bimbingankp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->where('keterangan','<>', 'Nilai KP Telah Keluar')->orderBy('status_kp', 'desc')->get(),

                'jml_seminarkp' => PenjadwalanKP::where('penguji_nip', Auth::user()->nip)->where('status_seminar', 0)->orWhere('pembimbing_nip', Auth::user()->nip)->where('status_seminar', 0)->get(),

                // SKRIPSI
                'pendaftaran_skripsi' => PendaftaranSkripsi::where('prodi_id', '3')->where('keterangan', 'Menunggu persetujuan Koordinator Program Studi')
                ->orWhere('pembimbing_1_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing 1')
                ->orWhere('pembimbing_2_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing 2')
                ->orWhere('pembimbing_1_nip', Auth::user()->nip)->where('keterangan', 'Seminar Proposal Dijadwalkan')
                ->orWhere('pembimbing_1_nip', Auth::user()->nip)->where('keterangan', 'Sidang Skripsi Dijadwalkan')
                ->orderBy('status_skripsi', 'desc')->get(),
            ]);
        }  
        //KOORDINATOR KP SKRIPSI
        if (auth()->user()->role_id == 9) {            
            return view('pendaftaran.dosen.persetujuankp-skripsi', [
                'pendaftaran_kp' => PendaftaranKP::where('prodi_id', '1')->where('keterangan', 'Menunggu persetujuan Koordinator KP')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Seminar KP Dijadwalkan')
                ->orWhere('prodi_id', '1')->where('keterangan', 'Proses Kerja Praktek Selesai')
                ->orWhere('prodi_id', '1')->where('status_kp', 'DAFTAR SEMINAR KP')->where('keterangan', 'Menunggu Jadwal Seminar KP')
                ->orderBy('status_kp', 'desc')->get(),

                'jml_prodikp' => PendaftaranKP::where('prodi_id', '1')->where('keterangan','<>', 'Nilai KP Telah Keluar')->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->orderBy('status_kp', 'desc')->get(),

                'jml_bimbingankp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->where('keterangan','<>', 'Nilai KP Telah Keluar')->orderBy('status_kp', 'desc')->get(),

                'jml_seminarkp' => PenjadwalanKP::where('penguji_nip', Auth::user()->nip)->where('status_seminar', 0)->orWhere('pembimbing_nip', Auth::user()->nip)->where('status_seminar', 0)->get(),

                // SKRIPSI
                'pendaftaran_skripsi' => PendaftaranSkripsi::where('prodi_id', '1')->where('keterangan', 'Menunggu persetujuan Koordinator Skripsi')
                ->orWhere('pembimbing_1_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing 1')
                ->orWhere('pembimbing_2_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing 2')
                ->orWhere('pembimbing_1_nip', Auth::user()->nip)->where('keterangan', 'Seminar Proposal Dijadwalkan')
                ->orWhere('pembimbing_1_nip', Auth::user()->nip)->where('keterangan', 'Sidang Skripsi Dijadwalkan')
                ->orWhere('prodi_id', '1')->where('keterangan', 'Proses Skripsi Selesai!')
                ->orWhere('keterangan', 'Menunggu Jadwal Seminar Proposal')->where('prodi_id', '1')
                ->orWhere('keterangan', 'Menunggu Jadwal Sidang Skripsi')->where('prodi_id', '1')
                ->orderBy('status_skripsi', 'desc')->get(),


            ]);
        }
        if (auth()->user()->role_id == 10) {            
            return view('pendaftaran.dosen.persetujuankp-skripsi', [
                'pendaftaran_kp' => PendaftaranKP::where('prodi_id', '2')->where('keterangan', 'Menunggu persetujuan Koordinator KP')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Seminar KP Dijadwalkan')
                ->orWhere('prodi_id', '2')->where('keterangan', 'Proses Kerja Praktek Selesai')
                ->orWhere('prodi_id', '2')->where('status_kp', 'DAFTAR SEMINAR KP')->where('keterangan', 'Menunggu Jadwal Seminar KP')
                ->orderBy('status_kp', 'desc')->get(),

                'jml_prodikp' => PendaftaranKP::where('prodi_id', '2')->where('keterangan','<>', 'Nilai KP Telah Keluar')->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->orderBy('status_kp', 'desc')->get(),

                'jml_bimbingankp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->where('keterangan','<>', 'Nilai KP Telah Keluar')->orderBy('status_kp', 'desc')->get(),

                'jml_seminarkp' => PenjadwalanKP::where('penguji_nip', Auth::user()->nip)->where('status_seminar', 0)->orWhere('pembimbing_nip', Auth::user()->nip)->where('status_seminar', 0)->get(),

                // SKRIPSI
                 'pendaftaran_skripsi' => PendaftaranSkripsi::where('prodi_id', '2')->where('keterangan', 'Menunggu persetujuan Koordinator Skripsi')
                ->orWhere('pembimbing_1_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing 1')
                ->orWhere('pembimbing_2_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing 2')
                ->orWhere('pembimbing_1_nip', Auth::user()->nip)->where('keterangan', 'Seminar Proposal Dijadwalkan')
                ->orWhere('pembimbing_1_nip', Auth::user()->nip)->where('keterangan', 'Sidang Skripsi Dijadwalkan')
                ->orWhere('prodi_id', '2')->where('keterangan', 'Proses Skripsi Selesai!')
                ->orWhere('keterangan', 'Menunggu Jadwal Seminar Proposal')->where('prodi_id', '2')
                ->orWhere('keterangan', 'Menunggu Jadwal Sidang Skripsi')->where('prodi_id', '2')
                ->orderBy('status_skripsi', 'desc')->get(),

            ]);
        }
        if (auth()->user()->role_id == 11) {  
            return view('pendaftaran.dosen.persetujuankp-skripsi', [
                'pendaftaran_kp' => PendaftaranKP::where('prodi_id', '3')->where('keterangan', 'Menunggu persetujuan Koordinator KP')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Seminar KP Dijadwalkan')
                ->orWhere('prodi_id', '3')->where('keterangan', 'Proses Kerja Praktek Selesai')
                ->orWhere('prodi_id', '3')->where('status_kp', 'DAFTAR SEMINAR KP')->where('keterangan', 'Menunggu Jadwal Seminar KP')
                ->orderBy('status_kp', 'desc')->get(),

                'jml_prodikp' => PendaftaranKP::where('prodi_id', '3')->where('keterangan','<>', 'Nilai KP Telah Keluar')->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->orderBy('status_kp', 'desc')->get(),

                'jml_bimbingankp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->where('keterangan','<>', 'Nilai KP Telah Keluar')->orderBy('status_kp', 'desc')->get(),

                'jml_seminarkp' => PenjadwalanKP::where('penguji_nip', Auth::user()->nip)->where('status_seminar', 0)->orWhere('pembimbing_nip', Auth::user()->nip)->where('status_seminar', 0)->get(),


                // SKRIPSI
                'pendaftaran_skripsi' => PendaftaranSkripsi::where('prodi_id', '3')->where('keterangan', 'Menunggu persetujuan Koordinator Skripsi')
                ->orWhere('pembimbing_1_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing 1')
                ->orWhere('pembimbing_2_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing 2')
                ->orWhere('pembimbing_1_nip', Auth::user()->nip)->where('keterangan', 'Seminar Proposal Dijadwalkan')
                ->orWhere('pembimbing_1_nip', Auth::user()->nip)->where('keterangan', 'Sidang Skripsi Dijadwalkan')
                ->orWhere('prodi_id', '3')->where('keterangan', 'Proses Skripsi Selesai!')
                ->orWhere('keterangan', 'Menunggu Jadwal Seminar Proposal')->where('prodi_id', '3')
                ->orWhere('keterangan', 'Menunggu Jadwal Sidang Skripsi')->where('prodi_id', '3')
                ->orderBy('status_skripsi', 'desc')->get(),

            ]);
        }  
        // DOSEN PEMBIMBING
        if (auth()->user()->nip > 0) {  
            return view('pendaftaran.dosen.persetujuankp-skripsi', [
                'pendaftaran_kp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing')->orderBy('created_at', 'desc')
                ->orWhere('dosen_pembimbing_nip', Auth::user()->nip)->where('keterangan', 'Seminar KP Dijadwalkan')->orderBy('updated_at', 'desc')
                ->orderBy('updated_at', 'desc')->get(),

                'jml_prodikp' => PendaftaranKP::where('prodi_id', '1')->where('keterangan','<>', 'Nilai KP Telah Keluar')->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->orderBy('status_kp', 'desc')->get(),

                'jml_bimbingankp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->where('keterangan','<>', 'Nilai KP Telah Keluar')->orderBy('status_kp', 'desc')->get(),

                'jml_seminarkp' => PenjadwalanKP::where('penguji_nip', Auth::user()->nip)->where('status_seminar', 0)->orWhere('pembimbing_nip', Auth::user()->nip)->where('status_seminar', 0)->get(),

            ]);
        } 

    }
    public function persetujuanskripsi_dosen (PendaftaranKP $kp, PendaftaranSkripsi $skripsi , Request $id)
    {

        //KAPRODI
        if (auth()->user()->role_id == 6) {            
            return view('pendaftaran.dosen.persetujuanskripsi', [             
                'pendaftaran_skripsi' => PendaftaranSkripsi::where('prodi_id', '1')->where('keterangan', 'Menunggu persetujuan Koordinator Program Studi')
                ->orWhere('pembimbing_1_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing 1')
                ->orWhere('pembimbing_2_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing 2')
                ->orWhere('pembimbing_1_nip', Auth::user()->nip)->where('keterangan', 'Seminar Proposal Dijadwalkan')
                ->orWhere('pembimbing_1_nip', Auth::user()->nip)->where('keterangan', 'Sidang Skripsi Dijadwalkan')
                ->orderBy('status_skripsi', 'desc')->get(),
            ]);
        }
        if (auth()->user()->role_id == 7) {            
            return view('pendaftaran.dosen.persetujuanskripsi', [
                'pendaftaran_skripsi' => PendaftaranSkripsi::where('prodi_id', '2')->where('keterangan', 'Menunggu persetujuan Koordinator Program Studi')
                ->orWhere('pembimbing_1_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing 1')
                ->orWhere('pembimbing_2_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing 2')
                ->orWhere('pembimbing_1_nip', Auth::user()->nip)->where('keterangan', 'Seminar Proposal Dijadwalkan')
                ->orWhere('pembimbing_1_nip', Auth::user()->nip)->where('keterangan', 'Sidang Skripsi Dijadwalkan')
                ->orderBy('status_skripsi', 'desc')->get(),
            ]);
        }
        if (auth()->user()->role_id == 8) {            
            return view('pendaftaran.dosen.persetujuanskripsi', [
                'pendaftaran_skripsi' => PendaftaranSkripsi::where('prodi_id', '3')->where('keterangan', 'Menunggu persetujuan Koordinator Program Studi')
                ->orWhere('pembimbing_1_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing 1')
                ->orWhere('pembimbing_2_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing 2')
                ->orWhere('pembimbing_1_nip', Auth::user()->nip)->where('keterangan', 'Seminar Proposal Dijadwalkan')
                ->orWhere('pembimbing_1_nip', Auth::user()->nip)->where('keterangan', 'Sidang Skripsi Dijadwalkan')
                ->orderBy('status_skripsi', 'desc')->get(),
            ]);
        }  
        //KOORDINATOR KP SKRIPSI
        if (auth()->user()->role_id == 9) {            
            return view('pendaftaran.dosen.persetujuanskripsi', [
                'pendaftaran_skripsi' => PendaftaranSkripsi::where('prodi_id', '1')->where('keterangan', 'Menunggu persetujuan Koordinator Skripsi')
                ->orWhere('pembimbing_1_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing 1')
                ->orWhere('pembimbing_2_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing 2')
                ->orWhere('pembimbing_1_nip', Auth::user()->nip)->where('keterangan', 'Seminar Proposal Dijadwalkan')
                ->orWhere('pembimbing_1_nip', Auth::user()->nip)->where('keterangan', 'Sidang Skripsi Dijadwalkan')
                ->orWhere('prodi_id', '1')->where('keterangan', 'Proses Skripsi Selesai!')
                ->orWhere('keterangan', 'Menunggu Jadwal Seminar Proposal')->where('prodi_id', '1')
                ->orWhere('keterangan', 'Menunggu Jadwal Sidang Skripsi')->where('prodi_id', '1')
                ->orderBy('status_skripsi', 'desc')->get(),
            ]);
        }
        if (auth()->user()->role_id == 10) {            
            return view('pendaftaran.dosen.persetujuanskripsi', [
                'pendaftaran_skripsi' => PendaftaranSkripsi::where('prodi_id', '2')->where('keterangan', 'Menunggu persetujuan Koordinator Skripsi')
                ->orWhere('pembimbing_1_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing 1')
                ->orWhere('pembimbing_2_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing 2')
                ->orWhere('pembimbing_1_nip', Auth::user()->nip)->where('keterangan', 'Seminar Proposal Dijadwalkan')
                ->orWhere('pembimbing_1_nip', Auth::user()->nip)->where('keterangan', 'Sidang Skripsi Dijadwalkan')
                ->orWhere('prodi_id', '2')->where('keterangan', 'Proses Skripsi Selesai!')
                ->orWhere('keterangan', 'Menunggu Jadwal Seminar Proposal')->where('prodi_id', '2')
                ->orWhere('keterangan', 'Menunggu Jadwal Sidang Skripsi')->where('prodi_id', '2')
                ->orderBy('status_skripsi', 'desc')->get(),
            ]);
        }
        if (auth()->user()->role_id == 11) {  
                  
           

            return view('pendaftaran.dosen.persetujuanskripsi', [
                'pendaftaran_skripsi' => PendaftaranSkripsi::where('prodi_id', '3')->where('keterangan', 'Menunggu persetujuan Koordinator Skripsi')
                ->orWhere('pembimbing_1_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing 1')
                ->orWhere('pembimbing_2_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing 2')
                ->orWhere('pembimbing_1_nip', Auth::user()->nip)->where('keterangan', 'Seminar Proposal Dijadwalkan')
                ->orWhere('pembimbing_1_nip', Auth::user()->nip)->where('keterangan', 'Sidang Skripsi Dijadwalkan')
                ->orWhere('prodi_id', '3')->where('keterangan', 'Proses Skripsi Selesai!')
                ->orWhere('keterangan', 'Menunggu Jadwal Seminar Proposal')->where('prodi_id', '3')
                ->orWhere('keterangan', 'Menunggu Jadwal Sidang Skripsi')->where('prodi_id', '3')
                ->orderBy('status_skripsi', 'desc')->get(),
            ]);
        }  
        // DOSEN PEMBIMBING
        if (auth()->user()->nip > 0) {  
            return view('pendaftaran.dosen.persetujuanskripsi', [
                'pendaftaran_skripsi' => PendaftaranSkripsi::where('pembimbing_1_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing 1')->orderBy('created_at', 'desc')
                ->orWhere('pembimbing_2_nip', Auth::user()->nip)->where('keterangan', 'Menunggu persetujuan Pembimbing 2')
                ->orWhere('pembimbing_1_nip', Auth::user()->nip)->where('keterangan', 'Seminar Proposal Dijadwalkan')
                ->orWhere('pembimbing_1_nip', Auth::user()->nip)->where('keterangan', 'Sidang Skripsi Dijadwalkan')
                 ->orderBy('updated_at', 'desc')->get(),

            ]);
        } 

    }


    public function detail_kuota_bimbingan_kp($nip)
    {       
        $dosen = Dosen::where('nip', $nip)->first();

        $mahasiswa = $dosen->pembimbingkp;

         return view('pendaftaran.dosen.detail-kuota-bimbingan-kp', [
                // 'pendaftaran_kp' => PendaftaranKP::where('dosen_pembimbing_nip', Auth::user()->nip)->where('status_kp','<>', 'USULAN KP DITOLAK')->where('status_kp','<>', 'USULKAN KP ULANG')->where('keterangan','<>', 'Nilai KP Telah Keluar')->orderBy('status_kp', 'desc')->get(),

                'pendaftaran_kp' => $mahasiswa,
                'dosen' => $dosen,
            ]);
    }
    public function detail_kuota_bimbingan_skripsi($nip)
    {       
        $dosen = Dosen::where('nip', $nip)->first();

        $mahasiswa1 = $dosen->pembimbing1skripsi;
        $mahasiswa2 = $dosen->pembimbing2skripsi;

        $gabungan = $mahasiswa1->merge($mahasiswa2);

         return view('pendaftaran.dosen.detail-kuota-bimbingan-skripsi', [
                'pendaftaran_skripsi' => $gabungan,
                'dosen' => $dosen,
            ]);
    }

    public function kuotabimbingan()
    {       

        $dosens = Dosen::withCount(['pendaftaranKP', 'pendaftaranSkripsi1', 'pendaftaranSkripsi2'])->get();
        
        $dosens = Dosen::withCount([
            'pendaftaranKP' => function ($query) {
                $query->where('status_kp', '!=', 'USULAN KP DITOLAK')
                        ->where('status_kp', '!=', 'USULKAN KP ULANG')
                        ->where('keterangan', '!=', 'Nilai KP Telah Keluar');
            },
            'pendaftaranSkripsi1' => function ($query) {
                $query->where('status_skripsi', '!=', 'USULAN JUDUL DITOLAK')
                        ->where('status_skripsi', '!=', 'USULKAN JUDUL ULANG')
                        ->where('keterangan', '!=', 'Nilai Skripsi Telah Keluar');
            },
            'pendaftaranSkripsi2' => function ($query) {
                $query->where('status_skripsi', '!=', 'USULAN JUDUL DITOLAK')
                        ->where('status_skripsi', '!=', 'USULKAN JUDUL ULANG')
                        ->where('keterangan', '!=', 'Nilai Skripsi Telah Keluar');
            },

        ])->get();

        return view('pendaftaran.dosen.kuota-bimbingan', [
            'dosen' => $dosens,
            'dosenn' => $dosens,
            // 'pendaftaran_kp' => PendaftaranKP::where('dosen_pembimbing_nip', $pembimbing)
            //      ->orderBy('updated_at', 'desc')->get(),
        ]);
    }

    public function kuotabimbingan_kp()
    {       
        $dosens = Dosen::withCount(['pendaftaranKP', 'pendaftaranSkripsi1', 'pendaftaranSkripsi2'])->get();

        $dosens = Dosen::withCount([
            'pendaftaranKP' => function ($query) {
                $query->where('status_kp', '!=', 'USULAN KP DITOLAK')
                        ->where('status_kp', '!=', 'USULKAN KP ULANG')
                        ->where('keterangan', '!=', 'Nilai KP Telah Keluar');
            },
            'pendaftaranSkripsi1' => function ($query) {
                $query->where('status_skripsi', '!=', 'USULAN JUDUL DITOLAK')
                        ->where('status_skripsi', '!=', 'USULKAN JUDUL ULANG')
                        ->where('keterangan', '!=', 'Nilai Skripsi Telah Keluar');
            },
            'pendaftaranSkripsi2' => function ($query) {
                $query->where('status_skripsi', '!=', 'USULAN JUDUL DITOLAK')
                        ->where('status_skripsi', '!=', 'USULKAN JUDUL ULANG')
                        ->where('keterangan', '!=', 'Nilai Skripsi Telah Keluar');
            },

        ])->get();


        return view('pendaftaran.dosen.kuota-bimbingan-kp', [
            'dosen' => $dosens,
        ]);
    }

    public function kuotabimbingan_skripsi()
    {       
        $dosens = Dosen::withCount(['pendaftaranKP', 'pendaftaranSkripsi1', 'pendaftaranSkripsi2'])->get();

        $dosens = Dosen::withCount([
            'pendaftaranKP' => function ($query) {
                $query->where('status_kp', '!=', 'USULAN KP DITOLAK')
                        ->where('status_kp', '!=', 'USULKAN KP ULANG')
                        ->where('keterangan', '!=', 'Nilai KP Telah Keluar');
            },
            'pendaftaranSkripsi1' => function ($query) {
                $query->where('status_skripsi', '!=', 'USULAN JUDUL DITOLAK')
                        ->where('status_skripsi', '!=', 'USULKAN JUDUL ULANG')
                        ->where('keterangan', '!=', 'Nilai Skripsi Telah Keluar');
            },
            'pendaftaranSkripsi2' => function ($query) {
                $query->where('status_skripsi', '!=', 'USULAN JUDUL DITOLAK')
                        ->where('status_skripsi', '!=', 'USULKAN JUDUL ULANG')
                        ->where('keterangan', '!=', 'Nilai Skripsi Telah Keluar');
            },

        ])->get();


        return view('pendaftaran.dosen.kuota-bimbingan-skripsi', [
            'dosen' => $dosens,
        ]);
    }



    public function daftarkp_mahasiswa()
    {       
        return view('pendaftaran.kerja-praktek.index', [
            'pendaftaran_kps' => PendaftaranKP::where('mahasiswa_nim', Auth::user()->nim)->get(),

            // 'penjadwalan_sempros' => PenjadwalanSempro::where('status_seminar', 0)->where('mahasiswa_nim', Auth::user()->nim)->get(),
            // 'penjadwalan_skripsis' => PenjadwalanSkripsi::where('status_seminar', 0)->where('mahasiswa_nim', Auth::user()->nim)->get(),
        ]);
    }

    public function koordinator_pendaftaran()
    {       

        if (auth()->user()->role_id == 9) {            
            return view('pendaftaran.dosen.index', [
                'pendaftaran_kp' => PendaftaranKP::where('prodi_id', '1')->get(),
            ]);
        }
        if (auth()->user()->role_id == 10) {            
            return view('pendaftaran.dosen.index', [
                'pendaftaran_kp' => PendaftaranKP::where('prodi_id', '2')->get(),
            ]);
        }
        if (auth()->user()->role_id == 11) {            
            return view('pendaftaran.dosen.index', [
                'pendaftaran_kp' => PendaftaranKP::where('prodi_id', '3')->get(),
                // 'usulan_kps' => UsulanKP::where('prodi_id', '3')->get(),
            ]);
        }   
    }
    // public function daftar_dosen()
    // {   
    //     return view('pendaftaran.dosen.index', [
    //         'pendaftaran_kp' => PendaftaranKP::where('dosen_pembimbing', Auth::user()->nip)->get(),
    //         ]);
        
    // }
    public function daftarkp_dosen()
    {   
        return view('pendaftaran.dosen.indexkp', [
            'pendaftaran_kp' => PendaftaranKP::where('dosen_pembimbing', Auth::user()->nip)->get(),
            ]);  
 
    }



    public function daftarkp_koordinator_detail_usulan()
    {       

        if (auth()->user()->role_id == 9) {            
            return view('pendaftaran.dosen.detail-usulan', [
                'pendaftaran_kps' => PendaftaranKP::where('prodi_id', '1')->get(),
            ]);
        }
        if (auth()->user()->role_id == 10) {            
            return view('pendaftaran.dosen.detail-usulan', [
                'pendaftaran_kps' => PendaftaranKP::where('prodi_id', '2')->get(),
            ]);
        }
        if (auth()->user()->role_id == 11) {     
            return view('pendaftaran.dosen.detail-usulan', [
                'pendaftaran_kps' => PendaftaranKP::where('prodi_id', '3')->get(),
            ]);
        } 

    }
    public function daftarkp_koordinator_detail_permohonan()
    {       

        if (auth()->user()->role_id == 9) {            
            return view('pendaftaran.dosen.detail-permohonan', [
                'pendaftaran_kp' => PendaftaranKP::where('prodi_id', '1')->get(),
            ]);
        }
        if (auth()->user()->role_id == 10) {            
            return view('pendaftaran.dosen.detail-permohonan', [
                'pendaftaran_kp' => PendaftaranKP::where('prodi_id', '2')->get(),
            ]);
        }
        if (auth()->user()->role_id == 11) {     
            return view('pendaftaran.dosen.detail-permohonan', [
                'pendaftaran_kp' => PendaftaranKP::where('prodi_id', '3')->get(),

            ]);
        } 

    }
    public function daftarkp_kaprodi()
    {       
        if (auth()->user()->role_id == 6) {            
            return view('pendaftaran.kerja-praktek.index', [
                'pendaftaran_kps' => PendaftaranKP::where('prodi_id', '1')->get(),
            ]);
        }
        if (auth()->user()->role_id == 7) {            
            return view('pendaftaran.kerja-praktek.index', [
                'pendaftaran_kps' => PendaftaranKP::where('prodi_id', '2')->get(),
            ]);
        }
        if (auth()->user()->role_id == 8) {     
            
            

            return view('pendaftaran.kerja-praktek.index', [
                'pendaftaran_kps' => PendaftaranKP::where('prodi_id', '3')->get(),
            ]);
        }  
    }



}
