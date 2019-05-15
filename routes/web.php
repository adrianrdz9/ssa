<?php

Route::get('/', 'Visitante\generalController@vistas');

Route::group(['prefix' => 's'], function () {
    Route::get('/', 'SuperAdminController@index');

    Route::post('/u', 'SuperAdminController@changeRole');
    Route::post('/c', 'SuperAdminController@createRol');
    Route::post('/cu', 'SuperAdminController@storeUser');
    Route::get('/cu', 'SuperAdminController@createUser');
    Route::get('/cl', 'SuperAdminController@changelog');
    Route::get('/ap','SuperAdminController@indexPassword');
    Route::patch('/uap/{id}','SuperAdminController@updatePassword')->name('updatePasswordA');
});

Auth::routes();
Route::group(['prefix' => 'comunidad'], function () {
    /*
    *   ADMINISTRADOR DE COMUNIDAD (admiComunidad/ASSA)
    */
    /*
    *   Evntos para la página principal
    */
    Route::get('/Event/create','Admis\EventosComunidadController@create')->name('createEventC');
    Route::post('/newEvent','Admis\EventosComunidadController@store')->name('storeEventC');
    Route::get('/','Admis\EventosComunidadController@index')->name('indexComunidad');
    Route::get('/{id}/editEventC','Admis\EventosComunidadController@edit')->name('editEventC');
    Route::patch('/{id}/updateEventC','Admis\EventosComunidadController@update')->name('updateEventC');
    Route::get('/delete/{id}','Admis\EventosComunidadController@destroy')->name('deleteEventF');
    /*
    *   NOTICIAS de agrupaciones (bolsa de trabajo y actividades deportivas)
    */
    /*
    * Noticas de agrupaciones
    */
    Route::get('/NoticiasAgrupaciones','Admis\NoticiasComunidadController@noticiasAgrupaciones');
    Route::get('/Agregar/id/{id}','Admis\NoticiasComunidadController@agregarNoticiaAgrupa');
    Route::get('/Eliminar/id/{id}','Admis\NoticiasComunidadController@eliminarNoticiaAgrupa');
    /*
    * Noticas de actividades deportivas
    */
    /*
    * Noticas de bolsa de trabajo
    */
});

Route::group(['prefix' => 'agrupaciones'], function () {
    /*
    *               ADMINISTRADOR (SSA)
    */
    /*
    *   NOTICIAS
    */
    Route::get('/Admi/ANoticias','Admis\NoticiasSSAController@index')->name('indexNew');
    Route::get('/Admi','Admis\NoticiasSSAController@create')->name('create');
    Route::post('/AdmiP','Admis\NoticiasSSAController@store')->name('storeNew');
    Route::get('/oNoticia/id/{id}','Admis\NoticiasSSAController@ONoticia');
    Route::get('/mNoticia/id/{id}','Admis\NoticiasSSAController@MNoticia');
    Route::get('/DNoticia/id/{id}','Admis\NoticiasSSAController@destroy')->name('destroyNew');
    Route::get('/{id}/edit','Admis\NoticiasSSAController@edit')->name('editNew');
    Route::patch('/{id}','Admis\NoticiasSSAController@update')->name('updateNew');
    /*
    *   CARRUSEL
    */
    Route::get('/Admi/Carusel','Admis\CarruselSSAController@index')->name('indexCarrusel');
    Route::get('/Admi/NICarusel','Admis\CarruselSSAController@create');
    Route::post('/NCarusel','Admis\CarruselSSAController@store')->name('storeCarrusel');
    Route::get('/OImagenC/id/{id}','Admis\CarruselSSAController@OImagenC');
    Route::get('/MImagenC/id/{id}','Admis\CarruselSSAController@MImagenC');
    Route::get('/DImagenC/id/{id}','Admis\CarruselSSAController@destroy')->name('destroyCarrusel');
    Route::get('/edit/{id}','Admis\CarruselSSAController@edit')->name('Carruseledit');
    Route::patch('/update/{id}','Admis\CarruselSSAController@update')->name('updateCarrusel');
    /*
    *   PROPUESTAS PARA LA FERIA DE AGRUPACIONES
    */
    //Ver propuestas
    Route::get('/Admi/Propuestas','Admis\admiController@Propuestas');
    Route::post('/NFeria','Admis\admiController@Feria')->name('NFeria');
    //Status propuestas
    Route::get('/statusA/id/{id}','Admis\admiController@StatusA');
    Route::get('/statusC/id/{id}','Admis\admiController@StatusC');
    /*
    *   MENSAJES
    */
    Route::get('/Admi/AdmiMsj','Admis\MensajesControlller@verMensajes');
    Route::get('/semiAdmi/semiAdmiMsj','Admis\MensajesControlller@verMensajes');
    Route::get('/Admi/AdmiMsj/contacts','Admis\MensajesControlller@get');
    Route::get('/Admi/AdmiMsj/conversation/{id}','Admis\MensajesControlller@getMessagesFor');
    Route::post('/Admi/AdmiMsj/conversation/send','Admis\MensajesControlller@send');
    /*
    *   EVENTOS PARA LA FERIA
    */
    Route::get('/Admi/EventosFeria','Admis\FeriasController@index')->name('indexEvents');
    Route::post('/NEvento','Admis\FeriasController@store')->name('storeEventF');
    Route::get('/DEvento/id/{id}','Admis\FeriasController@destroy')->name('destroyEvent');
    Route::get('/{id}/editE','Admis\FeriasController@edit')->name('editEvent');
    Route::patch('/{id}/updateE','Admis\FeriasController@update')->name('updateEvent');;

    /*
    *               AGRUPACIONES
    */
    //Información general
    Route::get('/semiAdmi','Admis\semiAdmiController@index')->name('semiAdmi');
    Route::post('/InfoGeneral','Admis\semiAdmiController@InfoGeneral')->name('InfoGeneral');
    //Integrantes
    Route::post('/Integrantes','Admis\semiAdmiController@Integrantes')->name('Integrantes');
    //status propuesta
    Route::get('/semiAdmi/Propuesta','Admis\semiAdmiController@Propuesta')->name('PropuestaSemi');
    //Nueva propuesta
    Route::post('/NPropuesta','Admis\semiAdmiController@NPropuesta')->name('NPropuesta');
    //Cambio de Mesa
    Route::get('/semiAdmi/CambioMesa','Admis\semiAdmiController@Mesa');
    /*
    *   RECLUTAMIENTOS
    */
    Route::get('/semiAdmi/Reclutamientos','Admis\semiAdmiController@ReclutamientosF');
    Route::post('/reclutamientoF','Admis\semiAdmiController@NReclutamiento')->name('reclutamientoF');
    Route::get('/semiAdmi/VerReclutamientos','Admis\semiAdmiController@VerReclutamientos');
    Route::get('/Reclutamiento/id/{id}','Visitante\generalController@Reclutamiento');


    /*
    *   VISITANTES (publico en general)
    */
    //Noticias - 9 (index)
    Route::get('/','Visitante\generalController@index')->name('agrupacionesIndex');
    //Noticias individual
    Route::get('/Noticia/id/{id}','Visitante\generalController@noticia');
    //Agrupaciones lista
    Route::get('/Agrupaciones','Visitante\generalController@agrupaciones');
    //Agrupaciones individual
    Route::get('/Agrupacion/id/{id}','Visitante\generalController@individual');
    //Reclutammientos
    Route::get('/Reclutamientos','Visitante\generalController@Reclutamientos');
    //Feria de agrupaciones
    Route::get('/Feria','Visitante\generalController@Feria')->name('Feria');

});

Route::group(['prefix' => 'actividades-deportivas'], function () {




    Route::get('/', 'HomeController@index')->name('actividadesDeportivasIndex');


    Route::post('/admin/slides', 'SlidesController@store')->name('storeSlide');
    Route::put('/admin/slides/{id}', 'SlidesController@update');
    Route::delete('/admin/slides/{id}', 'SlidesController@delete');

    Route::get('/admin/teams', 'TeamsController@index')->name('teamsAdminIndex');
    Route::post('/admin/teams', 'TeamsController@store');
    Route::get('/admin/teams/create', 'TeamsController@create')->name('teamsAdminCreate');


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
        Route::get('/semestres', 'TournamentsController@semester')->name('tournamentsSemester');
        Route::get('/nuevo', 'TournamentsController@new')->name('newTournament');
        Route::post('/nuevo', 'TournamentsController@store')->name('newTournament');

        Route::get('/rapido', 'TournamentsController@quickTournament')->name('quickTournament');
        Route::get('/rapido/{id}', 'TournamentsController@quickShow')->name('quickShow');
        Route::post('/rapido/{id}', 'TournamentsController@quickSignUp')->name('quickSignUp');

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

    Route::get('/carnet-imss/{userInTeamId}', 'TeamsController@carnet')->name('carnetIMSS');
    Route::get('/credencial/{userInTeamId}', 'TeamsController@credencial')->name('credencial');

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
