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
    return view('file_upload');
});

Route::get('/uploadvue', function () {
    return view('file_upload_vue');
})->name('uploadvue');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('upload', 'StoreAwsController@storeFile')->name('upload');
Route::get('download/{id}', 'StoreAwsController@getFile')->name('download');
Route::get('files', 'StoreAwsController@getFilesData')->name('files');