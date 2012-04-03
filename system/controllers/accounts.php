<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Accounts extends CI_Controller {

	public function login()
	{
		
		if($this->input->post('username') && $this->input->post('password'))
		{
			$this->load->model('user');
			
			$check = $this->user->login($this->input->post('username'), $this->input->post('password'));
			
			if( $check->errorCode == 0 )//login successfull
			{
				$this->load->library('session');
				$data = array(
					'UserID' => $check->UserID,
					'UserType' => $check->UserType,
					'FirstName' => $check->FirstName,
					'LastName' => $check->LastName,
					'Department' => $check->Department,
					'Roll' => $check->Roll
				);
				$this->session->set_userdata($data);
				
				$this->load->view("user_view", $data);
			}
			else
			{
				
				$data = array(
						'message' => 'Invalid Username/Password',
						'errorcode' => $check->errorCode
						);
				$this->load->view("main_view", $data);
			}
		}
		else
		{
			$data = array(
					'message' => 'Invalid Username/Password',
					'errorcode' => $check->errorCode
					);
			$this->load->view('main_view', $data);
		}
	}
	//end of login()
	
	public function logout(){}
	public function edit(){}
	public function register(){}
	public function view(){}
}