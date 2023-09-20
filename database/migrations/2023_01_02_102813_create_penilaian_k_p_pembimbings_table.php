<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenilaianKPPembimbingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaian_kp_pembimbing', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penjadwalan_kp_id');
            $table->string('pembimbing_nip');
            $table->string('presentasi')->nullable();
            $table->string('materi')->nullable();
            $table->string('tanya_jawab')->nullable();
            $table->string('total_nilai_huruf')->nullable();
            $table->string('total_nilai_angka')->nullable();
            $table->string('catatan1')->nullable();
            $table->string('catatan2')->nullable();
            $table->string('catatan3')->nullable();
            $table->string('nilai_pembimbing_lapangan')->nullable();            
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
        Schema::dropIfExists('penilaian_k_p_pembimbings');
    }
}
