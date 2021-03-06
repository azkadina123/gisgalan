
var dataKecamatan = [];
var kecamatan = L.layerGroup();
var jsondt = [];
let url_kecamtan = "../asset/json/kecamatan.json";
let url_kelurahan = "../asset/json/fixs.json";
let wilayah = $('#wilayah').val();
var url = '';
if (wilayah == 'kecamatan') {
    alert('kecamatan');
    url = url_kecamtan;
} else {
    url = url_kelurahan;
}
$.ajax({
    url: url,
    async: false,
    dataType: 'json',
    success: function (json) {
        jsondt = json;
    }
});
$.ajax({
    url: '/getKecamatan',
    dataType: 'JSON',
    async: false,
    success: function (data) {
        // console.log(data);
        $.each(data.kecamatan, function (index, val) {
            dataKecamatan[index] = val;
            // console.log(index);
        });
    }
});
var init = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox/streets-v11',
    tileSize: 512,
    zoomOffset: -1,
    // accessToken: 'your.mapbox.access.token'

});
var mymap = L.map('map', {
    center: [-6.8686, 109.1129],
    zoom: 13,
    layers: [init]
});

var sidebar = L.control.sidebar('sidebar').addTo(mymap);

var info = L.control();
info.onAdd = function (map) {
    this._div = L.DomUtil.create('div', 'info');
    this.update();
    return this._div;
};
info.update = function (props) {
    // console.log(props);
    this._div.innerHTML = '' + (props ? '<b> Kecamtan. ' + props.sub_district + '</b>' : '-');
    this._div.innerHTML += '<br>';
    this._div.innerHTML += '' + (props ? '<b> Kel. ' + props.village + '</b>' : '-');
};
info.addTo(mymap);


function onEachFeature(feature, layer) {
    // $("#featureModal").modal("show");
    layer.on({
        mouseover: hightlightFeature,
        mouseout: resetHightlight,
        click: zoomToFeature
    });


}

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
    });
    info.update();
}

function style(f) {
    var kode_kec = f.properties.kode_district;
    data = dataKecamatan[kode_kec];
    console.log(data.collor_maps);
    return {
        weight: 1,
        opacity: 1,
        color: 'white',
        dashArray: '',
        fillOpacity: 1,
        // fillColor: '#006cd8'
        fillColor: (data.collor_maps != 'undefined') ? data.collor_maps : ''
    }
}

var layers;
layers = L.geoJSON(jsondt, {
    onEachFeature: onEachFeature,
    style: style
}).addTo(mymap);

function zoomToFeature(e) {
    mymap.fitBounds(e.target.getBounds());
    let _token = $('meta[name="csrf-token"]').attr('content');
    let data = e.target.feature.properties;
    // let dataForm = [];
    dataForm = $('#form-filters').serializeArray()

    console.log(data);
    if (data.wilayah == 'kelurahan') {
        dataForm.push({ name: "id_desa", value: data.kode_village });
        var kelurahan = data.village;
    } else {
        dataForm.push({ name: "id_kecamatan", value: data.kode_district });
        var kelurahan = '-';
    }
    // dataForm.push();
    dataForm.push({ name: "_token", value: _token });
    console.log(dataForm);
    $.ajax({
        type: "post",
        url: "/getDataModal",
        data: dataForm,
        dataType: "JSON",
        success: function (response) {
            // let kelurahan = response.kelurahan;
            $('#featureModal').modal('show');
            chart.update({
                title: {
                    text: data.sub_district.toUpperCase()
                },
                subtitle: {
                    text: kelurahan
                },
                series: [{
                    name: 'KASUS',
                    data: response.chart
                }]
            });

        }
    });

}
$('div.list-group-item button.btn-grafik').click(function (e) {
    e.preventDefault();
    let kode_village = $(this).data('id_desa');
    $('#featureModal').modal('show');

});
var geojson;
var layerGroup = L.layerGroup().addTo(mymap);
var layerGroupkelurahan = L.layerGroup().addTo(mymap);
$('#filter-data').click(function (e) {
    e.preventDefault();
    let wilayah = $('#wilayah').val();
    if (wilayah == 'kecamatan') {
        url = url_kecamtan;
    } else {
        url = url_kelurahan;
    }
    var dtkec = [];


    // console.log(url);
    // alert(url)
    // layers.clearLayers();
    // layersFilter.clearLayers()
    // mymap.removeLayer(layersFilter)

    $.ajax({
        url: url,
        async: false,
        dataType: 'json',
        success: function (json) {
            jsondt = json;
        }
    });
    // console.log(newjson);
    let url_post = $('form-filters').attr('action');
    console.log(url_post);
    let _token = $('meta[name="csrf-token"]').attr('content');
    var formData = $('#form-filters').serializeArray();
    formData.push({ name: "_token", value: _token });
    $.ajax({
        type: 'post',
        url: '/getFilter',
        data: formData,
        dataType: 'JSON',
        // async: false,
        success: function (data) {
            console.log(data);
            if (data.wilayah == 'kecamatan') {
                $.each(data.data, function (index, val) {
                    dtkec[val] = val;
                });
            } else if (data.wilayah == 'kelurahan') {
                // console.log('desa' + data.data);
                $.each(data.data, function (index, val) {
                    dtkec[val] = val;
                    // console.log(index + '--' + val);
                });

            }
        }
    });
    if (layers) {
        mymap.removeLayer(layers);

        console.log('remove');
    }
    cleanLayer();
    $.getJSON(url, function (data) {
        console.log(dtkec);
        if (wilayah == 'kecamatan') {
            // mymap.removeLayer(layerGroupkelurahan);

            $.each(data.features, function (index, val) {
                var id = val.properties.kode_district;
                if (dtkec[id] == id) {
                    console.log('datas' + id);
                    L.geoJSON(val, {
                        onEachFeature: onEachFeature,
                        style: style
                    }).addTo(layerGroup);
                }
            });
        } else if (wilayah == 'kelurahan') {
            // mymap.removeLayer(layerGroup);

            $.each(data.features, function (index, val) {
                var id = val.properties.kode_village;
                if (dtkec[id] == id) {
                    console.log('datas' + id);
                    L.geoJSON(val, {
                        onEachFeature: onEachFeature,
                        style: style
                    }).addTo(layerGroupkelurahan);
                }
            });
        }
    });
});
function cleanLayer() {
    layerGroup.clearLayers();
    layerGroupkelurahan.clearLayers();
}