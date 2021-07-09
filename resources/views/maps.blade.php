<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maps</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin="" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
    <link rel="stylesheet" href="{{asset('asset/css/maps.css')}}">
    <style>
        #mapid {
            max-height: 480px;
        }
    </style>
</head>

<body>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div id="mapid"></div>
                </div>
            </div>
        </div>
    </div>
</body>
<div class="modal fade" id="featureModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title text-primary" id="feature-title"></h4>
            </div>
            <div class="modal-body" id="feature-info"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<!-- <script src="http://dukuhwaru.tegalkab.go.id/assets/Frontend/page/geoJs.js"></script> -->
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> -->
<!-- <script data-require="bootstrap" data-semver="3.3.6" src="{{ asset('/assets/bootstrap/js/bootstrap.min.js') }}"></script> -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<!-- <script type="text/javascript" src="{{ asset('/asset/tegal_barat.js') }}"></script> -->
<script type="text/javascript" src="{{ asset('/assets/jquery/jquery.min.js') }}"></script>
<!-- <script type="text/javascript" src="{{ asset('/asset/tegal_kota.js') }}"></script> -->
<!-- <script type="text/javascript" src="{{ asset('/asset/tes.js') }}"></script> -->

<!-- <script src="https://gist.github.com/ecangsandy/01989522e1d6ac0c2bc211d40af95a1e.js"></script> -->
<!-- <script src="https://gist.github.com/ecangsandy/e174b6308b3a6b8646fdacaf6a493c46.js"></script> -->

<script>
    var dataKecamatan = [];
    var overlays = [];
    var red = L.layerGroup();
    var yellow = L.layerGroup();
    let url_json = "{{ asset('/asset/json/fixs.json') }}";
    var jsondt = [];
    $.ajax({
        url: url_json,
        async: false,
        dataType: 'json',
        success: function(json) {
            jsondt = json;
        }
    });
    $.ajax({
        url: '/getKecamatan',
        dataType: 'JSON',
        async: false,
        success: function(data) {
            // console.log(data);
            $.each(data.kecamatan, function(index, val) {
                dataKecamatan[index] = val;
                // console.log(index);
                overlays[val.sub_district] = val.sub_district;
            });
        }
    });
    // console.log(dataKecamatan);
    $(function() {
        addLegend();
    });

    // var mymap = L.map('mapid').setView([-6.8686, 109.1129], 13);
    // var mymap = L.map('mapid').setView([-6.8686, 109.1129], 13);
    var init = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        // accessToken: 'your.mapbox.access.token'

    });
    var mymap = L.map('mapid', {
        center: [-6.8686, 109.1129],
        zoom: 13,
        layers: [init, red, yellow]
    });

    // L.geoJson(url_json).addTo(mymap);
    getData();
    var baseLayers = {
        "OpenStreetMap": init
    };

    var overlays = {
        "Merah": red,
        "Kuning": yellow,
        // "Hijau": green,
    };
    L.control.layers(baseLayers, overlays).addTo(mymap);

    var info = L.control();
    info.onAdd = function(map) {
        this._div = L.DomUtil.create('div', 'info');
        this.update();
        return this._div;
    };
    info.update = function(props) {
        // console.log(props);
        // data = (props ? dataZonasi[props.KODE_DAGRI] : '');
        this._div.innerHTML = '' + (props ? '<b> Kel. ' + props.village + '</b>' : '-');
    };
    info.addTo(mymap);

    function onMapClick(e) {
        // alert("You clicked the map at " + e.latlng);
        console.log(e);
    }

    // mymap.on('click', onMapClick);

    function onEachFeature(feature, layer) {
        // $("#featureModal").modal("show");
        layer.on({
            mouseover: hightlightFeature,
            mouseout: resetHightlight
        });
        // var popupContent = "<p>I started out as a GeoJSON " +
        //     feature.geometry.type + ", but now I'm a Leaflet vector!</p>";

        if (feature.properties && feature.properties.popupContent) {
            popupContent += feature.properties.popupContent;
        }
        var link = $('#test').click(function() {
            // alert("test");
        });
        let data = feature.properties;
        var popup = '<div class="list-group list-group-flush">' +
            // '<a href="#" class="list-group-item list-group-item-action flex-column align-items-start bg-' + data.color_zona + '">' +
            '<div class="d-flex w-100 justify-content-center">' +
            '<h6 class="mb-1">KEC. ' + data.village + '</h6>' +
            '</div>' +
            '</a>' +
            '<div class="list-group-item list-group-item-action flex-column align-items-start pt-1 pb-1 pl-2 pr-2">' +
            '<p class="mb-1 mt-1"><i><u>Skor Indikator</u></i></p>' +
            '<p class="mb-1 mt-1"><b>' + data.sub_district + '</b></p>' +
            '</div>' +
            '<div class="list-group-item list-group-item-action flex-column align-items-start pt-1 pb-1 pl-2 pr-2">' +
            '<p class="mb-1 mt-1"><i><u>Status Zonasi</u></i></p>' +
            // '<p class="mb-1 mt-1"><b>' + data.status_zona + '</b></p>' +
            '</div>' +

            '</div>';

        layer.bindPopup(popup);

    }

    mymap.on('click', function(e) {
        alert("Lat, Lon : " + e.latlng.lat + ", " + e.latlng.lng)
    });

    function hightlightFeature(e) {
        var layer = e.target;

        layer.setStyle({
            weight: 4, //ketebalan garis
            // color: '#666', //warna garis
            // dashArray: '',
            // fillOpacity: 0, //tingkat transparansi
            // fillColor: "#2262CC" // warna polygon saat hightlight
        });

        if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
            layer.bringToFront();
        }

        info.update(layer.feature.properties);
    }

    function resetHightlight(e) {
        var layer = e.target;
        // console.log(layer);
        layer.setStyle({
            weight: 1, //ketebalan garis
            // color: 'white', //warna garis
            // dashArray: '',
            // fillOpacity: 1, //tingkat transparansi
            // fillColor: "#006cd8" // warna polygon saat hightlight
        });
        info.update();
    }

    function style(f) {
        var kode_kec = f.properties.kode_district;
        data = dataKecamatan[kode_kec];
        return {
            weight: 1,
            opacity: 1,
            color: 'white',
            dashArray: '',
            fillOpacity: 1,
            // fillColor: '#006cd8'
            fillColor: data.collor_maps
        }
    }

    function addLegend() {
        var legend = L.control({
            position: 'bottomright'
        });
        legend.onAdd = function(map) {

            var div = L.DomUtil.create('div', 'info legend');
            div.innerHTML =
                '<i class="bg-red"></i> 0 - 1.8<br>' +
                '<i class="bg-yellow"></i> 1.81 - 3<br>' +
                '<i class="bg-green"></i> Tidak ada Kasus';

            return div;
        };
        legend.addTo(mymap);
    }
    L.geoJSON(jsondt, {
        onEachFeature: onEachFeature,
        style: style
    }).addTo(mymap);
    mymap.on('popupopen', function(e) {

        // $('#featureModal').modal('show');
        // $("img[rel]").overlay();
        console.log(e);
        // show();
    });

    function show() {

        $('#featureModal').modal('show');
    }
    // });
    function getData() {
        $.ajax({
            url: url_json,
            dataType: 'JSON',
            async: false,
            success: function(data) {
                // console.log(data.features);
                // $.each(data.features, function(index, val) {
                //     if (val.properties.kode_district == '1') {
                //         L.geoJSON(val, {
                //             onEachFeature: onEachFeature,
                //             style: {
                //                 "color": "#ff7800",
                //                 weight: 1,
                //                 opacity: 1,
                //                 color: 'white',
                //                 dashArray: '',
                //                 fillOpacity: 1,

                //             }
                //         }).addTo(red);
                //     } else {
                //         L.geoJSON(val, {
                //             onEachFeature: onEachFeature,
                //             // style: style
                //         }).addTo(yellow);
                //     }
                // });
            }
        });

    }
</script>

</html>