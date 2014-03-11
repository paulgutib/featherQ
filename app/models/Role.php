<?php

class Role extends Eloquent {

	public $timestamps = false;

	public function permissions() {
		return $this->hasMany('Permission');
	}

	public function users() {
		return $this->hasMany('User');
	}

}