<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Events extends CI_Controller {//roles to be dne

        public function index()
        {
            $this->load->model('event');
            $events = $this->event->all();
            $data = array('events' => $events);
            //print_r($data['events']);
            $this->load->view('events/all_view', $data);
        }
	public function create()
        {
            
            if(!$this->session->userdata('UserID') || ($this->session->userdata('UserType') != 'system' && $this->session->userdata('UserType') != 'dept'))
            {
                redirect(site_url().'main', 'location');
                return;
            }
            $this->load->helper('array');
            
            $arr = $this->input->post();
           
            $POSTED = elements(array('eName', 'dd' ,'mm', 'yy', 'dd1', 'mm1', 'yy1', 'social', 'eDetails','creditType','roleCount'), $arr);
            $POSTED['dept'] = $this->session->userdata('Department');
            $POSTED['social'] = $POSTED['social'] == '1' ? 1 : 0;
            $POSTED['creditType'] = $POSTED['creditType'] == 1 ? 'hours' : 'atomic';
            $POSTED['stdt'] = $POSTED['yy'].'-'.$POSTED['mm'].'-'.$POSTED['dd'];
            $POSTED['edt'] = $POSTED['yy1'].'-'.$POSTED['mm1'].'-'.$POSTED['dd1'];
            //print_r($arr);
            if($POSTED['eName'])
            {
                $i = 1;
                $roles = array();
                $credits = array();
                $visible = array();
//                while($i<=$POSTED['roleCount'])
//                {
//                    $index = "role".$i;
//                    $roles[$i-1] = $arr[$index];
//                    $index = "credit".$i;
//                    $credits[$i-1] = $arr[$index];
//                    $i++;
//                }
//                
                $i = 1;
                $j = 0;
                while($i<=$POSTED['roleCount'])
                {
                    $index = "role".$i;
                    if(isset($arr[$index]))
                    {
                        $roles[$j] = $arr[$index];
                        $index = "credit".$i;
                        $credits[$j] = $arr[$index];
                        $index = "check".$i;
                        $arr[$index] = isset($arr[$index]) ? 1 : 0;
                        $visible[$j] = $arr[$index];
                        $j++;
                    }
                    
                    $i++;
                }
                
                $POSTED['roleCount'] = $j;
                
                $POSTED['roles'] = $roles;
                $POSTED['credits'] = $credits;
                $POSTED['visible'] = $visible;
                //print_r($POSTED);
                $this->load->model('event');
                $this->event->create($POSTED);
                header("Refresh:2; URL=http://localhost/xcms/");
                echo "Event Created";
            }
            else
                $this->load->view('events/create_view');
        }
        
	public function view()
        {
            if(!$this->session->userdata('UserID')) 
            {
                redirect(site_url().'main', 'location');
                return;
            }
            $userType = $this->session->userdata("UserType");
            if($userType == 'dept' || $userType == 'system')
            {
                $this->load->model('event');
                $events = $this->event->details($this->session->userdata("Department"),$this->session->userdata("UserType"));
                
                $data = array('events'=>$events);
                $this->load->view('events/event_view',$data);
            }
            
        }
        
	public function delete($EID)
        {
            if(!$this->session->userdata('UserID') || $this->session->userdata("UserType") == 'student' || !$EID) 
            {
                redirect(site_url().'main', 'location');
                return;
            }
            $this->load->model('event');
            $this->event->delete($EID);
            header("Refresh:2; URL=http://localhost/xcms/events/view");
            echo "Event deleted";
        }
	public function edit($EID)
        {
            if(!$this->session->userdata('UserID') || $this->session->userdata("UserType") == 'student'|| $this->session->userdata("UserType") == 'cr' || !$EID) 
            {
                redirect(site_url().'main', 'location');
                return;
            }
            $this->load->model('event');
            $getDept = $this->event->getDepartment($EID);
            
            if($getDept['Department'] != $this->session->userdata('Department'))
            {
                redirect(site_url().'main', 'location');
                return;
            }
            $data = $this->event->getRoles($EID);
            
            $this->session->set_userdata('EID',$EID);
            //$this->load->view('events/create_view', $data);
            
            $this->load->helper('array');
            
            $arr = $this->input->post();
            //print_r($arr);
            
            $POSTED = elements(array('eName', 'dd' ,'mm', 'yy', 'dd1', 'mm1', 'yy1', 'social', 'eDetails','creditType', 'roleCount'), $arr);
            $POSTED['dept'] = $this->session->userdata('Department');
            $POSTED['social'] = $POSTED['social'] == '1' ? 1 : 0;
            $POSTED['creditType'] = $POSTED['creditType'] == 1 ? 'hours' : 'atomic';
            $POSTED['stdt'] = $POSTED['yy'].'-'.$POSTED['mm'].'-'.$POSTED['dd'];
            $POSTED['edt'] = $POSTED['yy1'].'-'.$POSTED['mm1'].'-'.$POSTED['dd1'];
            $POSTED['EID'] = $this->session->userdata('EID');
            $this->session->unset_userdata('EID');

            
            /*
             $i = 1;
                $j = 0;
                while($i<=$POSTED['roleCount'])
                {
                    $index = "role".$i;
                    if(isset($arr[$index]))
                    {
                        $roles[$j] = $arr[$index];
                        $index = "credit".$i;
                        $credits[$j] = $arr[$index];
                        $index = "check".$i;
                        $visible[$j] = $arr[$index];
                        $j++;
                    }
                    
                    $i++;
                }
             */
            
            
            if($POSTED['eName'])
            {
                $i = 1;
                $j = 0;
                $roles = array();
                $credits = array();
                $visible = array();
                
                while($i<=$POSTED['roleCount'])
                {
                    $index = "role".$i;
                    if(isset($arr[$index]))
                    {
                        $roles[$j] = $arr[$index];
                        $index = "credit".$i;
                        $credits[$j] = $arr[$index];
                        $index = "check".$i;
                        $arr[$index] = isset($arr[$index]) ? 1 : 0;
                        $visible[$j] = $arr[$index];
                        $j++;
                    }
                    
                    $i++;
                }
                //print_r($arr);
                $POSTED['roleCount'] = $j;
                $POSTED['roles'] = $roles;
                $POSTED['credits'] = $credits;
                $POSTED['visible'] = $visible;
                print_r($POSTED);
                $this->load->model('event');
                $this->event->create($POSTED,1);
                
                header("Refresh:2; URL=http://localhost/xcms/events/view");
                echo "Event Updated";
            }
            else
                $this->load->view('events/create_view',$data);
            
        }
	public function viewById($EID=-1){}
	public function register($EID=-1)
        {
            //$this->load->
        }
	public function close(){}
	public function viewAssociated($EID=-1){}
	public function accredit($EID=-1){}
}
