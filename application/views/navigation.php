<?php
	if (strlen($this->session->userdata('avatar')) > 2) {
        $grav_url = base_url()."/images/avatar/".$this->session->userdata('avatar');
    } else if ($this->session->userdata('User')) {
        $ses_user=$this->session->userdata('User');
        $grav_url = "https://graph.facebook.com/".$ses_user['id']."/picture";
    } else if ($this->session->userdata('twitter')) {
        $tname=$this->session->userdata('nome');
        $grav_url = "https://twitter.com/".$tname."/profile_image?size=original";
    } else {
        $email = $this->session->userdata('email');
        $default = $this->option_model->get_value('appusernophoto');
        $size = 30;
        $grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
    }

    if ($this->option_model->get_value('applayout') == 1) { 
        $nav = 0;
    } else {
        $nav = 1;
    }

?>


<style>
    
.logoimage {
    background: url('<?php echo base_url(); ?>images/<?php echo $this->option_model->get_value('applogo'); ?>') no-repeat;
     margin:-14px 0px 0px -15px;
    max-height: 55px;
    width:130px;
    height:55px;
}

/* for high resolution display */
@media only screen and (min--moz-device-pixel-ratio: 2),
only screen and (-o-min-device-pixel-ratio: 2/1),
only screen and (-webkit-min-device-pixel-ratio: 2),
only screen and (min-device-pixel-ratio: 2) {
<?php if (strlen($this->option_model->get_value('applogoretina') > 1)) { ?>
.logoimage {
    background: url('<?php echo base_url(); ?>images/<?php echo $this->option_model->get_value('applogoretina'); ?>') no-repeat;
    margin:-14px 0px 0px -15px;
    max-height: 55px;
    width:500px;
    height:55px;
}
<?php } ?>

}

</style>


    <!-- Begin Header -->
    <header>
    <nav class="navbar navbar-default navbar-custom navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo base_url(); ?>">
                    <?php if (strlen($this->option_model->get_value('applogo') > 1)) { ?>
                    <div class="logoimage"></div>
                    <?php } else { ?>
                    <span><?php echo $this->option_model->get_value('appname'); ?></span>
                    <?php } ?>
                </a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                
                <ul class="menu navbar-left hidden-xs">  
                        <div class="pull-left"> 
                            <ul>
               <li><a href="<?php echo base_url(); ?>stories/category/risingstars"><i class="fa fa-star-half"></i> Rising Stars</a></li>
               <li><a href="<?php echo base_url(); ?>stories/category/newstartups"><i class="fa fa-star-half"></i> New Startups</a></li>
               <li><a href="<?php echo base_url(); ?>stories/category/opportunities"><i class="fa fa-star-half"></i> Opportunities</a></li>
               <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-star-half"></i> Blog</a>
                                   <ul class="dropdown-menu">
                                       <li><a href="<?php echo base_url(); ?>stories/category/cities"><i class="fa fa-star-half"></i> Cities</a></li>
                                       <li><a href="<?php echo base_url(); ?>stories/category/fashion"><i class="fa fa-star-half"></i> Fashion & Lifestyle</a></li>
                                       <li><a href="<?php echo base_url(); ?>stories/category/entertainment"><i class="fa fa-star-half"></i> Entertainment</a></li>
                                       <li><a href="<?php echo base_url(); ?>stories/category/politics"><i class="fa fa-star-half"></i> Politics</a></li>
                                       <li><a href="<?php echo base_url(); ?>stories/category/technology"><i class="fa fa-star-half"></i> Technology Updates</a></li>
                                       <li><a href="<?php echo base_url(); ?>stories/category/business"><i class="fa fa-star-half"></i> Business</a></li>
                      
                                   </ul>
                            
                    </li>

               <li><a href="<?php echo base_url(); ?>stories/category/challenge"><i class="fa fa-star-half"></i> Challenge</a></li>
                    <li class="dropdown">
                        
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-star-half"></i> Talk</a>
                                   <ul class="dropdown-menu">
                                       <li><a href="<?php echo base_url(); ?>pitch.php"><i class="fa fa-star-half"></i> Photos</a></li>
                                       <li><a href="<?php echo base_url(); ?>"><i class="fa fa-star-half"></i> Videos</a></li>
                      
                                   </ul>
                            
                    </li>
                                </ul>
                    </div>
                    
                    
                    <li>
                        <div class="pull-left">
                <div id="filtercategory" class="dropdown">
                  <button class="filterposts dropdown-toggle" type="button" data-toggle="dropdown">.:
                  </button>
                  <ul class="dropdown-menu">
                    
                    <?php if (isset($categories)) { ?>
                    <?php if (!isset($category)) $category = ""; ?>
                    
                    
                    <?php 
                        if (count($categories)>0):                    
                        $com=1;
                        foreach($categories as $cat): 
                        if ($com <= 0) {
                    ?>
                        <li><a href="<?php echo base_url(); ?>stories/category/<?php echo $cat['category_slug']; ?>" onclick="$('.menu a').removeClass('activ');$(this).addClass('activ');filtercat('<?php echo $cat['id_category']; ?>', '<?php echo $cat['category_name']; ?>');"><?php echo $cat['category_name']; ?></a></li>
                    
                    <?php 
                        $com++; 
                        } 
                        endforeach;
                        endif;
                    ?>
                    
                    
                    <?php if (count($categories)>0): ?> 
                        
                  </ul>
                </div>
                </div> </li>
                    
                        <div class="pull-left">
                        <form class="search searchform">
                            <input id="search" name="search" class="searchTerm" placeholder="<?php echo $this->lang->line('search_text'); ?>" /><input class="searchButton" type="submit" />
                        </form>
                    </div>
                <?php endif; ?>

                <?php } ?>  

                </ul>   

                <?php if (!isset($iframe)) { ?>
                <ul class="nav navbar-nav navbar-right">
                     <?php if (isset($categories)) { ?>
                     <?php foreach($categories as $cat): ?>
                            <li class="hidden-sm hidden-md hidden-lg"><a class="<?php if ($category == $cat['category_slug']) { ?>activ<?php } ?>" href="<?php echo base_url(); ?>stories/category/<?php echo $cat['category_slug']; ?>"><?php echo $cat['category_name']; ?></a></li>
                            <?php endforeach; ?>
                     <?php } ?> 
                    

                            
                    <li class="hidden-sm">
                        <?php if($this->session->userdata('logged_in')) { ?>
                        <div class="dropdown">
                          <button class="dropdown-toggle userdrop" type="button" style="padding-right:10px;" data-toggle="dropdown">
                            <img src="<?php echo $grav_url; ?>" class="img-circle" style="max-height:30px;" alt="" />
                            &nbsp;&nbsp;&nbsp;<span class="txt"><?php echo $this->session->userdata('nome'); ?></span>
                          <span class="caret"></span></button>
                          <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url(); ?>user/profile">&nbsp;<i class="fa fa-pencil-square-o"></i><?php echo $this->lang->line('editprofile_link'); ?></a></li>
                            <li><a href="<?php echo base_url(); ?>login/logout">&nbsp;<i class="fa fa-sign-out"></i><?php echo $this->lang->line('logout_link'); ?></a></li>
                            <?php if ($this->option_model->check_admin()) {  ?>
                            <li class="divider"></li>
                            <li><a href="<?php echo base_url(); ?>admin">&nbsp;<i class="fa fa-cogs"></i>Admin</a></li>
                            <?php } ?>
                          </ul>
                        </div>

                        <?php } else { ?>
                        <a href="#" data-toggle="modal" data-target="#loginmodal" style="padding:15px 10px;" data-balloon="Login/Register" data-balloon-pos="down"><i class="fa fa-sign-in"></i>&nbsp;</a>
                        <?php } ?>
                    </li>
                    <li>
                        <?php if (($this->session->userdata('logged_in')) || ($this->option_model->get_value('apppostanon') == 1)) { ?>
                        <div class="dropdown" style="padding:10px 0px;">
                        <a class="dropdown-toggle userdrop" data-toggle="dropdown" href="#" data-balloon="Display your Talent" data-balloon-pos="left"><i class="fa fa-pencil-square-o" style="padding:6px 3px;"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url(); ?>stories/sharealink">&nbsp;<i class="fa fa-link"></i>Share video link</a></li>
                            <li><a href="<?php echo base_url(); ?>stories/writeastory">&nbsp;<i class="fa fa-pencil-square-o"></i>Publish your story</a></li>
                          </ul>
                        </div>  
                        <?php } else { ?>
                        <a href="#" data-toggle="modal" data-target="#loginmodal" data-balloon="Share a story" data-balloon-pos="left"><i class="fa fa-pencil-square-o" style="padding:6px 3px;"></i></a>                        
                        <?php } ?>
                    </li>
                                    
                </ul>
                <?php } else { ?>
                <ul class="nav navbar-nav navbar-right" style="margin-top: 15px;margin-right: 0px;">
                    <a href="javascript:window.history.back();" class="button button-green">Back to website</a>
                </ul>
                <?php } ?>
            </div>
        </div>
    </nav>
    </header>
	<!-- End Header -->
