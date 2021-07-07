<?php

namespace App\Http\Controllers;

use App\Models\MapsModel;
use Illuminate\Http\Request;

class DataMaps extends Controller
{
    //
    public function getKecamatan()
    {
        $kecamatan = MapsModel::all();
        $data = array();
        foreach ($kecamatan as $key => $val) {
            $data[$val->id] = $val;
        }
        return json_encode(array('data' => null, 'kecamatan' => $data));
    }
}
