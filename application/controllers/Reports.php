<?php  

defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends Admin_Controller 
{	
	public function __construct()
	{
		parent::__construct();
		$this->data['page_title'] = 'Reports';
		$this->load->model('model_reports');
		$this->load->model('model_orders');
		$this->load->model('model_products');
		$this->load->model('model_company');
		$this->load->model('model_productstock');
		$this->load->model('model_stocks');
		$this->load->model('model_users');
		$this->load->model('model_maincat');
	}

	/* 
    * It redirects to the report page
    * and based on the year, all the orders data are fetch from the database.
    */
	public function index()
	{
		if(!in_array('viewReport', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
		
		$today_year = date('Y');

		if($this->input->post('select_year')) {
			$today_year = $this->input->post('select_year');
		}

		$order_data = $this->model_reports->getOrderData($today_year);
		$this->data['report_years'] = $this->model_reports->getOrderYear();
		

		$final_order_data = array();
		foreach ($order_data as $k => $v) {
			
			if(count($v) > 1) {
				$total_amount_earned = array();
				foreach ($v as $k2 => $v2) {
					if($v2) {
						$total_amount_earned[] = $v2['net_amount'];						
					}
				}
				$final_order_data[$k] = array_sum($total_amount_earned);	
			}
			else {
				$final_order_data[$k] = 0;	
			}
			
		}
		
		$this->data['selected_year'] = $today_year;
		$this->data['company_currency'] = $this->company_currency();
		$this->data['results'] = $final_order_data;
		
		$this->render_template('reports/index', $this->data);
	}

	public function saleshistory(){
		if(!in_array('viewReport', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
		
		$this->render_template('reports/saleshistory', $this->data);
	

	}
	public function audit(){
		if(!in_array('viewReport', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
		
		$this->render_template('reports/audit', $this->data);
	}
	public function stock(){
		if(!in_array('viewReport', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
		
		$this->render_template('reports/stock', $this->data);
	
	}
	public function exp(){
		if(!in_array('viewReport', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
		
		$this->render_template('reports/exp', $this->data);
	
	}
	public function stockhistory(){
		if(!in_array('viewReport', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
		
		$this->render_template('reports/stockhistory', $this->data);
	}
	public function topprod(){
		if(!in_array('viewReport', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
		$piechartcaloy = $this->model_reports->pieChart();
		$this->data['piechartcaloy'] = $piechartcaloy;
		$this->render_template('reports/topprod', $this->data);
	}
	public function topcat(){
		if(!in_array('viewReport', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
		$piechartcaloy = $this->model_reports->pieChart1();
		$this->data['piechartcaloy'] = $piechartcaloy;
		$this->render_template('reports/topcat', $this->data);
	}
	public function prodlist(){
		if(!in_array('viewReport', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
		
		$this->render_template('reports/prodlist', $this->data);
	}
	public function fetchOrdersData1()
	{
		if(!in_array('viewOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$result = array('data' => array());

		$data = $this->model_orders->getOrdersData();

		foreach ($data as $key => $value) {

			date_default_timezone_set("Asia/Manila");
			$count_total_item = $this->model_orders->countOrderItem($value['id']);
			$date = date('d-m-Y', $value['date_time']);
			$time = date('h:i a', $value['date_time']);

			$date_time = $date . ' ' . $time;

			// button
			$buttons = '';

			if(in_array('viewOrder', $this->permission)) {
				$buttons .= '<a target="__blank" href="'.base_url('orders/printDiv/'.$value['id']).'" class="btn btn-warning"><i class="fa fa-print"></i></a>';
			}

			if($value['paid_status'] == 1) {
				$paid_status = '<span class="label label-success">Paid</span>';	
			}
			else if($value['paid_status'] == 2) {
				$paid_status = '<span class="label label-warning">Partially Paid</span>';	
			}
			else {
				$paid_status = '<span class="label label-danger">Not Paid</span>';
			}

			$result['data'][$key] = array(
				$value['bill_no'],
				$date_time,
				$count_total_item,
				$value['net_amount'],
				$paid_status,
				$value['remarks'],
				$buttons
			);
		} // /foreach	

		echo json_encode($result);
	}
	public function fetchAuditData()
	{
		if(!in_array('viewOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$result = array('data' => array());

		$data = $this->model_orders->getOrdersData100();

		foreach ($data as $key => $value) {

			date_default_timezone_set("Asia/Manila");
			$date = date('d-m-Y', $value['date_time']);
			$time = date('h:i a', $value['date_time']);

			$date_time = $date . ' ' . $time;
			$userinfo = $this->model_users->getUserData($value['user_id']);
			$result['data'][$key] = array(
				$date_time,
				$userinfo['username'],
				$value['action_made'],
			);
		} // /foreach	

		echo json_encode($result);
	}

	public function fetchOrdersData2()
	{
		if(!in_array('viewOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$result = array('data' => array());

		$data = $this->model_reports->getTopData();
		foreach ($data as $key => $value) {
			$result['data'][$key] = array(
				$value['product_name'],
				$value['COUNT(product_id)'],
				$value['SUM(amount)'],
			);	
		}
		echo json_encode($result);
	}
	public function fetchOrdersData3()
	{
		if(!in_array('viewOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$result = array('data' => array());

		$data = $this->model_reports->getLowData();
		foreach ($data as $key => $value) {
			$result['data'][$key] = array(
				$value['product_name'],
				$value['COUNT(product_id)'],
				$value['SUM(amount)'],
			);	
		}
		echo json_encode($result);
	}
	public function fetchOrdersData4()
	{
		if(!in_array('viewOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$result = array('data' => array());

		$data = $this->model_reports->getTopCatData();
		foreach ($data as $key => $value) {
			$result['data'][$key] = array(
				$value['subcat_name'],
				$value['COUNT(product_id)'],
			);	
		}
		echo json_encode($result);
	}
	public function fetchOrdersData5()
	{
		if(!in_array('viewOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$result = array('data' => array());

		$data = $this->model_reports->getTopCatData1();
		foreach ($data as $key => $value) {
			$result['data'][$key] = array(
				$value['subcat_name'],
				$value['COUNT(product_id)'],
			);	
		}
		echo json_encode($result);
	}
	public function valuation(){
		if(!in_array('viewReport', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
		
		$this->render_template('reports/valuation', $this->data);
	}
	public function printDiv1()
	{

	   $user_id = $this->session->userdata('id');
                //audit trail
                $data1 = array(
                    'date_time' => strtotime(date('Y-m-d h:i:s a')),
                    'user_id' => $user_id,
                    'action_made' => 'Generate Report For Inventory Valuation',
                );

       $audit = $this->model_maincat->create1($data1);
	    $user_info = $this->model_users->getUserData($user_id);

		$company_info = $this->model_company->getCompanyData(1);
		if(!in_array('viewOrder', $this->permission)) {
          	redirect('dashboard', 'refresh');
  		}
        $product = $this->model_products->getProductData();
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
					<div>
						<img src='.base_url('assets/dist/img/logo.png').' width="100" height="100"></img>
					</div>
			        <h2 class="page-header">
			          '.$company_info['company_name'].'
			        </h2>
				<div class="col-sm-4 invoice-col">
			        <b>Bubble Bee Food Hub <br></b> '.$company_info['address'].'<br>
					<b>Phone Number: <br></b> '.$company_info['phone'].'<br><br>
			      </div>
				</div>
			      <!-- /.col -->
			    </div>
			    <!-- info row -->
			    <div class="row invoice-info">
			      
			      <div class="col-sm-4 invoice-col">
			      </div>
			      <!-- /.col -->
			    </div>
			    <!-- /.row -->
				<h1> Inventory Valuation </h1>
				<br><br><hr>
			    <!-- Table row -->
			    <div class="row">
			      <div class="col-xs-12 table-responsive">
			        <table class="table table-striped">
			          <thead>
			          <tr>
			            <th>Product name</th>
			            <th>Cost</th>
						<th>Markup</th>
						<th>SRP</th>
			          </tr>
			          </thead>
			          <tbody>'; 
			          foreach ($product as $k => $v) {			          	
			          	$html .= '<tr>
				            <td>'.$v['name'].'</td>
				            <td>'.$v['cost'].'</td>
							<td>'.$v['markup'].'</td>
				            <td>'.$v['srp'].'</td>

			          	</tr>';
			          }
			          
			          $html .= '</tbody>
			        </table>
			      </div>
			      <!-- /.col -->
			    </div>
			    <!-- /.row -->
				<div style="text-align:center;">
				<hr>
					<b>Issued By: </b> '.$user_info['firstname'].' '.$user_info['lastname'].'<br><br>
				</div>
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
	public function printDiv10()
	{
	   $user_id = $this->session->userdata('id');
                //audit trail
                $data1 = array(
                    'date_time' => strtotime(date('Y-m-d h:i:s a')),
                    'user_id' => $user_id,
                    'action_made' => 'Generate Report For Product Master List',
                );

       $audit = $this->model_maincat->create1($data1);
	   $user_info = $this->model_users->getUserData($user_id);

		$company_info = $this->model_company->getCompanyData(1);
		if(!in_array('viewOrder', $this->permission)) {
          	redirect('dashboard', 'refresh');
  		}
        $product = $this->model_products->getProductData30();
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
					<div>
						<img src='.base_url('assets/dist/img/logo.png').' width="100" height="100"></img>
					</div>
			        <h2 class="page-header">
			          '.$company_info['company_name'].'
			        </h2>
				<div class="col-sm-4 invoice-col">
			        <b>Bubble Bee Food Hub <br></b> '.$company_info['address'].'<br>
					<b>Phone Number: <br></b> '.$company_info['phone'].'<br><br>
			      </div>
				</div>
			      <!-- /.col -->
			    </div>
			    <!-- info row -->
			    <div class="row invoice-info">
			      
			      <div class="col-sm-4 invoice-col">
			      </div>
			      <!-- /.col -->
			    </div>
			    <!-- /.row -->
				<h1> Products Master List </h1>
				<br><br><hr>
			    <!-- Table row -->
			    <div class="row">
			      <div class="col-xs-12 table-responsive">
			        <table class="table table-striped">
			          <thead>
			          <tr>
			            <th>Product name</th>
			            <th>Quantity</th>
			          </tr>
			          </thead>
			          <tbody>'; 
			          foreach ($product as $k => $v) {			          	
			          	$html .= '<tr>
				            <td>'.$v['name'].'</td>
				            <td>'.$v['qty'].'</td>

			          	</tr>';
			          }
			          
			          $html .= '</tbody>
			        </table>
			      </div>
			      <!-- /.col -->
			    </div>
			    <!-- /.row -->
				<div style="text-align:center;">
				<hr>
					<b>Issued By: </b> '.$user_info['firstname'].' '.$user_info['lastname'].'<br><br>
				</div>
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
public function printDiv2()
	{
		 $user_id = $this->session->userdata('id');
                //audit trail
                $data1 = array(
                    'date_time' => strtotime(date('Y-m-d h:i:s a')),
                    'user_id' => $user_id,
                    'action_made' => 'Generate Report For Stock Adjustment',
                );

       $audit = $this->model_maincat->create1($data1);
	   $user_info = $this->model_users->getUserData($user_id);
		$company_info = $this->model_company->getCompanyData(1);
		if(!in_array('viewOrder', $this->permission)) {
          	redirect('dashboard', 'refresh');
  		}
        $product = $this->model_stocks->getStockadjusmentData();
		$data = $this->model_stocks->getOrderlistData();

		foreach ($data as $key => $value) {
		$count_total_item = $this->model_stocks->countOrderlistItem($value['id']);


		//$date_time = date( 'Y-m-d H:i:s', $final);
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
					<div>
						<img src='.base_url('assets/dist/img/logo.png').' width="100" height="100"></img>
					</div>
			        <h2 class="page-header">
			          '.$company_info['company_name'].'
			        </h2>
				<div class="col-sm-4 invoice-col">
			        <b>Bubble Bee Food Hub <br></b> '.$company_info['address'].'<br>
					<b>Phone Number: <br></b> '.$company_info['phone'].'<br><br>
			      </div>
				</div>
			      <!-- /.col -->
			    </div>
			    <!-- info row -->
			    <div class="row invoice-info">
			      
			      <div class="col-sm-4 invoice-col">
			      </div>
			      <!-- /.col -->
			    </div>
			    <!-- /.row -->
				<h1> Stock Adjustment History Valuation </h1>
				<br><br><hr>
			    <!-- Table row -->
			    <div class="row">
			      <div class="col-xs-12 table-responsive">
			        <table class="table table-striped">
			          <thead>
			          <tr>
			            <th>SA Code</th>
						<th>Total Items</th>
						<th>Remarks</th>
			          </tr>
			          </thead>
			          <tbody>'; 
			          foreach ($product as $k => $v) {			          	
			          	$html .= '<tr>
				            <td>'.$v['sa_code'].'</td>
							<td>'.$count_total_item.'</td>
				            <td>'.$v['remarks'].'</td>

			          	</tr>';
			          }
			          
			          $html .= '</tbody>
			        </table>
			      </div>
			      <!-- /.col -->
			    </div>
			    <!-- /.row -->
				<div style="text-align:center;">
				<hr>
					<b>Issued By: </b> '.$user_info['firstname'].' '.$user_info['lastname'].'<br><br>
				</div>
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
	public function printDiv3()
	{
		$company_info = $this->model_company->getCompanyData(1);
		if(!in_array('viewOrder', $this->permission)) {
          	redirect('dashboard', 'refresh');
  		}
        $product = $this->model_productstock->getExpProd();
	

		//$date_time = date( 'Y-m-d H:i:s', $final);
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
					<div>
						<img src='.base_url('assets/dist/img/logo.png').' width="100" height="100"></img>
					</div>
			        <h2 class="page-header">
			          '.$company_info['company_name'].'
			        </h2>
				<div class="col-sm-4 invoice-col">
			        <b>Bubble Bee Food Hub <br></b> '.$company_info['address'].'<br>
					<b>Phone Number: <br></b> '.$company_info['phone'].'<br><br>
			      </div>
				</div>
			      <!-- /.col -->
			    </div>
			    <!-- info row -->
			    <div class="row invoice-info">
			      
			      <div class="col-sm-4 invoice-col">
			      </div>
			      <!-- /.col -->
			    </div>
			    <!-- /.row -->
				<h1> Stock Adjustment History Valuation </h1>
				<br><br><hr>
			    <!-- Table row -->
			    <div class="row">
			      <div class="col-xs-12 table-responsive">
			        <table class="table table-striped">
			          <thead>
			          <tr>
			            <th>ST Code</th>
						<th>Available Quantity</th>
						<th>Product Name</th>
						<th>Status </th>
			          </tr>
			          </thead>
			          <tbody>'; 
			          foreach ($product as $k => $v) {			          	
			          	$html .= '<tr>
				            <td>'.$v['st_code'].'</td>
							<td>'.$v['qty'].'</td>
				            <td>'.$v['product_name'].'</td>
							<td>Expired</td>
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
	public function printDiv100()
	{
		$company_info = $this->model_company->getCompanyData(1);
		if(!in_array('viewOrder', $this->permission)) {
          	redirect('dashboard', 'refresh');
  		}
        $product = $this->model_orders->getOrdersData100();
	
		 $user_id = $this->session->userdata('id');
                //audit trail
                $data1 = array(
                    'date_time' => strtotime(date('Y-m-d h:i:s a')),
                    'user_id' => $user_id,
                    'action_made' => 'Generate Report For Audit Trail',
                );
		$user_info = $this->model_users->getUserData($user_id);
       $audit = $this->model_maincat->create1($data1);
		//$date_time = date( 'Y-m-d H:i:s', $final);
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
					<div>
						<img src='.base_url('assets/dist/img/logo.png').' width="100" height="100"></img>
					</div>
			        <h2 class="page-header">
			          '.$company_info['company_name'].'
			        </h2>
				<div class="col-sm-4 invoice-col">
			        <b>Bubble Bee Food Hub <br></b> '.$company_info['address'].'<br>
					<b>Phone Number: <br></b> '.$company_info['phone'].'<br><br>
			      </div>
				</div>
			      <!-- /.col -->
			    </div>
			    <!-- info row -->
			    <div class="row invoice-info">
			      
			      <div class="col-sm-4 invoice-col">
			      </div>
			      <!-- /.col -->
			    </div>
			    <!-- /.row -->
				<h1> Stock Adjustment History Valuation </h1>
				<br><br><hr>
			    <!-- Table row -->
			    <div class="row">
			      <div class="col-xs-12 table-responsive">
			        <table class="table table-striped">
			          <thead>
			          <tr>
			            <th>Date Time</th>
						<th>Username</th>
						<th>Action Made</th>
			          </tr>
			          </thead>
			          <tbody>'; 
			          foreach ($product as $k => $v) {			          	
			          	$html .= '<tr>
				            <td>'.$v['date_time'].'</td>
							<td>'.$v['user_id'].'</td>
				            <td>'.$v['action_made'].'</td>
			          	</tr>';
			          }
			          
			          $html .= '</tbody>
			        </table>
			      </div>
			      <!-- /.col -->
			    </div>
			    <!-- /.row -->
				<div style="text-align:center;">
				<hr>
					<b>Issued By: </b> '.$user_info['firstname'].' '.$user_info['lastname'].'<br><br>
				</div>
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