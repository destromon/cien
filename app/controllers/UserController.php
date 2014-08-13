<?php

class UserController extends BaseController {

	public function __construct()
	{	
		//if user edit		

		$this->beforeFilter(function(){
			if(Auth::user()->user_access != 'Administrator') {
				$checkAccessRights = AccessRights::checkAccessRights();
				if(!$checkAccessRights) {
					return Redirect::to('admin')
					->with('warning', 'You dont have an access to this page.');
					}	
				}
		});
	}

	/*
	 * display user listing
	 * 
	 * @param
	 * @return
	 */
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
		//get user type
		$userTypes = UserType::select('id', 'user_type_name')->get();

		return View::make('user.create')
			->with(array('userTypes' => $userTypes));
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

			$userTypeId = Input::get('user_access');
			$existsUserType = UserType::where('id', '=', $userTypeId)->first();
			if(!$existsUserType) {
				return Redirect::to('user/create')
				->with('error', 'User Type doesnt exists')
				->withInput(Input::except('password'));
			}

			$user = new User;
			$user->user_email    = Input::get('user_email');
			$user->user_password = Hash::make(Input::get('user_password'));
			$user->user_first 	 = Input::get('user_first');
			$user->user_last 	 = Input::get('user_last');
			$user->user_middle	 = Input::get('user_middle');
			$user->user_access	 = Input::get('user_access');
			$user->active	 	 = true;
			$user->save();

			Session::flash('message', 'User successfully added');
			if(Input::get('save')) {
				return Redirect::to('user/' . $user->id . '/edit');
			}

			if(Input::get('save_and_close')) {
				return Redirect::to('user');
			}

			if(Input::get('save_and_new')) {
				return Redirect::to('user/create');
			}
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show()
	{
		$search = Input::get('search');
		$users = User::where('user_last', 'LIKE', '%' . $search .'%')
			->orWhere('user_first', 'LIKE', '%' . $search .'%')
			->orwhere('user_middle', 'LIKE', '%' . $search .'%')
			->orwhere('user_email', 'LIKE', '%' . $search .'%')
			->orderBy('user_last', 'asc')
			->paginate(15);

		return View::make('user.show')
			->with(array(
				'users'  => $users,
				'search' => $search));
	}

	/*
	 * display form with selected user data
	 * 
	 * @param string
	 * @return
	 */
	public function edit($id) 
	{
		//get user type
		$userTypes = UserType::select('id', 'user_type_name')->get();

		return View::make('user.edit')
			->with(array(
				'user' 		=> User::find($id),
				'userTypes' => $userTypes));
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
			'user_access'	=> 'required'
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
			$user->user_access	 = Input::get('user_access');
			$user->save();

			Session::flash('message', 'User successfully updated');

		}
	
		if(Input::get('save')) {
			return Redirect::to('user/' . $user->id . '/edit');
		}

		if(Input::get('save_and_close')) {
			return Redirect::to('user');
		}

		if(Input::get('save_and_new')) {
			return Redirect::to('user/create');
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
