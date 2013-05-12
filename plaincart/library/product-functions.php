<?php
require_once 'config.php';

/*********************************************************
*                 PRODUCT FUNCTIONS 
**********************************************************/


/*
	Get detail information of a product
*/
function getProductDetail($pdId, $catId)
{
	
	$_SESSION['shoppingReturnUrl'] = $_SERVER['REQUEST_URI'];
	
	// get the product information from database
	$sql = "SELECT pd_name, pd_description, pd_price, pd_image, pd_qty
			FROM tbl_product
			WHERE pd_id = $pdId";
	
	$result = dbQuery($sql);
	$row    = dbFetchAssoc($result);
	extract($row);
	
	$row['pd_description'] = nl2br($row['pd_description']);
	
	if ($row['pd_image']) {
		$row['pd_image'] = WEB_ROOT . 'images/product/' . $row['pd_image'];
	} else {
		$row['pd_image'] = WEB_ROOT . 'images/no-image-large.png';
	}
	
	$row['cart_url'] = "cart.php?action=add&p=$pdId";
	
	return $row;			
}



?>