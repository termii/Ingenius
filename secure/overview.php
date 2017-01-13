<?php
session_start();
session_regenerate_id();
require("core/config.php");
require("core/functions.php");
require("core/api.php");
get_plugins("plugins");

$error = $page = $active = array();
$page['name'] = "Overview";
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

// Daily counters
$bot = 0;
$ddos = 0;
$day = date("w");

// Bot counter
$cbot = glob("logs/count/bot/".$day."-*.log");
foreach($cbot as $file) {
	$count = file_get_contents($file);
	$bot = $bot + trim($count);
}

// DDoS counter
$cddos = glob("logs/count/ddos/".$day."-*.log");
foreach($cddos as $file) {
	$count = file_get_contents($file);
	$ddos = $ddos + trim($count);
}

require("inc/top.php");
?>
<!-- Content -->
<div class="main-box clearfix">
<header class="main-box-header clearfix">
<h2> Daily Overview </h2>
<p style="padding-bottom:1px;"> 
This is a overview of all blocked threats for today
</p>
</header>
</div>
<!-- Chart -->
<div class="row">
<div class="col-md-9 col-lg-10">
<div class="main-box">
<div class="row">
<div class="col-md-9">
<div class="graph-box emerald-bg">
<div class="graph" id="graph-line" style="max-height: 335px;"></div>
</div>
</div>
<div class="col-md-3">
<div class="row graph-nice-legend">
<div class="graph-legend-row col-md-12 col-sm-4">
<div class="graph-legend-row-inner">
<span class="graph-legend-name">
DDoS Attacks
</span>
<span class="graph-legend-value">
<?=$ddos?>
</span>
</div>
</div>
<div class="graph-legend-row col-md-12 col-sm-4">
<div class="graph-legend-row-inner">
<span class="graph-legend-name">
Malicious Bots
</span>
<span class="graph-legend-value">
<?=$bot?>
</span>
</div>
</div>
<div class="graph-legend-row col-md-12 col-sm-4">
<div class="graph-legend-row-inner">
<span class="graph-legend-name">
Total
</span>
<span class="graph-legend-value">
<?=$ddos+$bots?>
</span>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<!-- /Chart -->
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

<link rel="stylesheet" href="css/libs/morris.css" type="text/css"/>

<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/jquery.nanoscroller.min.js"></script>
 
<script src="js/jquery-ui.custom.min.js"></script>
<script src="js/jquery.slimscroll.min.js"></script>
<script src="js/raphael-min.js"></script>
<script src="js/morris.min.js"></script>
<script src="js/moment.min.js"></script>
<script src="js/jquery-jvectormap-1.2.2.min.js"></script>
<script src="js/jquery-jvectormap-world-merc-en.js"></script>
 
<script src="js/scripts.js"></script>

<script>
	$(document).ready(function() {
	    //CHARTS
		graphLine = Morris.Line({
			element: 'graph-line',
			data: [
			<?php
			for($i = 0; $i <= 23; $i++) {
				$period = date("w");
				$period = $period."-".$i.".log";
				$cddos_dir = "logs/count/ddos";
				$cbot_dir = "logs/count/bot";
				$ddos = $bot = false;
				if(file_exists($cddos_dir."/".$period)) {
					$ddos = true;
				} elseif(file_exists($cbot_dir."/".$period)) {
					$bot = true;
				}
				$total = 0;
				if($ddos) {
				$count = trim(file_get_contents($cddos_dir."/".$period));
				$total = $total+$count;
				echo "
				{period: '$i:00', threats: $total},
				";
				} elseif($bot) {
				$count = trim(file_get_contents($cbot_dir."/".$period));
				$total = $total+$count;
				echo "
				{period: '$i:00', threats: $total},
				";
				} else {
				echo "
				{period: '$i:00', threats: 0},
				";		
				}
			}
				?>
			],
			lineColors: ['#ffffff'],
			xkey: 'period',
			ykeys: ['threats'],
			labels: ['Threats'],
			pointSize: 3,
			hideHover: 'auto',
			parseTime: false,
			gridTextColor: '#ffffff',
			gridLineColor: '#ffffff',
			resize: true
		});
	});
	</script>
</body>
</html>
<!-- Localized -->