<?php
session_start();
session_regenerate_id();
require("core/config.php");
require("core/functions.php");
require("core/api.php");
get_plugins("plugins");

$error = $page = $active = array();
$page['name'] = "Themes";
$active['dashboard'] = "";
$active['security'] = "";
$active['server'] = "";
$active['settings'] = "";
$active['system'] = "";
$active['themes'] = "active";

if(!isset($_SESSION['admin_auth'])) {
	header("Location: login.php");
	exit;
}
if(isset($_GET['logout'])) {
	session_destroy();
	header("Location: login.php");
	exit;
}

if(isset($_GET['theme']) && is_numeric($_GET['theme'])) {
	$t = $_GET['theme'];
	if($t == 1) {
		$_SESSION['theme'] = "theme-blue";
		header("Location: themes.php");
		exit;
	} elseif($t == 2) {
		$_SESSION['theme'] = "theme-red";
		header("Location: themes.php");
		exit;
	}
}

require("inc/top.php");
?>
<!-- Content -->
<div class="main-box clearfix">
<header class="main-box-header clearfix">
<h2> Application Themes </h2>
<p style="padding-bottom:1px;"> 
Themes are an easy way to change the default look and feel of the application to something more suitable to your taste.
<br>
<div class="col-sm-1">
<a href="?theme=1">
<div style="width:50px; height:50px; background-color:#3498db; margin:5px; border-radius:5px; display:block;"></div>
</a>
</div>

<div class="col-sm-1">
<a href="?theme=2">
<div style="width:50px; height:50px; background-color:#e74c3c; margin:5px; border-radius:5px; display:block;"></div>
</a>
</div>
</p>
</header>
</div>
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