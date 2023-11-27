<?php

namespace App\Models;
use App\Models\Peminjaman;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'jumlah',
        'status'
    ];

    public function pinjaman(){
        return $this->belongsTo(Peminjaman::class);
    }
    
}
