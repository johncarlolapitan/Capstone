<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Productstock extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Products Stocks';

		$this->load->model('model_productstock');
		$this->load->model('model_subcat');
        $this->load->model('model_maincat');

	}

    /* 
    * It only redirects to the manage product pagei
    */
	public function index()
	{
        if(!in_array('viewStock', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->render_template('productstock/index', $this->data);	
        $category_data = $this->model_subcat->getSubCatData();
        $this->data['category_data'] = $category_data;
        
      //  print_r($category_data);
	}
    public function index1()
	{
        if(!in_array('viewStock', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->render_template('productstock/index1', $this->data);	

        
      //  print_r($category_data);
	}
     public function index2()
	{
        if(!in_array('viewStock', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->render_template('productstock/index2', $this->data);	

        
      //  print_r($category_data);
	}
	public function fetchProductData()
	{
        if(!in_array('viewStock', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
		$result = array('data' => array());
        date_default_timezone_set("Asia/Manila");
		$data = $this->model_productstock->getProductData0();

		foreach ($data as $key => $value) {
            $date = date('d-m-Y', $value['date_added']);
			$time = date('h:i a', $value['date_added']);
            $date_time = $date . ' ' . $time;

            $datee = date('d-m-Y',(int)$value['expiration_date']);
            $date_time1 = $datee;

            $availability = ($value['active'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';

			$result['data'][$key] = array(
				$value['product_name'],
				$value['qty'],
                $date_time,
                $date_time1,
                $availability,

			);
		} // /foreach

		echo json_encode($result);
	}	
    
	public function fetchProductData1()
	{
        if(!in_array('viewStock', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
		$result = array('data' => array());
		$data = $this->model_productstock->getProductData1();
		foreach ($data as $key => $value) {
            if($value['rop'] >= $value['qty']){
                $availability = '<span class="label label-danger">Critical Stock</span> <script>$("#criticalStockModal").modal("show");</script>';	  
            }
            else{
                $availability = '<span class="label label-success">Healty Stock</span>';	
            }


			$result['data'][$key] = array(
				$value['name'],
				$value['qty'],
                $value['rop'],
                $availability,
			);
		} // /foreach
		echo json_encode($result);
	}	
    public function fetchProductData2()
	{
        if(!in_array('viewStock', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
		$result = array('data' => array());
        date_default_timezone_set("Asia/Manila");
		$data = $this->model_productstock->getProductData();

		foreach ($data as $key => $value) {
            $date = date('d-m-Y', $value['date_added']);
			$time = date('h:i a', $value['date_added']);
            $date_time = $date . ' ' . $time;

            $datee = date('d-m-Y',(int)$value['expiration_date']);
			$timee = date('h:i a', (int)$value['expiration_date']);
            $date_time1 = $datee . ' ' . $timee;

            if($value['date_added'] >= $value['expiration_date']){
                $availability = '<span class="label label-danger">Expired</span> <script>$("#criticalStockModal").modal("show");</script>';	
                
            }
            else{
                $availability = '<span class="label label-success">Not Expired</span>';	
            }

			$result['data'][$key] = array(
                $value['st_code'],
                $value['qty'],
				$value['product_name'],
                $date_time,
                $date_time1,
                $availability
			);
		} // /foreach

		echo json_encode($result);
	}	    
    /*
    * view the product based on the store 
    * the admin can view all the product information
    */
    public function viewproduct()
    {
         $user_id = $this->session->userdata('id');
                //audit trail
                $data1 = array(
                    'date_time' => strtotime(date('Y-m-d h:i:s a')),
                    'user_id' => $user_id,
                    'action_made' => 'Viewed Product Stock',
                );

       $audit = $this->model_maincat->create1($data1);

        if(!in_array('viewStock', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        $company_currency = $this->company_currency();
        // get all the category 
        $sub_category_data = $this->model_subcat->getSubCatData();

        $result = array();
        
        foreach ($sub_category_data as $k => $v) {
            $result[$k]['sub_category'] = $v;
            $result[$k]['products'] = $this->model_productstock->getProductDataByCat($v['id']);

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
                                                                <h5>'  . $p_value['qty'].'</h5>
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
    public function fetchProductData3()
	{
        if(!in_array('viewStock', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
		$result = array('data' => array());
		$data = $this->model_productstock->getProductData1();
		foreach ($data as $key => $value) {
            if($value['rop'] >= $value['qty']){
                $availability = '<span class="label label-danger">Critical Stock</span>';	  
            }
            else{
                $availability = '<span class="label label-success">Healty Stock</span>';	
            }


			$result['data'][$key] = array(
				$value['name'],
				$value['qty'],
                $value['rop'],
                $availability,
			);
		} // /foreach
		echo json_encode($result);
	}	
    public function fetchProductData6()
	{
        if(!in_array('viewStock', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
		$result = array('data' => array());
        date_default_timezone_set("Asia/Manila");
		$data = $this->model_productstock->getExpProd();

		foreach ($data as $key => $value) {
            $date = date('d-m-Y', $value['date_added']);
			$time = date('h:i a', $value['date_added']);
            $date_time = $date . ' ' . $time;

            $datee = date('d-m-Y',(int)$value['expiration_date']);
			$timee = date('h:i a', (int)$value['expiration_date']);
            $date_time1 = $datee . ' ' . $timee;

            if($value['date_added'] >= $value['expiration_date']){
                $availability = '<span class="label label-danger">Expired</span>';	
               
            }
            else{
                $availability = '<span class="label label-success">Not Expired</span>';	
            }

			$result['data'][$key] = array(
                $value['st_code'],
                $value['qty'],
				$value['product_name'],
                $date_time,
                $date_time1,
                $availability
			);
		} // /foreach

		echo json_encode($result);
	}	    
}