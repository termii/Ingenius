<?php
class Newsletter_model extends CI_Model {

    public function get_stories($offset = null, $search = "", $filter = "Popular") 
	{
        
		//$this->db->where('post_by', $userid);
		$this->db->select('posts.*, users.*, COUNT(post_comments.posts_id) AS numbercomments');
		$this->db->join('users', 'posts.post_by = users.user_id', 'left');
		$this->db->join('post_comments', 'posts.post_id = post_comments.posts_id', 'left');
		//$this->db->order_by("post_date", "desc"); 
		$this->db->group_by("posts.post_id");		
		
		if ($filter == "Recent") {
			$this->db->order_by("post_date", "desc");
		} else if ($filter == "Most Comment") {
			$this->db->order_by("numbercomments", "desc");
		} else {
			$this->db->order_by("post_upvote", "desc");			
		}

		if (strlen($search)>1) {
			$this->db->like('posts.post_subject', $search);			
		}
		
		//$query = $this->db->get(); 
		$query = $this->db->get('posts', 10, $offset);
		//$this->output->enable_profiler(TRUE);		
		return $query->result_array();

	}
	public function get_emails_subscribers()
	{
	    $query = $this->db->get('stories');
	    return $query->result_array();
	}	
	
}
?>
