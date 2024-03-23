<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perkuliahan extends Model
{
    use HasFactory;
    protected $table = 'ab_perkuliahan';
    protected $fillable = [
        'mata_kuliah_id',
        'nomor_pertemuan',
        'materi',
        'jenis_perkuliahan',
        'next_pertemuan',
        'status'
    ];

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class);
    }

    public function location()
    {
        return $this->belongsTo(AbRuangan::class);
    }


    // public function attendances()
    // {
    //     return $this->hasMany(Attendance::class, 'perkuliahan_id', 'id');
    // }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($perkuliahan) {
            // Mendapatkan nomor pertemuan terakhir untuk mata kuliah tertentu
            $lastPerkuliahan = Perkuliahan::where('mata_kuliah_id', $perkuliahan->mata_kuliah_id)->latest()->first();

            // Mengatur nomor pertemuan baru
            $perkuliahan->nomor_pertemuan = $lastPerkuliahan ? $lastPerkuliahan->nomor_pertemuan + 1 : 1;
        });
    }
}
