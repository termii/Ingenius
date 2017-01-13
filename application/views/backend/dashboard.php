
    <div class="container-fluid background">
        <section class="container content">
		
			<div class="contspacing">
			
			
			<h3>Dashboard</h3>

			<p>&nbsp;</p>
			<div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="panel info-box panelgrey">
                                <div class="panel-body">
                                    <div class="info-box-stats">
                                        <p class="counter"><?php echo $estat1; ?></p>
                                        <span class="info-box-title">Registered Users</span>
                                    </div>
                                    
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel info-box panelgrey">
                                <div class="panel-body">
                                    <div class="info-box-stats">
                                        <p class="counter"><?php echo $estat2; ?></p>
                                        <span class="info-box-title">Published Stories</span>
                                    </div>
                                    
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel info-box panelgrey">
                                <div class="panel-body">
                                    <div class="info-box-stats">
                                       <p class="counter"><?php echo $estat3; ?></p>
                                        <span class="info-box-title">Number Comments</span>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel info-box panelgrey">
                                <div class="panel-body">
                                    <div class="info-box-stats">
                                        <p class="counter"><?php echo $estat4; ?></p>
                                        <span class="info-box-title">Newsletter subscribers</span>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
        </div>

        <div class="row">

                            <div class="col-lg-4">
                                <div class="card-box">
                                    <div class="mx-box">
                                        <div class="panel info-box panelgrey">
                                            <div class="panel-heading"><h3>Recent posts</h3></div>

                                            <div class="panel-body" style="height: 400px;overflow: auto;">                                            

                                            <?php if (count($stories)>0): ?>
                                                <table class="table no-margin">
                <thead>
                    <tr>
                    <th>#</th>
                    <th>Post</th>                    
                    </tr>
                </thead>
                <tbody>
                                            <?php foreach($stories as $sto): ?>

                                            
                    <tr>
                    <td><?php if ($sto['approved'] == 1) { ?><span class="label label-success">Approved</span><?php } else if ($sto['approved'] == 2) { ?><span class="label label-info">Draft</span><?php } else { ?><span class="label label-danger">Pending</span><?php } ?></td>
                    <td><a href="<?php echo base_url(); ?>stories/article/<?php echo $sto['post_slug']; ?>" style="color: #404B55;"><?php echo $sto['post_subject']; ?></a></td>                   
                    </tr>
                    
                

                <?php endforeach; ?>
                </tbody>
                </table>
                                                <?php else: ?>  
                                                    <br />
                                                    <span>No stories found.</span>
                                                    <br /><br />
                                                <?php endif; ?>

                                            
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

        
                            <div class="col-lg-4">
                                <div class="card-box">
                                    <div class="mx-box">
                                        <div class="panel info-box panelgrey">
                                            <div class="panel-heading"><h3>Recent comments</h3></div>

                                            <div class="panel-body" style="height: 400px;overflow: auto;">                                            
                                            <ul class="list-unstyled transaction-list m-r-5">
                                                
                                                <?php if (count($comments)>0): ?>

                                                    <table class="table no-margin">
                <thead>
                    <tr>
                    <th>Author</th>
                    <th>Comment/Post</th>                    
                    </tr>
                </thead>
                <tbody>
                    
                                                <?php foreach($comments as $com): ?>
                                                <tr>
                                                    <td><span class="label label-info"><a style="color:#FFF;" href="<?php echo base_url(); ?>user/viewprofile/<?php echo $com['user_id']; ?>" class="author-link"><?php echo ucfirst($com['user_name'])." ".ucfirst($com['user_lastname']); ?> </a></span></td>
                                                    <td><?php echo $com['comment']; ?><br />
                                                     on <a href="<?php echo base_url(); ?>stories/article/<?php echo $com['post_slug']; ?>#comments"><?php echo mb_substr($com['post_subject'],0,45)."..."; ?></a>
                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>
                                                </tbody>
                </table>
                                                <?php else: ?>  
                                                    <br />
                                                    <span>No comments found.</span>
                                                    <br /><br />
                                                <?php endif; ?>
                                                
                                            </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-4">
                                <div class="card-box">
                                    <div class="mx-box">
                                        <div class="panel info-box panelgrey">
                                            <div class="panel-heading"><h3>Recent users</h3></div>

                                            <div class="panel-body" style="height: 400px;overflow: auto;">                                            
                                            <ul class="list-unstyled transaction-list m-r-5">
                                                
                                                <?php if (count($users)>0): ?>
                                                    <table class="table no-margin">
                <thead>
                    <tr>
                    <td align="center"></td>
                    <th>User</th>                    
                    </tr>
                </thead>
                <tbody>
                                                <?php foreach($users as $use): ?>
                                                
                                                <?php
                            if (strlen($use['user_avatar']) > 2) {
                                $grav_url = base_url()."/images/avatar/".$use['user_avatar'];
                            } else if (strlen($use['user_facebookid']) > 2) {
                                $grav_url = "https://graph.facebook.com/".$use['user_facebookid']."/picture";
                            } else if (strlen($use['user_twitterid']) > 2) {                                    
                                $grav_url = "https://twitter.com/".$use['user_twittername']."/profile_image?size=original";
                            } else {
                                $email = $use['user_email'];
                                $default = $this->option_model->get_value('appusernophoto');
                                $size = 30;
                                $grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
                            }
                            ?>

                                                <tr>                                                  
                                                    <td align="center"><a href="<?php echo base_url(); ?>u/<?php echo $use['user_slug']; ?>" class="popup-ajax2 author-link" data-trigger="hover" data-placement="top" data-load="<?php echo base_url(); ?>user/hover/<?php echo $use['user_id']; ?>" data-toggle="popover" title="<?php echo $use['user_name']." ".$use['user_lastname']; ?>"><img src="<?php echo $grav_url; ?>" class="img-circle" style="max-height:40px;max-width:30px;margin-top:-3px;" alt="" /></a></td>
                                                    <td><?php echo $use['user_name']." ".$use['user_lastname']; ?></td>
                                                    
                                                </tr>
                                                <?php endforeach; ?>
                                                </tbody>
                                                </table>
                                                <?php else: ?>  
                                                    <br />
                                                    <span>No users found.</span>
                                                    <br /><br />
                                                <?php endif; ?>
                                                
                                            </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>




        </div>    



        <p>&nbsp;</p>

</div>

</section>