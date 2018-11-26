<?php

//login
Route::get('/login','Auth\LoginController@showLoginForm' );
Route::post('login','Auth\LoginController@login')->name('login');
//Administrador
Route::any('Admi','Admis\admiController@index')->name('Admi');
//semiAdmis
Route::any('semiAdmi','Admis\semiAdmiController@index')->name('semiAdmi');

//logout
Route::post('logout','Auth\LoginController@logout')->name('logout');

//Administrador
//Noticias - Admi
Route::post('AdmiP','Admis\admiController@store')->name('AdmiP');
//Ver propuestas
Route::get('Admi/Propuestas','Admis\admiController@Propuestas');
//Status propuestas
Route::get('/statusA/id/{id}','Admis\admiController@StatusA');
Route::get('/statusC/id/{id}','Admis\admiController@StatusC');
//contraseñas
Route::get('Admi/Contraseñas','Admis\admiController@Agrupaciones');
//semiAdmi
//Información general
Route::post('InfoGeneral','Admis\semiAdmiController@InfoGeneral');
//Integrantes
Route::post('Integrantes','Admis\semiAdmiController@Integrantes');
//status propuesta
Route::get('semiAdmi/Propuesta','Admis\semiAdmiController@Propuesta')->name('PropuestaSemi');
//Nueva propuesta
Route::post('NPropuesta','Admis\semiAdmiController@NPropuesta');

//Visitante
//Noticias - 9 (index)
Route::get('/','Visitante\generalController@index');
//Noticias individual
Route::get('Noticia/id/{id}','Visitante\generalController@noticia');
//Agrupaciones lista
Route::get('/Agrupaciones','Visitante\generalController@agrupaciones');
//Agrupaciones individual
Route::get('Agrupacion/id/{id}','Visitante\generalController@individual');
