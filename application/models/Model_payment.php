<?php 

class Model_payment extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_users');
	}

	public function getPaymentData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM payment_method WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$user_id = $this->session->userdata('id');
		if($user_id == 1) {
			$sql = "SELECT * FROM payment_method ORDER BY name ASC";
			$query = $this->db->query($sql);
			return $query->result_array();
		}
		else {
			$sql = "SELECT * FROM payment_method ORDER BY name ASC";
			$query = $this->db->query($sql);
			$user_data = $this->model_users->getUserData($user_id);
			return $query->result_array();	
		}
	}
	public function create($data = array())
	{
		if($data) {
			$create = $this->db->insert('payment_method', $data);
			return ($create == true) ? true : false;
		}
	}

	public function update($id = null, $data = array())
	{
		$this->db->where('id', $id);
		$update = $this->db->update('payment_method', $data);

		return ($update == true) ? true : false;
	}
	public function remove($id = null)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('payment_method');
			return ($delete == true) ? true : false;
		}
	}

	public function getActivePayment()
	{
		$user_id = $this->session->userdata('id');
		if($user_id == 1) {
			$sql = "SELECT * FROM payment_method WHERE active = ? AND active = ?";
			$query = $this->db->query($sql, array(1, 1));
			return $query->result_array();	
		}
		else {	
			$this->load->model('model_users');
			$user_data = $this->model_users->getUserData($user_id);
		
		}
		
	}
}