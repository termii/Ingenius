</div>

</div>
   <center> <div class="row hidden-xs" style="clear:both;position: fixed;bottom: 1px;max-height: 33px;background-color: rgba(255, 255, 255, 0.9);-webkit-transition: -webkit-transform 0.3s;-moz-transition: -moz-transform 0.3s;transition: transform 0.3s;box-shadow: 0 0 20px 0 rgba(0,0,0,0.21);width: 102%;">
			<div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1" style="margin-top: -28px;">
      
				<p style="font-size: 12px;"><?php echo $this->option_model->get_value('appfootercopy'); ?> Litwit Investment Capital| 
        <?php 
          $this->db->where('area', 'footer');
          $this->db->order_by('title', 'asc');
          $query = $this->db->get('pages');
          $pages = $query->result_array();
        ?>
        <?php if (count($pages)>0): ?>
        <?php foreach($pages as $page): ?>
        <a href="<?php if ($page['link']) { echo $page['link']; } else { echo base_url()."pages/p/".$page['title_slug']; } ?>"><?php echo $page['title']; ?></a>
        <?php endforeach; ?>
        <?php endif; ?> | 
                Codes secured with <i class="fa fa-heart" style="color: red;"></i> by <a href="http://termii.com/"><img src="<?php echo base_url(); ?>/images/termii.png"></a></p>
			</div>
		</div>
       </center>

  <!-- Login Modal - Display if user not login -->
  <?php if(!$this->session->userdata('logged_in')) { ?>
  <div class="modal fade" id="loginmodal" role="dialog" style="background: rgba(0, 0, 0, 0.91);">
    <div class="modal-dialog">
     <div class="col-lg-12 col-lg-offset-2 col-md-1 col-md-offset-1">
      <div class="modal-content" style="background-image: url(<?php echo base_url(); ?>/images/box/logo.jpg);background-size: cover;height: 100%;width: 340px !important;">
        <div>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <center><h4 style="color: #fff!important;margin-top: 45px;">Publish and Announce</h4>
          <p style="color: #fff!important;margin: 11px;">Welcome to InGenius, Where inGenuity is amplified</p></center>
        </div>

        <div class="modal-body">

		<form method="POST" id="formlogin" role="form" action="<?php echo base_url() ?>login/process_login">
			<br />
			<div class="append-icon">
				<input type="text" name="username" id="username" class="form-control form-white username" style="background: transparent;color: #fff !important;" placeholder="E-mail" required="">
				<i class="fa fa-envelope" style="color: #fff !important;"></i>
			</div>
			<div class="append-icon m-b-20">
				<input type="password" id="password" name="password" class="form-control form-white password" placeholder="Password" required=""  style="background: transparent;color: #fff !important;">
				<i class="fa fa-lock" style="color: #fff !important;"></i>
			</div>
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
			<button type="submit" id="submit-form" class="btn btn-lg button button-green btn-block ladda-button" style="background: #fff !important;color: #ce1417  !important;border: 2px solid #fff  !important;">Sign in</button>
			<br />
			<div id="loading" class="alert alert-warning"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> &nbsp;<?php echo $this->lang->line('loading_text'); ?></div>
			<div id="error" class="alert alert-warning" role="alert"></div>
			<div id="confirm" class="alert alert-success" role="alert"></div>

			<div class="social-btn">
				<a href="#" id="facebook"><button type="button" style="border-radius: 100px;" class="btn-facebook btn btn-lg btn-block btn-primary"><i class="fa fa-facebook"></i><?php echo $this->lang->line('facebookconnect'); ?></button></a>
			</div>
			<div class="clearfix">
				<p class="pull-left m-t-20"><a style="color: #fff;" id="password" href="<?php echo base_url() ?>user/password_recovery"><?php echo $this->lang->line('forgotpassword_button'); ?></a></p>
				<p class="pull-right m-t-20"><a style="color: #fff;border: 2px solid #fff;" href="<?php echo base_url(); ?>user/register" class="button"><?php echo $this->lang->line('signup_button'); ?></a></p>
			</div>
		</form>

        </div>
          
      </div>

      </div>

			<div class="col-lg-12 col-lg-offset-2 col-md-1 col-md-offset-1" style="margin-top: -28px;">
				<p style="font-size: 12px; color: #fff !important"><?php echo $this->option_model->get_value('appfootercopy'); ?> Litwit Investment Capital</a></p>
			</div>
    </div>
  </div>


  <!-- Begin JavaScript -->
  <script type='text/javascript'>
  jQuery(document).ready(function($){
  jQuery("#formlogin").on('submit',(function(e) {
                e.preventDefault();
                var curElement = jQuery(this);
                curElement.find(':submit').hide();

                curElement.find("#error").empty().slideUp();
                curElement.find("#confirm").empty().slideUp();
                curElement.find('#loading').show();

                jQuery.ajax({
                url: "<?php echo base_url(); ?>login/processlogin",
                type: "POST",
                dataType: 'json',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(data)
                {
                    curElement.find('#loading').hide();
                    curElement.find("#"+data.result).html(data.message).slideDown();
                    if (data.result == "confirm") location.reload();
                    curElement.find(':submit').show();
                }
                });
        }));
  });
  </script>
  <?php } ?>
  <script type="text/javascript">
  window.fbAsyncInit = function() {
	  //Initiallize the facebook using the facebook javascript sdk
     FB.init({ 
       appId:'1086974008045742', // App ID 
	   cookie:true, // enable cookies to allow the server to access the session
       status:true, // check login status
	   xfbml:true, // parse XFBML
	   oauth : true //enable Oauth 
     });
   };
   //Read the baseurl from the config.php file
   (function(d){
           var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
           if (d.getElementById(id)) {return;}
           js = d.createElement('script'); js.id = id; js.async = true;
           js.src = "//connect.facebook.net/en_US/all.js";
           ref.parentNode.insertBefore(js, ref);
         }(document));
	//Onclick for fb login
 $('#facebook').click(function(e) {
    FB.login(function(response) {
	  if(response.authResponse) {
		  parent.location ='<?php echo base_url(); ?>login/fblogin'; //redirect uri after closing the facebook popup
	  }
 },{scope: 'public_profile,email'}); //permissions for facebook
});
   </script>
  <!-- End Login Modal -->
  <!-- Bootstrap Core JavaScript -->
  <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>  
  <script src="<?php echo base_url(); ?>js/swiper.min.js"></script>  
  <script src="<?php echo base_url(); ?>js/jquery.cookiebar.js"></script>  
  <script src="<?php echo base_url(); ?>js/social-likes.min.js"></script>  
  <!-- Custom Theme JavaScript -->
  <script src="<?php echo base_url(); ?>js/main.js"></script>
  <!-- Begin Google Analytics -->
  <?php if (strlen($this->option_model->get_value('appgoogleanalytics')) > 1) { ?>
  <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', '<?php echo $this->option_model->get_value('appgoogleanalytics'); ?>', 'auto');
  ga('send', 'pageview');

</script>
  <?php } ?>
  <!-- End Google Analytics -->
  <!-- End JavaScript -->
</body>
</html>
