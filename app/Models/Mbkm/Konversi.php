<?php

namespace App\Models\Mbkm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Mahasiswa;


class Konversi extends Model
{
    use HasFactory;
    protected $table = 'mbkm_konversi';
    protected $guarded = [];

    public $timestamps = false;

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class);
    }
}
