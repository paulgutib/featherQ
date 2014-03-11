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

Route::controller('user', 'UserController');

Route::get('user', function()
{
	if (Auth::check()) {
		$user_id = Auth::user()->user_id;
		return Redirect::to('/user/' . $user_id . '/dashboard');
	}
	else {
		return Redirect::to('user/login');
	}
});

Route::get('user/{user_id}', function($user_id)
{
	if (Auth::check()) {
		$user_id = Auth::user()->user_id;
		return Redirect::to('/user/' . $user_id . '/dashboard');
	}
	else {
		return Redirect::to('user/login');
	}
})->where('user_id', '[0-9]+');

Route::get('logout', function(){
	Auth::logout();
	return Redirect::to('user/login')
	->with('message', 'You are now logged out');
});