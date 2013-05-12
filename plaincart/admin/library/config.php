<?php
ini_set('display_errors', 'On');
//ob_start("ob_gzhandler");
error_reporting(E_ALL);

// start the session
session_start();

// database connection config
$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = '';
$dbName = 'plaincart';

$link   = mysql_pconnect($dbHost, $dbUser, $dbPass);
		$select = mysql_select_db($dbName, $link);
		mysql_query('set character set greek',$link);       
         mysql_query("SET NAMES 'greek'",$link);

// setting up the web root and server root for
// this shopping cart application
$thisFile = str_replace('\\', '/', __FILE__);
$docRoot = $_SERVER['DOCUMENT_ROOT'];

$webRoot  = str_replace(array($docRoot, 'library/config.php'), '', $thisFile);
$srvRoot  = str_replace('library/config.php', '', $thisFile);

define('WEB_ROOT', $webRoot);
define('SRV_ROOT', $srvRoot);

// these are the directories where we will store all
// category and product images
define('CATEGORY_IMAGE_DIR', 'images/category/');
define('PRODUCT_IMAGE_DIR',  'images/product/');

// some size limitation for the category
// and product images

// all category image width must not 
// exceed 75 pixels
define('MAX_CATEGORY_IMAGE_WIDTH', 75);

// do we need to limit the product image width?
// setting this value to 'true' is recommended
define('LIMIT_PRODUCT_WIDTH',     true);

// maximum width for all product image
define('MAX_PRODUCT_IMAGE_WIDTH', 300);

// the width for product thumbnail
define('THUMBNAIL_WIDTH',         75);

if (!get_magic_quotes_gpc()) {
	if (isset($_POST)) {
		foreach ($_POST as $key => $value) {
			$_POST[$key] =  trim(addslashes($value));
		}
	}
	
	if (isset($_GET)) {
		foreach ($_GET as $key => $value) {
			$_GET[$key] = trim(addslashes($value));
		}
	}	
}

// since all page will require a database access
// and the common library is also used by all
// it's logical to load these library here
require_once 'database.php';
require_once 'common.php';

// get the shop configuration ( name, addres, etc ), all page need it
$shopConfig = getShopConfig();
?>