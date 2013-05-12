<?php
require_once '../library/config.php';
require_once '../library/functions.php';

$_SESSION['login_return_url'] = $_SERVER['REQUEST_URI'];
checkUser();

$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';

switch ($view) {
	case 'list' :
		$content 	= 'list.php';		
		$pageTitle 	= 'Shop Admin Control Panel - Προβολή Παραγγελιών';
		break;

	case 'detail' :
		$content 	= 'detail.php';		
		$pageTitle 	= 'Shop Admin Control Panel - Πληροφορίες Παραγγελιών';
		break;

	case 'modify' :
		modifyStatus();
		//$content 	= 'modify.php';		
		//$pageTitle 	= 'Shop Admin Control Panel - Modify Orders';
		break;

	default :
		$content 	= 'list.php';		
		$pageTitle 	= 'Shop Admin Control Panel - Προβολή Παραγγελιών';
}




$script    = array('order.js');

require_once '../include/template.php';
?>
