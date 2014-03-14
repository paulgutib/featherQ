<?php

class ServiceController extends BaseController {
	
	protected $layout = 'service.service';
	
	public function __construct() {
		$this->beforeFilter('csrf', array('on'=>'post'));
	}
	
	public function getList() {
		if (Auth::check()) {
			if (Auth::user()->user_id == 1) {
				$Service = new Service();
				$services_status = array();
				$available_services = $Service->fetchServices();
				unset($available_services[0]);
				if (isset($available_services)) {
					foreach ($available_services as $service_id => $service_name) {
						$services_status[$service_id] = $Service->status($service_id);
					}
				}
				$this->layout->content = View::make('service.service-list')
					->with('available_services', $available_services)
					->with('all_services', $Service->fetchServices())
					->with('services_status', $services_status);
			}
			else {
				return Redirect::to('user/dashboard')
					->with('error' , 'You need to be an admin to view this page.');
			}
		}
		else {
			return Redirect::to('user/login')
				->with('error' , 'You need to be logged in to view this page.');
		}
	}
	
	public function postAdd() {
		$service_name = Input::get('service_name');
		$Service = new Service();
		$Service->addService($service_name);
		return Redirect::to('service/list')
			->with('message', 'The service ' . $service_name . ' has been added.');
	}
	
	public function postEdit() {
		$service_id = Input::get('service_list');
		$service_name = Input::get('new_service_name');
		$Service = new Service();
		$Service->updateServiceName($service_name, $service_id);
		return Redirect::to('service/list')
		->with('message', 'A service has been renamed to ' . $service_name . '.');
	}
	
	public function postUpdatedelete() {
		$for_deletion = Input::get('service_delete');
		$Service = new Service();
		$delete_message = '';
		$service_ids = $Service->fetchServices();
		foreach ($service_ids as $service_id => $service_name) {
			$count = 0;
						
			// update the status of the service (active/inactive)
			$status = Input::get('service_status_' . $service_id);
			$Service->updateStatus($status, $service_id);
			
			while ($count < count($for_deletion)) {
				if ($service_id == $for_deletion[$count]) {
					$delete_message .= 'Service ' . $service_name . ' has been removed.<br/>';
					$Service->deleteService($service_id);
				}
				$count++;
			}
		}
		return Redirect::to('service/list')
			->with('message', $delete_message . '<br>The changes have been saved.');
	}
	
	public function postSignupRemove() {
		
	}
	
}