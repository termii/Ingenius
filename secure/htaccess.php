<?php
session_start();
session_regenerate_id();
require("core/config.php");
require("core/functions.php");
require("core/api.php");
get_plugins("plugins");

$error = $page = $active = array();
$page['name'] = ".htaccess";
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

if(file_exists("../.htaccess")) {
	$htaccess = file_get_contents("../.htaccess");
} else {
	fopen("../.htaccess","w+");
}
$exists = true;

if(isset($_POST['save'])) {
	$content = $_POST['editor'];
	file_put_contents("../.htaccess", $content);
	header("Location: htaccess.php");
	exit;
}

require("inc/top.php");
?>
<!-- Content -->
<div class="main-box clearfix">
<header class="main-box-header clearfix">
<h2> Editor </h2>
<p style="padding-bottom:1px;"> 
This page allows you to edit your server's .htaccess file, without having to manually open it in a text editor.
<form action="" method="POST">
<?php if($exists == false) { ?>
<pre><code><?=$htaccess?></code></pre>
<?php } else { ?>
<textarea name="editor" class="form-control" rows="5"><?=$htaccess?></textarea> <br>
<input type="submit" name="save" class="btn btn-success" value="Save" style="outline:none;">
<?php } ?>
</header>
</form>
</p>
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