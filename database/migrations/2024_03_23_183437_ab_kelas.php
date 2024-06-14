<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AbKelas extends Migration
{

    public function up()
    {
        Schema::create('ab_kelas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kelas');
            $table->timestamps();
        });
    }
}
