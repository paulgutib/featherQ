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
				$terminal_type_list = $Terminal->fetchTerminalTypes();
				$terminal_node_list = $Terminal->fetchTerminalNodes();
				$terminal_types = array();
				$terminal_status = array();
				unset($terminal_node_list[0]);
				unset($terminal_type_list[0]);
				if (isset($terminal_node_list)) {
					foreach ($terminal_node_list as $terminal_id => $terminal_name) {
						$terminal_types[$terminal_id] = $Terminal->getTerminalType(
								$Terminal->getTerminalTypeByTerminalId($terminal_id));
						$terminal_status[$terminal_id] = $Terminal->status($terminal_id);
					}
				}
				$this->layout->content = View::make('terminal.terminal-list')
				  ->with('terminal_status', $terminal_status)
				  ->with('terminal_types', $terminal_types) // Terminal type column
					->with('terminal_node_list', $terminal_node_list)
				  ->with('terminal_type_list', $terminal_type_list)
				  ->with('all_terminal_types', $Terminal->fetchTerminalTypes());
			}
			else {
				return Redirect::to('user/dashboard')
				->with('error' , 'You need to be an admin to view this page.');
			}
		}
		else {
			return Redirect::to('user/login')
			->with('error' , 'You need to be logged in to view this page.');
		}
	}
	
	public function postAddType() {
		$terminal_type = Input::get('terminal_type_name');
		$Terminal = new Terminal();
		$Terminal->addTerminalType($terminal_type);
		return Redirect::to('terminal/list')
		->with('message', 'The terminal type ' . $terminal_type . ' has been added.');
	}
	
	public function postUpdateType() {
		$type_id = Input::get('terminal_type_list');
		$type_name = Input::get('new_terminal_type_name');
		$Terminal = new Terminal();
		$Terminal->updateTerminalTypeName($type_name, $type_id);
		return Redirect::to('terminal/list')
		->with('message', 'A terminal type has been renamed to ' . $type_name . '.');
	}
	
	public function postDeleteType() {
		$for_deletion = Input::get('terminal_type_delete');
		$Terminal = new Terminal();
		$delete_message = '';
		$terminal_types = $Terminal->fetchTerminalTypes();
		unset($terminal_types[0]);
		foreach ($terminal_types as $type_id => $type_name) {
			$count = 0;
			while ($count < count($for_deletion)) {
				if ($type_id == $for_deletion[$count]) {
					$delete_message .= 'Terminal type ' . $type_name . ' has been removed.<br/>';
					$Terminal->deleteTerminalType($type_id);
				}
				$count++;
			}
		}
		return Redirect::to('terminal/list')
		->with('message', $delete_message);
	}
	
	public function postUpdatedeleteNode() {
		$for_deletion = Input::get('terminal_node_delete');
		$Terminal = new Terminal();
		$delete_message = '';
		$terminal_ids = $Terminal->fetchTerminalNodes();
		foreach ($terminal_ids as $terminal_id => $terminal_name) {
			$count = 0;
						
			// update the status of the service (active/inactive)
			$status = Input::get('terminal_status_' . $terminal_id);
			$Terminal->setStatus($status, $terminal_id);
			
			while ($count < count($for_deletion)) {
				if ($terminal_id == $for_deletion[$count]) {
					$delete_message .= 'Terminal node ' . $terminal_name . ' has been removed.<br/>';
					$Terminal->deleteTerminal($terminal_id);
				}
				$count++;
			}
		}
		return Redirect::to('terminal/list')
			->with('message', $delete_message . '<br>The changes have been saved.');
	}
	
	public function postAddNode() {
		$terminal_name = Input::get('terminal_node_name');
		$type_id = Input::get('terminal_type_list');
		$Terminal = new Terminal();
		$Terminal->addTerminalNode($terminal_name, $type_id);
		$terminal_type = $Terminal->getTerminalType($type_id);
		return Redirect::to('terminal/list')
		->with('message', 'The terminal node ' . $terminal_name . ' at ' .
				$terminal_type . ' has been added.');
	}
	
}