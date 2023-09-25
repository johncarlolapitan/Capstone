<?php

defined('BASEPATH') OR exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'assets/src/Exception.php';
require 'assets/src/PHPMailer.php';
require 'assets/src/SMTP.php';


class Forgotpass extends Admin_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_forgotpass');

	}

	/*
		Check if the login form is submitted, and validates the user credential
		If not submitted it redirects to the login page
	*/

    public function index()
	{

        $this->load->view('forgotpass/index','refresh');
		
    }

	public function send_email()
	{
		$this->load->model('model_users');
		if($_SERVER['REQUEST_METHOD']=='POST')
		{
			$this->form_validation->set_rules('email','Email','required');
			if($this->form_validation->run()==TRUE)
			{
				$email = $this->input->post('email');
				$validationemail = $this->model_forgotpass->validationemail($email);
				if($validationemail!=false)
				{
					$row = $validationemail;
					$user_id = $this->session->userdata('id');
					$user_data = $this->model_users->getUserData($user_id);

					$string = time().$user_id.$email;
					$hash_string = hash('sha256',$string);
					$currentDate = date('Y-m-d H:i');
					$hash_expiry = date('Y-m-d H:i',strtotime($currentDate. ' 1 days'));
					$data = array(
						'hash'=>$hash_string,
						'hash_expiry'=>$hash_expiry,
					);
					$this->model_forgotpass->updatePasswordhash($data,$email);
					$user = $this->model_users->getUserByEmail($email);


					$resetLink = base_url().'reset/password?hash='.$hash_string;
					$message = '<p>Your reset password Link is here:</p>'.$resetLink;
					$subject = "Password Reset link";
					$sentstatus = $this->sendEmail($email,$subject,$message);
					if($sentstatus==true)
					{
						$this->model_forgotpass->updatePasswordhash($data,$email);
						$this->session->set_flashdata('success','Reset password link successfully sent');
						redirect(base_url('forgotpass/index'));
					}
					else
					{
						$this->session->set_flashdata('error','Email sending error');
					}

				}
				else
				{
					$this->session->set_flashdata('error','Invalid email id');
				}
			}
		}
		else
		{
			$this->load->view('forgotpass/index','refresh');
		}
		$this->load->view('forgotpass/index','refresh');
	}
	public function sendEmail($email,$subject,$message)
	{
		$config = Array(
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.gmail.com',

			'smtp_port' => 465,
			'smtp_user' => 'jcarlolapitan6@gmail.com',
			'smtp_pass' => 'zpdtlziqmouuntzn',

			'mailtype' => 'html',
			'charset' => 'iso-8859-1',
			'wordwrap' => TRUE
		);
		$this->load->library('email',$config);
		$this->email->set_newline("\r\n");
		$this->email->from('noreply');
		$this->email->to($email);
		$this->email->subject($subject);
		$this->email->message($message);

		 if($this->email->send())
         {
            return true;
         }
         else
         {
            return false;
         }
	}
	
}
