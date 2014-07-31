<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('user_email', '100');
			$table->string('user_password', '100');
			$table->string('user_first', '20');
			$table->string('user_last', '20');
			$table->string('user_middle', '100')->nullable;
			$table->boolean('active')->defualt(1);
			$table->string('remember_token', '100');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user', function(Blueprint $table)
		{
			//
		});
	}

}
