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

//Administrador / semiAdmi
//Noticias - Admi
Route::post('Admi','Admis\admiController@index');
//Ver propuestas
Route::get('Admi/Propuestas','Admis\admiController@Propuestas');

//Información general
Route::post('InfoGeneral','Admis\semiAdmiController@InfoGeneral');
//Integrantes
Route::post('Integrantes','Admis\semiAdmiController@Integrantes');
//status propuesta
Route::get('semiAdmi/Propuesta','Admis\semiAdmiController@Propuestas');

//Visitante
//Noticias - 9 (index)
Route::get('/','Visitante\generalController@index');
//Noticias individual
Route::get('Noticia/id/{id}','Visitante\generalController@noticia');
//Agrupaciones lista
Route::get('/Agrupaciones','Visitante\generalController@agrupaciones');
//Agrupaciones individual
Route::get('Agrupacion/id/{id}','Visitante\generalController@individual');
