<?php

namespace App\Models\Mbkm;

use App\Models\Mahasiswa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SertifikatMbkm extends Model
{
    use HasFactory;
    protected $table = 'mbkm_sertifikat';
    protected $guarded = [];

    public $timestamps = false;

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class);
    }
}
