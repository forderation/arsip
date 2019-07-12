<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Pegawai extends Authenticatable
{
    //
    protected $table = 'pegawai';
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $fillable = [
        'nama_pegawai',
        'email',
        'nomor_pegawai'
    ];

    public function setPasswordAttribute($val)
    {
        return $this->attributes['password'] = bcrypt($val);
    }
}
