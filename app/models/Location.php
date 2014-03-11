<?php

class Location extends Eloquent {

	public $timestamps = false;

	public function services(){
		return $this->hasMany('Service');
	}

}