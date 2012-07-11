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
                $this->load->model('event');
                if($userType == 'dept' || $userType == 'system')
                    $events = $this->event->fetchPopular(5,$data['Department']);
                else
                    $events = $this->event->fetchPopular(5);
                $data['events'] = $events;
            //we load the relevant view
            if($userType == 'system')
            {
                
                $this->load->view('sysadmin_view', $data);
            }  
            
            else if($userType == 'dept')
            {
                
                $this->load->view('deptadmin_view', $data);
                
            }
            else if($userType == 'student' || $userType == 'cr')
            {
                
                $this->load->view('student_view', $data);
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
    public function myCredits()
    {
        
        if($this->session->userdata('UserType') == 'system' || $this->session->userdata('UserType') == 'dept')
        {
            redirect(site_url(), 'location');
            return;
        }
        
        $this->load->model('user');
        $credits = $this->user->getCredits($this->session->userdata('UserID'));
//        print_r($credits);
        $creditSum = 0;
        $socialSum = 0;
        for($i = 0; $i < count($credits); $i++)
        {
            if($credits[$i]['Unit'] == 'atomic')
                $creditSum += intval($credits[$i]['Amount']) * 30;
            else
                $creditSum += intval($credits[$i]['Amount']);
            
            if($credits[$i]['Social'] == '1')
            {
                if($credits[$i]['Unit'] == 'atomic')
                    $socialSum += intval($credits[$i]['Amount']) * 30;
                else
                    $socialSum += intval($credits[$i]['Amount']);
            }
            
        }
//        echo $creditSum."<br/>";
//        echo $socialSum;
        $socialFull = $socialSum >= 30 ? 1 :  0;
        $data = array (
                'credits' => $credits,  
                'socialSum' => $socialSum,
                'creditSum' => $creditSum,
                'socialFull' => $socialFull);
        
        $this->load->view('credits_view', $data);
    }
    
    public function search()
    {
        $t1 = microtime();
        $keyword =  $this->input->get('search');
        $arr = explode(' ', $keyword);
        
        if($keyword)
        {
            $this->load->model('event');
            $this->load->model('user');

            $users = $this->user->search($arr);
            $events = $this->event->search($arr);

            $data = array('users' => $users,
                    'events' => $events,
                    'keyword' => $keyword);


            $data['time'] = microtime() -  $t1;
            $this->load->view('search_view', $data);
        }
        else
        {
            redirect(site_url(), 'location');
            return;
        }
        
    }
}
/* End of file main.php */
/* Location: ./system/controllers/main.php */    