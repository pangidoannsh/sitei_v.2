<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AbJenisPerkuliahan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ab_jenis_perkuliahan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mata_kuliah_id')->constrained('ab_matakuliah')->onDelete('cascade');
            $table->enum('jenis_perkuliahan', ['Offline', 'Online']);
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
        Schema::dropIfExists('ab_jenis_perkuliahan');
    }
}
