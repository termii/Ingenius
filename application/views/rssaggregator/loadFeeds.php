<table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
												<th>#</th>                                               
												<th>Feed Name</th>                                                                                                                           
                                                <th>Feed Url</th>
                                                <th>Action</th>                                      																			
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                                        <?php if (count($feeds)>0): ?>

                                                        

                                                        <?php foreach($feeds as $pub): ?>

                                                        <tr data-id="<?php echo $pub['id_feed']; ?>">
                                                            <th><a style="cursor:pointer;" class="removefeed"><span class="label label-danger">Remove</span></a></th>
                                                            <th><a style="cursor:pointer;" class="editstory" href="<?php echo base_url(); ?>rssaggregator/editrss/<?php echo $pub['id_feed']; ?>"><span class="label label-warning">Edit</span></a></th>
                                                            <td><?php echo $pub['desc_feed']; ?></td>                                                            
                                                            <td><?php echo $pub['url_feed']; ?></td>
                                                            <td><button type="button" class="btn btn-primary btnimport">Import Now</button></td>															
                                                        </tr>                                                        
                                                        
                                                        <?php endforeach; ?>
                                                        

                                                    <?php else: ?>

                                                    <tr>
                                                    <td>No feeds.</td>
                                                    </tr>

                                                    <?php endif; ?>


                                        </tbody>
                                    </table>
									
<script type='text/javascript'>
jQuery(document).ready(function($){								
    PNotify.prototype.options.styling = "bootstrap3";
	jQuery('a.removefeed').click(function() 
	{
			if (confirm('Are you sure do you want delete?')) {
				var i = $(this).parent().parent().attr('data-id');
				$(this).parent().parent().remove();
				
				
				$.post("<?php echo base_url(); ?>rssaggregator/removefeed", {
                i:i,
                <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
                },
                function(data){                   
				});
				return false;
				
			}			
	});

    jQuery('button.btnimport').click(function() 
    {
            var btn = $(this);
            if (confirm('Are you sure do you want import?')) {
                var i = $(this).parent().parent().attr('data-id');
                $(this).html("Importing... Please wait").attr("disabled", true);                


                
                jQuery.post("<?php echo base_url() ?>rssaggregator/importfeed/"+i, { <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>' },
                    function(data){
                               if (data.result == "confirm") 
                                {
                                    new PNotify({
                                        title: 'Success',
                                        type: 'success',
                                        text: data.message
                                    });
                                    btn.html("Import Now").attr("disabled", false);                    
                                } else {
                                    new PNotify({
                                        title: 'Error',
                                        type: 'error',
                                        text: data.message
                                    });
                                }
                    }, "json");

            }           
    });
                                                        
});
</script>