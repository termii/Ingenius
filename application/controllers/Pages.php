<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('option_model');
		$this->load->model('pages_model');
		$this->load->model('stories_model');
	}
	public function p($i)
	{
		$data['stories'] = $this->pages_model->get_specific_page($i);
		$data['categories'] = $this->stories_model->get_categories();

		$this->load->helper('captcha');
        $random_number = substr(number_format(time() * rand(),0,'',''),0,6);
          $vals = array(
                 'word' => $random_number,
                 'img_path' => './captcha/',
                 'img_url' => base_url().'captcha/',
                 'img_width' => 140,
                 'img_height' => 32,
                 'expiration' => 7200
                );
        $data['captcha'] = create_captcha($vals);
        $this->session->set_userdata('captchaWord',$data['captcha']['word']);
		
		$this->load->view('header');
		$this->load->view('navigation', $data);
		$this->load->view('pages/single-page', $data);
		$this->load->view('footer');		
	}
	function sitemap()
    {
		$data['pages'] = $this->pages_model->get_all_pages();
		$data['stories'] = $this->stories_model->get_all_posts();

        header("Content-Type: text/xml;charset=iso-8859-1");
        $this->load->view("sitemap",$data);
    }
    function contactdata()
    {             
            $name = preg_replace('/[^A-Za-z0-9\-]/', '', $this->input->post('name', TRUE));
            $lastname = preg_replace('/[^A-Za-z0-9\-]/', '', $this->input->post('lastname', TRUE));
            $email = $this->input->post('email');
            $subject = $this->input->post('subject');
            $message = $this->input->post('message');            

            $this->load->helper('captcha');
            $userCaptcha = $this->input->post('userCaptcha');

            $arr['result'] = 'confirm';
            $arr['message'] = '<ul>';

            $datains = array();
            $newsins = array();

            $arr['result'] = 'confirm';
            $arr['message'] = '<ul>';

            if (strlen($userCaptcha) == 0) {
                $arr['result'] = 'error';
                $arr['message'] .= '<li>'.$this->lang->line('fill_captcha').'</li>';
            } else {
                $word = $this->session->userdata('captchaWord');
                if(strcmp(strtoupper($userCaptcha),strtoupper($word)) == 0){
                } else {
                    $arr['result'] = 'error';
                    $arr['message'] .= '<li>'.$this->lang->line('fill_captchawords').'</li>';
                }
            }
            if (strlen($name) == 0) {
                $arr['result'] = 'error';
                $arr['message'] .= '<li>'.$this->lang->line('fillname').'</li>';
            }

            if (strlen($lastname) == 0) {
                $arr['result'] = 'error';
                $arr['message'] .= '<li>'.$this->lang->line('lastname').'</li>';
            }

            if (strlen($subject) == 0) {
                $arr['result'] = 'error';
                $arr['message'] .= '<li>'.$this->lang->line('fillsubject').'</li>';
            }

            if(!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email)) {
                $arr['result'] = 'error';
                $arr['message'] .= '<li>'.$this->lang->line('fillemail').'</li>';
            }

            if (strlen($message) == 0) {
                $arr['result'] = 'error';
                $arr['message'] .= '<li>'.$this->lang->line('fillmessage').'</li>';
            }

            if ($arr['result'] != 'error') 
            {

            	$config = Array(
                  'protocol' => 'smtp',
                  'smtp_host' => $this->option_model->get_value('appmailserver_url'),
                  'smtp_port' => $this->option_model->get_value('appmailserver_port'),
                  'smtp_user' => $this->option_model->get_value('appmailserver_login'),
                  'smtp_pass' => $this->option_model->get_value('appmailserver_pass'),
                  'mailtype' => 'html',
                  'charset' => 'iso-8859-1',
                  'wordwrap' => TRUE
                );

                $data = Array(
                  'name' => $name,
                  'lastname' => $lastname,
                  'email' => $email,
                  'subject' => $subject,
                  'message' => $message
                );

                $this->load->library('email', $config);
                $this->email->from($this->option_model->get_value('appmailserver_login'));
                $this->email->to($this->option_model->get_value('appmailserver_login'));
                $this->email->subject('Contact Form');
                $message = $this->load->view('emails/contactform', $data, true);
                $this->email->message($message);
                
                if($this->email->send())
                {
                    $arr['result'] = 'confirm';
                    $arr['message'] = $this->lang->line('sentemailsuccess');
                }
                else
                {
                    $arr['result'] = 'error';
                    $arr['message'] = $this->email->print_debugger();
                }

            }

            echo json_encode($arr);   
    }

}
