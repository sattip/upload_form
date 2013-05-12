//Adapted for Etomite by Cris D.
//Save as a snippet called: "shop_miniCart.php"
require_once 'plaincart/library/common_in_etomite.php';
$cartContent = getCartContent();

$numItem = count($cartContent);	

$output .="<!--shop_miniCart snippet-->\n
<table width=\"100%\" border=\"1\" cellspacing=\"0\" cellpadding=\"2\" id=\"minicart\">\n";

if ($numItem > 0) {
$output .="<!--shop_miniCart snippet-->\n
 <tr>\n
  <td colspan=\"2\">Cart Content</td>\n
 </tr>\n";

	$subTotal = 0;
	for ($i = 0; $i < $numItem; $i++) {
		extract($cartContent[$i]);
		$pd_name = "$ct_qty x $pd_name";
		$url = $etomite->makeURL($etomite->documentIdentifier,'','?c='.$cat_id.'&p='.$pd_id);
		
		$subTotal += $pd_price * $ct_qty;
$output .="<!--shop_miniCart snippet--> \n
          <tr>\n   
            <td> <a href=\"$url\">$pd_name</a>
            </td>\n
            <td width=\"30%\" align=\"right\">".displayAmount($ct_qty * $pd_price)."
            </td>\n 
         </tr>\n";

	} // end while

$output .="<!--shop_miniCart snippet-->\n
  <tr>\n
    <td align=\"right\">Sub-total
    </td>\n
    <td width=\"30%\" align=\"right\">".displayAmount($subTotal)."
    </td>\n
 </tr>\n
  <tr>\n
     <td align=\"right\">Shipping
     </td>\n
     <td width=\"30%\" align=\"right\">".displayAmount($shopConfig['shippingCost'])."
     </td>\n
 </tr>\n
  <tr>\n
     <td align=\"right\">Total
     </td>\n
     <td width=\"30%\" align=\"right\">".displayAmount($subTotal + $shopConfig['shippingCost'])."
     </td>\n
 </tr>\n
  <tr>\n
     <td colspan=\"2\">&nbsp;
     </td>\n
  </tr>\n
  <tr>\n
     <td colspan=\"2\" align=\"center\">
         <a href=\"".$etomite->makeURL($etomite->documentIdentifier,'','?nav=cart&action=view')."\"
         >Go To Shopping Cart</a>
     </td>\n
 </tr>\n";  

} else {

  $output .="<!--shop_miniCart snippet-->\n
  <tr>\n
      <td colspan=\"2\" align=\"center\" valign=\"middle\">
         Shopping Cart Is Empty
      </td>\n
  </tr>\n";

}

$output .="<!--shop_miniCart snippet-->\n
</table>\n";

return $output;