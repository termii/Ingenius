<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feed extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('xml');
        $this->load->helper('text');
        $this->load->model('stories_model');
	}

	function index()
	{
	    $data['posts'] = $this->stories_model->get_stories_feed(10);  
	    header("Content-Type: application/rss+xml");
	    $this->load->view('pages/rss', $data);
	}
	
}
