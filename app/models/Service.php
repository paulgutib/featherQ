<?php

class Service extends Eloquent {
	
	public $timestamps = false;
	
	public function location() {
		return $this->belongsTo('Location');
	}
	
	public function popularity() {
		return $this->belongsTo('Popularity');
	}
	
}