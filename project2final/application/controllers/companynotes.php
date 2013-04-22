<?php
/*
*@ignore
 */
defined('BASEPATH') or exit;

/**
 * 
 */
class CompanyNotes extends AppController{

	public function view($companynoteID){
		$company_note = new CompanyNote();
		$company_note->where('id', $companynoteID);
		$company_note->get();

		$this->render_view('companynotes/view', array(
				'note' => $company_note
			));
	}

	public function edit($companynoteID){
		$this->load->library('form_validation');

		$success = 0;

		$this->form_validation->set_rules('e-com-note', 'Note', 'required');

		$company_note = new CompanyNote();
		$company_note->where('id', $companynoteID);
		$company_note->get();

		if ($this->form_validation->run() && $_POST) {
			$insert = new CompanyNote();
			$insert->where('id =', $company_note->id)->update(array(
					'note' => $this->input->post('e-com-note')
				));

			$success = 1;
		}

		$this->render_view('companynotes/edit', array(
				'data' => $company_note,
				'success' => $success
			));
	}

	public function confirm($companynoteID){
		$company_note = new CompanyNote();
		$company_note->where('id', $companynoteID);
		$company_note->get();

		$this->render_view('companynotes/confirm-delete', array(
				'companynote' => $company_note
			));
	}

	public function create($companyID){
		$this->load->helper('date');
		$this->load->library('form_validation');
		$data = array();		

		$this->form_validation->set_rules('com-note', 'Note', 'required');

		if ($this->form_validation->run() ) {
			$create_note = new CompanyNote();
			$create_note->note = $this->input->post('com-note');			
			$create_note->created = now();
			$create_note->company_id = $companyID;
			if($create_note->save()){
				$data['success'] = 1;
			}
		}

		$this->render_view('companynotes/create', $data);
	}

	public function delete($companynoteID){		

		$delete_note = new CompanyNote();
		$delete_note->where('id', $companynoteID)->get();
		$delete_note->delete();

		$this->render_view('companynotes/delete');
	}

}