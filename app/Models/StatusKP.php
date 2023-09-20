<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusKP extends Model
{
    protected $table = 'status_daftar_kp';
    protected $guarded = [];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }

    public function konsentrasi()
    {
        return $this->belongsTo(Konsentrasi::class);
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_nim', 'nim');
    }

    public function pembimbing()
    {
        return $this->belongsTo(Dosen::class, 'pembimbing_nama', 'nama');
    }
    public function status_kp()
    {
        return $this->belongsTo(StatusKP::class, 'nama_status', 'id');
    }
}
