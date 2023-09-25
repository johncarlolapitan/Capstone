<?php 

class Discount extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();
		
		$this->data['page_title'] = 'Discount';
		$this->load->model('model_discount');
		$this->load->model('model_maincat');

	}

	public function index()
	{	

		$this->render_template('discount/index', $this->data);
	}

	public function fetchDiscountData()
	{
		if(!in_array('viewDisc', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		
		$result = array('data' => array());

		$data = $this->model_discount->getDiscountData();
		if (is_array($data) || is_object($data))
		{
		foreach ($data as $key => $value) {


			// button
			$buttons = '';

			if(in_array('updateDisc', $this->permission)) {
				$buttons = '<button type="button" class="btn btn-info" onclick="editFunc('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i></button>';
			}

			if(in_array('deleteDisc', $this->permission)) {
				// dito yung delete button palitan mo nalang yung value para mawala if gamit gamit
				$buttons .=  ' <button type="button" class="btn btn-danger" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
			}

			$status = ($value['active'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';

			$result['data'][$key] = array(

				$value['name'],
				$value['discount_percent'],
				$status,
				$buttons
			);
		} // /foreach
		}
		echo json_encode($result);
	}


	public function getDiscById()
	{
		$discount_id = $this->input->post('discount_id');
		if($discount_id) {
			$discount_data = $this->model_discount->getDiscountData($discount_id);
			echo json_encode($discount_data);
		}
	}




	public function create()
	{
		if(!in_array('createDisc', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		try{
		$response = array();

		$this->form_validation->set_rules('disc_name', 'Discount name', 'trim|required');
		$this->form_validation->set_rules('disc_percent', 'Discount Percentage', 'trim|integer');


		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
        	$data = array(
        		'name' => $this->input->post('disc_name'),
        		'discount_percent' => $this->input->post('disc_percent'),	
        	);


			 



        	$create = $this->model_discount->create($data);
        	if($create == true) {

				$user_id = $this->session->userdata('id');
                //audit trail
                $data1 = array(
                    'date_time' => strtotime(date('Y-m-d h:i:s a')),
                    'user_id' => $user_id,
                    'action_made' => 'Created ['.$this->input->post('disc_name').'] in the Discount list',
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

	public function fetchDiscountDataById($id = null)
	{
		if($id) {
			$data = $this->model_discount->getDiscountData($id);
			echo json_encode($data);
		}
		
	}

	public function update($id)
	{
		if(!in_array('updateDisc', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		try{
		$response = array();

		if($id) {
			$this->form_validation->set_rules('edit_disc_name', 'Discount name', 'trim|required');
			$this->form_validation->set_rules('edit_disc_percent', 'Discount Percentage', 'trim|integer');
			$this->form_validation->set_rules('edit_active', 'Active', 'trim|required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');



	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
	        		'name' => $this->input->post('edit_disc_name'),
        			'discount_percent' => $this->input->post('edit_disc_percent'),	
        			'active' => $this->input->post('edit_active'),	
	        	);


	        	$update = $this->model_discount->update($id, $data);
	        	if($update == true) {

					$user_id = $this->session->userdata('id');
					//audit trail
					$data1 = array(
						'date_time' => strtotime(date('Y-m-d h:i:s a')),
						'user_id' => $user_id,
						'action_made' => 'Updated ['.$this->input->post('edit_disc_name').'] in the Discount list',
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
		if(!in_array('deleteDisc', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		
		$table_id = $this->input->post('discount_id');

		$discinfo = $this->model_discount->getDiscountData($table_id);
		$response = array();
		if($table_id) {
			$delete = $this->model_discount->remove($table_id);
			if($delete == true) {

				$user_id = $this->session->userdata('id');
                //audit trail
                $data1 = array(
                    'date_time' => strtotime(date('Y-m-d h:i:s a')),
                    'user_id' => $user_id,
                    'action_made' => 'Deleted [name = '.$discinfo['name'].'] in the Discount list',
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