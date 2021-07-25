@extends('masyarakat/master')
@section('title')
detaildata

@endsection
  

@section('css')
<!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('tamplate/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('tamplate/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('tamplate/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('tamplate/dist/css/adminlte.min.css') }}">


@endsection


  

  

{{-- @section('header-content')
<div class="row mb-2">
          <div class="col-sm-6">
            <h1>Detail Data</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            </ol>
          </div>
        </div>
       
@endsection   --}}

{{-- @section('content') --}}
<div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <center>
                <h2>Detail Data</h2>
                </center>

              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="tabledataakun" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>No.</th>
                    <th>Nama Penyakit</th>
                    <th>Usia</th>
                    <th>Jenis Kelamin</th>
                    <th>Tanggal Masuk</th>
                    <th>Kecamatan</th>
                    <th>Kelurahan</th>
                    
                  </tr>
                  </thead>
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
                      

                    </tr>
                    

                    
                    @endforeach
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Konfirmasi</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Konfirmasi Permintaan&hellip;</p>
            </div>
            <div class="modal-footer center-content-between">
              <button type="button" class="btn btn-danger">Tolak</button>
              <button type="button" class="btn btn-primary">Terima</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
{{-- @endsection   --}}

  

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