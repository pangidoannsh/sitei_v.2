<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AbPerkuliahan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ab_perkuliahan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mata_kuliah_id')->constrained('ab_matakuliah');
            $table->integer('nomor_pertemuan')->unsigned();
            $table->text('materi');
            $table->enum('jenis_perkuliahan', ['Luring', 'Daring']);
            $table->integer('buka_pertemuan')->nullable()->default(NULL);
            $table->enum('status', ['Perkuliahan Dimulai', 'Perkuliahan Selesai'])->default('Perkuliahan Dimulai');
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
        Schema::dropIfExists('ab_perkuliahan');
    }
}
