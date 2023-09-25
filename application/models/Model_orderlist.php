<?php 

class Model_orderlist extends CI_Model
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_tables');
		$this->load->model('model_users');
		$this->load->model('model_maincat');
	}

	/* get the orders data */
	public function getOrderlistData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM orderlist WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$user_id = $this->session->userdata('id');
		if($user_id == 1) {
			$sql = "SELECT * FROM orderlist ORDER BY id DESC";
			$query = $this->db->query($sql);
			return $query->result_array();
		}
		else {
			$sql = "SELECT * FROM orderlist ORDER BY id DESC";
			$query = $this->db->query($sql);
			$user_data = $this->model_users->getUserData($user_id);
			return $query->result_array();	
		}
	}

	// get the orders item data
	public function getOrderlistItemData($order_id = null)
	{
		if(!$order_id) {
			return false;
		}

		$sql = "SELECT * FROM orderlist_items WHERE orderlist_id = ?";
		$query = $this->db->query($sql, array($order_id));
		return $query->result_array();
	}

	
	public function create(){
		$user_id = $this->session->userdata('id');
		$user_data = $this->model_users->getUserData($user_id);

		$bill_no = 'OLCODE-'.strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 4));
    	$data = array(
    		'ol_code' => $bill_no,
    		'date_time' => strtotime(date('Y-m-d h:i:s a')),
    		'user_id' => $user_id,

    	);

		$insert = $this->db->insert('orderlist', $data);
		$order_id = $this->db->insert_id();

		$count_product = count($this->input->post('product'));
    	for($x = 0; $x < $count_product; $x++) {
    		$items = array(
    			'orderlist_id' => $order_id,
    			'product_id' => $this->input->post('product')[$x],
    			'qty' => $this->input->post('qty')[$x],
    			
    		);

    		$this->db->insert('orderlist_items', $items);
    	}
		$user_id = $this->session->userdata('id');
                //audit trail
                $data1 = array(
                    'date_time' => strtotime(date('Y-m-d h:i:s a')),
                    'user_id' => $user_id,
                    'action_made' => 'Created [OL No = '.$bill_no.'] in the OrderList',
                );

        $audit = $this->model_maincat->create1($data1);


		return ($order_id) ? $order_id : false;
	}
	public function update($id)
	{
		if($id) {
			$user_id = $this->session->userdata('id');
			$user_data = $this->model_users->getUserData($user_id);
			// update the table info

			$order_data = $this->getOrderlistData($id);


			$data = array(
	    		'user_id' => $user_id,

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
	    		$this->db->insert('orderlist_items', $items);


				$user_id = $this->session->userdata('id');
						//audit trail
						$data1 = array(
							'date_time' => strtotime(date('Y-m-d h:i:s a')),
							'user_id' => $user_id,
							'action_made' => 'Updated [OL No = '.$order_data['ol_code'].'] in the Orderlist',
						);

						$audit = $this->model_maincat->create1($data1);



	    	}

			return true;
		}
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