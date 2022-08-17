<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianKP extends Model
{
    protected $table = 'penilaian_kp';
    protected $guarded = [];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_nim', 'nim');
    }

    public function pembimbing()
    {
        return $this->belongsTo(Dosen::class, 'pembimbing_nip', 'nip');
    }

    public function penguji()
    {
        return $this->belongsTo(Dosen::class, 'penguji_nip', 'nip');
    }
}
