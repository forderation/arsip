<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataPegawai extends Model
{
    //
    protected $table = 'pegawai';

    protected $fillable = [
        'nama_pegawai',
        'email',
        'nomor_pegawai',
        'jenis_kelamin'
    ];

    public function get_nama(){
        return $this->nama_pegawai;
    }

    public function pinjaman_surat(){
        return $this->hasMany('App\Pinjaman','id_peminjam');
    }
}
