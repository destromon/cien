<?php

class UserSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		// $this->call('UserTableSeeder');
		//delete this please
		$user = [
		'user_email' 	=> 'super@admin.com',
		'user_password' => Hash::make('1234'),
		'user_first'	=> 'Jes',
		'user_last'	=>	'Tadena',
		'user_middle'	=>	'Gee'
		];

		DB::table('user')->insert($user);
	}

}
