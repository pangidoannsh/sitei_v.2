<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendaftaranSkripsiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendaftaran_skripsi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_nim');
            $table->foreignId('prodi_id');
            $table->foreignId('konsentrasi_id');
            //usul judul
            $table->string('judul_skripsi');
            $table->string('krs_berjalan');
            $table->string('khs');
            $table->string('transkip_nilai');
            $table->string('pembimbing_1_nip');
            $table->string('pembimbing_2_nip')->nullable();
            $table->string('tgl_created_usuljudul')->nullable();
            $table->string('tgl_disetujui_usuljudul_admin')->nullable();
            $table->string('tgl_disetujui_usuljudul_pemb1')->nullable();
            $table->string('tgl_disetujui_usuljudul_pemb2')->nullable();
            $table->string('tgl_disetujui_usuljudul_koordinator')->nullable();
            $table->string('tgl_disetujui_usuljudul_kaprodi')->nullable();
            // daftar sempro

            $table->string('logbook')->nullable();
            $table->string('naskah')->nullable();
            $table->string('naskah_proposal')->nullable();
            $table->string('sti_30')->nullable();
            $table->string('sti_31')->nullable();
            $table->string('tgl_created_sempro')->nullable();
            $table->string('tgl_disetujui_sempro_pemb1')->nullable();
            $table->string('tgl_disetujui_sempro_pemb2')->nullable();
            $table->string('tgl_disetujui_sempro_admin')->nullable();
            //jadwal sempro
            $table->string('tgl_disetujui_jadwalsempro')->nullable();
            //sempro selesai
            $table->string('tgl_semproselesai')->nullable();
            //perpanjangan skripsi 1
            $table->string('sti_22')->nullable();
            $table->string('tgl_created_perpanjangan1')->nullable();
            $table->string('tgl_disetujui_perpanjangan1_pemb1')->nullable();
            $table->string('tgl_disetujui_perpanjangan1_kaprodi')->nullable();
            //perpanjangan skripsi 2

            $table->string('tgl_created_perpanjangan2')->nullable();
            $table->string('tgl_disetujui_perpanjangan2_pemb1')->nullable();
            $table->string('tgl_disetujui_perpanjangan2_kaprodi')->nullable();
            //daftar sidang
            $table->string('skor_turnitin')->nullable();
            $table->string('resume_turnitin')->nullable();
            $table->string('sti_9')->nullable();
            //  $table->string('sti_11')->nullable(); 
            //  $table->string('naskah_skripsi')->nullable(); 
            $table->string('konsultasi_pa')->nullable();
            $table->string('toefl')->nullable();
            $table->string('pasang_poster')->nullable();
            $table->string('sti_10')->nullable();
            $table->string('url_poster')->nullable();
            $table->string('tgl_created_sidang')->nullable();
            $table->string('tgl_disetujui_sidang_admin')->nullable();
            $table->string('tgl_disetujui_sidang_pemb1')->nullable();
            $table->string('tgl_disetujui_sidang_pemb2')->nullable();
            $table->string('tgl_disetujui_sidang_koordinator')->nullable();
            $table->string('tgl_disetujui_sidang_kaprodi')->nullable();
            //JADWAL SIDANG
            $table->string('tgl_disetujui_jadwal_sidang')->nullable();
            $table->string('tgl_selesai_sidang')->nullable();
            //STI-17 / PENYERAHAN BUKU SKRIPSI
            $table->string('sti_17')->nullable();
            $table->string('sti_29')->nullable();
            //  $table->string('buku_skripsi_akhir')->nullable();
            $table->string('tgl_created_sti_17')->nullable();
            $table->string('tgl_disetujui_sti_17_koordinator')->nullable();
            //perpanjangan revisi
            $table->string('sti_23')->nullable();
            $table->string('tgl_created_revisi')->nullable();
            $table->string('tgl_disetujui_revisi_pemb1')->nullable();
            $table->string('tgl_disetujui_revisi_kaprodi')->nullable();
            $table->string('tgl_revisi_spesial')->nullable();
            //Alasan ditolak
            $table->string('alasan')->nullable();

            $table->string('jenis_usulan')->default('Usulan Judul Skripsi');
            $table->string('status_skripsi')->default('USULAN JUDUL');
            $table->string('keterangan')->default('Menunggu persetujuan Admin Prodi');
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
        Schema::dropIfExists('pendaftaran_skripsi');
    }
}
