<?php 

class Model_unit extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getUnitData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM unit WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		// if admin all data 
		$user_id = $this->session->userdata('id');
		if($user_id == 1) {
			$sql = "SELECT * FROM unit ORDER BY id DESC";
			$query = $this->db->query($sql);
			return $query->result_array();	
		}
		else {
			$this->load->model('model_users');
			$user_data = $this->model_users->getUserData($user_id);	
		}


		
	}

	public function create($data = array())
	{
		if($data) {
			$create = $this->db->insert('unit', $data);
			return ($create == true) ? true : false;
		}
	}

	public function update($id = null, $data = array())
	{		
		$this->db->where('id', $id);
		$update = $this->db->update('unit', $data);

		return ($update == true) ? true : false;
	}

	public function remove($id = null)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('unit');
			return ($delete == true) ? true : false;
		}
	}
	
}