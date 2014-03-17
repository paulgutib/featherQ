<?php

class TerminalController extends BaseController {
	
	protected $layout = 'terminal.terminal';
	
	public function __construct() {
		$this->beforeFilter('csrf', array('on'=>'post'));
	}
	
	public function getList() {
		if (Auth::check()) {
			if (Auth::user()->user_id == 1) {
				$Terminal = new Terminal();
				$types = $Terminal->fetchTerminalTypes();
				$nodes = $Terminal->fetchTerminalNodes();
				$type_array = array();
				$node_array = array();
				if (isset($types)) {
					foreach ($types as $key => $object) {
						$type_array[$key]['type_id'] = $object->type_id;
						$type_array[$key]['name'] = $object->name;
					}
				}
				if (isset($nodes)) {
					foreach ($nodes as $key => $object) {
						$node_array[$key]['terminal_id'] = $object->terminal_id;
						$node_array[$key]['name'] = $object->name;
						$node_array[$key]['type'] = $Terminal->getTerminalType($object->type);
						$node_array[$key]['status'] = $object->status;
					}
				}
				$this->layout->content = View::make('terminal.terminal-list')
					->with('types', $type_array)
					->with('nodes', $node_array);
			}
			else {
				return Redirect::to('/')
				->with('error' , 'You need to be an admin to view this page.');
			}
		}
		else {
			return Redirect::to('/')
			->with('error' , 'You need to be logged in to view this page.');
		}
	}
	
	public function getAdd() {
		if (Auth::user()->user_id == 1) {
			$Terminal = new Terminal();
			$types = $Terminal->fetchTerminalTypes();
			$type_array = array();
			if (isset($types)) {
				foreach ($types as $key => $object) {
					$type_array[$object->type_id] = $object->name;
				}
			}
			$this->layout->content = View::make('terminal.terminal-add')
				->with('types', $type_array);
		}
		else {
			return Redirect::to('/')
				->with('error', 'You are not allowed to view that page.');
		}
	}
	
	public function postCreateType() {
		$terminal_type = Input::get('type_name');
		$Terminal = new Terminal();
		$Terminal->addTerminalType($terminal_type);
		return Redirect::to('terminal/add')
			->with('message', 'The terminal type ' . $terminal_type . ' has been added.');
	}
	
	public function postUpdateType() {
		$type_id = Input::get('type_list');
		$type_name = Input::get('new_terminal_type_name');
		$Terminal = new Terminal();
		$Terminal->updateTerminalTypeName($type_name, $type_id);
		return Redirect::to('terminal/list')
		->with('message', 'A terminal type has been renamed to ' . $type_name . '.');
	}
	
	public function postDeleteType() {
		$for_deletion = Input::get('type_delete');
		$Terminal = new Terminal();
		$delete_message = '';
		$types = $Terminal->fetchTerminalTypes();
		foreach ($types as $key => $object) {
			$count = 0;
			while ($count < count($for_deletion)) {
				if ($object->type_id == $for_deletion[$count]) {
					$delete_message .= 'Terminal type ' . $object->name . ' has been removed.<br/>';
					$Terminal->deleteTerminalType($object->type_id);
				}
				$count++;
			}
		}
		return Redirect::to('terminal/list')
		->with('message', $delete_message);
	}
	
	public function postUpdatedeleteNode() {
		$for_deletion = Input::get('node_delete');
		$Terminal = new Terminal();
		$delete_message = '';
		$nodes = $Terminal->fetchTerminalNodes();
		foreach ($nodes as $key => $object) {
			$count = 0;
						
			// update the status of the service (active/inactive)
			$status = Input::get('terminal_status_' . $object->terminal_id);
			$Terminal->setStatus($status, $object->terminal_id);
			
			while ($count < count($for_deletion)) {
				if ($object->terminal_id == $for_deletion[$count]) {
					$delete_message .= 'Terminal node ' . $object->name . ' has been removed.<br/>';
					$Terminal->deleteTerminal($object->terminal_id);
				}
				$count++;
			}
		}
		return Redirect::to('terminal/list')
			->with('message', $delete_message . '<br>The changes have been saved.');
	}
	
	public function postCreateNode() {
		$terminal_name = Input::get('node_name');
		$type_id = Input::get('type_list');
		$Terminal = new Terminal();
		$Terminal->addTerminalNode($terminal_name, $type_id);
		$terminal_type = $Terminal->getTerminalType($type_id);
		return Redirect::to('terminal/add')
		->with('message', 'The terminal node ' . $terminal_name . ' at ' .
				$terminal_type . ' has been added.');
	}
	
}