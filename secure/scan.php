<?php
session_start();
session_regenerate_id();
require("core/config.php");
require("core/functions.php");
require("core/api.php");
get_plugins("plugins");

$error = $page = $active = array();
$page['name'] = "Website Scan";
$active['dashboard'] = "";
$active['security'] = "active";
$active['server'] = "";
$active['settings'] = "";
$active['system'] = "";
$active['themes'] = "";

if(!isset($_SESSION['admin_auth'])) {
	header("Location: login.php");
	exit;
}
if(isset($_GET['logout'])) {
	session_destroy();
	header("Location: login.php");
	exit;
}

if(isset($_POST['scan'])) {
	
	include("core/db.php");
	$suggestion = "";
	if(!file_exists("../robots.txt")) { $suggestion = "The <a href=\"http://www.robotstxt.org/robotstxt.html\"> robots.txt </a> file gives instructions to web robots. Seems like it's missing."; }
	$scan = website_scan($db);
	$response = true;
	$_SESSION['last_scan'] = time();
	
}

require("inc/top.php");
?>
<!-- Content -->
<div class="main-box clearfix" id="main">
<header class="main-box-header clearfix">
<h2> Full Scan </h2>
<p style="padding-bottom:1px;"> 
Uses an intelligent scanning algorithm to ensure no important files are deleted, while cleaning unnecesary files, junk and removing dangerous files. 
<br><b>Last Scan:</b> <?=ago_convert($_SESSION['last_scan'])?> </span> </p>
<form action="" method="POST">
<input type="submit" name="scan" class="btn btn-success" value="Scan" style="outline:none;">
</form>
</header>
</div>
<?php if($response) { ?>
<div class="main-box clearfix">
<header class="main-box-header clearfix">
<h2> Scan Results </h2>
<p style="padding-bottom:1px;"> Below are the results from the scan you just performed. 
<?php if(($scan['malicious']+$scan['shells']) < 1) { ?> <br> <em>Looks like your website is <span class="text-success"> secure</span> </em> <?php } else { ?>
<br> <em>Looks like your website was in <span class="text-danger"> danger</span>! Don't worry, I fixed everything for you. </em>	
<?php } ?>
</span> </p>

<div class="col-lg-3 col-sm-6 col-xs-12">
<div class="main-box infographic-box red-bg" style="color:#fff;">
<span class="headline">Scanned</span>
<span class="value"><?=number_format($scan['files']+$scan['folders'])?></span>
</div>
</div>

<div class="col-lg-3 col-sm-6 col-xs-12">
<div class="main-box infographic-box red-bg" style="color:#fff;">
<span class="headline">Malicious</span>
<span class="value"><?=$scan['malicious']?></span>
</div>
</div>

<div class="col-lg-3 col-sm-6 col-xs-12">
<div class="main-box infographic-box red-bg" style="color:#fff;">
<span class="headline">Shells</span>
<span class="value"><?=$scan['shells']?></span>
</div>
</div>

<div class="col-lg-3 col-sm-6 col-xs-12">
<div class="main-box infographic-box red-bg" style="color:#fff;">
<span class="headline">Cleaned</span>
<span class="value"><?=$scan['cleaned']?></span>
</div>
</div>
<?php if(!empty($suggestion)) { ?> 
<b><i class="fa fa-info-circle"></i> &nbsp Suggestion:</b> <?=$suggestion?>	
<?php } ?>
</header>
</div>
<?php } ?>
</div>
</div>
<footer id="footer-bar" class="row">
<p id="footer-copyright" class="col-xs-12">
&copy; <?=date("Y")?> Web Keeper
</p>
</footer>
</div>
</div>
</div>

<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/scripts.js"></script>
</body>
</html>
<!-- Localized -->