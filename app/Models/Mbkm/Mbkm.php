<?php

namespace App\Models\Mbkm;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Models\Konsentrasi;
use App\Models\Mbkm\Program;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mbkm extends Model
{
    use HasFactory;

    protected $table = 'mbkm';
    protected $guarded = [];

    public $timestamps = false;
    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }
    public function program()
    {
        return $this->belongsTo(Program::class);
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
        return $this->belongsTo(Dosen::class, 'dosen_pa', 'nip');
    }
    public static function usulanMahasiswa($nim)
    {
        return self::where('mahasiswa_nim', $nim)
            ->where(function ($query) {
                $query->where("status", "!=", "Ditolak")
                    ->where("status", "!=", "Mengundurkan diri")
                    ->where("status", "!=", "Nilai sudah keluar");
            })
            ->orderBy("updated_at", "DESC");
    }
    public static function riwayatMahasiswa($nim)
    {
        return self::where('mahasiswa_nim', $nim)
            ->where(function ($query) {
                $query->where("status", "Ditolak")
                    ->orWhere("status", "Mengundurkan diri")
                    ->orWhere("status", "Nilai sudah keluar");
            })
            ->orderBy("created_at", "DESC");
    }

    public static function usulanProdi($prodiId)
    {
        // return self::where(function ($status) {
        //     $status->orWhere(function ($query) {
        //         $query->where("status", "Usulan")->where("batas", ">=", Carbon::today());
        //     })
        //         ->orWhere("status", "Usulan konversi nilai")
        //         ->orWhere("status", "Konversi ditolak")
        //         ->orWhere("status", "Usulan pengunduran diri");
        return self::where(function ($status) {
            $status->orWhere("status", "Usulan")
                ->orWhere("status", "Usulan konversi nilai")
                ->orWhere("status", "Konversi ditolak")
                ->orWhere("status", "Usulan pengunduran diri");
        })->where("prodi_id", $prodiId);
    }

    public static function riwayatProdi($prodiId)
    {
        return self::where(function ($query) {
            $query->where("status", "Ditolak")
                ->orWhere("status", "Nilai sudah keluar")
                ->orWhere("status", "Konversi diterima")
                ->orWhere("status", "Mengundurkan diri");
        })->where("prodi_id", $prodiId);
    }

    public static function berjalanProdi($prodiId)
    {
        return  self::where("prodi_id", $prodiId)->where(function ($query) {
            $query->where("status", "Disetujui")
                ->orWhere("status", "Usulan konversi nilai")
                ->orWhere("status", "Konversi ditolak")
                ->orWhere("status", "Usulan konversi nilai");
        });
    }

    public static function usulanStaf($prodiId)
    {
        return self::where("status", "Konversi diterima")->where("prodi_id", $prodiId);
    }
    public static function riwayatStaf($prodiId)
    {
        return self::where("status", "Nilai sudah keluar")->where("prodi_id", $prodiId);
    }
}
