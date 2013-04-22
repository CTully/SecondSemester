<?php

/*
*@ignore
 */
defined('BASEPATH') or exit;

/**
 * 
 */
class Users extends AppController{

	public function index(){
		$this->render_view('users/index', array(
			));
	}

	public function view(){
		//allow users to view on anothers profile if currently logged in
	}

	public function edit(){
		//allow logged in users to access and edit their own profiles
	}

	public function login(){
		//allow users to login if they currently are not logged in
	}

	public function logout(){

	}

	public function register(){

	}


}