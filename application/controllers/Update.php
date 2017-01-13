<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Update extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}
    /* update */
	public function index() 
	{
		if ($_SERVER['SERVER_NAME'] == "labs.psilva.pt") return false;
		
		$query = $this->db->query("SELECT * FROM options WHERE option_name = 'apppostanon'");
		if($query->num_rows() == 0){ $this->db->query("INSERT INTO  `options` (`option_id` ,`option_name` ,`option_value`) VALUES (NULL ,  'apppostanon',  '0')"); }

		$query = $this->db->query("SELECT * FROM options WHERE option_name = 'apppostanonuser'");
		if($query->num_rows() == 0){ $this->db->query("INSERT INTO  `options` (`option_id` ,`option_name` ,`option_value`) VALUES (NULL ,  'apppostanonuser',  '')"); }

		$query = $this->db->query("SELECT * FROM options WHERE option_name = 'appvoteadd'");
		if($query->num_rows() == 0){ $this->db->query("INSERT INTO  `options` (`option_id` ,`option_name` ,`option_value`) VALUES (NULL ,  'appvoteadd',  '1')"); }
		
		$query = $this->db->query("SELECT * FROM options WHERE option_name = 'externalarticle'");
		if($query->num_rows() == 0){ $this->db->query("INSERT INTO  `options` (`option_id` ,`option_name` ,`option_value`) VALUES (NULL ,  'externalarticle',  'iframe')"); }

		$query = $this->db->query("SELECT * FROM options WHERE option_name = 'appnewsletter'");
		if($query->num_rows() == 0){ $this->db->query("INSERT INTO  `options` (`option_id` ,`option_name` ,`option_value`) VALUES (NULL ,  'appnewsletter',  '')"); }

		$query = $this->db->query("SELECT * FROM options WHERE option_name = 'mailchimpurl'");
		if($query->num_rows() == 0){ $this->db->query("INSERT INTO  `options` (`option_id` ,`option_name` ,`option_value`) VALUES (NULL ,  'mailchimpurl',  '')"); }	

		$query = $this->db->query("SELECT * FROM options WHERE option_name = 'appadscodehome'");
		if($query->num_rows() == 0){ $this->db->query("INSERT INTO  `options` (`option_id` ,`option_name` ,`option_value`) VALUES (NULL ,  'appadscodehome',  '')"); }		

		$query = $this->db->query("SELECT * FROM options WHERE option_name = 'appuserranklike'");
		if($query->num_rows() == 0){ $this->db->query("INSERT INTO  `options` (`option_id` ,`option_name` ,`option_value`) VALUES (NULL ,  'appuserranklike',  '0')"); }

		$query = $this->db->query("SELECT * FROM options WHERE option_name = 'appuserrank'");
		if($query->num_rows() == 0){ $this->db->query("INSERT INTO  `options` (`option_id` ,`option_name` ,`option_value`) VALUES (NULL ,  'appuserrank',  '0')"); }

		$query = $this->db->query("SELECT * FROM options WHERE option_name = 'appfbcommentsenable'");
		if($query->num_rows() == 0){ $this->db->query("INSERT INTO  `options` (`option_id` ,`option_name` ,`option_value`) VALUES (NULL ,  'appfbcommentsenable',  '1')"); }

		$query = $this->db->query("SELECT * FROM options WHERE option_name = 'appadsidebar'");
		if($query->num_rows() == 0){ $this->db->query("INSERT INTO  `options` (`option_id` ,`option_name` ,`option_value`) VALUES (NULL ,  'appadsidebar',  '0')"); }

		$query = $this->db->query("SELECT * FROM options WHERE option_name = 'appadscode'");
		if($query->num_rows() == 0){ $this->db->query("INSERT INTO  `options` (`option_id` ,`option_name` ,`option_value`) VALUES (NULL ,  'appadscode',  '')"); }

		$query = $this->db->query("SELECT * FROM options WHERE option_name = 'appadmiddlepost'");
		if($query->num_rows() == 0){ $this->db->query("INSERT INTO  `options` (`option_id` ,`option_name` ,`option_value`) VALUES (NULL ,  'appadmiddlepost',  '')"); }

		$query = $this->db->query("SELECT * FROM options WHERE option_name = 'appsliderlimit'");
		if($query->num_rows() == 0){ $this->db->query("INSERT INTO  `options` (`option_id` ,`option_name` ,`option_value`) VALUES (NULL ,  'appsliderlimit',  '3')"); }

		$query = $this->db->query("SELECT * FROM options WHERE option_name = 'appslideruser'");
		if($query->num_rows() == 0){ $this->db->query("INSERT INTO  `options` (`option_id` ,`option_name` ,`option_value`) VALUES (NULL ,  'appslideruser',  '')"); }

		$query = $this->db->query("SELECT * FROM options WHERE option_name = 'appslidertype'");
		if($query->num_rows() == 0){ $this->db->query("INSERT INTO  `options` (`option_id` ,`option_name` ,`option_value`) VALUES (NULL ,  'appslidertype',  'Recent')"); }

		$query = $this->db->query("SELECT * FROM options WHERE option_name = 'apppostauthor'");
		if($query->num_rows() == 0){ $this->db->query("INSERT INTO  `options` (`option_id` ,`option_name` ,`option_value`) VALUES (NULL ,  'apppostauthor',  '')"); }

		$query = $this->db->query("SELECT * FROM options WHERE option_name = 'appauthor'");
		if($query->num_rows() == 0){ $this->db->query("INSERT INTO  `options` (`option_id` ,`option_name` ,`option_value`) VALUES (NULL ,  'appauthor',  '')"); }

		$query = $this->db->query("SELECT * FROM options WHERE option_name = 'appkeywords'");
		if($query->num_rows() == 0){ $this->db->query("INSERT INTO  `options` (`option_id` ,`option_name` ,`option_value`) VALUES (NULL ,  'appkeywords',  '')"); }
				
		if (!$this->db->field_exists('ip', 'polls_votes')) {	
			$this->db->query("ALTER TABLE  `polls_votes` ADD  `ip` VARCHAR( 30 ) NULL AFTER  `timestamp` ;");
		}
		
		if (!$this->db->field_exists('category_description', 'categories')) {	
			$this->db->query("ALTER TABLE  `categories` ADD  `category_description` TEXT NULL AFTER  `category_color` ;");
		}
				
		if (!$this->db->field_exists('categorydefault', 'feed_source')) {		
			$this->db->query("ALTER TABLE  `feed_source` ADD  `categorydefault` INT( 1 ) NULL AFTER  `numposts` ;");
		}	
				
		if (!$this->db->field_exists('upvote', 'posts_votes')) {			
			$this->db->query("ALTER TABLE  `posts_votes` ADD  `upvote` INT( 11 ) NOT NULL AFTER  `vote_datetime` ;");
		}
		
		if (!$this->db->field_exists('downvote', 'posts_votes')) {				
			$this->db->query("ALTER TABLE  `posts_votes` CHANGE  `downvote`  `downvote` INT( 11 ) NULL DEFAULT  '0';");
		}
		
		if (!$this->db->field_exists('upvote', 'posts_votes')) {				
			$this->db->query("ALTER TABLE  `posts_votes` ADD  `upvote` INT( 11 ) NOT NULL AFTER  `vote_datetime` ;");
		}
				
		if (!$this->db->field_exists('category_color', 'categories')) {				
			$this->db->query("ALTER TABLE  `categories` ADD  `category_color` VARCHAR( 7 ) NOT NULL AFTER  `category_slug` ;");
		}
		
		if (!$this->db->field_exists('post_poll_id', 'posts')) {				
			$this->db->query("ALTER TABLE  `posts` ADD  `post_poll_id` INT( 11 ) NULL AFTER  `post_slug`;");
		}
				
		if (!$this->db->field_exists('category_slug', 'categories')) {
			$this->db->query("ALTER TABLE  `categories` ADD  `category_slug` TEXT NULL AFTER  `category_name`;");
		}


		if (!$this->db->table_exists('reports') )
		{
		 	$this->db->query("CREATE TABLE IF NOT EXISTS `reports` (
  `id_report` int(11) NOT NULL AUTO_INCREMENT,
  `posts_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `desc` text NOT NULL,
  `date` datetime NOT NULL,
  `read` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_report`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;");	 
		}


		if (!$this->db->table_exists('posts_views') )
		{
		 	$this->db->query("CREATE TABLE IF NOT EXISTS `posts_views` (
  `view_id` int(11) NOT NULL AUTO_INCREMENT,
  `view_postid` int(11) NOT NULL,
  `view_userid` int(11) NOT NULL,  
  PRIMARY KEY (`view_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;");	 
		}


		if (!$this->db->table_exists('polls') )
		{
		 	$this->db->query("CREATE TABLE IF NOT EXISTS `polls` (
  `poll_id` int(11) NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `closed` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`poll_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;");	 
		}

		if (!$this->db->table_exists('polls_options') )
		{
		 	$this->db->query("CREATE TABLE IF NOT EXISTS `polls_options` (
  `option_id` int(11) NOT NULL AUTO_INCREMENT,
  `poll_id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`option_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;");	 
		}


		if (!$this->db->table_exists('polls_votes') )
		{
		 	$this->db->query("CREATE TABLE IF NOT EXISTS `polls_votes` (
  `vote_id` int(11) NOT NULL AUTO_INCREMENT,
  `option_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `timestamp` int(10) NOT NULL,
  PRIMARY KEY (`vote_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;");	 
		}


		if (!$this->db->table_exists('posts_tags') )
		{
		 	$this->db->query("CREATE TABLE IF NOT EXISTS `posts_tags` (
  `postid` int(11) NOT NULL,
  `tagid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;");	 
		}


		if (!$this->db->table_exists('tags') )
		{
		 	$this->db->query("CREATE TABLE IF NOT EXISTS `tags` (
  `id_tag` int(11) NOT NULL AUTO_INCREMENT,
  `tag_name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tag_slug` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_tag`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;");	 
		}


		if (!$this->db->table_exists('comments_votes') )
		{
		 	$this->db->query("CREATE TABLE IF NOT EXISTS `comments_votes` (
  `com_voteid` int(11) NOT NULL AUTO_INCREMENT,
  `com_commentid` int(11) NOT NULL,
  `com_userid` int(11) NOT NULL,
  `com_up` int(3) NOT NULL DEFAULT '0',
  `com_down` int(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`com_voteid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;");	 
		}


		$query = $this->db->query("SELECT * FROM options WHERE option_name = 'appcolorbgheader'");
		if($query->num_rows() == 0){ $this->db->query("INSERT INTO  `options` (`option_id` ,`option_name` ,`option_value`) VALUES (NULL ,  'appcolorbgheader',  '#1a1d23')"); }

		$query = $this->db->query("SELECT * FROM options WHERE option_name = 'appcolorbodytext'");
		if($query->num_rows() == 0){ $this->db->query("INSERT INTO  `options` (`option_id` ,`option_name` ,`option_value`) VALUES (NULL ,  'appcolorbodytext',  '#888888')"); }
		
		$query = $this->db->query("SELECT * FROM options WHERE option_name = 'appcolortitlescolor'");
		if($query->num_rows() == 0){ $this->db->query("INSERT INTO  `options` (`option_id` ,`option_name` ,`option_value`) VALUES (NULL ,  'appcolortitlescolor',  '#5fcf80')"); }

		$query = $this->db->query("SELECT * FROM options WHERE option_name = 'appcolornewstitles'");
		if($query->num_rows() == 0){ $this->db->query("INSERT INTO  `options` (`option_id` ,`option_name` ,`option_value`) VALUES (NULL ,  'appcolornewstitles',  '#1a1d23')"); }

		$query = $this->db->query("SELECT * FROM options WHERE option_name = 'appcolorbgfooter'");
		if($query->num_rows() == 0){ $this->db->query("INSERT INTO  `options` (`option_id` ,`option_name` ,`option_value`) VALUES (NULL ,  'appcolorbgfooter',  '#1a1d23')"); }

		$query = $this->db->query("SELECT * FROM options WHERE option_name = 'appcolorfootertitles'");
		if($query->num_rows() == 0){ $this->db->query("INSERT INTO  `options` (`option_id` ,`option_name` ,`option_value`) VALUES (NULL ,  'appcolorfootertitles',  '#5fcf80')"); }

		$query = $this->db->query("SELECT * FROM options WHERE option_name = 'appcolorfootertext'");
		if($query->num_rows() == 0){ $this->db->query("INSERT INTO  `options` (`option_id` ,`option_name` ,`option_value`) VALUES (NULL ,  'appcolorfootertext',  '#7b8b8e')"); }

		$query = $this->db->query("SELECT * FROM options WHERE option_name = 'appcolorfooterlinks'");
		if($query->num_rows() == 0){ $this->db->query("INSERT INTO  `options` (`option_id` ,`option_name` ,`option_value`) VALUES (NULL ,  'appcolorfooterlinks',  '#7b8b8e')"); }

		$query = $this->db->query("SELECT * FROM options WHERE option_name = 'appcolorbuttonsbg'");
		if($query->num_rows() == 0){ $this->db->query("INSERT INTO  `options` (`option_id` ,`option_name` ,`option_value`) VALUES (NULL ,  'appcolorbuttonsbg',  '#5fcf80')"); }

		$query = $this->db->query("SELECT * FROM options WHERE option_name = 'appcolorbuttonstext'");
		if($query->num_rows() == 0){ $this->db->query("INSERT INTO  `options` (`option_id` ,`option_name` ,`option_value`) VALUES (NULL ,  'appcolorbuttonstext',  '#FFFFFF')"); }

		$query = $this->db->query("SELECT * FROM options WHERE option_name = 'appcolorbuttonsbghov'");
		if($query->num_rows() == 0){ $this->db->query("INSERT INTO  `options` (`option_id` ,`option_name` ,`option_value`) VALUES (NULL ,  'appcolorbuttonsbghov',  '#1cb071')"); }

		$query = $this->db->query("SELECT * FROM options WHERE option_name = 'appcolorbuttonstexth'");
		if($query->num_rows() == 0){ $this->db->query("INSERT INTO  `options` (`option_id` ,`option_name` ,`option_value`) VALUES (NULL ,  'appcolorbuttonstexth',  '#FFFFFF')"); }

		$query = $this->db->query("SELECT * FROM options WHERE option_name = 'appfacebookurl'");
		if($query->num_rows() == 0){ $this->db->query("INSERT INTO  `options` (`option_id` ,`option_name` ,`option_value`) VALUES (NULL ,  'appfacebookurl',  '#facebook')"); }

		$query = $this->db->query("SELECT * FROM options WHERE option_name = 'apptwitterurl'");
		if($query->num_rows() == 0){ $this->db->query("INSERT INTO  `options` (`option_id` ,`option_name` ,`option_value`) VALUES (NULL ,  'apptwitterurl',  '#')"); }

		$query = $this->db->query("SELECT * FROM options WHERE option_name = 'appyoutubeurl'");
		if($query->num_rows() == 0){ $this->db->query("INSERT INTO  `options` (`option_id` ,`option_name` ,`option_value`) VALUES (NULL ,  'appyoutubeurl',  '#')"); }

		$query = $this->db->query("SELECT * FROM options WHERE option_name = 'appvimeourl'");
		if($query->num_rows() == 0){ $this->db->query("INSERT INTO  `options` (`option_id` ,`option_name` ,`option_value`) VALUES (NULL ,  'appvimeourl',  '#')"); }

		$query = $this->db->query("SELECT * FROM options WHERE option_name = 'appinstagramurl'");
		if($query->num_rows() == 0){ $this->db->query("INSERT INTO  `options` (`option_id` ,`option_name` ,`option_value`) VALUES (NULL ,  'appinstagramurl',  '#')"); }

		$query = $this->db->query("SELECT * FROM options WHERE option_name = 'apptitleleftcolumn'");
		if($query->num_rows() == 0){ $this->db->query("INSERT INTO  `options` (`option_id` ,`option_name` ,`option_value`) VALUES (NULL ,  'apptitleleftcolumn',  'About Sharen')"); }

		$query = $this->db->query("SELECT * FROM options WHERE option_name = 'appleftcontent'");
		if($query->num_rows() == 0){ $this->db->query("INSERT INTO  `options` (`option_id` ,`option_name` ,`option_value`) VALUES (NULL ,  'appleftcontent',  'content')"); }
		
		$query = $this->db->query("SELECT * FROM options WHERE option_name = 'appfootercopy'");
		if($query->num_rows() == 0){ $this->db->query("INSERT INTO  `options` (`option_id` ,`option_name` ,`option_value`) VALUES (NULL ,  'appfootercopy',  'Copyright &copy; 2015')"); }

		$query = $this->db->query("SELECT * FROM options WHERE option_name = 'appfavicon'");
		if($query->num_rows() == 0){ $this->db->query("INSERT INTO  `options` (`option_id` ,`option_name` ,`option_value`) VALUES (NULL ,  'appfavicon',  '')"); }

		$query = $this->db->query("SELECT * FROM options WHERE option_name = 'appadvarea1'");
		if($query->num_rows() == 0){ $this->db->query("INSERT INTO  `options` (`option_id` ,`option_name` ,`option_value`) VALUES (NULL ,  'appadvarea1',  '')"); }
		
		//posts slug		
		if (!$this->db->field_exists('post_slug', 'posts')) {
			$this->db->query("ALTER TABLE  `posts` ADD  `post_slug` TEXT NULL AFTER  `approved`;");		
			$query = $this->db->query("SELECT * FROM posts");
			if ($query->num_rows() > 0)
	        {
	           foreach ($query->result() as $row)
	           {
	              $post_id = $row->post_id;
	              $post_subject = $row->post_subject;

	              $v = url_title($post_subject,'dash',TRUE);

	              $dad = array("post_slug"=>$v);
	              $this->db->where(array("post_id"=>$post_id));
				  $this->db->update("posts", $dad);
	           }
	        }
        }
		
        if (!$this->db->field_exists('user_gplus', 'users')) {
			$this->db->query("ALTER TABLE  `users` ADD  `user_gplus` TEXT NULL AFTER  `user_twitter` ;");	        
	    }

	    if (!$this->db->field_exists('user_fb', 'users')) {
			$this->db->query("ALTER TABLE  `users` ADD  `user_fb` TEXT NULL AFTER  `user_gplus` ;");	        
	    }

	    if (!$this->db->field_exists('user_instagram', 'users')) {
			$this->db->query("ALTER TABLE  `users` ADD  `user_instagram` TEXT NULL AFTER  `user_fb` ;");	        
	    }

	    if (!$this->db->field_exists('user_pinterest', 'users')) {
			$this->db->query("ALTER TABLE  `users` ADD  `user_pinterest` TEXT NULL AFTER  `user_instagram` ;");	        
	    }

	    

		//users slug
		if (!$this->db->field_exists('user_slug', 'users')) {
			$this->db->query("ALTER TABLE  `users` ADD  `user_slug` TEXT NULL AFTER  `shortbio`;");
	        
	    }

	    $query = $this->db->query("SELECT * FROM users");
			if ($query->num_rows() > 0)
	        {
	           foreach ($query->result() as $row)
	           {
	              $user_id = $row->user_id;
	              $slug = $row->user_name."".$row->user_lastname;

	              $v = url_title($slug,'',TRUE);

	              $dad = array("user_slug"=>$v);
	              $this->db->where(array("user_id"=>$user_id));
				  $this->db->update("users", $dad);
	           }
	        }

		echo "Updated successful! You can now leave this page. Thank you.";


	}

	
}
