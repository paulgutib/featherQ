<?php

class ServiceController extends BaseController {
	
	public function __construct() {
		$this->beforeFilter('csrf', array('on'=>'post'));
	}
	
	public function postAdd() {
		$service_name = Input::get('service_name');
		$Service = new Service();
		$Service->addService($service_name);
		return Redirect::to('user/dashboard')
			->with('message', $service_name . ' has been added.');
	}
	
	public function postUpdate() {
		$service_id = Input::get('service_list');
		$service_name = Input::get('new_service_name');
		$Service = new Service();
		$Service->updateServiceName($service_name, $service_id);
		return Redirect::to('user/dashboard')
		->with('message', 'A service has been renamed to ' . $service_name . '.');
	}
	
	public function postDelete() {
		$service_ids = Input::get('service_delete');
		$Service = new Service();
		$delete_message = '';
		foreach ($service_ids as $key => $service_id) {
			$delete_message .= $Service->serviceName($service_id) . ' has been removed.';
			$Service->deleteService($service_id);
		}
		return Redirect::to('user/dashboard')
			->with('message', $delete_message);
	}
	
}