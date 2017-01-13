<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Poll_model extends CI_Model {

    protected $polls_table;
    protected $options_table;
    protected $votes_table;

    public function __construct()
    {
        $this->polls_table = 'polls';
        $this->options_table = 'polls_options';
        $this->votes_table = 'votes';
    }

    public function num_polls()
    {
        return $this->db->count_all($this->polls_table);
    }

    public function get_poll($poll_id)
    {
        $this->db->select('poll_id, title, closed');
        $query = $this->db->get_where($this->polls_table, array('poll_id' => $poll_id));
        
        if ($query->num_rows == 1)
        {
            return $query->row_array();
        }
        else
        {
            return FALSE;
        }
    }


    public function get_polls($limit, $offset)
    {
        $this->db->select('poll_id, title, closed')->order_by('created', 'desc');
        $query = $this->db->get($this->polls_table, $limit, $offset);
        
        if ($query->num_rows > 0)
        {
            return $query->result_array();
        }
        else
        {
            return FALSE;
        }
    }

    public function get_latest_poll()
    {
        $this->db->select('poll_id, title, closed')->order_by('created', 'desc');
        $query = $this->db->get($this->polls_table, 1); // limit to 1
        
        if ($query->num_rows == 1)
        {
            return $query->row_array();
        }
        else
        {
            return FALSE;
        }
    }

    public function get_poll_options($poll_id)
    {
        $this->db->select('option_id, poll_id, title')->where('poll_id', $poll_id);
        $query = $this->db->get($this->options_table);
        
        return $query->result_array();        
    }

    public function get_options_votes($option_id)
    {
        $this->db->from($this->votes_table)
            ->select('vote_id')
            ->where('option_id', $option_id);
            
        return $this->db->count_all_results();
    }


    public function add_vote($option_id)
    {
        $this->db->insert($this->votes_table, array(
            'option_id' => $option_id,
            'user_id' => $this->session->userdata('userid'),
            'timestamp' => time()
        ));
        
        return ($this->db->affected_rows() == 1) ? TRUE : FALSE;
    }


    public function create_poll($title, $options = array())
    {
        if (count($options) >= $this->config->item('max_poll_options', 'poll') && count($options) <= $this->config->item('min_poll_options', 'poll'))
        {
            return FALSE;
        }
        
        $poll_data = array(
            'title' => $title,
            'created' => date('Y-m-d h:i:s', time())
        );
        
        // create the poll then add the options associated with that inserted id
        $this->db->trans_start();
        $this->db->insert($this->polls_table, $poll_data);
        $poll_id = $this->db->insert_id();

        //insert in posts
        $datains['post_by'] = $this->session->userdata('userid');
        $datains['post_date'] = date('Y-m-d G:i:s');
        $datains['post_subject'] = $title;
        $datains['post_slug'] = url_title($title,'dash',TRUE);
        $datains['post_type'] = 'poll';
        $datains['approved'] = 0;
        $datains['post_poll_id'] = $poll_id;
        $this->db->insert('posts', $datains);

        print_r($options);

        foreach ($options as $option)
        {
            $this->db->insert($this->options_table, array(
                'poll_id' => $poll_id,
                'title' => $option)
            );
        }
        
        $this->db->trans_complete();
        
        if ($this->db->trans_status() === FALSE)
        {
            log_message('Transaction failed in: models/poll_model on method: create_poll()');
        }
        
        return $poll_id;
    }


    public function has_previously_voted($poll_id)
    {
        $this->db->from($this->options_table)
            ->join($this->votes_table, 'votes.option_id = options.option_id')
            ->where('options.poll_id', $poll_id)
            ->where('votes.user_id', $this->session->userdata('userid'));
            
        return ($this->db->count_all_results() > 0) ? TRUE : FALSE;
        
    }

    public function has_previously_voted_within($interval, $poll_id)
    {
        $this->db->from($this->options_table)
            ->join($this->votes_table, 'votes.option_id = options.option_id')
            ->where('options.poll_id', $poll_id)
            ->where('votes.timestamp >', time() - $interval)
            ->where('votes.user_id', $this->session->userdata('userid'));
        
        return ($this->db->count_all_results() > 0) ? TRUE : FALSE;
    }

    public function add_option($poll_id, $option_title)
    {
        $this->db->insert($this->options_table, array(
            'poll_id' => $poll_id,
            'title' => $option_title,
        ));
        
        return ($this->db->affected_rows() == 1) ? TRUE : FALSE;
    }

    public function delete_option($option_id)
    {
        $this->db->delete($this->options_table, array('option_id' => $option_id));
        return ($this->db->affected_rows() == 1) ? TRUE : FALSE;
    }

    public function delete_poll($poll_id)
    {
        $this->db->delete($this->polls_table, array('poll_id' => $poll_id));
        return ($this->db->affected_rows() == 1) ? TRUE : FALSE;
    }

    public function close_poll($poll_id)
    {
        $this->db->set('closed', 1)
            ->where('poll_id', $poll_id)
            ->update($this->polls_table);
    }

    public function open_poll($poll_id)
    {
        $this->db->set('closed', 0)
            ->where('poll_id', $poll_id)
            ->update($this->polls_table);
    }

    public function is_closed($poll_id)
    {
        $query = $this->db->get_where($this->polls_table, array('poll_id' => $poll_id));
        $row = $query->row_array();
        return (bool)$row['closed'];
    }


    public function vote($poll_id, $option_id)
    {
        if ($this->is_closed($poll_id))
        {
            $this->set_error('error_poll_closed');
            return FALSE;
        }
        
        if ($this->allow_multiple_votes === TRUE)
        {
            if ( ! $this->has_previously_voted_within($this->interval_between_votes, $poll_id))
            {
                $this->add_vote($option_id);
                return TRUE;
            }
            else
            {
                $this->set_error('error_has_previously_voted_within_time');
                return FALSE;
            }
        }
        else
        {
            if ( ! $this->has_previously_voted($poll_id))
            {
                $this->add_vote($option_id);
                return TRUE;
            }
            else
            {
                $this->set_error('error_multiple_votes_not_allowed');
                return FALSE;
            }
        }
    }

    public function if_vote($option_id)
    {
        $ip = $this->input->ip_address();
        $query = $this->db->query("SELECT * FROM polls_votes WHERE ip='".$ip."' AND option_id='".$option_id."' LIMIT 1");
        if ($query->num_rows() > 0)
        {
            return TRUE;
        } else {
            return FALSE;
        }        

    }

    
}

?>
