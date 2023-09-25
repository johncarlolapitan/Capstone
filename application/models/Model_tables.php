<?php 

class Model_tables extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_users');

	}

	public function getTableData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM tables WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$user_id = $this->session->userdata('id');
		if($user_id == 1) {
			$sql = "SELECT * FROM tables ORDER BY table_name ASC";
			$query = $this->db->query($sql);
			return $query->result_array();
		}
		else {
			$sql = "SELECT * FROM tables ORDER BY table_name ASC";
			$query = $this->db->query($sql);
			$user_data = $this->model_users->getUserData($user_id);
			return $query->result_array();	
		}


		
	}

	public function create($data = array())
	{
		if($data) {
			$create = $this->db->insert('tables', $data);
			return ($create == true) ? true : false;
		}
	}

	public function update($id = null, $data = array())
	{		
		$this->db->where('id', $id);
		$update = $this->db->update('tables', $data);

		return ($update == true) ? true : false;
	}

	public function remove($id = null)
	{
		if($id) {
        	// check if the main category has any associated value in tbl_sub_category
        	$this->db->where('table_id', $id);
        	$query = $this->db->get('orders');
        	
        	if($query->num_rows() > 0) {
            	return false;
        	}

        	// if the main category does not have any associated subcat, proceed to delete
        	$this->db->where('id', $id);
        	$delete = $this->db->delete('tables');
        	return ($delete == true) ? true : false;
    	}
	}

	public function getActiveTable()
	{
		$user_id = $this->session->userdata('id');
		if($user_id == 1) {
			$sql = "SELECT * FROM tables WHERE available = ? AND active = ?";
			$query = $this->db->query($sql, array(1, 1));
			return $query->result_array();	
		}
		else {
			$this->load->model('model_users');
			$user_data = $this->model_users->getUserData($user_id);
		
		}

		
	}
	public function countTotalTables() {
		$sql = "SELECT * FROM tables WHERE available = 1";
		$query = $this->db->query($sql, array(1));
		return $query->num_rows();
	}
}