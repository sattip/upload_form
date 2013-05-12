<?php
require_once '../library/config.php';
require_once '../library/functions.php';

$_SESSION['login_return_url'] = $_SERVER['REQUEST_URI'];
checkUser();

$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';

switch ($view) {
	case 'list' :
		$content 	= 'list.php';		
		$pageTitle 	= 'Shop Admin Control Panel - Προβολή Προϊόντος';
		break;

	case 'add' :
		$content 	= 'add.php';		
		$pageTitle 	= 'Shop Admin Control Panel - Προσθήκη Προϊόντος';
		break;

	case 'modify' :
		$content 	= 'modify.php';		
		$pageTitle 	= 'Shop Admin Control Panel - Τροποποίήση Προϊόντος';
		break;

	case 'detail' :
		$content    = 'detail.php';
		$pageTitle  = 'Shop Admin Control Panel - Προβολή Πληροφοριών Προϊόντος';
		break;
		
	default :
		$content 	= 'list.php';		
		$pageTitle 	= 'Shop Admin Control Panel - Προβολή Προϊόντος';
}




$script    = array('product.js');

require_once '../include/template.php';
?>
