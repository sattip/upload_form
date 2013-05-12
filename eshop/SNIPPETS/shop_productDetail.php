//Modified for Etomite by Cris D
//Save as a snippet called "shop_productDetail.php"

$product = getProductDetail($pdId, $catId);

// we have $pd_name, $pd_price, $pd_description, $pd_image, $cart_url
extract($product);
$output .="<!--shop_productDetail snippet-->
<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"10\">\n
 <tr> \n
  <td align=\"center\"><img src=\"$pd_image\" border=\"0\" alt=\"$pd_name\" />
  </td>\n
  <td valign=\"middle\">
     <strong>$pd_name</strong><br>
     Price :".displayAmount($pd_price)."<br>";

// if we still have this product in stock
// show the 'Add to cart' button
if ($pd_qty > 0) {
$output .="<!--shop_productDetail snippet-->
<input type=\"button\" name=\"btnAddToCart\" value=\"Add To Cart &gt;\" onClick=\"window.location.href='$cart_url'\" class=\"addToCartButton\">\n";

} else {
	$output .="<!--shop_productDetail snippet-->Out Of Stock";
}
$output .="<!--shop_productDetail snippet-->
  </td>\n
 </tr>\n
 <tr align=\"left\"> \n
  <td colspan=\"2\">$pd_description</td>\n
 </tr>\n
</table>\n";

return $output;