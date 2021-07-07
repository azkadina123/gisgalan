<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\dataakun;
use App\kelurahan;
use App\kecamatan;
use App\User;
use Illuminate\Support\Facades\Hash;
class DataakunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataakun = dataakun::all();
        return view('dataakun.index', compact('dataakun'));
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
        return view('dataakun/tambah', compact('kelurahan', 'kecamatan'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dataakun = dataakun::create([
            'nama_instansi'=>$request->input('nama_instansi'),
            'jenis_instansi'=>$request->input('jenis_instansi'),
            'alamat'=>$request->input('alamat'),
            'kecamatan'=>$request->input('kecamatan'),
            'kelurahan'=>$request->input('kelurahan'),
            'email'=>$request->input('email'),
        ]);
            User::create([
                'name' => $request->input("nama_instansi"),
                'email' => $request->input("email"),
                'rule' => '2',
                'password' => Hash::make($request->input("email")),
            ]);
        return redirect('/keloladataakun')
        // ->with('succes','Data Akun Berhasil Ditambahkan')
        ;
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
        $dataakun = dataakun::find($id);
        $penyakit->nama_instansi = $request->get('nama_instansi');
        $penyakit->jenis_instansi = $request->get('jenis_instansi');
        $penyakit->alamat = $request->get('alamat');
        $penyakit->kecamatan = $request->get('kecamatan');
        $penyakit->kelurahan = $request->get('kelurahan');
        $penyakit->email = $request->get('email');


        $penyakit->save();

    
        return redirect('/keloladataakun');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dataAKUN::find($id)->delete();
        return redirect('/keloladataakun');
    }
}
