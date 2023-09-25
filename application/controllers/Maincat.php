<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Maincat extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Main Category';

		$this->load->model('model_maincat');
		$this->load->model('model_subcat');

	}

    /* 
    * It only redirects to the manage product pagei
    */
	public function index() 
	{
        if(!in_array('viewMaincat', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->render_template('maincat/index', $this->data);	
	}   

    /*
    * It Fetches the products data from the product table 
    * this function is called from the datatable ajax function
    */
	public function fetchMainCatData()
	{
        if(!in_array('viewMaincat', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
		$result = array('data' => array());

		$data = $this->model_maincat->getMainCatData();
		foreach ($data as $key => $value) {
           
            

			// button
            $buttons = '';
            if(in_array('updateMaincat', $this->permission)) {
    			$buttons .= '<a href="'.base_url('maincat/update/'.$value['id']).'" class="btn btn-info"><i class="fa fa-pencil"></i></a>';
            }

            if(in_array('deleteMaincat', $this->permission)) { 
				$buttons .= ($value['button_status'] == 1) ? ' <button style="display:none;" type="button" class="btn btn-danger" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>' : '<button style="margin-left: 5px;" type="button" class="btn btn-danger" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
            }
			


            $availability = ($value['active'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';

			$result['data'][$key] = array(
				$value['name'],

                $availability,
				$buttons
			);
		} // /foreach
		echo json_encode($result);
        
	}	
    
   

    /*
    * If the validation is not valid, then it redirects to the create page.
    * If the validation for each input field is valid then it inserts the data into the database 
    * and it stores the operation message into the session flashdata and display on the manage product page
    */
	public function create()
	{
        $user_id = $this->session->userdata('id');
		if(!in_array('createMaincat', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        try{
		$this->form_validation->set_rules('category_name', 'Category name', 'trim|required');
		
	
        if ($this->form_validation->run() == TRUE) {
            // true case

        	$data = array(
        		'name' => $this->input->post('category_name'),


        	);


       






        	$create = $this->model_maincat->create($data);
        	if($create == true) {
                //audit trail
                $data1 = array(
                    'date_time' => strtotime(date('Y-m-d h:i:s a')),
                    'user_id' => $user_id,
                    'action_made' => 'Created ['.$this->input->post('category_name').'] in the Main Category list',
                );

                $audit = $this->model_maincat->create1($data1);

        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('maincat/', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('maincat/create', 'refresh');
        	}
        }
        else {

            $this->render_template('maincat/create', $this->data);
        }	
        }
        catch(Exception $e){
        	$this->session->set_flashdata('success', 'Data already exist in the database');
        	redirect('maincat/create', 'refresh');

        }
	}

   

    /*
    * If the validation is not valid, then it redirects to the edit product page 
    * If the validation is successfully then it updates the data into the database 
    * and it stores the operation message into the session flashdata and display on the manage product page
    */
	public function update($id)
	{      
        $user_id = $this->session->userdata('id');
        if(!in_array('updateMaincat', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        try{
        if(!$id) {
            redirect('dashboard', 'refresh');
        }

		    $this->form_validation->set_rules('category_name', 'Category name', 'trim|required');
		    $this->form_validation->set_rules('active', 'Active', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            // true case
            
            $data = array(
               'name' => $this->input->post('category_name'),
        	   'active' => $this->input->post('active'),

            );


           


            $update = $this->model_maincat->update($data, $id);
            if($update == true) {
                 //audit trail
                $data1 = array(
                    'date_time' => strtotime(date('Y-m-d h:i:s a')),
                    'user_id' => $user_id,
                    'action_made' => 'Updated ['.$this->input->post('category_name').'] in the Main Category list',
                );

                $audit = $this->model_maincat->create1($data1);


                $this->session->set_flashdata('success', 'Successfully updated');
                redirect('maincat/', 'refresh');
            }
            else {
                $this->session->set_flashdata('errors', 'Error occurred!!');
                redirect('maincat/update/'.$id, 'refresh');
            }
        }
        else {
                         
            $category_data = $this->model_maincat->getMainCatData($id);
            $this->data['category_data'] = $category_data;

          //  print_r($product_data);die;
            $this->render_template('maincat/edit', $this->data); 
        } 
        }
        catch(Exception $e){
           $this->session->set_flashdata('success', 'Data already exist in the database');
            redirect('maincat/update/'.$id, 'refresh');

        }
	}

    /*
    * It removes the data from the database
    * and it returns the response into the json format
    */
	public function remove()
	{
        if(!in_array('deleteMaincat', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
        $id = $this->input->post('category_id');
        $maincat = $this->model_maincat->getMainCatData($id);
        $user_id = $this->session->userdata('id');

        



        $response = array();
        if($id) {
            $delete = $this->model_maincat->remove($id);
            if($delete == true) {
                    //audit trail
                $data1 = array(
                    'date_time' => strtotime(date('Y-m-d h:i:s a')),
                    'user_id' => $user_id,
                    'action_made' => 'Deleted [name = '.$maincat['name'].'] in the Main Category list',
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