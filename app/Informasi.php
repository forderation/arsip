<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Informasi extends Model
{
    //
    protected $table = "informasi";
    protected $fillable = [
        "batas_akhir_kembali"
    ];
}
