<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbRuangan extends Model
{
    use HasFactory;
    protected $table = 'ab_ruangan';
    protected $primaryKey = 'id';
    protected $guarded = [];
    protected $fillable = ['nama_ruangan', 'gedung_id'];

    public function gedung()
    {
        return $this->belongsTo(AbGedung::class, 'gedung_id', 'id');
    }
}
