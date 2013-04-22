<?php

/*
*@ignore
 */
defined('BASEPATH') or exit;

/**
 * 
 */
class People extends AppController{

	public function index(){
		$person = new Person();
		$person->where('user_id', $this->session->userdata('id') );
		$person->order_by('lname', 'ASC');
		$person->get();

		$this->render_view('people/index', array(
				'data' => $person
			));
	}

	public function view($personID){
		$person = new Person();
		$person->where('id', $personID);
		$person->get();

		//getting the related company
		$per_company = new Company();
		$per_company->where('id', $person->company_id);
		$per_company->get();

		//grabbing notes
		$person_notes = new PersonNote();
		$person_notes->where('person_id', $personID);
		$person_notes->get();

		$this->render_view('people/view', array(
				'data' => $person,
				'notes' => $person_notes,
				'per_company' => $per_company
			));
	}

	public function edit($personID){
		$this->load->library('form_validation');

		$success = 0;

		$this->form_validation->set_rules('e-peo-fname', 'First Name', 'required');	
		$this->form_validation->set_rules('e-peo-lname', 'Last Name', 'required');		
		$this->form_validation->set_rules('e-peo-phone', 'Phone', 'required');
		$this->form_validation->set_rules('e-peo-mobile', 'Mobile', 'required');
		$this->form_validation->set_rules('e-peo-email', 'Email', 'required');

		$person = new Person();
		$person->where('id', $personID);
		$person->get();

		if($_POST){
			//parsing google maps 
			$add_query = $this->gmap_prep($this->input->post('e-peo-street') );
			$country = $this->input->post('e-peo-country');
			$city_query = $this->gmap_prep($this->input->post('e-peo-city') );			
			$prosta = $this->input->post('e-peo-prosta');

			$gmap_arr = json_decode(file_get_contents("http://maps.googleapis.com/maps/api/geocode/json?address=" . $add_query . '+' . $city_query . ',' . $prosta . ',' . $country . "&sensor=false"), true);

			//assinging relevant parts of the json file to variables
			$lat = $gmap_arr['results']['0']['geometry']['location']['lat'];
			$long = $gmap_arr['results']['0']['geometry']['location']['lng'];
			$address = $gmap_arr['results']['0']['formatted_address'];
		}

		//grabbing all other availabe companies
		$companies = new Company();
		$companies->get();

		if ($this->form_validation->run() && $_POST) {
			$insert = new Person();
			$insert->where('id =', $person->id)->update(array(
					'title' => $this->input->post('e-peo-title'),
					'fname' => $this->input->post('e-peo-fname'),
					'lname' => $this->input->post('e-peo-lname'),
					'email' => $this->input->post('e-peo-email'),
					'website' => $this->input->post('e-peo-website'),
					'lat' => $lat,
					'long' => $long,
					'address' => $address,
					'inputted_address' => $this->input->post('e-peo-street'),
					'inputted_city' => $this->input->post('e-peo-city'),
					'inputted_prosta' => $this->input->post('e-peo-prosta'),
					'inputted_country' => $this->input->post('e-peo-country'),
					'mobile' => $this->input->post('e-peo-mobile'),
					'phone' => $this->input->post('e-peo-phone'),
					'company_id' => $this->input->post('e-peo-company')
				));

			$success = 1;
		}

		$this->render_view('people/edit', array(
				'data' => $person,
				'companies' => $companies,
				'success' => $success,
				'state_arr' => $this->state_arr,
				'title' => $this->title
			));
	}

	public function create(){
		$this->load->helper('date');
		$this->load->library('form_validation');
		$data = array();

		//grabbing all existing company info to pass to view
		$company = new Company();
		$company->where('user_id', $this->session->userdata('id') );
		$company->get();
		$data['company'] = $company;		

		$this->form_validation->set_rules('peo-fname', 'First Name', 'required');
		$this->form_validation->set_rules('peo-lname', 'Last Name', 'required');

		if($_POST){
			//parsing google maps 
			$add_query = $this->gmap_prep($this->input->post('peo-street') );
			$country = $this->input->post('peo-country');
			$city_query = $this->gmap_prep($this->input->post('peo-city') );
			$prosta = $this->input->post('peo-prosta');

			$gmap_arr = json_decode(file_get_contents("http://maps.googleapis.com/maps/api/geocode/json?address=" . $add_query . '+' . $city_query . ',' . $prosta . ',' . $country . "&sensor=false"), true);
			
			//assinging relevant parts of the json file to variables
			$lat = $gmap_arr['results']['0']['geometry']['location']['lat'];
			$long = $gmap_arr['results']['0']['geometry']['location']['lng'];
			$address = $gmap_arr['results']['0']['formatted_address'];
		}	

		$this->load->library('upload', $this->upload_config);

		if ($this->form_validation->run() ) {
			$create = new Person();
			$create->title = $this->input->post('peo-title');
			$create->fname = $this->input->post('peo-fname');
			$create->lname = $this->input->post('peo-lname');			
			$create->phone = $this->input->post('peo-phone');
			$create->mobile = $this->input->post('peo-mobile');
			$create->email = $this->input->post('peo-email');
			$create->website = $this->input->post('peo-website');
			$create->lat = $lat;
			$create->long = $long;
			$create->address = $address;
			$create->inputted_address = $this->input->post('peo-street');
			$create->inputted_city = $this->input->post('peo-city');
			$create->inputted_prosta = $this->input->post('peo-prosta');
			$create->inputted_country = $this->input->post('peo-country');
			$create->company_id = $this->input->post('peo-company');
			if ($this->upload->do_upload()) {
				$create->profile_pic = $this->upload->file_name;
			}	
			$create->created = now();
			$create->user_id = $this->session->userdata('id');
			if($create->save()){
				$data['success'] = 1;
			}else{
				$data['errors'] = $this->upload->display_errors();
			}
		}

		$data['state_arr'] = $this->state_arr;
		$data['title'] = $this->title;

		$this->render_view('people/create', $data);
	}

	public function confirm($personID){
		$person = new Person();
		$person->where('id', $personID);
		$person->get();

		$this->render_view('people/confirm-delete', array(
				'person' => $person
			));
	}

	public function delete($personID){
		$this->render_view('people/delete');

		$delete_note = new PersonNote();
		$delete_note->where('person_id', $personID)->get();
		$delete_note->delete();

		$delete = new Person();
		$delete->where('id', $personID)->get();
		if ($delete->profile_pic != 'default.jpg') {
			unlink( $this->upload_path . $delete->profile_pic);
		}			
		$delete->delete();
	}

	public function changepic($personID){
		$data = array(); 	

		$this->load->library('upload', $this->upload_config);
		$person = new Person();
		$person->get();
		if($this->upload->do_upload() ){
			if($person->profile_pic != 'default.jpg'){
				unlink( $this->upload_path . $person->profile_pic);
			}
			$person->where('id =', $personID)->update(array(
					'profile_pic' => $this->upload->file_name
				));
			$data['success'] = 1;
		}else{
			$data['upload_errors'] = $this->upload->display_errors('<p class="validation-error">', '</p>');	
		}

		$this->render_view('people/changepic', $data);
	}

}