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

Route::get('/logout', 'Auth\LoginController@logout');


Route::get('/', function (){
   return redirect(app()->getLocale());
});

// Route group with localization
Route::group([
    'prefix' => '{locale}',
    'where' => ['locale' => '[a-zA-Z]{2}'],
    'middleware' => 'setLocale',
    ], function () {

    Route::get('/', function () {
        return view('landing-page');
    });

    //Auth::routes();

    // Authentication Routes...
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

    // Registration Routes...
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register');

    // Password Reset Route
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');

    // User routes
    Route::resource('/user', 'UserController')->middleware('can:eModelador');
    Route::get('/change_password/{id}', 'UserController@changePassword')->name('user.editPassword')->middleware('can:eModelador');
    Route::put('/update_password/{id}', 'UserController@updatePassword')->name('user.updatePassword')->middleware('can:eModelador');

    Route::any('/ontology_relation/search', 'OntologyRelationController@search')->name('ontology_relation.search')->middleware('can:eAdmin');
    Route::resource('/ontology_relation', 'OntologyRelationController')->middleware('can:eAdmin');

    Route::any('/ontology_class/search', 'OntologyClassController@search')->name('ontology_class.search')->middleware('can:eAdmin');
    Route::resource('/ontology_class', 'OntologyClassController')->middleware('can:eAdmin');

    // Ontologies CRUD
    Route::resource('/ontologies', 'OntologyController')->middleware('can:eModelador');
    Route::get('/ontologies/download/{userId}/{ontologyId}', 'OntologyController@downloadXML')->name('ontologies.download')->middleware('can:eModelador');
    Route::get('/ontologies/downloadOWL/{userId}/{ontologyId}', 'OntologyController@downloadOWL')->name('ontologies.downloadOWL')->middleware('can:eModelador');
    Route::put('/ontologies/favourite/{userId}/{ontologyId}', 'OntologyController@saveAsFavourite')->name('ontologies.favourite')->middleware('can:eModelador');
    Route::put('/ontologies/normal/{userId}/{ontologyId}', 'OntologyController@saveAsNormal')->name('ontologies.normal')->middleware('can:eModelador');

    // Thesaurus CRUD
    Route::resource('/thesaurus', 'ThesauruController')->middleware('can:eModelador');
    Route::get('/thesaurus-editor', 'ThesauruController@editor')->name('thesaurus-editor')->middleware('can:eModelador');


    // Messages CRUD
    Route::resource('/messages', 'MessageController')->middleware('can:eAdmin');
    Route::any('/messages/search', 'MessageController@search')->name('messages.search')->middleware('can:eAdmin');

    // Editor routes
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/aboutUs', 'HomeController@aboutUs')->name('aboutUs');
    Route::get('/tutorial', 'HomeController@tutorial')->name('tutorial');
    Route::get('/warningIndex', 'HomeController@warningIndex')->name('warningIndex');


    Route::get('/help', 'HomeController@help')->name('help');

    // AdminController
    Route::get('/admin', 'AdminController@index')->name('admin.index')->middleware('can:eAdmin');
    Route::get('/admin/{id}', 'AdminController@edit')->name('admin.edit')->middleware('can:eAdmin');
    Route::put('/admin/{userId}', 'AdminController@update')->name('admin.update')->middleware('can:eAdmin');
    Route::any('/admin/search', 'AdminController@search')->name('admin.search')->middleware('can:eAdmin');


});


// Diagram routes
Route::post('/openDiagram', 'DiagramController@openDiagram');
Route::post('/openRecentDiagram', 'DiagramController@openRecentDiagram');
Route::post('/export', 'HomeController@export');
Route::post('/exportImage', 'HomeController@exportImage');
Route::post('/save', 'HomeController@save');
Route::post('/exportFile', 'HomeController@exportFile');
Route::post('/exportOWL', 'HomeController@exportOWL');
Route::post('/exportXML', 'HomeController@exportXML');
Route::get('/open');
Route::post('/updateOrCreate', 'OntologyController@updateOrCreate');

Route::get('/thesaurus/download/{userId}/{thesauruId}', 'ThesauruController@download')->name('thesaurus.download')->middleware('can:eModelador');

// Socialite routes
//Route::get('/redirect', 'SocialAuthFacebookController@redirect');
//Route::get('/callback', 'SocialAuthFacebookController@callback');


// Password Reset Routes...
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.reset');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');