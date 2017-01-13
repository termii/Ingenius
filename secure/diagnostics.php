<?php
session_start();
session_regenerate_id();
require("core/config.php");
require("core/functions.php");
require("core/api.php");
get_plugins("plugins");

$error = $page = $active = array();
$page['name'] = "Diagnostics";
$active['dashboard'] = "";
$active['security'] = "";
$active['server'] = "";
$active['settings'] = "";
$active['system'] = "active";
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

if(isset($_POST['run'])) {
	$log = "";
	$start = microtime(true);
	
	// Collect information
	$software = $_SERVER['SERVER_SOFTWARE'];
	$script_version = $version['current'];
	$php_version = phpversion();
	if(is_numeric($version['newest'])) { $api = "successful"; } else { $api = "unsuccessful"; }
	
	$log .= "Software Version is ".$software;
	$log .= "<br>";
	$log .= "Web Keeper Version is ".$script_version;
	$log .= "<br>";
	$log .= "PHP Version is ".$php_version;
	$log .= "<br>";
	$log .= "Attempting to connect to API";
	$log .= "<br>";
	$log .= "Connection to API was ".$api;
	$log .= "<br>";
	$log .= "Trying again...";
	$log .= "<br>";
	$log .= "Connection to API was ".$api;
	$end = microtime(true);
	$total = $end - $start;
	$log .= "<br> --- <br>";
	$log .= "Finished in ".round($total, 2)."s";

	// Display log
	$response = true;

}

require("inc/top.php");
?>
<!-- Content -->
<div class="main-box clearfix">
<header class="main-box-header clearfix">
<h2> System Diagnostics </h2>
<p style="padding-bottom:1px;"> 
Running diagnostics will create a report for you. The report contains general information about your server environment and can help us resolve any issues that you may happen to experience.
<br>
<form action="" method="POST">
<input type="submit" name="run" class="btn btn-success" value="Run" style="outline:none;">
</form>
</p>
</header>
</div>
<?php if($response) { ?>
<div class="main-box clearfix">
<header class="main-box-header clearfix">
<h2> Report </h2>
<p style="padding-bottom:1px;">
<div class="well">
<code>
<?=$log?>
</code>
</div>
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