<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianSkripsiPembimbing extends Model
{
    protected $table = 'penilaian_skripsi_pembimbing';
    protected $guarded = [];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_nim', 'nim');
    }

    public function pembimbingsatu()
    {
        return $this->belongsTo(Dosen::class, 'pembimbingsatu_nip', 'nip');
    }

    public function pembimbingdua()
    {
        return $this->belongsTo(Dosen::class, 'pembimbingdua_nip', 'nip');
    }

    public function pengujisatu()
    {
        return $this->belongsTo(Dosen::class, 'pengujisatu_nip', 'nip');
    }

    public function pengujidua()
    {
        return $this->belongsTo(Dosen::class, 'pengujidua_nip', 'nip');
    }

    public function pengujitiga()
    {
        return $this->belongsTo(Dosen::class, 'pengujitiga_nip', 'nip');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dibuat_oleh', 'nip');
    }

    public function penjadwalan_skripsi()
    {
        return $this->belongsTo(PenjadwalanSkripsi::class);
    }
}
