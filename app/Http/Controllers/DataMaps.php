<?php

namespace App\Http\Controllers;

use App\datapenyakit;
use App\kecamatan;
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
        return response()->json([
            'status' => 200,
            'kecamatan' => $data,
        ]);
    }
    public function getKecamatanId(Request $request)
    {
        $query = datapenyakit::select(DB::raw("COUNT(*) as count, nama_penyakit"))
            ->where('status', 'Diterima')
            ->whereYear('created_at', date('Y'));
        if (isset($request->id_desa)) {
            $query->where('kelurahan', $request->id_desa);
            $get = AppKelurahan::find($request->id_desa);
        }
        if (isset($request->id_kecamatan)) {
            $query->where('kecamatan', $request->id_kecamatan);
            $get = kecamatan::find($request->id_kecamatan);
        }
        if (isset($request->usia) && $request->usia !== 'semua') {
            $query->where('usia', $request->usia);
        }
        if (isset($request->penyakit) && $request->penyakit != 'semua') {
            $query->where('nama_penyakit', $request->penyakit);
        }
        if (isset($request->bulan) && $request->bulan !== 'semua') {
            $query->whereMonth('tanggal_input', $request->bulan);
        }
        $query->whereYear('tanggal_input', date('Y'));
        $query->groupBy('nama_penyakit');

        $chart = $query->get();

        $arr_chart = array();
        foreach ($chart as $key => $val) {
            $arr_chart[] = array($val->nama_penyakit, $val->count);
        }
        return response()->json([
            'status' => 200,
            'data' => $get,
            'chart' =>  $arr_chart
        ]);
    }
    public function getFilter(Request $request)
    {
        $wilayah = $request->wilayah;
        $penyakit = $request->penyakit;
        $usia = $request->usia;
        $query = DB::table('datapenyakits')->where('status', 'Diterima');
        if ($wilayah == 'kecamatan') {
            $query->select('kecamatan');
        } else {
            $query->select('kelurahan');
        }
        if (isset($penyakit) && $penyakit != 'semua') {
            $query->where('nama_penyakit', $penyakit);
        }
        if (isset($usia) && $usia !== 'semua') {
            $query->where('usia', $usia);
        }
        if (isset($request->bulan) && $request->bulan !== 'semua') {
            $query->whereMonth('tanggal_input', $request->bulan);
        }
        if ($wilayah == 'kecamatan') {
            $query->groupBy('kecamatan');
        } else {
            $query->groupBy('kelurahan');
        }
        $query->whereYear('tanggal_input', date('Y'));
        $result = $query->get();
        $arr_result = array();
        if ($wilayah == 'kecamatan') {
            foreach ($result as $key => $val) {
                $arr_result[] = $val->kecamatan;
            }
        } else {
            foreach ($result as $key => $val) {
                $arr_result[] = $val->kelurahan;
            }
        }
        return response()->json([
            'status' => 200,
            'wilayah' => $wilayah,
            'data' => $arr_result

        ]);
    }
}
