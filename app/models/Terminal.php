<?php

class Terminal extends Eloquent {
	
	public $timestamps = false;
	
	public function user() {
		return $this->belongsTo('User');
	}
	
	public function priorityNumbers() {
		return $this->hasMany('PriorityNumber');
	}
	
	public function status($terminal_id) {
		$sql = 'SELECT status FROM terminal_list WHERE terminal_id=?';
		return DB::selectOne($sql, array($terminal_id))->status;
	}
	
	public function setTerminalName($terminal_name, $terminal_id = NULL) {
		$sql = 'UPDATE terminal_list SET name=? WHERE terminal_id=?';
		DB::update($sql, array($terminal_name, $terminal_id));
	}
	
	public function setStatus($status, $terminal_id) {
		$sql = 'UPDATE terminal_list SET status=? WHERE terminal_id=?';
		DB::update($sql, array($status, $terminal_id));
	}
	
	public function getTerminalType($type_id) {
		$sql = 'SELECT name FROM terminal_type WHERE type_id=?';
		return DB::selectOne($sql, array($type_id))->name;
	}
	
	public function getTerminalTypeByTerminalId($terminal_id) {
		$sql = 'SELECT type FROM terminal_list WHERE terminal_id=?';
		return DB::selectOne($sql, array($terminal_id))->type;
	}
	
	public function updateTerminalTypeName($type_name, $type_id) {
		$sql = 'UPDATE terminal_type SET name=? WHERE type_id=?';
		DB::update($sql, array($type_name, $type_id));
	}
	
	public function deleteTerminalType($type_id) {
		$sql = 'DELETE FROM terminal_type WHERE type_id=?';
		DB::delete($sql, array($type_id));
		
		// what happens to the terminals with no terminal type?
		// will they get deleted too?
	}
	
	public function deleteTerminal($terminal_id) {
		$sql = 'DELETE FROM terminal_list WHERE terminal_id=?';
		DB::delete($sql, array($terminal_id));
	}
	
	public function fetchTerminalTypes() {
		$terminals = array();
		$terminals[0] = '-Select a Terminal Type-';
		$sql = 'SELECT * FROM terminal_type';
		$res = DB::select($sql);
		foreach ($res as $key => $value) {
			$terminals[$value->type_id] = $value->name;
		}
		return $terminals;
	}
	
	public function fetchTerminalNodes() {
		$terminals = array();
		$terminals[0] = '-Select a Terminal Node-';
		$sql = 'SELECT * FROM terminal_list';
		$res = DB::select($sql);
		foreach ($res as $key => $value) {
			$terminals[$value->terminal_id] = $value->name;
		}
		return $terminals;
	}
	
	public function openCloseTerminal($status, $terminal_id) {
		$sql = 'UPDATE terminal_list SET status=? WHERE terminal_id=?';
		DB::update($sql, array($status, $terminal_id));
	}
	
	public function addTerminalType($terminal_type) {
		$sql = 'INSERT INTO terminal_type (name) VALUES (?)';
		DB::insert($sql, array($terminal_type));
	}
	
	public function addTerminalNode($terminal_name, $type_id) {
		$sql = 'INSERT INTO terminal_list (name, type) VALUES (?, ?)';
		DB::insert($sql, array($terminal_name, $type_id));
	}
	
	// hook to terminal
	public function hookToTerminal($terminal_id, $user_id, $in_out) {
		$open = $this->checkTerminalStatus($terminal_id); // helper function
		if (!$open) {
			$sql = 'INSERT INTO user_terminal (user_id, terminal_id, time_in_out, in_out)
					VALUES (?, ?, ?, ?)';
			DB::insert($sql, array($user_id, $terminal_id, time(), $in_out));
		}
	}
	
	// helper function to check if the terminal is open or closed
	public function checkTerminalStatus($terminal_id) {
		$sql = 'SELECT status FROM terminal_list WHERE terminal_id=?';
		return DB::selectOne($sql, array($terminal_id));
	}
	
}