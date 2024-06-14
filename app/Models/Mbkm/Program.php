<?php

namespace App\Models\Mbkm;

use App\Models\Mbkm\Mbkm;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;
    protected $table = 'mbkm_program';
    protected $guarded = [];

    public function mbkm()
    {
        return $this->hasMany(Mbkm::class);
    }
}
