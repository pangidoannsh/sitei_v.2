<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianKPPenguji extends Model
{
    protected $table = 'penilaian_kp_penguji';
    protected $guarded = [];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_nim', 'nim');
    }

    public function pembimbing()
    {
        return $this->belongsTo(Dosen::class, 'pembimbing_nip', 'nip');
    }

    public function penjadwalan_kp()
    {
        return $this->belongsTo(PenjadwalanKP::class);
    }

    public function penguji()
    {
        return $this->belongsTo(Dosen::class, 'penguji_nip', 'nip');
    }
}
