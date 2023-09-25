<?php 

class Model_productstock extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_users');
	}
	public function getProductData0($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM stock_history where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}	

		$user_id = $this->session->userdata('id');
		if($user_id == 1) {
			$sql = "SELECT * FROM stock_history WHERE qty >= 0 ORDER BY id ASC";
			$query = $this->db->query($sql);
			return $query->result_array(); 
		}
		else {
			
			$user_data = $this->model_users->getUserData($user_id);
			$sql = "SELECT * FROM stock_history WHERE qty >= 0 ORDER BY id ASC ";
			$query = $this->db->query($sql);
            return $query->result_array();     	
		}
	}
	/* get the product data */
	public function getProductData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM product_inventory where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}	

		$user_id = $this->session->userdata('id');
		if($user_id == 1) {
			$sql = "SELECT * FROM product_inventory WHERE qty >= 1 ORDER BY id ASC";
			$query = $this->db->query($sql);
			return $query->result_array(); 
		}
		else {
			
			$user_data = $this->model_users->getUserData($user_id);
			$sql = "SELECT * FROM product_inventory WHERE qty >= 1 ORDER BY id ASC ";
			$query = $this->db->query($sql);
			return $query->result_array();    	
		}
	}
	public function getExpProd($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM product_inventory where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}	

		$user_id = $this->session->userdata('id');
		if($user_id == 1) {
			$sql = "SELECT * FROM product_inventory WHERE qty >= 1 ORDER BY id ASC";
			$query = $this->db->query($sql);
			return $query->result_array(); 
		}
		else {
			
			$user_data = $this->model_users->getUserData($user_id);
			$sql = "SELECT * FROM product_inventory WHERE qty >= 1 ORDER BY id ASC";
			$query = $this->db->query($sql);
			return $query->result_array();    	
		}
	}
	public function getProductData1($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM products where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}	

		$user_id = $this->session->userdata('id');
		if($user_id == 1) {
			$sql = "SELECT * FROM products ORDER BY id DESC";
			$query = $this->db->query($sql);
			return $query->result_array(); 
		}
		else {
			
			$user_data = $this->model_users->getUserData($user_id);
			$sql = "SELECT * FROM products ORDER BY id DESC";
			$query = $this->db->query($sql);
			return $query->result_array();    	
		}
	}
	/* get the product data */
	public function getProductDataByCat($cat_id = null)
	{
		if($cat_id) {

			$user_id = $this->session->userdata('id');
			if($user_id == 1) {
				$sql = "SELECT * FROM products ORDER BY id DESC";
				$query = $this->db->query($sql);
				$result = array();
				foreach($query->result_array() as $key => $value) {
					$sub_category_ids = json_decode($value['sub_category_id']);
					if(in_array($cat_id, $sub_category_ids)) {
						$result[] = $value;
					}
				} 

				return $result;
			}
			else {


				$user_data = $this->model_users->getUserData($user_id);

				$sql = "SELECT * FROM products ORDER BY id DESC";
				$query = $this->db->query($sql);

				$data = array();


				return $data;		


			}
		}	
	}

	public function getActiveProductData()
	{
		$user_id = $this->session->userdata('id');

		if($user_id == 1) {
			$sql = "SELECT * FROM products WHERE active = ? ORDER BY id DESC";
			$query = $this->db->query($sql, array(1));
			return $query->result_array();
		}
		else {
			$this->load->model('model_users');
			$user_data = $this->model_users->getUserData($user_id);
			$sql = "SELECT * FROM products WHERE active = ? ORDER BY id DESC";
			$query = $this->db->query($sql, array(1));

			$data = array();


			return $data;			
		}

		
	}

}