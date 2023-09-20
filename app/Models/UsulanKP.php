<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsulanKP extends Model
{

    protected $table = 'usulan_kps';
    protected $guarded = [];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_nim', 'nim');
    }
    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_pembimbing', 'nip');
    }
    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id', 'id');
    }
    public function konsentrasi()
    {
        return $this->belongsTo(Konsentrasi::class, 'konsentrasi_id', 'id');
    }
  


}
