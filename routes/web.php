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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::post('/admin/slides', 'SlidesController@store')->name('storeSlide');
Route::put('/admin/slides/{id}', 'SlidesController@update');
Route::delete('/admin/slides/{id}', 'SlidesController@delete');

Route::get('/eventos-y-avisos', 'HomeController@events')->name('events');

Route::post('/admin/events', 'EventsController@store')->name('storeEvent');
Route::put('/admin/events/{id}', 'EventsController@update');
Route::delete('/admin/events/{id}', 'EventsController@delete');

Route::post('/admin/notices', 'NoticesController@store')->name('storeNotice');
Route::put('/admin/notices/{id}', 'NoticesController@update');
Route::delete('/admin/notices/{id}', 'NoticesController@delete');

Route::post('/admin/sports', 'SportsController@store');
Route::post('/admin/requirements', 'TournamentsController@requirementCreate');

Route::group(['prefix' => '/torneos'], function () {
    Route::get('/', 'TournamentsController@index')->name('tournamentsIndex');
    Route::get('/nuevo', 'TournamentsController@new')->name('newTournament');
    Route::post('/nuevo', 'TournamentsController@store')->name('newTournament');

    Route::put('/{id}', 'TournamentsController@update')->name('updateTournament');
    Route::get('/{id}/editar', 'TournamentsController@edit')->name('editTournament');

    Route::get('/{id}', 'TournamentsController@show')->name('signUpTournament');
    Route::get('/{id}/equipo', 'TournamentsController@team')->name('teamSelect');
    Route::get('/{id}/voucher')->name('tournamentVoucher');

    Route::get('/completar')->name('completeSignup');
});

Route::post('/teams', 'TeamsController@store');
Route::post('/teams/{id}', 'TeamsController@request');

Route::get('/mis_equipos', 'TeamsController@index')->name('teamsIndex');
Route::put('/mis_equipos/{id}', 'TeamsController@update')->name('updateUserTeam');


Route::get('/deportes', 'SportsController@index')->name('sportsIndex');
Route::put('/deportes/{sportName}', 'SportsController@update')->name('updateSport');
Route::delete('/deportes/{sportName}', 'SportsController@delete')->name('deleteSport');

Route::get('/cuenta', 'Auth\UpdateAccountController@show')->name('updateAccount');
Route::put('/cuenta', 'Auth\UpdateAccountController@update')->name('updateAccount');

Route::get('/historico', 'HistoricController@index')->name('historicIndex');
Route::get('/historico/{id}', 'HistoricController@show')->name('tournamentHistoric');