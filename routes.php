<?php
use Core\Route;

Route::get('/','HomeController@index');
Route::get('banner','HomeController@banner');
Route::post('vote','HomeController@vote');

//user url start
Route::get('login','AuthController@loginView');
Route::get('register','AuthController@registerView');
Route::post('register','AuthController@register');
Route::post('login','AuthController@login');
Route::get('logout','AuthController@logout');
Route::get('activate','AuthController@activate');

Route::get('dashboard','PollController@index');
Route::get('poll/create','PollController@showCreateForm');
Route::post('poll/create','PollController@createPoll');
Route::get('poll/view','PollController@view');
Route::get('poll/edit','PollController@edit');
Route::get('poll/delete','PollController@delete');
Route::get('answer/remove','PollController@removeAnswer');
Route::post('poll/update','PollController@update');


/**
 * admin url start
 */
Route::get('admin/login','Admin\AuthController@loginView');
Route::post('admin/login','Admin\AuthController@login');
Route::get('admin/logout','Admin\AuthController@logout');

Route::get('admin','Admin\PollController@index');
Route::get('admin/dashboard','Admin\PollController@index');
Route::get('admin/poll/view','Admin\PollController@view');
Route::get('admin/poll/edit','Admin\PollController@edit');
Route::get('admin/poll/delete','Admin\PollController@delete');
Route::get('admin/answer/remove','Admin\PollController@removeAnswer');
Route::post('admin/poll/update','Admin\PollController@update');



throw new Exception('Route not found.',404);