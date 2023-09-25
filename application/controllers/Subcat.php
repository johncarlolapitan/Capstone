<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Subcat extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Sub Category';

		$this->load->model('model_maincat');
		$this->load->model('model_subcat');
        $this->load->model('model_products');
	}

    /* 
    * It only redirects to the manage product pagei
    */
	public function index()
	{
        if(!in_array('viewSubcat', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
		$this->render_template('subcat/index', $this->data);	

	}

    /*
    * It Fetches the products data from the product table 
    * this function is called from the datatable ajax function
    */
	public function fetchSubCatData()
	{
        if(!in_array('viewSubcat', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
		$result = array('data' => array());

		$data = $this->model_subcat->getSubCatData();

		foreach ($data as $key => $value) {
           
            

			// button
            $buttons = '';
            if(in_array('updateSubcat', $this->permission)) {
    			$buttons .= '<a href="'.base_url('subcat/update/'.$value['id']).'" class="btn btn-info"><i class="fa fa-pencil"></i></a>';
            }

            if(in_array('deleteSubcat', $this->permission)) { 
    			$buttons .= ' <button type="button" class="btn btn-danger" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
            }
			


            $availability = ($value['active'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';

			$result['data'][$key] = array(
				$value['name'],
                $value['markup'],

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
		if(!in_array('createSubcat', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        try{
		$this->form_validation->set_rules('category_name', 'Category name', 'trim|required');
        $this->form_validation->set_rules('markup', 'Markup', 'trim|required|numeric');
	
        if ($this->form_validation->run() == TRUE) {
            // true case

        	$data = array(
        		'name' => $this->input->post('category_name'),
                'markup' => $this->input->post('markup'),
        		'main_category_id' => $this->input->post('category'),



        	);

        	$create = $this->model_subcat->create($data);
        	if($create == true) {
                 $user_id = $this->session->userdata('id');
                //audit trail
                $data1 = array(
                    'date_time' => strtotime(date('Y-m-d h:i:s a')),
                    'user_id' => $user_id,
                    'action_made' => 'Created ['.$this->input->post('category_name').'] in the Sub Category list',
                );

                $audit = $this->model_maincat->create1($data1);


        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('subcat/', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('subcat/create', 'refresh');
        	}
        }
        else {
            $this->data['category'] = $this->model_maincat->getActiveMainCategory(); // eto need 22/10/2022

            $this->render_template('subcat/create', $this->data);
        }	
        }
        catch(Exception $e){
        	$this->session->set_flashdata('success', 'Data already exist in the database');
        	redirect('subcat/create', 'refresh');

        }
	}



    /*
    * If the validation is not valid, then it redirects to the edit product page 
    * If the validation is successfully then it updates the data into the database 
    * and it stores the operation message into the session flashdata and display on the manage product page
    */
	public function update($id)
	{      
        if(!in_array('updateSubcat', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        try{
        if(!$id) {
            redirect('dashboard', 'refresh');
        }

		    $this->form_validation->set_rules('category_name', 'Category name', 'trim|required');
            $this->form_validation->set_rules('markup', 'Markup', 'trim|required|numeric');
		    $this->form_validation->set_rules('active', 'Active', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            // true case
            
            $data = array(
               'name' => $this->input->post('category_name'),
        	   'active' => $this->input->post('active'),
               'markup' => $this->input->post('markup'),
               'main_category_id' => $this->input->post('category'),
            );


            $update = $this->model_subcat->update($data, $id);
            if($update == true) {
                 $user_id = $this->session->userdata('id');
                //audit trail
                $data1 = array(
                    'date_time' => strtotime(date('Y-m-d h:i:s a')),
                    'user_id' => $user_id,
                    'action_made' => 'Updated ['.$this->input->post('category_name').'] in the Sub Category list',
                );

                $audit = $this->model_maincat->create1($data1);



                $this->session->set_flashdata('success', 'Successfully updated');
                redirect('subcat/', 'refresh');
            }
            else {
                $this->session->set_flashdata('errors', 'Error occurred!!');
                redirect('subcat/update/'.$id, 'refresh');
            }
        }
        else {
             $this->data['category'] = $this->model_maincat->getActiveMainCategory(); // eto need 22/10/2022


            $category_data = $this->model_subcat->getSubCatData($id);
            $this->data['category_data'] = $category_data;

            //print_r($category_data);die;
            $this->render_template('subcat/edit', $this->data); 
        }   
        }
        catch(Exception $e){
           $this->session->set_flashdata('success', 'Data already exist in the database');
            redirect('subcat/update/'.$id, 'refresh');

        }
	}

    /*
    * It removes the data from the database
    * and it returns the response into the json format
    */
	public function remove()
	{
        if(!in_array('deleteSubcat', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        $id = $this->input->post('category_id');
        $maincat = $this->model_subcat->getSubCatData($id);
        $response = array();
        if($id) {
            $delete = $this->model_subcat->remove($id);
            if($delete == true) {
                

                 $user_id = $this->session->userdata('id');
                //audit trail
                $data1 = array(
                    'date_time' => strtotime(date('Y-m-d h:i:s a')),
                    'user_id' => $user_id,
                    'action_made' => 'Deleted [id = '.$maincat['name'].'] in the Sub Category list',
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
     public function myformAjax($id) { 
           $result = $this->db->where("main_category_id",$id)->get("tbl_sub_category")->result();
           echo json_encode($result);
       }

}