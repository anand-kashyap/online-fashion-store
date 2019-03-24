<?php
//enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

ob_start(); /*turn on output buffering to prevent output headers already sent error while redirecting*/
session_start();
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR); //checking for constant and defining if not found 
// echo DS; //used to get platform specific separator
// echo __DIR__; //get dir path of current file excluding filename
defined('TEMPLATE_FRONT') ? null : define('TEMPLATE_FRONT', __DIR__. DS . "templates/front"); 
defined('TEMPLATE_BACK') ? null : define('TEMPLATE_BACK',  __DIR__. DS . "templates/back"); 


/*DB Info - production*/
/*defined('DB_HOST') ? null : define('DB_HOST', "localhost"); 
defined('DB_USER') ? null : define('DB_USER', "root"); 
defined('DB_PASS') ? null : define('DB_PASS', ""); 
defined('DB_NAME') ? null : define('DB_NAME', "online-fashion-store");*/ 

/*DB Info - development*/
defined('DB_HOST') ? null : define('DB_HOST', "localhost"); 
defined('DB_USER') ? null : define('DB_USER', "root"); 
defined('DB_PASS') ? null : define('DB_PASS', ""); 
defined('DB_NAME') ? null : define('DB_NAME', "online-fashion-store"); 

$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);

require_once 'functions.php';

?>