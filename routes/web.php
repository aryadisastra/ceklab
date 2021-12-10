<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/get-data-lab', 'PasienLabController@getPdf');

Route::get('/logout', 'LoginController@logout');
Route::get('/admin', 'LoginController@index');
Route::get('/dashboard', 'LoginController@index');
Route::get('/dashboard/getData', 'LoginController@getData');
Route::get('/admin/login', 'LoginController@login');

Route::get('/data-lab','dataLabController@index');
Route::get('/data-lab/ceklab/{id}','dataLabController@detailLab');
Route::post('/data-lab/ceklab','dataLabController@updateLab');

Route::get('/data-perawat','dataPerawatController@index');
Route::post('/data-perawat','dataPerawatController@add');
Route::get('/data-perawat/{id}','dataPerawatController@detail');
Route::put('/data-perawat','dataPerawatController@update');

Route::get('/data-dokter','dataDokterController@index');
Route::post('/data-dokter','dataDokterController@add');
Route::get('/data-dokter/{id}','dataDokterController@detail');
Route::put('/data-dokter','dataDokterController@update');

Route::get('/data-pasien','dataPasienController@index');
Route::put('/data-pasien','dataPasienController@update');
Route::post('/data-pasien','dataPasienController@add');
Route::get('/data-pasien/{id}','dataPasienController@detail');
Route::get('/data-pasien/ceklab/{id}','dataPasienController@cekLab');
Route::post('/data-pasien/ceklab','dataPasienController@addcekLab');
