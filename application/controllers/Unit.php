<?php 

class Unit extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();
		
		$this->data['page_title'] = 'Unit of Measurement';
		$this->load->model('model_unit');

	}

	public function index()
	{	

		$this->render_template('unit/index', $this->data);
	}

	public function fetchUnitData()
	{
		if(!in_array('viewUnit', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		
		$result = array('data' => array());

		$data = $this->model_unit->getUnitData();

		foreach ($data as $key => $value) {


			// button
			$buttons = '';

			if(in_array('updateUnit', $this->permission)) {
				$buttons = '<button type="button" class="btn btn-info" onclick="editFunc('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i></button>';
			}

			if(in_array('deleteUnit', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-danger" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
			}

			$result['data'][$key] = array(

				$value['unit_name'],
				$buttons
			);	
		} // /foreach

		echo json_encode($result);
	}

	public function create()
	{
		if(!in_array('createUnit', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		try{
		$response = array();

		$this->form_validation->set_rules('unit_name', 'Unit Name', 'trim|required');


		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
        	$data = array(
        		'unit_name' => $this->input->post('unit_name'),
	
        	);

        	$create = $this->model_unit->create($data);
        	if($create == true) {
        		$response['success'] = true;
        		$response['messages'] = 'Succesfully created';
        	}
        	else {
        		$response['success'] = false;
        		$response['messages'] = 'Error in the database while creating the brand information';			
        	}
        }
        else {
        	$response['success'] = false;
        	foreach ($_POST as $key => $value) {
        		$response['messages'][$key] = form_error($key);
        	}
        }
		}
        catch(Exception $e){
				$response['success'] = false;
        		$response['messages'] = 'Data already exist in the database';		

        }
        echo json_encode($response);

	}

	public function fetchUnitDataById($id = null)
	{
		if($id) {
			$data = $this->model_unit->getUnitData($id);
			echo json_encode($data);
		}
		
	}

	public function update($id)
	{
		if(!in_array('updateUnit', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		try{
		$response = array();

		if($id) {
			$this->form_validation->set_rules('edit_unit_name', 'Unit name', 'trim|required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
	        		'unit_name' => $this->input->post('edit_unit_name'),
	        	);

	        	$update = $this->model_unit->update($id, $data);
	        	if($update == true) {
	        		$response['success'] = true;
	        		$response['messages'] = 'Succesfully updated';
	        	}
	        	else {
	        		$response['success'] = false;
	        		$response['messages'] = 'Error in the database while updated the brand information';			
	        	}
	        }
	        else {
	        	$response['success'] = false;
	        	foreach ($_POST as $key => $value) {
	        		$response['messages'][$key] = form_error($key);
	        	}
	        }
		}
		else {
			$response['success'] = false;
    		$response['messages'] = 'Error please refresh the page again!!';
		}
		}
        catch(Exception $e){
				$response['success'] = false;
        		$response['messages'] = 'Data already exist in the database';		

        }
		echo json_encode($response);
	}

	public function remove()
	{
		if(!in_array('deleteUnit', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		
		$unit_id = $this->input->post('unit_id');

		$response = array();
		if($unit_id) {
			$delete = $this->model_unit->remove($unit_id);
			if($delete == true) {
				$response['success'] = true;
				$response['messages'] = "Successfully removed";	
			}
			else {
				$response['success'] = false;
				$response['messages'] = "Error in the database while removing the brand information";
			}
		}
		else {
			$response['success'] = false;
			$response['messages'] = "Refresh the page again!!";
		}

		echo json_encode($response);
	}

}