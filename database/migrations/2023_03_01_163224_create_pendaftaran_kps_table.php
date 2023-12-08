<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendaftaranKPSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendaftaran_kp', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_nim');
            // $table->string('mahasiswa_nama');
            $table->foreignId('prodi_id');
            $table->foreignId('konsentrasi_id');
            // usulankp
            $table->string('krs_berjalan');  
            $table->string('transkip_nilai');  
            $table->string('dosen_pembimbing_nip');
            $table->string('nama_perusahaan');
            $table->string('alamat_perusahaan');
            $table->string('bidang_usaha');
            $table->string('tanggal_rencana');
            $table->string('tgl_created_usulankp')->nullable();
            $table->string('tgl_disetujui_usulankp_admin')->nullable();
            $table->string('tgl_disetujui_usulankp_pembimbing')->nullable();
            $table->string('tgl_disetujui_usulankp_koordinator')->nullable();
            $table->string('tgl_disetujui_usulankp_kaprodi')->nullable();
            // surat balasan kp
            $table->string('surat_balasan')->nullable();
            $table->string('tanggal_mulai')->nullable();
            $table->string('tgl_created_balasan')->nullable();
            $table->string('tgl_disetujui_balasan')->nullable();
            // usulan seminar kp
            $table->string('judul_laporan')->nullable();
            $table->string('laporan_kp')->nullable();
            $table->string('kpti_11')->nullable();
            $table->string('sti_31')->nullable();
            $table->string('tgl_created_semkp')->nullable();
            $table->string('tgl_disetujui_semkp_admin')->nullable();
            $table->string('tgl_disetujui_semkp_pembimbing')->nullable();
            $table->string('tgl_disetujui_semkp_koordinator')->nullable();
            $table->string('tgl_disetujui_semkp_kaprodi')->nullable();
            //kp dijadwalkan
            $table->string('tgl_dijadwalkan')->nullable();
            //kp selesai
            $table->string('tgl_selesai_semkp')->nullable();
            //LAPORAN/KPTI-10
            $table->string('kpti_10')->nullable();
            $table->string('laporan_akhir')->nullable();
            $table->string('tgl_created_kpti10')->nullable();
            // $table->string('tgl_disetujui_kpti_10_admin')->nullable();
            // $table->string('tgl_disetujui_kpti_10_pembimbing')->nullable();
            $table->string('tgl_disetujui_kpti_10_koordinator')->nullable();
            $table->string('tgl_disetujui_kpti_10_kaprodi')->nullable();
            //Alasan ditolak
            $table->string('alasan')->nullable();
            $table->string('pesan')->nullable();

            $table->string('jenis_usulan')->default('Usulan Kerja Praktek');
            $table->string('status_kp')->default('USULAN KP');
            $table->string('keterangan')->default('Menunggu persetujuan Admin Prodi');
            // $table->string('persetujuan')->default('Menunggu persetujuan Koordinator KP');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pendaftaran_kp');
    }
}
