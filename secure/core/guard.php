<?php
session_start();

function url_get_contents($url){
   if(function_exists('curl_init') && function_exists('curl_setopt') && function_exists('curl_exec') && function_exists('curl_exec')){
     # Use cURL
     $curl = curl_init($url);

     curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
     curl_setopt($curl, CURLOPT_HEADER, 0);
     curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);
     curl_setopt($curl, CURLOPT_TIMEOUT, 5);
     if(stripos($url,'https:') !== false){
         curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
         curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
     }
     $content = @curl_exec($curl);
     curl_close($curl);
   }else{
     # Use FGC, because cURL is not supported
     ini_set('default_socket_timeout',5);
     $content = @file_get_contents($url);
   }
   return $content;
}

function in_array_r($needle, $haystack, $strict = false) {
    foreach ($haystack as $item) {
        if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
            return true;
        }
    }

    return false;
}

// Country Block Plugin
$blocked_countries = file_get_contents('web-keeper/core/plugin-data/blocked-countries.php');
if(!empty($blocked_countries)) {
$blocked_countries = unserialize($blocked_countries);
$user_ip = $_SERVER['REMOTE_ADDR'];
$user_info = url_get_contents('http://freegeoip.net/json/'.$user_ip);
$user_info = json_decode($user_info,true);
$user_country = $user_info['country_code'];

if(in_array_r($user_country,$blocked_countries)) {

	$htaccess = fopen(".htaccess", "a");
	$log = fopen("web-keeper/logs/bot.log", "a");

	$str = "Deny from ".$user_ip." \r\n";
	$check2 = file_get_contents("web-keeper/logs/bot.log");

	// Write
	fwrite($htaccess, $str);
	if(!empty($check2)) { fwrite($log, "<br>".$str2); } else { fwrite($log, $str2); }

}
}

function guard($ddos_guard, $bot_guard, $email, $notif) {

function dnsbllookup($ip){
$dnsbl_lookup=array("dnsbl-1.uceprotect.net","dnsbl-2.uceprotect.net","dnsbl-3.uceprotect.net","dnsbl.dronebl.org","dnsbl.sorbs.net","zen.spamhaus.org"); 
if($ip){
$reverse_ip=implode(".",array_reverse(explode(".",$ip)));
foreach($dnsbl_lookup as $host){
if(checkdnsrr($reverse_ip.".".$host.".","A")){
return true;
} else {
return false;
}
}
}
}

if(isset($ddos_guard) && $ddos_guard == 'true') {
	
$_SESSION['requests'] = $_SESSION['requests']+1; // increase each time a new request is made

if(isset($_SESSION['last_request']) && time()-$_SESSION['last_request'] >= 20) { $_SESSION['requests'] = 0; $_SESSION['last_request'] = time(); } 

if($_SESSION['requests'] >= 15 && $_SESSION['last_request'] < time()+10) {
	
	// oh, a ddos atempt?
	$_SESSION['requests'] = 0;
	$ip = $_SERVER['REMOTE_ADDR'];
	$htaccess = fopen(".htaccess", "a");
	$log = fopen("web-keeper/logs/ddos.log", "a");
	
	/* Counter */
	if(!file_exists("web-keeper/logs/count/ddos/".date("w-H").".log")) {
		fopen("web-keeper/logs/count/ddos/".date("w-H").".log", "w"); // Create counter if it does not exist
	}
	$count = trim(file_get_contents("web-keeper/logs/count/ddos/".date("w-H").".log")); // Get daily counter
	$count++;
	file_put_contents("web-keeper/logs/count/ddos/".date("w-H").".log", $count); // Update daily counter
	/* Counter */
	
	$str = "Deny from ".$ip." \r\n";
	$str2 = "DDoS attack from ".$ip." was blocked on ".date("F j, G:i", time());
	$check2 = file_get_contents("web-keeper/logs/ddos.log");
	
	// Write
	fwrite($htaccess, $str);
	if($notif['email'] == true) { mail($email, "[Web Keeper] DDoS attack was blocked", $str2); }
	if(!empty($check2)) { fwrite($log, "<br>".$str2); } else { fwrite($log, $str2); }
	
}
}


if(isset($bot_guard) && $bot_guard == 'true') {
	
	$ip = $_SERVER['REMOTE_ADDR'];
	
	if(dnsbllookup($ip)) {
		
		$htaccess = fopen(".htaccess", "a");
		$log = fopen("web-keeper/logs/bot.log", "a");
		
		/* Counter */
		if(!file_exists("web-keeper/logs/count/bot/".date("w-H").".log")) {
			fopen("web-keeper/logs/count/bot/".date("w-H").".log", "w"); // Create counter if it does not exist
		}
		$count = trim(file_get_contents("logs/count/bot/".date("w-H").".log")); // Get daily counter
		$count++;
		file_put_contents("web-keeper/logs/count/bot/".date("w-H").".log", $count); // Update daily counter
		/* Counter */
	
		$str = "Deny from ".$ip." \r\n";
		$str2 = $ip." was blocked on ".date("F j, G:i", time());
		$check2 = file_get_contents("web-keeper/logs/bot.log");
		
		// Write
		fwrite($htaccess, $str);
		if($notif['email'] == true) { mail($email, "[Web Keeper] Malicious bot visited your website", $str2); }
		if(!empty($check2)) { fwrite($log, "<br>".$str2); } else { fwrite($log, $str2); }
		
} 	
}

// Sanitization
foreach($_POST as $name => $value) {
	if($html == false) {
	$_POST[$name] = strip_tags($value);
	} else {
	$_POST[$name] = htmlentities($value);
	}
}
}
?>