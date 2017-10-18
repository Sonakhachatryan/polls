<?php
use Core\Route;

Route::get('/','HomeController@index');
Route::get('login','AuthController@loginView');
Route::get('register','AuthController@registerView');
Route::post('register','AuthController@register');



throw new Exception('Route not found.',404);