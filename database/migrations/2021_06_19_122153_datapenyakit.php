<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Datapenyakit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datapenyakits', function (Blueprint $table) {
            $table->id();
            $table->enum('nama_penyakit', ['TBC','Pneunomia','HIV/AIDS']);
            $table->enum('usia',['balita','remaja','dewasa','lansia']);
            $table->enum('jenis_kelamin',['laki-laki','perempuan']);
            $table->date('tanggal_input');
            $table->integer('kecamatan');
            $table->integer('kelurahan');
            $table->enum('status',['Diterima','Ditolak','Belum dikonfirmasi']);
            $table->integer('id_instansi');
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
        //
    }
}
