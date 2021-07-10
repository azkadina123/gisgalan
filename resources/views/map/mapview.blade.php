<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin="" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- <link rel="stylesheet" href="{{asset('asset/css/maps.css')}}"> -->
    <title>Kota Tegal</title>
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        #map {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        html,
        body,
        #map {
            height: 100%;
            margin: 0px;
        }

        .sidebar {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #eadede;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
        }

        .sidebar a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 25px;
            color: #818181;
            display: block;
            transition: 0.3s;
        }

        .sidebar a:hover {
            color: #f1f1f1;
        }

        .sidebar .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }

        #refreshButton {
            position: absolute;
            top: 20px;
            right: 20px;
            padding: 10px;
            z-index: 400;
        }

        .openbtn {
            font-size: 20px;
            cursor: pointer;
            background-color: #111;
            color: white;
            padding: 10px 15px;
            border: none;
            position: absolute;
            top: 10px;
            left: 10px;
            z-index: 1;
            border-radius: 3px;
        }

        .openbtn:hover {
            background-color: #444;
        }

        #main {
            position: relative;
            transition: margin-left .5s;
            padding: 16px;
            height: 100%;

        }

        /* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
        @media screen and (max-height: 450px) {
            .sidebar {
                padding-top: 15px;
            }

            .sidebar a {
                font-size: 18px;
            }
        }
    </style>
</head>

<body>
    <div id="mySidebar" class="sidebar">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
        <div class="container">
            <form action="">
                <div class="form-group">
                    <label>Nama Penyakit</label>
                    <select class="form-control select2bs4" style="width: 100%;">
                        <option selected="selected"></option>
                        <option>TBC</option>
                        <option>Pneunomia</option>
                        <option>HIV/AIDS</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Jenis Data</label>
                    <select class="form-control select2bs4" style="width: 100%;">
                        <option selected="selected"></option>
                        <option>Tertinggi</option>
                        <option>Terendah</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Usia</label>
                    <select class="form-control select2bs4" style="width: 100%;">
                        <option selected="selected"></option>
                        <option>Balita</option>
                        <option>Remaja</option>
                        <option>Dewasa</option>
                        <option>Lansia</option>
                    </select>
                </div>
                <button class="btn btn-primary waves-effect" type="button" id="filter-data">CARI</button>

            </form>
        </div>
    </div>
    <div id="main">
        <button class="openbtn" id="refreshButton" onclick="openNav()">☰ Toggle Sidebar</button>
        <div id='map'></div>
    </div>

    <!-- <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div id="map">

                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <div class="modal fade" id="featureModal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title text-primary" id="feature-title"></h4>
                </div>
                <div class="modal-body" id="feature-info">
                    <div id="chart"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">Data Statistik</h3>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Nama Penyakit</label>
                    <select class="form-control select2bs4" style="width: 100%;">
                        <option selected="selected"></option>
                        <option>TBC</option>
                        <option>Pneunomia</option>
                        <option>HIV/AIDS</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <!-- /.form-group -->
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Jenis Data</label>
                    <select class="form-control select2bs4" style="width: 100%;">
                        <option selected="selected"></option>
                        <option>Tertinggi</option>
                        <option>Terendah</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Usia</label>
                    <select class="form-control select2bs4" style="width: 100%;">
                        <option selected="selected"></option>
                        <option>Balita</option>
                        <option>Remaja</option>
                        <option>Dewasa</option>
                        <option>Lansia</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <button class="btn btn-primary waves-effect" type="button" id="filter-data">CARI</button>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script> -->
    <script type="text/javascript" src="{{ asset('/assets/jquery/jquery.min.js') }}"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
    <script>



    </script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script>
        const chart = Highcharts.chart('chart', {
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
                data: []
            }]
        });
    </script>
    <script type="text/javascript" src="{{ asset('/asset/map.js') }}"></script>
    <script>
        function openNav() {
            document.getElementById("mySidebar").style.width = "250px";
            document.getElementById("main").style.marginLeft = "250px";
        }

        function closeNav() {
            document.getElementById("mySidebar").style.width = "0";
            document.getElementById("main").style.marginLeft = "0";
        }
    </script>
</body>

</html>