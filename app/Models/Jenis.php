<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
    protected $table = 'jenis_perangkats';
    protected $fillable = [
        'nama_jenis',
        'prefix',
        'kode_jenis',
    ];  
}
