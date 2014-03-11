<?php

class Popularity extends Eloquent {

	public $timestamps = false;

	public function services(){
		return $this->hasMany('Service');
	}

}
