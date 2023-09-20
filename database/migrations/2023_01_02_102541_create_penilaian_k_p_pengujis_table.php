<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenilaianKPPengujisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaian_kp_penguji', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penjadwalan_kp_id');
            $table->string('penguji_nip');
            $table->string('presentasi')->nullable();
            $table->string('materi')->nullable();
            $table->string('tanya_jawab')->nullable();     
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
        Schema::dropIfExists('penilaian_k_p_pengujis');
    }
}
