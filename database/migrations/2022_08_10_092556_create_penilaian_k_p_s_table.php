<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenilaianKPSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaian_kp', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penjadwalan_kp_id');
            $table->string('penguji_nip');
            $table->string('presentasi');
            $table->string('materi');
            $table->string('tanya_jawab');
            $table->string('total_nilai_seminar');
            $table->string('nilai_pembimbing_lapangan');
            $table->string('nilai_pembimbing_kp');
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
        Schema::dropIfExists('penilaian_k_p_s');
    }
}
