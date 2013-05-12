<?php
if (!defined('WEB_ROOT')) {
	exit;
}

$cartContent = getCartContent();

$numItem = count($cartContent);	
?>
<table width="100%" border="1" cellspacing="0" cellpadding="2" id="minicart">
 <?php
if ($numItem > 0) {
?>
 <tr>
  <td colspan="2">Cart Content</td>
 </tr>
<?php
	$subTotal = 0;
	for ($i = 0; $i < $numItem; $i++) {
		extract($cartContent[$i]);
		$pd_name = "$ct_qty x $pd_name";
		$url = "index.php?c=$cat_id&p=$pd_id";
		
		$subTotal += $pd_price * $ct_qty;
?>
 <tr>
   <td><a href="<?php echo $url; ?>"><?php echo $pd_name; ?></a></td>
   
  <td width="30%" align="right"><?php echo displayAmount($ct_qty * $pd_price); ?></td>
 </tr>
<?php
	} // end while
?>
  <tr><td align="right">Sub-total</td>
  <td width="30%" align="right"><?php echo displayAmount($subTotal); ?></td>
 </tr>
  <tr><td align="right">Shipping</td>
  <td width="30%" align="right"><?php echo displayAmount($shopConfig['shippingCost']); ?></td>
 </tr>
  <tr><td align="right">Total</td>
  <td width="30%" align="right"><?php echo displayAmount($subTotal + $shopConfig['shippingCost']); ?></td>
 </tr>
  <tr><td colspan="2">&nbsp;</td></tr>
  <tr>
  <td colspan="2" align="center"><a href="cart.php?action=view"> Go To Shopping 
   Cart</a></td>
 </tr>  
<?php	
} else {
?>
  <tr><td colspan="2" align="center" valign="middle">Shopping Cart Is Empty</td></tr>
<?php
}
?> 
</table>
