<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbRekapitulasiRps extends Model
{
    use HasFactory;

    protected $table = 'ab_rpsmateri';

    protected $fillable = ['perkuliahan_id', 'kesesuaian'];

}
