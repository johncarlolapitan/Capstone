<?php 

class Tables extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();
		
		$this->data['page_title'] = 'Tables';
		$this->load->model('model_tables');
		$this->load->model('model_maincat');
	}

	public function index()
	{	

		$this->render_template('tables/index', $this->data);
	}

	public function fetchTableData()
	{
		if(!in_array('viewTable', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		
		$result = array('data' => array());

		$data = $this->model_tables->getTableData();
		if (is_array($data) || is_object($data))
		{
		foreach ($data as $key => $value) {


			// button
			$buttons = '';

			if(in_array('updateTable', $this->permission)) {
				$buttons = '<button type="button" class="btn btn-info" onclick="editFunc('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i></button>';
			}

			if(in_array('deleteTable', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-danger" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
			}

			$available = ($value['available'] == 1) ? '<span class="label label-success">Available</span>' : '<span class="label label-danger">Unavailable</span>';
			$status = ($value['active'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';

			$result['data'][$key] = array(

				$value['table_name'],
				$value['capacity'],
				$available,
				$status,
				$buttons
			);
		} // /foreach
		}
		echo json_encode($result);
	}

	public function create()
	{
		if(!in_array('createTable', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		try{
		$response = array();

		$this->form_validation->set_rules('table_name', 'Table name', 'trim|required');
		$this->form_validation->set_rules('capacity', 'Capacity', 'trim|integer');


		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
        	$data = array(
        		'table_name' => $this->input->post('table_name'),
        		'available' => 1,
        		'capacity' => ($this->input->post('capacity') > 0) ? $this->input->post('capacity') : 1,	
        	);

        	$create = $this->model_tables->create($data);
        	if($create == true) {

				$user_id = $this->session->userdata('id');
                //audit trail
                $data1 = array(
                    'date_time' => strtotime(date('Y-m-d h:i:s a')),
                    'user_id' => $user_id,
                    'action_made' => 'Created ['.$this->input->post('table_name').'] in the Tables list',
                );

                $audit = $this->model_maincat->create1($data1);


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

	public function fetchTableDataById($id = null)
	{
		if($id) {
			$data = $this->model_tables->getTableData($id);
			echo json_encode($data);
		}
		
	}

	public function update($id)
	{
		if(!in_array('updateTable', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		try{
		$response = array();

		if($id) {
			$this->form_validation->set_rules('edit_table_name', 'Table name', 'trim|required');
			$this->form_validation->set_rules('edit_capacity', 'Capacity', 'trim|integer');
			$this->form_validation->set_rules('edit_active', 'Active', 'trim|required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
	        		'table_name' => $this->input->post('edit_table_name'),
        			'capacity' => $this->input->post('edit_capacity'),	
        			'active' => $this->input->post('edit_active'),	
	        	);

	        	$update = $this->model_tables->update($id, $data);
	        	if($update == true) {

					$user_id = $this->session->userdata('id');
					//audit trail
					$data1 = array(
						'date_time' => strtotime(date('Y-m-d h:i:s a')),
						'user_id' => $user_id,
						'action_made' => 'Updated ['.$this->input->post('edit_table_name').'] in the Table list',
					);

					$audit = $this->model_maincat->create1($data1);

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
		if(!in_array('deleteTable', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		
		$table_id = $this->input->post('table_id');
		$discinfo = $this->model_tables->getTableData($table_id);


		$response = array();
		if($table_id) {
			$delete = $this->model_tables->remove($table_id);
			if($delete == true) {


				$user_id = $this->session->userdata('id');
                //audit trail
                $data1 = array(
                    'date_time' => strtotime(date('Y-m-d h:i:s a')),
                    'user_id' => $user_id,
                    'action_made' => 'Deleted [name = '.$discinfo['table_name'].'] in the Tables list',
                );

                $audit = $this->model_maincat->create1($data1);


				$response['success'] = true;
				$response['messages'] = "Successfully removed";	
			}
			else {
				$response['success'] = false;
				$response['messages'] = "This Data is already in used in some modules.";
			}
		}
		else {
			$response['success'] = false;
			$response['messages'] = "Refersh the page again!!";
		}

		echo json_encode($response);
	}

}