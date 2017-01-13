<?php
session_start();
session_regenerate_id();
require("core/config.php");
require("core/functions.php");
require("core/api.php");
get_plugins("plugins");
define("SPECIAL_PLUGIN", true);
define("P_DIR", "plugins");

$error = $page = $active = array();
$page['name'] = "";

if(!isset($_GET['id'])) { header("Location: index.php"); exit; }

$id = $_GET['id'];
$plugin = $id.".php";

if(!file_exists(P_DIR."/".$id."/".$plugin)) { header("Location: index.php"); exit; }

// Retrieve Plugin Configuration
if(file_exists(P_DIR."/".$id."/"."info.json")) {
$info = json_decode(file_get_contents(P_DIR."/".$id."/"."info.json"), true);
$page['name'] = $info['plugin_name'];
} else {
$break = true;	
}

require("inc/top.php");
if(!$break) {
require(P_DIR."/".$id."/".$plugin);
} else {
$page['name'] = "Error";
echo "Could not retrieve plugin information";
}
?>