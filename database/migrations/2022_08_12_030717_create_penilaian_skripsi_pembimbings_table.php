<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenilaianSkripsiPembimbingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaian_skripsi_pembimbing', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penjadwalan_skripsi_id');
            $table->string('pembimbing_nip');
            $table->string('penguasaan_dasar_teori')->nullable();
            $table->string('tingkat_penguasaan_materi')->nullable();
            $table->string('tinjauan_pustaka')->nullable();
            $table->string('tata_tulis')->nullable();
            $table->string('hasil_dan_pembahasan')->nullable();
            $table->string('sikap_dan_kepribadian')->nullable();
            $table->string('total_nilai_angka')->nullable();
            $table->string('total_nilai_huruf')->nullable();
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
        Schema::dropIfExists('penilaian_skripsi_pembimbings');
    }
}
