<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pinjaman extends Model
{
    //
    protected $table = "pinjaman_surat";
    protected $fillable = [
        "id_surat_ukur","id_peminjam","tanggal_pinjam","tanggal_kembali","batas_akhir_kembali"
    ];

    public function peminjam()
    {
        return $this->belongsTo('App\DataPegawai', 'id_peminjam');
    }

    public function surat_ukur(){
        return $this->belongsTo('App\SuratUkur', 'id_surat_ukur');
    }
}
