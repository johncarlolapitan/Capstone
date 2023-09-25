<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Products';

		$this->load->model('model_products');
		$this->load->model('model_subcat');
        $this->load->model('model_maincat');
	}
	public function index()
	{
        if(!in_array('viewProd', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->render_template('products/index', $this->data);	
        $category_data = $this->model_subcat->getSubCatData();
        $this->data['category_data'] = $category_data;
        
      //  print_r($category_data);
	}
    public function getSubcatById()
	{
		$sub_category_id = $this->input->post('sub_category_id');
		if($sub_category_id) {
			$sub_category_data = $this->model_subcat->getSubCatData($sub_category_id);
			echo json_encode($sub_category_data);
		}
	}




	public function fetchProductData()
	{
        if(!in_array('viewProd', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
		$result = array('data' => array());

		$data = $this->model_products->getProductData();

		foreach ($data as $key => $value) {
           
            

			// button
            $buttons = '';
            if(in_array('updateProd', $this->permission)) {
    			$buttons .= '<a href="'.base_url('products/update/'.$value['id']).'" class="btn btn-info"><i class="fa fa-pencil"></i></a>';
            }

            if(in_array('deleteProd', $this->permission)) { 
    			$buttons .= ' <button type="button" class="btn btn-danger" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
            }
			


            $availability = ($value['active'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';

			$result['data'][$key] = array(
				$value['name'],
				$value['cost'],
                $value['srp'],
                $availability,
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}	
    public function viewproduct()
    {
        if(!in_array('viewProd', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        $user_id = $this->session->userdata('id');
                //audit trail
                $data1 = array(
                    'date_time' => strtotime(date('Y-m-d h:i:s a')),
                    'user_id' => $user_id,
                    'action_made' => 'Viewed Inventory Valuation',
                );

       $audit = $this->model_maincat->create1($data1);


        $company_currency = $this->company_currency();
        // get all the category 
        $sub_category_data = $this->model_subcat->getSubCatData();

        $result = array();
        
        foreach ($sub_category_data as $k => $v) {
            $result[$k]['sub_category'] = $v;
            $result[$k]['products'] = $this->model_products->getProductDataByCat($v['id']);
        }

        // based on the category get all the products 

        $html = '<!-- Main content -->
                    <!DOCTYPE html>
                    <html>
                    <head>
                      <meta charset="utf-8">
                      <meta http-equiv="X-UA-Compatible" content="IE=edge">
                      <title>Invoice</title>
                      <!-- Tell the browser to be responsive to screen width -->
                      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
                      <!-- Bootstrap 3.3.7 -->
                      <link rel="stylesheet" href="'.base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css').'">
                      <!-- Font Awesome -->
                      <link rel="stylesheet" href="'.base_url('assets/bower_components/font-awesome/css/font-awesome.min.css').'">
                      <link rel="stylesheet" href="'.base_url('assets/dist/css/AdminLTE.min.css').'">
                    </head>
                    <body>
                    
                    <div class="wrapper">
                      <section class="invoice">

                        <div class="row">
                        ';
                            foreach ($result as $k => $v) {
                                $html .= '<div class="col-md-6">
                                    <div class="product-info">
                                        <div class="category-title">
                                            <h1>'.$v['sub_category']['name'].'</h1>
                                        </div>';

                                        if(count($v['products']) > 0) {
                                            foreach ($v['products'] as $p_key => $p_value) {
                                                $html .= '<div class="product-detail">
                                                            <div class="product-name" style="display:inline-block;">
                                                                <h5>'.$p_value['name'].'</h5>
                                                            </div>
                                                            <div class="product-price" style="display:inline-block;float:right;">
                                                                <h5>'.$company_currency . ' ' . $p_value['srp'].'</h5>
                                                            </div>
                                                        </div>';
                                            }
                                        }
                                        else {
                                            $html .= 'N/A';
                                        }        
                                    $html .='</div>
                                        
                                </div>';
                            }
                        

                        $html .='
                        </div>
                      </section>
                      <!-- /.content -->
                    </div>
                </body>
            </html>';

                      echo $html;
    }
      public function viewproduct1()
    {
        if(!in_array('viewProd', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        $user_id = $this->session->userdata('id');
                //audit trail
                $data1 = array(
                    'date_time' => strtotime(date('Y-m-d h:i:s a')),
                    'user_id' => $user_id,
                    'action_made' => 'Viewed Product Master List',
                );

       $audit = $this->model_maincat->create1($data1);


        $company_currency = $this->company_currency();
        // get all the category 
        $sub_category_data = $this->model_subcat->getSubCatData();

        $result = array();
        
        foreach ($sub_category_data as $k => $v) {
            $result[$k]['sub_category'] = $v;
            $result[$k]['products'] = $this->model_products->getProductDataByCat($v['id']);
        }

        // based on the category get all the products 

        $html = '<!-- Main content -->
                    <!DOCTYPE html>
                    <html>
                    <head>
                      <meta charset="utf-8">
                      <meta http-equiv="X-UA-Compatible" content="IE=edge">
                      <title>Invoice</title>
                      <!-- Tell the browser to be responsive to screen width -->
                      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
                      <!-- Bootstrap 3.3.7 -->
                      <link rel="stylesheet" href="'.base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css').'">
                      <!-- Font Awesome -->
                      <link rel="stylesheet" href="'.base_url('assets/bower_components/font-awesome/css/font-awesome.min.css').'">
                      <link rel="stylesheet" href="'.base_url('assets/dist/css/AdminLTE.min.css').'">
                    </head>
                    <body>
                    
                    <div class="wrapper">
                      <section class="invoice">

                        <div class="row">
                        ';
                            foreach ($result as $k => $v) {
                                $html .= '<div class="col-md-6">
                                    <div class="product-info">
                                        <div class="category-title">
                                            <h1>'.$v['sub_category']['name'].'</h1>
                                        </div>';

                                        if(count($v['products']) > 0) {
                                            foreach ($v['products'] as $p_key => $p_value) {
                                                $html .= '<div class="product-detail">
                                                            <div class="product-name" style="display:inline-block;">
                                                                <h5>Quantity: </h5>
                                                            </div>
                                                            <div class="product-price" style="display:inline-block;float:right;">
                                                                <h5>'. $p_value['qty'].'</h5>
                                                            </div>
                                                        </div>';
                                            }
                                        }
                                        else {
                                            $html .= 'N/A';
                                        }        
                                    $html .='</div>
                                        
                                </div>';
                            }
                        

                        $html .='
                        </div>
                      </section>
                      <!-- /.content -->
                    </div>
                </body>
            </html>';

                      echo $html;
    }
	public function create()
	{

		if(!in_array('createProd', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        try{
		$this->form_validation->set_rules('product_name', 'Product name', 'trim|required');
		$this->form_validation->set_rules('srp_value', 'SRP', 'trim|required|numeric');
        $this->form_validation->set_rules('cost', 'Cost', 'trim|required|numeric');
        $this->form_validation->set_rules('markup_value', 'Markup', 'trim|required');


		
	
        if ($this->form_validation->run() == TRUE) {

        	$data = array(
        		'name' => $this->input->post('product_name'),
        		'srp' => $this->input->post('srp_value'),
                'cost' => $this->input->post('cost'), 
        		'description' => $this->input->post('description'),
        		'sub_category_id' => json_encode($this->input->post('sub_category')),
                'main_category_id' => json_encode($this->input->post('main_category')),
                'markup' => $this->input->post('markup_value'),
                'lead_time' => $this->input->post('lead_time'),
                'daily_use' => $this->input->post('daily_use'),
                'safety_stock' => $this->input->post('safety_stock_value'),
                'rop' => $this->input->post('reorderpoint_value'),
                'active' => 2,
        	);

           



        	$create = $this->model_products->create($data);
        	if($create == true) {
                $user_id = $this->session->userdata('id');
                //audit trail
                $data1 = array(
                    'date_time' => strtotime(date('Y-m-d h:i:s a')),
                    'user_id' => $user_id,
                    'action_made' => 'Created ['.$this->input->post('product_name').'] in the Product list',
                );

                $audit = $this->model_maincat->create1($data1);


        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('products/', 'refresh');
        	}
        	else {
        		    $this->session->set_flashdata('errors', 'Error occurred!!');
        		    redirect('products/create', 'refresh');
        	}
        }
        else {
           
			$this->data['category'] = $this->model_subcat->getActiveSubCategory();   
            $this->data['sub_category'] = $this->model_subcat->getActiveSubCategory();  

            $this->data['main_category'] = $this->model_maincat->getActiveMainCategoryData(); 

            $this->render_template('products/create', $this->data);
        }	
        }
        catch(Exception $e){
        	$this->session->set_flashdata('success', 'Data already exist in the database');
        	redirect('products/create', 'refresh');

        }
       
	}
	public function update($product_id)
	{      
        if(!in_array('updateProd', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        try{
        if(!$product_id) {
            redirect('dashboard', 'refresh');
        }

        $this->form_validation->set_rules('product_name', 'Product name', 'trim|required');
        $this->form_validation->set_rules('srp_value', 'Srp', 'trim|required');
        $this->form_validation->set_rules('cost', 'cost', 'trim|required');
        $this->form_validation->set_rules('active', 'active', 'trim|required');
        $this->form_validation->set_rules('markup_value', 'Markup', 'trim|required');


        if ($this->form_validation->run() == TRUE) {
            // true case
            
            $data = array(
                'name' => $this->input->post('product_name'),
                'srp' => $this->input->post('srp_value'),
                'cost' => $this->input->post('cost'),
                'description' => $this->input->post('description'),
                'sub_category_id' => json_encode($this->input->post('sub_category')),
                'markup' => $this->input->post('markup_value'),
                'active' => $this->input->post('active'),
                'lead_time' => $this->input->post('lead_time'),
                'daily_use' => $this->input->post('daily_use'),
                'safety_stock' => $this->input->post('safety_stock_value'),
                'rop' => $this->input->post('reorderpoint_value'),
            );

           


            $update = $this->model_products->update($data, $product_id);
            if($update == true) {
                $user_id = $this->session->userdata('id');
                //audit trail
                $data1 = array(
                    'date_time' => strtotime(date('Y-m-d h:i:s a')),
                    'user_id' => $user_id,
                    'action_made' => 'Updated ['.$this->input->post('product_name').'] in the Product list',
                );

                $audit = $this->model_maincat->create1($data1);


                $this->session->set_flashdata('success', 'Successfully updated');
                redirect('products/', 'refresh');
            }
            else {
                $this->session->set_flashdata('errors', 'Error occurred!!');
                redirect('products/update/'.$product_id, 'refresh');
            }
        }
        else {
                    
            $this->data['category'] = $this->model_subcat->getActiveSubCategory();           
            $this->data['sub_category'] = $this->model_subcat->getActiveSubCategory();  
             $this->data['main_category'] = $this->model_maincat->getActiveMainCategoryData(); 
            $category_data = $this->model_subcat->getSubCatData();
            $product_data = $this->model_products->getProductData($product_id);
            $this->data['product_data'] = $product_data;
          //  print_r($product_data);die;

            $this->render_template('products/edit', $this->data); 
        }   
        }
        catch(Exception $e){
           $this->session->set_flashdata('success', 'Data already exist in the database');
            redirect('products/update/'.$product_id, 'refresh');

        }
	}

	public function remove()
	{
        if(!in_array('deleteProd', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
        $product_id = $this->input->post('product_id');
        $prod1 = $this->model_products->getProductData($product_id);
          


        $response = array();
        if($product_id) {
            $delete = $this->model_products->remove($product_id);
            if($delete == true) {
                $user_id = $this->session->userdata('id');
                //audit trail
                $data1 = array(
                    'date_time' => strtotime(date('Y-m-d h:i:s a')),
                    'user_id' => $user_id,
                    'action_made' => 'Deleted [name = '.$prod1['name'].'] in the Product list',
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
    public function fetchProductData1()
	{
        if(!in_array('viewProd', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
		$result = array('data' => array());

		$data = $this->model_products->getProductData();

		foreach ($data as $key => $value) {
           
            $availability = ($value['active'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';

			$result['data'][$key] = array(
				$value['name'],
				$value['cost'],
                $value['markup'],
                $value['srp'],
                $availability,
			);
		} // /foreach

		echo json_encode($result);
	}	
     public function fetchProductData10()
	{
        if(!in_array('viewProd', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
		$result = array('data' => array());

		$data = $this->model_products->getProductData500();

		foreach ($data as $key => $value) {
           
            $availability = ($value['active'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';

			$result['data'][$key] = array(
				$value['name'],
				$value['qty'],
                $availability,
			);
		} // /foreach

		echo json_encode($result);
	}	

}