    <!-- Main Content -->
    <div class="container maincontent bodyInside" style="margin-top:25px;background-color:#FFF;border: 1px solid #ecf0f1;box-shadow: 0 1px 6px rgba(0,0,0,0.04);padding-bottom: 40px;">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                
              <div class="row">
                <div class="col-md-9 col-sm-12">

                 <?php $this->load->view('ajaxcontent/single-stories2'); ?>

                <div class="pull-right">                
                <div id="filtercomments" class="dropdown">
                  <button class="filterposts dropdown-toggle" type="button" data-toggle="dropdown" style="margin: 25px;"><span class="txt">Popular</span>
                  <span class="caret"></span></button>
                  <ul class="dropdown-menu">
                    <li><a href="javascript:void(0);" onclick="filtercom('Popular');"><?php echo $this->lang->line('popular_text'); ?></a></li>
                    <li><a href="javascript:void(0);" onclick="filtercom('Recent');"><?php echo $this->lang->line('recent_text'); ?></a></li>                    
                  </ul>
                </div>
                </div>
                <div id="comments"></div>


      <br />          
    <div id="leavecomment">
      <h4><?php echo $this->lang->line('title_comment'); ?></h4>
      
     <?php if ($this->session->userdata('logged_in') == TRUE) { ?>
     
      <form id="commentsform" class="form-horizontal">
       
    <div class="form-group" style="display:none;">
        <div class="col-sm-8">
           
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $this->session->userdata('nome'); ?>" required disabled>
        </div>
    </div>
    <div class="form-group" style="display:none;">
       <div class="col-sm-8">
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $this->session->userdata('email'); ?>" required disabled>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-12">
            <textarea class="form-control" required rows="4" id="comment" name="comment" placeholder="<?php echo $this->lang->line('input_comment'); ?>"></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-8">
            <label for="captcha"><?php echo $captcha['image']; ?></label>
            <br>
            <input type="text" autocomplete="off" name="userCaptcha" placeholder="Enter above text" value="<?php if(!empty($userCaptcha)){ echo $userCaptcha;} ?>" />
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-8">
            <input id="submit" name="submit" type="submit" value="<?php echo $this->lang->line('comment_button'); ?>" class="button button-green">
        </div>
    </div>
    <div id="loading" class="alert alert-warning"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> &nbsp;<?php echo $this->lang->line('loading_text'); ?></div>
    <div id="error" class="alert alert-warning" role="alert"></div>
    <div id="confirm" class="alert alert-success" role="alert"></div>
   
</form>  
<?php } else { ?>
<span style="color:#888;">Please <a href="#" data-toggle="modal" data-target="#loginmodal">Login</a> to insert comment.</span>
<br /><br />
<?php } ?>


              <?php if ($this->option_model->get_value('appfbcommentsenable') == "1") { ?>
              <p>&nbsp;</p>
              <h4><?php echo $this->lang->line('facebookconversations'); ?></h4>
              <?php $link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>
              <div class="fb-comments" data-href="<?php echo $link; ?>" data-numposts="5"></div>
              <?php } ?>



</div>


                
             



                </div>

                <div id="sidebar" class="col-md-3 col-sm-12 sidebar">
                

                
                  
                  <span style="margin:40px 0px 20px 15px;color:#FFF;padding:0px 5px;" class="catf pull-left"><?php echo $this->lang->line('populartags'); ?></span>
                  

                  <ul class="storiesrecent">
                                        

                  </ul>  

				<br style="clear:both;" />
				<div class="row">
				<div class="col-md-12">
                <?php if ($this->option_model->get_value('appadsidebar') == "1") { ?>
                <a href="<?php echo $this->option_model->get_value('appadvlink'); ?>">
                <img src="<?php echo $this->option_model->get_value('appadvimgurl'); ?>" style="display:inline-block;" class="img-responsive">
                </a>    
                <?php } ?>

                <?php if ($this->option_model->get_value('appadsidebar') == "2") { ?>
                		<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
						<!-- sidebar -->
						<ins class="adsbygoogle"
							 style="display:block"
							 data-ad-client="ca-pub-<?php echo $this->option_model->get_value('appgadscode'); ?>"
							 data-ad-slot="<?php echo $this->option_model->get_value('appgadslot'); ?>"
							 data-ad-format="auto"></ins>
						<script>
						(adsbygoogle = window.adsbygoogle || []).push({});
						</script>
				<?php } ?>

                <?php if ($this->option_model->get_value('appadsidebar') == "3") { echo "<p>&nbsp;</p>".$this->option_model->get_value('appadscode'); } ?>
				</div>
				</div>
                  
				  
				  <br style="clear:both;" /><br />
                  <div class="fb-page" data-href="<?php echo $this->option_model->get_value('appfacebookurl'); ?>" data-height="20" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false" data-show-posts="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="<?php echo $this->option_model->get_value('appfacebookurl'); ?>"><a href="<?php echo $this->option_model->get_value('appfacebookurl'); ?>">Facebook</a></blockquote></div></div>

                  <span style="margin:30px 0px 20px 15px;color:#FFF;padding:0px 5px;" class="catf pull-left"><?php echo $this->lang->line('topauthors'); ?></span>

                <ul class="topauthors"></ul> 

                                 
                <span style="margin:30px 0px 20px 15px;color:#FFF;padding:0px 5px;" class="catf pull-left"><?php echo $this->lang->line('populartags'); ?></span>

                <div class="tagcloud">
                    <?php if (isset($tags)): ?>
                    <?php foreach($tags as $ta): ?>
                        <a href="<?php echo base_url(); ?>stories/tag/<?php echo $ta['tag_slug']; ?>"><?php echo $ta['tag_name']; ?></a>                    
                    <?php endforeach; ?>
                    <?php endif; ?>    
                    
                </div>


                </div>  

                


              </div>  
                
               </div>

                


<script type='text/javascript'>
jQuery(document).ready(function($){
      
    loadComments  = function() 
    {
      var article_id = $("#article").val();
           $.post('<?php echo base_url();?>stories/get_comments/<?php echo $storyid; ?>',
                                                    {
                                                     filtera: filtera,
                                                     <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
                                                    },
                                                    function(data)
     {
                                                       
       $("#comments").html(data);
     });
    }
          
  
  $("#commentsform").on('submit',(function(e) 
  {
        event.preventDefault();
        $("#error").empty().hide();
        $("#confirm").empty().hide();
        $('#loading').show();

        var curElement = $(this);
        curElement.find(':submit').hide();

        var name = $("#commentsform input[name=name]").val();
        var email = $("#commentsform input[name=email]").val();
        var message = $("#commentsform textarea[name=comment]").val();
        var userCaptcha = $("#commentsform input[name=userCaptcha]").val();
            
        $.post("<?php echo base_url(); ?>stories/insertcomment/", {
                  name: name,
          email: email,
          message: message,
          userCaptcha: userCaptcha,
          postid: <?php echo $storyid; ?>,
          <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
        },
        function(data){
          //$(".stories").append(data);
          //$("#comments").html(data);

          $('#loading').hide();
          $("#"+data.result).html(data.message).show();
          if (data.result == "confirm") { loadComments(); $("#commentsform textarea[name=comment]").val(""); }
          curElement.find(':submit').show();


        }, "json");
  }));


    var loaded_messages_rec = 0;
    var filterb = "Most Recent";
    var category = "";


 loadRecent  = function() 
    {            
            var search = $(".search-form input[name=search]").val();
            $.post("<?php echo base_url(); ?>stories/loadrecent/"+loaded_messages_rec, {
                search: search,
                filterb: filterb,
                category: category,
                <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            function(data){
                $(".storiesrecent").append(data);
            });
            loaded_messages_rec += 10;
            
            
    }

    loadTopAuthors  = function() 
    {            
            $.post("<?php echo base_url(); ?>stories/loadtopauthors/", {
                <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            function(data){
                $(".topauthors").append(data);
            });
    }

  var filtera = "Popular";

  filtercom = function(q) {
        $('#filtercomments .txt').html(q);
        loaded_comments = 0;
        $("#comments").html("");
        filtera = q;
        loadComments();
  }


  loadComments();
  loadRecent();
  loadTopAuthors();

});
</script>