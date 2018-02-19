<?php

Auth::routes();

Route::get('series/', 'SeriesController@index')->name('home');
Route::get('series/{slug}', 'SeriesController@show');
//Route::get('/series/{slug}', 'SeriesController@show');