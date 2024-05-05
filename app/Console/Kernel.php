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
            // \App\Models\PendaftaranKP::whereNull('tgl_created_usulankp')
            //      ->where('status_kp', 'USULAN KP')
            //     ->where('created_at', '<', now()->subMinutes(1))
            //     ->update([
            //         'status_kp' => 'USULKAN KP ULANG',
            //         'keterangan' => 'Batas Waktu Habis Ya'
            //     ]);
            //  })->everyMinute->runInBackground();

    

        // $schedule->call(function () {
        // \App\Models\PendaftaranKP::whereNull('surat_balasan')
        // ->where('status_kp', 'USULAN KP DITERIMA')
        // ->where('tgl_disetujui_usulankp_kaprodi', '<', now()->subMonths(1))
        // ->update([
        //     'status_kp' => 'USULKAN KP ULANG',
        //     'alasan' => 'Batas Waktu Unggah Surat Balasan Perusahaan Habis',
        //     'keterangan' => 'Batas Waktu Unggah Surat Balasan Perusahaan Habis',
        //     'tgl_disetujui_usulankp_admin' => null,
        //     'tgl_disetujui_usulankp_pembimbing' => null,
        //     'tgl_disetujui_usulankp_koordinator' => null,
        //     'tgl_disetujui_usulankp_kaprodi' => null,
        // ]);
        // })->monthly()->runInBackground();

        $schedule->call(function () {
        \App\Models\PendaftaranKP::whereNull('judul_laporan')
        ->where('status_kp', 'KP DISETUJUI')
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
        })->daily()->runInBackground();
        
        $schedule->call(function () {
        \App\Models\PendaftaranKP::whereNull('kpti_10')
        ->where('status_kp', 'SEMINAR KP SELESAI')
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
        })->daily()->runInBackground();

        //SKRIPSI
        
        $schedule->call(function () {
        \App\Models\PendaftaranSkripsi::whereNull('tgl_created_sempro')
        ->where('status_skripsi', 'USULAN JUDUL')
        ->where('tgl_disetujui_usuljudul_kaprodi', '<', now()->subMonths(6))
        ->update([
            'status_skripsi' => 'USULKAN JUDUL ULANG',
            'keterangan' => 'Batas Waktu Daftar Seminar Proposal Habis'
        ]);
        })->daily()->runInBackground();

        
        $schedule->call(function () {
        \App\Models\PendaftaranSkripsi::whereNull('buku_skripsi_akhir')
        ->where('tgl_created_revisi', null)
        ->where('tgl_selesai_sidang', 'SIDANG SELESAI')
        ->where('tgl_selesai_sidang', '<', now()->subMonths(1))
        ->update([
            'status_skripsi' => 'USULKAN JUDUL ULANG',
            'keterangan' => 'Batas Waktu Peyerahan Buku Skripsi Habis'
        ]);
        })->daily()->runInBackground();

        $schedule->call(function () {
        \App\Models\PendaftaranSkripsi::whereNull('buku_skripsi_akhir')
        ->where('status_skripsi', 'PERPANJANGAN REVISI DISETUJUI')
        ->where('tgl_selesai_sidang', '<', now()->subMonths(2))
        ->update([
            'status_skripsi' => 'USULKAN JUDUL ULANG',
            'keterangan' => 'Batas Waktu Peyerahan Buku Skripsi Habis'
        ]);
        })->daily()->runInBackground();
        

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
