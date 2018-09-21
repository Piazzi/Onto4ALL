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
Route::get('auth/logout', 'Auth\AuthController@logout');


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin/settings', 'UserController@index')->name('settings');
Route::get('/profile', 'ProfileController@index');
Route::get('/admin/users/{user}', 'UserController@update');
Route::post('/open', 'MxGraphController@open')->name('open');
Route::post('/save', 'MxGraphController@save')->name('save');

Route::get('/aboutUs', function (){
    return view('aboutUs');
});

Route::get('tutorial', function() {
    return view('tutorial');
});

Route::get('/example1', function () {
    return view('ontology_example1');
});




