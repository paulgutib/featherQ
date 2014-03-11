<?php

class NotificationPlatform extends Eloquent {

	public $timestamps = false;

	public function priorityQueues(){
		return $this->hasMany('PriorityQueue');
	}

}