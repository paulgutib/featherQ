<?php

class MasterAdminSeed extends Seeder {

	public function run() {
		DB::table('user')->insert(array(array(
			'username' => "reminisense",
			'password' => Hash::make("Reminisense!1"),
			'email' => "paul@reminisense.com",
		)));
		DB::table('role')->insert(array(
			array('name' => 'Master Admin'),
			array('name' => 'Business Admin'),
			array('name' => 'Terminal Admin'),
			array('name' => 'Regular User'),
		));
	}
}