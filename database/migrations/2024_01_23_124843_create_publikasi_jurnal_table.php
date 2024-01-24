
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublikasiJurnalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publikasi_jurnal', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penjadwalan_skripsi_id');
            $table->string('indeksasi_jurnal')->nullable();
            $table->string('judul_jurnal')->nullable();
            $table->string('status_publikasi_jurnal')->nullable();
            $table->string('nilai');
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
        Schema::dropIfExists('publikasi_jurnal');
    }
}
