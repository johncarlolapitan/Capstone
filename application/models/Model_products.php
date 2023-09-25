<?php 

class Model_products extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_users');
	}

	/* get the product data */
	public function getProductData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM products WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$user_id = $this->session->userdata('id');
		if($user_id == 1) {
			$sql = "SELECT * FROM products ORDER BY name ASC";
			$query = $this->db->query($sql);
			return $query->result_array();
		}
		else {
			$sql = "SELECT * FROM products ORDER BY name ASC";
			$query = $this->db->query($sql);
			$user_data = $this->model_users->getUserData($user_id);
			return $query->result_array();	
		}
	}
	public function getProductData30($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM products WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$user_id = $this->session->userdata('id');
		if($user_id == 1) {
			$sql = "SELECT * FROM products WHERE qty > 1 ORDER BY name ASC";
			$query = $this->db->query($sql);
			return $query->result_array();
		}
		else {
			$sql = "SELECT * FROM products WHERE qty > 1 ORDER BY name ASC";
			$query = $this->db->query($sql);
			$user_data = $this->model_users->getUserData($user_id);
			return $query->result_array();	
		}
	}
	public function getProductData500($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM products WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$user_id = $this->session->userdata('id');
		if($user_id == 1) {
			$sql = "SELECT * FROM products ORDER BY name ASC";
			$query = $this->db->query($sql);
			return $query->result_array();
		}
		else {
			$sql = "SELECT * FROM products ORDER BY name ASC";
			$query = $this->db->query($sql);
			$user_data = $this->model_users->getUserData($user_id);
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
	public function getActiveProductData1()
	{
		$user_id = $this->session->userdata('id');

		if($user_id == 1) {
			$sql = "SELECT * FROM products WHERE qty >= 1 AND active = 1 ORDER BY id DESC";
			$query = $this->db->query($sql, array(1));
			return $query->result_array();
		}
		else {
			$this->load->model('model_users');
			$user_data = $this->model_users->getUserData($user_id);
			$sql = "SELECT * FROM products WHERE qty >= 1 AND active = 1 ORDER BY id DESC";
			$query = $this->db->query($sql, array(1));

			$data = array();


			return $data;			
		}

		
	}
	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('products', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('products', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
        	// check if the main category has any associated value in tbl_sub_category
        	$this->db->where('product_id', $id);
        	$query = $this->db->get('order_items');
        	
        	if($query->num_rows() > 0) {
            	return false;
        	}

        	// if the main category does not have any associated subcat, proceed to delete
        	$this->db->where('id', $id);
        	$delete = $this->db->delete('products');
        	return ($delete == true) ? true : false;
    	}
	}

	public function countTotalProducts()
	{
		$sql = "SELECT * FROM products";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

}		