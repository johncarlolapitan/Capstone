<?php 

class Model_maincat extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_users');
	}
	public function getMainCatData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM tbl_main_category WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$user_id = $this->session->userdata('id');
		if($user_id == 1) {
			$sql = "SELECT * FROM tbl_main_category ORDER BY name ASC";
			$query = $this->db->query($sql);
			return $query->result_array();
		}
		else {
			$sql = "SELECT * FROM tbl_main_category ORDER BY name ASC";
			$query = $this->db->query($sql);
			$user_data = $this->model_users->getUserData($user_id);
			return $query->result_array();	
		}
	}
	

	public function getActiveMainCategoryData()
	{
		$user_id = $this->session->userdata('id');

		if($user_id == 1) {
			$sql = "SELECT * FROM tbl_main_category WHERE active = ? ORDER BY id DESC";
			$query = $this->db->query($sql, array(1));
			return $query->result_array();
		}
		else {
			$this->load->model('model_users');
			$user_data = $this->model_users->getUserData($user_id);
			$sql = "SELECT * FROM tbl_main_category WHERE active = ? ORDER BY id DESC";
			$query = $this->db->query($sql, array(1));

			$data = array();


			return $data;			
		}

		
	}
	public function getActiveMainCategory()
	{
		$sql = "SELECT * FROM tbl_main_category WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}
	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('tbl_main_category', $data);
			return ($insert == true) ? true : false;
		}
	}
		public function create1($data)
	{
		if($data) {
			$insert = $this->db->insert('audit', $data);
			return ($insert == true) ? true : false;
		}
	}
	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('tbl_main_category', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
    	if($id) {
        	// check if the main category has any associated value in tbl_sub_category
        	$this->db->where('main_category_id', $id);
        	$query = $this->db->get('tbl_sub_category');
        	
        	if($query->num_rows() > 0) {
            	return false;
        	}

        	// if the main category does not have any associated subcat, proceed to delete
        	$this->db->where('id', $id);
        	$delete = $this->db->delete('tbl_main_category');
        	return ($delete == true) ? true : false;
    	}
	}


}