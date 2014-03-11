<?php

class Terminal extends Eloquent {
	
	public $timestamps = false;
	
	public function user() {
		return $this->belongsTo('User');
	}
	
	public function priorityNumbers() {
		return $this->hasMany('PriorityNumber');
	}
	
}