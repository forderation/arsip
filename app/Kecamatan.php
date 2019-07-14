<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    //
    protected $table = "kecamatan";
    protected $primaryKey = "id";
    protected $fillable = [
        "nama_kecamatan"
    ];

    public function kelurahan()
    {
        return $this->hasMany('App\Kelurahan','id_kecamatan');
    }

    public function surat_ukur(){
        return $this->hasMany('App\SuratUkur');
    }
}
