<?php 

class Payment extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();
		
		$this->data['page_title'] = 'Payment Method';
		$this->load->model('model_payment');
		$this->load->model('model_maincat');
	}

	public function index()
	{	

		$this->render_template('payment/index', $this->data);
	}

	public function fetchPaymentData()
	{
		if(!in_array('viewDisc', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		
		$result = array('data' => array());

		$data = $this->model_payment->getPaymentData();
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
				$buttons .= ' <button type="button" class="btn btn-danger" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
			}

			$status = ($value['active'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';

			$result['data'][$key] = array(

				$value['name'],
				$value['account_number'],
				$status,
				$buttons
			);
		} // /foreach
		}
		echo json_encode($result);
	}


	public function create()
	{
		if(!in_array('createDisc', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		try{
		$response = array();

		$this->form_validation->set_rules('pay_name', 'Payment Method Name', 'trim|required');
		$this->form_validation->set_rules('acc_num', 'Account Number', 'trim|integer');


		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
        	$data = array(
        		'name' => $this->input->post('pay_name'),
        		'account_number' => $this->input->post('acc_num'),	
        	);

        	$create = $this->model_payment->create($data);
        	if($create == true) {

				$user_id = $this->session->userdata('id');
                //audit trail
                $data1 = array(
                    'date_time' => strtotime(date('Y-m-d h:i:s a')),
                    'user_id' => $user_id,
                    'action_made' => 'Created ['.$this->input->post('pay_name').'] in the Payment Method list',
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
		public function getPaymentById()
	{
		$payment_id = $this->input->post('payment_id');
		if($payment_id) {
			$payment_data = $this->model_payment->getPaymentData($payment_id);
			echo json_encode($payment_data);
		}
	}

	public function fetchPaymentDataById($id = null)
	{
		if($id) {
			$data = $this->model_payment->getPaymentData($id);
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
			$this->form_validation->set_rules('edit_pay_name', 'Payment Method name', 'trim|required');
			$this->form_validation->set_rules('edit_acc_number', 'Discount Percentage', 'trim|integer');
			$this->form_validation->set_rules('edit_active', 'Active', 'trim|required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');



	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
	        		'name' => $this->input->post('edit_pay_name'),
        			'account_number' => $this->input->post('edit_acc_number'),	
        			'active' => $this->input->post('edit_active'),	
	        	);


	        	$update = $this->model_payment->update($id, $data);
	        	if($update == true) {

					$user_id = $this->session->userdata('id');
					//audit trail
					$data1 = array(
						'date_time' => strtotime(date('Y-m-d h:i:s a')),
						'user_id' => $user_id,
						'action_made' => 'Updated ['.$this->input->post('edit_pay_name').'] in the Payment Method list',
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
		
		$table_id = $this->input->post('payment_id');
		$discinfo = $this->model_payment->getPaymentData($table_id);


		$response = array();
		if($table_id) {
			$delete = $this->model_payment->remove($table_id);
			if($delete == true) {

				$user_id = $this->session->userdata('id');
                //audit trail
                $data1 = array(
                    'date_time' => strtotime(date('Y-m-d h:i:s a')),
                    'user_id' => $user_id,
                    'action_made' => 'Deleted [name = '.$discinfo['name'].'] in the Payment Method list',
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