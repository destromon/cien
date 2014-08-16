<?php

class Menu {
	public static function render()
	{
		//for Admin

		//user
		$subMenuUser = array(
			array( 'link' => '/user', 'text' => 'Lists of Users'),
	        array( 'link' => '/user/create', 'text' => 'Add New User'));

		//settings
		$subMenuSettings = array(
			array( 'link' => '/page', 	       'text' => 'List of Pages'),
	        array( 'link' => '/user_type',     'text' => 'User Type'),
	        array( 'link' => '/access_rights', 'text' => 'Assign Access Rights / Priviledges'));
		
		//add submenu to main menu
		$mainMenu = array(
			array(
				'name'    => 'Users', 
				'class'   => 'fa fa-user', 
				'subMenu' => $subMenuUser),

			array(
				'name'    => 'Settings', 
				'class'   => 'fa fa-gear',
				'subMenu' => $subMenuSettings));
		

		//for public users

		$subMenuCart = array(
			array('link' => '/account/cart', 'text' => 'My Cart'),
			array('link' => '/account/order', 'text' => 'My Order'));

		$mainMenuPublic = array(
			array(
				'name'    => 'Cart',
				'class'   => 'fa fa-shopping-cart',
				'subMenu' => $subMenuCart));

		//default access rights
		if(Auth::user()->user_access == 'Administrator') {
			return $mainMenu;
		} elseif (Auth::user()->user_access == 'public') {
			return $mainMenuPublic;
		}

		//base on configurable access rights.
		if(is_numeric(Auth::user()->user_access)) {
			$userAccess = UserType::where('id', '=', Auth::user()->user_access)
				->first();

			//check if user access rights is existing
			if($userAccess) {
				//check if its public
				if($userAccess->user_type_name == 'public') {
					return $mainMenuPublic;
				}

				//else return admin menu
				return $mainMenu;
			}
		}
		
	}
}