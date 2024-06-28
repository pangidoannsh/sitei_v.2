<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;
    protected $table = 'ab_absensi';
    protected $fillable = [
        'nim_mahasiswa',
        'class_id',
        'perkuliahan_id',
        'attended_at',
        'nama_dosen',
        'mata_kuliah',
        'keterangan'
    ];
    
    public function student()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim_mahasiswa', 'nim');
    }

    public function class()
    {
        return $this->belongsTo(MataKuliah::class);
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim_mahasiswa', 'nim');
    }

    public function dosenmatkul()
    {
        return $this->belongsTo(Dosen::class, 'nip_dosen', 'nama');
    }

    public function dosenmatkul2()
    {
        return $this->belongsTo(Dosen::class, 'dosen_2', 'nama');
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function mata_kuliah()
    {
        return $this->belongsTo(MataKuliah::class);
    }

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'mata_kuliah', 'id');
    }


    public function perkuliahan()
    {
        return $this->belongsTo(Perkuliahan::class);
    }

    public function ruangan()
    {
        return $this->belongsTo(AbRuangan::class, 'ruangan_id', 'id');
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class, 'semester_id', 'id');
    }

}
