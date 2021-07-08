
    var dataKecamatan = [];
    var overlays = [];
    var red = L.layerGroup();
    var yellow = L.layerGroup();
    let url_json = "../asset/json/fixs.json";
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
            mouseout: resetHightlight,
            click : zoomToFeature
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
            '<p class="mb-1 mt-1"><i><u>Kecamatan</u></i></p>' +
            '<p class="mb-1 mt-1"><b>' + data.sub_district + '</b></p>' +
            '</div>' +
            '<div class="list-group-item list-group-item-action flex-column align-items-start pt-1 pb-1 pl-2 pr-2">' +
            '<p class="mb-1 mt-1"><i><u>Status Zonasi</u></i></p>' +
            '<button class="btn btn-info btn-sm btn-grafik" data-id_desa="' + data.kode_village + '">View Grafik</button>' +
            '</div>' +

            '</div>';

        // layer.bindPopup(popup);

    }

    // mymap.on('click', function(e) {
    //     alert("Lat, Lon : " + e.latlng.lat + ", " + e.latlng.lng)
    // });
    function show() {
        // alert(this.data('id_desa'))
        console.log($(this).data('id_desa'));
        $('#featureModal').modal('show');
    }
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

    function zoomToFeature(e) {
        mymap.fitBounds(e.target.getBounds());
        console.log(e.target.feature);
        let _token = $('meta[name="csrf-token"]').attr('content');
        let data = e.target.feature
        $.ajax({
            type: "post",
            url: "/getDataModal",
            data: {
                'id_desa' : data.properties.kode_village,
                _token: _token
            },
            dataType: "JSON",
            success: function (response) {
                let kelurahan = response.kelurahan;
                $('#featureModal').modal('show');
                chart.update({
                    title: {
                        text: kelurahan.nama.toUpperCase()
                    },
                    subtitle: {
                        text: 'Data Kelurahan'
                    },
                    series: [{
                        name: 'KASUS',
                        data:response.chart
                    }]
                });
                
            }
        });

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
    $('div.list-group-item button.btn-grafik').click(function(e) {
        e.preventDefault();
        let kode_village = $(this).data('id_desa');
        alert(kode_village)
        $('#featureModal').modal('show');

    });
