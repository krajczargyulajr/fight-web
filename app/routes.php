<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


Route::get('/', array('uses' => 'AuthController@showLogin'));
Route::post('login', array('uses' => 'AuthController@doLogin'));

Route::get('logout', array('uses' => 'AuthController@doLogout'));

Route::get('register', 'AuthController@showRegistration');
Route::post('register', 'AuthController@doRegistration');

// Registration

Route::get('registration', 'RegistrationController@show');
Route::post('registration', 'RegistrationController@update');

Route::group(["before" => "auth"], function() {

	// Admin
	Route::get('admin', 'AdminController@home');

	// Deletion
	Route::post('delete', 'DeleteController@confirmDelete');

});
