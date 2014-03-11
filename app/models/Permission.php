<?php

class Permission extends Eloquent {

	public $timestamps = false;

	public function role(){
		return $this->belongsTo('Role');
	}

}
