<?php

class DashboardController extends BaseController {
	
	protected $layout = 'dashboard-master-admin';
	
	public function __construct() {
		$this->beforeFilter('csrf', array('on'=>'post'));
	}
	
	public function getDashboard() {
		if (!Auth::check()) {
			return Redirect::to('/')
			->with('error' , 'You need to be logged in to view this page.');
		}
		else {
			if (Auth::user()->user_id != 1) {
				$this->layout->content = View::make('dashboard-user');
			}
			else {
				$this->layout->content = View::make('dashboard-master-admin');
			}
		}
		
		/*
		if (Auth::check()) {
		  $Service = new Service();
		  $Terminal = new Terminal();
			if (Auth::user()->user_id == 1) {
				$services_status = array();
		    $available_services = $Service->fetchServices();
				$terminal_type_list = $Terminal->fetchTerminalTypes();
				unset($terminal_type_list[0]);
				foreach ($available_services as $service_id => $service_name) {
					$services_status[$service_id] = $Service->status($service_id);
				}
				$this->layout->content = View::make('user.dashboard-master-admin');
					//->with('available_services', $available_services)
				  //->with('all_services', $Service->fetchServices())
				  //->with('services_status', $services_status)
				  //->with('terminal_type_list', $terminal_type_list)
				  //->with('all_terminal_types', $Terminal->fetchTerminalTypes());
			}
			else {
				$available_services = $Service->fetchAvailableServices();
				unset($available_services[0]);
				foreach ($available_services as $service_id => $service_name) {
					if ($Service->checkSignupStatus(Auth::user()->user_id, $service_id)) {
						$signup_type[$service_id] = 'Remove?';
					}
					else {
						$signup_type[$service_id] = 'Sign-Up!';
					}
				}
				$this->layout->content = View::make('user.dashboard-user')
					->with('signup_type', $signup_type)
					->with('available_services', $available_services);
			}
		}
		else {
			return Redirect::to('user/login')
				->with('error' , 'You need to be logged in to view this page.');
		}
		*/
		
	}
	
}