<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

Route::get('/', 'MoviesController@index')->name('movies.index');
Route::get('/movies/{movie}', 'MoviesController@show')->name('movies.show');

Route::get('/actors', 'ActorsController@index')->name('actors.index');
Route::get('/actors/page/{page?}', 'ActorsController@index');
Route::get('/actors/{actor}', 'ActorsController@show')->name('actors.show');

Route::get('/ch', function() {
    return $genres = Http::get('http://ws.lankabangla.com:8010/chatbotapis/loanbymobile.php?username=chatbot&password=716260ae41ae6bd27735384bf9ac619d&mobile=01710328545')
            ->json();
});
