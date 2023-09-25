<?php 

class Dashboard extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();


		$this->data['page_title'] = 'Dashboard';
		
		$this->load->model('model_products');
		$this->load->model('model_orders');
		$this->load->model('model_users');
		$this->load->model('model_reports');

	}

	public function index()
	{

		$this->data['total_products'] = $this->model_products->countTotalProducts();
		$this->data['total_paid_orders'] = $this->model_orders->countTotalPaidOrders();
		$this->data['total_unpaid_orders'] = $this->model_orders->countTotalUnPaidOrders();
		$this->data['total_orders'] = $this->model_orders->countTotalOrders();
		$this->data['total_users'] = $this->model_users->countTotalUsers();
		$this->data['total_group_users'] = $this->model_users->countTotalGroupUsers();
		$this->data['total_tables'] = $this->model_tables->countTotalTables();

		$user_id = $this->session->userdata('id');
		$is_admin = ($user_id == 1) ? true :false;

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
		$piechartcaloy = $this->model_reports->pieChart();
		$this->data['piechartcaloy'] = $piechartcaloy;
		$piechartcaloy = $this->model_reports->pieChart1();
		$this->data['piechartcaloy1'] = $piechartcaloy;

		$this->data['is_admin'] = $is_admin;
		$this->render_template('dashboard', $this->data);
	}
}