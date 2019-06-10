<?php

/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

 define("MYROOTPATH", $_SERVER['DOCUMENT_ROOT']."/bus_dev/");
 
define("MYCLASSPATH", MYROOTPATH."config/");

if (!empty($_SERVER['HTTPS'])) 
{
  $Murl="https://".$_SERVER['HTTP_HOST']."/bus_dev/";
}
else
{
$Murl="http://".$_SERVER['HTTP_HOST']."/bus_dev/";
}
 define('FRONTURL',$Murl);

if (!defined("PJ_HOST")) define("PJ_HOST", "localhost");
if (!defined("PJ_USER")) define("PJ_USER", "root");
if (!defined("PJ_PASS")) define("PJ_PASS", "atinder13@");
if (!defined("PJ_DB")) define("PJ_DB", "bus_dev");
if (!defined("PJ_PREFIX")) define("PJ_PREFIX", "");
if (!defined("PJ_INSTALL_FOLDER")) define("PJ_INSTALL_FOLDER", "/bus_dev/admin/");
if (!defined("PJ_INSTALL_PATH")) define("PJ_INSTALL_PATH", "/var/www/html/bus_dev/admin/");
if (!defined("PJ_INSTALL_URL")) define("PJ_INSTALL_URL", "http://52.38.56.164/bus_dev/admin/");
if (!defined("PJ_SALT")) define("PJ_SALT", "2U1EPNPU");
if (!defined("PJ_INSTALLATION")) define("PJ_INSTALLATION", "MjM5MzYxNTkyODc0ODU5MDk2ODc1ODkxNzE4MzU1NTg3NjIyOTQ2MzgxNjAyMTY4Mzc3MjIxMTMyNDM5NTgwOTI5MzQ3MjUwMTk3MzY0MTY3MjUwNDA5ODA5NjkwMTQyNDMzIDI5Mzk1NjIzNDg2NTk3NDk3ODkzNTE2NjI5OTMwNjc5NjQxMjMyNDIzMzA2NDk0NDY1NTg5NTgzNjg2NzQ5MDc0NTY5MjExNTQ3NzY5NDMxMDc0NzQ1MDczMzE1NzYxNTc0MSAzMTMyODc2MzY4OTk0NjIxMjk3Mzc1NTIzMzExMjQ0NjkzMjU3MzAyNDE3NzU1MTI3MDA1NDg0OTAwMzI1NDc2Mzk3MTMyMzgyMDA4NDI3Nzk0MDM0NjAzNzUxOTQ0NzExNzMgMTIzNzAyOTc1NzQ1MTE5NzIxNzY4NDA1NzQyNDczMzc5NzY5MTEwNzcxMDk3NTA0NTA2MDQ3Mjc1OTY0NDExMzcwOTYzMzU1NzQ1ODc4ODc1NDYzMTE4NDAwMzk5NjUxMjgyNw==");
//don't rearranged 
$DBAmenities=array(
	1 => 'WIFI',
	2 => 'SLEEPER',
	3 => 'AC',
	4 => 'Bedrooms',
	5 => 'Bathrooms',
);

$DEFAULTSEATMAP=array(
	'default.jpg',
	'default1.jpg',
	'1_8b62fd1ff776f7062cef28753e22c6d1.jpg'
	
);
?>