<?php

namespace App\Models;
use App\Models\Barang;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $fillable = [
        'tujuan',
        'ruangan',
        'jaminan',
        'barang_satu',
        'barang_dua',
        'barang_tiga',
        'user_id',
        'peminjam',
        'penerima',
        'pengembali' 
    ];


}
