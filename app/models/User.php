<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'user';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}
	
	public $timestamps = false;
	
	public function priorityQueue() {
		return $this->belongsTo('PriorityQueue');
	}
	
	public function terminal() {
		return $this->belongsTo('Terminal');
	}
	
	public function role($user_id) {
		
	}
	
	public static $rules = array(
		'username'=>'required|alpha_num|min:2',
		'phone'=>'required|numeric|min:2',
		'email'=>'required|email|unique:user',
		'password'=>'required|between:6,30|confirmed',
		'password_confirmation'=>'required|between:6,30'
	);
	
	public function fetchUsers() {
		$sql = 'SELECT user_id, username, email, phone, status FROM user';
		return DB::select($sql);
	}
	
	public function setStatus($arg0, $user_id) {
		$sql = 'UPDATE user SET status=? WHERE user_id=?';
		DB::update($sql, array($arg0, $user_id));
	}
	
	public function deleteUser($user_id) {
		$sql = 'DELETE FROM user WHERE user_id=?';
		DB::delete($sql, array($user_id));
	}
	
	public function status($user_id) {
		$sql = 'SELECT status FROM user WHERE user_id=?';
		return DB::selectOne($sql, array($user_id))->status;
	}
	
	public function getUsername($user_id) {
		$sql = 'SELECT username FROM user WHERE user_id=?';
		return DB::selectOne($sql, array($user_id))->username;
	}
	
	public function getUserId($username) {
		$sql = 'SELECT user_id FROM user WHERE username=?';
		return DB::selectOne($sql, array($username))->user_id;
	}
	
	public function getEmail($user_id) {
		$sql = 'SELECT email FROM user WHERE user_id=?';
		return DB::selectOne($sql, array($user_id))->email;
	}
	
	public function getPhone($user_id) {
		$sql = 'SELECT phone FROM user WHERE user_id=?';
		return DB::selectOne($sql, array($user_id))->phone;
	}
	
	public function getFullname($user_id) {
		$sql = 'SELECT full_name FROM user WHERE user_id=?';
		return DB::selectOne($sql, array($user_id))->full_name;
	}
	
	public function getStatus($user_id) {
		$sql = 'SELECT status FROM user WHERE user_id=?';
		return DB::selectOne($sql, array($user_id))->status;
	}
	
	public function getBirthdate($user_id) {
		$sql = 'SELECT birthdate FROM user WHERE user_id=?';
		return DB::selectOne($sql, array($user_id))->birthdate;
	}
	
	public function getLocation($user_id) {
		$sql = 'SELECT location FROM user WHERE user_id=?';
		return DB::selectOne($sql, array($user_id))->location;
	}
	
	public function getSex($user_id) {
		$sql = 'SELECT sex FROM user WHERE user_id=?';
		return DB::selectOne($sql, array($user_id))->sex;
	}
	
	public function getRoleId($user_id) {
		$sql = 'SELECT role_id FROM user_role WHERE user_id=?';
		return DB::selectOne($sql, array($user_id))->role_id;
	}
	
	public function getRoleNameByUserId($user_id) {
		$sql2 = 'SELECT name FROM role WHERE role_id=?';
		return DB::selectOne($sql2, array($this->getRoleId($user_id)))->name;
	}
	
	public function registerAccount($email, $username, $password, $phone, $full_name, $birthdate, $sex, $location, $nationality) {
		$duplicate = $this->checkExistenceUsernameEmailPhone($username, $email, $phone);
		if (!$duplicate['flag']) {
			$sql = 'INSERT INTO user (username, email, password, phone, full_name,
					birthdate, sex, location, nationality) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)';
			DB::insert($sql, array($username, $email, $password, $phone, $full_name,
				$birthdate, $sex, $location, $nationality));
			$message = 'Account has been created!';
			Auth::attempt(array('username' => $username, 'status' => 1));
		}
		else {
			$message = $duplicate['type'];
		}
		return $message;
	}
	
	public function updateAccount($email, $username, $password, $phone, $full_name, $birthdate, $sex, $location, $nationality, $user_id) {
		$duplicate = $this->checkExistenceUsernameEmailPhone($username, $email, $phone, $user_id);
		if (!$duplicate['flag']) {
			if ($password == '') {
				$sql = 'UPDATE user SET username=?, email=?, phone=?, full_name=?,
					birthdate=?, sex=?, location=?, nationality=? WHERE user_id=?';
				DB::update($sql, array($username, $email, $phone, $full_name,
					$birthdate, $sex, $location, $nationality, $user_id));
			}
			else {
				$sql = 'UPDATE user SET username=?, email=?, password=?, phone=?, full_name=?,
						birthdate=?, sex=?, location=?, nationality=? WHERE user_id=?';
				DB::update($sql, array($username, $email, $password, $phone, $full_name,
					$birthdate, $sex, $location, $nationality, $user_id));
			}
			$message = 'Account has been updated!';
		}
		else {
			$message = $duplicate['type'];
		}
		return $message;
	}
	
	private function checkExistenceUsernameEmailPhone($username, $email, $phone, $user_id = 0) {
		$sql = 'SELECT COUNT(*) AS existence FROM user WHERE username=? AND user_id!=?';
		$sql2 = 'SELECT COUNT(*) AS existence FROM user WHERE email=? AND user_id!=?';
		$sql3 = 'SELECT COUNT(*) AS existence FROM user WHERE phone=? AND user_id!=?';
		$exists = DB::selectOne($sql, array($username, $user_id))->existence;
		$exists2 = DB::selectOne($sql, array($email, $user_id))->existence;
		$exists3 = DB::selectOne($sql, array($phone, $user_id))->existence;
		$duplicate['type'] = '';
		if ($exists) {
			$duplicate['type'] .= 'Username is unavailable. <br/>';
			$duplicate['flag'] = TRUE;
		}
		elseif ($exists2) {
			$duplicate['type'] .= 'Email is unavailable. <br/>';
			$duplicate['flag'] = TRUE;
		}
		elseif ($exists3) {
			$duplicate['type'] .= 'Phone is unavailable. <br/>';
			$duplicate['flag'] = TRUE;
		}
		else {
			$duplicate['flag'] = FALSE;
		}
		return $duplicate;
	}
	
	public function fetchRoles() {
		$sql = 'SELECT * FROM role';
		return DB::select($sql);
	}
	
	public function insertRole($role_id, $user_id) {
		$sql = 'INSERT INTO user_role (user_id, role_id) VALUES (?, ?)';
		DB::insert($sql, array($user_id, $role_id));
	}
	
}