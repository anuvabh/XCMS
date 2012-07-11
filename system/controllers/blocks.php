<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blocks extends CI_Controller{

    public function view(){}//to have options for freezing and generating
    public function create()
    {   
        if(!$this->session->userdata('UserID') || $this->session->userdata('UserType') != 'system')
        {
            redirect(site_url().'main', 'location');
            return;
        }

        $Year = $this->input->post('Year');
        $Room = $this->input->post('Room');
        $Department = $this->input->post('Department');
        $data = array('errorMessage' => '');
        
        if(strlen($Room) > 0)
        {
            $error = 0;
            if(!is_numeric($Room))
            {
                $error = 1;
                $data['errorMessage'] .= "Room number should be numeric<br />";
            }
            else
            {
                $this->load->model('block');
                $blockID = $this->block->fetchBlockID($Department, $Year, $Room);
                if($blockID != 0)
                {
                    $error = 1;
                    $data['errorMessage'] .= "Block already exists<br />";
                }
            }
            if($error == 0)
            {
                $this->block->createBlock($Department, $Year, $Room);
                header("Refresh:2; URL=http://localhost/xcms/main");
                $d = array ( 'message' => "Block created",
                                'image' => "blocks.gif");
                $this->load->view('displayPrompt_view', $d);
//                echo "Block created";
            }
                else
            {
                $this->load->model('user');
                $data['dept'] = $this->user->fetchDepartments();

                $this->load->view('newblock_view', $data);
            }

        }
        else
        {
            $this->load->model('user');
            $data['dept'] = $this->user->fetchDepartments();

            $this->load->view('newblock_view', $data);
        }
    }
    public function generateSet()
    {
        if(!$this->session->userdata('UserID') || $this->session->userdata('UserType') != 'system')
        {
            redirect(site_url().'main', 'location');
            return;
        }
        $data = array('errorMessage' => "");

        $Year = $this->input->post('Year');
        $Room = $this->input->post('Room');
        $cr = $this->input->post('cr');
        $net = $this->input->post('net');
        $Department = $this->input->post('Department');

        if(strlen($cr)*strlen($Room)*strlen($net) != 0)
        {
            $error = 0;
            $this->load->model('block');      

            if(!$this->block->checkRoom($Room))
            {
                $data['errorMessage'] .= "Room Number incorrect<br />";
                $error = 1;
            }

            if(!is_numeric($net))
            {
                $data['errorMessage'] .= "Numeric value for numer of codes is required<br />";
                $error = 1;
            }

            if(!is_numeric($Room))
            {
                $data['errorMessage'] .= "Numeric value for room is required<br />";
                $error = 2;
            }
            $this->load->model('user');

            if($this->user->fetchUserID($cr) == 0 || !$this->user->isCR($cr))
            {
                $data['errorMessage'] .= "Username of CR is incorrect <br />";
                $error = 3;
            }

            if(!$this->user->checkDept($cr, $Department))
            {
                $data['errorMessage'] .= "Department and username do not match <br />";
                $error = 3;
            }
            $blockID;
            $blockSetID;
            if($error == 0)
            {
                $blockID = $this->block->fetchBlockID($Department, $Year, $Room); //needs to be checked
                $blockSetID = $this->block->fetchBlockSetsID($blockID);

                if($blockID == 0)
                {
                    $data['errorMessage'] .= "Invalid DATA entered. Please check. <br />";
                    $error = 3;
                }

                if($blockSetID != 0)
                {
                    $data = array('department' => $Department,
                            'year' => $Year,
                            'room' => $Room,
                            'blockID' => $blockID,
                            'blockSetID' => $blockSetID);
                    $this->load->view('freeze_view', $data);
                    $error = 4;
                    return;
                }           

            }
            if($error == 0 )
            {
                $blockSetData = $this->block->generate($this->user->fetchUserID($cr), $net, $blockID);
                $blockSetID = $blockSetData->blockSetID;
                $data = array('codes' => $blockSetData->codes,
                        'blockSetID' => $blockSetID,
                        'blockID' => $blockID,
                        'limit' => $blockSetData->limit);

                $this->load->view('codes_view',$data);
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
            $data['errorMessage'] = "Please fill in all the details<br/>";
            $this->load->model('user');
            $dept = $this->user->fetchDepartments();
            $data['dept'] = $dept;
            $this->load->view('newset_view', $data);
        }
    }
    public function freeze($blockID, $blockSetID)
    {
        
        $this->load->model('block');
        if($this->block->freeze($blockSetID))
        {
            $d = array ( 'message' => "Set ".$blockID."/".$blockSetID." has been frozen<br />".'<a href="http://localhost/xcms/blocks/generateSet">Click to request new set</a>',
                                'image' => "codes.gif");
                        $this->load->view('displayPrompt_view', $d);
//            echo "Set ".$blockID."/".$blockSetID." has been frozen<br />".'<a href="http://localhost/xcms/blocks/generateSet">Click to request new set</a>';

        }
        else
        {
            $d = array ( 'message' => "An error occured. Please try again.");
            $this->load->view('displayPrompt_view', $d);
//            echo "An error occured. Please try again.";

            redirect(site_url().'blocks/generateSet', 'location');
        }
    }
}