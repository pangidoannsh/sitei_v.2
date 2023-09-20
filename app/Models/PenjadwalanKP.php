<?php

namespace App\Models;

use App\Models\Dosen;
use App\Models\Prodi;
use App\Models\Mahasiswa;
use App\Models\Konsentrasi;
use App\Models\PendaftaranKP;
use App\Models\PenilaianKPPenguji;
use App\Models\PenilaianKPPembimbing;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PenjadwalanKP extends Model
{
    protected $table = 'penjadwalan_kp';
    protected $guarded = [];

    public function penilaian($nip, $id)
    {
        $penilaian_pembimbing = PenilaianKPPembimbing::where('pembimbing_nip', $nip)->where('penjadwalan_kp_id', $id)->count();

        if ($penilaian_pembimbing == 0) {
            $penilaian_penguji = PenilaianKPPenguji::where('penguji_nip', $nip)->where('penjadwalan_kp_id', $id)->count();

            if ($penilaian_penguji > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }

    public function konsentrasi()
    {
        return $this->belongsTo(Konsentrasi::class);
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_nim', 'nim');
    }

    public function pembimbing()
    {
        return $this->belongsTo(Dosen::class, 'pembimbing_nip', 'nip');
    }

    public function penguji()
    {
        return $this->belongsTo(Dosen::class, 'penguji_nip', 'nip');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dibuat_oleh', 'nip');
    }

    public function pendaftaran_kp()
    {
        return $this->belongsTo(Pendaftaran::class, 'id', 'id');
    }
    public function dosen_pembimbing_kp()
    {
        return $this->belongsTo(Pendaftaran::class, 'dosen_pembimbing_nip', 'nip');
    }


    public function cek()
    {
        $penilaian = 2;        
        return $penilaian;
    }

    public function jmlpenilaian($id)
    {
        $penguji = PenilaianKPPenguji::where('penjadwalan_kp_id', $id)->count();
        $pembimbing = PenilaianKPPembimbing::where('penjadwalan_kp_id', $id)->count();

        return $penguji + $pembimbing;
    }
}
