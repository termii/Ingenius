<?php
session_start();
session_regenerate_id();
require("core/config.php");
require("core/functions.php");
require("core/api.php");
get_plugins("plugins");

$error = $page = $active = array();
$page['name'] = "Bot Guard";
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

if(isset($_POST['clear'])) {
	
	file_put_contents("logs/bot.log", "");
	header("Location: bot-guard.php");
	exit;
	
}

if(isset($_POST['export'])) {
	$file = "bot.log";
	header('Content-type: audio/mpeg3');
	header('Content-Disposition: attachment; filename="'.$file.'"');
	readfile('logs/'.$file);
	exit();
}

if(isset($bot_guard)) {
	if($bot_guard == 'true') {
		$guard = '<span class="text-success"> Online </span>';
	} else {
		$guard = '<span class="text-danger"> Offline </span>';
	}
} else { die("Error retrieving Bot Guard configuration!! Please consider reinstalling or contacting support."); }

if(isset($_POST['start'])) {

$status = 'true';

$new = "
<?php
\$user = \$server = array();

// User Settings
\$default['username'] = '".$default['username']."';
\$default['password'] = '".$default['password']."';
\$default['email'] = '".$default['email']."';

\$system['version'] = '".$system['version']."';

\$ddos_guard = '$ddos_guard';
\$bot_guard = 'true';

\$notif['email'] = ".$notif['email'].";
";

$new = trim($new);

file_put_contents("core/config.php", $new);

header("Location: bot-guard.php");

exit;

}

if(isset($_POST['stop'])) {

$status = 'false';

$new = "
<?php
\$user = \$server = array();

// User Settings
\$default['username'] = '".$default['username']."';
\$default['password'] = '".$default['password']."';
\$default['email'] = '".$default['email']."';

\$system['version'] = '".$system['version']."';

\$ddos_guard = '$ddos_guard';
\$bot_guard = 'false';

\$notif['email'] = ".$notif['email'].";
";

$new = trim($new);

file_put_contents("core/config.php", $new);

header("Location: bot-guard.php");

exit;

}

if(file_exists("logs/bot.log")) {
	$log = file_get_contents("logs/bot.log");
	if(empty($log)) {
		$log = "No malicious bots have visited your website";
	}
} else {
	$log = "No malicious bots have visited your website";
}

require("inc/top.php");
?>
<!-- Content -->
<div class="main-box clearfix">
<header class="main-box-header clearfix">
<h2> Guard </h2>
<p style="padding-bottom:1px;"> 
Powerful tool which will automatically detect and block spam/malicious bots on any page of your website. <br>
<b>Status:</b> <?=$guard?>
<form action="" method="POST">
<input type="submit" name="start" class="btn btn-success" value="Start" style="outline:none;">
<input type="submit" name="stop" class="btn btn-danger" value="Stop" style="outline:none;">
</form>
</header>
</p>
</div>
<!-- Log -->
<div class="main-box clearfix">
<header class="main-box-header clearfix">
<h2> Log </h2>
<p style="padding-bottom:1px;"> Below are all of the logged bot blocks. </span> </p>
<pre><code><div style="overflow-y:auto; max-height:200px;"><?=$log?></div></code></pre>
<form action="" method="POST">
<button type="submit" name="export" class="btn btn-primary" style="outline:none;"> <i class="fa fa-download" style="padding-right:2px;"></i> Export </button>
<button type="submit" name="clear" class="btn btn-primary" style="outline:none;"> <i class="fa fa-trash" style="padding-right:2px;"></i> Clear </button>
</form>
</header>
</div>
<!-- Log -->
<!-- Content -->
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