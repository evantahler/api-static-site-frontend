<?php
/***********************************************
DAVE PHP FRONTEND
https://github.com/evantahler/PHP-DAVE-FRONTEND
Evan Tahler | 2011

I load in the enviorment.
***********************************************/

ini_set("display_errors","1");
error_reporting (E_ALL ^ E_NOTICE);

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

if (file_exists("CONFIG.php")) 
{
	require_once("CONFIG.php");
	date_default_timezone_set($CONFIG['SystemTimeZone']);
}
else 
{
	echo "Please create CONFIG.php from CONFIG.php.example\r\n"; 
	exit;
}

?>