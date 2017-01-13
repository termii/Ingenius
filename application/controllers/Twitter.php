<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Twitter extends CI_Controller {

 function __construct()
 {
   parent::__construct();
   $this->load->model('login_model');
   
   $this->load->library('twitteroauth');
   $this->config->load('twitter');
      
   if($this->session->userdata('access_token') && $this->session->userdata('access_token_secret'))
        {
            // If user already logged in
            $this->connection = $this->twitteroauth->create($this->config->item('twitter_consumer_token'), $this->config->item('twitter_consumer_secret'), $this->session->userdata('access_token'),  $this->session->userdata('access_token_secret'));
        }
        elseif($this->session->userdata('request_token') && $this->session->userdata('request_token_secret'))
        {
            // If user in process of authentication
            $this->connection = $this->twitteroauth->create($this->config->item('twitter_consumer_token'), $this->config->item('twitter_consumer_secret'), $this->session->userdata('request_token'), $this->session->userdata('request_token_secret'));
        }
        else
        {
            // Unknown user
            $this->connection = $this->twitteroauth->create($this->config->item('twitter_consumer_token'), $this->config->item('twitter_consumer_secret'));
        }
   
   
 }

 

    function login() 
    {
        if($this->session->userdata('access_token') && $this->session->userdata('access_token_secret'))
        {
            // User is already authenticated. Add your user notification code here.
            redirect(base_url('/'));
        }
        else
        {
            // Making a request for request_token
            $request_token = $this->connection->getRequestToken(base_url('/twitter/callback'));

            $this->session->set_userdata('request_token', $request_token['oauth_token']);
            $this->session->set_userdata('request_token_secret', $request_token['oauth_token_secret']);
            
            if($this->connection->http_code == 200)
            {
                $url = $this->connection->getAuthorizeURL($request_token);
                redirect($url);
            }
            else
            {
                
            }
        }

        
    }

    public function callback()
    {
       


        if($this->input->get('oauth_token') && $this->session->userdata('request_token') !== $this->input->get('oauth_token'))
        {
            $this->reset_session();
            redirect(base_url('/twitter/login'));
        }
        else
        {
            $access_token = $this->connection->getAccessToken($this->input->get('oauth_verifier'));
        
            if ($this->connection->http_code == 200)
            {
                /*$this->session->set_userdata('access_token', $access_token['oauth_token']);
                $this->session->set_userdata('access_token_secret', $access_token['oauth_token_secret']);
                $this->session->set_userdata('twitter_user_id', $access_token['user_id']);
                $this->session->set_userdata('twitter_screen_name', $access_token['screen_name']);*/
                
                

                if (!$this->login_model->user_exists_twitter($access_token['user_id'])) 
                {
                    $datains['user_name'] = $access_token['screen_name'];
                    $datains['user_twitterid'] = $access_token['user_id'];                    
                    $datains['user_twittername'] = $access_token['screen_name'];                   
                    $datains['user_date'] = date('Y-m-d G:i:s');
                    $datains['user_slug'] = sha1(mt_rand());

                    $result = $this->db->insert('users', $datains);
                }

                $this->db->where('user_twitterid', $access_token['user_id']);
                $query = $this->db->get_where('users');
        
                if ($query->num_rows() > 0) 
                {
                    $row = $query->row_array();

                    $ses_user=array(
                       'twitter'  => $row['user_twitterid'],
                       'userid'  => $row['user_id'],
                       'userslug' => $row['user_slug'],
                       'nome'  => $row['user_name'],
                       'email'  => $row['user_email'],
                       'logged_in'  => TRUE
                    );
                    $this->session->set_userdata($ses_user);

                    redirect(base_url('/'));

                }




                /*$ses_user=array(                     
                       'twitter'  => $access_token['user_id'],
                       'userid'  => $access_token['user_id'],
                       'nome'  => $access_token['screen_name'],
                       'logged_in'  => TRUE
                );
                $this->session->set_userdata($ses_user);*/

                
                /*$this->session->unset_userdata('request_token');
                $this->session->unset_userdata('request_token_secret');*/
                
                redirect(base_url('/'));
            }
            else
            {
                // An error occured. Add your notification code here.
                
                redirect(base_url('/'));
            }
        }
    }

	function logout()
    {
        $this->session->sess_destroy();
        redirect('stories');
    }

	
}

?>