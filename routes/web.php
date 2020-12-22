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

Route::get('/cek', 'DPMController@index');
Route::get('/admission/csv', 'AdmissionController@save_csv');

Route::get('/', 'UserController@index');
Route::get('register', 'UserController@v_register');
Route::get('navbar', 'UserController@navbar');

Route::get('login', 'UserController@v_login')->name('login');
Route::post('login', 'UserController@login');
Route::post('register', 'UserController@register');
Route::get('logout', 'UserController@logout');
Route::post('newPassword', 'UserController@newPassword');

Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('/', 'UserController@dashboard')->name('dashboard');
        Route::get('bap', 'BAPController@index')->name('bap');
        Route::get('bap/{proker}', 'BAPController@createBAPProker')->name('bapProker');
        Route::post('bap', 'BAPController@insertBAPProker')->name('insertBAPProker');
        Route::put('bap', 'BAPController@updateBAPProker')->name('updateBAPProker');

        Route::get('indikator', 'IndikatorController@index')->name('indikator');
        Route::get('indikator/{id}', 'IndikatorController@editIndikator')->name('editIndikator');
        Route::post('indikator', 'IndikatorController@insertIndikator')->name('insertIndikator');
        Route::put('indikator', 'IndikatorController@updateIndikator')->name('updateIndikator');
        Route::delete('indikator', 'IndikatorController@deleteIndikator')->name('deleteIndikator');

        Route::get('kegiatan', 'KegiatanController@index')->name('kegiatan');
        Route::get('kegiatan/{id}', 'KegiatanController@editKegiatan')->name('editKegiatan');
        Route::post('kegiatan', 'KegiatanController@insertKegiatan')->name('insertKegiatan');
        Route::put('kegiatan', 'KegiatanController@updateKegiatan')->name('updateKegiatan');
        Route::delete('kegiatan', 'KegiatanController@deleteKegiatan')->name('deleteKegiatan');

        Route::get('printBAP/{id}', 'BAPController@printBAP')->name('printBAP');

    });
});

Route::post('submit', 'BAPController@debug');


//DEBUG
Route::get('demo-css', 'UserController@demo_css');
Route::get('demo-js', 'UserController@demo_js');
Route::get('component', 'UserController@component');
Route::get('file', 'UserController@v_file');
Route::get('exportFile', 'UserController@exportFile')->name('exportFile');
Route::post('file', 'UserController@file')->name('file');
Route::get('pdf', 'UserController@pdf');
Route::view('a', 'debug.a');


// Route::get('/api/admission/csv','AdmissionController');






