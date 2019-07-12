<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    //
    protected $table = "kecamatan";
    protected $fillable = [
        "nama_kecamatan"
    ];

    public function kelurahan()
    {
        return $this->hasMany('App\Kelurahan');
    }

    public function surat_ukur(){
        return $this->hasMany('App\SuratUkur');
    }
}
