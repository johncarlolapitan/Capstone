<?php


class Reset extends MY_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_forgotpass');

	}
	public function password_hash($pass = '')
	{
		if($pass) {
			$password = password_hash($pass, PASSWORD_DEFAULT);
			return $password;
		}
	}
	function password()
	{
		if($this->input->get('hash'))
		{
			$hash  = $this->input->get('hash');
			$this->data['hash']=$hash;
			$getHashDetails = $this->model_forgotpass->getHashDetails($hash);
			if($getHashDetails!=false)
			{
				$hash_expiry = $getHashDetails->hash_expiry;
				$currentDate = date('Y-m-d H:i');
				if($currentDate < $hash_expiry)
				{
					if($_SERVER['REQUEST_METHOD']=='POST')
					{
						$this->form_validation->set_rules('password','New Password','required');
						$this->form_validation->set_rules('cpassword','Confirm New Password','required');
						if($this->form_validation->run()==TRUE)
						{
							$newpassword = $this->input->post('password');
							$newpassword1 = $this->input->post('cpassword');
							if($newpassword!=$newpassword1)
							{
								$this->session->set_flashdata('error','Password do not match');
								$this->load->view('forgotpass/reset',$this->data);
							}
							else
							{
								$password = $this->password_hash($this->input->post('password'));
								$newpassword = 
        						$data = array(
        							'password' => $password,
									'hash' => null,
									'hash_expiry'=>null

        						);
								$this->model_forgotpass->updateNewPass($data, $hash);
								$this->session->set_flashdata('success','Succesfully changed password');
								$this->load->view('forgotpass/reset',$this->data);
							}
						}
					}
					else
					{
						$this->load->view('forgotpass/reset',$this->data);
					}
				}
				else
				{
					$this->session->set_flashdata('error','link is expired');
					redirect(base_url('forgotpass/index'));
				}
			}
			else
			{
				$this->load->view('forgotpass/reset',$this->data);
			}
		}
		else
		{
			redirect(base_url('forgotpass/index'));
		}
	}

}