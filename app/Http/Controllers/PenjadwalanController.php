<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PenjadwalanKP;
use App\Models\PendaftaranKP;
use App\Models\PenjadwalanSempro;
use App\Models\PenjadwalanSkripsi;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PenjadwalanController extends Controller
{
    public function index()
    {
        

        if (auth()->user()->role_id == 1) {            
            return view('penjadwalan.index', [
                'role' => Role::all(),
                'penjadwalan_kps' => PenjadwalanKP::where('tanggal', '>=', Carbon::today())->orWhere('tanggal', NULL)->orderBy('tanggal', 'ASC')->get(),
                'penjadwalan_sempros' => PenjadwalanSempro::where('status_seminar', '0')->orWhere('tanggal', NULL)->orderBy('tanggal', 'ASC')->get(),
                'penjadwalan_skripsis' => PenjadwalanSkripsi::where('tanggal', '>=', Carbon::today())->orWhere('tanggal', NULL)->orderBy('tanggal', 'ASC')->get(),
                // 'penjadwalan_skripsis' => PenjadwalanSkripsi::where('tanggal', '>=', Carbon::today())->orWhere('tanggal', NULL)->orderBy('tanggal', 'ASC')->get(),
            ]);
        }
        if (auth()->user()->role_id == 2) {            
            return view('penjadwalan.index', [
                'role' => Role::all(),
                
                'penjadwalan_kps' => PenjadwalanKP::where(function($query) {
                    $query->where('tanggal', '>=', Carbon::today())->orWhere('tanggal', NULL);
                })->where('prodi_id', 1)->orderBy('tanggal', 'ASC')->get(),

                'pendaftaran_kp' => PendaftaranKP::where('keterangan', 'Menunggu persetujuan Admin Prodi')->where('prodi_id', '1')
                ->orWhere('keterangan', 'Menunggu Jadwal Seminar KP')->where('prodi_id', '1')
                ->get()->sortBy('update_at'),
                

                'penjadwalan_sempros' => PenjadwalanSempro::where('status_seminar', '0')->where('prodi_id', 1)->orderBy('tanggal', 'ASC')->get(),
                
                'penjadwalan_skripsis' => PenjadwalanSkripsi::where(function($query) {
                    $query->where('tanggal', '>=', Carbon::today())->orWhere('tanggal', NULL);
                })->where('prodi_id', 1)->orderBy('tanggal', 'ASC')->get(),
            ]);
        }
        if (auth()->user()->role_id == 3) {            
            return view('penjadwalan.index', [
                'role' => Role::all(),
                
                'penjadwalan_kps' => PenjadwalanKP::where(function($query) {
                    $query->where('tanggal', '>=', Carbon::today())->orWhere('tanggal', NULL);
                })->where('prodi_id', 2)->orderBy('tanggal', 'ASC')->get(),

                'pendaftaran_kp' => PendaftaranKP::where('keterangan', 'Menunggu persetujuan Admin Prodi')->where('prodi_id', '1')
                ->orWhere('keterangan', 'Menunggu Jadwal Seminar KP')->where('prodi_id', '2')
                ->get()->sortBy('update_at'),
                

                // 'penjadwalan_sempros' => PenjadwalanSempro::where(function($query) {
                //     $query->where('tanggal', '>=', Carbon::today())->orWhere('tanggal', NULL);
                // })->where('prodi_id', 2)->orderBy('tanggal', 'ASC')->get(),
                'penjadwalan_sempros' => PenjadwalanSempro::where('status_seminar', '0')->where('prodi_id', 2)->orderBy('tanggal', 'ASC')->get(),
                'penjadwalan_skripsis' => PenjadwalanSkripsi::where(function($query) {
                    $query->where('tanggal', '>=', Carbon::today())->orWhere('tanggal', NULL);
                })->where('prodi_id', 2)->orderBy('tanggal', 'ASC')->get(),
            ]);
        }
        if (auth()->user()->role_id == 4) {   
        
            return view('penjadwalan.index', [
                'role' => Role::all(),
                
                'penjadwalan_kps' => PenjadwalanKP::where(function($query) {
                    $query->where('tanggal', '>=', Carbon::today())->orWhere('tanggal', NULL);
                })->where('prodi_id', 3)->orderBy('tanggal', 'ASC')->get(),

                'pendaftaran_kp' => PendaftaranKP::where('keterangan', 'Menunggu persetujuan Admin Prodi')->where('prodi_id', '3')
                ->orWhere('keterangan', 'Menunggu Jadwal Seminar KP')->where('prodi_id', '3')
                ->get()->sortBy('update_at'),

                

                'penjadwalan_sempros' => PenjadwalanSempro::where('status_seminar', '0')->where('prodi_id', 3)->orderBy('tanggal', 'ASC')->get(),

                'penjadwalan_skripsis' => PenjadwalanSkripsi::where(function($query) {
                    $query->where('tanggal', '>=', Carbon::today())->orWhere('tanggal', NULL);
                })->where('prodi_id', 3)->orderBy('tanggal', 'ASC')->get(),
            ]);
        }
    }

    public function riwayat()
    {       
        if (auth()->user()->role_id == 1) {            
            return view('penjadwalan.riwayat-penjadwalan', [
                'role' => Role::all(),
                'penjadwalan_kps' => PenjadwalanKP::where('tanggal', '<', Carbon::today())->get(),
                'penjadwalan_sempros' => PenjadwalanSempro::where('status_seminar', '1')->get(),
                'penjadwalan_skripsis' => PenjadwalanSkripsi::where('status_seminar', '3')->get(),
            ]);
        }
        if (auth()->user()->role_id == 2) {            
            return view('penjadwalan.riwayat-penjadwalan', [
                'role' => Role::all(),
                'penjadwalan_kps' => PenjadwalanKP::where('tanggal', '<', Carbon::today())->where('prodi_id', 1)->get(),
                'penjadwalan_sempros' => PenjadwalanSempro::where('status_seminar', '1')->where('prodi_id', 1)->get(),
                'penjadwalan_skripsis' => PenjadwalanSkripsi::where('status_seminar', '3')->where('prodi_id', 1)->get(),
            ]);
        }
        if (auth()->user()->role_id == 3) {            
            return view('penjadwalan.riwayat-penjadwalan', [
                'role' => Role::all(),
                'penjadwalan_kps' => PenjadwalanKP::where('tanggal', '<', Carbon::today())->where('prodi_id', 2)->get(),
                'penjadwalan_sempros' => PenjadwalanSempro::where('status_seminar', '1')->where('prodi_id', 2)->get(),
                'penjadwalan_skripsis' => PenjadwalanSkripsi::where('status_seminar', '3')->where('prodi_id', 2)->get(),
            ]);
        }
        if (auth()->user()->role_id == 4) {            
            return view('penjadwalan.riwayat-penjadwalan', [
                'role' => Role::all(),
                'penjadwalan_kps' => PenjadwalanKP::where('tanggal', '<', Carbon::today())->where('prodi_id', 3)->get(),
                'penjadwalan_sempros' => PenjadwalanSempro::where('status_seminar', '1')->where('prodi_id', 3)->get(),
                'penjadwalan_skripsis' => PenjadwalanSkripsi::where('status_seminar', '3')->where('prodi_id', 3)->get(),
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
            ]);
        }
        if (auth()->user()->role_id == 10) {            
            return view('persetujuan.riwayat-koordinator', [                
                'penjadwalan_skripsis' => PenjadwalanSkripsi::where('status_seminar', 3)->where('prodi_id', 2)->get(),
            ]);
        }
        if (auth()->user()->role_id == 11) {            
            return view('persetujuan.riwayat-koordinator', [                
                'penjadwalan_skripsis' => PenjadwalanSkripsi::where('status_seminar', 3)->where('prodi_id', 3)->get(),
            ]);
        }
    }

    public function riwayat_kaprodi()
    {       
        if (auth()->user()->role_id == 6) {            
            return view('persetujuan.riwayat-kaprodi', [                
                'penjadwalan_skripsis' => PenjadwalanSkripsi::where('status_seminar', 3)->where('prodi_id', 1)->get(),
            ]);
        }
        if (auth()->user()->role_id == 7) {            
            return view('persetujuan.riwayat-kaprodi', [                
                'penjadwalan_skripsis' => PenjadwalanSkripsi::where('status_seminar', 3)->where('prodi_id', 2)->get(),
            ]);
        }
        if (auth()->user()->role_id == 8) {            
            return view('persetujuan.riwayat-kaprodi', [                
                'penjadwalan_skripsis' => PenjadwalanSkripsi::where('status_seminar', 3)->where('prodi_id', 3)->get(),
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
