<!DOCTYPE html>
<html lang="en">

<head>
    <title>Kota Tegal</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.1/dist/leaflet.css" />
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <!--[if lte IE 8]><link rel="stylesheet" href="https://cdn.leafletjs.com/leaflet-0.7.2/leaflet.ie.css" /><![endif]-->

    <link rel="stylesheet" href="{{asset('asset/css/leaflet-sidebar.css')}}" />
    <link rel="stylesheet" href="{{asset('asset/css/maps.css')}}" />

    <style>
        body {
            padding: 0;
            margin: 0;
        }

        html,
        body,
        #map {
            height: 100%;
            font: 10pt "Helvetica Neue", Arial, Helvetica, sans-serif;
        }

        .lorem {
            font-style: italic;
            color: #AAA;
        }
    </style>
</head>

<body>
    <div id="sidebar" class="sidebar collapsed">
        <!-- Nav tabs -->
        <div class="sidebar-tabs">
            <ul role="tablist">
                <li><a href="#home" role="tab"><i class="fa fa-bars"></i></a></li>
                <!-- <li><a href="#profile" role="tab"><i class="fa fa-user"></i></a></li>
                <li class="disabled"><a href="#messages" role="tab"><i class="fa fa-envelope"></i></a></li>
                <li><a href="https://github.com/Turbo87/sidebar-v2" role="tab" target="_blank"><i class="fa fa-github"></i></a></li> -->
            </ul>

            <ul role="tablist">
                <li><a href="#settings" role="tab"><i class="fa fa-gear"></i></a></li>
            </ul>
        </div>

        <!-- Tab panes -->
        <div class="sidebar-content">
            <div class="sidebar-pane" id="home">
                <h1 class="sidebar-header">
                    Filter Data
                    <span class="sidebar-close"><i class="fa fa-caret-left"></i></span>
                </h1>
                <div class="form-filter">
                    <form action="{{ url('/getFilter') }}" id="form-filters" method="POST">
                        <div class="form-group">
                            <label>Wilayah</label>
                            <select class="form-control select2bs4" style="width: 100%;" name="wilayah" id="wilayah">
                                <option selected="selected" disabled>-- Pilih Wilayah --</option>
                                <option value="kecamatan">Kecamatan</option>
                                <option value="kelurahan">Kelurahan</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Nama Penyakit</label>
                            <select class="form-control select2bs4" style="width: 100%;" name="penyakit">
                                <option selected="selected" disabled>-- Pilih Penyakit --</option>
                                <option value="semua">Semua</option>
                                <option value="TBC">TBC</option>
                                <option value="Pneunomia">Pneunomia</option>
                                <option value="HIV/AIDS">HIV/AIDS</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Usia</label>
                            <select class="form-control select2bs4" name="usia" style="width: 100%;">
                                <option selected="selected" disabled>-- Pilih Usia --</option>
                                <option value="semua">Semua</option>
                                <option value="balita">Balita</option>
                                <option value="remaja">Remaja</option>
                                <option value="dewasa">Dewasa</option>
                                <option value="lansia">Lansia</option>
                            </select>
                        </div>
                        <button class="btn btn-primary waves-effect" type="button" id="filter-data">CARI</button>

                    </form>
                </div>
            </div>


        </div>
    </div>

    <div id="map" class="sidebar-map"></div>
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

    <!-- <a href="https://github.com/Turbo87/sidebar-v2/"><img style="position: fixed; top: 0; right: 0; border: 0;" src="https://s3.amazonaws.com/github/ribbons/forkme_right_darkblue_121621.png" alt="Fork me on GitHub"></a> -->

    <script type="text/javascript" src="{{ asset('/assets/jquery/jquery.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
    <script src="https://unpkg.com/leaflet@1.0.1/dist/leaflet.js"></script>
    <script src="{{asset('asset/js/leaflet-sidebar.js')}}"></script>
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
</body>

</html>