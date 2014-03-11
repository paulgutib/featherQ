<?php

class UserController extends BaseController {
	
	protected $layout = 'user.user';
	
	public function getRegister() {
		$this->layout->content = View::make('user.user-register');
	}
	
	public function getLogin() {
		$this->layout->content = View::make('user.user-login');
	}
	
	public function getPassword() {
		$this->layout->content = View::make('user.user-password');
	}
	
	public function postCreate() {
		$validator = Validator::make(Input::all(), User::$rules);
		if ($validator->passes()) {
	    $user = new User;
	    $user->setUsername(Input::get('username'));
	    $user->setPhone(Input::get('phone'));
	    $user->setEmail(Input::get('email'));
	    $user->setPassword(Hash::make(Input::get('password')));
	    $user->register();
	    return Redirect::to('user/login')->with('message', 'Thanks for registering!');
		} else {
		  return Redirect::to('user/register')->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
		}
	}
	
}