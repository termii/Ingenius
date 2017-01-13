<div class="row">

    <div class="col-md-12">   
        <?php if ($this->option_model->get_value('appgads') == "1") { ?>
        <!-- Ads -->
        <div class="pubarea" style="margin-top:20px;padding-bottom:15px;">                
                <div class="row">
                    <div class="col-md-12" style="text-align:center;">
                        <a href="<?php echo $this->option_model->get_value('appadvlink'); ?>">
                            <img src="<?php echo $this->option_model->get_value('appadvimgurl'); ?>" style="display:inline-block;" class="img-responsive">
                        </a>                   
                    </div>
                </div>
        </div>
        <?php } ?>

        <?php if ($this->option_model->get_value('appgads') == "2") { ?>
        <div class="pubarea" style="margin-top:20px;padding-bottom:15px;">                
                <div class="row">
                    <div class="col-md-12" style="text-align:center;">

                       <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Inegnius -->
<ins class="adsbygoogle"
     style="display:inline-block;width:728px;height:90px"
     data-ad-client="ca-pub-7923110857512188"
     data-ad-slot="4139835821"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>

                        </div>
                </div>
        </div>
        <?php } ?>

        <?php if ($this->option_model->get_value('appgads') == "3") { echo $this->option_model->get_value('appadscode'); } ?>

        <?php $this->load->view('pages/filter_search'); ?>
                
        </div>
        </div>