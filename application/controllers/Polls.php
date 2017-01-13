<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Polls extends CI_Controller {

	function __construct()
	{
		parent::__construct();		
		$this->load->helper('form');
		$this->load->model('stories_model');
		$this->load->model('poll_model');
	}
    
	public function show()
	{
		$data['min_options'] = 2;
		$data['max_options'] = 10;
		$data['categories'] = $this->stories_model->get_categories();

		$this->load->view('polls/create', $data);
	}	

	public function create()
	{
		$datains = array();

        $arr['result'] = 'confirm';
        $arr['message'] = '<ul>';

        $title = $this->input->post('title');
        $options = $this->input->post('options');
        $category = trim($this->input->post('category'));
        $post_text = $this->input->post('post_text');
        $postimage = trim($this->input->post('postimage'));

        $rep = base_url()."images/";
        $postimage2 = str_replace($rep,"",$postimage);        

        if (strlen($title) == 0) {
            $arr['result'] = 'pollerror';
            $arr['message'] .= '<li>'.$this->lang->line('category_select').'</li>';
        }

        if (count($options) == 0) {
            $arr['result'] = 'pollerror';
            $arr['message'] .= '<li>'.$this->lang->line('category_select').'</li>';
        }

        if (strlen($category) == 0) {
                $arr['result'] = 'pollerror';
                $arr['message'] .= '<li>'.$this->lang->line('category_select').'</li>';
        }

        if (strlen($postimage) == 0) {
                $arr['result'] = 'error';
                $arr['message'] .= '<li>'.$this->lang->line('fillimagelink').'</li>';
        }


        $poll_data = array(
            'created' => date('Y-m-d h:i:s', time())
        );

        if ($arr['result'] != 'pollerror') 
        {

        	$this->db->insert('polls', $poll_data);
        	$poll_id = $this->db->insert_id();

        	//insert in posts
	        $datains['post_by'] = $this->session->userdata('userid');
	        $datains['post_date'] = date('Y-m-d G:i:s');
	        $datains['post_subject'] = $title;
	        $datains['post_slug'] = url_title($title,'dash',TRUE);
	        $datains['post_type'] = 'poll';
	        $datains['approved'] = 0;
	        $datains['post_poll_id'] = $poll_id;
	        $datains['post_text'] = $post_text;
	        $datains['post_image'] = $postimage2;
	        $this->db->insert('posts', $datains);

	        $dt['post_id'] = $this->db->insert_id();
            $dt['id_category'] = $category;
            $nresult = $this->db->insert('categories_posts', $dt);
	        
			foreach ($options as $option)
	        {
	            $this->db->insert('polls_options', array(
	                'poll_id' => $poll_id,
	                'title' => $option)
	            );
	        }

	        $arr['result'] = 'pollconfirm';
            $arr['message'] .= "Thank you!";
        }
		echo json_encode($arr);		
	}

	function uploadimage()
    {
    	$arr['result'] = 'fileconfirm';
        $arr['message'] = '';

    	if (strlen($_FILES["file"]["name"]) > 1) 				
		{
				$validextensions = array("jpeg", "jpg", "png");
				$temporary = explode(".", $_FILES["file"]["name"]);
				$file_extension = strtolower(end($temporary));

				if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")) && ($_FILES["file"]["size"] < 900000) && in_array($file_extension, $validextensions)) 
				{
					if ($_FILES["file"]["error"] > 0)
					{
						echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
					} else {
						if (file_exists("images/" . $_FILES["file"]["name"])) 
						{
							$arr['result'] = 'fileerror';
	            			$arr['message'] .= '<li>File exists.</li>';
						} else {
							$sourcePath = $_FILES['file']['tmp_name'];
							$nameFile 	=	time() . "_" . $_FILES['file']['name'];
							$targetPath = "images/".$nameFile;
							move_uploaded_file($sourcePath,$targetPath);
							
							//resize
							$this->load->library('image_lib');
							$config['image_library'] = 'gd2';
							$config['source_image']	= $targetPath;
							$config['create_thumb'] = FALSE;
							$config['maintain_ratio'] = TRUE;
							$config['width'] = 900;
							$config['height'] = 900;

							$this->image_lib->clear();
							$this->image_lib->initialize($config);
							$this->image_lib->resize();
							
							$arr['result'] = 'fileconfirm';
	            			$arr['url'] = base_url().$targetPath;							
	            			$arr['message'] = $this->lang->line('uploadedsucessfully');

						}
					}
				} else {
					$arr['result'] = 'fileerror';
	            	$arr['message'] .= '<li>'.$this->lang->line('invalidextension').'</li>';	            
				}		
		}
		echo json_encode($arr); 	
    }

	public function vote()
	{		
		if (!$this->poll_model->if_vote($this->input->post('y'))) {
			$poll_id = $this->input->post('i');
			$option_id = $this->input->post('y');
			$dd['user_id'] = $this->session->userdata('userid');
			$dd['option_id'] = $option_id;
			$dd['ip'] = $this->input->ip_address();
			$result = $this->db->insert('polls_votes', $dd);
		}
	}

	public function open($poll_id)
	{
		$this->poll_model->open_poll($poll_id);
		redirect('', 'refresh');
	}

	public function close($poll_id)
	{
		$this->poll_model->close_poll($poll_id);
		redirect('', 'refresh');
	}


	
}
