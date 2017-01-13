<?php if(isset($_SESSION['theme'])) { $theme = $_SESSION['theme']; } else { $theme = "theme-red"; } ?>
<?=hook("page_control", time())?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Termii Secure - <?=$page['name']?></title>
		<meta name="description" content="Termii is a pan-African web-technology company focused at helping businesses increase their earning power by leveraging on modern Web Technologies, Tools and Branding best Practices that increases and converts leads into paying customers">
		<meta name="author" content="Termii">
		<link rel="Shortcut Icon" type="image/ico" href="img/favicon.ico">
<link href="css/bootstrap/bootstrap.min.css" rel="stylesheet"/>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/libs/nanoscroller.css" type="text/css"/>
<link rel="stylesheet" type="text/css" href="css/compiled/layout.css">
<link rel="stylesheet" type="text/css" href="css/compiled/elements.css">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300%7CTitillium+Web:200,300,400' rel='stylesheet' type='text/css'>
<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->
<style>
.form-space {
margin-bottom:3px;
}
</style>
</head>
<body class="<?=$theme?>">
<header class="navbar" id="header-navbar">
<div class="container">
<a href="index.php" style="padding-top:8px;" class="navbar-brand">
<img src="img/logo.png" style="width: 80px">
</a>
<div class="clearfix">
<button class="navbar-toggle" data-target=".navbar-ex1-collapse" data-toggle="collapse" type="button">
<span class="sr-only">Toggle navigation</span>
<span class="fa fa-bars"></span>
</button>
<div class="nav-no-collapse navbar-left pull-left hidden-sm hidden-xs">
<ul class="nav navbar-nav pull-left">
<li>
<a class="btn" id="make-small-nav">
<i class="fa fa-bars"></i>
</a>
</li>
</ul>
</div>
<div class="nav-no-collapse pull-right" id="header-nav">
<ul class="nav navbar-nav pull-right">
<li class="dropdown hidden-xs">
<a class="btn dropdown-toggle" data-toggle="dropdown">
<i class="fa fa-globe"></i>
<span class="count"><?=count($notify)?></span>
</a>
<ul class="dropdown-menu notifications-list">
<li class="pointer">
<div class="pointer-inner">
<div class="arrow"></div>
</div>
</li>
<li class="item-header">Notifications</li>
<?php 
get_notifications($notify);
?>
<!--<li class="item-footer">
<a href="#">
Update
</a>
</li>
-->
</ul>
</li>
<li class="dropdown profile-dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown">
<img src="img/avatar.png" alt=""/>
<span class="hidden-xs"><?=$_SESSION['username']?></span> <b class="caret"></b>
</a>
<ul class="dropdown-menu">
<li><a href="settings.php"><i class="fa fa-cog"></i>Settings</a></li>
<li><a href="?logout"><i class="fa fa-power-off"></i>Logout</a></li>
</ul>
</li>
<li class="hidden-xxs">
<a href="?logout" class="btn">
<i class="fa fa-power-off"></i>
</a>
</li>
</ul>
</div>
</div>
</div>
</header>
<div id="page-wrapper" class="container">
<div class="row">
<div id="nav-col">
<section id="col-left" class="col-left-nano">
<div id="col-left-inner" class="col-left-nano-content" style="background: #fff;">
<div id="user-left-box" class="clearfix hidden-sm hidden-xs">
<img alt="" src="img/avatar.png"/>
<div class="user-box">
<span class="name">
Welcome<br/>
<?=$_SESSION['username']?>
</span>
<span class="status">
<i class="fa fa-circle"></i> Online
</span>
</div>
</div>
<div class="collapse navbar-collapse navbar-ex1-collapse" id="sidebar-nav">
<ul class="nav nav-pills nav-stacked">
<li class="<?=$active['dashboard']?>">
<a href="index.php">
<i class="fa fa-dashboard"></i>
<span>Dashboard</span>
</a>
</li>
<li class="<?=$active['security']?>">
<a href="#" class="dropdown-toggle">
<i class="fa fa-lock"></i> 
<span>Security</span>
<i class="fa fa-chevron-circle-right drop-icon"></i>
</a>
<ul class="submenu">
<li> <a href="overview.php"> Overview </a> </li>
<li> <a href="scan.php"> Website Scan </a> </li>
<li> <a href="password.php"> Password Generator  </a> </li>
<li> <a href="hasher.php"> Hash Generator  </a> </li>
<li> <a href="ddos-guard.php"> DDoS Guard </a> </li>
<li> <a href="bot-guard.php"> Bot Guard </a> </li>
<?=hook("security_dropdown", time())?>
</ul>
</li>
<li class="<?=$active['server']?>">
<a href="#" class="dropdown-toggle">
<i class="fa fa-database"></i>
<span>Server</span>
<i class="fa fa-chevron-circle-right drop-icon"></i>
</a>
<ul class="submenu">
<li> <a href="server.php"> Statistics </a> </li>
<li> <a href="backup.php"> Website Backup </a> </li>
<?=hook("server_dropdown", time())?>
<li> <a href="htaccess.php"> .Htaccess </a> </li>
</ul>
</li>
<li class="<?=$active['system']?>">
<a href="#" class="dropdown-toggle">
<i class="fa fa-plug"></i>
<span>System</span>
<i class="fa fa-chevron-circle-right drop-icon"></i>
</a>
<ul class="submenu">
<li> <a href="diagnostics.php"> Diagnostics </a> </li>
</ul>
</li>
<li class="<?=$active['settings']?>">
<a href="settings.php">
<i class="fa fa-cog"></i> 
<span>Settings</span>
</a>
</li>
<li class="<?=$active['themes']?>">
<a href="themes.php">
<i class="fa fa-tint"></i> 
<span>Themes</span>
</a>
</li>

</ul>
</div>
</div>
</section>
</div>
<div id="content-wrapper">
<div class="row">
<div class="col-lg-12">
<div class="row">
<div class="col-lg-12">
<ol class="breadcrumb">
<li><a href="#">Home</a></li>
<li class="active"><span><?=$page['name']?></span></li>
</ol>
<h1><?=$page['name']?></h1>
</div>
</div>