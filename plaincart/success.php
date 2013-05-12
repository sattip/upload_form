<?php
require_once 'library/config.php';

// if no order id defined in the session
// redirect to main page
if (!isset($_SESSION['orderId'])) {
	header('Location: ' . WEB_ROOT);
	exit;
}

$pageTitle   = 'Checkout Completed Successfully';
require_once 'include/header.php';


// send notification email
if ($shopConfig['sendOrderEmail'] == 'y') {
	$subject = "[New Order] " . $_SESSION['orderId'];
	$email   = $shopConfig['email'];
	$message = "You have a new order. Check the order detail here \n http://" . $_SERVER['HTTP_HOST'] . WEB_ROOT . 'admin/order/index.php?view=detail&oid=' . $_SESSION['orderId'] ;
	mail($email, $subject, $message, "From: $email\r\nReturn-path: $email");
}


unset($_SESSION['orderId']);
?>
<p>&nbsp;</p><table width="500" border="0" align="center" cellpadding="1" cellspacing="0">
   <tr> 
      <td align="left" valign="top" bgcolor="#333333"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr> 
               <td align="center" bgcolor="#EEEEEE"> <p>&nbsp;</p>
                        <p>Thank you for shopping with us! We will send the purchased 
                            item(s) immediately. To continue shopping please <a href="index.php">click 
                            here</a></p>
                  <p>&nbsp;</p></td>
            </tr>
         </table></td>
   </tr>
</table>
<br>
<br>
<?php
require_once 'include/footer.php';
?>