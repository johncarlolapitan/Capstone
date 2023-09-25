<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Stock extends Admin_Controller 
{
	var $currency_code = '';

	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Stock Transfer';

		$this->load->model('model_stocks');
		$this->load->model('model_tables');
		$this->load->model('model_products');
		$this->load->model('model_company');
		$this->load->model('model_discount');

		$this->currency_code = $this->company_currency();
	}

	/* 
	* It only redirects to the manage order page
	*/
	public function index()
	{
		if(!in_array('viewStocktransfer', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->data['page_title'] = 'Manage Request Order';
		$this->render_template('stock/index', $this->data);		
	}

	/*
	* Fetches the orders data from the orders table 
	* this function is called from the datatable ajax function
	*/
	public function fetchOrdersData()
	{
		if(!in_array('viewStocktransfer', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$result = array('data' => array());

		$data = $this->model_stocks->getOrderlistData();

		foreach ($data as $key => $value) {


			$count_total_item = $this->model_stocks->countOrderlistItem($value['id']);
			$date = date('d-m-Y', $value['date_time']);
			$time = date('h:i a', $value['date_time']);

			$date_time = $date . ' ' . $time;

			// button
			$buttons = '';

			if(in_array('viewStocktransfer', $this->permission)) {
				$buttons .= '<a target="__blank" href="'.base_url('stock/printDiv/'.$value['id']).'" class="btn btn-warning"><i class="fa fa-print"></i></a>';
			}

			if(in_array('updateStocktransfer', $this->permission)) {
				$buttons .= ($value['st_status'] == 1) ? ' <a style="display:none;" href="'.base_url('stock/update/'.$value['id']).'" class="btn btn-info"><i class="fa fa-pencil"></i></a>' : '<a href="'.base_url('stock/update/'.$value['id']).'" class="btn btn-info"><i class="fa fa-pencil"></i></a>';
			}


			if(in_array('deleteStocktransfer', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-danger" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
			}
			if($value['st_status'] == 1) {
				$status = '<span class="label label-success">Received</span>';	
			}
			else {
				$status = '<span class="label label-danger">Pending</span>';
			}

			$result['data'][$key] = array(
				$value['st_code'],
				$value['ro_code'],
				$date_time,
				$count_total_item,
				$value['remarks'],
				$status,				
				$buttons
			);
		} // /foreach	

		echo json_encode($result);
	}

	/*
	* If the validation is not valid, then it redirects to the create page.
	* If the validation for each input field is valid then it inserts the data into the database 
	* and it stores the operation message into the session flashdata and display on the manage group page
	*/
	
	public function update($id)
	{
		if(!in_array('updateStocktransfer', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		if(!$id) {
			redirect('dashboard', 'refresh');
		}

		$this->data['page_title'] = 'Update Request Order';

		$this->form_validation->set_rules('product[]', 'Product name', 'trim|required');
		
	
        if ($this->form_validation->run() == TRUE) {        	

        	$update = $this->model_stocks->update($id);
        	
        	if($update == true) {

				

        		$this->session->set_flashdata('success', 'Successfully updated');
        		redirect('stock/update/'.$id, 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('stock/update/'.$id, 'refresh');
        	}
        }
        else {
           

        	$result = array();
        	$orders_data = $this->model_stocks->getOrderlistData($id);

        	if(empty($orders_data)) {
        		$this->session->set_flashdata('errors', 'The request data does not exists');
        		redirect('stock', 'refresh');
        	}

    		$result['stock'] = $orders_data;
    		$orders_item = $this->model_stocks->getOrderlistItemData($orders_data['id']);

    		foreach($orders_item as $k => $v) {
    			$result['orderlist_item'][] = $v;
    		}


    		$this->data['order_data'] = $result;

        	$this->data['products'] = $this->model_products->getActiveProductData();      	

       


            $this->render_template('stock/edit', $this->data);
        }
	}

	public function getProductValueById()
	{
		$product_id = $this->input->post('product_id');
		if($product_id) {
			$product_data = $this->model_products->getProductData($product_id);
			echo json_encode($product_data);
		}
	}
	public function getOrderListById()
	{
		$orderlist_id = $this->input->post('orderlist_id');
		if($orderlist_id) {
			$orderlist_data = $this->model_stocks->getOrderlistData($orderlist_id);
			echo json_encode($orderlist_data);
		}
	}

	public function getTableProductRow()
	{
		$products = $this->model_products->getActiveProductData();
		echo json_encode($products);
	}

	
	public function remove()
	{
		if(!in_array('deleteStocktransfer', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$order_id = $this->input->post('orderlist_id');
		$discinfo = $this->model_orderlist->getOrderlistData($order_id);
        $response = array();
        if($order_id) {
            $delete = $this->model_stocks->remove($order_id);
            if($delete == true) {

				$user_id = $this->session->userdata('id');
						//audit trail
						$data1 = array(
							'date_time' => strtotime(date('Y-m-d h:i:s a')),
							'user_id' => $user_id,
							'action_made' => 'Deleted [ST No = '.$discinfo['st_code'].'] in the Stock Transfer List',
				);

				$audit = $this->model_maincat->create1($data1);


                $response['success'] = true;
                $response['messages'] = "Successfully removed"; 
            }
            else {
                $response['success'] = false;
                $response['messages'] = "Error in the database while removing the product information";
            }
        }
        else {
            $response['success'] = false;
            $response['messages'] = "Refersh the page again!!";
        }

        echo json_encode($response); 
	}

	/*
	* It gets the product id and fetch the order data. 
	* The order print logic is done here 
	*/
	public function printDiv($id)
	{
		if(!in_array('viewStocktransfer', $this->permission)) {
          	redirect('dashboard', 'refresh');
  		}
        
		if($id) {
			$orderlist_data = $this->model_stocks->getOrderlistData($id);
			$orderlist_items = $this->model_stocks->getOrderlistItemData($id);
			$company_info = $this->model_company->getCompanyData(1);


			$order_date = date('d/m/Y', $orderlist_data['date_time']);


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
			<body onload="window.print();">
			
			<div class="wrapper">
			  <section class="invoice">
			    <!-- title row -->
			    <div class="row">
			      <div class="col-xs-12">
			        <h2 class="page-header">
			          '.$company_info['company_name'].'
			          <small class="pull-right">Date: '.$order_date.'</small>
			        </h2>
			      </div>
			      <!-- /.col -->
			    </div>
			    <!-- info row -->
			    <div class="row invoice-info">
			      
			      <div class="col-sm-4 invoice-col">
			        <b>OL Code: </b> '.$orderlist_data['ol_code'].'<br>
			        <b>Total items: </b> '.count($orderlist_items).'<br><br>
			      </div>
			      <!-- /.col -->
			    </div>
			    <!-- /.row -->

			    <!-- Table row -->
			    <div class="row">
			      <div class="col-xs-12 table-responsive">
			        <table class="table table-striped">
			          <thead>
			          <tr>
			            <th>Product name</th>
			            <th>Qty</th>
			          </tr>
			          </thead>
			          <tbody>'; 

			          foreach ($orderlist_items as $k => $v) {

			          	$product_data = $this->model_products->getProductData($v['product_id']); 
			          	
			          	$html .= '<tr>
				            <td>'.$product_data['name'].'</td>
				            <td>'.$v['qty'].'</td>

			          	</tr>';
			          }
			          
			          $html .= '</tbody>
			        </table>
			      </div>
			      <!-- /.col -->
			    </div>
			    <!-- /.row -->

			      <!-- /.col -->
			    </div>
			    <!-- /.row -->
			  </section>
			  <!-- /.content -->
			</div>
		</body>
	</html>';

			  echo $html;
		}
	}

}