<?php
/*
 * This file contain paypal settings and some functions.
 * Taken from "PHP Toolkit for PayPal v0.50" with some stuff
 * removed ( because i don't need them ) and slightly modified
 *
 */

$paypal = array();

$paypal['business']      = "armanpi@phpwebcommerce.com";
$paypal['site_url']      = "http://www.phpwebcommerce.com/plaincart/";
$paypal['image_url']     = "";
$paypal['success_url']   = "success.php";
$paypal['cancel_url']    = "error.php";
$paypal['notify_url']    = "include/paypal/ipn.php";
$paypal['return_method'] = "2"; //1=GET 2=POST               --> Use post since we will need the return values to check if order is valid
$paypal['currency_code'] = "USD"; //['USD,GBP,JPY,CAD,EUR']
$paypal['lc']            = "US";

//$paypal['url'] = "https://www.paypal.com/cgi-bin/webscr";
$paypal['url']           = "https://www.sandbox.paypal.com/cgi-bin/webscr";
$paypal['post_method']   = "fso"; //fso=fsockopen(); curl=curl command line libCurl=php compiled with libCurl support
$paypal['curl_location'] = "/usr/local/bin/curl";

$paypal['bn']  = "toolkit-php";
$paypal['cmd'] = "_xclick";

//Payment Page Settings
$paypal['display_comment']          = "0"; //0=yes 1=no
$paypal['comment_header']           = "Comments";
$paypal['continue_button_text']     = "Continue >>";
$paypal['background_color']         = ""; //""=white 1=black
$paypal['display_shipping_address'] = "1"; //""=yes 1=no     --> We already asked for the shipping address so tell paypal not to ask it again
$paypal['display_comment']          = "1"; //""=yes 1=no

//Product Settings
$paypal['item_name']     = isset($_POST['item_name']) ? $_POST['item_name']: "";
$paypal['item_number']   = isset($_POST['item_number']) ? $_POST['item_number']: "";
$paypal['amount']        = isset($_POST['amount']) ? $_POST['amount']: "";
$paypal['on0']           = isset($_POST['on0']) ? $_POST['on0']: "";
$paypal['os0']           = isset($_POST['os0']) ? $_POST['os0']: "";
$paypal['on1']           = isset($_POST['on1']) ? $_POST['on1']: "";
$paypal['os1']           = isset($_POST['os1']) ? $_POST['os1']: "";
$paypal['quantity']      = isset($_POST['quantity']) ? $_POST['quantity']: "";
$paypal['edit_quantity'] = ""; //1=yes ""=no
$paypal['invoice']       = isset($_POST['invoice']) ? $_POST['invoice']: "";
$paypal['tax']           = isset($_POST['tax']) ? $_POST['tax']: "";

//Shipping and Taxes
$paypal['shipping_amount']          = isset($_POST['shipping_amount']) ? $_POST['shipping_amount']: "";
$paypal['shipping_amount_per_item'] = "";
$paypal['handling_amount']          = "";
$paypal['custom_field']             = "";

//Customer Settings
$paypal['firstname'] = isset($_POST['firstname']) ? $_POST['firstname']: "";
$paypal['lastname']  = isset($_POST['lastname']) ? $_POST['lastname']: "";
$paypal['address1']  = isset($_POST['address1']) ? $_POST['address1']: "";
$paypal['address2']  = isset($_POST['address2']) ? $_POST['address2']: "";
$paypal['city']      = isset($_POST['city']) ? $_POST['city']: "";
$paypal['state']     = isset($_POST['state']) ? $_POST['state']: "";
$paypal['zip']       = isset($_POST['zip']) ? $_POST['zip']: "";
$paypal['email']     = isset($_POST['email']) ? $_POST['email']: "";
$paypal['phone_1']   = isset($_POST['phone1']) ? $_POST['phone1']: "";
$paypal['phone_2']   = isset($_POST['phone2']) ? $_POST['phone2']: "";
$paypal['phone_3']   = isset($_POST['phone3']) ? $_POST['phone3']: "";



/********************************************************************************
*
*                           PAYPAL FUNCTIONS 
*
********************************************************************************/

//create variable names to perform additional order processing

function create_local_variables() 
{ 
	$array_name = array();
	$array_name['business'] = $_POST['business'];
	$array_name['receiver_email'] = $_POST['receiver_email'];
	$array_name['receiver_id'] = $_POST['receiver_id'];
	$array_name['item_name'] = $_POST['item_name'];
	$array_name['item_number'] = $_POST['item_number'];
	$array_name['quantity'] = $_POST['quantity'];
	$array_name['invoice'] = $_POST['invoice'];
	$array_name['custom'] = $_POST['custom'];
	$array_name['memo'] = $_POST['memo'];
	$array_name['tax'] = $_POST['tax'];
	$array_name['option_name1'] = $_POST['option_name1'];
	$array_name['option_selection1'] = $_POST['option_selection1'];
	$array_name['option_name2'] = $_POST['option_name2'];
	$array_name['option_selection2'] = $_POST['option_selection2'];
	$array_name['num_cart_items'] = $_POST['num_cart_items'];
	$array_name['mc_gross'] = $_POST['mc_gross'];
	$array_name['mc_fee'] = $_POST['mc_fee'];
	$array_name['mc_currency'] = $_POST['mc_currency'];
	$array_name['settle_amount'] = $_POST['settle_amount'];
	$array_name['settle_currency'] = $_POST['settle_currency'];
	$array_name['exchange_rate'] = $_POST['exchange_rate'];
	$array_name['payment_gross'] = $_POST['payment_gross'];
	$array_name['payment_fee'] = $_POST['payment_fee'];
	$array_name['payment_status'] = $_POST['payment_status'];
	$array_name['pending_reason'] = $_POST['pending_reason'];
	$array_name['reason_code'] = $_POST['reason_code'];
	$array_name['payment_date'] = $_POST['payment_date'];
	$array_name['txn_id'] = $_POST['txn_id'];
	$array_name['txn_type'] = $_POST['txn_type'];
	$array_name['payment_type'] = $_POST['payment_type'];
	$array_name['for_auction'] = $_POST['for_auction'];
	$array_name['auction_buyer_id'] = $_POST['auction_buyer_id'];
	$array_name['auction_closing_date'] = $_POST['auction_closing_date'];
	$array_name['auction_multi_item'] = $_POST['auction_multi_item'];
	$array_name['first_name'] = $_POST['first_name'];
	$array_name['last_name'] = $_POST['last_name'];
	$array_name['payer_business_name'] = $_POST['payer_business_name'];
	$array_name['address_name'] = $_POST['address_name'];
	$array_name['address_street'] = $_POST['address_street'];
	$array_name['address_city'] = $_POST['address_city'];
	$array_name['address_state'] = $_POST['address_state'];
	$array_name['address_zip'] = $_POST['address_zip'];
	$array_name['address_country'] = $_POST['address_country'];
	$array_name['address_status'] = $_POST['address_status'];
	$array_name['payer_email'] = $_POST['payer_email'];
	$array_name['payer_id'] = $_POST['payer_id'];
	$array_name['payer_status'] = $_POST['payer_status'];
	$array_name['notify_version'] = $_POST['notify_version'];
	$array_name['verify_sign'] = $_POST['verify_sign'];
	 
	return $array_name; 
}


//this function creates a comma separated value file from an array. 

function create_csv_file($file,$data) 
{
	// the return value
	$success = false;
	
	//check for array
	if (is_array($data)) { 
		$post_values = array_values($data); 
		
		//build csv data
		foreach ($post_values as $i) { 
			$csv.="\"$i\","; 
		}
		
		//remove the last comma from string
		$csv = substr($csv,0,-1); 
		
		//check for existence of file
		if(file_exists($file) && is_writeable($file)) { 
			$mode="a"; 
		} else { 
			$mode="w"; 
		}
		
		//create file pointer
		$fp=@fopen($file,$mode);
		 
		//write to file
		fwrite($fp,$csv . "\n"); 
		
		//close file pointer
		fclose($fp); 
		
		$success = true; 
	} 
	
	return $success;	 
}

//posts transaction data using fsockopen. 
function fsockPost($url,$data) 
{ 
	$postData = '';
	
	// return value
	$info = '';
	
	//Parse url 
	$web=parse_url($url); 
	
	//build post string 
	foreach ($data as $i=>$v) { 
		$postData.= $i . "=" . urlencode($v) . "&"; 
	}
	
	// we must append cmd=_notify-validate to the POST string
	// so paypal know that this is a confirmation post
	$postData .= "cmd=_notify-validate";
	
	//Set the port number
	if ($web['scheme'] == "https") { 
		$web['port'] = "443";  
		$ssl       = "ssl://"; 
	} else { 
		$web['port'] = "80"; 
		$ssl       = "";
	}  
	
	//Create paypal connection
	$fp = @fsockopen($ssl . $web[host], $web[port], $errnum, $errstr,30); 
	
	//Error checking
	if(!$fp) { 
		echo "$errnum: $errstr"; 
	} else { 
		//Post Data
		fputs($fp, "POST $web[path] HTTP/1.1\r\n"); 
		fputs($fp, "Host: $web[host]\r\n"); 
		fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n"); 
		fputs($fp, "Content-length: ".strlen($postData)."\r\n"); 
		fputs($fp, "Connection: close\r\n\r\n"); 
		fputs($fp, $postData . "\r\n\r\n"); 
	
		// loop through the response from the server 
		$info = array();
		while (!feof($fp)) { 
			$info[] = @fgets($fp, 1024); 
		} 
		
		//close fp - we are done with it 
		fclose($fp); 
		
		// join the results into a string separated by comma
		$info = implode(",", $info); 
		
	}
	
	return $info; 

} 

//Display Paypal Hidden Variables

function showVariables() {
	global $paypal; 
?> 

<!-- PayPal Configuration --> 
<input type="hidden" name="business" value="<?php echo $paypal['business']?>"> 
<input type="hidden" name="cmd" value="<?php echo $paypal['cmd']?>"> 
<input type="hidden" name="image_url" value="<?php echo  "{$paypal['site_url']}{$paypal['image_url']}"; ?>">
<input type="hidden" name="return" value="<?php echo  "{$paypal['site_url']}{$paypal['success_url']}"; ?>">
<input type="hidden" name="cancel_return" value="<?php echo  "{$paypal['site_url']}{$paypal['cancel_url']}"; ?>">
<input type="hidden" name="notify_url" value="<?php echo  "{$paypal['site_url']}{$paypal['notify_url']}"; ?>">
<input type="hidden" name="rm" value="<?php echo $paypal['return_method']?>">
<input type="hidden" name="currency_code" value="<?php echo $paypal['currency_code']?>">
<input type="hidden" name="lc" value="<?php echo $paypal['lc']?>">
<input type="hidden" name="bn" value="<?php echo $paypal['bn']?>">
<input type="hidden" name="cbt" value="<?php echo $paypal['continue_button_text']?>">

<!-- Payment Page Information --> 
<input type="hidden" name="no_shipping" value="<?php echo $paypal['display_shipping_address']?>">
<input type="hidden" name="no_note" value="<?php echo $paypal['display_comment']?>">
<input type="hidden" name="cn" value="<?php echo $paypal['comment_header']?>"> 
<input type="hidden" name="cs" value="<?php echo $paypal['background_color']?>">

<!-- Product Information --> 
<input type="hidden" name="item_name" value="<?php echo $paypal['item_name']?>">
<input type="hidden" name="amount" value="<?php echo $paypal['amount']?>">
<input type="hidden" name="quantity" value="<?php echo $paypal['quantity']?>"> 
<input type="hidden" name="item_number" value="<?php echo $paypal['item_number']?>">
<input type="hidden" name="undefined_quantity" value="<?php echo $paypal['edit_quantity']?>">
<input type="hidden" name="on0" value="<?php echo $paypal['on0']?>">
<input type="hidden" name="os0" value="<?php echo $paypal['os0']?>">
<input type="hidden" name="on1" value="<?php echo $paypal['on1']?>">
<input type="hidden" name="os1" value="<?php echo $paypal['os1']?>">

<!-- Shipping and Misc Information --> 
<input type="hidden" name="shipping" value="<?php echo $paypal['shipping_amount']?>">
<input type="hidden" name="shipping2" value="<?php echo $paypal['shipping_amount_per_item']?>">
<input type="hidden" name="handling" value="<?php echo $paypal['handling_amount']?>">
<input type="hidden" name="tax" value="<?php echo $paypal['tax']?>">
<input type="hidden" name="custom" value="<?php echo $paypal['custom_field']?>">
<input type="hidden" name="invoice" value="<?php echo $paypal['invoice']?>">

<!-- Customer Information --> 
<input type="hidden" name="first_name" value="<?php echo $paypal['firstname']?>"> 
<input type="hidden" name="last_name" value="<?php echo $paypal['lastname']?>"> 
<input type="hidden" name="address1" value="<?php echo $paypal['address1']?>"> 
<input type="hidden" name="address2" value="<?php echo $paypal['address2']?>"> 
<input type="hidden" name="city" value="<?php echo $paypal['city']?>"> 
<input type="hidden" name="state" value="<?php echo $paypal['state']?>"> 
<input type="hidden" name="zip" value="<?php echo $paypal['zip']?>"> 
<input type="hidden" name="email" value="<?php echo $paypal['email']?>"> 
<input type="hidden" name="night_phone_a" value="<?php echo $paypal['phone_1']?>"> 
<input type="hidden" name="night_phone_b" value="<?php echo $paypal['phone_2']?>"> 
<input type="hidden" name="night_phone_c" value="<?php echo $paypal['phone_3']?>"> 

<?php 
} 
?>