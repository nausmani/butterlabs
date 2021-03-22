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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('file-upload', 'FileUploadController@fileUpload')->name('file.upload');
Route::post('file-upload', 'FileUploadController@fileUploadPost')->name('file.upload.post');


Route::get('pdf-upload/frontier', 'FileUploadController@frontier');
Route::post('pdf-upload/frontier', 'FileUploadController@frontierHandle');

Route::get('pdf-upload/comcast', 'FileUploadController@comcast');
Route::post('pdf-upload/comcast', 'FileUploadController@comcastHandle');

Route::get('pdf-upload/rednight', 'FileUploadController@redNight');
Route::post('pdf-upload/rednight', 'FileUploadController@redNightHandle');
