<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccessRightsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('access_rights', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('user_type_id', '100');
			$table->string('page_id', '100');
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
		Schema::drop('access_rights', function(Blueprint $table)
		{
			//
		});
	}

}
