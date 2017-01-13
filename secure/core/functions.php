<?php
error_reporting(0);
	
function get_notifications($notify) {
	if(count($notify) >= 1) {
	foreach($notify as $notification) { ?>
	<li class="item">
	<a href="#">
	<i class="fa fa-exclamation"></i>
	<span class="content"> <?=$notification?></span>
	</a>
	</li>
	<?php
	}
	} else { ?>
	<li class="item"> 
	<a>
	<i class="fa fa-info-circle"></i>
	You have no pending notifications
	</a>
	</li>
	<?php
	}
}

function tail($filename, $lines = 10, $buffer = 4096)
{
    // Open the file
    $f = fopen($filename, "rb");

    // Jump to last character
    fseek($f, -1, SEEK_END);

    // Read it and adjust line number if necessary
    // (Otherwise the result would be wrong if file doesn't end with a blank line)
    if(fread($f, 1) != "\n") $lines -= 1;

    // Start reading
    $output = '';
    $chunk = '';

    // While we would like more
    while(ftell($f) > 0 && $lines >= 0)
    {
        // Figure out how far back we should jump
        $seek = min(ftell($f), $buffer);

        // Do the jump (backwards, relative to where we are)
        fseek($f, -$seek, SEEK_CUR);

        // Read a chunk and prepend it to our output
        $output = ($chunk = fread($f, $seek)).$output;

        // Jump back to where we started reading
        fseek($f, -mb_strlen($chunk, '8bit'), SEEK_CUR);

        // Decrease our line counter
        $lines -= substr_count($chunk, "\n");
    }

    // While we have too many lines
    // (Because of buffer size we might have read too many)
    while($lines++ < 0)
    {
        // Find first newline and remove all text before that
        $output = substr($output, strpos($output, "\n") + 1);
    }

    // Close file and return
    fclose($f); 
    return $output; 
}
function ago($ptime) {
    $etime = time() - $ptime;
    if ($etime < 1) {
        return '0 seconds';
    }
    $a = array(12 * 30 * 24 * 60 * 60 => 'year', 30 * 24 * 60 * 60 => 'month', 24 * 60 * 60 => 'day', 60 * 60 => 'hour', 60 => 'minute', 1 => 'second');
    foreach ($a as $secs => $str) {
        $d = $etime / $secs;
        if ($d >= 1) {
            $r = round($d);
            return $r . ' ' . $str . ($r > 1 ? 's' : '') . ' ago';
        }
    }
}

function ago_convert($time) {
	$time = ago($time);
	if($time == "0 seconds") {
		$time = "just now";
	}
	return $time;
}
function update_stats() {
$files = 0;
$folders = 0;
$images = 0;
$dir = scandir("../");
foreach($dir as $obj) {
if(is_dir($obj)) {
$folders++;
$scan = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($obj, FilesystemIterator::SKIP_DOTS), RecursiveIteratorIterator::CHILD_FIRST);
foreach($scan as $file) {
if(is_file($file)) {
$exp = explode(".", $file);
if(array_search("png", $exp) || array_search("jpg", $exp) || array_search("svg", $exp) || array_search("jpeg", $exp || array_search("gif", $exp))) {
$images++;
} else {
$files++;
}
} else {
$folders++;
}
}
} else {
if(array_search("png", $exp) || array_search("jpg", $exp) || array_search("svg", $exp) || array_search("jpeg", $exp || array_search("gif", $exp))) {
$images++;
} else {
$files++;
}
}
}
return array("files" => $files, "images" => $images, "folders" => $folders);
}

function website_scan($db) {
	$files = 0;
	$folders = 0;
	$malicious = 0;
	$cleaned = 0;
	$shells = 0;
	$viruses = array();
	$dir = scandir("../");
	foreach($dir as $obj) {
	if(is_dir($obj)) {
	// if folder
	$folders++;
	$scan = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($obj, FilesystemIterator::SKIP_DOTS), RecursiveIteratorIterator::CHILD_FIRST);

	foreach($scan as $file) {
	if(is_file($file)) {
	// if file
	$files++;

	// Check if shell
	$contents = file_get_contents($file);
	foreach($db as $shell => $part) {
	if(strpos($contents, $part) && basename($file) != "db.php") {
	$shells++;
	$cleaned++;
	unlink($file);
	}
	}

	// Check if junk
	$contents = fopen($file, "r");
	if(empty($file)) { unlink($file); $cleaned++;}

	if(extension_loaded('clamav')) {
	$virusname = "";
    $retcode = cl_scanfile($file, $virusname);
	if ($retcode == CL_VIRUS) {
		$malicious++;
		$cleaned++;
		if(isset($virusname) && !empty($virusname)) {
		$viruses[] = $virusname;
		}
		unlink($file);
	}
	}

	} else {
	// if folder
	$folders++;
	}
	}

	} else {
	// if file
	$files++;	
	}
	}
	return array("files" => $files, "folders" => $folders, "shells" => $shells, "malicious" => $malicious, "cleaned" => $cleaned);
}

function get_cpu_usage(){
    
	        if (stristr(PHP_OS, 'win')) {
        		
				if(class_exists("COM")) {
	            $wmi = new COM("Winmgmts://");
	            $server = $wmi->execquery("SELECT LoadPercentage FROM Win32_Processor");
            
	            $cpu_num = 0;
	            $load_total = 0;
            
	            foreach($server as $cpu){
	                $cpu_num++;
	                $load_total += $cpu->loadpercentage;
	            }
            
	            $load = round($load_total/$cpu_num);
            	
				}
				
	        } else {
        
	            $sys_load = sys_getloadavg();
	            $load = $sys_load[0];
        
	        }
        
	        return (int) $load;

}
function get_free_space() {
	return disk_free_space("/");
}
function get_total_space() {
	return disk_total_space("/");
}
function get_plugins($pdir) {
global $plugins;
$dir = scandir($pdir);
foreach($dir as $obj) {
	if(is_dir($pdir."/".$obj)) {
	$p_files = scandir($pdir."/".$obj);
	foreach($p_files as $file) {
	if(!is_dir($file)) {
			$ext = explode(".", $file);
			$ext = $ext[1];
			if($ext == "php") {
				if(substr($file, 0, 1) == "_") {
				$plugins[] = $obj."/".$file;
				}
			}
		}
			}
	}
}
foreach($plugins as $plugin) {
	require($pdir."/".$plugin);
}
}
function get_host() {

$arr = explode("/",$_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']));
$count = count($arr);
unset($arr[$count-1]);
return "http://".implode("/", $arr);

}

?>