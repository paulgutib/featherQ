<?php

class MasterAdminSeed extends Seeder {

	public function run() {
		DB::table('user')->insert(array(array(
			'username' => "reminisense",
			'password' => Hash::make("Reminisense1!"),
			'email' => "paul@reminisense.com"
		)));
	}

}