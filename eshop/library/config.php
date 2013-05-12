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
$dbName = 'eshop';

// setting up the web root and server root for
// this shopping cart application

$etomiteBaseURL="http://www.domain.com";//point to the web root of your etomite index.php file//currently not used

$thisFile = str_replace('\\', '/', __FILE__);
$docRoot = $_SERVER['DOCUMENT_ROOT'];

$webRoot  = str_replace(array($docRoot, 'library/config.php'), '', $thisFile);
$srvRoot  = str_replace('library/config.php', '', $thisFile);



define('ETOMITE_BASE_URL',$etomiteBaseURL);//currently not used
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


//load the various paypal variables for external files to accesss
define('PAYPAL_BUSINESSNAME', 'seller_1189938445_biz@bigpond.com');
define('PAYPAL_SITE_URL', 'http://www.artimental.com');
define('PAYPAL_IMAGE_URL',"");
define('PAYPAL_SUCCESS_URL', "/plainCart.html?nav=success");
define('PAYPAL_CANCEL_URL', "/plainCart.html?nav=error");
define('PAYPAL_NOTIFY_URL',"/plainCart.html?action=ipn");
define('PAYPAL_RETURN_METHOD',"2");//1=GET 2=POST --> Use post since we will need the return values to check if order is valid
define('PAYPAL_CURRENCY_CODE',"USD");//['USD,GBP,JPY,CAD,EUR']               
define('PAYPAL_LC',"US"); 

//define('PAYPAL_URL',"https://www.paypal.com/cgi-bin/webscr");//uncomment to activate 
//SET to this URL when you have tested with the sandbox and
//are ready to process orders 
//In the mean time, here is the sandbox url
define('PAYPAL_URL',"https://www.sandbox.paypal.com/cgi-bin/webscr");//comment out to deactivate
//other paypal variables can be changed in the plaincart/include/paypal/paypal.inc.php file.


// since all page will require a database access
// and the common library is also used by all
// it's logical to load these library here
require_once 'database.php';
require_once 'common.php';

// get the shop configuration ( name, addres, etc ), all page need it
$shopConfig = getShopConfig();
?>