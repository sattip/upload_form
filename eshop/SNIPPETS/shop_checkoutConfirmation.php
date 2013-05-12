//shop_checkoutConfirmation.php Adapted for Etomite by Cris D.
//Save in the snippet library as "shop_checkoutConfirmation.php" 

//There is a problem using the 0.6.1.4 Version of Etomite makeURL API in that it returns &amp; instead of '&' 
//and when comparing the httpreferrer and the current URL they look identical but are not.

//Therefore, I have used the first 25 letters of the url example: "http://localhost/dom" to extract whether the referrer was the same domain
//but may fail if the string returned includes the first amperstand in the url index.php?id=xx"&".

//You might like to build in more security than these simple checks...

if (!isset($_GET['step']) || (int)$_GET['step'] != 2
	|| substr($_SERVER['HTTP_REFERER'],0,25) != substr($etomite->makeURL($etomite->documentIdentifier,'','?nav=checkout&step=1'),0,25))

	{
	
	return "<p>NOT A VALID REFERRING PAGE.  Please access this page from the <a href=\"".$etomite->makeURL($etomite->documentIdentifier,'','?nav=checkout&step=1')."\"> shopping cart only</a>.</p>";
  }

$errorMessage = '&nbsp;';

/*
 Make sure all the required field exist is $_POST and the value is not empty
 Note: txtShippingAddress2 and txtPaymentAddress2 are optional
*/
$requiredField = array('txtShippingFirstName', 'txtShippingLastName', 'txtShippingAddress1', 'txtShippingPhone', 'txtShippingState',  'txtShippingCity', 'txtShippingPostalCode',
                       'txtPaymentFirstName', 'txtPaymentLastName', 'txtPaymentAddress1', 'txtPaymentPhone', 'txtPaymentState', 'txtPaymentCity', 'txtPaymentPostalCode');
					   
if (!checkRequiredPost($requiredField)) {
	$errorMessage = 'Input not complete.';
}
					   

$cartContent = getCartContent();

$output ="<!--shop_checkoutConfirmation.php snippet-->
<table width\550\" border=\"0\" align=\"center\" cellpadding=\"10\" cellspacing=\"0\">
    <tr> 
        <td>Step 2 Of 3 : Confirm Order </td>
    </tr>
</table>
<p id=\"errorMessage\">$errorMessage</p>";

$output .="
<form action=\"".$etomite->makeURL($etomite->documentIdentifier,'','?nav=checkout&step=3')."\" method=\"post\" name=\"frmCheckout\" id=\"frmCheckout\">";

if ($_POST['optPayment'] == 'paypal') {
$output .="
    <!--shop_checkoutConfirmation.php-->
    <table width=\"550\" border=\"0\" align=\"center\" cellpadding=\"10\" cellspacing=\"0\">
        <tr> 
            <td align=\"center\"><strong>:: IMPORTANT NOTE :: </strong></td>
        </tr>
        <tr> 
            <td><p>Before clicking the &quot;Confirm Order&quot; button open a 
                    new browser window and go to <a href=\"https://developer.paypal.com\" target=\"_blank\">https://developer.paypal.com</a> 
                    then login using this username and password :<br>
                    Email : Not avaliable for you yet.<br />
                    Password : Not avaliable for you yet.<br />
                 
                    After you click on the &quot;Confirm Order&quot; button below 
                    you will be redirected to paypal website. On the paypal checkout 
                    page use these info to login and complete the checkout process 
                    :<br />
                    Email :tester_1189938371_per@bigpond.com<br />
                    Password : tester08<br />
                    <p>This message can be removed in the shop_checkoutConfirmation.php snippet.</p>
                    </td>
        </tr>
    </table>
    <p>&nbsp;</p>";

}//end if paypal
$output .="<!--shop_checkoutConfirmation.php snippet-->
    <table width=\"550\" border=\"0\" align=\"center\" cellpadding=\"5\" cellspacing=\"1\" class=\"infoTable\">
        <tr class=\"infoTableHeader\"> 
            <td colspan=\"3\">Ordered Item</td>
        </tr>
        <tr class=\"label\"> 
            <td>Item</td>
            <td>Unit Price</td>
            <td>Total</td>
        </tr>";


$numItem  = count($cartContent);
$subTotal = 0;
for ($i = 0; $i < $numItem; $i++) {
	extract($cartContent[$i]);
	$subTotal += $pd_price * $ct_qty;
	
$output .="<!--shop_checkoutConfirmation.php snippet-->
            <tr class=\"shopcontent\">\n
              <td class=\"shopcontent\">$ct_qty x $pd_name</td>\n
              <td align=\"right\">".displayAmount($pd_price)."</td>\n
              <td align=\"right\">".displayAmount($ct_qty * $pd_price)."</td>\n
        </tr>\n";
        
}

$output .="<!--shop_checkoutConfirmation.php snippet-->
        <tr class=\"shopcontent\"> \n
            <td colspan=\"2\" align=\"right\">Sub-total</td>\n
            <td align=\"right\">".displayAmount($subTotal)."</td>\n
        </tr>\n";
        
$output .="  
        <tr class=\"shopcontent\">\n 
            <td colspan=\"2\" align=\"right\">Shipping</td>\n
            <td align=\"right\">".displayAmount($shopConfig['shippingCost'])."</td>\n
        </tr>\n
        <tr class=\"shopcontent\"> \n
            <td colspan=\"2\" align=\"right\">Total</td>\n
            <td align=\"right\">".displayAmount($shopConfig['shippingCost'] + $subTotal)."</td>\n
        </tr>\n
    </table>\n
    <p>&nbsp;</p>
    <table width=\"550\" border=\"0\" align=\"center\" cellpadding=\"5\" cellspacing=\"1\" class=\"infoTable\">\n
        <tr class=\"infoTableHeader\"> \n
            <td colspan=\"2\">Shipping Information</td>\n
        </tr>\n
        <tr> \n
            <td width=\"150\" class=\"label\">First Name</td>\n
            <td class=\"shopcontent\">".$_POST['txtShippingFirstName']."\n
                <input name=\"hidShippingFirstName\" type=\"hidden\" id=\"hidShippingFirstName\" value=\"".$_POST['txtShippingFirstName']."\"></td>\n
        </tr>\n
        <tr> \n
            <td width=\"150\" class=\"label\">Last Name</td>\n
            <td class=\"shopcontent\">".$_POST['txtShippingLastName']."\n
                <input name=\"hidShippingLastName\" type=\"hidden\" id=\"hidShippingLastName\" value=\"".$_POST['txtShippingLastName']."\"></td>\n
        </tr>\n
        <tr> \n
            <td width=\"150\" class=\"label\">Address1</td>\n
            <td class=\"shopcontent\">".$_POST['txtShippingAddress1']."\n
                <input name=\"hidShippingAddress1\" type=\"hidden\" id=\"hidShippingAddress1\" value=\"".$_POST['txtShippingAddress1']."\"></td>\n
        </tr>\n
        <tr> \n
            <td width=\"150\" class=\"label\">Address2</td>\n
            <td class=\"shopcontent\">".$_POST['txtShippingAddress2']."\n
                <input name=\"hidShippingAddress2\" type=\"hidden\" id=\"hidShippingAddress2\" value=\"".$_POST['txtShippingAddress2']."\"></td>\n
        </tr>\n
        <tr> \n
            <td width=\"150\" class=\"label\">Phone Number</td>\n
            <td class=\"shopcontent\">".$_POST['txtShippingPhone']."\n
                <input name=\"hidShippingPhone\" type=\"hidden\" id=\"hidShippingPhone\" value=\"".$_POST['txtShippingPhone']."\"></td>\n
        </tr>\n
        <tr> \n
            <td width=\"150\" class=\"label\">Province / State</td>\n
            <td class=\"shopcontent\">".$_POST['txtShippingState']."<input name=\"hidShippingState\" type=\"hidden\" id=\"hidShippingState\" value=\"".$_POST['txtShippingState']."\" ></td>\n
        </tr>\n
        <tr> \n
            <td width=\"150\" class=\"label\">City</td>\n
            <td class=\"shopcontent\">".$_POST['txtShippingCity']."\n
                <input name=\"hidShippingCity\" type=\"hidden\" id=\"hidShippingCity\" value=\"".$_POST['txtShippingCity']."\" ></td>\n
        </tr>\n
        <tr> \n
            <td width=\"150\" class=\"label\">Postal Code</td>\n
            <td class=\"shopcontent\">".$_POST['txtShippingPostalCode']."\n
                <input name=\"hidShippingPostalCode\" type=\"hidden\" id=\"hidShippingPostalCode\" value=\"".$_POST['txtShippingPostalCode']."\"></td>\n
        </tr>\n
    </table>\n
    <p>&nbsp;</p>
    <table width=\"550\" border=\"0\" align=\"center\" cellpadding=\"5\" cellspacing=\"1\" class=\"infoTable\">\n
        <tr class=\"infoTableHeader\"> \n
            <td colspan=\"2\">Payment Information</td>\n
        </tr>\n
        <tr>\n 
            <td width=\"150\" class=\"label\">First Name</td>\n
            <td class=\"shopcontent\">".$_POST['txtPaymentFirstName']."\n
                <input name=\"hidPaymentFirstName\" type=\"hidden\" id=\"hidPaymentFirstName\" value=\"".$_POST['txtPaymentFirstName']."\"></td>\n
        </tr>\n
        <tr> \n
            <td width=\"150\" class=\"label\">Last Name</td>\n
            <td class=\"shopcontent\">".$_POST['txtPaymentLastName']."\n
                <input name=\"hidPaymentLastName\" type=\"hidden\" id=\"hidPaymentLastName\" value=\"".$_POST['txtPaymentLastName']."\"></td>\n
        </tr>\n
        <tr> \n
            <td width=\"150\" class=\"label\">Address1</td>\n
            <td class=\"shopcontent\">".$_POST['txtPaymentAddress1']."\n
                <input name=\"hidPaymentAddress1\" type=\"hidden\" id=\"hidPaymentAddress1\" value=\"".$_POST['txtPaymentAddress1']."\"></td>\n
        </tr>\n
        <tr> \n
            <td width=\"150\" class=\"label\">Address2</td>\n
            <td class=\"shopcontent\">".$_POST['txtPaymentAddress2']."<input name=\"hidPaymentAddress2\" type=\"hidden\" id=\"hidPaymentAddress2\" value=\"".$_POST['txtPaymentAddress2']."\"> \n
            </td>\n
        </tr>\n
        <tr> \n
            <td width=\"150\" class=\"label\">Phone Number</td>\n
            <td class=\"shopcontent\">".$_POST['txtPaymentPhone']."<input name=\"hidPaymentPhone\" type=\"hidden\" id=\"hidPaymentPhone\" value=\"".$_POST['txtPaymentPhone']."\"></td>\n
        </tr>\n
        <tr> \n
            <td width=\"150\" class=\"label\">Province / State</td>\n
            <td class=\"shopcontent\">".$_POST['txtPaymentState']."<input name=\"hidPaymentState\" type=\"hidden\" id=\"hidPaymentState\" value=\"".$_POST['txtPaymentState']."\" ></td>\n
        </tr>\n
        <tr> \n
            <td width=\"150\" class=\"label\">City</td>\n
            <td class=\"shopcontent\">".$_POST['txtPaymentCity']."\n
                <input name=\"hidPaymentCity\" type=\"hidden\" id=\"hidPaymentCity\" value=\"".$_POST['txtPaymentCity']."\"></td>\n
        </tr>\n
        <tr> \n
            <td width=\"150\" class=\"label\">Postal Code</td>\n
            <td class=\"shopcontent\">".$_POST['txtPaymentPostalCode']."\n
                <input name=\"hidPaymentPostalCode\" type=\"hidden\" id=\"hidPaymentPostalCode\" value=\"".$_POST['txtPaymentPostalCode']."\"></td>\n
        </tr>\n
    </table>\n
    <p>&nbsp;</p>
    <table width=\"550\" border=\"0\" align=\"center\" cellpadding=\"5\" cellspacing=\"1\" class=\"infoTable\">\n
      <tr>\n
        <td width=\"150\" class=\"infoTableHeader\">Payment Method </td>\n
        <td class=\"shopcontent\">";
$output .= $_POST['optPayment'] == 'paypal' ? 'Paypal' : 'Cash on Delivery';

$output .="
          <input name=\"hidPaymentMethod\" type=\"hidden\" id=\"hidPaymentMethod\" value=\"".$_POST['optPayment']."\" />\n
        </tr>\n
    </table>\n
    <p>&nbsp;</p>
    <p align=\"center\"> 
        <input name=\"btnBack\" type=\"button\" id=\"btnBack\" value=\"&lt;&lt; Modify Shipping/Payment Info\" onClick=\"window.location.href='".$etomite->makeURL($etomite->documentIdentifier,'','?nav=checkout&step=1')."';\" class=\"box\">\n
        &nbsp;&nbsp; 
        <input name=\"btnConfirm\" type=\"submit\" id=\"btnConfirm\" value=\"Confirm Order &gt;&gt;\" class=\"box\">\n
</form>\n
<p>&nbsp;</p>";

return $output;