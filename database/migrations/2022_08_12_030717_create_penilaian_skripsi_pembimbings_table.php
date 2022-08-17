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
            $table->string('penguasaan_dasar_teori');
            $table->string('tingkat_penguasaan_materi');
            $table->string('tinjauan_pustaka');
            $table->string('tata_tulis');
            $table->string('hasil_dan_pembahasan');
            $table->string('sikap_dan_kepribadian');
            $table->string('total_nilai_angka');
            $table->string('total_nilai_huruf');
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
