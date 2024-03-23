<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbGedung extends Model
{
    use HasFactory;

    protected $table = 'ab_gedung';
    protected $primaryKey = 'id';
    protected $guarded = [];
    protected $fillable = [
        'id',
        'nama_gedung',
        'koordinat_longitude',
        'koordinat_latitude'
    ];
}
