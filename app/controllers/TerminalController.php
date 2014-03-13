<?php

class TerminalController extends BaseController {
	
	public function __construct() {
		$this->beforeFilter('csrf', array('on'=>'post'));
	}
	
	public function postAddType() {
		$terminal_type = Input::get('terminal_type_name');
		$Terminal = new Terminal();
		$Terminal->addTerminalType($terminal_type);
		return Redirect::to('user/dashboard')
		->with('message', 'The terminal type ' . $terminal_type . ' has been added.');
	}
	
	public function postUpdateType() {
		$type_id = Input::get('terminal_type_list');
		$type_name = Input::get('new_terminal_type_name');
		$Terminal = new Terminal();
		$Terminal->updateTerminalTypeName($type_name, $type_id);
		return Redirect::to('user/dashboard')
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
		return Redirect::to('user/dashboard')
		->with('message', $delete_message);
	}
	
}