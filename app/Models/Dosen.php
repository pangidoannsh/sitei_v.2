<?php

namespace App\Models;

use App\Models\Role;
use App\Models\Prodi;
use App\Models\PendaftaranKP;
use Laravel\Sanctum\HasApiTokens;
use App\Models\PendaftaranSkripsi;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Mahasiswa;

class Dosen extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];
    protected $table = 'dosen';
    protected $guarded = [];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function pendaftaran_kp()
{
    return $this->hasMany(PendaftaranKP::class, 'dosen_pembimbing_nip', 'nip');
}

    public function pendaftarankp()
{
    return $this->belongsTo(PendaftaranKP::class, 'dosen_pembimbing_nip', 'nip');
}
    public function pendaftaran_skripsi1()
{
    return $this->hasMany(PendaftaranSkripsi::class, 'pembimbing_1_nip', 'nip');
}
    public function pendaftaran_skripsi2()
{
    return $this->hasMany(PendaftaranSkripsi::class, 'pembimbing_2_nip', 'nip');
}

public function mahasiswas()
{
    return $this->hasMany(Mahasiswa::class, 'dosen_pembimbing_nip');
}
public function mahasiswa()
{
    return $this->hasMany(Mahasiswa::class, 'mahasiswa_nim', 'nim');
}


// public function pendaftaranKP()
//     {
//         return $this->hasOne(PendaftaranKP::class, 'dosen_pembimbing_nip', 'nip');
//     }

    public function pendaftaranSkripsi1()
    {
        return $this->hasMany(PendaftaranSkripsi::class, 'pembimbing_1_nip', 'nip');
    }
    public function pendaftaranSkripsi2()
    {
        return $this->hasMany(PendaftaranSkripsi::class, 'pembimbing_2_nip', 'nip');
    }



    public function pendaftaranSkripsiPembimbing1()
    {
        return $this->hasMany(PendaftaranSkripsi::class, 'pembimbing_1_nip', 'nip');
    }

    public function pendaftaranSkripsiPembimbing2()
    {
        return $this->hasMany(PendaftaranSkripsi::class, 'pembimbing_2_nip', 'nip');
    }
   

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
}
