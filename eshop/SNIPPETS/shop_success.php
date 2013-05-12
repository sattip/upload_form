//Etomised by Cris D.
//Save as a snippet called "shop_success.php"

require_once 'plaincart/library/config.php';

// if no order id defined in the session
// return the error page
if (!isset($_SESSION['orderId'])) {

$output = $etomite->runSnippet('shop_error.php',$params=array());

//order id was sent back from Paypal, transaction successful
}else{

// send notification email
if ($shopConfig['sendOrderEmail'] == 'y') {
	$subject = "[New Order] " . $_SESSION['orderId'];
	$email   = $shopConfig['email'];
	$message = "You have a new order. Check the order detail here \n http://" . $_SERVER['HTTP_HOST'] . WEB_ROOT . 'admin/order/index.php?view=detail&oid=' . $_SESSION['orderId'] ;
	@mail($email, $subject, $message, "From: $email\r\nReturn-path: $email");
}


//unset($_SESSION['orderId']);

$output ="
<!--shop_success snippet-->
<p>&nbsp;</p>
<table width='500' border='0' align='center' cellpadding='1' cellspacing='0'>\n
   <tr> \n
      <td align='left' valign='top' bgcolor='#333333'> 
          <table width='100%' border='0' cellspacing='0' cellpadding='0'>
              <tr> \n
                  <td align='center' bgcolor='#EEEEEE'>\n 
                     <p>&nbsp;</p>
                     <p>Thank you for shopping with us! We will send the purchased 
                        item(s) immediately. To continue shopping please 
                        <a href='".$etomite->makeURL($etomite->documentIdentifier,'','')."'
                        >click here</a>
                     </p>
                     <p>&nbsp;</p>
                  </td>\n
             </tr>\n
          </table>\n
        </td>\n
   </tr>\n
</table>\n
<br />
<br />";
}
return $output;