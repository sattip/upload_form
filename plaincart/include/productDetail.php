<?php
if (!defined('WEB_ROOT')) {
	exit;
}

$product = getProductDetail($pdId, $catId);

// we have $pd_name, $pd_price, $pd_description, $pd_image, $cart_url
extract($product);
?> 
<table width="100%" border="0" cellspacing="0" cellpadding="10">
 <tr> 
  <td align="center"><img src="<?php echo $pd_image; ?>" border="0" alt="<?php echo $pd_name; ?>"></td>
  <td valign="middle">
<strong><?php echo $pd_name; ?></strong><br>
Price : <?php echo displayAmount($pd_price); ?><br>
<?php
// if we still have this product in stock
// show the 'Add to cart' button
if ($pd_qty > 0) {
?>
<input type="button" name="btnAddToCart" value="Add To Cart &gt;" onClick="window.location.href='<?php echo $cart_url; ?>';" class="addToCartButton">
<?php
} else {
	echo 'Out Of Stock';
}
?>
  </td>
 </tr>
 <tr align="left"> 
  <td colspan="2"><?php echo $pd_description; ?></td>
 </tr>
</table>
