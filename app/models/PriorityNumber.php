<?php

class PriorityNumber extends Eloquent {
	
	public $timestamps = false;
	
	public function priorityQueue(){
		return $this->belongsTo('PriorityQueue');
	}
	
	public function terminal(){
		return $this->belongsTo('Terminal');
	}
	
}