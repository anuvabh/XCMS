<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Events extends CI_Controller {//roles to be dne

        public function index()
        {
            $this->load->model('event');
            $events = $this->event->all();
            $data = array('events' => $events);
           
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
           
            $POSTED = elements(array('eName', 'dd' ,'mm', 'yy', 'dd1', 'mm1', 'yy1', 'social', 'eDetails','creditType','roleCount', 'choice'), $arr);
            $POSTED['dept'] = $this->session->userdata('Department');
            $POSTED['social'] = $POSTED['social'] == '1' ? 1 : 0;
            $POSTED['creditType'] = $POSTED['creditType'] == 1 ? 'hours' : 'atomic';
            $POSTED['stdt'] = $POSTED['yy'].'-'.$POSTED['mm'].'-'.$POSTED['dd'];
            $POSTED['edt'] = $POSTED['yy1'].'-'.$POSTED['mm1'].'-'.$POSTED['dd1'];
            
            if($POSTED['eName'])
            {
                $i = 1;
                $roles = array();
                $credits = array();
                $visible = array();               
                $i = 0;
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
//                print_r($POSTED);
                $this->load->model('event');
                if($POSTED['choice']=='open')
                    $this->event->create($POSTED,0);
                else
                    $this->event->create($POSTED,1);
                header("Refresh:2; URL=".site_url()."events/view");
                $d = array ( 'message' => "Event created",
                                'image' => "events.gif");
                $this->load->view('displayPrompt_view', $d);
//                echo "Event Created";
            }
            else
            {
                $data['save'] = 1;
                $this->load->view('events/create_view', $data);
                
            }
        }
        
	public function view()
        {
            if(!$this->session->userdata('UserID')) 
            {
                redirect(site_url(), 'location');
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
            else
            {
                redirect(site_url(), 'location');
                return;
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
            $d = array ( 'message' => "Event deleted",
                                'image' => "events.gif");
                $this->load->view('displayPrompt_view', $d);
//            echo "Event deleted";
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
            $status = $this->event->getStatus($EID);

            if($getDept['Department'] != $this->session->userdata('Department'))
            {
                redirect(site_url().'main', 'location');
                return;
            }
            $data = $this->event->getRoles($EID);
            $data['cType'] = $data['details'][0]['Unit'] == 'atomic' ? 0 : 1;
            
            $this->session->set_userdata('EID',$EID);
            
            
            $this->load->helper('array');
            
            $arr = $this->input->post();
          
            
            
            $POSTED = elements(array('eName', 'dd' ,'mm', 'yy', 'dd1', 'mm1', 'yy1', 'social', 'eDetails','creditType', 'roleCount', 'credit0', 'choice'), $arr);
            $data['save'] = $status == -1 ? 1 : 0;
            if($POSTED['eName'])
            {
                $POSTED['dept'] = $this->session->userdata('Department');
                $POSTED['social'] = $POSTED['social'] == '1' ? 1 : 0;
                if(isset($arr) && count($arr)>0)
                $data['cType'] = $arr['creditType'] == '1' ? 1 : 0;
                $POSTED['creditType'] = $POSTED['creditType'] == '1' ? 'hours' : 'atomic';
                $POSTED['stdt'] = $POSTED['yy'].'-'.$POSTED['mm'].'-'.$POSTED['dd'];
                $POSTED['edt'] = $POSTED['yy1'].'-'.$POSTED['mm1'].'-'.$POSTED['dd1'];
                $POSTED['EID'] = $this->session->userdata('EID');
                $data['EID'] = $this->session->userdata('EID');
                
                
                
                $this->session->unset_userdata('EID');
                
                $i = 0;
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
                
                $POSTED['roleCount'] = $j;
                $POSTED['roles'] = $roles;
                $POSTED['credits'] = $credits;
                $POSTED['visible'] = $visible;
                
                $this->load->model('event');
                if($POSTED['choice']=='open')
                {
                    if($status == -1)
                        $this->event->create($POSTED,12);
                    else
                    $this->event->create($POSTED,10);
                }
                else
                    $this->event->create($POSTED,11);
                
                header("Refresh:2; URL=http://localhost/xcms/events/view");
                $d = array ( 'message' => "Event updated",
                                'image' => "events.gif");
                $this->load->view('displayPrompt_view', $d);
//                echo "Event Updated";
            }
            else
            {
                $data['EID'] = $EID;
                if($status==-1)
                    $this->load->view('events/saved_view',$data);
                else
                    $this->load->view('events/create_view',$data);
            }
            
        }
        
        
        
	public function viewById($EID=-1){}
	public function register($EID=-1)
        {
            if(!$this->session->userdata('UserID') || $this->session->userdata("UserType") == 'system'|| $this->session->userdata("UserType") == 'dept' || $EID==-1) 
            {
                redirect(site_url().'main', 'location');
                return;
            }
            $this->load->model('event');
            if ($this->event->isRegistered($EID, $this->session->userdata('UserID')) == 1)
            {
                header("Refresh:2; URL=".site_url()."events/");
                $d = array ('message' => "You are Already Registered, Check Other Events Attend",
                            'image' => "events.gif");
                $this->load->view('displayPrompt_view', $d);
//                    echo "You are already Registered";
                return;
            }
            $this->load->helper("array");
            $arr = $this->input->post();
            if(isset($arr['Posted']))
            {
                if(isset($arr['roleSelect']))
                {
                   
                   
                    $a = $this->input->post('roleSelect');
                    $this->event->register($EID, $this->session->userdata('UserID'), $a);
                    
                    header("Refresh:2; URL=".site_url()."events/");
                                    $d = array ( 'message' => "You have been registered for this event",
                                'image' => "events.gif");
                    $this->load->view('displayPrompt_view', $d);
//                    echo "Registered";
                }
            }
            else
            {
                
                $data = $this->event->getPublicDetails($EID);
                
                
                $this->load->view('events/register_view',$data);
            }
        }
	public function close($EID)
        {
            //echo $EID;
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
            
            $this->event->close($EID);
            header("Refresh:2; URL=".site_url()."events/view");
                            $d = array ( 'message' => "Event closed",
                                'image' => "events.gif");
            $this->load->view('displayPrompt_view', $d);
//                echo "Event Closed";
            
        }
        
        public function open($EID)
        {
            //echo $EID;
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
            
            $this->event->open($EID);
            header("Refresh:2; URL=".site_url()."events/view");
            
                            $d = array ( 'message' => "Event open",
                                'image' => "events.gif");
            $this->load->view('displayPrompt_view', $d);
//                echo "Event Open";
            
        }
        
	public function viewAssociated($EID=-1)
        {
            if(!$this->session->userdata('UserID') || $this->session->userdata("UserType") == 'student'|| $this->session->userdata("UserType") == 'cr' || $EID==-1) 
            {
                redirect(site_url(), 'location');
                return;
            }
            $this->load->model('event');
            $getDept = $this->event->getDepartment($EID);

            if($getDept['Department'] != $this->session->userdata('Department'))
            {
                redirect(site_url(), 'location');
                return;
            }
            $assoc = $this->event->getAssociated($EID);
            $count = count($assoc);
            $this->load->helper('array');
            $POSTED = $this->input->post();
            if(isset($POSTED['posted']))
            {
                for($i=0; $i<$count; $i++)
                {
                    $roleIndex = "Role".$i;
                    $stateIndex = "State".$i;
                    $UIDIndex = "UID".$i;
                    $accIndex = "accredit".$i;
                    if(isset($POSTED[$roleIndex]))
                    {
//                        echo $POSTED[$roleIndex];
                        if(isset($POSTED[$accIndex]))
                        {
                            $this->event->updateState($EID, $POSTED[$roleIndex], 'accredited', $POSTED[$UIDIndex]);

                            $this->accredit($EID,$POSTED[$UIDIndex],$POSTED[$roleIndex]);
                        }
                        else
                        $this->event->updateState($EID, $POSTED[$roleIndex], $POSTED[$stateIndex], $POSTED[$UIDIndex]);

                    }
                    //echo $POSTED[$roleIndex]."  ".$POSTED[$stateIndex]."  ".$POSTED[$UIDIndex];
                    
                    //$this->event->updateState($EID, $POSTED['stateIndex'], $POSTED['roleIndex']);
                    
                }
//                $this->event->updateState($EID, $POSTED['State'], $POSTED['Role']);
//                if($POSTED['State'] == 'accredited')
//                {
//                    $this->accredit($EID,);
//                }
                header("Refresh:2; URL=".site_url()."events/view");
                
                            $d = array ( 'message' => "Event updated",
                                'image' => "events.gif");
                $this->load->view('displayPrompt_view', $d);
//                echo "UPDATED";
            }
            else
            {
                
                $eName = $this->event->geteventName($EID);
                $data = array('associated' => $assoc,
                                'count' => count($assoc),
                                'eName' => $eName);
                
                $data['EID'] = $EID;
                $det = $this->event->getRoles($EID);
                $data['roles'] = $det['roles'];
                $data['details'] = $det['details'][0];
                //$this->accredit('2323');
                $this->load->view('events/associated_view', $data);
            }
        }
	public function accredit($EID=-1, $UID, $role)
        {
            if(!$this->session->userdata('UserID') || $this->session->userdata("UserType") == 'student'|| $this->session->userdata("UserType") == 'cr' || $EID==-1) 
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
            $this->event->accredit($EID, $UID, $role);
        }
        function profile($EID=-1)
        {
            if($EID==-1) 
            {
                redirect(site_url(), 'location');
                return;
            }
            $this->load->model("event");
            $data = $this->event->getPublicDetails($EID);          
            
            $this->load->view('events/register_view',$data);
        }
}