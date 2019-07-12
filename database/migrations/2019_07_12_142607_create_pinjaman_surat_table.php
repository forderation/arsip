<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePinjamanSuratTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pinjaman_surat', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_surat_ukur');
            $table->unsignedInteger('id_peminjam');
            $table->dateTime('tanggal_pinjam')->nullable();
            $table->dateTime('tanggal_kembali')->nullable();
            $table->dateTime('batas_akhir_kembali')->nullable();
            $table->enum('status_dipinjam', ['masih dipinjam', 'ada'])->default('ada');
            $table->timestamps();
            $table->foreign('id_surat_ukur')->references('id')->on('surat_ukur')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_peminjam')->references('id')->on('pegawai')
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
        Schema::dropIfExists('pinjaman_surat');
    }
}
