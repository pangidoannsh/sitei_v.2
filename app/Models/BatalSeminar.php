<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BatalSeminar extends Model
{
    use HasFactory;

    protected $table = 'batal_seminar';
    protected $guarded = [];

    public function penjadwalan_sempro()
    {
        return $this->belongsTo(PenjadwalanSempro::class);
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_nim', 'nim');
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }

    public function konsentrasi()
    {
        return $this->belongsTo(Konsentrasi::class);
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'lokasi', 'id');
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
}
