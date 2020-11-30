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
    if(!Auth::check()){
        return view('welcome');
    }else{
        return redirect('/dashboard');
    }
});
Route::get('register', function () {
    return view('register');
});
Route::get('navbar', function () {
    return view('navbar');
});

Route::post('login', 'UserController@login');
Route::post('register', 'UserController@register');
Route::get('logout', 'UserController@logout');
Route::post('newPassword', 'UserController@newPassword');

Route::get('dashboard', function () {
    if (!Auth::check()) {
        return redirect('/');
    }
    return view("dashboard");
});

//DEBUG
Route::get('demo-css', function () {
    return view('debug.demo-css');
});
Route::get('demo-js', function () {
    return view('debug.demo-js');
});
Route::get('component', function () {
    return view('debug.component');
});
Route::get('file', function () {
    return view('debug.file');
});
Route::get('exportFile', function () {
    $pdf = PDF::loadView('debug.pdf');
    return $pdf->download('theFile.pdf');
});
Route::post('file', 'UserController@file');
Route::get('pdf', function () {
    return view('debug.pdf');
});
