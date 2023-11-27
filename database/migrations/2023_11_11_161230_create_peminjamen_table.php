<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeminjamenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjamen', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('user_id');
            $table->string('peminjam');
            $table->foreignId('barang_satu');
            $table->foreignId('barang_dua')->nullable();
            $table->foreignId('barang_tiga')->nullable();
            $table->string('tujuan');
            $table->string('ruangan');
            $table->dateTime('waktu_pinjam')->nullable();
            $table->string('penerima')->nullable();
            $table->dateTime('waktu_kembali')->nullable();
            $table->string('pengembali')->nullable();
            $table->string('jaminan');
            $table->string('status')->default('Usulan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peminjamen');
    }
}
