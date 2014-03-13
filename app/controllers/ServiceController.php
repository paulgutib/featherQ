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
			->with('message', 'The service ' . $service_name . ' has been added.');
	}
	
	public function postUpdate() {
		$service_id = Input::get('service_list');
		$service_name = Input::get('new_service_name');
		$Service = new Service();
		$Service->updateServiceName($service_name, $service_id);
		return Redirect::to('user/dashboard')
		->with('message', 'A service has been renamed to ' . $service_name . '.');
	}
	
	public function postUpdatedelete() {
		$for_deletion = Input::get('service_delete');
		$Service = new Service();
		$delete_message = '';
		$update_message = '';
		$service_ids = $Service->fetchServices();
		foreach ($service_ids as $service_id => $service_name) {
			$count = 0;
						
			// update the status of the service (active/inactive)
			$status = Input::get('service_status_' . $service_id);
			$Service->updateStatus($status, $service_id);
			$update_message .= 'The status of '. $service_name . ' has been updated.<br/>';
			
			while ($count < count($for_deletion)) {
				if ($service_id == $for_deletion[$count]) {
					$delete_message .= 'Service ' . $service_name . ' has been removed.<br/>';
					$Service->deleteService($service_id);
				}
				$count++;
			}
		}
		return Redirect::to('user/dashboard')
			->with('message', $delete_message);
	}
	
}