<?php

namespace App\Models;

use App\Models\PenilaianSemproPenguji;
use Illuminate\Database\Eloquent\Model;
use App\Models\PenilaianSemproPembimbing;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PenjadwalanSempro extends Model
{
    protected $table = 'penjadwalan_sempro';
    protected $guarded = [];

    public function penilaian($nip, $id)
    {
        $penilaian_pembimbing = PenilaianSemproPembimbing::where('pembimbing_nip', $nip)->where('penjadwalan_sempro_id', $id)->count();

        if ($penilaian_pembimbing == 0) {
            $penilaian_penguji = PenilaianSemproPenguji::where('penguji_nip', $nip)->where('penjadwalan_sempro_id', $id)->count();

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

    public function pembimbingsatu()
    {
        return $this->belongsTo(Dosen::class, 'pembimbingsatu_nip', 'nip');
    }

    public function pembimbingdua()
    {
        return $this->belongsTo(Dosen::class, 'pembimbingdua_nip', 'nip');
    }

    public function pengujisatu()
    {
        return $this->belongsTo(Dosen::class, 'pengujisatu_nip', 'nip');
    }

    public function pengujidua()
    {
        return $this->belongsTo(Dosen::class, 'pengujidua_nip', 'nip');
    }

    public function pengujitiga()
    {
        return $this->belongsTo(Dosen::class, 'pengujitiga_nip', 'nip');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dibuat_oleh', 'nip');
    }

    public function cek($id)
    {
        $penilaian = 4;
        $cekdata = PenjadwalanSempro::find($id);

        if ($cekdata->pembimbingdua_nip != null) {
            $penilaian++;
        }

        return $penilaian;
    }

    public function jmlpenilaian($id)
    {
        $penguji = PenilaianSemproPenguji::where('penjadwalan_sempro_id', $id)->count();
        $pembimbing = PenilaianSemproPembimbing::where('penjadwalan_sempro_id', $id)->count();

        return $penguji + $pembimbing;
    }
}
