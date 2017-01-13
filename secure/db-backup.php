<?php
session_start();
session_regenerate_id();
require("core/config.php");
require("core/functions.php");
require("core/api.php");
get_plugins("plugins");

$error = $page = $active = array();
$page['name'] = "Database Backup";
$active['dashboard'] = "";
$active['security'] = "";
$active['server'] = "active";
$active['settings'] = "";
$active['system'] = "";
$active['themes'] = "";

if(isset($_POST['backup'])) {
	$dbhost = $_POST['db_host'];
	$dbuser = $_POST['db_username'];
	$dbpass = $_POST['db_password'];
	$dbname = $_POST['db_name'];
	$backup_file = $dbname."-".date("Y-m-d-H-i-s") . '.gz';
	$command = "mysqldump --opt -h $dbhost -u $dbuser -p $dbpass $dbname | gzip > backups/$backup_file";
	$command = system($command);
	$success = true;
}

require("inc/top.php");
?>
<!-- Content -->
<div class="main-box clearfix">
<header class="main-box-header clearfix">
<h2> MySQL Database Backup </h2>
<p style="padding-bottom:1px;"> 
You can use this tool to backup your mysql database in a secure and easy way.
<div class="row">
<div class="col-md-3">
<form action="" method="POST">
<input type="text" name="db_host" class="form-control form-space" placeholder="MySQL Database Host">
<input type="text" name="db_username" class="form-control form-space" placeholder="MySQL Database Username">
<input type="password" name="db_password" class="form-control form-space" placeholder="MySQL Database Password">
<input type="text" name="db_name" class="form-control" placeholder="MySQL Database Name">
<br>
<input type="submit" name="backup" class="btn btn-success" value="Create" style="outline:none;">	
</form>
</div>
</div>
</p>
</header>
</div>
<?php if(isset($success) && isset($_POST['backup']) && $success == true) { ?>
<div class="main-box clearfix">
<header class="main-box-header clearfix">
<h2 class="text-success"> Backup Created </h2>
<p style="padding-bottom:1px;">
Your <b><?=$dbname?></b> database has been successfully backed up!
</p>
<a href="backups/<?=$backup_file?>" class="btn btn-success"> Download </a>.
</header>
</div>
<?php } elseif(isset($success) && isset($_POST['backup']) && $success == false) { ?>
<div class="main-box clearfix">
<header class="main-box-header clearfix">
<h2 class="text-danger"> Oops! </h2>
<p style="padding-bottom:1px;"> 
<div class="alert alert-danger"><i>Are you sure all of the provided information is <b>correct</b>?</i></div>
There was problem backing up the requested database, please try again later!
</p>
</header>
</div>	
<?php } ?>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/scripts.js"></script>