<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

 function __construct()
 {
   parent::__construct();
   $this->load->model('login_model');
 }

 function index()
 {
    if ($this->session->userdata('logged_in') == TRUE)
    {
        redirect('stories');
    }
    $item['atual'] = "";
    
    $this->load->view('admin/header', $item);
    $this->load->view('admin/login/login');
    $this->load->view('admin/footer');
 }

 function processlogin()
 {

        $username = $this->input->post('username', TRUE);
        $password  = $this->input->post('password', TRUE);
           
        $arr['result'] = 'error';
        $arr['message'] = '<ul>';

        if ((strlen($username) == 0) || (strlen($password) == 0))  {
                $arr['result'] = 'error';
                $arr['message'] .= '<li>'.$this->lang->line('fill_login').'</li>';
                echo json_encode($arr);
                return false;
        } else {

            $this->db->where('user_email', $username);
            $this->db->where('user_facebookid IS NULL', null, false);
            $query = $this->db->get_where('users');
	    
            if ($query->num_rows() > 0) {
            
                $row = $query->row_array();
                $salt = $row['user_salt'];

				$check_password = hash('sha256', $password . $salt); 
				for($round = 0; $round < 65536; $round++){
					$check_password = hash('sha256', $check_password . $salt);
				}
				
				if($check_password != $row['user_pass'])
				{
                    $arr['result'] = 'error';
                    $arr['message'] .= '<li>'. $this->lang->line('email_pass_invalid') .'</li>';
                    echo json_encode($arr);
                    return false;
                }

                $data = array(
                   'userid'  => $row['user_id'],
                   'userslug'  => $row['user_slug'],
                   'nome'  => $row['user_name']." ".$row['user_lastname'],
				   'email'  => $row['user_email'],
                   'avatar'  => $row['user_avatar'],
                   'logged_in'  => TRUE
                );

                $this->session->set_userdata($data);                
                
                $arr['result'] = 'confirm';
                $arr['message'] .= '';
                echo json_encode($arr);
                return false;

            } else {
                    $arr['result'] = 'error';
                    $arr['message'] .= '<li>'.$this->lang->line('email_pass_invalid').'</li>';
                    echo json_encode($arr);
                    return false;
            }
	    }
	    	  
	}

    function fblogin()
    {
        require_once APPPATH.'libraries/facebook/facebook.php';
        $this->config->load('facebook');

        $base_url=$this->config->item('base_url');        
        $facebook = new Facebook(array(
        'appId'     =>  $this->config->item('api_id'), 
        'secret'    => $this->config->item('app_secret'),
        ));
        
        $user = $facebook->getUser();
        
        if($user){
            
            try{
                $user_profile = $facebook->api('/me?fields=id,name,email');  //Get the facebook user profile data
                
                $params = array('next' => $base_url.'login/logout');
                
                //verify if user exists on mysql
                //if exists
                if (!$this->login_model->user_exists($user_profile['id'], $user_profile['email'])) 
                {
                    $datains['user_email'] = $user_profile['email'];
                    $datains['user_name'] = $user_profile['name'];
                    $datains['user_facebookid'] = $user_profile['id'];                    
                    $datains['user_date'] = date('Y-m-d G:i:s');
                    $datains['user_slug'] = sha1(mt_rand());
                    $result = $this->db->insert('users', $datains);
                }

                $this->db->where('user_email', $user_profile['email']);
                $query = $this->db->get_where('users');
        
                if ($query->num_rows() > 0) 
                {
                    $row = $query->row_array();

                    $ses_user=array(
                       'User'=>$user_profile,
                       'logout' =>$facebook->getLogoutUrl($params),
                       'userid'  => $row['user_id'],
                       'nome'  => $user_profile['name'],
                       'email'  => $user_profile['email'],
                       'logged_in'  => TRUE
                    );
                    $this->session->set_userdata($ses_user);

                    header('Location: '.$base_url);

                }

            }catch(FacebookApiException $e){
                error_log($e);
                $user = NULL;
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