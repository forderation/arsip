<?php

use Illuminate\Database\Seeder;
use App\Admin;

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
            'email' => "ruwanda@gmail.com"
        ]);
    }
}
