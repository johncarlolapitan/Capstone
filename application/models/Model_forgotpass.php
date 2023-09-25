<?php 

class Model_forgotpass extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	function validationemail($email)
	{
		if($email) {
			$sql = 'SELECT * FROM users WHERE email = ?';
			$query = $this->db->query($sql, array($email));
			$result = $query->num_rows();
			return ($result == 1) ? true : false;
		}

		return false;
		
	}
	function updatePasswordhash($data,$email)
	{
		$this->db->where('email',$email);
		$this->db->update('users',$data);
	}

	function getHashDetails($hash){
		$query = $this->db->query("SELECT * FROM users WHERE hash='$hash'");
		if($query->num_rows()==1)
		{
			return $query->row();
		}
		else
		{
			return false;
		}



	}
	public function updateNewPass($data,$hash)
	{
		$this->db->where('hash',$hash);
		$this->db->update('users',$data);

	}
}