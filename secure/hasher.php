<?php
session_start();
session_regenerate_id();
require("core/config.php");
require("core/functions.php");
require("core/api.php");
get_plugins("plugins");

$error = $page = $active = array();
$page['name'] = "Hash Generator";
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

if(isset($_POST['hash']) && !empty($_POST['data']) && strlen(trim($_POST['data'])) > 0) {
	$data = $_POST['data'];
	$result = "";
	$alg = $_POST['alg'];
	$result = hash($alg, $data);
}

require("inc/top.php");
?>
<!-- Content -->
<div class="main-box clearfix">
<header class="main-box-header clearfix">
<h2> Generator </h2>
<p style="padding-bottom:1px;"> 
Here you can convert data (such as strings), to non-human-readable code.
<form action="" method="POST">
<div class="col-md-4">
<input type="text" name="data" class="form-control" placeholder="Data" style="margin-bottom:7px;">
<select name="alg" class="form-control" style="margin-bottom:7px;">
<?php
$algs = hash_algos();
foreach($algs as $alg) {
	?>
	<option value="<?=$alg?>"> <?=$alg?> </option>
	<?php
}	
?>
</select>
<input type="submit" name="hash" class="btn btn-success" value="Generate" style="outline:none;">
</div>
</form>
</p>
</header>
</div>
<?php if(isset($result) && !empty($result)) { ?>
<div class="main-box clearfix">
<header class="main-box-header clearfix">
<p style="padding-bottom:1px;"> 
<h2 class="text-success"> Generated Hash </h2>
</p>
<form action="" method="POST">
<div class="col-md-4">
<input type="text" value="<?=$result?>" class="form-control">
</div>
</form>
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