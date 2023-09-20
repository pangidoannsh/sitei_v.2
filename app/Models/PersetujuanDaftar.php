<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersetujuanDaftar extends Model
{
    protected $table = 'pendaftaran_kp';
    protected $guarded = [];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_nim', 'nim');
    }

    public function pembimbing()
    {
        return $this->belongsTo(Dosen::class, 'dosen_pembimbing', 'nip');
    }

    public function pendaftaran_kp()
    {
        return $this->belongsTo(PendaftaranKP::class);
    }

}
