<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class dataakun extends Model
{
    
    protected $fillable = ['nama_instansi','jenis_instansi','alamat','kecamatan','kelurahan','email'];
}
