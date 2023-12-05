<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use App\Models\PendaftaranSkripsi;
use App\Models\PenjadwalanSkripsi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jadwalkan extends Model
{
    protected $table = 'penjadwalan_kp';
    protected $guarded = [];
    

    public function pendaftaranskripsi()
    {
        return $this->hasOne(PendaftaranSkripsi::class);
    }
    public function penjadwalanskripsi()
    {
        return $this->hasOne(PenjadwalanSkripsi::class);
    }
}