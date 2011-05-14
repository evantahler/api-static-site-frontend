<?php
/***********************************************
DAVE PHP FRONTEND
https://github.com/evantahler/PHP-DAVE-FRONTEND
Evan Tahler | 2011

I load in the enviorment.
***********************************************/

ini_set("display_errors","1");
error_reporting (E_ALL ^ E_NOTICE);

$parts = explode("/",__FILE__);
$ThisFile = $parts[count($parts) - 1];
chdir(substr(__FILE__,0,(strlen(__FILE__) - strlen($ThisFile))));

// Ensure we have the user's IP address for logging, etc.
if (getenv(HTTP_X_FORWARDED_FOR)) 
{							
  	$IPList = getenv(HTTP_X_FORWARDED_FOR); 
  	$IPArray = explode(",", $IPList);
  	$IP = trim($IPArray[count($IPArray)-1]);
} else { 
   	$IP = getenv(REMOTE_ADDR);
}
if ($IP == ""){
	$IP = $_SERVER["REMOTE_ADDR"];
}

if (file_exists($CONFIG['App_dir'] . "_CONFIG.php")) 
{
	require_once($CONFIG['App_dir'] . "_CONFIG.php");
	date_default_timezone_set($CONFIG['SystemTimeZone']);
	require_once($CONFIG['App_dir'] . "_PageClass.php");
}
else 
{
	echo "Please create CONFIG.php from CONFIG.php.example\r\n"; 
	exit;
}

?>