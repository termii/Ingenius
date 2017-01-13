<?php
session_start();
session_regenerate_id();
set_time_limit(0);
require("core/config.php");
require("core/functions.php");
require("core/api.php");
get_plugins("plugins");
error_reporting(E_ALL);

$error = $page = $active = array();
$page['name'] = "Website Backup";
$active['dashboard'] = "";
$active['security'] = "";
$active['server'] = "active";
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

if(isset($_POST['backup'])) {
	
	require("inc/zip.php");
		
	$zipName = "backup_".time().".zip";
	Zip($_SERVER['DOCUMENT_ROOT'], 'backups/'.$zipName);
}

require("inc/top.php");
?>
<style>
b {
	font-size:13px;
}
</style>
<!-- Content -->
<div class="main-box clearfix">
<header class="main-box-header clearfix">
<h2> Full Backup </h2>
<p style="padding-bottom:1px;"> 
Backup your entire root directory in just one click (this may take a while)
<?php if(isset($error[0])) { ?> <div class="alert alert-danger"><?=$error[0]?></div> <?php } ?>
<form action="" method="POST">
<div class="col-md-4">
<input type="submit" name="backup" class="btn btn-success" value="Create" style="outline:none;">
</div>
</form>
</p>
</header>
</div>
<?php if(isset($result) && !empty($result)) { ?>
<div class="main-box clearfix">
<header class="main-box-header clearfix">
<p style="padding-bottom:1px;"> 
<h2 class="text-success"> Success </h2>
Your backup has succesfully been created and will automatically be downloaded to your computer in a few seconds...
</p>
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