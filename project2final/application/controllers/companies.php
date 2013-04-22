<?php

/*
*@ignore
 */
defined('BASEPATH') or exit;

/**
 * 
 */
class Companies extends AppController{

	public function index(){
		$company = new Company();
		$company->where('user_id', $this->session->userdata('id'));
		$company->order_by('name', 'ASC');
		$company->get();

		$this->render_view('companies/index', array(
				'data' => $company
			));
	}

	public function view($companyID){
		$company = new Company();
		$company->where('id', $companyID);
		$company->get();

		$company_notes = new CompanyNote();
		$company_notes->where('company_id', $companyID);
		$company_notes->get();

		//getting associated people
		$people = new Person();
		$people->where('company_id', $companyID);
		$people->get();

		$this->render_view('companies/view', array(
				'data' => $company,
				'notes' => $company_notes,
				'people' => $people
			));
	}

	public function edit($companyID){
		$this->load->library('form_validation');

		$success = 0;

		$this->form_validation->set_rules('e-com-name', 'Name', 'required');

		$company = new Company();
		$company->where('id', $companyID);
		$company->get();

		if($_POST){
			//parsing google maps 
			$add_query = $this->gmap_prep($this->input->post('e-com-street') );
			$country = $this->input->post('e-com-country');
			$city_query = $this->gmap_prep($this->input->post('e-com-city') );
			$prosta = $this->input->post('e-com-prosta');

			$gmap_arr = json_decode(file_get_contents("http://maps.googleapis.com/maps/api/geocode/json?address=" . $add_query . '+' . $city_query . ',' . $prosta . ',' . $country . "&sensor=false"), true);
			
			//assinging relevant parts of the json file to variables
			$lat = $gmap_arr['results']['0']['geometry']['location']['lat'];
			$long = $gmap_arr['results']['0']['geometry']['location']['lng'];
			$address = $gmap_arr['results']['0']['formatted_address'];
		}
		if ($this->form_validation->run() && $_POST) {
			$insert = new Company();
			$insert->where('id =', $company->id)->update(array(
					'name' => $this->input->post('e-com-name'),
					'email' => $this->input->post('e-com-email'),
					'website' => $this->input->post('e-com-website'),
					'phone' => $this->input->post('e-com-phone'),
					'lat' => $lat,
					'long' => $long,
					'address' => $address,
					'inputted_address' => $this->input->post('e-com-street'),
					'inputted_city' => $this->input->post('e-com-city'),
					'inputted_prosta' => $this->input->post('e-com-prosta'),
					'inputted_country' => $this->input->post('e-com-country')
				));

			$success = 1;
		}

		$this->render_view('companies/edit', array(
				'data' => $company,
				'success' => $success,
				'state_arr' => $this->state_arr
			));

	}

	public function create(){
		$this->load->helper('date');
		$this->load->library('form_validation');
		$data = array();		

		$this->form_validation->set_rules('com-name', 'Name', 'required');

		$this->load->library('upload', $this->upload_config);

		if($_POST){
			//parsing google maps 
			$add_query = $this->gmap_prep($this->input->post('com-street') );
			$country = $this->input->post('com-country');
			$city_query = $this->gmap_prep($this->input->post('com-city') );			
			$prosta = $this->input->post('com-prosta');

			$gmap_arr = json_decode(file_get_contents("http://maps.googleapis.com/maps/api/geocode/json?address=" . $add_query . '+' . $city_query . ',' . $prosta . ',' . $country . "&sensor=false"), true);
			
			//assinging relevant parts of the json file to variables
			$lat = $gmap_arr['results']['0']['geometry']['location']['lat'];
			$long = $gmap_arr['results']['0']['geometry']['location']['lng'];
			$address = $gmap_arr['results']['0']['formatted_address'];
		}

		if ($this->form_validation->run() ) {
			$create = new Company();
			$create->name = $this->input->post('com-name');			
			$create->phone = $this->input->post('com-phone');
			$create->email = $this->input->post('com-email');
			$create->website = $this->input->post('com-website');
			$create->lat = $lat;
			$create->long = $long;
			$create->address = $address;
			$create->inputted_address = $this->input->post('com-street');
			$create->inputted_city = $this->input->post('com-city');
			$create->inputted_prosta = $this->input->post('com-prosta');
			$create->inputted_country = $this->input->post('com-country');
			if ($this->upload->do_upload()) {
				$create->profile_pic = $this->upload->file_name;
			}			
			$create->created = now();
			$create->user_id = $this->session->userdata('id');

			if($create->save()){
				$data['success'] = 1;
			}
		}

		$data['state_arr'] = $this->state_arr;

		$this->render_view('companies/create', $data);
	}

	public function confirm($companyID){
		$company = new Company();
		$company->where('id', $companyID);
		$company->get();

		$this->render_view('companies/confirm-delete', array(
				'company' => $company
			));
	}

	public function delete($companyID){
		$this->render_view('companies/delete');

		$delete_note = new CompanyNote();
		$delete_note->where('company_id', $companyID)->get();

		foreach ($delete_note as $note) {
			$note->delete();
		}

		$delete = new Company();		
		$delete->where('id', $companyID)->get();
		
		if ($delete->profile_pic != 'default.jpg') {
			unlink( $this->upload_path . $delete->profile_pic);
		}
		$delete->delete();
	}

	public function changepic($companyID){
		$data = array(); 

		$this->load->library('upload', $this->upload_config);
		$company = new Company();
		$company->get();
		if($this->upload->do_upload() ){
			
			if($company->profile_pic != 'default.jpg'){
				unlink( $this->upload_path . $company->profile_pic);
			}

			$company->where('id =', $companyID)->update(array(
					'profile_pic' => $this->upload->file_name
				));

			$data['success'] = 1;
		}else{

			$data['upload_errors'] = $this->upload->display_errors('<p class="validation-error">', '</p>');	
		}

		$this->render_view('companies/changepic', $data);
	}	

}