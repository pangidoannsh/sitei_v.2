<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function jam()
    {
        return $this->belongsTo(Jam::class);
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

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class);
    }


    public function jamkpsel()
    {
        return $this->belongsTo(JamKPSel::class);
    }
    
    public function jamkpkam()
    {
        return $this->belongsTo(JamKPKam::class);
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
