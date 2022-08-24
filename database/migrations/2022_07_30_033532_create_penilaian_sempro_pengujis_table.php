<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenilaianSemproPengujisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaian_sempro_penguji', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penjadwalan_sempro_id');
            $table->string('penguji_nip');
            $table->string('presentasi')->nullable();
            $table->string('tingkat_penguasaan_materi')->nullable();
            $table->string('keaslian')->nullable();
            $table->string('ketepatan_metodologi')->nullable();
            $table->string('penguasaan_dasar_teori')->nullable();
            $table->string('kecermatan_perumusan_masalah')->nullable();
            $table->string('tinjauan_pustaka')->nullable();
            $table->string('tata_tulis')->nullable();
            $table->string('sumbangan_pemikiran')->nullable();
            $table->string('revisi_naskah1')->nullable();
            $table->string('revisi_naskah2')->nullable();
            $table->string('revisi_naskah3')->nullable();
            $table->string('revisi_naskah4')->nullable();
            $table->string('revisi_naskah5')->nullable();
            $table->string('total_nilai_huruf')->nullable();
            $table->string('total_nilai_angka')->nullable();
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
        Schema::dropIfExists('penilaian_sempro_pengujis');
    }
}
