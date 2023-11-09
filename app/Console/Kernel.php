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
        // ->where('tgl_disetujui_usulankp', '<=', now()->subMinutes(10))
        // ->update([
        //     'status_kp' => 'USULKAN KP ULANG',
        //     'keterangan' => 'Batas Waktu Habis'
        // ]);
        // })->everyMinute();

        // $schedule->call(function () {
        // \App\Models\PendaftaranSkripsi::whereNull('proposal')
        // ->where('tgl_disetujui_usuljudul', '<=', now()->subMinutes(6))
        // ->update([
        //     'status_skripsi' => 'USULKAN JUDUL ULANG',
        //     'keterangan' => 'Batas Waktu Daftar Seminar Proposal Habis'
        // ]);
        // })->everyMinute();
        
        // $schedule->call(function () {
        // \App\Models\PendaftaranKP::whereNull('surat_balasan')
        // ->where('tgl_disetujui_usulankp', '<=', now()->subDays(1))
        // ->update([
        //     'status_kp' => 'USULKAN KP ULANG',
        //     'keterangan' => 'Batas Waktu Habis']);
        // })->daily();

        // $schedule->call(function () {
        // \App\Models\PendaftaranKP::whereNull('judul_laporan')
        // ->where('tgl_disetujui_balasan', '<=', now()->subDays(1))
        // ->update(['status_kp' => 'USULKAN KP ULANG']);
        // })->daily();

        // $schedule->call(function () {
        // \App\Models\PendaftaranKP::whereNull('surat_balasan')
        // ->where('tgl_disetujui_usulankp', '<=', now()->subMonths(3))
        // ->update([
        //     'status_kp' => 'USULKAN KP ULANG',
        //     'keterangan' => 'Batas Waktu Unggah Surat Balasan Perusahaan Habis'
        // ]);
        // })->monthly();

        $schedule->call(function () {
        \App\Models\PendaftaranKP::whereNull('surat_balasan')
        ->where('tgl_disetujui_usulankp', '<=', now()->subMonths(1))
        ->update([
            'status_kp' => 'USULKAN KP ULANG',
            'alasan' => 'Batas Waktu Unggah Surat Balasan Perusahaan Habis',
            'keterangan' => 'Batas Waktu Unggah Surat Balasan Perusahaan Habis'
        ]);
        })->monthly();

        $schedule->call(function () {
        \App\Models\PendaftaranKP::whereNull('judul_laporan')
        ->where('tanggal_mulai', '<=', now()->subMonths(3))
        ->update([
            'status_kp' => 'USULKAN KP ULANG',
            'keterangan' => 'Batas Waktu Daftar Seminar KP Habis'
        ]);
        })->monthly();
        $schedule->call(function () {
        \App\Models\PendaftaranKP::whereNull('kpti_10')
        ->where('tgl_selesai_semkp', '<=', now()->subMonths(1))
        ->update([
            'status_kp' => 'USULKAN KP ULANG',
            'keterangan' => 'Batas Waktu Penyerahan Laporan Habis'
        ]);
        })->monthly();

        //SKRIPSI
        
        $schedule->call(function () {
        \App\Models\PendaftaranSkripsi::whereNull('tgl_created_sempro')
        ->where('tgl_disetujui_usuljudul', '<=', now()->subMonths(6))
        ->update([
            'status_skripsi' => 'USULKAN JUDUL ULANG',
            'keterangan' => 'Batas Waktu Daftar Seminar Proposal Habis'
        ]);
        })->monthly();

        $schedule->call(function () {
           \App\Models\PendaftaranSkripsi::whereNull('tgl_created_sidang')
        ->whereNull('tgl_created_perpanjangan1')
        ->whereNull('tgl_created_perpanjangan2')
        ->where('tgl_semproselesai', '<=', now()->subMonths(6))
        ->update([
            'status_skripsi' => 'USULKAN JUDUL ULANG',
            'keterangan' => 'Batas Waktu Daftar Sidang Skripsi Habis'
        ]);
        })->monthly();


        $schedule->call(function () {
            \App\Models\PendaftaranSkripsi::whereNull('tgl_created_sidang')
                ->whereNotNull('tgl_created_perpanjangan1')
                ->whereNull('tgl_created_perpanjangan2')
                ->where('tgl_semproselesai', '<=', now()->subMonths(9))
                ->update([
                    'status_skripsi' => 'USULKAN JUDUL ULANG',
                    'keterangan' => 'Batas Waktu Daftar Sidang Skripsi Habis'
                ]);
                })->monthly();
        
        $schedule->call(function () {
            \App\Models\PendaftaranSkripsi::whereNull('tgl_created_sidang')
                ->whereNotNull('tgl_created_perpanjangan1')
                ->whereNotNull('tgl_created_perpanjangan2')
                ->where('tgl_semproselesai', '<=', now()->subMonths(12))
                ->update([
                    'status_skripsi' => 'USULKAN JUDUL ULANG',
                    'keterangan' => 'Batas Waktu Daftar Sidang Skripsi Habis'
                ]);
                })->monthly();



        $schedule->call(function () {
        \App\Models\PendaftaranSkripsi::whereNull('tgl_created_sidang')
        ->where('tgl_semproselesai', '<=', now()->subMonths(9))
        ->update([
            'status_skripsi' => 'USULKAN JUDUL ULANG',
            'keterangan' => 'Batas Waktu Perpanjangan 1 Waktu Skripsi Habis'
        ]);
        })->monthly();

        $schedule->call(function () {
        \App\Models\PendaftaranSkripsi::whereNull('buku_skripsi_akhir')
        ->where('tgl_sidangselesai', '<=', now()->subMonths(1))
        ->update([
            'status_skripsi' => 'USULKAN JUDUL ULANG',
            'keterangan' => 'Batas Waktu Perpanjangan 1 Waktu Skripsi Habis'
        ]);
        })->monthly();

        $schedule->call(function () {
        \App\Models\PendaftaranSkripsi::whereNull('buku_skripsi_akhir')
        ->where('tgl_disetujui_sidang', '<=', now()->subMonths(1))
        ->update([
            'status_skripsi' => 'USULKAN JUDUL ULANG',
            'keterangan' => 'Batas Waktu Penyerahan Buku Skripsi Habis'
        ]);
        })->monthly();


        //BATAS PERSETUJUAN

       $schedule->call(function () {
        \App\Models\PendaftaranKP::whereNull('tgl_disetujui_usulankp_admin')
        ->where('tgl_created_usulankp', '<=', now()->subDays(3))
        ->update([
            'status_kp' => 'USULKAN KP ULANG',
            'alasan' => 'Usulan Anda belum disetujui Admin Prodi',
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
