@extends('layouts/master')
@section('title')
keloladatapenyakit

@endsection
  

@section('css')
<!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('tamplate/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('tamplate/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('tamplate/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('tamplate/dist/css/adminlte.min.css') }}">


@endsection


  

  

@section('header-content')
<div class="row mb-2">
          <div class="col-sm-6">
            <h1>Daftar Akun</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Daftar Akun</li>
            </ol>
          </div>
        </div>
       
@endsection  

@section('content')
<div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">DataTable with minimal features & hover style</h3>
                <a href="keloladatapenyakit/create"class="btn btn-sm btn-primary float-sm-right">Tambah Akun</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="tabledatapenyakit" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>No.</th>
                    <th>Nama Penyakit</th>
                    <th>Usia</th>
                    <th>Jenis Kelamin</th>
                    <th>Tanggal Masuk</th>
                    <th>Kecamatan</th>
                    <th>Kelurahan</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    @php
                        $i = 1
                    @endphp
                    @foreach ($datapenyakit as $item)
                    <tr>
                      <td>{{$i++}}</td>
                      <td>{{$item->nama_penyakit}}</td>
                      <td>{{$item->usia}}</td>
                      <td>{{$item->jenis_kelamin}}</td>
                      <td>{{$item->tanggal_input}}</td>
                      @foreach ($kecamatan as $itm)
                          @if ($itm->id ===$item->kecamatan )
                          <td>{{$itm->nama}}</td>
                          @endif
                      @endforeach
                      @foreach ($kelurahan as $itm)
                          @if ($itm->id ===$item->kelurahan )
                          <td>{{$itm->nama}}</td>
                          @endif
                      @endforeach
                      <td> 
                        <a class="btn btn-info" href="{{$item->id}}/detail">Detail</a>
                        <a class="btn btn-primary" href="/keloladatapenyakit/{{$item->id}}/edit">Edit</a>
                        <button type="button" class="btn btn-danger waves-effect" data-toggle="modal" data-target="#smallModal{{$item->id}}">Hapus</button>
										<div class="modal fade" id="smallModal{{$item->id}}" tabindex="-1" role="dialog">
										<div class="modal-dialog modal-sm" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h4 class="modal-title" id="smallModalLabel">Hapus Data</h4>
												</div>
												<div class="modal-body">
													Apakah Anda yakin untuk menghapus data ini?  
												</div>
												<form action="/keloladatapenyakit/{{$item->id}}" method="POST">
												
												@csrf
												@method('DELETE')
												<div class="modal-footer">
													<button type="submit" class="btn btn-danger">Hapus</button>
													<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
												</div>
												</form>
											</div>
										</div>
									</div>

                      </td>

                    </tr>
                    

                    
                    @endforeach
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
@endsection  

  

@section('js')
<!-- DataTables  & Plugins -->
<script src="{{ asset('tamplate/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('tamplate/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('tamplate/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('tamplate/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{ asset('tamplate/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('tamplate/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>



<script>
  $(function () {
    
    $('#tabledataakun').DataTable({
      
    });
  });
</script>


@endsection