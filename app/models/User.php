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
	
}