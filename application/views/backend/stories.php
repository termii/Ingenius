<div class="container background">

		    <div class="container header">
				<div class="pull-left">
					<h1 class="page_title_text">Stories</h1>
				</div>
			</div>

        <section id="maincontent" class="container content">
		
			<div class="contspacing">

	
			<form id="storiesform" action="" method="post">

			<div style="padding:20px 20px;  text-align: right;"><input type="text" value="" name="pubpesquisar" placeholder="Search" /></div>
			
			<div id="storiesarea" class="panel-body">
										
			</div>
										
			</form>
			

</div>

</section>
<script type='text/javascript'>
jQuery(document).ready(function($){
$("#storiesform").on('submit',(function(e) {
        e.preventDefault();
				var p = $(this).find('input[name=pubpesquisar]').val();
				
                $.post("<?php echo base_url(); ?>admin/loadstories", {
                p:p,
                <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
                },
                function(data){
                    $("#storiesarea").html(data);
				});
        return false;		
}));
$('input[name=pubpesquisar]').change(function() { $('#storiesform').submit(); });
$('#storiesform').submit();
});
</script>