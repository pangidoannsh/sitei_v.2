<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBatalSeminarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('batal_seminar', function (Blueprint $table) {
            $table->id();
            $table->string("penjadwalan_sempro_id")->nullable();
            $table->string("penjadwalan_skripsi_id")->nullable();
            $table->string("mahasiswa_nim");
            $table->string("pembimbingsatu_nip")->nullable();
            $table->string("pembimbingdua_nip")->nullable();
            $table->string("pengujisatu_nip")->nullable();
            $table->string("pengujidua_nip")->nullable();
            $table->string("pengujitiga_nip")->nullable();
            $table->string("prodi_id");
            $table->string("jenis_seminar");
            $table->string("judul_skripsi");
            $table->string("tanggal")->nullable();
            $table->string("waktu")->nullable();
            $table->string("lokasi")->nullable();
            $table->string("alasan")->nullable();
            $table->string("dibuat_oleh")->nullable();
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
        Schema::dropIfExists('batal_seminar');
    }
}
