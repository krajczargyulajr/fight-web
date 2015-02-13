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


Route::get('login', array('uses' => 'AuthController@showLogin'));
Route::post('login', array('uses' => 'AuthController@doLogin'));

Route::get('logout', array('uses' => 'AuthController@doLogout'));

Route::group(["before" => "auth"], function() {

	Route::get('/', function()
	{
		return Redirect::action('RegistrationController@show');
	});

	// Admin
	Route::get('admin', 'AdminController@home');

	// Registration

	Route::get('registration', 'RegistrationController@show');
	Route::post('registration/save', 'RegistrationController@update');

	// Deletion
	Route::post('delete', 'DeleteController@confirmDelete');

});
