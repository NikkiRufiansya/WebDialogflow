<?php

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
    return view('/auth/login');
});

Route::view('/admin','pertanyaan');
Route::post('putjson','FirebaseController@index');
Route::get('/mahasiswa/tambah','MahasiswaController@tambah');
Route::get('mahasiswa','MahasiswaController@index');
Route::post('/mahasiswa/store','MahasiswaController@store');
Route::get('/mahasiswa/edit/{id}','MahasiswaController@edit');
Route::put('/mahasiswa/update/{id}', 'MahasiswaController@update');
Route::get('/mahasiswa/hapus/{id}', 'MahasiswaController@destroy');
Route::get('users', 'HomeController@users');
Route::get('trainingData/{id}','TrainingData@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
