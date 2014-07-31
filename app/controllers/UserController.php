<?php

class UserController extends BaseController {

	/*
	 * display user listing
	 * 
	 * @param
	 * @return
	 */
	function __construct()
	{

	}
	public function index()
	{
		//get all users in the database
		
		$users = User::where('id', '!=',  Auth::user()->id)->paginate(15);

		//create a view for index page
		return View::make('user.index')
			->with(array('users' => $users));
	}

	/*
	 * display user form inputs
	 * 
	 * @param
	 * @return
	 */
	public function create()
	{
		return View::make('user.create');
	}

	/*
	 * save new user to database
	 * 
	 * @param
	 * @return form / listing
	 */
	public function store()
	{
		//create rules 
		$rules = array(
			'user_email'    => 'required|email|unique:user',
			'user_password' => 'required|confirmed',
			'user_first' 	=> 'required',
			'user_last' 	=> 'required',
			'user_access' 	=> 'required'
		);

		//validate posted data
		$validator = Validator::make(Input::all(), $rules);
		
		//check if data is ok
		if($validator->fails()) {
			return Redirect::to('user/create')
				->withErrors($validator)
				->withInput(Input::except('password'));
		} else {
			$user = new User;
			$user->user_email    = Input::get('user_email');
			$user->user_password = Hash::make(Input::get('user_password'));
			$user->user_first 	 = Input::get('user_first');
			$user->user_last 	 = Input::get('user_last');
			$user->user_middle	 = Input::get('user_middle');
			$user->user_access 	 = Input::get('user_access');
			$user->save();

			Session::flash('message', 'User successfully created');

			return Redirect::to('user');
		}
	}

	/*
	 * display form with selected user data
	 * 
	 * @param string
	 * @return
	 */
	public function edit($id) 
	{
		return View::make('user.edit')
			->with(array('user'=>User::find($id)));
	}

	/*
	 * update user in the database
	 * 
	 * @param
	 * @return
	 */
	public function update($id) 
	{
		//create rules 
		$rules = array(
			'user_email'    => 'required|email|unique:user,user_email,' .$id,
			'user_password' => 'required|confirmed',
			'user_first' 	=> 'required',
			'user_last' 	=> 'required',
			'user_access' 	=> 'required'
		);

		//validate posted data
		$validator = Validator::make(Input::all(), $rules);
		
		//check if data is ok
		if($validator->fails()) {
			return Redirect::to('user/' . $id . '/edit')
				->withErrors($validator)
				->withInput(Input::except('password'));
		} else {
			$user = User::find($id);
			$user->user_email    = Input::get('user_email');
			$user->user_password = Hash::make(Input::get('user_password'));
			$user->user_first 	 = Input::get('user_first');
			$user->user_last 	 = Input::get('user_last');
			$user->user_middle	 = Input::get('user_middle');
			$user->user_access 	 = Input::get('user_access');
			$user->save();

			Session::flash('message', 'User successfully updated');

			return Redirect::to('user');
		}
	}

	/*
	 * make user inactive
	 * 
	 * @param
	 * @return
	 */
	public function destroy($id) 
	{
		$user = User::find($id);
		$user->delete();

		Session::flash('delete', 'User successfully deleted');
		return Redirect::to('user');
	}

}
