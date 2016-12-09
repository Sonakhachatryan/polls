<?php


Route::get('home/home','HomeController@index');
Route::get('home/{id}/{name}','HomeController@index');
Route::get('index','HomeController@index');