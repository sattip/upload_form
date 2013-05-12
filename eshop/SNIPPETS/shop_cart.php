//Etomised by Cris D
//Save in snippet Library as "shop_cart.php"
require_once 'plaincart/library/common_in_etomite.php';
require_once 'plaincart/library/config.php';
require_once 'plaincart/library/cart-functions.php';
$nav=$_GET['nav'];
if($nav == 'cart'){

$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : 'view';

switch ($action) {
	case 'add' :
		addToCart();
		break;
	case 'update' :
		updateCart();
		break;	
	case 'delete' :
		deleteFromCart();
		break;
	case 'view' :
}

$cartContent = getCartContent();
$numItem = count($cartContent);

//$pageTitle = 'Shopping Cart';
//require_once 'include/header.php';

// show the error message ( if we have any )
$output=displayError();

if ($numItem > 0 ) {
$output .="<!--shop_cart.php snippet-->
<form action=\"".$etomite->makeURL($etomite->documentIdentifier,'','?action=update&nav=cart')."\" method=\"post\" name=\"frmCart\" id=\"frmCart\">
 <table width=\"780\" border=\"0\" align=\"center\" cellpadding=\"5\" cellspacing=\"1\" class=\"entryTable\">
  <tr class=\"entryTableHeader\"> 
   <td colspan=\"2\" align=\"center\">Item</td>
   <td align=\"center\">Unit Price</td>
   <td width=\"75\" align=\"center\">Quantity</td>
   <td align=\"center\">Total</td>
  <td width=\"75\" align=\"center\">&nbsp;</td>
 </tr>";
 
$subTotal = 0;
for ($i = 0; $i < $numItem; $i++) {
	extract($cartContent[$i]);
	$productUrl = $etomite->makeURL($etomite->documentIdentifier,'','c='.$cat_id.'&p='.$pd_id);
	$subTotal += $pd_price * $ct_qty;
$output .="
 <tr class=\"shopcontent\"><!--shop_cart.php snippet-->
  <td width=\"80\" align=\"center\"><a href=\"$productUrl\"><img src=\"$pd_thumbnail\" border=\"0\"></a></td>
  <td><a href=\"$productUrl\">$pd_name</a></td>
   <td align=\"right\">".displayAmount($pd_price)."</td>
  <td width=\"75\"><input name=\"txtQty[]\" type=\"text\" id=\"txtQty[]\" size=\"5\" value=\"$ct_qty\" class=\"box\" onKeyUp=\"checkNumber(this);\">
  <input name=\"hidCartId[]\" type=\"hidden\" value=\"$ct_id\">
  <input name=\"hidProductId[]\" type=\"hidden\" value=\"$pd_id\">
  </td>
  <td align=\"right\">".displayAmount($pd_price * $ct_qty)."</td>
  <td width=\"75\" align=\"center\"> <input name=\"btnDelete\" type=\"button\" id=\"btnDelete\" value=\"Delete\" onClick=\"window.location.href='".$etomite->makeURL($etomite->documentIdentifier,'','?action=delete&nav=cart&cid='.$ct_id)."';\" class=\"box\"> 
  </td>
 </tr>";

}
$output .="
 <tr class=\"shopcontent\"><!--shop_cart.php snippet--> 
  <td colspan=\"4\" align=\"right\">Sub-total</td>
  <td align=\"right\">".displayAmount($subTotal)."</td>
  <td width=\"75\" align=\"center\">&nbsp;</td>
 </tr>
<tr class=\"shopcontent\"> 
   <td colspan=\"4\" align=\"right\">Shipping </td>
  <td align=\"right\">".displayAmount($shopConfig['shippingCost'])."</td>
  <td width=\"75\" align=\"center\">&nbsp;</td>
 </tr>
<tr class=\"shopcontent\"> 
   <td colspan=\"4\" align=\"right\">Total </td>
  <td align=\"right\">".displayAmount($subTotal + $shopConfig['shippingCost'])."</td>
  <td width=\"75\" align=\"center\">&nbsp;</td>
 </tr>  
 <tr class=\"shopcontent\"> 
  <td colspan=\"5\" align=\"right\">&nbsp;</td>
  <td width=\"75\" align=\"center\">
<input name=\"btnUpdate\" type=\"submit\" id=\"btnUpdate\" value=\"Update Cart\" class=\"box\"></td>
 </tr>
</table>
</form>";

} else {
	
$output .="<!--shop_cart.php snippet--><p>&nbsp;</p><table width=\"550\" border=\"0\" align=\"center\" cellpadding=\"10\" cellspacing=\"0\">
 <tr>
  <td><p align=\"center\">You shopping cart is empty</p>
   <p>If you find you are unable to add anything to your cart, please ensure that 
    your internet browser has cookies enabled and that any other security software 
    is not blocking your shopping session.</p></td>
 </tr>
</table>";


}

$shoppingReturnUrl = isset($_SESSION['shop_return_url']) ? $_SESSION['shop_return_url'] : $etomite->makeURL($etomite->documentIdentifier,'','');

$checkoutUrl= $etomite->makeURL($etomite->documentIdentifier,'','?nav=checkout&step=1');

$output .="<!--shop_cart.php snippet-->
<table width=\"550\" border=\"0\" align=\"center\" cellpadding=\"10\" cellspacing=\"0\">
 <tr align=\"center\"> 
  <td><input name=\"btnContinue\" type=\"button\" id=\"btnContinue\" value=\"&lt;&lt; Continue Shopping\" onClick=\"window.location.href='$shoppingReturnUrl';\" class=\"box\"></td>";

if ($numItem > 0) {
$output .="<!--shop_cart.php snippet-->
  <td><input name=\"btnCheckout\" type=\"button\" id=\"btnCheckout\" value=\"Proceed To Checkout &gt;&gt;\" onClick=\"window.location.href='$checkoutUrl';\" class=\"box\"></td>";

}
$output .="<!--shop_cart.php snippet--> 
 </tr>
</table>";

}
return $output;