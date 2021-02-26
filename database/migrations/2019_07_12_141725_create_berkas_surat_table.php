<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBerkasSuratTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('berkas_surat', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nomor_surat');
            $table->string('nama_pemilik');
            $table->unsignedInteger('id_kelurahan');
            $table->unsignedInteger('id_kecamatan');
            $table->string('nomor_rak');
            $table->string('path_gambar')->nullable();
            $table->enum('ketersediaan', ['tersedia', 'tidak tersedia'])->default('tersedia');
            $table->timestamps();
            $table->foreign('id_kelurahan')->references('id')->on('kelurahan')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_kecamatan')->references('id')->on('kecamatan')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('berkas_surat');
    }
}