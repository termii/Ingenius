<?php
session_start();
session_regenerate_id();
require("core/config.php");
require("core/functions.php");
require("core/api.php");
get_plugins("plugins");

$error = $page = $active = array();
$page['name'] = "Settings";
$active['dashboard'] = "";
$active['security'] = "";
$active['server'] = "";
$active['settings'] = "active";
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

if(isset($_POST['save'])) {

$username = $_POST['username'];
$password = $_POST['password'];
$email_notif= $_POST['email_notifications'];
$email = $_POST['email'];

if(empty($username)) { $error = "Username is empty"; }
elseif(empty($password)) { $error = "Password is empty"; }
else {

$new = "
<?php
\$user = \$server = array();

// User Settings
\$default['username'] = '".$username."';
\$default['password'] = '".$password."';
\$default['email'] = '".$email."';

\$system['version'] = '".$system['version']."';

\$ddos_guard = ".$ddos_guard.";
\$bot_guard = ".$bot_guard.";

\$notif['email'] = ".$email_notif.";
";

$new = trim($new);

file_put_contents("core/config.php", $new);

header("Location: settings.php");

exit;

}
}

require("inc/top.php");
?>
<!-- Content -->
<div class="main-box clearfix">
<header class="main-box-header clearfix">
<h2> Application Settings </h2>
<p style="padding-bottom:1px;"> 
Here you can edit the application's configuration.
</p>
<div class="clearfix"></div>
<div class="col-md-3">
<?php if(isset($error[0])) { ?> <div class="alert alert-danger"><?=$error[0]?></div> <?php } ?>
<form action="" method="POST">
<label style="font-size:14px;"> <b> Admin </b> </label>
<input type="text" name="username" class="form-control form-space" placeholder="Username" value="<?=$default['username']?>">
<input type="password" name="password" class="form-control" placeholder="Password" value="<?=$default['password']?>">
<br>
<input type="submit" name="save" class="btn btn-success" value="Save" style="outline:none;">
</div>
<div class="col-md-3">
<?php if(isset($error[0])) { ?> <div class="alert alert-danger"><?=$error[0]?></div> <?php } ?>
<label style="font-size:14px;"> <b> Email Notifications </b> </label>
<select name="email_notifications" class="form-control form-space">
<?php if($notif['email'] == true) { ?>
<option value="true"> On </option>
<option value="false"> Off </option>
<?php } else { ?>
<option value="false"> Off </option>	
<option value="true"> On </option>
<?php } ?>
</select>
<input type="text" name="email" class="form-control" placeholder="Email" value="<?=$default['email']?>">
</form>
</div>
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