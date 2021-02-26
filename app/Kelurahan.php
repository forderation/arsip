<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    //
    protected $table = "kelurahan";
    protected $fillable = [
        "nama_kelurahan","id_kecamatan"
    ];

    public function kecamatan()
    {
        return $this->belongsTo('App\Kecamatan', 'id_kecamatan');
    }

    public function surat_ukur(){
        return $this->hasMany('App\BerkasSurat');
    }
}
