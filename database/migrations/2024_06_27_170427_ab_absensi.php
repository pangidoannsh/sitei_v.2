<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AbAbsensi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ab_absensi', function (Blueprint $table) {
            $table->id();
            $table->string('nim_mahasiswa');
            $table->unsignedBigInteger('class_id');
            $table->unsignedBigInteger('perkuliahan_id');
            $table->string('nama_dosen');
            $table->string('mata_kuliah');
            $table->timestamp('attended_at');
            $table->enum('keterangan', ['Hadir', 'Sakit', 'Izin', 'Alpha']);
            $table->timestamps();

            // $table->foreign('student_id')->references('id')->on('mahasiswa')->onDelete('cascade');
            // $table->unique(['student_id', 'perkuliahan_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ab_absensi');
    }
}
