//shop_paypal_payment.php
//Save as a snippet called "shop_paypal_payment.php"

//Etomised by Cris D.

//Set $sandbox=1; in the shop_controller snippet to turn on, ANYTHING is treated as "on" even "false".
//Therefore to turn off, do not set $sandbox at all. 
$sandbox=isset($sandbox)? $sandbox:false;


/*
	This page will submit the order information to paypal website.
	After the customer completed the payment she will return to this site
*/

if (!isset($orderId)) {
	return;
}

require_once 'plaincart/include/paypal/paypal.inc.php';

$paypal['item_name'] = $etomite->config['site_name'].' Purchase';
$paypal['invoice']   = $orderId;
$paypal['amount']    = $orderAmount;

if(!$sandbox){
$output ="<!--shop_paypal_payment snippet-->
<center>
    <p>&nbsp;</p>
    <p><font face='Verdana, Arial, Helvetica, sans-serif' size='2' color='333333'>Processing 
        Transaction . . . </font></p>
</center>";

$output .="<!--shop_paypal_payment snippet-->
<form action='".$paypal['url']."' method='post' name='frmPaypal' id='frmPaypal'>
<input type='hidden' name='amount' value='". $paypal['amount']."'>
<input type='hidden' name='invoice' value='".$paypal['invoice']."'>
<input type='hidden' name='item_name' value='".$paypal['item_name']."'>
<input type='hidden' name='business' value='".$paypal['business']."'> 
<input type='hidden' name='cmd' value='".$paypal['cmd']."'> 
<input type='hidden' name='return' value='". $paypal['site_url'] . $paypal['success_url']."'>
<input type='hidden' name='cancel_return' value='".$paypal['site_url'] . $paypal['cancel_url']."'>
<input type='hidden' name='notify_url' value='". $paypal['site_url'] . $paypal['notify_url']."'>

<input type='hidden' name='rm' value='".$paypal['return_method']."'>
<input type='hidden' name='currency_code' value='".$paypal['currency_code']."'>
<input type='hidden' name='lc' value='".$paypal['lc']."'>
<input type='hidden' name='bn' value='".$paypal['bn']."'>
<input type='hidden' name='no_shipping' value='".$paypal['display_shipping_address']."'>
</form>";

//check if this site is test of live, if live send the script.

$output .="
<script language=\"JavaScript\" type=\"text/javascript\">
window.onload=function() {
	window.document.frmPaypal.submit();
}
</script>";
}else{ //sandbox turned on, pretend to send the order

$output .=$etomite->runSnippet('shop_success.php');

}

return $output;