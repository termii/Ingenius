<?php
session_start();
session_regenerate_id();
require("core/config.php");
require("core/functions.php");
require("core/api.php");
get_plugins("plugins");

$error = $page = $active = array();
$page['name'] = "Server Statistics";
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

$phpversion = phpversion();
$mysql_version = mysql_get_client_info();
$extensions = get_loaded_extensions();
$count = count($extensions);

require("inc/top.php");
?>
<!-- Content -->	
<div class="main-box clearfix">
<header class="main-box-header clearfix">
<h2> Statistics </h2>
<p style="padding-bottom:1px;"> 
Here you can find statistics and general information related to your web server.
</p>
</header>
</div>
<!-- PHP Version -->
<div class="col-lg-3 col-sm-6 col-xs-12">
<div class="main-box infographic-box red-bg" style="color:#fff;">
<span class="headline">PHP Version</span>
<span class="value"><?=phpversion()?></span>
</div>
</div>
<!-- MySQL Version -->
<div class="col-lg-3 col-sm-6 col-xs-12">
<div class="main-box infographic-box red-bg" style="color:#fff;">
<span class="headline">MySQL Version</span>
<span class="value"><?=$mysql_version?></span>
</div>
</div>
<!-- Loaded Extensions -->
<div class="col-lg-3 col-sm-6 col-xs-12">
<div class="main-box infographic-box red-bg" style="color:#fff;">
<span class="headline">Loaded Extensions</span>
<span class="value"><?=$count?></span>
</div>
</div>
</div>
</div>

<!-- Loaded Extensions List -->
<div class="main-box clearfix">
<header class="main-box-header clearfix">
<h2> Loaded Extensions (<?=$count?>)</h2>
<p style="padding-bottom:1px;"> 
Below you can find a list of all currently loaded php extensions.
</p>
<div class="well" style="overflow-y:scroll; max-height:200px;">
<ul>
<?php
foreach($extensions as $extension) {
	echo "<li>".$extension."</li>";
}
?>
</ul>
</div>
</header>
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