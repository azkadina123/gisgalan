<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MapsModel extends Model
{
    // use HasFactory;
    protected $table = "kecamatans";
    public function getKecamatanId($id)
    {
        $get = DB::table('kelurahans')
            ->where('id_desa', $id)
            ->get();
        return $get;
    }
}
