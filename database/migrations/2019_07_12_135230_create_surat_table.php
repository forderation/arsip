<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuratTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_ukur', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nomor_surat_ukur');
            $table->string('nomor_hak');
            $table->string('nama_pemilik');
            $table->unsignedInteger('id_kelurahan');
            $table->unsignedInteger('id_kecamatan');
            $table->string('nomor_rak');
            $table->string('path_gambar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('surat_ukur');
    }
}
