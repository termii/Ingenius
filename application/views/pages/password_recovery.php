<style>
    
#loginmodal{ display: none !important;

   }
</style>

  <div class="modal in fade" role="dialog" style="background: #000;">
    <div class="modal-dialog">

      <div class="modal-content" style="background-image: url(<?php echo base_url(); ?>/images/box/login.png);background-size: cover;height: 100%;width: 100%;padding: 20px;">
        <div>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <center><h4 style="color: #fff!important;margin-top: 45px;">Welcome to InGenius, Where InGenuity is Amplified</h4>
          <p style="color: #fff!important;margin: 11px 0;">Lost your password, find it here</p></center>
        </div>
                        <form id="form-password" class="form-password" role="form">
                            <div class="append-icon m-b-20">
                                <input type="email" name="email" class="form-control form-white password" placeholder="E-mail" required="">
                                <i class="icon-lock"></i>
                            </div>

                            <div class="clearfix">
                                
                            

                            <p class="pull-left m-t-20"><button type="submit" id="submit-password" class="button button-green" style="width:auto;">Send</button>&nbsp;<a id="login" href="<?php echo base_url() ?>" class="button button-grey"><?php echo $this->lang->line('cancel_button'); ?></a></p>

                                <p class="pull-right m-t-20"></p>
                                </div>
                        </form>
						<div id="loading" class="alert alert-warning"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> &nbsp;<?php echo $this->lang->line('loading_text'); ?></div>
                        <div id="error" class="alert alert-warning" role="alert"></div>
                        <div id="confirm" class="alert alert-success" role="alert"></div>

                    </div>
                </div>
            </div>     
</div>



<script type="text/javascript">
	jQuery(document).ready(function(){
			//save
			jQuery("#form-password").on('submit',(function(e) {
				e.preventDefault();
                jQuery("#error").empty().slideUp();
                jQuery("#confirm").empty().slideUp();
                jQuery('#loading').show();
                var curElement = jQuery(this);
                curElement.find(':submit').hide();
				
				var email = jQuery("#form-password input[name=email]").val();

				jQuery.post("<?php echo base_url() ?>user/send_recovery_email", { email: email, p: 1, <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>' },
				function(data){
                    jQuery('#loading').hide();
                    jQuery("#"+data.result).html(data.message).slideDown();
                    curElement.find(':submit').show();
                    if (data.result == "confirm") { jQuery('form#form-password').slideUp("fast"); }
				}, "json");
			}));
			                         
	});
</script>