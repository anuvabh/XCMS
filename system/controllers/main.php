<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {
	
	public function index()
	{
		$data = array(
				'message' => 'Log In',
				'errorcode' => -1
				);
		$this->load->view("main_view", $data);
	}
	public function pages($url=''){}
	public function myCredits(){}
}
