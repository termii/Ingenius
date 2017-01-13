<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('backend/admin_model');
		$this->load->model('stories_model');

		if (!$this->admin_model->check_admin()) die("admin only");
        
	}
    /* dashboard */
	public function index() 
	{
		redirect('/admin/dashboard', 'location');
	}
	public function dashboard()
    {
        $sel['sel'] = "dashboard";

        $data['estat1']=$this->admin_model->get_num_users();
		$data['estat2']=$this->admin_model->get_num_stories();
		$data['estat3']=$this->admin_model->get_num_comments();
		$data['estat4']=$this->admin_model->get_num_subscribers();

		$data['stories']=$this->admin_model->get_recent_stories();	
		$data['comments']=$this->admin_model->get_recent_comments();
		$data['users']=$this->admin_model->get_recent_users();
		
		$this->load->view('backend/header');
        $this->load->view('backend/navigation', $sel);
        $this->load->view('backend/dashboard', $data);
        $this->load->view('backend/footer');
    }
	/* users menu */
	public function users()
	{
		$sel['sel'] = "users";

		$this->load->view('backend/header');
        $this->load->view('backend/navigation', $sel);
        $this->load->view('backend/users');
        $this->load->view('backend/footer');
	}
	public function loadusers()
	{
		$p = $this->input->post('p');
		
		$data['users'] = $this->admin_model->get_users('', $p, '', 'all');		
		
		$this->load->view('backend/ajaxcontent/loadUsers', $data);
	}
	function adduser() {
		$sel['sel'] = "users";

		$this->load->view('backend/header');
        $this->load->view('backend/navigation', $sel);
        $this->load->view('backend/useradd');
        $this->load->view('backend/footer');
	}
	public function removeuser()
	{		
		if ($_SERVER['SERVER_NAME'] == "labs.psilva.pt") return false;		
		$i = $this->input->post('i');
		$this->db->where(array("user_id"=>$i));
		$this->db->delete("users");
	}
	function edituser($i) {
		$sel['sel'] = "users";

		$data['stories'] = $this->admin_model->get_specific_user($i);

		$this->load->view('backend/header');
        $this->load->view('backend/navigation', $sel);
        $this->load->view('backend/useredit', $data);
        $this->load->view('backend/footer');
	}
	public function usereditdata() {
		
			if ($_SERVER['SERVER_NAME'] == "labs.psilva.pt") return false;	
			
			$user_id =  $_POST['user_id'];			
			$user_name =  $_POST['user_name'];
			$user_lastname =  $_POST['user_lastname'];
			$user_email =  $_POST['user_email'];
			$level =  $_POST['level'];
            
			$data = array(
				'user_name' => $user_name,
				'user_lastname' => $user_lastname,
				'user_email' => $user_email,
				'user_level' => $level
			);

			$this->db->where('user_id', $user_id);
			$this->db->update('users', $data); 
			
			echo "edit";	 
	}
	public function useradddata() 
	{
		if ($_SERVER['SERVER_NAME'] == "labs.psilva.pt") return false;	
						
			$user_name =  $_POST['user_name'];
			$user_lastname =  $_POST['user_lastname'];
			$user_email =  $_POST['user_email'];
			$level =  $_POST['level'];
			$password = $_POST['user_pass'];
			
			if ($password) {
				$salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));
				$passwordins = hash('sha256', $password . $salt); 
				for($round = 0; $round < 65536; $round++){ $passwordins = hash('sha256', $passwordins . $salt); }

				$datains['user_pass'] = $passwordins;
				$datains['user_salt'] = $salt;
			} 

			$datains['user_name'] = $user_name;
            $datains['user_lastname'] = $user_lastname;
            $datains['user_email'] = $user_email;
            $datains['user_date'] = date('Y-m-d G:i:s');

			$this->db->insert('users', $datains); 
			
			echo "add";	 
	}
	public function stories()
	{
		$sel['sel'] = "stories";		

		$this->load->view('backend/header');
        $this->load->view('backend/navigation', $sel);
        $this->load->view('backend/stories');
        $this->load->view('backend/footer');
	}
	function editstory($i) {
		$sel['sel'] = "stories";

		$data['stories'] = $this->admin_model->get_specific_story($i);
		$data['categories'] = $this->stories_model->get_categories();

		$this->load->view('backend/header');
        $this->load->view('backend/navigation', $sel);
        $this->load->view('backend/storyedit', $data);
        $this->load->view('backend/footer');
	}
	public function storyeditdata() {
		
			if ($_SERVER['SERVER_NAME'] == "labs.psilva.pt") return false;	

			$id =  $_POST['post_id'];			
			$post_subject =  $_POST['post_subject'];
			$post_url =  $_POST['post_url'];
			$post_text =  $_POST['post_text'];
			$category =  $_POST['category'];

			//delete category assoc
			$this->db->where(array("post_id"=>$id));
			$this->db->delete("categories_posts");

			//insert category
			$data2 = array(
				'post_id' => $id,
				'id_category' => $category
			);
			$this->db->insert('categories_posts', $data2); 

            
			$data = array(
				'post_subject' => $post_subject,
				'post_url' => $post_url,
				'post_text' => $post_text
			);

			$this->db->where('post_id', $id);
			$this->db->update('posts', $data); 
			
			echo "edit";
	 
	 }
	public function loadstories()
	{
		$p = $this->input->post('p');
		
		$data['stories'] = $this->admin_model->get_stories('', $p, '', 'all');
		$this->load->view('backend/ajaxcontent/loadStories', $data);
	}
	public function removestory()
	{
		if ($_SERVER['SERVER_NAME'] == "labs.psilva.pt") return false;
		$i = $this->input->post('i');

		$this->db->where('post_id', $i);        
        $query = $this->db->get_where('posts');

        if ($query->num_rows() > 0) {
        	$row = $query->row_array();
            $image = "images/".$row['post_image'];

            if (file_exists($image)) {
    			unlink($image);
    		}
        }


		$this->db->where(array("post_id"=>$i));
		$this->db->delete("posts");
		
		$this->db->where(array("post_id"=>$id));
		$this->db->delete("categories_posts");

		//remove comments
		$this->db->where(array("posts_id"=>$i));
		$this->db->delete("post_comments");

	}

	public function aprovstory()
	{
		if ($_SERVER['SERVER_NAME'] == "labs.psilva.pt") return false;
		$i = $this->input->post('i');
		$v = $this->input->post('v');

		//if ($v == 1) { $ni = 0; } else { $ni = 1; }
		$dad = array("approved"=>$v);
		$this->db->where(array("post_id"=>$i));
		$this->db->update("posts", $dad);
		//echo $ni;
	}

	/* newsletter subscribers */
	public function subscribers()
	{
		$sel['sel'] = "newsletter";

		$this->load->view('backend/header');
        $this->load->view('backend/navigation', $sel);
        $this->load->view('backend/subscribers');
        $this->load->view('backend/footer');
	}
	public function loadsubscribers()
	{
		$p = $this->input->post('p');
		
		$data['categories'] = $this->admin_model->get_subscribers('', $p, '', 'all');
		$this->load->view('backend/ajaxcontent/loadSubscribers', $data);
	}

	/*categories menu*/
	public function categories()
	{
		$sel['sel'] = "categories";

		$this->load->view('backend/header');
        $this->load->view('backend/navigation', $sel);
        $this->load->view('backend/categories');
        $this->load->view('backend/footer');
	}
	public function loadcategories()
	{
		$p = $this->input->post('p');
		
		$data['categories'] = $this->admin_model->get_categories('', $p, '', 'all');
		$this->load->view('backend/ajaxcontent/loadCategories', $data);
	}
	public function removecategory()
	{
		if ($_SERVER['SERVER_NAME'] == "labs.psilva.pt") return false;
		$i = $this->input->post('i');
		$this->db->where(array("id_category"=>$i));
		$this->db->delete("categories");
	}
	function addcategory() {
		$sel['sel'] = "categories";

		$this->load->view('backend/header');
        $this->load->view('backend/navigation', $sel);
        $this->load->view('backend/categoriesadd');
        $this->load->view('backend/footer');
	}
	function addcategory_data() 
	{
		if ($_SERVER['SERVER_NAME'] == "labs.psilva.pt") return false;

		$name=trim($this->input->post('name', TRUE));
		$category_description=trim($this->input->post('category_description', TRUE));
		$category_color=trim($this->input->post('category_color', TRUE));


		$datains = array();            

        $arr['result'] = 'confirm';
        $arr['message'] = '<ul>';

         
		if (strlen($name) == 0) {
            $arr['result'] = 'error';
            $arr['message'] .= '<li>Please fill the category name.</li>';
        }

        if ($this->admin_model->check_category($name)) {
        	$arr['result'] = 'error';
            $arr['message'] .= '<li>Please choose another category.</li>';
        }
	     
	    
	    if ($arr['result'] != 'error') 
        { 
	     	$datains['category_name'] = $name;
	     	$datains['category_description'] = $category_description;
	     	$datains['category_color'] = $category_color;

	     	$name = preg_replace('/[^A-Za-z0-9\-]/', '', $name);
	     	$datains['category_slug'] = url_title($name,'dash',TRUE);

			$result = $this->db->insert('categories', $datains);

            $arr['result'] = 'confirm';
        	$arr['message'] = 'Category Inserted.';
	    }

        echo json_encode($arr); 


	}
	function editcategory($i) {
		$sel['sel'] = "pages";

		$data['pages'] = $this->admin_model->get_specific_cat($i);

		$this->load->view('backend/header');
        $this->load->view('backend/navigation', $sel);
        $this->load->view('backend/categoriesedit', $data);
        $this->load->view('backend/footer');
	}
	function editcategory_data() 
	{
		if ($_SERVER['SERVER_NAME'] == "labs.psilva.pt") return false;
		$category_name=trim($this->input->post('category_name', TRUE));
		$category_description=trim($this->input->post('category_description', TRUE));	
		$id_category=trim($this->input->post('id_category', TRUE));	
		$category_color=trim($this->input->post('category_color', TRUE));

		$datains = array();            

        $arr['result'] = 'confirm';
        $arr['message'] = '<ul>';
         
		if (strlen($category_name) == 0) {
            $arr['result'] = 'error';
            $arr['message'] .= '<li>Please fill the cat name.</li>';
        }

        
	    if ($arr['result'] != 'error') 
        { 
	     	$datains['category_name'] = $category_name;
	     	$datains['category_description'] = $category_description;
	     	$datains['category_color'] = $category_color;	     	

			$this->db->where('id_category', $id_category);
			$result = $this->db->update('categories', $datains);

            $arr['result'] = 'confirm';
        	$arr['message'] = 'Category Edited.';
	    }

        echo json_encode($arr); 
	}

	/* pages menu */
	/*categories menu*/
	public function pages()
	{
		$sel['sel'] = "pages";

		$this->load->view('backend/header');
        $this->load->view('backend/navigation', $sel);
        $this->load->view('backend/pages');
        $this->load->view('backend/footer');
	}
	public function loadpages()
	{
		$p = $this->input->post('p');
		
		$data['categories'] = $this->admin_model->get_pages('', $p, '', 'all');
		$this->load->view('backend/ajaxcontent/loadPages', $data);
	}
	public function removepage()
	{
		if ($_SERVER['SERVER_NAME'] == "labs.psilva.pt") return false;
		$i = $this->input->post('i');
		$this->db->where(array("id_page"=>$i));
		$this->db->delete("pages");
	}
	function editpage($i) {
		$sel['sel'] = "pages";

		$data['pages'] = $this->admin_model->get_specific_page($i);

		$this->load->view('backend/header');
        $this->load->view('backend/navigation', $sel);
        $this->load->view('backend/pageedit', $data);
        $this->load->view('backend/footer');
	}
	function addpage() {
		$sel['sel'] = "pages";

		$this->load->view('backend/header');
        $this->load->view('backend/navigation', $sel);
        $this->load->view('backend/pageadd');
        $this->load->view('backend/footer');
	}
	function addpage_data() 
	{
		if ($_SERVER['SERVER_NAME'] == "labs.psilva.pt") return false;
		$title=trim($this->input->post('title', TRUE));
		$area=trim($this->input->post('area', TRUE));
		$content=trim($this->input->post('content', TRUE));
		$link=trim($this->input->post('link', TRUE));		

		$title = preg_replace('/[^A-Za-z0-9\-]/', '', $title);


		$datains = array();            

        $arr['result'] = 'confirm';
        $arr['message'] = '<ul>';
         
		if (strlen($title) == 0) {
            $arr['result'] = 'error';
            $arr['message'] .= '<li>Please fill the title name.</li>';
        }

        
	    if ($arr['result'] != 'error') 
        { 
	     	$datains['title'] = $title;
	     	$datains['area'] = $area;
	     	$datains['content'] = $content;
	     	$datains['link'] = $link;
	     	$datains['title_slug'] = url_title($name,'dash',TRUE);

			$result = $this->db->insert('pages', $datains);

            $arr['result'] = 'confirm';
        	$arr['message'] = 'Page Inserted.';
	    }

        echo json_encode($arr); 
	}

	function editpage_data() 
	{
		if ($_SERVER['SERVER_NAME'] == "labs.psilva.pt") return false;
		$title=trim($this->input->post('title', TRUE));
		$area=trim($this->input->post('area', TRUE));
		$content=trim($this->input->post('content', TRUE));
		$link=trim($this->input->post('link', TRUE));
		$id=trim($this->input->post('page_id', TRUE));		

		$title = preg_replace('/[^A-Za-z0-9\-]/', '', $title);


		$datains = array();            

        $arr['result'] = 'confirm';
        $arr['message'] = '<ul>';
         
		if (strlen($title) == 0) {
            $arr['result'] = 'error';
            $arr['message'] .= '<li>Please fill the title name.</li>';
        }

        
	    if ($arr['result'] != 'error') 
        { 
	     	$datains['title'] = $title;
	     	$datains['area'] = $area;
	     	$datains['content'] = $content;
	     	$datains['link'] = $link;
	     	$datains['title_slug'] = url_title($title,'dash',TRUE);

			$this->db->where('id_page', $id);
			$result = $this->db->update('pages', $datains);

            $arr['result'] = 'confirm';
        	$arr['message'] = 'Page Edited.';
	    }

        echo json_encode($arr); 
	}

	/* comments menu */
	public function comments()
	{
		$sel['sel'] = "comments";

		$this->load->view('backend/header');
        $this->load->view('backend/navigation', $sel);
        $this->load->view('backend/comments');
        $this->load->view('backend/footer');
	}
	public function loadcomments()
	{
		$p = $this->input->post('p');
		
		$data['comments'] = $this->admin_model->get_comments('', $p, 'all');
		$this->load->view('backend/ajaxcontent/loadComments', $data);
	}
	public function removecomment()
	{
		$i = $this->input->post('i');
		$this->db->where(array("comment_id"=>$i));
		$this->db->delete("post_comments");
	}

	/* options menu */
	public function options()
	{
		$data['users'] = $this->admin_model->get_stories();
		$data['utila'] = $this->admin_model->get_users('','','','all');
		$sel['sel'] = "options";

		$this->load->view('backend/header');
        $this->load->view('backend/navigation', $sel);
        $this->load->view('backend/options', $data);
        $this->load->view('backend/footer');
	}
	
	public function editoption()
	{
		if ($_SERVER['SERVER_NAME'] == "labs.psilva.pt") return false;
		
		$v = $_POST['v'];
		$i = $this->input->post('i');
		
		$data=array('option_value'=>$v);
		$this->db->where('option_name',$i);
		$this->db->update('options',$data);		
	}

	function savelogo()
    {
    			if ($_SERVER['SERVER_NAME'] == "labs.psilva.pt") return false;	
    			
    			$datains = array();
            	$newsins = array();

            	$arr['result'] = 'confirm';
            	$arr['message'] = '<ul>';

                //edit logo
                if (strlen($_FILES["file"]["name"]) > 1)                
                {
                    $validextensions = array("jpeg", "jpg", "png");
                    $temporary = explode(".", $_FILES["file"]["name"]);
                    $file_extension = end($temporary);

                    if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")) && ($_FILES["file"]["size"] < 400000) && in_array($file_extension, $validextensions)) 
                    {
                        if ($_FILES["file"]["error"] > 0)
                        {
                            echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
                        } else {
                            if (file_exists("images/" . $_FILES["file"]["name"])) 
                            {
                                $arr['result'] = 'erro';
                                $arr['message'] .= '<li>Image already exist.</li>';
                            } else {
                                $sourcePath = $_FILES['file']['tmp_name'];
                                $nameFile   =   time() . "_" . $_FILES['file']['name'];
                                $targetPath = "images/".$nameFile;
                                move_uploaded_file($sourcePath,$targetPath);
                                
                                $datains['option_value'] = $nameFile;

								$this->db->where('option_name','applogo');
								$this->db->update('options',$datains);
                            }
                        }
                    } else {
                        $arr['result'] = 'error';
                        $arr['message'] .= '<li>Invalid File. Extension or size not valid.</li>';
                    }       
                }

                echo json_encode($arr);  

    }

    function saveretinalogo()
    {
    			if ($_SERVER['SERVER_NAME'] == "labs.psilva.pt") return false;	

    			$datains = array();
            	$newsins = array();

            	$arr['result'] = 'confirm';
            	$arr['message'] = '<ul>';

                //edit logo
                if (strlen($_FILES["file"]["name"]) > 1)                
                {
                    $validextensions = array("jpeg", "jpg", "png");
                    $temporary = explode(".", $_FILES["file"]["name"]);
                    $file_extension = end($temporary);

                    if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")) && ($_FILES["file"]["size"] < 400000) && in_array($file_extension, $validextensions)) 
                    {
                        if ($_FILES["file"]["error"] > 0)
                        {
                            echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
                        } else {
                            if (file_exists("images/" . $_FILES["file"]["name"])) 
                            {
                                $arr['result'] = 'erro';
                                $arr['message'] .= '<li>Image already exist.</li>';
                            } else {
                                $sourcePath = $_FILES['file']['tmp_name'];
                                $nameFile   =   time() . "_" . $_FILES['file']['name'];
                                $targetPath = "images/".$nameFile;
                                move_uploaded_file($sourcePath,$targetPath);
                                
                                $datains['option_value'] = $nameFile;

								$this->db->where('option_name','applogoretina');
								$this->db->update('options',$datains);
                            }
                        }
                    } else {
                        $arr['result'] = 'error';
                        $arr['message'] .= '<li>Invalid File. Extension or size not valid.</li>';
                    }       
                }

                echo json_encode($arr);  

    }

    function importwordpress()
    {
    	if ($_SERVER['SERVER_NAME'] == "labs.psilva.pt") return false;

		//upload file
    	$datains = array();

            	$arr['result'] = 'confirm';
            	$arr['message'] = '<ul>';

                //edit logo
                if (strlen($_FILES["file"]["name"]) > 1)                
                {
                    $validextensions = array("xml");
                    $temporary = explode(".", $_FILES["file"]["name"]);
                    $file_extension = end($temporary);

                    if (($_FILES["file"]["size"] < 10000000) && in_array($file_extension, $validextensions)) 
                    {
                        if ($_FILES["file"]["error"] > 0)
                        {
                            echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
                        } else {
                            if (file_exists("files/" . $_FILES["file"]["name"])) 
                            {
                                $arr['result'] = 'erro';
                                $arr['message'] .= '<li>File already exist.</li>';
                            } else {
                                $sourcePath = $_FILES['file']['tmp_name'];
                                $nameFileXML   =   time() . "_" . $_FILES['file']['name'];
                                $targetPath = "files/".$nameFileXML;
                                move_uploaded_file($sourcePath,$targetPath);                                
                            }
                        }
                    } else {
                        $arr['result'] = 'error';
                        $arr['message'] .= '<li>Invalid File. Extension or size not valid.</li>';
                    }       
                }
                

        if ($arr['result'] == "confirm") 
        {
			$importfile = simplexml_load_file("files/".$nameFileXML);		
			$xi=0;
			foreach ($importfile->channel->item as $item) {			
			
			if (!$this->admin_model->verifyexists_title($item->title)) {

				$imageurl = $item->children('wp', true)->attachment_url;

				if ($imageurl) {
					copy($imageurl, 'images/file.png');
	            	$nameFile = time().$xi.".png";
	            	$sourcePath = "images/file.png";
	            	$targetPath = "images/".$nameFile;
	                move_uploaded_file($sourcePath,$targetPath);                
	                rename("images/file.png",$targetPath);

	                $this->load->library('image_lib');
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = $targetPath;
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 900;
                    $config['height'] = 500;

                    $this->image_lib->clear();
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();

	            }
	            
				$datains['post_subject'] = $item->title;                
				$datains['post_by'] = $this->session->userdata('userid');
				$datains['post_image'] = $nameFile;
                $datains['post_date'] = $item->children('wp', true)->post_date;
                $datains['post_text'] = $item->children("content", true);
                $datains['post_slug'] = url_title($item->title,'dash',TRUE);
                $datains['post_type'] = "text";
                $datains['approved'] = 1;

                $result = $this->db->insert('posts', $datains);

                
                $xi++;

            }

            $arr['result'] = 'confirm';
            $arr['message'] = "$xi posts imported successfully.";
		
		}

		}

		echo json_encode($arr);
    }

    function savefavicon()
    {
    			if ($_SERVER['SERVER_NAME'] == "labs.psilva.pt") return false;	

    			$datains = array();
            	$newsins = array();

            	$arr['result'] = 'confirm';
            	$arr['message'] = '<ul>';

                //edit logo
                if (strlen($_FILES["file"]["name"]) > 1)                
                {
                    $validextensions = array("jpeg", "jpg", "png", "ico");
                    $temporary = explode(".", $_FILES["file"]["name"]);
                    $file_extension = end($temporary);

                    if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/x-icon") || ($_FILES["file"]["type"] == "image/jpeg")) && ($_FILES["file"]["size"] < 400000) && in_array($file_extension, $validextensions)) 
                    {
                        if ($_FILES["file"]["error"] > 0)
                        {
                            echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
                        } else {
                            if (file_exists("images/" . $_FILES["file"]["name"])) 
                            {
                                $arr['result'] = 'erro';
                                $arr['message'] .= '<li>Image already exist.</li>';
                            } else {
                                $sourcePath = $_FILES['file']['tmp_name'];
                                $nameFile   =   time() . "_" . $_FILES['file']['name'];
                                $targetPath = "images/".$nameFile;
                                move_uploaded_file($sourcePath,$targetPath);
                                
                                $datains['option_value'] = $nameFile;

								$this->db->where('option_name','appfavicon');
								$this->db->update('options',$datains);
                            }
                        }
                    } else {
                        $arr['result'] = 'error';
                        $arr['message'] .= '<li>Invalid File. Extension or size not valid.</li>';
                    }       
                }

                echo json_encode($arr);  

    }

	
}
