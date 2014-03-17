<?php

use Monolog\Handler\SyslogUdp\UdpSocket;
class UserController extends BaseController {
	
	protected $layout = 'user.user';
	
	public function __construct() {
		$this->beforeFilter('csrf', array('on'=>'post'));
	}
	
	public function getRegister() {
		if (Auth::check()) {
			return Redirect::to('/');
		}
		else {
			$this->layout->content = View::make('user.user-register');
		}
	}
	
	public function getPassword() {
		if (Auth::check()) {
			return Redirect::to('/');
		}
		else {
			$this->layout->content = View::make('user.user-password');
		}
	}
	
	public function getLogin() {
		if (Auth::check()) {
			return Redirect::to('/');
		}
		else {
			$this->layout->content = View::make('user.user-login');
		}
	}
	
	public function getList() {
		if (Auth::user()->user_id == 1) {
			$User = new User();
			$users = $User->fetchUsers();
			$user_array = array();
			if (isset($users)) {
				foreach ($users as $key => $object) {
					if ($object->user_id != 1) {
						$user_array[$key]['user_id'] = $object->user_id;
						$user_array[$key]['username'] = $object->username;
						$user_array[$key]['email'] = $object->email;
						$user_array[$key]['phone'] = $object->phone;
						$user_array[$key]['status'] = $object->status;
					}
				}
			}
			$this->layout->content = View::make('user.user-list')
				->with('users', $user_array);
		}
		else {
			return Redirect::to('/')
			->with('error', 'You are not allowed to view that page.');
		}
	}
	
	public function getAdd() {
		if (Auth::user()->user_id == 1) {
			$this->layout->content = View::make('user.user-add');
		}
		else {
			return Redirect::to('/')
				->with('error', 'You are not allowed to view that page.');
		}
	}
	
	public function postCreateViaAdmin() {
		$validator = Validator::make(Input::all(), User::$rules);
		if ($validator->passes()) {
			$user = new User;
			$user->username = Input::get('username');
			$user->phone = Input::get('phone');
			$user->email = Input::get('email');
			$user->password = Hash::make(Input::get('password'));
			$user->save();
			return Redirect::to('user/add')->with('message', 'Username ' .
					$user->username . ' has been created.');
		} else {
			return Redirect::to('user/add')->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
		}
	}
	
	public function postUpdatedelete() {
		$for_deletion = Input::get('user_delete');
		$User = new User();
		$delete_message = '';
		$users = $User->fetchUsers();
		foreach ($users as $key => $object) {
			$count = 0;
						
			// update the status of the service (active/inactive)
			if ($object->user_id != 1) {
				$status = Input::get('user_status_' . $object->user_id);
				$User->setStatus($status, $object->user_id);
			}
			
			while ($count < count($for_deletion)) {
				if ($object->user_id == $for_deletion[$count]) {
					$delete_message .= 'User ' . $object->username . ' has been deleted.<br/>';
					$User->deleteUser($object->user_id);
				}
				$count++;
			}
		}
		return Redirect::to('user/list')
			->with('message', $delete_message . '<br>The changes have been saved.');
	}
	
	public function postCreate() {
		$validator = Validator::make(Input::all(), User::$rules);
		if ($validator->passes()) {
	    $user = new User;
	    $user->username = Input::get('username');
	    $user->phone = Input::get('phone');
	    $user->email = Input::get('email');
	    $user->password = Hash::make(Input::get('password'));
	    $user->save();
	    return Redirect::to('/')->with('message', 'Thanks for registering!');
		} else {
		  return Redirect::to('/')->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
		}
	}
	
	public function postSignin() {
		if (Auth::attempt(array('username' => Input::get('username'), 'password' => Input::get('password'), 'status' => 1))) {
			return Redirect::to('/');
		}
		else {
			return Redirect::to('/')
				->withInput()
				->with('error', 'You entered a wrong username and password combination or the account has been disabled or non-existent.');
		}
	}
	
	public function getLogout() {
		Auth::logout();
		return Redirect::to('/')
			->with('message', 'You are now logged out');
	}
	
}