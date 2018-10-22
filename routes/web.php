<?php

//login
Route::get('/login','Auth\LoginController@showLoginForm' );
Route::post('login','Auth\LoginController@login')->name('login');
//Administrador
Route::get('Admi','Admis\admiController@index')->name('Admi');
//semiAdmis
Route::get('semiAdmi','Admis\semiAdmiController@index')->name('semiAdmi');

//logout
Route::post('logout','Auth\LoginController@logout')->name('logout');

//Noticias
//Admi
Route::resource('Admi','Admis\admiController');
//visitante
Route::get('/','Visitante\generalController@index');

//Agrupaciones
//Todas visitante
Route::get('/Agrupaciones','Visitante\generalController@Agrupaciones');
// Integrantes Actualizar
//Informacion Actualizar
