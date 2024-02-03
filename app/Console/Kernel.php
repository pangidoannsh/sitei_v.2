<?php

namespace App\Console;

use App\Models\PendaftaranKP;
use App\Models\PendaftaranSkripsi;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->call(function () {
        // \App\Models\PendaftaranKP::whereNull('surat_balasan')
        // ->where('tgl_disetujui_usulankp', '<', now()->subMinutes(10))
        // ->update([
        //     'status_kp' => 'USULKAN KP ULANG',
        //     'keterangan' => 'Batas Waktu Habis'
        // ]);
        // })->everyMinute();

        // $schedule->call(function () {
        // \App\Models\PendaftaranSkripsi::whereNull('proposal')
        // ->where('tgl_disetujui_usuljudul', '<', now()->subMinutes(6))
        // ->update([
        //     'status_skripsi' => 'USULKAN JUDUL ULANG',
        //     'keterangan' => 'Batas Waktu Daftar Seminar Proposal Habis'
        // ]);
        // })->everyMinute();
        
        // $schedule->call(function () {
        // \App\Models\PendaftaranKP::whereNull('surat_balasan')
        // ->where('tgl_disetujui_usulankp', '<', now()->subDays(1))
        // ->update([
        //     'status_kp' => 'USULKAN KP ULANG',
        //     'keterangan' => 'Batas Waktu Habis']);
        // })->daily();

        // $schedule->call(function () {
        // \App\Models\PendaftaranKP::whereNull('judul_laporan')
        // ->where('tgl_disetujui_balasan', '<', now()->subDays(1))
        // ->update(['status_kp' => 'USULKAN KP ULANG']);
        // })->daily();

        // $schedule->call(function () {
        // \App\Models\PendaftaranKP::whereNull('surat_balasan')
        // ->where('tgl_disetujui_usulankp', '<', now()->subMonths(3))
        // ->update([
        //     'status_kp' => 'USULKAN KP ULANG',
        //     'keterangan' => 'Batas Waktu Unggah Surat Balasan Perusahaan Habis'
        // ]);
        // })->monthly();

        $schedule->call(function () {
        \App\Models\PendaftaranKP::whereNull('surat_balasan')
        ->where('tgl_disetujui_usulankp_kaprodi', '<', now()->subMonths(1))
        ->update([
            'status_kp' => 'USULKAN KP ULANG',
            'alasan' => 'Batas Waktu Unggah Surat Balasan Perusahaan Habis',
            'keterangan' => 'Batas Waktu Unggah Surat Balasan Perusahaan Habis',
            'alasan' => 'Batas Waktu Unggah Surat Balasan Perusahaan Habis',
            'tgl_disetujui_usulankp_admin' => null,
            'tgl_disetujui_usulankp_pembimbing' => null,
            'tgl_disetujui_usulankp_koordinator' => null,
            'tgl_disetujui_usulankp_kaprodi' => null,
        ]);
        })->monthly();

        $schedule->call(function () {
        \App\Models\PendaftaranKP::whereNull('judul_laporan')
        ->where('tanggal_mulai', '<', now()->subMonths(3))
        ->update([
            'status_kp' => 'USULKAN KP ULANG',
            'keterangan' => 'Batas Waktu Daftar Seminar KP Habis',
            'alasan' => 'Batas Waktu Daftar Seminar KP Habis',
            'tgl_disetujui_usulankp_admin' => null,
            'tgl_disetujui_usulankp_pembimbing' => null,
            'tgl_disetujui_usulankp_koordinator' => null,
            'tgl_disetujui_usulankp_kaprodi' => null,

            'surat_balasan' => null,
            'tgl_disetujui_balasan' => null,
        ]);
        })->monthly();
        $schedule->call(function () {
        \App\Models\PendaftaranKP::whereNull('kpti_10')
        ->where('tgl_selesai_semkp', '<', now()->subMonths(1))
        ->update([
            'status_kp' => 'USULKAN KP ULANG',
            'keterangan' => 'Batas Waktu Penyerahan Laporan Habis',
            'alasan' => 'Batas Waktu Penyerahan Laporan Habis',
            'tgl_disetujui_usulankp_admin' => null,
            'tgl_disetujui_usulankp_pembimbing' => null,
            'tgl_disetujui_usulankp_koordinator' => null,
            'tgl_disetujui_usulankp_kaprodi' => null,

            'surat_balasan' => null,
            'tgl_disetujui_balasan' => null,

            'judul_laporan' => null,
            'tgl_disetujui_semkp_admin' => null,
            'tgl_disetujui_semkp_pembimbing' => null,
            'tgl_disetujui_semkp_koordinator' => null,
            'tgl_disetujui_semkp_kaprodi' => null,
        ]);
        })->monthly();

        //SKRIPSI
        
        $schedule->call(function () {
        \App\Models\PendaftaranSkripsi::whereNull('tgl_created_sempro')
        ->where('tgl_disetujui_usuljudul', '<', now()->subMonths(6))
        ->update([
            'status_skripsi' => 'USULKAN JUDUL ULANG',
            'keterangan' => 'Batas Waktu Daftar Seminar Proposal Habis'
        ]);
        })->monthly();

        // $schedule->call(function () {
        //    \App\Models\PendaftaranSkripsi::whereNull('tgl_created_sidang')
        // ->whereNull('tgl_created_perpanjangan1')
        // ->whereNull('tgl_created_perpanjangan2')
        // ->where('tgl_semproselesai', '<', now()->subMonths(6))
        // ->update([
        //     'status_skripsi' => 'USULKAN JUDUL ULANG',
        //     'keterangan' => 'Batas Waktu Daftar Sidang Skripsi Habis'
        // ]);
        // })->monthly();

        // $schedule->call(function () {
        //     \App\Models\PendaftaranSkripsi::whereNull('tgl_created_sidang')
        //         ->whereNotNull('tgl_created_perpanjangan1')
        //         ->whereNull('tgl_created_perpanjangan2')
        //         ->where('tgl_semproselesai', '<', now()->subMonths(9))
        //         ->update([
        //             'status_skripsi' => 'USULKAN JUDUL ULANG',
        //             'keterangan' => 'Batas Waktu Daftar Sidang Skripsi Habis'
        //         ]);
        //         })->monthly();
        
        // $schedule->call(function () {
        //     \App\Models\PendaftaranSkripsi::whereNull('tgl_created_sidang')
        //         ->whereNotNull('tgl_created_perpanjangan1')
        //         ->whereNotNull('tgl_created_perpanjangan2')
        //         ->where('tgl_semproselesai', '<', now()->subMonths(12))
        //         ->update([
        //             'status_skripsi' => 'USULKAN JUDUL ULANG',
        //             'keterangan' => 'Batas Waktu Daftar Sidang Skripsi Habis'
        //         ]);
        //         })->monthly();



        $schedule->call(function () {
        \App\Models\PendaftaranSkripsi::whereNull('tgl_created_sidang')
        ->where('tgl_semproselesai', '<', now()->subMonths(9))
        ->update([
            'status_skripsi' => 'USULKAN JUDUL ULANG',
            'keterangan' => 'Batas Waktu Perpanjangan 1 Waktu Skripsi Habis'
        ]);
        })->monthly();

        $schedule->call(function () {
        \App\Models\PendaftaranSkripsi::whereNull('buku_skripsi_akhir')
        ->where('tgl_sidangselesai', '<', now()->subMonths(1))
        ->update([
            'status_skripsi' => 'USULKAN JUDUL ULANG',
            'keterangan' => 'Batas Waktu Perpanjangan 1 Waktu Skripsi Habis'
        ]);
        })->monthly();

        $schedule->call(function () {
        \App\Models\PendaftaranSkripsi::whereNull('buku_skripsi_akhir')
        ->where('tgl_disetujui_sidang', '<', now()->subMonths(1))
        ->update([
            'status_skripsi' => 'USULKAN JUDUL ULANG',
            'keterangan' => 'Batas Waktu Penyerahan Buku Skripsi Habis'
        ]);
        })->monthly();


        // PERSETUJUAN KP

       $schedule->call(function () {
        \App\Models\PendaftaranKP::whereNull('tgl_disetujui_usulankp_admin')
        ->where('tgl_created_usulankp', '<', now()->subDays(3))
        ->update([
            'status_kp' => 'USULKAN KP ULANG',
            'keterangan' => 'Usulan belum disetujui Admin Prodi',
            'alasan' => 'Silahkan Usulkan KP Ulang',
        ]);
        })->daily();
       
        $schedule->call(function () {
        \App\Models\PendaftaranKP::whereNull('tgl_disetujui_usulankp_pembimbing')
        ->where('tgl_disetujui_usulankp_admin', '<', now()->subDays(3))
        ->update([
            'status_kp' => 'USULKAN KP ULANG',
            'keterangan' => 'Usulan belum disetujui Pembimbing',
            'alasan' => 'Silahkan Usulkan KP Ulang',
            'tgl_disetujui_usulankp_admin' => null,
        ]);
        })->daily();

        $schedule->call(function () {
        \App\Models\PendaftaranKP::whereNull('tgl_disetujui_usulankp_koordinator')
        ->where('tgl_disetujui_usulankp_pembimbing', '<', now()->subDays(3))
        ->update([
            'status_kp' => 'USULKAN KP ULANG',
            'keterangan' => 'Usulan belum disetujui Koordinator',
            'alasan' => 'Silahkan Usulkan KP Ulang',
            'tgl_disetujui_usulankp_admin' => null,
            'tgl_disetujui_usulankp_pembimbing' => null,
        ]);
        })->daily();

        $schedule->call(function () {
        \App\Models\PendaftaranKP::whereNull('tgl_disetujui_usulankp_kaprodi')
        ->where('tgl_disetujui_usulankp_koordinator', '<', now()->subDays(3))
        ->update([
            'status_kp' => 'USULKAN KP ULANG',
            'keterangan' => 'Usulan belum disetujui Kaprodi',
            'alasan' => 'Silahkan Usulkan KP Ulang',
            'tgl_disetujui_usulankp_admin' => null,
            'tgl_disetujui_usulankp_pembimbing' => null,
            'tgl_disetujui_usulankp_koordinator' => null,
        ]);
        })->daily();
       
    //    BALASAN KP 
        $schedule->call(function () {
        \App\Models\PendaftaranKP::whereNull('tgl_disetujui_balasan')
        ->where('tgl_created_balasan', '<', now()->subDays(3))
        ->update([
            'status_kp' => 'SURAT PERUSAHAAN DITOLAK',
            'keterangan' => 'Surat Perusahaan belum disetujui Koordinator KP',
            'alasan' => 'Silahkan Unggah Ulang Surat Balasan Perusahaan!',
        ]);
        })->daily();
       
        //DAFTAR SEMINAR KP
        $schedule->call(function () {
        \App\Models\PendaftaranKP::whereNull('tgl_disetujui_semkp_admin')
        ->where('tgl_created_semkp', '<', now()->subDays(3))
        ->update([
            'status_kp' => 'DAFTAR SEMINAR KP ULANG',
            'keterangan' => 'Surat Perusahaan belum disetujui Koordinator KP',
            'alasan' => 'Silahkan Unggah Ulang Surat Balasan Perusahaan!',
        ]);
        })->daily();
        
        $schedule->call(function () {
        \App\Models\PendaftaranKP::whereNull('tgl_disetujui_semkp_pembimbing')
        ->where('tgl_disetujui_semkp_admin', '<', now()->subDays(3))
        ->update([
            'status_kp' => 'DAFTAR SEMINAR KP ULANG',
            'keterangan' => 'Surat Perusahaan belum disetujui Koordinator KP',
            'alasan' => 'Silahkan Unggah Ulang Surat Balasan Perusahaan!',
            'tgl_disetujui_semkp_admin' => null,
        ]);
        })->daily();
        
        $schedule->call(function () {
        \App\Models\PendaftaranKP::whereNull('tgl_disetujui_semkp_koordinator')
        ->where('tgl_disetujui_semkp_pembimbing', '<', now()->subDays(3))
        ->update([
            'status_kp' => 'DAFTAR SEMINAR KP ULANG',
            'keterangan' => 'Surat Perusahaan belum disetujui Koordinator KP',
            'alasan' => 'Silahkan Unggah Ulang Surat Balasan Perusahaan!',
            'tgl_disetujui_semkp_admin' => null,
            'tgl_disetujui_semkp_pembimbing' => null,
        ]);
        })->daily();
        
        $schedule->call(function () {
        \App\Models\PendaftaranKP::whereNull('tgl_disetujui_semkp_kaprodi')
        ->where('tgl_disetujui_semkp_koordinator', '<', now()->subDays(3))
        ->update([
            'status_kp' => 'DAFTAR SEMINAR KP ULANG',
            'keterangan' => 'Surat Perusahaan belum disetujui Koordinator KP',
            'alasan' => 'Silahkan Unggah Ulang Surat Balasan Perusahaan!',
            'tgl_disetujui_semkp_admin' => null,
            'tgl_disetujui_semkp_pembimbing' => null,
            'tgl_disetujui_semkp_koordinator' => null,
        ]);
        })->daily();

        //BUKTI PENYERAHAN LAPORAN

        $schedule->call(function () {
        \App\Models\PendaftaranKP::whereNull('tgl_disetujui_kpti_10_koordinator')
        ->where('tgl_created_kpti10', '<', now()->subDays(3))
        ->update([
            'status_kp' => 'SURAT PERUSAHAAN DITOLAK',
            'keterangan' => 'Surat Perusahaan belum disetujui Koordinator KP',
            'alasan' => 'Silahkan Unggah Ulang Surat Balasan Perusahaan!',
        ]);
        })->daily();
        
        $schedule->call(function () {
        \App\Models\PendaftaranKP::whereNull('tgl_disetujui_kpti_10_kaprodi')
        ->where('tgl_disetujui_kpti_10_koordinator', '<', now()->subDays(3))
        ->update([
            'status_kp' => 'SURAT PERUSAHAAN DITOLAK',
            'keterangan' => 'Surat Perusahaan belum disetujui Koordinator KP',
            'alasan' => 'Silahkan Unggah Ulang Surat Balasan Perusahaan!',
            'tgl_disetujui_kpti_10_koordinator' => null,
        ]);
        })->daily();



        //BATAS PERSETUJUAN SKRIPSI

        //UDUL JUDUL
        $schedule->call(function () {
        \App\Models\PendaftaranSkripsi::whereNull('tgl_disetujui_usuljudul_admin')
        ->where('tgl_created_usuljudul', '<', now()->subDays(3))
        ->update([
            'status_kp' => 'USULKAN JUDUL ULANG',
            'keterangan' => 'Usulan Judul belum disetujui Admin Prodi',
            'alasan' => 'Silahkan Usulkan Judul ulang!',
        ]);
        })->daily();
        
        $schedule->call(function () {
        \App\Models\PendaftaranSkripsi::whereNull('tgl_disetujui_usuljudul_pemb1')
        ->where('tgl_disetujui_usuljudul_admin', '<', now()->subDays(3))
        ->update([
            'status_kp' => 'USULKAN JUDUL ULANG',
            'keterangan' => 'Usulan Judul belum disetujui Pembimbing 1',
            'alasan' => 'Silahkan Usulkan Judul ulang!',
            'tgl_disetujui_usuljudul_admin' => null,
        ]);
        })->daily();
        
        $schedule->call(function () {
        \App\Models\PendaftaranSkripsi::whereNull('tgl_disetujui_usuljudul_pemb2')
        ->where('tgl_disetujui_usuljudul_pemb1', '<', now()->subDays(3))
        ->update([
            'status_kp' => 'USULKAN JUDUL ULANG',
            'keterangan' => 'Usulan Judul belum disetujui Pembimbing 2',
            'alasan' => 'Silahkan Usulkan Judul ulang!',
            'tgl_disetujui_usuljudul_admin' => null,
            'tgl_disetujui_usuljudul_pemb1' => null,
        ]);
        })->daily();
        
        $schedule->call(function () {
        \App\Models\PendaftaranSkripsi::whereNull('tgl_disetujui_usuljudul_koordinator')
        ->where('tgl_disetujui_usuljudul_pemb2', '<', now()->subDays(3))
        ->update([
            'status_kp' => 'USULKAN JUDUL ULANG',
            'keterangan' => 'Usulan Judul belum disetujui Koordinator Skripsi',
            'alasan' => 'Silahkan Usulkan Judul ulang!',
            'tgl_disetujui_usuljudul_admin' => null,
            'tgl_disetujui_usuljudul_pemb1' => null,
            'tgl_disetujui_usuljudul_pemb2' => null,
        ]);
        })->daily();
        
        $schedule->call(function () {
        \App\Models\PendaftaranSkripsi::whereNull('tgl_disetujui_usuljudul_kaprodi')
        ->where('tgl_disetujui_usuljudul_koordinator', '<', now()->subDays(3))
        ->update([
            'status_kp' => 'USULKAN JUDUL ULANG',
            'keterangan' => 'Usulan Judul belum disetujui Koordinator Program Studi',
            'alasan' => 'Silahkan Usulkan Judul ulang!',
            'tgl_disetujui_usuljudul_admin' => null,
            'tgl_disetujui_usuljudul_pemb1' => null,
            'tgl_disetujui_usuljudul_pemb2' => null,
            'tgl_disetujui_usuljudul_koordinator' => null,
        ]);
        })->daily();


        //DAFTAR SEMPRO
         $schedule->call(function () {
        \App\Models\PendaftaranSkripsi::whereNull('tgl_disetujui_sempro_pemb1')
        ->where('tgl_created_sempro', '<', now()->subDays(3))
        ->update([
            'status_kp' => 'DAFTAR SEMPRO ULANG',
            'keterangan' => 'Pendaftaran Seminar Proposal belum disetujui Pembimbing 1',
            'alasan' => 'Silahkan Daftar Sempro ulang!',
        ]);
        })->daily();
        
        $schedule->call(function () {
        \App\Models\PendaftaranSkripsi::whereNull('tgl_disetujui_sempro_pemb2')
        ->where('tgl_disetujui_sempro_pemb1', '<', now()->subDays(3))
        ->update([
            'status_kp' => 'DAFTAR SEMPRO ULANG',
            'keterangan' => 'Pendaftaran Seminar Proposal belum disetujui Pembimbing 2',
            'alasan' => 'Silahkan Daftar Sempro ulang!',
            'tgl_disetujui_sempro_pemb1' => null,
        ]);
        })->daily();
        
        $schedule->call(function () {
        \App\Models\PendaftaranSkripsi::whereNull('tgl_disetujui_sempro_admin')
        ->where('tgl_disetujui_sempro_pemb2', '<', now()->subDays(3))
        ->update([
            'status_kp' => 'DAFTAR SEMPRO ULANG',
            'keterangan' => 'Pendaftaran Seminar Proposal belum disetujui Admin Prodi',
            'alasan' => 'Silahkan Daftar Sempro ulang!',
            'tgl_disetujui_sempro_pemb1' => null,
            'tgl_disetujui_sempro_pemb2' => null,
        ]);
        })->daily();

        //PERPANJANGAN 1

         $schedule->call(function () {
        \App\Models\PendaftaranSkripsi::whereNull('tgl_disetujui_perpanjangan1_pemb1')
        ->where('tgl_created_perpanjangan1', '<', now()->subDays(3))
        ->update([
            'status_kp' => 'PERPANJANGAN 1 DITOLAK',
            'keterangan' => 'Usulan Perpanjangan 1 belum disetujui Pembimbing 1',
            'alasan' => 'Silahkan Usulkan Perpanjangan 1 ulang!',
        ]);
        })->daily();
        
        $schedule->call(function () {
        \App\Models\PendaftaranSkripsi::whereNull('tgl_disetujui_perpanjangan1_kaprodi')
        ->where('tgl_disetujui_perpanjangan1_pemb1', '<', now()->subDays(3))
        ->update([
            'status_kp' => 'PERPANJANGAN 1 DITOLAK',
            'keterangan' => 'Usulan Perpanjangan 1 belum disetujui Koordinator Program Studi',
            'alasan' => 'Silahkan Usulkan Perpanjangan 1 ulang!',
            'tgl_disetujui_perpanjangan1_pemb1' => null,
        ]);
        })->daily();
        
        //PERPANJANGAN 2

         $schedule->call(function () {
        \App\Models\PendaftaranSkripsi::whereNull('tgl_disetujui_perpanjangan2_pemb1')
        ->where('tgl_created_perpanjangan2', '<', now()->subDays(3))
        ->update([
            'status_kp' => 'PERPANJANGAN 2 DITOLAK',
            'keterangan' => 'Usulan Perpanjangan 2 belum disetujui Pembimbing 1',
            'alasan' => 'Silahkan Usulkan Perpanjangan 2 ulang!',
        ]);
        })->daily();
        
        $schedule->call(function () {
        \App\Models\PendaftaranSkripsi::whereNull('tgl_disetujui_perpanjangan2_kaprodi')
        ->where('tgl_disetujui_perpanjangan2_pemb2', '<', now()->subDays(3))
        ->update([
            'status_kp' => 'PERPANJANGAN 2 DITOLAK',
            'keterangan' => 'Usulan Perpanjangan 2 belum disetujui Koordinator Program Studi',
            'alasan' => 'Silahkan Usulkan Perpanjangan 2 ulang!',
            'tgl_disetujui_perpanjangan2_pemb1' => null,
        ]);
        })->daily();

        // DAFTAR SIDANG
        $schedule->call(function () {
        \App\Models\PendaftaranSkripsi::whereNull('tgl_disetujui_sidang_admin')
        ->where('tgl_created_sidang', '<', now()->subDays(3))
        ->update([
            'status_kp' => 'DAFTAR SIDANG ULANG',
            'keterangan' => 'Pendaftaran Sidang Skripsi belum disetujui Admin Prodi',
            'alasan' => 'Silahkan Daftar Sidang ulang!',
        ]);
        })->daily();
        
        $schedule->call(function () {
        \App\Models\PendaftaranSkripsi::whereNull('tgl_disetujui_sidang_pemb1')
        ->where('tgl_disetujui_sidang_admin', '<', now()->subDays(3))
        ->update([
            'status_kp' => 'DAFTAR SIDANG ULANG',
            'keterangan' => 'Pendaftaran Sidang Skripsi belum disetujui Pembimbing 1',
            'alasan' => 'Silahkan Daftar Sidang ulang!',
            'tgl_disetujui_sidang_admin' => null,
        ]);
        })->daily();
        
        $schedule->call(function () {
        \App\Models\PendaftaranSkripsi::whereNull('tgl_disetujui_sidang_pemb2')
        ->where('tgl_disetujui_sidang_pemb1', '<', now()->subDays(3))
        ->update([
            'status_kp' => 'DAFTAR SIDANG ULANG',
            'keterangan' => 'Pendaftaran Sidang Skripsi belum disetujui Pembimbing 2',
            'alasan' => 'Silahkan Daftar Sidang ulang!',
            'tgl_disetujui_sidang_admin' => null,
            'tgl_disetujui_sidang_pemb1' => null,
        ]);
        })->daily();
        
        $schedule->call(function () {
        \App\Models\PendaftaranSkripsi::whereNull('tgl_disetujui_sidang_koordinator')
        ->where('tgl_disetujui_sidang_pemb2', '<', now()->subDays(3))
        ->update([
            'status_kp' => 'DAFTAR SIDANG ULANG',
            'keterangan' => 'Pendaftaran Sidang Skripsi belum disetujui Koordinator Skripsi',
            'alasan' => 'Silahkan Daftar Sidang ulang!',
            'tgl_disetujui_sidang_admin' => null,
            'tgl_disetujui_sidang_pemb1' => null,
            'tgl_disetujui_sidang_pemb2' => null,
        ]);
        })->daily();
        
        $schedule->call(function () {
        \App\Models\PendaftaranSkripsi::whereNull('tgl_disetujui_sidang_kaprodi')
        ->where('tgl_disetujui_sidang_koordinator', '<', now()->subDays(3))
        ->update([
            'status_kp' => 'DAFTAR SIDANG ULANG',
            'keterangan' => 'Pendaftaran Sidang Skripsi belum disetujui Koordinator Program Studi',
            'alasan' => 'Silahkan Daftar Sidang ulang!',
            'tgl_disetujui_sidang_admin' => null,
            'tgl_disetujui_sidang_pemb1' => null,
            'tgl_disetujui_sidang_pemb2' => null,
            'tgl_disetujui_sidang_koordinator' => null,
        ]);
        })->daily();

        // PERPANJANGAN REVISI
         $schedule->call(function () {
        \App\Models\PendaftaranSkripsi::whereNull('tgl_disetujui_revisi_pemb1')
        ->where('tgl_created_revisi', '<', now()->subDays(3))
        ->update([
            'status_kp' => 'PERPANJANGAN 2 DITOLAK',
            'keterangan' => 'Usulan Perpanjangan 2 belum disetujui Pembimbing 1',
            'alasan' => 'Silahkan Usulkan Perpanjangan 2 ulang!',
        ]);
        })->daily();
        
        $schedule->call(function () {
        \App\Models\PendaftaranSkripsi::whereNull('tgl_disetujui_revisi_kaprodi')
        ->where('tgl_disetujui_revisi_pemb1', '<', now()->subDays(3))
        ->update([
            'status_kp' => 'PERPANJANGAN 2 DITOLAK',
            'keterangan' => 'Usulan Perpanjangan 2 belum disetujui Koordinator Program Studi',
            'alasan' => 'Silahkan Usulkan Perpanjangan 2 ulang!',
            'tgl_disetujui_revisi_pemb1' => null,
        ]);
        })->daily();
        
        // PENYERAHAN BUKU SKRIPSI
         $schedule->call(function () {
        \App\Models\PendaftaranSkripsi::whereNull('tgl_disetujui_sti_17_koordinator')
        ->where('tgl_created_sti_17', '<', now()->subDays(3))
        ->update([
            'status_kp' => 'BUKTI PENYERAHAN BUKU SKRIPSI DITOLAK',
            'keterangan' => 'Bukti Penyerahan Buku Skripsi belum disetujui Koordinator Skripsi',
            'alasan' => 'Silahkan Usulkan Bukti Penyerahan Buku Skripsi ulang!',
        ]);
        })->daily();
        

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
