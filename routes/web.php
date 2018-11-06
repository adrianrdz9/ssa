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
Route::post('/admin/tournaments', 'TournamentsController@store');

Route::get('/torneos', 'TournamentsController@index')->name('tournamentsIndex');
Route::get('/torneos/nuevo', 'TournamentsController@new')->name('newTournament');
Route::get('/torneos/completar', 'TournamentsController@complete')->name('completeSignup');
Route::get('/torneos/completar/{id}', 'TournamentsController@query')->name('querySignup');
Route::put('/torneos/completar/{id}', 'TournamentsController@update');
Route::get('/torneos/{id}', 'TournamentsController@show')->name('signUpTournament');
Route::post('/torneos/{id}', 'TournamentsController@signUp')->name('signUpTournament');
Route::delete('/torneos/{id}', 'TournamentsController@delete')->name('deleteTournament');
Route::get('/torneos/{id}/cedula', 'TournamentsController@cedula')->name('cedula');


Route::get('/torneos/{id}/comprobante', 'TournamentsController@voucher')->name('tournamentVoucher');


Route::get('/deportes', 'SportsController@index')->name('sportsIndex');
Route::put('/deportes/{sportName}', 'SportsController@update')->name('updateSport');
Route::delete('/deportes/{sportName}', 'SportsController@delete')->name('deleteSport');

Route::get('/cuenta', 'Auth\UpdateAccountController@show')->name('updateAccount');
Route::put('/cuenta', 'Auth\UpdateAccountController@update')->name('updateAccount');

Route::get('/historico', 'HistoricController@index')->name('historicIndex');
Route::get('/historico/{id}', 'HistoricController@show')->name('tournamentHistoric');