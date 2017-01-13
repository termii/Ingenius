<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Newsletter extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('stories_model');
	}
	public function index()
	{
		$this->load->view('header');
		$this->load->view('navigation');
		$this->load->view('pages/newsletter');
		$this->load->view('footer');
	}
	public function register()
	{
		$email = $this->input->post('email');
		
		$arr['result'] = 'confirm';
        $arr['message'] = '<ul>';

         
		if (strlen($email) == 0) {
            $arr['result'] = 'error';
            $arr['message'] .= '<li>Please fill the email.</li>';
        }

		if ($arr['result'] != 'error') 
        { 
        	$insertcomment=$this->db->insert('newsletter_subscribers',array('email'=>$email));
		
			$arr['result'] = 'confirm';
        	$arr['message'] = 'Successfull Added.';
		}
		echo json_encode($arr);
	}
	public function cronjob()
	{
		$data['stories'] = $this->newsletter_model->get_stories($email);
		$data['emails'] = $this->newsletter_model->get_emails_subscribers();
	}
	
}
