<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	public function register()
	{
		$this->load->library('form_validation');

        $this->form_validation->set_rules('email', 'Email', 'required');
		if ($this->form_validation->run() == FALSE){
			$this->load->view('auth/register');
		}else{
			//get user inputs
			$email = $this->input->post('email');
			$password = $this->input->post('password');
 
			//generate simple random code
			$set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$code = substr(str_shuffle($set), 0, 12);
			

			$data = array(
				'email' => $email,
				'password' => $password,
				'code' => $code,
				'active' => '0'
			);
			
			$this->db->insert('users', $data);

			$id = $this->db->insert_id();

			//set up email
			$config = array(
				'protocol' => 'smtp',
				'smtp_host' => 'ssl://smtp.gmail.com',
				'smtp_port' => 465,
				'smtp_user' => 'kontakzyuni@gmail.com', // change it to yours
				'smtp_pass' => 'winda069606', // change it to yours
				'mailtype' => 'html',
				'wordwrap' => TRUE
		  );

		  $message = "
						<html>
						<head>
							<title>Verification Code</title>
						</head>
						<body>
							<h2>Thank you for Registering.</h2>
							<p>Your Account:</p>
							<p>Email: ".$email."</p>
							<p>Password: ".$password."</p>
							<p>Please click the link below to activate your account.</p>
							<h4><a href='".base_url()."index.php/auth/activate/".$id."/".$code."'>Activate My Account</a></h4>
						</body>
						</html>
						";
			
			
			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");
			$this->email->from($config['smtp_user']);
			$this->email->to($email);
			$this->email->subject('Signup Verification Email');
			$this->email->message($message);
	
			//sending email
			if($this->email->send()){
				die('success');
			}else{
				echo $this->email->print_debugger();
				die('error');
			}

			redirect('auth/register');
		}
		
	}

	public function activate($id, $code)
	{
		$user = $this->db->query("SELECT * FROM users WHERE id = $id")->row_array();

		if($user['code'] == $code){
			$data = array(
				'active' => '1'
			);
			
			$this->db->where('id', $id);
			$this->db->update('users', $data);

			redirect('auth/login');
		}
		
	}

	public function login()
	{
		$this->load->library('form_validation');

        $this->form_validation->set_rules('email', 'Email', 'required');
		if ($this->form_validation->run() == FALSE){
			$this->load->view('auth/login');
		}else{

			$email = $this->input->post('email');
			$password = $this->input->post('password');

			$user = $this->db->query("SELECT * FROM users WHERE email = '$email'")->row_array();

			if($user){
				if($user['password'] == $password){
					redirect('welcome');
				}else{
					redirect('auth/login');
				}
			}else{
				redirect('auth/login');
			}
		}
		
	}
}
