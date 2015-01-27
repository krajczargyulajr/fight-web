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

Route::get('/', function()
{
	return View::make('hello');
});

// route to show the login form
Route::get('login', array('uses' => 'HomeController@showLogin'));

// route to process the form
Route::post('login', array('uses' => 'HomeController@doLogin'));

Route::get('first', array('uses' => 'HomeController@showFirst'));

Route::get('logout', array('uses' => 'HomeController@doLogout'));

// Admin
Route::get('admin', 'AdminController@home');

// Competitions
Route::get('competitions', 'CompetitionController@listCompetitions');
Route::get('competition/new', 'CompetitionController@newCompetition');
Route::post('competition/save', 'CompetitionController@saveCompetition');

Route::get('competition/{id}/delete', 'CompetitionController@deleteCompetition');
Route::get('competition/{id}/edit', 'CompetitionController@editCompetition');
Route::get('competition/{id}', 'CompetitionController@showCompetition');

// Competition events
Route::post('event/save', 'CompetitionEventController@saveEvent');
Route::get('event/new', 'CompetitionEventController@newEvent');
Route::get('event/{eventId}', 'CompetitionEventController@showEvent');
Route::get('event/{eventId}/edit', 'CompetitionEventController@editEvent');
Route::get('event/{eventId}/delete', 'CompetitionEventController@deleteCompetition');

Route::get('fields', 'CompetitionEventFieldController@listFields');
Route::get('field/new', 'CompetitionEventFieldController@newField');
Route::post('field/save', 'CompetitionEventFieldController@saveField');
Route::get('field/{id}', 'CompetitionEventFieldController@showField');
Route::get('field/{id}/edit', 'CompetitionEventFieldController@editField');
Route::get('field/{id}/delete', 'CompetitionEventFieldController@deleteField');

// Teams


// Delete
Route::post('delete', 'DeleteController@confirmDelete');
