<?php 

class Model_auth extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* 
		This function checks if the email exists in the database
	*/
	public function check_email($email) 
	{
		if($email) {
			$sql = 'SELECT * FROM users WHERE email = ?';
			$query = $this->db->query($sql, array($email));
			$result = $query->num_rows();
			return ($result == 1) ? true : false;
		}

		return false;
	}

	/* 
		This function checks if the email and password matches with the database
	*/
	public function login($email, $password) {
		if($email && $password) {
			$sql = "SELECT * FROM users WHERE email = ?";
			$query = $this->db->query($sql, array($email));

			if($query->num_rows() == 1) {
				$result = $query->row_array();

				$hash_password = password_verify($password, $result['password']);
				if($hash_password === true) {
					return $result;	
				}
				else {
					return false;
				}

				
			}
			else {
				return false;
			}
		}
	}
	public function updatelogged($email) {
		$sql = "UPDATE users set logged = 1 where email = ?";
		$query = $this->db->query($sql, array($email));
		return $query;
	}
	public function updatelogged1() {
		$sql = "UPDATE users set logged = 0";
		$query = $this->db->query($sql, array());
		return $query;
	}
		public function get_user_by_email($email) {
		$sql = "SELECT * FROM users WHERE email = ?";
		$query = $this->db->query($sql, array($email));
		return $query->row_array();
	}
	public function increment_login_attempts($email) {
		$sql = "UPDATE users SET login_attempts = login_attempts + 1 WHERE email = ?";
		$query = $this->db->query($sql, array($email));
		return $query;
		}
		public function increment_login_attempts1($email) {
		$sql = "UPDATE users SET login_attempts = login_attempts = 0 WHERE email = ?";
		$query = $this->db->query($sql, array($email));
		return $query;
		}
		public function reset_login_attempts($email) {
		$sql = "UPDATE users SET login_attempts = 0 WHERE email = ?";
		$query = $this->db->query($sql, array($email));
		return $query;
		}
		
		public function get_cooldown_time($email) {
		$sql = "SELECT cooldown_time FROM users WHERE email = ?";
		$query = $this->db->query($sql, array($email));
		return $query->row_array();
		}
		
		public function update_cooldown_time($email, $cooldown_time) {
		$sql = "UPDATE users SET cooldown_time = ? WHERE email = ?";
		$query = $this->db->query($sql, array($cooldown_time, $email));
		return $query;
		}
		
		public function get_login_attempts($email) {
		$sql = "SELECT login_attempts FROM users WHERE email = ?";
		$query = $this->db->query($sql, array($email));
		return $query->row_array();
		}
	
}