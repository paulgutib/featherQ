<?php

use Monolog\Handler\SyslogUdp\UdpSocket;
class UserController extends BaseController {
	
	protected $layout = 'user.user';
	
	public function __construct() {
		$this->beforeFilter('csrf', array('on'=>'post'));
	}
	
	public function getEdit($user_id) {
		if (Auth::user()->user_id == 1) {
			$User = new User();
			$roles = $User->fetchRoles();
			$role_array = array();
			if (isset($roles)) {
				foreach ($roles as $key => $object) {
					if ($object->role_id != 1) {
						$role_array[$object->role_id] = $object->name;
					}
				}
			}
			$birthdate = $User->getBirthdate($user_id);
			$month = date("m", $birthdate);
			$year = date("Y", $birthdate);
			$day = date("d", $birthdate);
			$this->layout->content = View::make('user.user-edit')
			  ->with('user_id', $user_id)
				->with('roles', $role_array)
				->with('role_id', $User->getRoleId($user_id))
				->with('days', $this->getDays())
				->with('years', $this->getYears())
				->with('months' , $this->getMonths())
				->with('user_id', $user_id)
				->with('email', $User->getEmail($user_id))
				->with('username', $User->getUsername($user_id))
				->with('status', $User->getStatus($user_id))
				->with('fullname', $User->getFullname($user_id))
				->with('month', $month)
				->with('year', $year)
				->with('day', $day)
				->with('location', $User->getLocation($user_id))
				->with('sex', $User->getSex($user_id))
				->with('phone', $User->getPhone($user_id));
		}
		else {
			return Redirect::to('/')
			->with('error', 'You are not allowed to view that page.');
		}
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
						$user_array[$key]['role'] = $User->getRoleNameByUserId($object->user_id);
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
			$User = new User();
			$roles = $User->fetchRoles();
			$role_array = array();
			if (isset($roles)) {
				foreach ($roles as $key => $object) {
					if ($object->role_id != 1) {
						$role_array[$object->role_id] = $object->name;
					}
				}
			}
			$this->layout->content = View::make('user.user-add')
			  ->with('roles', $role_array)
				->with('days', $this->getDays())
			  ->with('years', $this->getYears())
				->with('months' , $this->getMonths());
		}
		else {
			return Redirect::to('/')
				->with('error', 'You are not allowed to view that page.');
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
	    $User = new User;
	    $birthdate = mktime(0, 0, 0, Input::get('month'), Input::get('day'), Input::get('year'));
	    $message = $User->registerAccount(Input::get('email'), Input::get('username'),
	    		Hash::make(Input::get('password')), Input::get('phone'), Input::get('fullname'),
	    		$birthdate, Input::get('sex'), Input::get('location'), Input::get('nationality'));
	    return Redirect::to($this->roleRedirect(Input::get('add_type'),
	    		Input::get('role'), $User->getUserId(Input::get('username'))))
	    	->with('message', $message);
		} else {
		  return Redirect::to('/')->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
		}
	}
	
	public function postUpdate() {
		$validator = Validator::make(Input::all(), User::$rules);
		if ($validator->passes()) {
			$User = new User;
			$birthdate = mktime(0, 0, 0, Input::get('month'), Input::get('day'), Input::get('year'));
			$message = $User->updateAccount(Input::get('email'), Input::get('username'),
					Hash::make(Input::get('password')), Input::get('phone'), Input::get('fullname'),
					$birthdate, Input::get('sex'), Input::get('location'), Input::get('nationality'),
					Input::get('user_id'));
			return Redirect::to('user/edit/' . Input::get('user_id'))
				->with('message', $message);
		} else {
			return Redirect::to('user/edit/' . Input::get('user_id'))
				->with('message', 'The following errors occurred')
				->withErrors($validator)->withInput();
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
	
	public function postUpdateViaAdmin() {
		
	}
	
	public function getLogout() {
		Auth::logout();
		return Redirect::to('/')
			->with('message', 'You are now logged out');
	}
	
	public function getMonths() {
		$month = 1;
		while ($month <= 12) {
			$months[$month] = date("M", mktime(0, 0, 0, $month));
			$month++;
		}
		return $months;
	}
	
	public function getDays() {
		$day = 1;
		while ($day <= 31) {
			$days[$day] = $day;
			$day++;
		}
		return $days;
	}
	
	public function getYears() {
		$year = 1930;
		while ($year <= date("Y", time())) {
			$years[$year] = $year;
			$year++;
		}
		return $years;
	}
	
	private function roleRedirect($add_type, $role_id, $user_id) {
		$User = new User;
		if ($add_type == 'admin') {
			$redirect_to = 'user/add';
			$User->insertRole($role_id, $user_id);
		}
		else {
			$redirect_to = '/';
			$User->insertRole(4, $user_id);
		}
		return $redirect_to;
	}
	
	private function roleRedirectV2($add_type, $role_id, $user_id) {
		$User = new User;
		if ($add_type == 'admin') {
			$redirect_to = 'user/add';
			$User->insertRole($role_id, $user_id);
		}
		else {
			$redirect_to = '/';
			$User->insertRole(4, $user_id);
		}
		return $redirect_to;
	}
	
}