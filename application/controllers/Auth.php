<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends Admin_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_auth');
        $this->load->model('model_maincat');
	}

	/*
		Check if the login form is submitted, and validates the user credential
		If not submitted it redirects to the login page
	*/
	public function login()
	{
    $this->logged_in();

	$captcha = trim((string)$this->input->post('g-recaptcha-response'));
	if($captcha != ''){
		$secret = '6LdN2_AjAAAAACaFeC4_-QR7oB6xHMygJuvJEUul';
		$check = array (
			'secret' => $secret,
			'response' => $this->input->post('g-recaptcha-response'),
		);
		$startprocess = curl_init();

		curl_setopt($startprocess, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
		curl_setopt($startprocess, CURLOPT_POST, true);
		curl_setopt($startprocess, CURLOPT_POSTFIELDS, http_build_query($check));
		curl_setopt($startprocess, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($startprocess, CURLOPT_RETURNTRANSFER, true);

		$receiveData = curl_exec($startprocess);

		$finalResponse = json_decode($receiveData, true);

		if($finalResponse['success']){
			$this->form_validation->set_rules('email', 'Email','required');
            $this->form_validation->set_rules('password', 'Password','required');

            if ($this->form_validation->run() == TRUE) {
                // true case
                $email_exists = $this->model_auth->check_email($this->input->post('email'));

                if($email_exists == TRUE) {
                    $user = $this->model_auth->get_user_by_email($this->input->post('email'));
                    if ($user['login_attempts'] >= 3) { 
               
                        // login failed because user has exceeded the login attempts threshold
                        $this->load->view('login');
                        echo '<script>alert("You have exceeded the maximum number of login attempts. Please try again in 30 seconds.")</script>'; 
                        sleep(30); // delay for 30 seconds
                        $this->model_auth->increment_login_attempts1($this->input->post('email'));
                        return;
                    }
                    $login = $this->model_auth->login($this->input->post('email'), $this->input->post('password'));

                    if($login) {
                        // login successful
                        $logged_in_sess = array(
                            'id' => $login['id'],
                            'username'  => $login['username'],
                            'email'     => $login['email'],
                            'logged_in' => TRUE
                        );
                        $user_id = $login['id'];
                        //audit trail
                        $data1 = array(
                            'date_time' => strtotime(date('Y-m-d h:i:s a')),
                            'user_id' => $user_id,
                            'action_made' => 'User has logged In',
                        );
                        $audit = $this->model_maincat->create1($data1);


                        $this->model_auth->increment_login_attempts1($this->input->post('email'));
                        $this->session->set_userdata($logged_in_sess);
                        $this->model_auth->updatelogged($this->input->post('email'));
                        redirect('dashboard', 'refresh');
                    }
                    else {
                        // login failed because of incorrect email/password
                        $this->load->view('login');
                        echo '<script>alert("Incorrect username/password combination")</script>';
                        $this->model_auth->increment_login_attempts($this->input->post('email'));
                    }
                }
                else {
                    // login failed because email does not exist
                    $this->load->view('login');
                    echo '<script>alert("Email does not exists")</script>';
                }
            }
            else {
                // false case
                $this->load->view('login','refresh');
            }
		}
		else{
			$this->load->view('login','refresh');
		}
    }
    else {
        // false case
        $this->load->view('login','refresh');
    }
}

	/*
		clears the session and redirects to login page
	*/
	public function logout()
	{

        $user_id = $this->session->userdata('id');
        //audit trail
        $data1 = array(
            'date_time' => strtotime(date('Y-m-d h:i:s a')),
            'user_id' => $user_id,
            'action_made' => 'User has logged out',
        );

        $audit = $this->model_maincat->create1($data1);

        $this->model_auth->updatelogged1();
		$this->session->sess_destroy();
		redirect('auth/login', 'refresh');
	}

}
