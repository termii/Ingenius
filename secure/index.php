<?php
session_start();
if(!isset($_SESSION['admin_auth'])) {
	header("Location: login.php");
	exit;
} else {
	header("Location: dashboard.php");
	exit;
}
?>