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
defined('HOME') ? null : define('HOME',  "index.php"); 


/*DB Info - production*/
// defined('DB_HOST') ? null : define('DB_HOST', "localhost"); 

// defined('DB_USER') ? null : define('DB_USER', "id9043215_root"); 

// defined('DB_PASS') ? null : define('DB_PASS', "rooted"); 

// defined('DB_NAME') ? null : define('DB_NAME', "id9043215_online_fashion_store"); 
// defined('DOMAIN_URL') ? null : define('DOMAIN_URL', "http://localhost:8888/online-fashion-store");

/*DB Info - mac office development*/
defined('DB_HOST') ? null : define('DB_HOST', "localhost"); 
defined('DB_USER') ? null : define('DB_USER', "root"); 
defined('DB_PASS') ? null : define('DB_PASS', "root"); 
defined('DB_NAME') ? null : define('DB_NAME', "online-fashion-store");
defined('DOMAIN_URL') ? null : define('DOMAIN_URL', "http://localhost:8888/online-fashion-store");

/*DB Info - home development*/
/* defined('DB_HOST') ? null : define('DB_HOST', "localhost"); 
defined('DB_USER') ? null : define('DB_USER', "root"); 
defined('DB_PASS') ? null : define('DB_PASS', ""); 
defined('DB_NAME') ? null : define('DB_NAME', "online-fashion-store");  */

/* PAYPAL sandbox creds
client id: AQwkB3vnaiCsJNby0JtkUy6Jx71JzOzkOEM11MOAgPkJqJMoPD7GtN5IpFzoqdKlOU7f2ZwJEydU-FkF
client secret: EF2xfo02pGzrSBBIIvtwjiz8wtgu1TPAKC1scOgD46bSEICDpjZHanvQDU34WsBJ4OqrFpsqCMNPnSEA
*/
$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);

require_once 'functions.php';

?>