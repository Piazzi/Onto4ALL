<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OntologyClassController;
use App\Http\Controllers\OntologyController;
use App\Http\Controllers\OntologyRelationController;
use App\Http\Controllers\ThesauruController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserNotificationsController;
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

Route::post('/logout', [LoginController::class, 'logout']);
Route::get('/', function () {
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
    })->name('landing-page');

    //Auth::routes();
    // Authentication Routes...


    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    // Registration Routes...
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);

    // Password Reset Route
    Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');

    // User routes
    Route::resource('/user', UserController::class)->middleware('can:eModelador');
    Route::get('/change_password/{id}', [UserController::class, 'changePassword'])->name('user.editPassword')->middleware('can:eModelador');
    Route::put('/update_password/{id}', [UserController::class, 'updatePassword'])->name('user.updatePassword')->middleware('can:eModelador');
    Route::any('/ontology_relation/search', [OntologyRelationController::class, 'search'])->name('ontology_relation.search')->middleware('can:eAdmin');
    Route::resource('/ontology_relation', OntologyRelationController::class)->middleware('can:eAdmin');
    Route::any('/ontology_class/search', [OntologyClassController::class, 'search'])->name('ontology_class.search')->middleware('can:eAdmin');
    Route::resource('/ontology_class', OntologyClassController::class)->middleware('can:eAdmin');

    // Ontologies CRUD
    Route::resource('/ontologies', OntologyController::class)->middleware('can:eModelador');

    Route::get('/ontologies/download/{userId}/{ontologyId}', [OntologyController::class, 'downloadXML'])->name('ontologies.download')->middleware('can:eModelador');
    Route::get('/ontologies/downloadOWL/{userId}/{ontologyId}', [OntologyController::class, 'downloadOWL'])->name('ontologies.downloadOWL')->middleware('can:eModelador');
    Route::get('/ontologies/downloadSVG/{userId}/{ontologyId}', [OntologyController::class, 'downloadSVG'])->name('ontologies.downloadSVG')->middleware('can:eModelador');
    Route::put('/ontologies/favourite/{userId}/{ontologyId}', [OntologyController::class, 'saveAsFavourite'])->name('ontologies.favourite')->middleware('can:eModelador');
    Route::put('/ontologies/normal/{userId}/{ontologyId}', [OntologyController::class, 'saveAsNormal'])->name('ontologies.normal')->middleware('can:eModelador');
    Route::post('/updateOrCreate', [OntologyController::class, 'updateOrCreate']);
    Route::post('/favouriteOntologyIndex', [OntologyController::class, 'favouriteOntologyIndex'] )->middleware('can:eModelador');

    // Thesaurus CRUD
    Route::resource('/thesaurus', ThesauruController::class)->middleware('can:eModelador');
    Route::get('/thesaurus-editor', [ThesauruController::class, 'editor'])->name('thesaurus-editor')->middleware('can:eModelador');

    //Notifications CRUD
    Route::get('notifications', [UserNotificationsController::class, 'index'])->name('notifications.index')->middleware('auth');
    Route::post('notifications/send-contact', [UserNotificationsController::class, 'sendContactNotification'])->name('notifications.send-contact')->middleware('auth');
    Route::get('notifications/{notificationId}/{notificationType}/show', [UserNotificationsController::class, 'show'])->name('notifications.show')->middleware('auth');

    // Editor routes
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/aboutUs', [HomeController::class, 'aboutUs'])->name('aboutUs');
    Route::get('/tutorial', [HomeController::class, 'tutorial'])->name('tutorial');
    Route::get('/warningIndex', [HomeController::class, 'warningIndex'])->name('warningIndex');
    Route::get('/help', [HomeController::class, 'help'])->name('help');

    // AdminController
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index')->middleware('can:eAdmin');
    Route::get('/admin/{id}', [AdminController::class, 'edit'])->name('admin.edit')->middleware('can:eAdmin');
    Route::put('/admin/{userId}', [AdminController::class, 'update'])->name('admin.update')->middleware('can:eAdmin');
    Route::any('/admin/search', [AdminController::class, 'search'])->name('admin.search')->middleware('can:eAdmin');

});


// Editor Routes that doesnt require localization
Route::post('/openOntology', [OntologyController::class, 'openOntologyInTheEditor']);
Route::post('/openLastUpdatedOntology', [OntologyController::class, 'openLastUpdatedOntology']);
Route::post('/export', [HomeController::class, 'export']);
Route::post('/exportImage', [HomeController::class, 'exportImage']);
Route::post('/exportOWL', [HomeController::class, 'exportOWL']);
Route::post('/exportXML', [HomeController::class, 'exportXML']);
Route::get('/thesaurus/download/{userId}/{thesauruId}', [ThesauruController::class, 'download'])->name('thesaurus.download')->middleware('can:eModelador');
// mxGraph Routes (don't remove)
Route::get('/open');
Route::post('/save');

 // Chat
 Route::post('/updateChat/{id}', [ChatController::class, 'updateChat'] )->middleware('can:eModelador');
 Route::post('/sendChat', [ChatController::class, 'sendChat'] )->middleware('can:eModelador');

// Socialite routes
//Route::get('/redirect', 'SocialAuthFacebookController@redirect');
//Route::get('/callback', 'SocialAuthFacebookController@callback');

// Password Reset Routes...
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.reset');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm']);
Route::post('password/reset', [ResetPasswordController::class, 'reset']);
