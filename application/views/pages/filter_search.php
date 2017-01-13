<!-- Today -->
                <div class="row" style="margin-bottom:15px;">
                    
                    <div id="filtrag" class="col-md-12 col-sm-12" style="text-align:left;">
                        
                        <div class="row">
                        <div class="col-md-6 col-sm-12" style="padding-left:0;">
                        <div id="dayfilter" class="dropdown" style="min-height: 35px;">
                          <button class="filterposts dropdown-toggle" style="padding-right:0;" type="button" data-toggle="dropdown"><span class="txt">All InGenius categories</span>
                          <span class="caret"></span></button>
                          <ul class="dropdown-menu">
                            <li><a href="javascript:void(0);" onclick="jQuery.filtrb('All');"><?php echo $this->lang->line('alltime_text'); ?></a></li>
                            <li><a href="javascript:void(0);" onclick="jQuery.filtrb('Today');"><?php echo $this->lang->line('today_text'); ?></a></li>
                            <li><a href="javascript:void(0);" onclick="jQuery.filtrb('Yesterday');"><?php echo $this->lang->line('yesterday_text'); ?></a></li>
                            <li><a href="javascript:void(0);" onclick="jQuery.filtrb('Week');"><?php echo $this->lang->line('week_text'); ?></a></li>
                            <li><a href="javascript:void(0);" onclick="jQuery.filtrb('Month');"><?php echo $this->lang->line('month_text'); ?></a></li>
                            <li><a href="javascript:void(0);" onclick="jQuery.filtrb('Year');"><?php echo $this->lang->line('year_text'); ?></a></li>  
                            <li><a href="javascript:void(0);" onclick="jQuery.filtr('Most Recent');" class="sel">Recent</a></li>
                            <li><a href="javascript:void(0);" onclick="jQuery.filtr('Most Comment');">Comments</a></li>                          
                          </ul>
                        </div>
                        </div>

                        
                        <div class="widget">
          
    <div class="social-widget">            
      <ul>        
        <?php if ($this->option_model->get_value('appfacebookurl')) { ?>
        <li><a href="<?php echo $this->option_model->get_value('appfacebookurl'); ?>" class="facebook" target="_blank"><i class="fa fa-facebook"></i></a></li>
        <?php } ?>
        <?php if ($this->option_model->get_value('apptwitterurl')) { ?>
        <li><a href="<?php echo $this->option_model->get_value('apptwitterurl'); ?>" class="twitter" target="_blank"><i class="fa fa-twitter"></i></a></li>
        <?php } ?>
        <?php if ($this->option_model->get_value('appyoutubeurl')) { ?>
        <li><a href="<?php echo $this->option_model->get_value('appyoutubeurl'); ?>" class="youtube" target="_blank"><i class="fa fa-youtube"></i></a></li>                        
        <?php } ?>
        <?php if ($this->option_model->get_value('appvimeourl')) { ?>
        <li><a href="<?php echo $this->option_model->get_value('appvimeourl'); ?>" class="vimeo" target="_blank"><i class="fa fa-vimeo-square"></i></a></li>
        <?php } ?>
        <?php if ($this->option_model->get_value('appinstagramurl')) { ?>
        <li><a href="<?php echo $this->option_model->get_value('appinstagramurl'); ?>" class="instagram" target="_blank"><i class="fa fa-instagram"></i></a></li>        
        <?php } ?>
      </ul>
    </div>
  
    </div>
                        </div>
                </div>
                <br />