<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blocks extends CI_Controller{

	public function view(){}
        public function create(){}
	public function generateSet()
        {
            
            $data = array('errorMessage' => "");
            
            $Year = $this->input->post('Year');
            $Room = $this->input->post('Room');
            $cr = $this->input->post('cr');
            $net = $this->input->post('net');
            $Department = $this->input->post('Department');

            if(strlen($cr)*strlen($Room)*strlen($net) != 0)
            {
                $error = 0;
                if(!is_numeric($net))
                {
                    $data['errorMessage'] .= "Numeric value for code is required<br />";
                    $error = 1;
                }
                if(!is_numeric($Room))
                {
                    $data['errorMessage'] .= "Numeric value for room is required<br />";
                    $error = 2;
                }
                $this->load->model('user');
                if($this->user->fetchUserID($cr) == 0)
                {
                    $data['errorMessage'] .= "Invalid Username <br />";
                    $error = 3;
                }
                $blockID;
                $blockSetID;
                if($error == 0)
                {
                    $this->load->model('block');
                    $blockID = $this->block->fetchBlockID($Department, $Year, $Room); //needs to be checked
                    $blockSetID = $this->block->fetchBlockSetsID($blockID);
                    
                    if($blockSetID != 0)
                    {
                        $this->load->view('freeze_view');
                        $error = 4;
                    }
                }
                if($error == 0 )
                {
                    $blockSetID = $this->block->generate($this->user->fetchUserID($cr), $net, $blockID);
                }
                else
                {
                    $this->load->model('user');
                    $dept = $this->user->fetchDepartments();
                    $data['dept'] = $dept;
                    $this->load->view('newset_view', $data);
                }
                
            }
            else
            {
                $this->load->model('user');
                $dept = $this->user->fetchDepartments();
                $data['dept'] = $dept;
                $this->load->view('newset_view', $data);
            }
        }
	public function freeze(){}
}