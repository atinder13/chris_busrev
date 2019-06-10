<?php
/* 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); */

 define("ROOTPATH", $_SERVER['DOCUMENT_ROOT']."/bus_dev/");

if (!empty($_SERVER['HTTPS'])) 
{
  $Murl="https://".$_SERVER['HTTP_HOST']."/bus_dev/";
}
else
{
$Murl="http://".$_SERVER['HTTP_HOST']."/bus_dev/";
}

 define('ROOTURL',$Murl);

define("CLASSPATH", ROOTPATH."config/");


define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_DATABASE", "bus");
if (!defined("PJ_SALT")) define("PJ_SALT", "2U1EPNPU");
date_default_timezone_set("Africa/Lagos");

$DBAmenities=array(
	1 => 'WIFI',
	2 => 'SLEEPER',
	3 => 'AC',
	4 => 'Bedrooms',
	5 => 'Bathrooms',
	6 => 'Audio',
);

?>