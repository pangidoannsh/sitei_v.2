<?php

namespace App\Models\ProgressReport;

use App\Models\Mahasiswa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pr_Proposal extends Model
{
    use HasFactory;
    protected $table = "pr_proposals";
    protected $fillable = [
        'id',
        'bimbingan',
        'progress_report',
        'mahasiswa_nama',
        'mahasiswa_nim',
        'pembimbing_nip',
        'pembimbing_nama',
        'status',
        'bab1',
        'bab2',
        'bab3',
        'keterangan',
        'diskusi',
        'link',
        'komentar',
        'tanggal',
        'naskah'
    ];

    protected $casts = [
        'bab1' => 'array',
        'bab2' => 'array',
        'bab3' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(Mahasiswa::class);
    }
}
