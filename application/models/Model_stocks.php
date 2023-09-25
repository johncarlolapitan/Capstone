<?php 

class Model_stocks extends CI_Model
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_tables');
		$this->load->model('model_users');
		$this->load->model('model_products');
		$this->load->model('model_orders');
		$this->load->model('model_maincat');
	}
	public function getOrderlistData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM orderlist WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$user_id = $this->session->userdata('id');
		if($user_id == 1) {
			$sql = "SELECT * FROM orderlist WHERE ro_code IS NOT NULL ORDER BY id DESC";
			$query = $this->db->query($sql);
			return $query->result_array();
		}
		else {
			$sql = "SELECT * FROM orderlist WHERE ro_code IS NOT NULL ORDER BY id DESC";
			$query = $this->db->query($sql);
			$user_data = $this->model_users->getUserData($user_id);
			return $query->result_array();	
		}
	}
	public function getStockadjusmentData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM stockadjustment_info WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$user_id = $this->session->userdata('id');
		if($user_id == 1) {
			$sql = "SELECT * FROM stockadjustment_info ORDER BY id DESC";
			$query = $this->db->query($sql);
			return $query->result_array();
		}
		else {
			$sql = "SELECT * FROM stockadjustment_info ORDER BY id DESC";
			$query = $this->db->query($sql);
			$user_data = $this->model_users->getUserData($user_id);
			return $query->result_array();	
		}
	}
	public function getOrderlistItemData($order_id = null)
	{
		if(!$order_id) {
			return false;
		}

		$sql = "SELECT * FROM orderlist_items WHERE orderlist_id = ?";
		$query = $this->db->query($sql, array($order_id));
		return $query->result_array();
	}
	public function update($id)
	{
		if($id) {
			$user_id = $this->session->userdata('id');
			$user_data = $this->model_users->getUserData($user_id);
			// update the table info

			$order_data = $this->getOrderlistData($id);

			$stcode = 'STCODE-'.strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 4));
			$data = array(
				'st_code' => $stcode,
	    		'user_id' => $user_id,
				'st_status' => $this->input->post('status'),
				'remarks' => $this->input->post('remarks'),
				'st_exp_date' => strtotime(date($this->input->post('exp_date'))),
	    	);

			$this->db->where('id', $id);
			$update = $this->db->update('orderlist', $data);

			// now remove the order item data 
			$this->db->where('orderlist_id', $id);
			$this->db->delete('orderlist_items');

			$count_product = count($this->input->post('product'));
	    	for($x = 0; $x < $count_product; $x++) {
	    		$items = array(
	    			'orderlist_id' => $id,
	    			'product_id' => $this->input->post('product')[$x],
	    			'qty' => $this->input->post('qty')[$x],
	    			
	    		);

				$prodid = $this->input->post('product')[$x];

				//print_r($prodid);die;
					
				//$this->db->set('qty', 'qty+1', FALSE);
				//$this->db->where('id', $prodid);
				//$this->db->update('products');
			
				if($prodid){	
					$product_data = $this->model_products->getProductData([$prodid]); 
					$items1 = array(
					'st_code' => $stcode,
	    			'product_id' => $this->input->post('product')[$x],
					'product_name' => $product_data['name'],
	    			'qty' => $this->input->post('qty')[$x],
	    			'date_added' => strtotime(date('Y-m-d h:i:s a')),
					'expiration_date' => strtotime(date($this->input->post('exp_date'))),
					'active' => 1,
	    			);
					$inputQuantity = (int)$this->input->post('qty')[$x];
					$this->db->where('id', $prodid);
					$this->db->set('qty', "qty+$inputQuantity", false);
					$this->db->update('products');

					$this->db->insert('product_inventory', $items1);
					$this->db->insert('stock_history', $items1);
				}
		


				//////CHECKPOINT////
				//print_r($prodid);die;
				//$update = $this->model_products->update($product_quanti, $prodid);
		
				

	    		$this->db->insert('orderlist_items', $items);


				$user_id = $this->session->userdata('id');
						//audit trail
						$data1 = array(
							'date_time' => strtotime(date('Y-m-d h:i:s a')),
							'user_id' => $user_id,
							'action_made' => 'Updated [RO No = '.$order_data['ro_code'].'] in the Stock Transfer List',
						);

				$audit = $this->model_maincat->create1($data1);
	    	}
			




			return true;
		}
	}

	public function update2($id)
	{
		$user_id = $this->session->userdata('id');
		// get store id from user id 
		$user_data = $this->model_users->getUserData($user_id);
		$count_product = count($this->input->post('product'));
    	for($x = 0; $x < $count_product; $x++) {
			$prodid = $this->input->post('product')[$x];
			$inputQuantity = (int)$this->input->post('qty')[$x];
			$check = $this->model_stocks->check_stock($prodid, $inputQuantity);
			if($check == TRUE){
				$data1 = array(
					'sa_code' => $this->input->post('st_code'),
	   				'user_id' => $user_id,
					'st_status' => 1,
					'date_time' => strtotime(date('Y-m-d h:i:s a')),
					'remarks' => $this->input->post('remarks'),
				);
				$insert = $this->db->insert('stockadjustment_info', $data1);
				$user_id = $this->session->userdata('id');
						//audit trail
						$data1 = array(
							'date_time' => strtotime(date('Y-m-d h:i:s a')),
							'user_id' => $user_id,
							'action_made' => 'Removed some stocks of [ST No = '.$this->input->post('st_code').'] in the Stock Adjusment',
						);

				$audit = $this->model_maincat->create1($data1);

				$order_id = $this->db->insert_id();
				$count_product = count($this->input->post('product'));
				for($x = 0; $x < $count_product; $x++) {
	    			$items = array(
	    				'orderlist_id' => $order_id,
	    				'product_id' => $this->input->post('product')[$x],
	    				'qty' => $this->input->post('qty')[$x],
	    		
	   				);
					$prodid = $this->input->post('product')[$x];
					if($prodid){	
						$product_data = $this->model_products->getProductData([$prodid]); 
						$items1 = array(
							'st_code' => $this->input->post('st_code'),
	    					'product_id' => $this->input->post('product')[$x],
							'product_name' => $product_data['name'],
							'qty' => $this->input->post('qty')[$x],
	    					'date_added' => strtotime(date('Y-m-d h:i:s a')),
							'active' => 1,
	    				);
						if($prodid){
							$inputQuantity = (int)$this->input->post('qty')[$x];
							$this->model_stocks->decrementItem($prodid, $inputQuantity);
							$this->model_stocks->decrementItem1($prodid, $inputQuantity);
						}

						$this->db->insert('stock_history', $items1);
					}
	    			$this->db->insert('orderlist_items', $items);
					


	   			}
				return true;
			}
			else{
				return false;
			}
		}
	}
	public function check_stock($productId, $inputQuantity)
	{
	   $product = $this->db->get_where('products', ['id' => $productId])->row();
   
	   if(isset($product))
	   {
		  if($product->qty <= $inputQuantity)
		  {
			  echo '<script>alert("NO MORE STOCK");</script>';
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
	public function update1($id)
	{
		$user_id = $this->session->userdata('id');
		// get store id from user id 
		$user_data = $this->model_users->getUserData($user_id);

		$data1 = array(
			'sa_code' => $this->input->post('st_code'),
	   		'user_id' => $user_id,
			'st_status' => 1,
			'date_time' => strtotime(date('Y-m-d h:i:s a')),
			'remarks' => $this->input->post('remarks'),
	    );
		


		$insert = $this->db->insert('stockadjustment_info', $data1);
		$order_id = $this->db->insert_id();
		$count_product = count($this->input->post('product'));
	    for($x = 0; $x < $count_product; $x++) {
	    	$items = array(
	    		'orderlist_id' => $order_id,
	    		'product_id' => $this->input->post('product')[$x],
	    		'qty' => $this->input->post('qty')[$x],
	    		
	   		);
			$prodid = $this->input->post('product')[$x];
			if($prodid){	
				$product_data = $this->model_products->getProductData([$prodid]); 
				$items1 = array(
					'st_code' => $this->input->post('st_code'),
	    			'product_id' => $this->input->post('product')[$x],
					'product_name' => $product_data['name'],
					'qty' => $this->input->post('qty')[$x],
	    			'date_added' => strtotime(date('Y-m-d h:i:s a')),
					'expiration_date' => strtotime(date($this->input->post('exp_date'))),
					'active' => 1,
	    		);
				$inputQuantity = (int)$this->input->post('qty')[$x];
				$this->db->where('id', $prodid);
				$this->db->set('qty', "qty+$inputQuantity", false);
				$this->db->update('products');

				$this->db->insert('product_inventory', $items1);
				$this->db->insert('stock_history', $items1);
			}
	    	$this->db->insert('orderlist_items', $items);
			

	   	}
		return true;
	}
	public function countOrderlistItem($order_id)
	{
		if($order_id) {
			$sql = "SELECT * FROM orderlist_items WHERE orderlist_id = ?";
			$query = $this->db->query($sql, array($order_id));
			return $query->num_rows();
		}
	}
	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('orderlist');

			$this->db->where('orderlist_id', $id);
			$delete_item = $this->db->delete('orderlist_items');
			return ($delete == true && $delete_item) ? true : false;
		}
	}
	public function countTotalOrders()
	{
		$sql = "SELECT * FROM orderlist";
		$query = $this->db->query($sql, array(1));
		return $query->num_rows();
	}

}