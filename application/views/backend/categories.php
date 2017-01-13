<div class="container header">
				<div class="pull-left">
					<h1 class="page_title_text">Categories</h1>
				</div>
				<div class="pull-right">
<a data-toggle="modal" class="btn btn-primary" href="<?php echo site_url('admin/addcategory'); ?>">Add new category</a>
</div>
			</div>
        <section id="maincontent" class="container content">
		
			<div class="contspacing">
						
	
			

			<form id="categoriesform" action="" method="post">


			<div style="padding:20px 20px;  text-align: right;"><input type="text" value="" name="pubpesquisar" placeholder="Search" /></div>
			
			<div id="categoriesarea" class="panel-body">
										
			</div>
										
			</form>
			

</div>

</section>
<script type='text/javascript'>
jQuery(document).ready(function($){
$("#categoriesform").on('submit',(function(e) {
        e.preventDefault();
				var p = $(this).find('input[name=pubpesquisar]').val();
				
                $.post("<?php echo base_url(); ?>admin/loadcategories", {
                p:p,
                <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
                },
                function(data){
                    $("#categoriesarea").html(data);
				});
        return false;		
}));
$('input[name=pubpesquisar]').change(function() { $('#categoriesform').submit(); });
$('#categoriesform').submit();
});
</script>