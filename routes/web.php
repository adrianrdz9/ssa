<?php

//login
Route::get('/Agrupa','Auth\LoginController@showLoginForm' );
Route::post('Agrupa','Auth\LoginController@login')->name('Agrupa');
//Administrador
Route::any('Admi','Admis\admiController@index')->name('Admi');
//semiAdmis
Route::any('semiAdmi','Admis\semiAdmiController@index')->name('semiAdmi');

//logout
Route::post('logout','Auth\LoginController@logout')->name('logout');

//Administrador
//Noticias - Admi
Route::get('ANoticias','Admis\admiController@Noticias')->name('ANoticias');
Route::post('AdmiP','Admis\admiController@store')->name('AdmiP');
Route::get('/oNoticia/id/{id}','Admis\admiController@ONoticia');
Route::get('/mNoticia/id/{id}','Admis\admiController@MNoticia');
//Carusel
Route::get('Admi/Carusel','Admis\admiController@Carusel');
Route::post('NCarusel','Admis\admiController@NCarusel');
//Ver propuestas
Route::get('Admi/Propuestas','Admis\admiController@Propuestas');
Route::post('NFeria','Admis\admiController@Feria');
//Status propuestas
Route::get('/statusA/id/{id}','Admis\admiController@StatusA');
Route::get('/statusC/id/{id}','Admis\admiController@StatusC');
//contraseñas
Route::get('Admi/Contraseñas','Admis\admiController@Agrupaciones');
Route::post('NPassword','Admis\admiController@NPassword');
//semiAdmi
//Información general
Route::post('InfoGeneral','Admis\semiAdmiController@InfoGeneral');
//Integrantes
Route::post('Integrantes','Admis\semiAdmiController@Integrantes');
//status propuesta
Route::get('semiAdmi/Propuesta','Admis\semiAdmiController@Propuesta')->name('PropuestaSemi');
//Nueva propuesta
Route::post('NPropuesta','Admis\semiAdmiController@NPropuesta');
//Cambio de Mesa
Route::view('/semiAdmi/CambioMesa','Admis.cambioMesa');
//Visitante
//Noticias - 9 (index)
Route::get('/','Visitante\generalController@index');
//Noticias individual
Route::get('Noticia/id/{id}','Visitante\generalController@noticia');
Route::get('/Historial','Visitante\generalController@Historial');
//Agrupaciones lista
Route::get('/Agrupaciones','Visitante\generalController@agrupaciones');
//Agrupaciones individual
Route::get('Agrupacion/id/{id}','Visitante\generalController@individual');
