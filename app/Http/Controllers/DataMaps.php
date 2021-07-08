<?php

namespace App\Http\Controllers;

use App\datapenyakit;
use App\kelurahan as AppKelurahan;
use App\Models\MapsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $chart = datapenyakit::select(DB::raw("COUNT(*) as count, nama_penyakit"))
            ->where('kelurahan', $id_desa)
            ->whereYear('created_at', date('Y'))
            ->groupBy('nama_penyakit')
            ->get();
        $arr_chart = array();
        foreach ($chart as $key => $val) {
            $arr_chart[] = array($val->nama_penyakit, $val->count);
        }
        // return json_encode(array('data' => null, 'desa' => $get));
        return response()->json([
            'status' => 200,
            'kelurahan' => $get,
            'chart' =>  $arr_chart
        ]);
    }
}
