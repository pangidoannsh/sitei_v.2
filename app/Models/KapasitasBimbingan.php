<?php

namespace App\Models;

use App\Models\Dosen;
use App\Models\Prodi;
use App\Models\Mahasiswa;
use App\Models\Konsentrasi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use App\Notifications\NotifPendaftaranSkripsi;

class KapasitasBimbingan extends Model
{
    protected $table = 'kapasitas_bimbingan';
    protected $guarded = [];

    // use HasFactory;
}
