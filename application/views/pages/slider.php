<?php
    $sliderp = $this->stories_model->get_slider($this->option_model->get_value('appslidertype'));
    $sx = 0;
    $som = 0;
    $total = $this->option_model->get_value('appsliderlimit');
    if (count($sliderp)>0) {
    while ($sx < $total) {
?>    
    <div id="topslide">
        <?php $link = base_url()."stories/article/".$sliderp[$som+$sx]['post_slug']; ?>
        <div class="row">
            <div class="col-md-8" style="padding-left:0;background:url('<?php echo base_url()."images/".$sliderp[$som+$sx]['post_image']; ?>');background-size:cover;min-height:390px;">
                <a class="topslidebg" href="<?php echo $link; ?>">
                <div class="captionslideshow">
                    <div class="cat" style="background-color:#2196f3;"><span><?php echo $sliderp[$som+$sx]['category_name']; ?></span></div> <br>                                              
                    <h2 class="upper posts-masonry-heading" style="clear:both;">
                        <?php echo mb_substr($sliderp[$som+$sx]['post_subject'],0,100).'...'; ?>
                    </h2> 

                    

                          <?php if (strlen($sliderp[$som+$sx]['post_text']) > 0)  { ?>
                          <p style="width:80%;color:#FFF;margin:0;margin-top:10px;margin-bottom:7px;"><?php echo strip_tags(mb_substr($sliderp[$som+$sx]['post_text'],0,90)).'...'; ?></p>
                          <?php } ?>

                </div>
                </a>
                <div style="position:absolute;bottom:35px;right:30px;">
                        
                            <span><i class="fa fa-eye"></i>&nbsp;&nbsp;<?php echo $sliderp[$som+$sx]['numberviews']; ?></span>&nbsp;&nbsp;&nbsp;
                            <i class="fa fa-comment"></i>&nbsp;&nbsp;<?php echo $this->stories_model->num_comments($sliderp[$som+$sx]['post_id']); ?>&nbsp;&nbsp;

                                       
                                <i class="fa fa-thumbs-up"></i>&nbsp;&nbsp;<span class="numvotes"><?php echo $this->stories_model->num_votes($sliderp[$som+$sx]['post_id']); ?></span>&nbsp;
                                

                        </div>
            </div>
            <div class="col-md-4">
                <?php $link = base_url()."stories/article/".$sliderp[$som+$sx+1]['post_slug']; ?>
                <div class="row">
                    <div class="col-md-12" style="background:url('<?php echo base_url()."images/".$sliderp[$som+$sx+1]['post_image']; ?>');background-size:cover;min-height:195px;">
                        <a class="topslidebg" href="<?php echo $link; ?>" tabindex="-1">
                        <div class="captionslideshow">
                            <div class="cat" style="background-color:#f44336;"><span><?php echo $sliderp[$som+$sx+1]['category_name']; ?></span></div> <br>                                              
                            <h2 class="upper posts-masonry-heading" style="clear:both;font-size: 22px;">
                                <?php echo mb_substr($sliderp[$som+$sx+1]['post_subject'],0,30).'...'; ?> 
                            </h2>                  
                        </div>
                        </a>
                    </div>
                </div>
                <?php $link = base_url()."stories/article/".$sliderp[$som+$sx+2]['post_slug']; ?>
                <div class="row">
                    <div class="col-md-12" style="background:url('<?php echo base_url()."images/".$sliderp[$som+$sx+2]['post_image']; ?>');background-size:cover;min-height:195px;">
                            <a class="topslidebg" href="<?php echo $link; ?>" tabindex="0">
                            <div class="captionslideshow">
                    <div class="cat" style="background-color:#78909c;"><span><?php echo $sliderp[$som+$sx+2]['category_name']; ?></span></div> <br>                                              
                    <h2 class="upper posts-masonry-heading" style="clear:both;font-size: 22px;">
                        <?php echo mb_substr($sliderp[$som+$sx+2]['post_subject'],0,30).'...'; ?>
                    </h2>                  
                </div>
                </a>
                    </div>
                </div>

            </div>
        </div>      

    </div>
    <?php $sx++; $som = $som+2; } } ?>