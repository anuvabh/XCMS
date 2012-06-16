<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {
	
    public function index()
    {
        if($this->session->userdata('UserID'))
        {
            $userType = $this->session->userdata('UserType');

            $data = array(
                    'FirstName' => $this->session->userdata('FirstName'),
                    'LastName' => $this->session->userdata('LastName'),
                    'Department' => $this->session->userdata('Department'),
                    'Roll' => $this->session->userdata('Roll')
                    );
            //we load the relevant view
            if($userType == 'system')
            {
                $this->load->view('sysadmin_view', $data);
               
            }
            else if($userType == 'dept')
            {
                $this->load->view('deptadmin_view', $data);
                
            }
            else if($userType == 'student')
            {
                $this->load->view('student_view', $data);
                
            }
            else if($userType == 'cr')//cr_view to be merged
            {
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
    //end of index()
    public function pages($url=''){}
    public function myCredits(){}
}
/* End of file main.php */
/* Location: ./system/controllers/main.php */    