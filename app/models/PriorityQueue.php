<?php

class PriorityQueue extends Eloquent {
	
	public $timestamps = false;
	
	public function priorityNumbers() {
		return $this->hasMany('PriorityNumber');
	}
	
	public function services() {
		return $this->hasMany('Service');
	}
	
	public function terminals() {
		return $this->hasMany('Terminal');
	}
	
	public function users() {
		return $this->hasMany('User');
	}
	
	public function notificationPlatform() {
		return $this->hasMany('NotificationPlatform');
	}
	
}