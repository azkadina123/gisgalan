@extends('layouts/master')
@section('title')
tambahdataakun

@endsection
  

@section('css')


@endsection


  

  

@section('header-content')
<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Tambah Data Akun</h2>
                        </div>
                        <div class="body">
                        <form action="/keloladataakun" method="POST">
							@csrf
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label">Nama Instansi</label>
                                        <input type="text" class="form-control" name="nama_instansi" required>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label">Email</label>
                                        <input type="text" class="form-control" name="email" required>
                                    </div>
                                </div>
                            </div>
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                <br><label class="form-label">Jenis Instansi</label></br>
                                        <select name="jenis_instansi" class="form-control show-tick">
                                            <option value="Klinik">Klinik</option>
                                            <option value="Puskesmas">Puskesmas</option>
                                            <option value="Rumahsakit">Rumahsakit</option>
                                        </select>
                                    </div>
                                </div>
                                    
                                    <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label">Alamat</label>
                                        <input type="text" class="form-control" name="alamat" required>

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