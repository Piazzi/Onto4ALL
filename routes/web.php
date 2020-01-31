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


// Rotas do perfil do usuário
Route::resource('/profile', 'ProfileController')->middleware('can:eModelador');
Route::get('/change_password/{id}', 'ProfileController@changePassword')->middleware('can:eModelador');
Route::put('/update_password/{id}', 'ProfileController@updatePassword')->name('profile.updatePassword')->middleware('can:eModelador');

// Rotas do Socialite
Route::get('/redirect', 'SocialAuthFacebookController@redirect');
Route::get('/callback', 'SocialAuthFacebookController@callback');


// Rotas do CRUD's

Route::any('/ontology_relation/search', 'OntologyRelationController@search')->name('ontology_relation.search')->middleware('can:eAdmin');
Route::resource('/ontology_relation', 'OntologyRelationController')->middleware('can:eAdmin');


Route::any('/ontology_class/search', 'OntologyClassController@search')->name('ontology_class.search')->middleware('can:eAdmin');
Route::resource('/ontology_class', 'OntologyClassController')->middleware('can:eAdmin');

// CRUD de ontologias
Route::resource('/ontologies', 'OntologyController')->middleware('can:eModelador');
Route::get('/ontologies/download/{userId}/{ontologyId}', 'OntologyController@download')->name('ontologies.download')->middleware('can:eModelador');
Route::get('/ontologies/downloadOWL/{userId}/{ontologyId}', 'OntologyController@downloadOWL')->name('ontologies.downloadOWL')->middleware('can:eModelador');
Route::put('/ontologies/favourite/{userId}/{ontologyId}', 'OntologyController@saveAsFavourite')->name('ontologies.favourite')->middleware('can:eModelador');
Route::put('/ontologies/normal/{userId}/{ontologyId}', 'OntologyController@saveAsNormal')->name('ontologies.normal')->middleware('can:eModelador');

// CRUD de mensagens
Route::resource('/messages', 'MessageController')->middleware('can:eAdmin');
Route::any('/messages/search', 'MessageController@search')->name('messages.search')->middleware('can:eAdmin');

// Rotas do Editor
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/save', 'HomeController@save');
Route::post('/saveXML', 'HomeController@saveXML');
Route::post('/exportOWL', 'HomeController@exportOWL');
Route::get('/aboutUs', 'HomeController@aboutUs')->name('aboutUs');
Route::get('/tutorial', 'HomeController@tutorial')->name('tutorial');
Route::get('/errorIndex', 'HomeController@errorIndex')->name('errorIndex');
Route::get('/open');
Route::post('/export', 'HomeController@export');
Route::post('/exportImage', 'HomeController@exportImage');
Route::get('/help', 'HomeController@help')->name('help');