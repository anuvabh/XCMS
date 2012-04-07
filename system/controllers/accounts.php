<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Accounts extends CI_Controller 
{
    /*--- login --- */
    public function login()
    {
        //someone is already logged in
        if($this->session->userdata('UserID'))
	{
            redirect(site_url().'main', 'location');
            return;
        }
        
        if($this->input->post('username') && $this->input->post('password'))//user has been kind enough to enter data
        {
            
            $this->load->model('user');
            $check = $this->user->login($this->input->post('username'), $this->input->post('password'));
            
            if( $check->errorCode == 0 )//login successfull
            {
                $data = array(
                        'UserID' => $check->UserID,
                        'UserType' => $check->UserType,
                        'FirstName' => $check->FirstName,
                        'LastName' => $check->LastName,
                        'Department' => $check->Department,
                        'Roll' => $check->Roll
                        );
                //we create the session
                $this->session->set_userdata($data);
                redirect(site_url().'main', 'location');
                return;
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
        else//Username or password has not been posted
        {
            $data = array(
                    'message' => 'Enter Username/Password',
                    'errorcode' => 1010
                    );
            
            $this->load->view('main_view', $data);
        }
    }
    //end of login()
	
    /*---  logout() ----*/
    public function logout()
    {        
        $this->session->sess_destroy();
        redirect(site_url().'main', 'location');
    }
    //end of logout()
  
    
    /*--- register ---*/
    public function register()
    {
        $this->load->model('user');
        $dept = $this->user->fetchDepartments();
        
        $data = array(
                'dept' => $dept,
                'errorMessage' => "");
        
        $errorMessage = "";
        
        //someone is already logged in...
        if($this->session->userdata('UserID'))
        {
            redirect(site_url().'main', 'location');
            return;
        }
        
        $Code = $this->input->post('Code');
        $Year = $this->input->post('Year');
        $Room = $this->input->post('Room');
        $FirstName = $this->input->post('FirstName');    
        $LastName = $this->input->post('LastName');
        $Roll = $this->input->post('Roll');
        $Email = $this->input->post('Email');
        $Department = $this->input->post('Department');
        $Password1 = $this->input->post('Password1');
        $Password = $this->input->post('Password');
        
        if(strlen($Code)*strlen($FirstName)*strlen($LastName)*strlen($Roll)*strlen($Email)*strlen($Password1)*strlen($Password) != 0)
        {//all fields have been filled, hence we proceed...   
            $error = 0;
            $this->load->helper('email');
            
            //we need to check validity of the acces code
            /*------*/
            $this->load->model('block');
            $result =  $this->block->checkValidity($Code, $Department, $Year, $Room);
            
            if($result->error)
            {
                $error = 1;
                $errorMessage = "Wrong Access Code<br />";
            }
            
            /*------*/
            
            
            if($Password != $Password1)
            {
               $error = 2;
               $errorMessage = "Passwords should match<br />";
            }
            if(!is_numeric($Roll))
            {
                $error = $error*10 + 3;
                $errorMessage = $errorMessage."Roll should be an integer<br />";
            }
            if(!valid_email($Email))
            {
                $error = $error*10 + 4;
                $errorMessage = $errorMessage."Email id should be valid<br />";
            }
            
           if ($this->user->fetchUserID($Email) != 0)
            {
               $error = $error*10 + 5;
                
               $errorMessage = $errorMessage."Choose different email id<br />";
            }
            if($error == 0)
            {
                $info = array( 
                        'FirstName' => $FirstName,
                        'LastName' => $LastName,
                        'Roll' => $Roll,
                        'Department' => $Department,
                        'Email' => $Email,
                        'Password' => $Password,
                        'Code' => $Code);

                $result = $this->user->register($info);//later we'll check for errors
                                                       //YES, WE WILL
                $data = array(
                        'UserID' => $result->UserID,
                        'UserType' => $result->UserType,//might need to use escape and change wherever needed
                        'FirstName' => $FirstName,
                        'LastName' => $LastName,
                        'Department' => $Department,
                        'Roll' => $Roll
                        );
                $this->session->set_userdata($data);

                redirect(site_url().'main', 'location');
                return;
            }
            else
            {
                $data['errorMessage'] = $errorMessage;
                $this->load->view('register_view', $data);
            }
             
        }    
        else
        {
            $data['errorMessage'] = 'Please fill all fields';
            $this->load->view('register_view', $data);
        }
    }
    //end of register() 
    public function view(){}
    public function edit(){}
}
/* End of file accounts.php */
/* Location: ./system/controllers/accounts.php */    