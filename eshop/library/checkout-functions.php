<?php
require_once 'config.php';

/*********************************************************
*                 CHECKOUT FUNCTIONS 
*********************************************************/
function saveOrder()
{
	$orderId       = 0;
	$shippingCost  = 5;
	$requiredField = array('hidShippingFirstName', 'hidShippingLastName', 'hidShippingAddress1', 'hidShippingCity', 'hidShippingPostalCode',
						   'hidPaymentFirstName', 'hidPaymentLastName', 'hidPaymentAddress1', 'hidPaymentCity', 'hidPaymentPostalCode');
						   
	if (checkRequiredPost($requiredField)) {
	    extract($_POST);
		
		// make sure the first character in the 
		// customer and city name are properly upper cased
		$hidShippingFirstName = ucwords($hidShippingFirstName);
		$hidShippingLastName  = ucwords($hidShippingLastName);
		$hidPaymentFirstName  = ucwords($hidPaymentFirstName);
		$hidPaymentLastName   = ucwords($hidPaymentLastName);
		$hidShippingCity      = ucwords($hidShippingCity);
		$hidPaymentCity       = ucwords($hidPaymentCity);
				
		$cartContent = getCartContent();
		$numItem     = count($cartContent);
		
		// save order & get order id
		$sql = "INSERT INTO tbl_order(od_date, od_last_update, od_shipping_first_name, od_shipping_last_name, od_shipping_address1, 
		                              od_shipping_address2, od_shipping_phone, od_shipping_state, od_shipping_city, od_shipping_postal_code, od_shipping_cost,
                                      od_payment_first_name, od_payment_last_name, od_payment_address1, od_payment_address2, 
									  od_payment_phone, od_payment_state, od_payment_city, od_payment_postal_code)
                VALUES (NOW(), NOW(), '$hidShippingFirstName', '$hidShippingLastName', '$hidShippingAddress1', 
				        '$hidShippingAddress2', '$hidShippingPhone', '$hidShippingState', '$hidShippingCity', '$hidShippingPostalCode', '$shippingCost',
						'$hidPaymentFirstName', '$hidPaymentLastName', '$hidPaymentAddress1', 
						'$hidPaymentAddress2', '$hidPaymentPhone', '$hidPaymentState', '$hidPaymentCity', '$hidPaymentPostalCode')";
		$result = dbQuery($sql);
		
		// get the order id
		$orderId = dbInsertId();
		
		if ($orderId) {
			// save order items
			for ($i = 0; $i < $numItem; $i++) {
				$sql = "INSERT INTO tbl_order_item(od_id, pd_id, od_qty)
						VALUES ($orderId, {$cartContent[$i]['pd_id']}, {$cartContent[$i]['ct_qty']})";
				$result = dbQuery($sql);					
			}
		
			
			// update product stock
			for ($i = 0; $i < $numItem; $i++) {
				$sql = "UPDATE tbl_product 
				        SET pd_qty = pd_qty - {$cartContent[$i]['ct_qty']}
						WHERE pd_id = {$cartContent[$i]['pd_id']}";
				$result = dbQuery($sql);					
			}
			
			
			// then remove the ordered items from cart
			for ($i = 0; $i < $numItem; $i++) {
				$sql = "DELETE FROM tbl_cart
				        WHERE ct_id = {$cartContent[$i]['ct_id']}";
				$result = dbQuery($sql);					
			}							
		}					
	}
	
	return $orderId;
}

/*
	Get order total amount ( total purchase + shipping cost )
*/
function getOrderAmount($orderId)
{
	$orderAmount = 0;
	
	$sql = "SELECT SUM(pd_price * od_qty)
	        FROM tbl_order_item oi, tbl_product p 
		    WHERE oi.pd_id = p.pd_id and oi.od_id = $orderId
			
			UNION
			
			SELECT od_shipping_cost 
			FROM tbl_order
			WHERE od_id = $orderId";
	$result = dbQuery($sql);

	if (dbNumRows($result) == 2) {
		$row = dbFetchRow($result);
		$totalPurchase = $row[0];
		
		$row = dbFetchRow($result);
		$shippingCost = $row[0];
		
		$orderAmount = $totalPurchase + $shippingCost;
	}	
	
	return $orderAmount;	
}

?>