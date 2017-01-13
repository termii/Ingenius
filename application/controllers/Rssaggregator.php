<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rssaggregator extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('backend/rssfeeds_model');
		if (!$this->rssfeeds_model->check_admin()) die("admin only");
	}
    /* dashboard */
	public function index() 
	{
		$sel['sel'] = "rssaggregator";

		$this->load->view('backend/header');
        $this->load->view('backend/navigation', $sel);
        $this->load->view('rssaggregator/rssfeeds');        
        $this->load->view('backend/footer');
	}	
	public function loadfeeds()
	{
		$p = $this->input->post('p');
		
		$data['feeds'] = $this->rssfeeds_model->get_feeds();
		$this->load->view('rssaggregator/loadFeeds', $data);
	}
	public function removefeed()
	{
		if ($_SERVER['SERVER_NAME'] == "labs.psilva.pt") return false;
		$i = $this->input->post('i');
		$this->db->where(array("id_feed"=>$i));
		$this->db->delete("feed_source");
	}
	function addfeed() {
		$sel['sel'] = "rssaggregator";
		$data['categories'] = $this->rssfeeds_model->get_categories();

		$this->load->view('backend/header');
        $this->load->view('backend/navigation', $sel);
        $this->load->view('rssaggregator/feedadd', $data);
        $this->load->view('backend/footer');
	}
	function addfeed_data() 
	{
		if ($_SERVER['SERVER_NAME'] == "labs.psilva.pt") return false;
		$description=trim($this->input->post('description', TRUE));
		$url=trim($this->input->post('url', TRUE));
		$numposts=trim($this->input->post('numposts', TRUE));
		$categorydefault=trim($this->input->post('categorydefault', TRUE));

		$datains = array();            

        $arr['result'] = 'confirm';
        $arr['message'] = '<ul>';
         
		if (strlen($description) == 0) {
            $arr['result'] = 'error';
            $arr['message'] .= '<li>Please fill the feed name.</li>';
        }

        if (strlen($url) == 0) {
            $arr['result'] = 'error';
            $arr['message'] .= '<li>Please fill the url.</li>';
        }

        if ($arr['result'] != 'error') 
        { 
	     	$datains['desc_feed'] = $description;
	     	$datains['url_feed'] = $url;
	     	$datains['numposts'] = $numposts;
	     	$datains['categorydefault'] = $categorydefault;	     	

			$result = $this->db->insert('feed_source', $datains);

            $arr['result'] = 'confirm';
        	$arr['message'] = 'Feed Inserted.';
	    }

        echo json_encode($arr); 
	}

	function editrss_data() 
	{
		if ($_SERVER['SERVER_NAME'] == "labs.psilva.pt") return false;
		$description=trim($this->input->post('description', TRUE));
		$url=trim($this->input->post('url', TRUE));
		$numposts=trim($this->input->post('numposts', TRUE));
		$categorydefault=trim($this->input->post('categorydefault', TRUE));
		$id=trim($this->input->post('id_feed', TRUE));		

		$datains = array();            

        $arr['result'] = 'confirm';
        $arr['message'] = '<ul>';
         
		if (strlen($numposts) == 0) {
            $arr['result'] = 'error';
            $arr['message'] .= '<li>Please fill the title name.</li>';
        }

        
	    if ($arr['result'] != 'error') 
        { 
	     	$datains['desc_feed'] = $description;
	     	$datains['url_feed'] = $url;
	     	$datains['numposts'] = $numposts;
	     	$datains['categorydefault'] = $categorydefault;

			$this->db->where('id_feed', $id);
			$result = $this->db->update('feed_source', $datains);

            $arr['result'] = 'confirm';
        	$arr['message'] = 'Rss Edited.';
	    }

        echo json_encode($arr); 
	}


	function editrss($i) {		
		$sel['sel'] = "rssaggregator";

		$data['pages'] = $this->rssfeeds_model->get_feed_specific($i);
		$data['categories'] = $this->rssfeeds_model->get_categories();

		$this->load->view('backend/header');
        $this->load->view('backend/navigation', $sel);
        $this->load->view('rssaggregator/rssedit', $data);
        $this->load->view('backend/footer');
	}


	function importfeed($i)
    {
    	if ($_SERVER['SERVER_NAME'] == "labs.psilva.pt") return false;
		$feeds = $this->rssfeeds_model->get_feed_specific($i);

		if (count($feeds)>0):
		foreach($feeds as $row):
    		
    		$content = file_get_contents($row['url_feed']);
    		$xml = new SimpleXmlElement($content);
    		$namespaces = $xml->getNamespaces(true);

    		$t = 0;
    		$limit = 0;
    		foreach($xml->channel->item as $entry)
            {
            	unset($imageurl);
            	$item['post_slug'] = url_title($entry->title,'dash',TRUE);

            	if (!$this->rssfeeds_model->verifyexists_title($item['post_slug'])) {
	            	
	            if ($limit < $row['numposts']) {
					
					if (trim($imageurl) == "") {
						$imageurl = $entry->enclosure['url'];
					}

					if (trim($imageurl) == "") {
						$imageurl = trim((string)$entry->children($namespaces['media'])->content->attributes()->url);
					}

					if (trim($imageurl) == "") {
						$imag = $entry->children($namespaces['media'])->thumbnail->attributes();
						$imageurl = $imag['url'];
					}

					if (trim($imageurl) == "") {
						@$html = file_get_contents($entry->link);
		            	if(strlen($html)){
							$doc = new DOMDocument();
							@$doc->loadHTML($html);
							$metas = $doc->getElementsByTagName("meta");
							for ($i = 0; $i < $metas->length; $i++)
							{
								$meta = $metas->item($i);
								if(strtolower($meta->getAttribute('property')) == 'og:image') $imageurl = $meta->getAttribute('content');
							}
						}
					}					
					
					if (strlen($entry->title)>5) {
						
						
						
						if (isset($imageurl)) {
						

			            	
			            	$fol = date("Ym");
			            	if  (!file_exists("images/$fol")) {
			            		mkdir("images/$fol", 0777);
			            	}		

			            	copy($imageurl, 'images/'.$fol.'/file.png');	            	
			            	
			            	$nameFile = time().".png";
			            	$sourcePath = "images/".$fol."/file.png";
			            	$targetPath = "images/".$fol."/".$nameFile;
			                move_uploaded_file($sourcePath,$targetPath);                
			                rename("images/".$fol."/file.png",$targetPath);

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
		                    $item['post_image'] = $fol."/".$nameFile;
			            }

		            	if ($entry->link) $parse = parse_url($entry->link);
		            	if ($entry->link) $item['post_domain'] = $parse['host'];

		            	$item['post_type'] = 'link';
		            	$item['post_subject'] = $entry->title;
		                $item['post_text'] = $entry->description;
		                $item['post_url'] = $entry->link;
		                $item['post_date'] = date("Y-m-d G:i:s", strtotime($entry->pubDate));
		                $item['post_by'] = $this->session->userdata('userid');		                	                
		                
		                	$t++;
		                	$this->db->insert('posts',$item);
		                	
		                	$it['post_id'] = $this->db->insert_id();
		                	$it['id_category'] = $row['categorydefault'];
		                	$this->db->insert('categories_posts',$it);

		                }		                
		            }
	            }
	            $limit++;
            }


    	endforeach;
    	endif;

    	$arr['result'] = 'confirm';
        $arr['message'] = "$t posts imported.";        
        echo json_encode($arr);
    }


	
}
