@extends('layouts/master')
@section('title')
grafik

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
            <h1>Grafik Statistik</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Grafik Statistik</li>
            </ol>
          </div>
        </div>
       
@endsection  

@section('content')
<div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>150</h3>

                <p>New Orders</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>53<sup style="font-size: 20px">%</sup></h3>

                <p>Bounce Rate</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>44</h3>

                <p>User Registrations</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="panel">
            <div id="chart"></div> 

          </div>
          <!-- ./col -->
        </div>
        
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

<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
  Highcharts.chart('chart', {
    chart: {
        type: 'pie',
        options3d: {
            enabled: true,
            alpha: 90
        }
    },
    title: {
        text: 'Contents of Highsoft\'s weekly fruit delivery'
    },
    subtitle: {
        text: '3D donut in Highcharts'
    },
    plotOptions: {
        pie: {
            innerSize: 100,
            depth: 45
        }
    },
    series: [{
        name: 'KASUS',
        data: [
            ['TBC', 8],
            ['Pneunomia', 1],
            ['HIV/AIDS', 6],
          
        ]
    }]
});
</script>

@endsection