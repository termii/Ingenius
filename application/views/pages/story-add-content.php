<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.1/summernote.css" rel="stylesheet">    
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.1/summernote.js"></script>
<link href="<?php echo base_url(); ?>css/bootstrap-tagsinput.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url(); ?>ckeditor/toolbarconfigurator/lib/codemirror/neo.css">
<script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap-tagsinput.js"></script>

<div class="container" id="pagecontent">
            <div class="row">
                <div class="col-sm-8 col-md-8 col-md-offset-2">
                    <div class="account-wall" style="margin:30px 0px;">                        
                        
                        <h3 style="margin-top:0;">
                        <?php if ($story) { echo $this->lang->line('title_editstory'); } else { echo $this->lang->line('title_addstory'); } ?>
                        </h3>
                        <br />


                        <?php 
                            $show = 1;
                            if ($this->option_model->get_value('apppostauthor') == 1) {
                              $query = $this->db->query("SELECT * FROM users WHERE user_id='".$this->session->userdata('userid')."' AND user_level='2' LIMIT 1");
                              if ($query->num_rows() > 0) { $show = 1; } else { $show = 0; }
                            }
                        ?>
                        <?php if ($show == 1) { ?>

                        <form id="formstorycontent" action="" method="post">
                                <div class="append-icon" style="margin-top:10px;">
                                    <div id="filtercategory" class="dropdown">
                                      <button class="filterposts dropdown-toggle" type="button" data-toggle="dropdown"><span class="txt"><?php echo $this->lang->line('selectcategory'); ?></span>
                                      <span class="caret"></span></button>
                                      <ul class="dropdown-menu">
                                        <?php if (count($categories)>0): ?>
                                        <?php foreach($categories as $cat): ?>
                                            <li><a href="javascript:void(0);" onclick="filtercat('<?php echo $cat['id_category']; ?>', '<?php echo $cat['category_name']; ?>');"><?php echo $cat['category_name']; ?></a></li>                    
                                        <?php endforeach; ?>
                                        <?php endif; ?>    
                                      </ul>
                                    </div>
                                    <i class="icon-envelope"></i>
                                </div>

                                <div class="append-icon" style="margin-top:10px;">
                                    <input type="text" data-role="tagsinput" name="tags" id="tags" class="form-control form-white" placeholder="Tags" value="<?php if (count($tags)>0): ?><?php foreach($tags as $tag): ?><?php echo $tag['tag_name']; ?>,<?php endforeach; ?><?php endif; ?>">
                                    <span style="font-size:12px;clear:both;"><?php echo $this->lang->line('entertag'); ?></span>
                                </div>

                                <br />
                                <div class="append-icon" style="margin-top:10px;">
                                  <input type="text" name="title" id="title" class="form-control form-white" placeholder="Title" required="" value="<?php if ($story) { echo $story[0]['post_subject']; } ?>">
                                  <i class="icon-envelope"></i>
                                </div>

                                <div class="editornote" style="margin-top:10px;">
                                  <div id="summernote2"><?php if ($story) { echo $story[0]['post_text']; } ?></div>
                                  <textarea style="display:none;" name="post_text" id="post_text2" class="form-control form-white" placeholder="Post text" rows="6" maxlength="900"></textarea>                                
                                </div>
                                <br />
                                
                                <div class="append-icon row" style="margin-top:10px;background-color:#f8f8f8;border-radius:10px;padding:10px 30px;">                                
                                    <div class="col-md-6">
                                    <?php echo $this->lang->line('uploadimage'); ?>
                                    <input type="file" name="file" id="file" />
                                    <span style="font-size:12px;clear:both;"><?php echo $this->lang->line('maxsize'); ?> 900 Kb</span>
                                    </div>
                                    <div class="col-md-6">
                                      <br />
                                      <button type="button" id="send-image" class="button m-t-20 button-green" style="float:right;"><?php echo $this->lang->line('uploadimage'); ?></button>
                                    </div>
                                </div>
                                <div id="fileloading" style="display:none;" class="alert alert-warning"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> &nbsp;<?php echo $this->lang->line('loading_text'); ?></div>
                                <div id="fileerror" style="display:none;" class="alert alert-warning" role="alert"></div>
                                <div id="fileconfirm" style="display:none;" class="alert alert-success" role="alert"></div>
                                <br />
                                <div class="append-icon row" style="margin-top:10px;background-color:#f8f8f8;border-radius:10px;padding:10px 30px;">                                
                                    <?php echo $this->lang->line('uploadimageurl'); ?>
                                    <input type="text" name="postimage" id="postimage" class="form-control form-white" value="<?php if ($story) {?><?php echo base_url(); ?>images/<?php echo $story[0]['post_image']; ?><?php } ?>" placeholder="Image full url" required="" rows="6" />                                
                                </div>

                                <div class="clearfix">
                                 <br />
                                  <input type="hidden" id="contentype" name="contentype" value="text" />
                                  <input type="hidden" name="category" value="" />
                                  <input type="hidden" name="draft" value="" />
                                  <?php if ($story) { ?><input type="hidden" name="edit" value="<?php echo $story[0]['post_id']; ?>" /><?php } ?>
                                  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                  <?php if ($story) { ?>
                                      
                                      <button type="submit" id="submit-form" class="button m-t-20 button-green"><?php echo $this->lang->line('submit_editstory'); ?></button>
                                      </p>
                                      <p class="pull-right m-t-20">
                                      <a href="<?php echo base_url() ?>"><?php echo $this->lang->line('cancel_addstory'); ?></a>
                                      <?php } else { ?>
                                      <button type="submit" id="submit-form" class="button m-t-20 button-green"><?php echo $this->lang->line('submit_addstory'); ?></button>
                                      <button type="button" id="draft-form" class="button m-t-20 button-grey"><?php echo $this->lang->line('draft_addstory'); ?></button></p>
                                      <p class="pull-right m-t-20">
                                      <a href="<?php echo base_url() ?>"><?php echo $this->lang->line('cancel_addstory'); ?></a>
                                      <?php } ?>
                                </div>

                                </form>



                            <div id="loading" class="alert alert-warning"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> &nbsp;<?php echo $this->lang->line('loading_text'); ?></div>
                            <div id="error" class="alert alert-warning" role="alert"></div>
                            <div id="confirm" class="alert alert-success" role="alert"></div>


                            <?php } else { ?>
                              <div id="onlyauthor" class="alert alert-warning" role="alert"><?php echo $this->lang->line('onlyauthors'); ?></div>
                            <?php } ?>

</div>
</div>
</div>
</div>

<script type="text/javascript">

    jQuery(document).ready(function(){


      $('#summernote1, #summernote2').summernote({
              height: 200,                 
  minHeight: null,             
  maxHeight: null,             
  focus: false  
});


        var imgArray;
        var title;
        var desc;
        
        var index = 0;

            $("#link").keyup(function(){
            $('#successdata').slideUp();
            var link = $.trim($("#link").val());

        if(/^(http|https|ftp):\/\/[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/i.test(link))
        {

              imgArray = new Array();
              jQuery('#error').html("").hide();
              $("#loading").show();
              $("#successdata").slideUp("hide");
              var link=$("#link").val();
              
              
        $.post("<?php echo base_url(); ?>stories/verifylink2", {
                  link: link,
          <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
        },
        function(data){
          
           
            
        if(data.result != "error") {

           $('#successdata').slideDown("show");

           $.each(data, function(key, val) {

            if(val.src != null){
                imgArray.push(val.src);
                $("#trick").attr("src",val.src);
                console.log(imgArray);
            }

            if(val.title != null) $('#title').val(val.title);
            if(val.desc != null) $('#summernote1').summernote('code', val.desc); //CKEDITOR.instances['post_text'].setData(val.desc); //$('#post_text').html(val.desc); 
            if(val.contentype != null) $('#contentype').val(val.contentype);            

          });  


          if(imgArray.length > 0){
            $(".nav").show();
            $(".extract-thumb").css("visibility","visible");

            if($(".extract-thumb").html() == "") {
                $(".extract-thumb").append('<img src="'+imgArray[0]+'" style="">');
            } else {
                $(".extract-thumb").html('<img src="'+imgArray[0]+'" style="">');
            }

          } else {
                $(".nav").hide();
                $(".extract-thumb").css("visibility","hidden");
                $("#linkimageno").show();
          }

          showcount(index);
          jQuery('#loading').hide();
          $('#successdata').slideDown("show");
          $('#postimage').val(imgArray[index]);

        } else {
            jQuery('#loading').hide();
            jQuery('#error').html(data.message).show();

        }              

          


        }, "json");


        } else {
            jQuery('#error').html("URL invalid").show();
        }
              
        
    });


    $("#next").click(function(){
         if(index < imgArray.length){
             index++;
             $(".extract-thumb").find("img").attr("src",imgArray[index]);
             if (imgArray[index]) $('#postimage').val(imgArray[index]);
             showcount(index);
         }
     });
     $("#prev").click(function(){
         if(index > 0){
             index--;
             $(".extract-thumb").find("img").attr("src",imgArray[index]);
             if (imgArray[index]) $('#postimage').val(imgArray[index]);
             showcount(index);
         }
     });

     
     showcount = function(index){
       index = index + 1;
       if(index <= imgArray.length && index > 0)    
        $("#navount").html("Images "+index+" of "+imgArray.length);
     };

    jQuery("#formstory, #formstorycontent").on('submit',(function(e) {
        e.preventDefault();

        jQuery("#formstory textarea[name=post_text]").val($('#summernote1').summernote('code'));
        jQuery("#formstorycontent textarea[name=post_text]").val($('#summernote2').summernote('code'));                

        jQuery("#error").empty().slideUp();
        jQuery("#confirm").empty().slideUp();
        jQuery('#loading').show();
        var curElement = jQuery(this);
        curElement.find(':submit').hide();

        jQuery.ajax({
        url: "<?php echo base_url(); ?>stories/addstory",
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
            if (data.result == "confirmm") window.location.replace("<?php echo base_url(); ?>");
        }
        });            
    }));

    


    filtercat = function(q, t) {
        jQuery('#filtercategory .txt').html(t);
        jQuery('input[name=category]').val(q);
    }

    <?php if ($story) { ?>
    filtercat('<?php echo $story[0]['id_category']; ?>', '<?php echo $story[0]['category_name']; ?>'); 
    <?php } ?>
    
    $("#draft-form").click(function(){
      jQuery('input[name=draft]').val("draft");
      $(this).parent().submit();
    });


            
    $("#send-image").click(function(){
            
    jQuery('#formstorycontent > #fileloading').show();
    data = new FormData($("#formstorycontent")[0]);

    jQuery.ajax({
        url: "<?php echo base_url(); ?>stories/uploadimage",
        type: "POST",
        dataType: 'json',
        data: data,
        contentType: false,
        cache: false,
        processData:false,
        success: function(data)
        {
            jQuery('#formstorycontent > #fileloading').hide();
            jQuery("#formstorycontent > #"+data.result).html(data.message).slideDown();
            if (data.result == "fileconfirm") { $("#formstorycontent input[name=postimage]").val(data.url) }
        }
    });
    });

    });

</script>