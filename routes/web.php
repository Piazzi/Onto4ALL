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
    return view('vendor/adminlte/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/mxgraph', 'MxGraphController@index')->name('mxgraph');
Route::get('/admin/settings', 'UserController@index')->name('settings');
Route::get('/profile', 'ProfileController@index');
Route::get('/admin/users/{user}', 'UserController@update');

Route::get('tutorial', function() {
    return view('tutorial');
});




