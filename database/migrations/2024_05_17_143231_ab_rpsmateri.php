<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AbRpsmateri extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ab_rpsmateri', function (Blueprint $table) {
            $table->id();
            $table->foreignId('perkuliahan_id')->constrained('ab_perkuliahan');
            $table->enum('kesesuaian', ['Sesuai', 'Tidak Sesuai']);
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
        //
    }
}
