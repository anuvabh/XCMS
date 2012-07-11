<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Accounts extends CI_Controller 
{
    /*--- login --- */
    public function login()
    {
        //someone is already logged in
        if($this->session->userdata('UserID'))
	{
            redirect(site_url(), 'location');
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
                redirect(site_url(), 'location');
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
        redirect(site_url(), 'location');
    }
    //end of logout()
  
    
    /*--- register ---*/
    public function register($type = 'student', $modify=0)
    {
        if(strlen($this->input->post('modify')>0))
            $modify = intval ($this->input->post('modify'));
        if($modify!=0 && $modify!=1 && $modify!=3)
        {
            show_404('page');
        }
        
        $UserType = $this->session->userdata('UserType'); 
        
        //someone is already logged in and it is not the system admin...
        if($this->session->userdata('UserID') && $UserType != 'system')
        {
            redirect(site_url(), 'location');
            return;
        }        
        
        $this->load->model('user');
        $dept = $this->user->fetchDepartments();
        
        $data = array(
                'dept' => $dept,
                'errorMessage' => "");
        
        $errorMessage = "";
        
        $Code = "";
      
            $Code = $this->input->post('Code');
        
        if($UserType == 'system')
            $Code = "cr";
      
        $Year = $this->input->post('Year');
        $Room = $this->input->post('Room');
        $FirstName = $this->input->post('FirstName');    
        $LastName = $this->input->post('LastName');
        $Roll = $this->input->post('Roll');
        $Email = $this->input->post('Email');
        $Department = $this->input->post('Department');
        $Password1 = $this->input->post('Password1');
        $Password = $this->input->post('Password');
        
        if($modify == 0 )
            $length = strlen($Code)*strlen($Room)*strlen($FirstName)*strlen($LastName)*strlen($Roll)*strlen($Email)*strlen($Password1)*strlen($Password);
        else
            $length = strlen($Room)*strlen($Email);
            
//        if($modify!=0 && $length==0)
        
        if($length != 0)
        {//all fields have been filled, hence we proceed...   
            
            $error = 0;
            $this->load->helper('email');
            $blockID;
            if($UserType == 'system' && $type == 'cr')
            {
                $this->load->model('block');
                $blockID = $this->block->fetchBlockID($Department, $Year, $Room);
                if($blockID == 0)//no such block exists
                {
                    $error = 1;
                    $errorMessage = "Please check your data<br />";
                    
                }
                else
                {
                    if($modify==0 && $this->block->blockHasCR($blockID) != 0)
                    {
                        $error = 1;
                        $errorMessage = "CR already assigned to the block<br />";
                    }
                    if($modify!=0)
                    {
                        
                        
                            
                        $existing = $this->user->hasCR($Department, $Year, $Room);
                        $isCR = $this->user->isCR($Email);

                        if ($Department != $this->user->userDept($Email))
                        {
                            $data['errorMessage'] = 'To make a student a CR, he/she has to belng to that department';
                            $data['modify'] = 1;

                            $this->load->view('register_view', $data);
                            return;
                        }
                        if(count($existing) == 0 && !$isCR)
                        {
                            
                                $this->user->makeCR($Department, $Year, $Room, $Email);

                                header("Refresh:2; URL=http://localhost/xcms/");
                                $d = array ( 'message' => "CR created",
                                    'image' => "student.gif");
                                $this->load->view('displayPrompt_view', $d);
                                return;
                        }
                        else 
                        {
                            if($isCR)
                            {
                                
                                if(count($existing) > 0)
                                {

                                    if($modify==3)
                                    {
                                        $this->user->revokeCR($this->input->post('CRID'));
                                        $this->user->makeCR($Department, $Year, $Room, $Email);
                                        header("Refresh:2; URL=http://localhost/xcms/");
                                        $d = array ( 'message' => "CR changed",
                                            'image' => "student.gif");
                                        $this->load->view('displayPrompt_view', $d);
                                        return;
                                    }

                                    else
                                    {
                                        $x['CR'] = $existing[0];

                                        $x['Department'] = $Department;
                                        $x['Year'] = $Year;
                                        $x['Room'] = $Room;
                                        $x["Email"] = $Email;
                                        $this->load->view('CRcreate_view', $x);
                                    }
                                    $this->user->modifyCR($Department, $Year, $Room, $Email);
                                

                                }
                                return;
                            }
                            else if(count($existing) > 0)
                            {
                                if($modify==3)
                                {
//                                    print_r($existing[0]);
                                    $this->user->revokeCR($existing[0]['UserID']);
                                    $this->user->makeCR($Department, $Year, $Room, $Email);
                                    header("Refresh:2; URL=http://localhost/xcms/");
                                    $d = array ( 'message' => "CR changed",
                                        'image' => "student.gif");
                                    $this->load->view('displayPrompt_view', $d);
                                }
                                
                                else
                                {
                                    $x['CR'] = $existing[0];
                                    $x['Department'] = $Department;
                                    $x['Year'] = $Year;
                                    $x['Room'] = $Room;
                                    $x["Email"] = $Email;
                                    $this->load->view('CRcreate_view', $x);
                                }
                                
                            }
                            return;
                        }
                        
                        
                    }
                }
            }
            
            
            if(isset($UserType) && $UserType != 'system')
            {
                if(is_numeric($Room) && $Room > 0)
                {
                    //we need to check validity of the acces code
                    $this->load->model('block');
                    $result =  $this->block->checkValidity($Code, $Department, $Year, $Room);
                    if($result->error)
                    {
                        $error = 1;
                        $errorMessage = "Wrong data entered<br />";
                    }
                }
                else
                {
                    $error = 1;
                    $errorMessage = "Room number is invalid<br />";
                }                
            }
            if($UserType != 'system' || $type != 'cr')
            {
                if($Password != $Password1)
                {
                $error = 2;
                $errorMessage = "Passwords should match<br />";
                }
                if(!is_numeric($Roll) || $Roll <=0 )
                {
                    $error = $error*10 + 3;
                    $errorMessage = $errorMessage."Roll should be an integer<br />";
                }
                if(!valid_email($Email))
                {
                    $error = $error*10 + 4;
                    $errorMessage = $errorMessage."Email id should be valid<br />";
                }

                if ($this->user->fetchUserID($Email) != 0 && $type!='cr')
                {
                $error = $error*10 + 5;
                $errorMessage = $errorMessage."Choose different email id<br />";
                }
            
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
                    
                    header("Refresh:2; URL=http://localhost/xcms/");
                    $d = array ( 'message' => "CR created",
                                'image' => "student.gif");
                    $this->load->view('displayPrompt_view', $d);
                    //echo "CR created";
                    
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
                    redirect(site_url(), 'location');
                }
                return;
            }
            else
            {
//                echo "1";
                $data['errorMessage'] = $errorMessage;//title to be sent
                $data['modify'] = $modify;
                //depending on system or student, CR Creation or New Student Register
                $this->load->view('register_view', $data);
            }
             
        }    
        else
        {
            
            $data['errorMessage'] = 'Please Fill All Fields';
            $data['modify'] = $modify;
            $this->load->view('register_view', $data);
        }
    }
    //end of register() 
    
    function changePassword()
    {
        if(!$this->session->userdata('UserID'))
	{
            redirect(site_url(), 'location');
            return;
        }
        
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
                header("Refresh:2; URL=http://localhost/xcms/");
                $d = array ( 'message' => "Password changed");
                $this->load->view('displayPrompt_view', $d);
                //echo "Password Changed";
                //redirect(site_url().'main', 'refresh:5');
            }
            else
            {
                $data['Err'] = "Please enter correct Password";
                $this->load->view('changePassword_view', $data);
            }
        }
        else
            $this->load->view('changePassword_view', $data);    
    }
    
    
    public function viewUsers()
    {
        if(!$this->session->userdata('UserID') || $this->session->userdata('UserType') != 'system')
        {
            redirect(site_url().'main', 'location');
            return;
        }
        $this->load->model('user');
        $users = $this->user->allUsers();
        $t = array('users' =>$users );

        $this->load->view('allUsers_view',$t);
    }
    public function edit(){}
    public function view($UID)
    {
        if(!$this->session->userdata('UserID'))
        {
            redirect(site_url().'main', 'location');
            return;
        }
        $this->load->model('user');
        $data['user'] = $this->user->userDetails($UID);
        if($data['user'])
            $this->load->view('profile_view', $data);
        else
            $this->load->view('404_view', $data);
//        print_r($data);
        
        
    }
}
/* End of file accounts.php */
/* Location: ./system/controllers/accounts.php */    