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
		//'firstname'=>'required|alpha|min:2',
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
	
}