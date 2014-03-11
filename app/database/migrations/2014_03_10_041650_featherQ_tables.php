<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FeatherQTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('location', function($table) {
			$table->increments('location_id');
			$table->string('name')->default('');
		});
		Schema::create('notification_platform', function($table) {
			$table->increments('platform_id');
			$table->string('name')->default('');
		});
		Schema::create('permission', function($table) {
			$table->integer('role_id')->default(0);
			$table->string('permissions')->default('');
			$table->integer('terminal_permissions')->default(0);
			$table->primary('role_id');
		});
		Schema::create('popularity', function($table) {
			$table->increments('popularity_id');
			$table->string('name')->default('');
		});
		Schema::create('priority_number', function($table) {
			$table->increments('priority_number');
			$table->integer('time_served')->default(0);
		});
		Schema::create('priority_queue', function($table) {
			$table->integer('transaction_number')->default(0);
			$table->integer('priority_number')->default(0);
			$table->integer('service_id')->default(0);
			$table->integer('terminal_id')->default(0);
			$table->integer('user_id')->default(0);
			$table->integer('status')->default(1);
			$table->integer('notification_platform')->default(0);
			$table->integer('time_called')->default(0);
			$table->primary('transaction_number');
		});
		Schema::create('processed_queue', function($table) {
			$table->integer('transaction_number')->default(0);
			$table->integer('priority_number')->default(0);
			$table->integer('service_id')->default(0);
			$table->integer('terminal_id')->default(0);
			$table->integer('user_id')->default(0);
			$table->integer('time_processed')->default(0);
			$table->primary('transaction_number');
		});
		Schema::create('queue_service', function($table) {
			$table->increments('service_id');
			$table->string('service_name')->default('');
			$table->integer('location')->default(0);
			$table->integer('popularity')->default(0);
			$table->integer('status')->default(1);
		});
		Schema::create('role', function($table) {
			$table->increments('role_id');
			$table->string('name')->default('');
		});
		Schema::create('scheduled_queue', function($table) {
			$table->integer('transaction_number')->default(0);
			$table->integer('scheduled_time')->default(0);
			$table->primary('transaction_number');
		});
		Schema::create('terminal_list', function($table) {
			$table->increments('terminal_id');
			$table->string('name')->default('');
			$table->integer('type')->default(0);
			$table->integer('status')->default(1);
		});
		Schema::create('terminal_type', function($table) {
			$table->increments('type_id');
			$table->string('name')->default('');
		});
		Schema::create('terminal_type_hierarchy', function($table) {
			$table->integer('parent')->default(0);
			$table->integer('child')->default(0);
			$table->primary('parent', 'child');
		});
		Schema::create('user', function($table) {
			$table->increments('user_id');
			$table->string('email')->default('');
			$table->string('username')->default('');
			$table->string('password')->default('');
			$table->integer('phone')->default(0);
			$table->integer('status')->default(1);
			$table->unique('username', 'email');
		});
		Schema::create('user_role', function($table) {
			$table->integer('user_id')->default(0);
			$table->integer('role_id')->default(0);
			$table->primary('user_id', 'role_id');
		});
		Schema::create('user_service', function($table) {
			$table->integer('user_id')->default(0);
			$table->integer('service_id')->default(0);
			$table->string('other_data')->default('');
			$table->primary('user_id', 'service_id');
		});
		Schema::create('user_terminal', function($table) {
			$table->increments('login_id');
			$table->integer('user_id')->default(0);
			$table->integer('terminal_id')->default(0);
			$table->integer('time_in')->default(0);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('location');
		Schema::drop('notification_platform');
		Schema::drop('permission');
		Schema::drop('popularity');
		Schema::drop('priority_number');
		Schema::drop('priority_queue');
		Schema::drop('processed_queue');
		Schema::drop('queue_service');
		Schema::drop('role');
		Schema::drop('scheduled_queue');
		Schema::drop('terminal_list');
		Schema::drop('terminal_type');
		Schema::drop('terminal_type_hierarchy');
		Schema::drop('user');
		Schema::drop('user_role');
		Schema::drop('user_service');
		Schema::drop('user_terminal');
	}

}
