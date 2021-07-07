<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\datapenyakit;
use App\kelurahan;
use App\kecamatan;
use App\dataakun;

class permintaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datapenyakit = datapenyakit::where('status','Belum dikonfirmasi')->get();
         $kelurahan = kelurahan::all();
         $kecamatan = kecamatan::all();
         $instansi = dataakun::all();
         return view('permintaanverifikasi.verifikasi', compact('datapenyakit', 'kelurahan', 'kecamatan','instansi'));
        //  $data = data_guru::where('email', Auth::user()->email)->get();
        // return view('/guru/profil',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $penyakit = datapenyakit::find($id);
        $penyakit->status = $request->get('status');


        $penyakit->save();
        return redirect('/permintaanverifikasi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
