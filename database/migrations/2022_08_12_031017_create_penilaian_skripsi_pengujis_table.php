<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenilaianSkripsiPengujisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaian_skripsi_penguji', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penjadwalan_skripsi_id');
            $table->string('penguji_nip');
            $table->string('presentasi');
            $table->string('tingkat_penguasaan_materi');
            $table->string('keaslian');
            $table->string('ketepatan_metodologi');
            $table->string('penguasaan_dasar_teori');
            $table->string('kecermatan_perumusan_masalah');
            $table->string('tinjauan_pustaka');
            $table->string('tata_tulis');
            $table->string('tools');
            $table->string('penyajian_data');
            $table->string('hasil');
            $table->string('pembahasan');
            $table->string('kesimpulan');
            $table->string('luaran');
            $table->string('sumbangan_pemikiran');
            $table->string('revisi_naskah1')->nullable();
            $table->string('revisi_naskah2')->nullable();
            $table->string('revisi_naskah3')->nullable();
            $table->string('revisi_naskah4')->nullable();
            $table->string('revisi_naskah5')->nullable();
            $table->string('total_nilai_huruf');
            $table->string('total_nilai_angka');
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
        Schema::dropIfExists('penilaian_skripsi_pengujis');
    }
}
