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
	if (!Auth::check()) {
		return View::make('page-front')
		->with('error' , 'You need to be logged in to view this page.');
	}
	else {
		if (Auth::user()->user_id != 1) {
			return View::make('dashboard-user');
		}
		else {
			return View::make('dashboard-master-admin');
		}
	}
});

Route::controller('user', 'UserController');

Route::get('user/service/{service_id}', function() {
	return View::make('service.service-signup-remove');
});

Route::controller('service', 'ServiceController');

Route::controller('terminal', 'TerminalController');
