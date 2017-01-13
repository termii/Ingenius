<style>
    
#loginmodal{ display: none !important;

   }
</style>

  <div class="modal in fade" role="dialog" style="background: #000;">
    <div class="modal-dialog">

      <div class="modal-content" style="background-image: url(http://ingenius.ng//images/box/logo.jpg);background-size: cover;height: 515px;width: 100%;padding: 20px;overflow: auto;">
        <div>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <center><h4 style="color: #fff!important;margin-top: 45px;">We Spot, Announce, and encourage InGenuity in Nigerians</h4>
          <p style="color: #fff!important;margin: 11px 0;">Welcome to InGenius, Nigeria's platform for showcasing InGenuity</p></center>
        </div>

        <div class="modal-body">
                        <form id="formregisto" action="" method="post">    
                            <div class="row" style="margin-top:10px;">
                                <div class="col-sm-6">
                                    <div class="append-icon">
                                        <input type="text" name="name" class="form-control form-white" placeholder="<?php echo $this->lang->line('input_firstname'); ?>" required="" autofocus="">
                                        <i class="icon-user"></i>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="append-icon">
                                        <input type="text" name="lastname" class="form-control form-white lastname" placeholder="<?php echo $this->lang->line('input_lastname'); ?>" required="">
                                        <i class="icon-user"></i>
                                    </div>
                                </div>
                            </div>  
                            <div class="row" style="margin-top:10px;">
                                <div class="col-sm-6">
                                 <div class="append-icon">
                                <input type="slug" name="slug" id="slug" class="form-control form-white email" placeholder="<?php echo $this->lang->line('input_slug'); ?>" required="">                           
                                 </div>
                                </div>
                                <div class="col-sm-6">
                                  <div class="append-icon">
                                    <input type="email" name="email" id="email" class="form-control form-white email" placeholder="<?php echo $this->lang->line('input_email'); ?>" required="">
                                   <i class="icon-envelope"></i>
                                   </div>
                                </div>
                            </div>
                            <div class="row" style="margin-top:10px;">
                                <div class="col-sm-6">
                                 <div class="append-icon">
                                 <input type="password" name="password" class="form-control form-white password" placeholder="<?php echo $this->lang->line('input_password'); ?>" required="">
                                 <i class="icon-lock"></i>
                                 </div>
                                </div>
                                <div class="col-sm-6">
                                 <div class="append-icon">
                                <input type="password" name="password2" class="form-control form-white password2" placeholder="<?php echo $this->lang->line('input_confirmpassword'); ?>" required="">
                                <i class="icon-lock"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-top:10px;">
                             <div class="col-sm-6">
                                <div class="terms option-group">
                                <label for="terms" class="m-t-10">
                                <input type="checkbox" name="newsletter">
                                &nbsp;&nbsp;<span style="font-size: 13px;color: #fff;font-weight: 100;"><?php echo $this->lang->line('checkbox_register'); ?></span>
                                </label> 
                                 </div>
                                </div>
                            
                             <div class="col-sm-6">
                            <div class="terms option-group">
                                <label for="terms" class="m-t-10">
                                <input type="checkbox" name="terms">
                                &nbsp;&nbsp;<span style="font-size: 13px;color: #fff;font-weight: 100;"><a style="font-size: 13px;color: #fff;font-weight: 100;" href="#" onclick="jQuery('#terms').toggle();"><?php echo $this->lang->line('checkbox_terms'); ?></a></span>
                                </label> <br />
                                <div id="terms" style="display:none;">
                                <textarea style="width:100%;height:150px;font-size: 13px;color: #fff;font-weight: 100;" disabled required><?php echo $this->lang->line('termsandconditions'); ?></textarea>
                                </div>
                                 </div>
                                </div>
                            </div>
                            
                            <div class="row" style="margin-top:10px;">
                            <div class="append-icon">
                             <div class="col-sm-6">
                                <label for="captcha"><?php echo $captcha['image']; ?></label>
                                </div>
                             <div class="col-sm-6">
                                <input type="text" autocomplete="off" name="userCaptcha" class="form-control form-white" placeholder="Enter secruity text" value="<?php if(!empty($userCaptcha)){ echo $userCaptcha;} ?>" />
                                </div>
                            </div>
                            </div>

                            <div class="clearfix">
                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                <p class="pull-right m-t-20"><button type="submit" id="submit-form" class="button m-t-20 button-green"  style="background: #fff !important;color: #ce1417  !important;border: 2px solid #fff  !important;">Sign up Now</button></p>
                                <p class="pull-left m-t-20" style="font-size: 13px;color: #fff;font-weight: 100;">Already with an account <a href="<?php echo base_url(); ?>" class="button m-t-20 button-green"  style="background: transparent !important;color: #fff  !important;border: 2px solid #fff  !important;">Sign in</a></p>
                            </div>

                            <div id="loading" class="alert alert-warning"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> &nbsp;<?php echo $this->lang->line('loading_text'); ?></div>
                            <div id="error" class="alert alert-warning" role="alert"></div>
                            <div id="confirm" class="alert alert-success" role="alert"></div>

                        </form>
          </div>
        </div>
        

			<div class="col-lg-12 col-lg-offset-2 col-md-1 col-md-offset-1" style="margin-top: -28px;">
      
				<p style="font-size: 12px; color: #fff !important"><?php echo $this->option_model->get_value('appfootercopy'); ?> Litwit Investment Capital</p>
			</div>
      </div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function(){
       

            jQuery("#formregisto").on('submit',(function(e) {
                e.preventDefault();
                jQuery("#error").empty().slideUp();
                jQuery("#confirm").empty().slideUp();
                jQuery('#loading').show();
                var curElement = jQuery(this);
                curElement.find(':submit').hide();

                jQuery.ajax({
                url: "<?php echo base_url(); ?>user/registerdata",
                type: "POST",
                dataType: 'json',
                data: new FormData(this),
                contentType: false,
                cache: false,             
                processData:false,
                success: function(data)
                {
                    jQuery('#loading').hide();
                    jQuery("#"+data.result).html(data.message).slideDown();
                    curElement.find(':submit').show();
                    if (data.result == "confirm") window.location.replace("<?php echo base_url(); ?>");
                }
                });
                    



            }));
            
    });
</script>