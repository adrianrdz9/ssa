<?php

Route::get('/', function () {
    return view('welcome');
});
Route::get("Admis/login","semiAdmi@login");
Route::get("Admis/Informacion","semiAdmi@Informacion");
Route::get('Visitante/Noticias', function () {
    return view('Visitante/Noticias');
});
