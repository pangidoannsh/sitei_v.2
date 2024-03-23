<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AbMatakuliah extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ab_matakuliah', function (Blueprint $table) {
            $table->id();
            $table->string('kode_mk');
            $table->string('mk');
            $table->string('kelas_id');
            $table->string('prodi_id');
            $table->string('sks');
            $table->string('semester_id');
            $table->string('nip_dosen');
            $table->string('dosen_2')->nullable();
            $table->enum('hari', ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat']);
            $table->string('jam');
            $table->string('ruangan_id');
            $table->string('kuota');
            $table->string('rps_pertemuan_1');
            $table->string('rps_pertemuan_2');
            $table->string('rps_pertemuan_3');
            $table->string('rps_pertemuan_4');
            $table->string('rps_pertemuan_5');
            $table->string('rps_pertemuan_6');
            $table->string('rps_pertemuan_7');
            $table->string('rps_pertemuan_8');
            $table->string('rps_pertemuan_9');
            $table->string('rps_pertemuan_10');
            $table->string('rps_pertemuan_11');
            $table->string('rps_pertemuan_12');
            $table->string('rps_pertemuan_13');
            $table->string('rps_pertemuan_14');
            $table->string('rps_pertemuan_15');
            $table->string('rps_pertemuan_16');
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
        Schema::dropIfExists('ab_matakuliah');
    }
}
