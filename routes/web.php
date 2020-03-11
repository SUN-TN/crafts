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
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
});

Route::any('/component/upload','Component\UploadController@upload');


Route::get('uuid-gen', function () {

    dd(Uuid::generate(4)->string);

});

Route::post('/sendSecurityCode','Component\SendSecurityCodeController@sendSecurityCode');


include __DIR__.'/admin/web.php';
include __DIR__.'/entry/web.php';
