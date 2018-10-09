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