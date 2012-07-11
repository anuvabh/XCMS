<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function createDepartment()
        {
            $this->load->helper('array');
            $data = array(
                'err' => "");
            if(!$this->session->userdata('UserID') || $this->session->userdata('UserType') != 'system')
            {
                redirect(site_url().'main', 'location');
                return;
            }
            
            $this->load->model("block");
            $arr = $this->input->post();
            $POSTED = elements(array('year', 'Email', 'dname', 'dcode', 'Password1', 'Password', 'type', 'room1', 'room2', 'room3', 'room4', 'room5'), $arr);
            if(!($POSTED['Email']  && $POSTED['dname'] && $POSTED['dcode'] && $POSTED['Password1'] && $POSTED['Password1']))
            {
                $data['err'] = "Please fill all fields";
                $this->load->view('createDepartment_view',$data);
                return;
            }
            $POSTED['type'] = $POSTED['type']== 1 ? "academic" : "nonacademic";

            $err = false;
            if($POSTED['dname'])
            {
                if($this->block->departmentExists($POSTED['dcode'], $POSTED['dname']) == 1)
                {
                    $this->block->createDepartment($POSTED['dname'], $POSTED['dcode'], $POSTED['type']);
                    $dt = array(
                        'FirstName' => $POSTED['dname'],
                        'LastName' =>  'Department',
                        'Department' =>  $POSTED['dcode'],
                        'Roll' => 0,
                        'Email' =>  $POSTED['Email'],
                        'Password' =>  $POSTED['Password']
                    );                    

                    $this->load->model('user');                    
                    $res = $this->user->register($dt, 'dept');
                    if($res->error)
                    {
                        $err = true;
                        $this->block->removeDepartment($POSTED['dcode']);
                        $data['err'] = "Username already exists. Please select another username.";
                        $this->load->view('createDepartment_view',$data);
                    }
                    else
                    {
                        if($POSTED['room1'])
                        {

                            $bockID = $this->block->createBlock($POSTED['dcode'],1,$POSTED['room1']);

                            if($POSTED['room2'])
                            {
                                sleep(1);
                                $bockID = $this->block->createBlock($POSTED['dcode'],2,$POSTED['room2']);


                                if($POSTED['room3'])
                                {
                                    sleep(1);
                                    $bockID = $this->block->createBlock($POSTED['dcode'],3,$POSTED['room3']);

                                    if($POSTED['room4'])
                                    {
                                        sleep(1);
                                        $bockID = $this->block->createBlock($POSTED['dcode'],4,$POSTED['room4']);

                                        if($POSTED['room5'])
                                        {
                                            sleep(1);
                                            $bockID = $this->block->createBlock($POSTED['dcode'],5,$POSTED['room5']);

                                        }
                                    }
                                }
                            }
                        }
                    }            
                }
                else
                {
                    if($POSTED['dcode'] && $POSTED['type'])
                    {
                        $data['err']="Please enter correctly";
                        $err = true;
                        
                    }
                    $this->load->view('createDepartment_view',$data);
                }
                if(!$err && $POSTED['dname'])
                {
                    header("Refresh:2; URL=http://localhost/xcms/");
                    $d = array ( 'message' => "Department created",
                                'image' => "department.gif");
                    $this->load->view('displayPrompt_view', $d);
                }
            }
            else
            {
                $this->load->view('createDepartment_view',$data);
            }           
        }
        public function createCR()
        {
            $data['choice'] = 1;
            $this->load->view('CRcreate_view', $data);
            return;
        }
        public function deleteDepartment()
        {
            
            $data = array(
                'err' => "");
            if(!$this->session->userdata('UserID') || $this->session->userdata('UserType') != 'system')
            {
                redirect(site_url().'main', 'location');
                return;
            }
           
            $dcode = $this->input->post('Dcode');
            $this->load->model('block');
            if($dcode)
            {
                if($this->block->departmentExists($dcode) == 1)
                {
                    $data['err'] = "No such Department. Please enter correctly.";
                    $this->load->view('removeDept_view',$data);
                }
                else
                {
                    if($dcode != 'ADMIN')
                    {
                        $this->block->removeDepartment($dcode);
                        header("Refresh:2; URL=http://localhost/xcms/");
                        $d = array ( 'message' => "Department deleted",
                                'image' => "department.gif");
                        $this->load->view('displayPrompt_view', $d);
                        //echo "Department deleted";
                        
                    }
                    else
                    {
                         $data['err'] = "No such Department. Please enter correctly.";
                         $this->load->view('removeDept_view',$data);
                    }
                }
            }
            else
            $this->load->view('removeDept_view',$data);
        }
	public function editDepartment(){}
	public function viewRegistry(){}
	public function editRegistry(){}
	public function viewActionLog(){}
	public function viewErrorLog(){}
}