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
		$this->render_view('users/index');
	}

	public function edit(){
		$this->load->helper(array('form', 'date') );
		$this->load->library('form_validation');

		$this->form_validation->set_rules('e-username', 'Name', 'required');
		$this->form_validation->set_rules('e-email', 'Email Address', 'required');

		$data = array(
				'username' => $this->session->userdata('username'),
				'success' => 0
			);

		$edit = new User();

		$username = $this->session->userdata('username');

		$data['query_info'] = $edit->edit($username);

		if ($this->form_validation->run() && $_POST) {
			$insert = new User();
			$insert->where('username =', $this->session->userdata('username'))->update(array(
					'username' => $this->input->post('e-username'),
					'email' => $this->input->post('e-email')
				));
			$this->session->set_userdata('username', $this->input->post('e-username') );
			$data['success'] = 1;
		}

		$this->render_view('users/edit', $data);

	}

	public function confirm(){
		$this->render_view('users/confirm-delete');
	}

	public function delete(){
		$this->render_view('users/delete');

		//deleting companies		
		$delete_companies = new Company();
		$delete_companies->where('user_id', $this->session->userdata('id') )->get();		

		foreach ($delete_companies as $company) {
			if ($company->profile_pic != 'default.jpg') {
				unlink( $this->upload_path . $company->profile_pic);
			}
			$company->delete();
		}

		//deleting people
		$delete_people = new Person();
		$delete_people->where('user_id', $this->session->userdata('id') )->get();		

		foreach ($delete_people as $person) {
			if ($person->profile_pic != 'default.jpg') {
				unlink( $this->upload_path . $person->profile_pic);
			}
			$person->delete();
		}

		//deleting company notes
		$delete_company_notes = new CompanyNote();
		$delete_company_notes->where('company_id', 0)->get();
		
		foreach ($delete_company_notes as $note) {
			$note->delete();
		}

		//deleting a peron's notes
		$delete_people_notes = new PersonNote();
		$delete_people_notes->where('person_id', 0)->get();

		foreach ($delete_people_notes as $note) {
			$note->delete();
		}

		//and finally, deleting the user
		$delete_user = new User();
		$delete_user->where('id', $this->session->userdata('id'))->get();
		if ($delete_user->profile_pic != 'default.jpg') {
			unlink( $this->upload_path . $delete_user->profile_pic);
		}
		$delete_user->delete();

		$this->session->sess_destroy();
	}

	public function login(){
		$this->load->helper('form');
		$data = array();

		if ($_POST) {
			$login = new User();
			$username = $this->input->post('l-username');
			$password = $this->input->post('l-password');

			$attempt = $login->login($username, $password);

			if ($attempt) {
				$this->session->set_userdata('username', $username);
				$this->session->set_userdata('id', $attempt['id']);
				$data['username'] = $this->session->userdata('username');
				$data['success'] = 1;
			}else{
				$data['failure'] = 1;
			}
		}

		$this->render_view('users/login', $data);
	}

	public function view(){
		$user = new User;
		$user->get();

		$this->render_view('users/view', array(
				'user' => $user
			));
	}

	public function logout(){
		$this->session->sess_destroy();
		$this->render_view('users/logout', array(
				'title' => 'Users - logout'
			));
	}

	public function register(){
		$this->load->helper(array('date') );
		$this->load->library('form_validation');
		$data = array();		

		$this->form_validation->set_rules('r-username', 'Name', 'required|is_unique[users.username]');
		$this->form_validation->set_rules('r-email', 'Email Address', 'required');
		$this->form_validation->set_rules('r-password', 'Password', 'required');
		$this->form_validation->set_rules('r-confirm-password', 'Password', 'required|matches[r-password]');	

		$this->load->library('upload', $this->upload_config);		

		if ($this->form_validation->run() ) {
			$register = new User();
			$register->username = $this->input->post('r-username');
			$register->email = $this->input->post('r-email');
			if ($this->upload->do_upload()) {
				$register->profile_pic = $this->upload->file_name;
			}	
			$register->password = md5($this->input->post('r-password'));
			$register->created = now();

			if ($register->save() ) {
				$this->session->set_userdata('username', $this->input->post('r-username') );
				$this->session->set_userdata('id', $register->id );
				$data['username'] = $this->session->userdata('username');
				$data['success'] = 1;
			}else{
				$data['failure'] = 1;
			}
		}

		$this->render_view('users/register', $data);
		
	}

	public function changepic(){
		$data = array();
		$this->load->library('upload', $this->upload_config);

		$user = new User();
		$user->get();		
		
		if($this->upload->do_upload() ){
			unlink( $this->upload_path . $user->profile_pic);
				
			$user->where('id =', $this->session->userdata('id'))->update(array(
					'profile_pic' => $this->upload->file_name
				));

			$data['success'] = 1;
		}else{

			$data['upload_errors'] = $this->upload->display_errors('<p class="validation-error">', '</p>');	
		}

		$this->render_view('users/changepic', $data);
	}


}