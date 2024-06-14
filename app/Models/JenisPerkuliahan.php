<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisPerkuliahan extends Model
{
    use HasFactory;
    protected $table = 'ab_jenis_perkuliahan';

    protected $fillable = ['mata_kuliah_id', 'jenis_perkuliahan'];

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'mata_kuliah_id');
    }
}
