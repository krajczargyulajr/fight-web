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


// route to show the login form
Route::get('login', array('uses' => 'AuthController@showLogin'));

// route to process the form
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

	/*
	// Competition events
	Route::post('event/save', 'CompetitionEventController@saveEvent');
	Route::get('event/new', 'CompetitionEventController@newEvent');
	Route::get('event/{eventId}', 'CompetitionEventController@showEvent');
	Route::get('event/{eventId}/edit', 'CompetitionEventController@editEvent');
	Route::get('event/{eventId}/delete', 'CompetitionEventController@deleteCompetition');

	// Teams
	Route::get('teams', 'TeamController@listTeams');
	Route::post('team/save', 'TeamController@saveTeam');
	Route::get('team/new', 'TeamController@newTeam');
	Route::get('team/{teamId}', 'TeamController@showTeam');
	Route::get('team/{teamId}/edit', 'TeamController@editTeam');
	Route::get('team/{teamId}/delete', 'TeamController@deleteTeam');

	// People
	Route::post('person/save', 'PersonController@savePerson');
	Route::get('person/new', 'PersonController@newPerson');
	Route::get('person/{personId}', 'PersonController@showPerson');
	Route::get('person/{personId}/edit', 'PersonController@editPerson');
	Route::get('person/{personId}/delete', 'PersonController@deletePerson');
	*/

	// Delete
	Route::post('delete', 'DeleteController@confirmDelete');

});
