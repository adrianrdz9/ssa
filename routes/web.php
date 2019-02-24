<?php

Route::get('/', function(){
    return view('home');
});

Auth::routes();

Route::group(['prefix' => 'agrupaciones'], function () {
    //Administrador
    Route::any('/Admi','Admis\admiController@index')->name('Admi');
    //semiAdmis
    Route::any('/semiAdmi','Admis\semiAdmiController@index')->name('semiAdmi');

    //logout
    Route::post('/logout','Auth\LoginController@logout')->name('logout');

    //Administrador
    //Noticias - Admi
    Route::get('/ANoticias','Admis\admiController@Noticias')->name('ANoticias');
    Route::post('/AdmiP','Admis\admiController@store')->name('AdmiP');
    Route::get('/oNoticia/id/{id}','Admis\admiController@ONoticia');
    Route::get('/mNoticia/id/{id}','Admis\admiController@MNoticia');
    //Carusel
    Route::get('/Admi/Carusel','Admis\admiController@VerCarusel');
    Route::get('/Admi/NICarusel','Admis\admiController@Carusel');
    Route::post('/NCarusel','Admis\admiController@NCarusel')->name('NCarusel');
    Route::get('/OImagenC/id/{id}','Admis\admiController@OImagenC');
    Route::get('/MImagenC/id/{id}','Admis\admiController@MImagenC');
    //Ver propuestas
    Route::get('Admi/Propuestas','Admis\admiController@Propuestas');
    Route::post('/NFeria','Admis\admiController@Feria')->name('NFeria');
    //Status propuestas
    Route::get('/statusA/id/{id}','Admis\admiController@StatusA');
    Route::get('/statusC/id/{id}','Admis\admiController@StatusC');
    //contraseñas
    Route::get('/Admi/Contraseñas','Admis\admiController@Agrupaciones');
    Route::post('/NPassword','Admis\admiController@NPassword')->name('NPassword');
    //semiAdmi
    //Información general
    Route::post('/InfoGeneral','Admis\semiAdmiController@InfoGeneral')->name('InfoGeneral');
    //Integrantes
    Route::post('/Integrantes','Admis\semiAdmiController@Integrantes')->name('Integrantes');
    //status propuesta
    Route::get('/semiAdmi/Propuesta','Admis\semiAdmiController@Propuesta')->name('PropuestaSemi');
    //Nueva propuesta
    Route::post('/NPropuesta','Admis\semiAdmiController@NPropuesta');
    //Cambio de Mesa
    Route::get('/semiAdmi/CambioMesa','Admis\semiAdmiController@Mesa');
    //Visitante
    //Noticias - 9 (index)
    Route::get('/','Visitante\generalController@index')->name('agrupacionesIndex');
    //Noticias individual
    Route::get('Noticia/id/{id}','Visitante\generalController@noticia');
    Route::get('/Historial','Visitante\generalController@Historial');
    //Agrupaciones lista
    Route::get('/Agrupaciones','Visitante\generalController@agrupaciones');
    //Agrupaciones individual
    Route::get('/Agrupacion/id/{id}','Visitante\generalController@individual');
    //Reclutammientos
    Route::get('/Reclutamientos','Visitante\generalController@Reclutamientos');
    //semiAdmi
    Route::get('/semiAdmi/Reclutamientos','Admis\semiAdmiController@ReclutamientosF');
    Route::post('reclutamientoF','Admis\semiAdmiController@NReclutamiento')->name('reclutamientoF');
    Route::get('/semiAdmi/VerReclutamientos','Admis\semiAdmiController@VerReclutamientos');
    Route::get('Reclutamiento/id/{id}','Visitante\generalController@Reclutamiento');

});

Route::group(['prefix' => 'actividades-deportivas'], function () {


    Route::get('/', 'HomeController@index')->name('actividadesDeportivasIndex');


    Route::post('/admin/slides', 'SlidesController@store')->name('storeSlide');
    Route::put('/admin/slides/{id}', 'SlidesController@update');
    Route::delete('/admin/slides/{id}', 'SlidesController@delete');


    Route::get('/admin/events', 'EventsController@index')->name('events');
    Route::post('/admin/events', 'EventsController@store')->name('storeEvent');
    Route::put('/admin/events/{id}', 'EventsController@update');
    Route::delete('/admin/events/{id}', 'EventsController@delete');

    Route::post('/admin/notices', 'NoticesController@store')->name('storeNotice');
    Route::put('/admin/notices/{id}', 'NoticesController@update');
    Route::delete('/admin/notices/{id}', 'NoticesController@delete');

    Route::post('/admin/sports', 'SportsController@store');
    Route::post('/admin/requirements', 'TournamentsController@requirementCreate');

    Route::get('/cedula', 'HistoricController@cedula')->name('cedulaIndex');

    Route::group(['prefix' => '/torneos'], function () {
        Route::get('/', 'TournamentsController@index')->name('tournamentsIndex');
        Route::get('/nuevo', 'TournamentsController@new')->name('newTournament');
        Route::post('/nuevo', 'TournamentsController@store')->name('newTournament');


        Route::put('/{id}', 'TournamentsController@update')->name('updateTournament');
        Route::get('/{id}/editar', 'TournamentsController@edit')->name('editTournament');
        Route::get('/{id}/cedula', 'TournamentsController@cedula')->name('tournamentCedula');

        Route::get('/ramas/{id}/cedula', 'TournamentsController@branchCedula')->name('branchCedula');

        Route::get('/completar', 'TeamsController@complete')->name('completeSignup');
        Route::get('/completar/{id}', 'TeamsController@teamDetails');
        Route::post('/completar/{id}', 'TeamsController@markComplete');

        Route::get('/{id}', 'TournamentsController@show')->name('signUpTournament');
        Route::get('/{id}/equipo', 'TournamentsController@team')->name('teamSelect');
        Route::get('/{id}/voucher')->name('tournamentVoucher');

    });

    Route::post('/teams', 'TeamsController@store');
    Route::post('/teams/{id}', 'TeamsController@request');

    //! Remplazar totalmente por responsiva individual
    Route::get('/equipos/{id}/cedula', 'TeamsController@cedula')->name('teamCedula');

    //? Remplazo implementandose
    Route::get('/responsiva/{userInTeamId}', 'TeamsController@responsive')->name('responsive');

    Route::get('/mis_equipos', 'TeamsController@index')->name('teamsIndex');
    Route::put('/mis_equipos/{id}', 'TeamsController@update')->name('updateUserTeam');
    Route::post('/mis_equipos/{id}/close', 'TeamsController@close')->name('closeTeam');
    Route::get('/mis_equipos/{id}/comprobante', 'TeamsController@voucher')->name('getVoucher');


    Route::get('/deportes', 'SportsController@index')->name('sportsIndex');
    Route::get('/deportes/{id}/cedula', 'SportsController@cedula')->name('sportCedula');

    Route::put('/deportes/{sportName}', 'SportsController@update')->name('updateSport');
    Route::delete('/deportes/{sportName}', 'SportsController@delete')->name('deleteSport');

    Route::get('/cuenta', 'Auth\UpdateAccountController@show')->name('updateAccount');
    Route::put('/cuenta', 'Auth\UpdateAccountController@update')->name('updateAccount');

    Route::get('/historico', 'HistoricController@index')->name('historicIndex');
    Route::get('/historico/{id}', 'HistoricController@show')->name('tournamentHistoric');

    Route::get('/admin/responsiva', 'TournamentsController@getResponsive')->name('getResponsive');
    Route::post('/admin/getResponsive', 'TournamentsController@findResponsive');
});

Route::group(['prefix' => 'bolsa'], function () {
    Route::get('/', function(){

    })->name('bolsaIndex');
});
