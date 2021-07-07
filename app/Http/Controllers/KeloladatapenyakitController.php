<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\kelurahan;
use App\kecamatan;
use App\datapenyakit;
use App\dataakun;
use Illuminate\Support\Facades\Auth;


class KeloladatapenyakitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $akun =dataakun::where('nama_instansi', Auth::user()->name)->get();
        foreach ($akun as $key => $value) {
           $id = $value["id"];
        } 
        $datapenyakit = datapenyakit::where('status','Belum dikonfirmasi')->where('id_instansi',$id)->get();
         $kelurahan = kelurahan::all();
         $kecamatan = kecamatan::all();
         return view('keloladatapenyakit.keloladata', compact('datapenyakit', 'kelurahan', 'kecamatan'));
        // return view('keloladatapenyakit.keloladata');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelurahan = kelurahan::all();
        $kecamatan = kecamatan::all();
        return view('keloladatapenyakit.tambahdatapenyakit', compact('kelurahan', 'kecamatan'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        $akun =dataakun::where('nama_instansi', Auth::user()->name)->get();
        foreach ($akun as $key => $value) {
           $id = $value["id"];
        }
        $datapenyakit = datapenyakit::create([
            'nama_penyakit'=>$request->input('nama_penyakit'),
            'usia'=>$request->input('usia'),
            'jenis_kelamin'=>$request->input('jenis_kelamin'),
            'tanggal_input'=>$request->input('tanggal_input'),
            'kecamatan'=>$request->input('kecamatan'),
            'kelurahan'=>$request->input('kelurahan'),
            'status'=>'Belum dikonfirmasi',
            'id_instansi'=>$id
        ]);
        return redirect('/keloladatapenyakit');
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
        $penyakit = datapenyakit::find($id);
        $kelurahan = kelurahan::all();
        $kecamatan = kecamatan::all();
        return view('keloladatapenyakit/edit', compact('penyakit', 'kelurahan', 'kecamatan'));
        // echo json_encode($penyakit);
        // echo json_encode($kecamatan);

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
        $penyakit = datapenyakit::find($id);
        $penyakit->nama_penyakit = $request->get('nama_penyakit');
        $penyakit->usia = $request->get('usia');
        $penyakit->jenis_kelamin = $request->get('jenis_kelamin');
        $penyakit->tanggal_input = $request->get('tanggal_input');
        $penyakit->kecamatan = $request->get('kecamatan');
        $penyakit->kelurahan = $request->get('kelurahan');


        $penyakit->save();

    
        return redirect('/keloladatapenyakit');
    }

        // return return redirect(route(''))
        // ->with('succes','data berhasil');



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        datapenyakit::find($id)->delete();
        return redirect('/keloladatapenyakit');
    }
}
