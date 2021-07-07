@extends('layouts/master')
@section('title')
tambahdatapenyakit

@endsection
  

@section('css')


@endsection


  

  

@section('header-content')
<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Tambah Data Penyakit</h2>
                        </div>
                        <div class="body">
							@csrf
                            <form action="/keloladatapenyakit" method="POST">
                                @csrf
                            <div class="row clearfix">
                                <div class="col-sm-6">
                            <br><label class="form-label">Nama Penyakit</label></br>
                                    <select name="nama_penyakit" class="form-control show-tick">
                                        <option value="TBC">TBC</option>
                                        <option value="Pneunomia">Pneunomia</option>
                                        <option value="HIV/AIDS">HIV/AIDS</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-6">
                            <br><label class="form-label">Usia</label></br>
                                    <select name="usia" class="form-control show-tick">
                                        <option value="balita">balita</option>
                                        <option value="remaja">remaja</option>
                                        <option value="dewasa">dewasa</option>
                                        <option value="lansia">lansia</option>

                                    </select>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-6">
                            <br><label class="form-label">Jenis Kelamin</label></br>
                                    <select name="jenis_kelamin" class="form-control show-tick">
                                        <option value="laki-laki">Laki-laki</option>
                                        <option value="perempuan">Perempuan</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-sm-4">
                                        <label class="form-label">Tanggal Input</label></br>
                                        <div class="form-group">
                                            <div class="form-line" >
                                            <input type="date" name="tanggal_input" class="form-control" placeholder="Please choose a date...">
                                        </div>
                                    </div>
                                </div>
                            </div>
                                
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                <br><label class="form-label">Kecamatan</label></br>
                                        <select name="kecamatan" class="form-control show-tick">
                                            <option value="">pilih kecamatan</option>
                                            @foreach ($kecamatan as $item)
                                            <option value="{{$item->id}}">{{$item->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                <br><label class="form-label">Kelurahan</label></br>
                                        <select name="kelurahan" class="form-control show-tick">
                                            <option value="">pilih kelurahan</option>
                                            @foreach ($kelurahan as $item)
                                            <option value="{{$item->id}}">{{$item->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                            <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
                        </form>
                    </div>    
                </div>
       
@endsection  

@section('content')

@endsection  

  

@section('js')



@endsection