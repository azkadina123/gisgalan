@extends('layouts/master')
@section('title')
editdatapenyakit

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
                            <form action="/keloladatapenyakit/{{$penyakit->id}}" method="POST">
                                @csrf
                                @method('PUT')
                            <div class="row clearfix">
                                <div class="col-sm-6">
                            <br><label class="form-label">Nama Penyakit</label></br>
                                    <select name="nama_penyakit" class="form-control show-tick">
                                        @if ($penyakit->nama_penyakit==="TBC")
                                            <option value="TBC" selected>TBC</option>
                                            <option value="Pneunomia">Pneunomia</option>
                                            <option value="HIV/AIDS" >HIV/AIDS</option>
                                        @elseif ($penyakit->nama_penyakit==="Pneunomia")
                                            <option value="TBC" >TBC</option>
                                            <option value="Pneunomia" selected>Pneunomia</option>
                                            <option value="HIV/AIDS" >HIV/AIDS</option>
                                        @elseif ($penyakit->nama_penyakit==="HIV/AIDS")
                                            <option value="TBC" >TBC</option>
                                            <option value="Pneunomia" >Pneunomia</option>
                                            <option value="HIV/AIDS"selected >HIV/AIDS</option>
                                        @else
                                            
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-6">
                            <br><label class="form-label">Usia</label></br>
                                    <select name="usia" class="form-control show-tick">
                                    @if ($penyakit->usia==="balita")
                                        <option value="balita"selected>balita</option>
                                        <option value="remaja">remaja</option>
                                        <option value="dewasa">dewasa</option>
                                        <option value="lansia">lansia</option>
                                    @elseif ($penyakit->usia==="remaja")
                                        <option value="balita">balita</option>
                                        <option value="remaja"selected>remaja</option>
                                        <option value="dewasa">dewasa</option>
                                        <option value="lansia">lansia</option>
                                    @elseif ($penyakit->usia==="dewasa")
                                        <option value="balita">balita</option>
                                        <option value="remaja">remaja</option>
                                        <option value="dewasa"selected>dewasa</option>
                                        <option value="lansia">lansia</option>
                                    @elseif ($penyakit->usia==="remaja")
                                        <option value="balita">balita</option>
                                        <option value="remaja">remaja</option>
                                        <option value="dewasa">dewasa</option>
                                        <option value="lansia"selected>lansia</option>
                                        

                                    @else
                                        
                                    @endif
                                    </select>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-6">
                            <br><label class="form-label">Jenis Kelamin</label></br>
                                    <select name="jenis_kelamin" class="form-control show-tick">
                                     @if ($penyakit->jenis_kelamin==="laki-laki")
                                        <option value="laki-laki"selected>Laki-laki</option>
                                        <option value="perempuan">Perempuan</option>
                                    @elseif ($penyakit->usia==="remaja")
                                        <option value="laki-laki">Laki-laki</option>
                                        <option value="perempuan"selected>Perempuan</option>
                                    @else
                                        
                                    @endif

                                    </select>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-sm-4">
                                        <label class="form-label">Tanggal Input</label></br>
                                        <div class="form-group">
                                            <div class="form-line" >
                                            <input type="date" name="tanggal_input" id="tanggal_input" class="form-control" value="{{$penyakit->tanggal_input}}" placeholder="Please choose a date...">
                                        </div>
                                    </div>
                                </div>
                            </div>
                                
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                <br><label class="form-label">Kecamatan</label></br>
                                        <select name="kecamatan" class="form-control show-tick">
                                            <option value="">pilih kecamatan</option>
                                            @foreach ($kecamatan as $itm)
                                            @if ($itm->id === $penyakit->kecamatan)
                                                <option value="{{$itm->id}}" selected>{{$itm->nama}}</option>

                                            @else
                                                <option value="{{$itm->id}}">{{$itm->nama}}</option>

                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                <br><label class="form-label">Kelurahan</label></br>
                                        <select name="kelurahan" class="form-control show-tick">
                                            <option value="">pilih kelurahan</option>
                                            @foreach ($kelurahan as $itm)
                                            @if ($itm->id === $penyakit->kelurahan)
                                                <option value="{{$itm->id}}" selected>{{$itm->nama}}</option>

                                            @else
                                                <option value="{{$itm->id}}">{{$itm->nama}}</option>

                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            <button class="btn btn-primary waves-effect" type="submit">SAVE</button>
                        </form>
                    </div>    
                </div>
       
@endsection  

@section('content')

@endsection  

  

@section('js')

<SCRIpt>
    $("#tanggal_input").each(function){
        $(this).datapicker('setDate', $(this).val());

    });
</SCRIpt>



@endsection