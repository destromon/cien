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


/*
|--------------------------------------------------------------------------
| Index Routes
|--------------------------------------------------------------------------
/
/ All routes to home
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

//register controller
Route::get('register', 'RegisterController@index');
Route::post('register', 'RegisterController@doRegister');

//forgot password
Route::get('/forgot', 'PasswordResetRequestController@index');
Route::post('/forgot', 'PasswordResetRequestController@forgotPassword');

Route::get('/forgot/password', 'PasswordResetRequestController@formForgotPassword');
Route::get('/forgot/form', 'PasswordResetRequestController@form');
Route::post('/forgot/form', 'PasswordResetRequestController@doResetPassword');

//activate user
Route::get('/activate', 'UserPublicController@activate');
Route::get('/activate/resend', 'RegisterController@resendActivation');


/*
|--------------------------------------------------------------------------
| Backend Routes
|--------------------------------------------------------------------------
/
/ All routes to back-end
*/
Route::group(array('before' => 'auth'), function()
{	

	/*
	|--------------------------------------------------------------------------
	| Public Routes
	|--------------------------------------------------------------------------
	/
	/ All routes to back-end
	*/
	Route::get('/account', 'AccountController@index');

	/*
	|--------------------------------------------------------------------------
	| Admin/with access Routes
	|--------------------------------------------------------------------------
	/
	/ All routes to back-end
	*/
	Route::get('admin', 'AdminController@index');
	
	Route::resource('user', 'UserController');

	//Settings
	Route::resource('/user_type', 'UserTypeController');
	Route::resource('/page', 'PageController');
	Route::resource('/access_rights', 'AccessRightsController');

	//profile
	Route::resource('/profile', 'ProfileController');
});



//anti cross scripting
Route::filter('csrf', function() {

});

//check if visitors only
Route::filter('auth', function() {
	if(Auth::guest()) Redirect::to('login');
});	