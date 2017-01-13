<?php
if(!isset($server)) { die(); }

// Communication with API Server

function fetch_version () {

/*
if(function_exists("curl_init")) {
$ch = curl_init("http://condor5.com/api.php?q=version&filter=webkeeper");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
$content = curl_exec($ch);
curl_close($ch);
$api = json_decode(trim($content));
return $version = $api->version;
} else {
	return "1.0";
}
*/
return "1.0";
}

$version = $notify = array();
$version['newest'] = fetch_version();
$version['current'] = $system['version'];

if($version['current'] < $version['newest']) {
	$notify[] = "A newer version of <b>Web Keeper</b> is available <b>({$version['newest']})</b>";
}

/** Plugin system **/

$listeners = array();

/* Create an entry point for plugins */
function hook(){
  global $listeners;

  $num_args = func_num_args();
  $args = func_get_args();

  if($num_args < 2)
    trigger_error("Insufficient arguments", E_USER_ERROR);

  // Hook name should always be first argument
  $hook_name = array_shift($args);

  if(!isset($listeners[$hook_name]))
    return; // No plugins have registered this hook

  foreach($listeners[$hook_name] as $func){
    $args = $func($args); 
  }

  return $args;
}

/* Attach a function to a hook */
function add_listener($hook, $function_name){
  global $listeners;

  $listeners[$hook][] = $function_name;
}