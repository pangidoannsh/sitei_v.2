<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    use HasFactory;

    protected $table = 'ab_matakuliah';
    protected $primaryKey = 'id';
    protected $guarded = [];
    protected $fillable = [
        'id',
        'kode_mk',
        'mk',
        'kelas_id',
        'prodi_id',
        'sks',
        'semester_id',
        'nip_dosen',
        'dosen_2',
        'hari',
        'jam',
        'ruangan_id',
        'kuota',
        'rps_pertemuan_1',
        'rps_pertemuan_2',
        'rps_pertemuan_3',
        'rps_pertemuan_4',
        'rps_pertemuan_5',
        'rps_pertemuan_6',
        'rps_pertemuan_7',
        'rps_pertemuan_8',
        'rps_pertemuan_9',
        'rps_pertemuan_10',
        'rps_pertemuan_11',
        'rps_pertemuan_12',
        'rps_pertemuan_13',
        'rps_pertemuan_14',
        'rps_pertemuan_15',
        'rps_pertemuan_16',
    ];

    public function attendances()
    {
        return $this->hasMany(Absensi::class, 'class_id', 'id');
    }
    // MataKuliah.php
    public function dosenmatkul()
    {
        return $this->belongsTo(Dosen::class, 'nip_dosen', 'nama');
    }

    public function dosenmatkul2()
    {
        return $this->belongsTo(Dosen::class, 'dosen_2', 'nama');
    }

    public function mahasiswas()
    {
        return $this->hasMany(Mahasiswa::class, 'prodi_id', 'prodi_id');
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class, 'semester_id', 'id');
    }

    // public function ruangan()
    // {
    //     return $this->belongsTo(Location::class, 'ruangan_id', 'id');
    // }

    public function ruangan()
    {
        return $this->belongsTo(AbRuangan::class, 'ruangan_id', 'id');
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function perkuliahan()
    {
        return $this->hasMany(Perkuliahan::class);
    }

    public function perkuliahann()
    {
        return $this->hasMany(Perkuliahan::class, 'mata_kuliah_id', 'id');
    }
}
