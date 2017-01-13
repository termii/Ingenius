<?php
session_start();
session_regenerate_id();
require("core/config.php");
require("core/functions.php");
require("core/api.php");
get_plugins("plugins");

$error = $page = $active = array();
$page['name'] = "Dashboard";
$active['dashboard'] = "active";
$active['security'] = "";
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

if(file_exists("../php_errorlog")) {
	$log = tail("../php_errorlog",500);
} else {
	$log = "No log exists";
}

// Scan and update statistics (auto)
$stats = update_stats();
$files = $stats['files'];
$images = $stats['images'];
$folders = $stats['folders'];


// Scan and update statistics (by user request)
if(isset($_POST['scan'])) {
unset($_SESSION['last_update']);
$_SESSION['last_update'] = time();
$stats = update_stats();
$files = $stats['files'];
$images = $stats['images'];
$folders = $stats['folders'];
}

require("inc/top.php");
?>
<div class="row">
<div class="col-lg-3 col-sm-6 col-xs-12">
<div class="main-box infographic-box">
<i class="fa fa-file red-bg"></i>
<span class="headline">Files</span>
<span class="value"><?=$files?></span>
</div>
</div>
<div class="col-lg-3 col-sm-6 col-xs-12">
<div class="main-box infographic-box">
<i class="fa fa-folder red-bg"></i>
<span class="headline">Folders</span>
<span class="value"><?=$folders?></span>
</div>
</div>
<div class="col-lg-3 col-sm-6 col-xs-12">
<div class="main-box infographic-box">
<i class="fa fa-picture-o yellow-bg"></i>
<span class="headline">Images</span>
<span class="value"><?=$images?></span>
</div>
</div>
<div class="col-lg-3 col-sm-6 col-xs-12">
<div class="main-box infographic-box">
<i class="fa fa-info emerald-bg"></i>
<span class="headline">Version</span>
<span class="value"><?=$system['version']?></span>
</div>
</div>
</div>
<div class="main-box clearfix">
<header class="main-box-header clearfix">
<h2> Statistics </h2>
<p style="padding-bottom:1px;"> Click the button bellow to scan the filesystem and update the statistics. <br> <b>Last Update:</b> <?=ago_convert($_SESSION['last_update'])?> </span> </p>
<form action="" method="POST">
<input type="submit" name="scan" class="btn btn-success" value="Update" style="outline:none;">
</form>
</header>
</div>
<div class="main-box clearfix">
<header class="main-box-header clearfix">
<h2> Error Log </h2>
<p style="padding-bottom:1px;"> This is your server's error log</span> </p>
<pre><code><div style="overflow-y:auto; max-height:200px;"><?=$log?></div></code></pre>
</header>
</div>
<?hook('dashboard', time())?>
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