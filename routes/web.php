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

Route::get('/logout', 'Auth\LoginController@logout');

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin/settings', 'UserController@index')->name('settings');
Route::get('/profile', 'ProfileController@index');
Route::get('/admin/users/{user}', 'UserController@update');


Route::get('/aboutUs', function (){
    return view('about_us');
});

Route::get('tutorial', function() {
    return view('tutorial');
});

// Rotas do Socialite
Route::get('/redirect/{service}', 'Auth\LoginController@redirectToProvider');
Route::get('/callback/{service}', 'Auth\LoginController@handleProviderCallback');

// Rotas do CRUD's
Route::resource('/menus', 'MenuController')->middleware('can:eAdmin');
Route::resource('/tips_relations', 'TipsRelationController')->middleware('can:eAdmin');
Route::resource('/tips_class', 'TipClassController')->middleware('can:eAdmin');
Route::resource('/ontologies', 'OntologyController')->middleware('can:eModelador');


Route::post('/save', 'HomeController@save');
Route::get('/open');
Route::get('/export');
