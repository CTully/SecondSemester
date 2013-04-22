<?php
/*
*@ignore
 */
defined('BASEPATH') or exit;

/**
 * 
 */
class PersonNotes extends AppController{

	public function view($personnoteID){
		$person_note = new PersonNote();
		$person_note->where('id', $personnoteID);
		$person_note->get();

		$this->render_view('personnotes/view', array(
				'note' => $person_note
			));
	}

	public function edit($personnoteID){
		$this->load->library('form_validation');

		$success = 0;

		$this->form_validation->set_rules('e-per-note', 'Note', 'required');

		$person_note = new PersonNote();
		$person_note->where('id', $personnoteID);
		$person_note->get();

		if ($this->form_validation->run() && $_POST) {
			$insert = new PersonNote();
			$insert->where('id =', $person_note->id)->update(array(
					'note' => $this->input->post('e-per-note')
				));

			$success = 1;
		}

		$this->render_view('personnotes/edit', array(
				'data' => $person_note,
				'success' => $success
			));
	}

	public function create($personID){
		$this->load->helper('date');
		$this->load->library('form_validation');
		$data = array();		

		$this->form_validation->set_rules('per-note', 'Note', 'required');

		if ($this->form_validation->run() ) {
			$create_note = new PersonNote();
			$create_note->note = $this->input->post('per-note');			
			$create_note->created = now();
			$create_note->person_id = $personID;
			if($create_note->save()){
				$data['success'] = 1;
			}
		}

		$this->render_view('personnotes/create', $data);
	}

	public function confirm($personnoteID){
		$person_note = new PersonNote();
		$person_note->where('id', $personnoteID);
		$person_note->get();

		$this->render_view('personnotes/confirm-delete', array(
				'personnote' => $person_note
			));
	}

	public function delete($personnoteID){		

		$delete_note = new PersonNote();
		$delete_note->where('id', $personnoteID)->get();
		$delete_note->delete();

		$this->render_view('personnotes/delete');
	}

}