<?php

class UserController extends BaseController {
	
	protected $layout = 'user.user';
	
	public function __construct() {
		$this->beforeFilter('csrf', array('on'=>'post'));
	}
	
	public function getRegister() {
		if (Auth::check()) {
			return Redirect::to('user/dashboard');
		}
		else {
			$this->layout->content = View::make('user.user-register');
		}
	}
	
	public function getPassword() {
		if (Auth::check()) {
			return Redirect::to('user/dashboard');
		}
		else {
			$this->layout->content = View::make('user.user-password');
		}
	}
	
	public function getLogin() {
		if (Auth::check()) {
			return Redirect::to('user/dashboard');
		}
		else {
			$this->layout->content = View::make('user.user-login');
		}
	}
	
	public function postCreate() {
		$validator = Validator::make(Input::all(), User::$rules);
		if ($validator->passes()) {
	    $user = new User;
	    $user->username = Input::get('username');
	    $user->phone = Input::get('phone');
	    $user->email = Input::get('email');
	    $user->password = Hash::make(Input::get('password'));
	    $user->save();
	    return Redirect::to('user/login')->with('message', 'Thanks for registering!');
		} else {
		  return Redirect::to('user/register')->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
		}
	}
	
	public function postSignin() {
		if (Auth::attempt(array('username' => Input::get('username'), 'password' => Input::get('password')))) {
			return Redirect::to('user/dashboard');
		}
		else {
			return Redirect::to('user/login')
				->withInput()
				->with('error', 'You entered a wrong username and password combination.');
		}
	}
	
	public function getLogout() {
		Auth::logout();
		return Redirect::to('user/login')
			->with('message', 'You are now logged out');
	}
	
	public function getDashboard() {
		if (Auth::check()) {
		  $Service = new Service();
		  $Terminal = new Terminal();
			if (Auth::user()->user_id == 1) {
				$services_status = array();
				$available_services = $Service->fetchServices();
				$terminal_type_list = $Terminal->fetchTerminalTypes();
				unset($available_services[0]);
				unset($terminal_type_list[0]);
				foreach ($available_services as $service_id => $service_name) {
					$services_status[$service_id] = $Service->status($service_id);
				}
				$this->layout->content = View::make('user.dashboard-master-admin')
					->with('available_services', $available_services)
				  ->with('all_services', $Service->fetchServices())
				  ->with('services_status', $services_status)
				  ->with('terminal_type_list', $terminal_type_list)
				  ->with('all_terminal_types', $Terminal->fetchTerminalTypes());
			}
			else {
				$this->layout->content = View::make('user.dashboard-user');
			}
		}
		else {
			return Redirect::to('user/login')
				->with('error' , 'You need to be logged in to view this page.');
		}
	}
	
}