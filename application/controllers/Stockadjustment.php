<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Stockadjustment extends Admin_Controller 
{
	var $currency_code = '';

	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Stock Adjustment';

		$this->load->model('model_stocks');
		$this->load->model('model_products');
		$this->load->model('model_company');
		$this->load->model('model_discount');

		$this->currency_code = $this->company_currency();
	}
	public function index()
	{
		if(!in_array('viewStockadjustment', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->data['page_title'] = 'Manage Stock Adjustment';
		$this->render_template('stockadjustment/index', $this->data);		
	}
	public function index2()
	{
		if(!in_array('viewStockadjustment', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->data['page_title'] = 'Manage Stock Adjustment';
		$this->render_template('stockadjustment/index2', $this->data);		
	}

	public function fetchOrdersData()
	{
		if(!in_array('viewStockadjustment', $this->permission)) {
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

			if(in_array('updateOrder', $this->permission)) {
				$buttons .= ' <a href="'.base_url('stockadjustment/update1/'.$value['id']).'" class="btn btn-success" title="Add Quantity"><i class="fa fa-plus"></i></a>';
			}
			if(in_array('updateOrder', $this->permission)) {
				$buttons .= ' <a href="'.base_url('stockadjustment/update2/'.$value['id']).'" class="btn btn-danger" title="Remove Quantity"><i class="fa fa-minus"></i></a>';
			}
			$result['data'][$key] = array(
				$value['st_code'],
				$date_time,
				$count_total_item,
				$value['remarks'],
				$buttons
			);
		} // /foreach	

		echo json_encode($result);
	}
	public function fetchOrdersData1()
	{
		if(!in_array('viewStockadjustment', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$result = array('data' => array());

		$data = $this->model_stocks->getStockadjusmentData();

		foreach ($data as $key => $value) {


			$count_total_item = $this->model_stocks->countOrderlistItem($value['id']);
			$date = date('d-m-Y', $value['date_time']);
			$time = date('h:i a', $value['date_time']);

			$date_time = $date . ' ' . $time;

			if($value['st_status'] == 1) {
				$status = '<span class="label label-success">Processed</span>';	
			}
			else {
				$status = '<span class="label label-danger">Not Processed</span>';
			}

			$result['data'][$key] = array(
				$value['sa_code'],
				$date_time,
				$count_total_item,
				$value['remarks'],
				$status,
			);
		} // /foreach	

		echo json_encode($result);
	}
	public function update1($id)
	{
		if(!in_array('updateStockadjustment', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		if(!$id) {
			redirect('dashboard', 'refresh');
		}

		$this->data['page_title'] = 'Add Stock';

		$this->form_validation->set_rules('product[]', 'Product name', 'trim|required');
		
	
        if ($this->form_validation->run() == TRUE) {        	

        	$update = $this->model_stocks->update1($id);
        	
        	if($update == true) {
				$user_id = $this->session->userdata('id');
						//audit trail
						$data1 = array(
							'date_time' => strtotime(date('Y-m-d h:i:s a')),
							'user_id' => $user_id,
							'action_made' => 'Added Stocks of [ST No = '.$this->input->post('st_code').'] in the Stock Adjusment',
						);

				$audit = $this->model_maincat->create1($data1);


        		$this->session->set_flashdata('success', 'Successfully Added');
        		redirect('stockadjustment/index2', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('stockadjustment/update1/'.$id, 'refresh');
        	}
        }
        else {
        	$result = array();
        	$orders_data = $this->model_stocks->getOrderlistData($id);

        	if(empty($orders_data)) {
        		$this->session->set_flashdata('errors', 'The request data does not exists');
        		redirect('stockadjustment', 'refresh');
        	}

    		$result['stockadjustment'] = $orders_data;
    		$orders_item = $this->model_stocks->getOrderlistItemData($orders_data['id']);

    		foreach($orders_item as $k => $v) {
    			$result['orderlist_item'][] = $v;
    		}


    		$this->data['order_data'] = $result;

        	$this->data['products'] = $this->model_products->getActiveProductData();      	

       


            $this->render_template('stockadjustment/edit', $this->data);
        }
	}
	public function update2($id)
	{
		if(!in_array('updateStockadjustment', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		if(!$id) {
			redirect('dashboard', 'refresh');
		}

		$this->data['page_title'] = 'Remove Stock';

		$this->form_validation->set_rules('product[]', 'Product name', 'trim|required');
		
	
        if ($this->form_validation->run() == TRUE) {        	

        	$update = $this->model_stocks->update2($id);
        	
        	if($update == true) {
        		$this->session->set_flashdata('success', 'Successfully Remove');
        		redirect('stockadjustment/index2', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('stockadjustment/update2/'.$id, 'refresh');
        	}
        }
        else {
           

        	$result = array();
        	$orders_data = $this->model_stocks->getOrderlistData($id);

        	if(empty($orders_data)) {
        		$this->session->set_flashdata('errors', 'The request data does not exists');
        		redirect('stockadjustment', 'refresh');
        	}

    		$result['stockadjustment'] = $orders_data;
    		$orders_item = $this->model_stocks->getOrderlistItemData($orders_data['id']);

    		foreach($orders_item as $k => $v) {
    			$result['orderlist_item'][] = $v;
    		}


    		$this->data['order_data'] = $result;

        	$this->data['products'] = $this->model_products->getActiveProductData();      	

       


            $this->render_template('stockadjustment/edit1', $this->data);
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

}