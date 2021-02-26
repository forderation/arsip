<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BerkasSurat extends Model
{
    //
    protected $table = "berkas_surat";
    protected $fillable = [
        "nomor_surat","nama_pemilik","id_kelurahan","id_kecamatan","nomor_rak","path_gambar","status_dipinjam"
    ];

    public function kelurahan()
    {
        return $this->belongsTo('App\Kelurahan','id_kelurahan');
    }

    public function kecamatan()
    {
        return $this->belongsTo('App\Kecamatan','id_kecamatan');
    }

    public function pinjaman_surat(){
        return $this->hasMany('App\Pinjaman');
    }
}
