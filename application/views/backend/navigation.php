<?php
    $default = $this->session->userdata('avatar');
    $size = 30;
    $email = $this->session->userdata('email');
    if (strlen($default) > 2) {
        $grav_url = base_url()."/images/avatar/".$default;
    } else {
        $grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
    }    
?>

<nav class="navbar navbar-findcond">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">Admin</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a></li>
		
		<li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Users <b class="caret"></b></a>
                    <ul class="dropdown-menu multi-level">
                        <li><a href="<?php echo base_url(); ?>admin/users">List</a></li>                        
                        <li class="divider" style="display:none;"></li>
                        <li class="dropdown-submenu" style="display:none;">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown</a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Action</a></li>
                                <li class="dropdown-submenu">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown</a>
                                    <ul class="dropdown-menu">
                                        <li class="dropdown-submenu">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown</a>
                                            <ul class="dropdown-menu">
                                                <li><a href="#">Action</a></li>
                                                <li><a href="#">Another action</a></li>
                                                <li><a href="#">Something else here</a></li>
                                                <li class="divider"></li>
                                                <li><a href="#">Separated link</a></li>
                                                <li class="divider"></li>
                                                <li><a href="#">One more separated link</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
		
		
		<li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Stories <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo base_url(); ?>admin/stories">Stories List</a></li>
            <li><a href="<?php echo base_url(); ?>admin/comments">Comments</a></li>
            <li><a href="<?php echo base_url(); ?>admin/categories">Categories</a></li>
          </ul>
        </li>
        <li><a href="<?php echo base_url(); ?>admin/pages">Pages</a></li>
        <li><a href="<?php echo base_url(); ?>admin/subscribers">Newsletter</a></li>
        <li><a href="<?php echo base_url(); ?>admin/options">Options</a></li>
        <li><a href="<?php echo base_url(); ?>rssaggregator">RSS Aggregator</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <?php
            $this->db->join('users', 'reports.user_id = users.user_id', 'left');
            $this->db->join('posts', 'posts.post_id = reports.posts_id', 'left');
            $query = $this->db->get('reports');            
            $reports = $query->result_array();
            $num_rows = $query->num_rows();            
        ?>
        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span
                    class="glyphicon glyphicon-envelope"></span>&nbsp;Inbox&nbsp;&nbsp;<span class="label label-info"><?php echo $num_rows; ?></span>
                </a>
                    <ul class="dropdown-menu">
                        <?php if (count($reports)>0): ?>
                        <?php foreach($reports as $rep): ?>
                        <li>
                        <a href="<?php echo base_url(); ?>admin/editstory/<?php echo $rep['posts_id']; ?>"><span class="label label-warning">Report content</span><br /><span title="<?php echo $rep['desc']; ?>"><?php echo substr($rep['desc'], 0, 50)."..."; ?></span><br />
                        <small><span style="opacity:0.7;">on post</span> <?php echo mb_substr($rep['post_subject'],0,25)."..."; ?> <span style="opacity:0.7;">by</span> <?php echo $rep['user_name']." ".$rep['user_lastname']; ?>.</small></a>
                        </li>
                        <?php endforeach; ?>
                        <li class="divider"></li>
                        <?php endif; ?>                        
                    </ul>
        </li>
        <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-user"></span> 
                        <strong><?php echo $this->session->userdata('nome'); ?></strong>
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <div class="navbar-login">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <p class="text-center">
                                            <img src="<?php echo $grav_url; ?>" class="img-circle" style="max-height:80px;float: left;" alt="" />
                                        </p>
                                    </div>
                                    <div class="col-lg-8">
                                        <p class="text-left"><strong><?php echo $this->session->userdata('nome'); ?></strong></p>
                                        <p class="text-left small"></p>
                                        <p class="text-left">
                                            <a href="<?php echo base_url(); ?>user/profile" class="btn btn-primary btn-block btn-sm" style="color:#FFF;background-color: #00B289;">Edit profile</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="navbar-login navbar-login-session">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <p>
                                            <a href="<?php echo base_url(); ?>login/logout" class="btn btn-danger btn-block" style="color:#FFF;background-color: #d9534f;">Logout</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
      </ul>
    </div>
  </div>
</nav>