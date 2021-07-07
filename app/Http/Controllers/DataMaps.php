<?php

namespace App\Http\Controllers;

use App\kelurahan as AppKelurahan;
use App\Models\MapsModel;
use Illuminate\Http\Request;
use Kelurahan;

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
        // return json_encode(array('data' => null, 'kecamatan' => $data));
        return response()->json([
            'status' => 200,
            'kecamatan' => $data,
        ]);
    }
    public function getKecamatanId(Request $request)
    {
        $id_desa = $request->id_desa;
        $get = AppKelurahan::find($id_desa);

        // return json_encode(array('data' => null, 'desa' => $get));
        return response()->json([
            'status' => 200,
            'kelurahan' => $get,
        ]);
    }
}
