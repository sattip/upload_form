<?php
require_once '../../library/config.php';
require_once '../library/functions.php';

$_SESSION['login_return_url'] = $_SERVER['REQUEST_URI'];
checkUser();

$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';

switch ($view) {
	case 'list' :
		$content 	= 'list.php';		
		$pageTitle 	= 'Shop Admin Control Panel - View Orders';
		break;

	case 'detail' :
		$content 	= 'detail.php';		
		$pageTitle 	= 'Shop Admin Control Panel - Order Detail';
		break;

	case 'modify' :
		modifyStatus();
		//$content 	= 'modify.php';		
		//$pageTitle 	= 'Shop Admin Control Panel - Modify Orders';
		break;

	default :
		$content 	= 'list.php';		
		$pageTitle 	= 'Shop Admin Control Panel - View Orders';
}




$script    = array('order.js');

require_once '../include/template.php';
?>
