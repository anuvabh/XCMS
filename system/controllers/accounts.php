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
    public function register($type = 'student')
    {
        $this->load->model('user');
        $dept = $this->user->fetchDepartments();
        
        $data = array(
                'dept' => $dept,
                'errorMessage' => "");
        
        $errorMessage = "";
        $UserType = $this->session->userdata('UserType'); 
        //someone is already logged in and is not the system admin...
        if($this->session->userdata('UserID') && $UserType != 'system')
        {
            redirect(site_url().'main', 'location');
            return;
        }
        
        $Code = "";
        if(isset($UserType))
            $Code = $this->input->post('Code');
        if($UserType == 'system')
            $Code = "cr";
       
        echo $Code;
        $Year = $this->input->post('Year');
        $Room = $this->input->post('Room');
        $FirstName = $this->input->post('FirstName');    
        $LastName = $this->input->post('LastName');
        $Roll = $this->input->post('Roll');
        $Email = $this->input->post('Email');
        $Department = $this->input->post('Department');
        $Password1 = $this->input->post('Password1');
        $Password = $this->input->post('Password');
        
        $length = strlen($Code)*strlen($Room)*strlen($FirstName)*strlen($LastName)*strlen($Roll)*strlen($Email)*strlen($Password1)*strlen($Password);
        //echo $length;
        if($length != 0)
        {//all fields have been filled, hence we proceed...   
            $error = 0;
            $this->load->helper('email');
            $blockID;
            if($UserType == 'system' && $type == 'cr')
            {
                $this->load->model('block');
                $blockID = $this->block->fetchBlockID($Department, $Year, $Room);
                if($blockID == 0)
                {
                    $error = 1;
                    $errorMessage = "Please check your data<br />";
                }
                else
                {
                    if($this->block->blockHasCR($blockID) != 0)
                    {
                        $error = 1;
                        $errorMessage = "CR already assigned to the block<br />";
                    }
                }
            }
            
            
            if(isset($UserType) && $UserType != 'system')
            {
                //we need to check validity of the acces code
                /*------*/
                $this->load->model('block');
                $result =  $this->block->checkValidity($Code, $Department, $Year, $Room);

                if($result->error)
                {
                    $error = 1;
                    $errorMessage = "Wrong data entered<br />";
                }
            }
            
            
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

                $result = $this->user->register($info, $type);//later we'll check for errors
                                                       //YES, WE WILL
               
                if($UserType == 'system')
                {
                    $this->block->assignCRBlock($result->UserID, $blockID);
                    
                    header("Refresh:2; URL=http://localhost/xcms/main");
                    echo "CR created";
                    
                }
                else
                {
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
                }
                return;
            }
            else
            {
                $data['errorMessage'] = $errorMessage;//title to be sent
                //depending on system or student, CR Creation or New Student Register
                $this->load->view('register_view', $data);
            }
             
        }    
        else
        {
            $data['errorMessage'] = 'Please fill all fields';
            $this->load->view('register_view', $data);
        }
    }
    
    function changePassword()
    {
        $oldPass = $this->input->post('oldPassword');
        $newPass = $this->input->post('newPassword');
        
        $data = array(
                'Err' => ""
        );
        
        if(strlen($oldPass)*strlen($newPass) != 0)
        {
            $this->load->model('user');
            if($this->user->changePassword($this->session->userdata('UserID'), $oldPass, $newPass))
            {
                echo "Password Changed";
                header("Refresh:2; URL=http://localhost/xcms/main");
                //redirect(site_url().'main', 'refresh:5');
            }
            else
            {
                $data['Err'] = "Please enter correct Password";
                $this->load->view('changePassword', $data);
            }
        }
        else
        $this->load->view('changePassword', $data);
        
    }
    function createCR()
    {        
        $this->load->model('user');
        $dept = $this->user->fetchDepartments();
        
        $data=array(
            'dept' => $dept,
            'errorMessage' => ""
        );
        
        $FirstName = $this->input->post('FirstName');    
        $LastName = $this->input->post('LastName');
        $Roll = $this->input->post('Roll');
        $Email = $this->input->post('Email');
        $Department = $this->input->post('Department');
        $Password1 = $this->input->post('Password1');
        $Password = $this->input->post('Password');
        
        if(strlen($FirstName)*strlen($LastName)*strlen($Roll)*strlen($Email)*strlen($Password1)*strlen($Password) != 0)
        {//all fields have been filled, hence we proceed...   
            $error = 0;
            $this->load->helper('email');
            
            //we need to check validity of the acces code
            /*------*/
            $this->load->model('block');
            
            
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
                        'Password' => $Password);

                $this->user->register($info,'cr');//later we'll check for errors
                                                       //YES, WE WILL
                /*$data = array(
                        'UserID' => $result->UserID,
                        'UserType' => $result->UserType,//might need to use escape and change wherever needed
                        'FirstName' => $FirstName,
                        'LastName' => $LastName,
                        'Department' => $Department,
                        'Roll' => $Roll
                        );
                $this->session->set_userdata($data);
                */    
                
                header("Refresh:2; URL=http://localhost/xcms/main");
                echo "CR created";
                return;
            }
            else
            {
                $data['errorMessage'] = $errorMessage;
                $this->load->view('createCR_view', $data);
            }
             
        }    
        else
        {
            $data['errorMessage'] = 'Please fill all fields';
            $this->load->view('createCR_view', $data);
        }
    }
    //end of register() 
    public function view(){}
    public function edit(){}
}
/* End of file accounts.php */
/* Location: ./system/controllers/accounts.php */    