<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesanKpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesan_kp', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_nim');
            $table->foreignId('pendaftaran_kp_id');
            $table->string('mahasiswa_nama');
            $table->foreignId('prodi_id');
            $table->foreignId('konsentrasi_id');
            $table->string('pesan');

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
        Schema::dropIfExists('pesan_kp');
    }
}
