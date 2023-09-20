<?php

namespace App\Models;

use App\Models\Dosen;
use App\Models\Prodi;
use App\Models\Mahasiswa;
use App\Models\Konsentrasi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use App\Notifications\NotifPendaftaranSkripsi;

class PendaftaranSkripsi extends Model
{
    protected $table = 'pendaftaran_skripsi';
    protected $guarded = [];

    use Notifiable;

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_nim', 'nim');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_pembimbing', 'nip');
    }
    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id', 'id');
    }
    public function konsentrasi()
    {
        return $this->belongsTo(Konsentrasi::class, 'konsentrasi_id', 'id');
    
    }

    public function dosen_pembimbing1()
    {
        return $this->belongsTo(Dosen::class, 'pembimbing_1_nip', 'nip');
    }
    public function dosen_pembimbing2()
    {
        return $this->belongsTo(Dosen::class, 'pembimbing_2_nip', 'nip');
    }

    public function pembimbing1()
    {
        return $this->belongsTo(Dosen::class, 'pembimbing_1_nip', 'nip');
    }

    public function pembimbing2()
    {
        return $this->belongsTo(Dosen::class, 'pembimbing_2_nip', 'nip');
    }


}
