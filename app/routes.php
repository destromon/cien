<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//index controller
Route::get('/', 'HomeController@index');

//login controller
Route::get('login', 'LoginController@index');
Route::post('login', 'LoginController@doLogin');

//logout
Route::get('logout', function() {
	Auth::logout();
	return Redirect::to('login')
		->with('logout', 'You are now logged out.');
});


//group controller
Route::group(array('before' => 'auth'), function()
{	
	Route::get('admin', 'AdminController@index');

	Route::resource('user', 'UserController');
	Route::resource('user_type', 'UserTypeController');
	Route::resource('page', 'PageController');
	Route::resource('access_rights', 'AccessRightsController');
    
});



//anti cross scripting
Route::filter('csrf', function() {

});

//check if visitors only
Route::filter('auth', function() {
	if(Auth::guest()) Redirect::to('login');
});	