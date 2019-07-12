<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\AdminResetPasswordNotification;

class Admin extends Authenticatable
{
    //
    protected $table = 'admin';
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $fillable = [
        'nama_admin',
        'email',
        'nomor_pegawai'
    ];

    public function setPasswordAttribute($val)
    {
        return $this->attributes['password'] = bcrypt($val);
    }
}
