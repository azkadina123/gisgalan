<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataMaps;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/home', function () {
    return view('dashboard/grafik');
});

Route::get('/', function () {
    return view('/auth/login');
});

// Route::get('/login', function () {
//     return view('login');
// });

Route::resource('/keloladataakun', 'DataakunController');




Route::resource('/permintaanverifikasi', 'permintaanController');


Route::resource('/statuspermintaan', 'statuspermintaanController');


Route::resource('/keloladatapenyakit', 'KeloladatapenyakitController');


Route::get('/grafik', function () {
    return view('dashboard/grafik');
});
Route::resource('/tampilpeta', 'datatampilController');

Route::resource('/riwayat', 'riwayatdataController');

Route::resource('/riwayat', 'riwayatdatapenyakitController');

Route::resource('/masyarakat', 'detaildatatampilController');



Route::get('/peta', function () {
    return view('masyarakat/peta');
});
Route::get('/tes', function () {
    return view('masyarakat/tes');
});


Auth::routes();

Route::get('/home1', 'HomeController@index')->name('home');
Route::get('/getKecamatan', [DataMaps::class, 'getKecamatan']);
Route::any('/getDataModal', [DataMaps::class, 'getKecamatanId']);
Route::get('/maps', function () {
    return view('map/mapview1');
});
Route::get('/maps1', function () {
    return view('map/mapview');
});
Route::get('/maps2', function () {
    return view('maps1');
});
Route::any('/getFilter', [DataMaps::class, 'getFilter']);
