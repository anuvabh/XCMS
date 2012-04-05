<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {
	
	public function index()
	{
           
            if($this->session->userdata('UserID'))
            {
                
                $userType = $this->session->userdata('UserType');
                
                if($userType == 'system')
		{
                    $data = array(
                            'FirstName' => $this->session->userdata('FirstName'),
                            'LastName' => $this->session->userdata('LastName')
                            );
               
			    	$this->load->view('sysadmin_view', $data);
                }
                else if($userType == 'dept')
				{
                    $data = array(
                            'FirstName' => $this->session->userdata('FirstName'),
                            'LastName' => $this->session->userdata('LastName')
                            	);
               
			    	$this->load->view('deptadmin_view', $data);
                }
                else if($userType == 'student')
		{
                    $data = array(
                            'FirstName' => $this->session->userdata('FirstName'),
                            'LastName' => $this->session->userdata('LastName'),
                            'Department' => $this->session->userdata('Department'),
                            'Roll' => $this->session->userdata('Roll'),
                            	);
                   $this->load->view('student_view', $data);
                }
            	else if($userType == 'cr')
		{
                    $data = array(
                            'FirstName' => $this->session->userdata('FirstName'),
                            'LastName' => $this->session->userdata('LastName'),
                            'Department' => $this->session->userdata('Department'),
                            'Roll' => $this->session->userdata('Roll'),
                            	);
                $this->load->view('cr_view', $data);
                }
            }
            else
            {
                $data = array(
                'message' => 'Please Log In',
                'errorcode' => 0
                );
                $this->load->view("main_view", $data);
            }
        }
	public function pages($url=''){}
	public function myCredits(){}
}
