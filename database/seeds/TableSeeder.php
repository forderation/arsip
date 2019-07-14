<?php

use Illuminate\Database\Seeder;
use App\Admin;
use App\Informasi;

class TableSeeder extends Seeder
{
    //seed tabel admin dan table role
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'nomor_pegawai' => 197201242000031004,
            'nama_admin'  => "Ruwanda Destory",
            'password'  =>  bcrypt("123admin"),
            'email' => "ruwanda@gmail.com",
            'jenis_kelamin' => 'laki-laki'
        ]);
        Admin::create([
            'nomor_pegawai' => 197201242000031003,
            'nama_admin'  => "Kharisma Muzaki",
            'password'  =>  bcrypt("123arip"),
            'email' => "kharisma.muzaki@gmail.com",
            'jenis_kelamin' => 'laki-laki'
        ]);
        Informasi::create([
            'batas_akhir_kembali' => 7,
        ]);
    }
}
