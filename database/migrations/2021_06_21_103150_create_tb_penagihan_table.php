<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbPenagihanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_penagihan', function (Blueprint $table) {
            $table->string('id_pelanggan')->primary();
            $table->string('nama_pelanggan');
            $table->string('alamat_pelanggan');
            $table->date('tanggal_awal');
            $table->date('tanggal_akhir');
            $table->integer('jumlah_tunggakan');
            $table->string('keterangan')->nullable();
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
        Schema::dropIfExists('tb_penagihan');
    }
}
