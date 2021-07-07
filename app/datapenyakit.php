<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class datapenyakit extends Model
{
    protected $fillable = ['id_instansi','nama_penyakit','usia','jenis_kelamin','tanggal_input','kecamatan','kelurahan','status'];

}
