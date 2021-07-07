<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Dataakun extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dataakuns', function (Blueprint $table) {
            $table->id();
            $table->string('nama_instansi');
            $table->enum('jenis_instansi',['klinik','puskesmas','rumahsakit']);
            $table->text('alamat');
            $table->integer('kecamatan');
            $table->integer('kelurahan');
            $table->string('email');
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
