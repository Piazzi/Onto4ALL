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


Route::resource('/profile', 'ProfileController')->middleware('can:eModelador');
Route::get('/change_password/{id}', 'ProfileController@changePassword')->middleware('can:eModelador');
Route::put('/update_password/{id}', 'ProfileController@updatePassword')->name('profile.updatePassword')->middleware('can:eModelador');

// Rotas do Socialite
Route::get('/redirect/{service}', 'Auth\LoginController@redirectToProvider');
Route::get('/callback/{service}', 'Auth\LoginController@handleProviderCallback');


// Rotas do CRUD's
Route::resource('/menus', 'MenuController')->middleware('can:eAdmin');

Route::any('/tips_relations/search', 'TipsRelationController@search')->name('tips_relations.search')->middleware('can:eAdmin');
Route::resource('/tips_relations', 'TipsRelationController')->middleware('can:eAdmin');


Route::any('/tips_class/search', 'TipClassController@search')->name('tips_class.search')->middleware('can:eAdmin');
Route::resource('/tips_class', 'TipClassController')->middleware('can:eAdmin');


Route::resource('/ontologies', 'OntologyController')->middleware('can:eModelador');
Route::get('/ontologies/download/{userId}/{ontologyId}', 'OntologyController@download')->name('ontologies.download')->middleware('can:eModelador');
Route::get('/ontologies/downloadOWL/{userId}/{ontologyId}', 'OntologyController@downloadOWL')->name('ontologies.downloadOWL')->middleware('can:eModelador');
Route::put('/ontologies/favourite/{userId}/{ontologyId}', 'OntologyController@saveAsFavourite')->name('ontologies.favourite')->middleware('can:eModelador');
Route::put('/ontologies/normal/{userId}/{ontologyId}', 'OntologyController@saveAsNormal')->name('ontologies.normal')->middleware('can:eModelador');


// Rotas do Editor
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/save', 'HomeController@save');
Route::post('/saveXML', 'HomeController@saveXML');
Route::post('/exportOWL', 'HomeController@exportOWL');
Route::get('/aboutUs', 'HomeController@aboutUs');
Route::get('/tutorial', 'HomeController@tutorial');
Route::get('/open');
Route::post('/export', 'HomeController@export');
Route::post('/exportImage', 'HomeController@exportImage');
