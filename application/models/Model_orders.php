<?php 

class Model_orders extends CI_Model
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_tables');
		$this->load->model('model_users');
		$this->load->model('model_products');
		$this->load->model('model_subcat');
		$this->load->model('model_maincat');
	}

	/* get the orders data */
	public function getOrdersData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM orders WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$user_id = $this->session->userdata('id');
		if($user_id == 1) {
			$sql = "SELECT * FROM orders ORDER BY id DESC LIMIT 100";
			$query = $this->db->query($sql);
			return $query->result_array();
		}
		else {
			$sql = "SELECT * FROM orders ORDER BY id DESC LIMIT 100";
			$query = $this->db->query($sql);
			$user_data = $this->model_users->getUserData($user_id);
			return $query->result_array();	
		}
	}
	public function getOrdersData100($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM audit WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$user_id = $this->session->userdata('id');
		if($user_id == 1) {
			$sql = "SELECT * FROM audit ORDER BY id DESC LIMIT 100";
			$query = $this->db->query($sql);
			return $query->result_array();
		}
		else {
			$sql = "SELECT * FROM audit ORDER BY id DESC LIMIT 100";
			$query = $this->db->query($sql);
			$user_data = $this->model_users->getUserData($user_id);
			return $query->result_array();	
		}
	}
	// get the orders item data
	public function getOrdersItemData($order_id = null)
	{
		if(!$order_id) {
			return false;
		}

		$sql = "SELECT * FROM order_items WHERE order_id = ?";
		$query = $this->db->query($sql, array($order_id));
		return $query->result_array();
	}

	public function create()
	{

		$user_id = $this->session->userdata('id');
		// get store id from user id 
		$user_data = $this->model_users->getUserData($user_id);
		
		$bill_no = 'BUBBLE-'.strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 4));
    	$data = array(
    		'bill_no' => $bill_no,
    		'date_time' => strtotime(date('Y-m-d h:i:s a')),
    		'gross_amount' => $this->input->post('gross_amount_value'),
    		'service_charge_rate' => $this->input->post('service_charge_rate'),
    		'service_charge_amount' => ($this->input->post('service_charge_value') > 0) ?$this->input->post('service_charge_value'):0,
    		'vat_charge_rate' => $this->input->post('vat_charge_rate'),
    		'vat_charge_amount' => ($this->input->post('vat_charge_value') > 0) ? $this->input->post('vat_charge_value') : 0,
    		'net_amount' => $this->input->post('net_amount_value'),
    		'discount' => $this->input->post('discount_amount_value'),
    		'paid_status' => 3,
    		'user_id' => $user_id,
    		'table_id' => $this->input->post('table_name'),
			'discount_id' => json_encode($this->input->post('discount')),
			'discount_percent' => $this->input->post('discount_perct_value'),
			'datetoday' => date('Y-m-d h:i:s a'),
			'payment_id' => json_encode($this->input->post('payment')),
			'vattable_amount' => $this->input->post('vattable_value'),

    	);
		$count_product = count($this->input->post('product'));
    	for($x = 0; $x < $count_product; $x++) {

			$prodid = $this->input->post('product')[$x];
			$prod_quan = $this->model_products->getProductData($prodid);

			$inputQuantity = (int)$this->input->post('qty')[$x];
			$check = $this->model_orders->check_stock($prodid, $inputQuantity);
			if($check == TRUE)
			{
				$insert = $this->db->insert('orders', $data);
				$order_id = $this->db->insert_id();

				$count_product = count($this->input->post('product'));
    			for($x = 0; $x < $count_product; $x++) {
    				$items = array(
    					'order_id' => $order_id,
    					'product_id' => $this->input->post('product')[$x],
    					'qty' => $this->input->post('qty')[$x],
    					'rate' => $this->input->post('rate_value')[$x],
    					'amount' => $this->input->post('amount_value')[$x],
    				);
						$this->db->insert('order_items', $items);
    			}
    			$this->load->model('model_tables');
    			$this->model_tables->update($this->input->post('table_name'), array('available' => 2));

				$user_id = $this->session->userdata('id');
                //audit trail
                $data1 = array(
                    'date_time' => strtotime(date('Y-m-d h:i:s a')),
                    'user_id' => $user_id,
                    'action_made' => 'Created [Bill No = '.$bill_no.'] in the Order list',
                );

                $audit = $this->model_maincat->create1($data1);


				return ($order_id) ? $order_id : false;
			}			
    		else
			{
				return false;
			}
		
		}
		
		
		
	}
	public function check_stock($productId, $inputQuantity)
	{
	   $product = $this->db->get_where('products', ['id' => $productId])->row();
   
	   if(isset($product))
	   {
		  if($product->qty < $inputQuantity)
		  {
			   $this->session->set_flashdata('error','No more stock on some selected items'); 
			   return false;
			   
		  }
		  else
		  {
			return true;
		  }
	   }
	}

	 public function decrementItem($productId, $inputQuantity){
       $q = "UPDATE products SET qty = qty - ? WHERE id = ?";
        
			$this->db->query($q, [$inputQuantity, $productId]);
			
			if($this->db->affected_rows() > 0){
				return TRUE;
			}
        
			else{
				return FALSE;
			}
    }
	/// checkpoint
	 public function decrementItem1($productId, $inputQuantity){
       $q = "UPDATE product_inventory SET qty = qty - ? WHERE product_id = ? LIMIT 1";
        
			$this->db->query($q, [$inputQuantity, $productId]);
			
			if($this->db->affected_rows() > 0){
				return TRUE;
			}
        
			else{
				return FALSE;
			}
    }
	public function countOrderItem($order_id)
	{
		if($order_id) {
			$sql = "SELECT * FROM order_items WHERE order_id = ? ";
			$query = $this->db->query($sql, array($order_id));
			return $query->num_rows();
		}
	}

	public function update($id)
	{
		if($id) {
			$user_id = $this->session->userdata('id');
			$user_data = $this->model_users->getUserData($user_id);

			$order_data = $this->getOrdersData($id);
			$data = $this->model_tables->update($order_data['table_id'], array('available' => 1));

			if($this->input->post('paid_status') == 1) {
	    		$this->model_tables->update($this->input->post('table_name'), array('available' => 1));	
	    	}
	    	else {
	    		$this->model_tables->update($this->input->post('table_name'), array('available' => 2));	
	    	}

			$data = array(
	    			'gross_amount' => $this->input->post('gross_amount_value'),
	    			'service_charge_rate' => $this->input->post('service_charge_rate'),
	    			'service_charge_amount' => ($this->input->post('service_charge_value') > 0) ?$this->input->post('service_charge_value'):0,
	    			'vat_charge_rate' => $this->input->post('vat_charge_rate'),
	    			'vat_charge_amount' => ($this->input->post('vat_charge_value') > 0) ? $this->input->post('vat_charge_value') : 0,
	    			'net_amount' => $this->input->post('net_amount_value'),
	    			'discount' => $this->input->post('discount_amount_value'),
	    			'user_id' => $user_id,
	    			'table_id' => $this->input->post('table_name'),
					'cash_tendered' => $this->input->post('cash_tendered'),
					'total_change' => ($this->input->post('change_value') > 0) ? $this->input->post('change_value') : 0,
					'discount_id' => json_encode($this->input->post('discount')),
					'discount_percent' => $this->input->post('discount_perct_value'),
					'remarks' => $this->input->post('remarks'),
					'payment_id' => json_encode($this->input->post('payment')),
					'paid_status' => 1,
					'reference_no' => $this->input->post('ref_num'),
					'senior_id' => $this->input->post('id_number'),
	    		);
			$count_product = count($this->input->post('product'));
    		for($x = 0; $x < $count_product; $x++) {
				$prodid = $this->input->post('product')[$x];
				$prod_quan = $this->model_products->getProductData($prodid);

				$inputQuantity = (int)$this->input->post('qty')[$x];
				$check = $this->model_orders->check_stock($prodid, $inputQuantity);
				if($check == TRUE){

					$this->db->where('id', $id);
					$update = $this->db->update('orders', $data);

					// now remove the order item data 
					$this->db->where('order_id', $id);
					$this->db->delete('order_items');

					$count_product = count($this->input->post('product'));
	    			for($x = 0; $x < $count_product; $x++) {
	    				$items = array(
	  						'order_id' => $id,
	   						'product_id' => $this->input->post('product')[$x],
							'product_name' => json_encode($prod_quan['name']),
							'subcat_name' => $prod_quan['sub_category_id'],
	   						'qty' => $this->input->post('qty')[$x],
	   						'rate' => $this->input->post('rate_value')[$x],
	   						'amount' => $this->input->post('amount_value')[$x],
	   					);
	    				$this->db->insert('order_items', $items);
						if($prodid){
							$inputQuantity = (int)$this->input->post('qty')[$x];
							$this->model_orders->decrementItem($prodid, $inputQuantity);
							$this->model_orders->decrementItem1($prodid, $inputQuantity);
						}
						$this->model_tables->update($this->input->post('table_name'), array('available' => 1));	
						$user_id = $this->session->userdata('id');
						//audit trail
						$data1 = array(
							'date_time' => strtotime(date('Y-m-d h:i:s a')),
							'user_id' => $user_id,
							'action_made' => 'Updated [Bill No = '.$order_data['bill_no'].'] in the Order list',
						);

						$audit = $this->model_maincat->create1($data1);


	    			}
				}
				else{
					return false;
				}
			}
			return true;
		}	
	}



	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('orders');

			$this->db->where('order_id', $id);
			$delete_item = $this->db->delete('order_items');
			return ($delete == true && $delete_item) ? true : false;
		}
	}

	public function countTotalPaidOrders()
	{
		$sql = "SELECT * FROM orders WHERE paid_status = ?";
		$query = $this->db->query($sql, array(1));
		return $query->num_rows();
	}

	public function countTotalOrders()
	{
		$sql = "SELECT * FROM orders";
		$query = $this->db->query($sql, array(1));
		return $query->num_rows();
	}

	public function countTotalUnPaidOrders()
	{
		$sql = "SELECT * FROM orders WHERE paid_status = 2";
		$query = $this->db->query($sql, array(1));
		return $query->num_rows();
	}

}