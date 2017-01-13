<?php

function pretify($header, $body, $side=false) {
?>
<div class="main-box clearfix">
<header class="main-box-header clearfix">
<h2><?=$header?></h2>
<p style="padding-bottom:1px;"><?=$body?></p>
<?php
if(empty($_POST)) {
	echo "</div>";
}
if($side == false) {
	echo '</header></div>';
} 
}

function side_pretify($header, $body) {
?>
<div class="col-md-3">
<h2><?=$header?></h2>
<p style="padding-bottom:1px;"><?=$body?></p>
</div>
</div>
<?php
}