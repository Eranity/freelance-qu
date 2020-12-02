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


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


# Tech card routes ================================================================================================================

Route::get('/tech-cards', 'TechCardsController@index')->name('tech-cards');

Route::get('/ibp', 'Ibp\IbpController@index')->name('ipb');


Route::get('/tech-cards/create', 'TechCardsController@create')->name('tech-card.add');;

Route::post('/tech-cards/create', 'TechCardsController@createTechCard')->name('tech-card.save');


Route::get('/tech-cards/{id}/edit', 'TechCardsController@edit')->name('tech-card.edit');;

Route::post('/tech-cards/{id}/edit', 'TechCardsController@update')->name('tech-card.update');


Route::get('/tech-cards/{id}', 'TechCardsController@details');


Route::get('/tech-cards/{techCardId}/stage/{stageId}', 'TechCardsController@stageView')->name('tech-card.stage.add');

Route::post('/tech-cards/{techCardId}/stage/{stageId}', 'TechCardsController@addWork')->name('tech-card.stage.create');

Route::get('/tech-cards/{techCardId}/stage/work/{workId}/edit', 'TechCardsController@editWork')->name('tech-card.stage.work.edit');

Route::put('/tech-cards/{techCardId}/stage/work/{workId}/edit', 'TechCardsController@updateWork')->name('tech-card.stage.work.update');

Route::delete('/tech-cards/{techCardId}/stage/work/{workId}', 'TechCardsController@deleteWork')->name('tech-card.stage.work.delete');


Route::get('/applications/create', 'Applications\ApplicationsController@create')->name('application.create');

Route::post('/applications', 'Applications\ApplicationsController@store')->name('application.store');

#====================================================================================================================================


#Project routes
Route::get('/project', 'ProjectController@index')->name('project');

Route::post('/project/{id}/respond', 'ProjectController@respond');

Route::get('/project/{id}', 'ProjectController@details')->name('project-details');

Route::get('/project/create/{id}', 'ProjectController@create_view')->name('project-create');

Route::post('/project/create/{id}', 'ProjectController@create');

Route::post('/project/respond/{id}', 'ProjectController@respond');

Route::post('/project/aproveResponse/{id}', 'ProjectController@aproveResponse');

Route::post('/project/rejectResponse/{id}', 'ProjectController@rejectResponse');

#====================================================================================================================================

#Iniciator routes

Route::get('/busyness', 'ExecutorController@busyness')->name('busyness');


