<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjadwalanKPSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjadwalan_kp', function (Blueprint $table) {
            $table->id();
            $table->string('pendaftarankp_id')->nullable();
            $table->string('mahasiswa_nim');
            $table->string('pembimbing_nip');
            $table->string('penguji_nip');
            $table->foreignId('prodi_id');                       
            $table->string('jenis_seminar')->default('KP');
            $table->string('judul_kp');
            $table->date('tanggal');
            $table->time('waktu');
            $table->string('lokasi');
            $table->string('status_seminar')->default(0);
            $table->string('dibuat_oleh');
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
        Schema::dropIfExists('penjadwalan_k_p_s');
    }
}
