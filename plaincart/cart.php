
 
<div class="shell">
	
	<!-- Header -->	
	<div id="header">
		<h1 id="logo"><a href="#">shoparound</a></h1>	
		
		<!-- Cart -->
		<div id="cart">
			<a href="#" class="cart-link">Your Shopping Cart</a>
			<div class="cl">&nbsp;</div>
		<span>Articles: <strong><?php echo $sss;?></strong></span>
			&nbsp;&nbsp;
			<span>Cost: <strong></strong></span>
		</div>
		<!-- End Cart -->
		
		<!-- Navigation -->
		<div id="navigation">
				<ul>
			    <li><a href="http://localhost/html/main.php" class="active">Home</a></li>
			    <li><a href="#">Support</a></li>
			    <li><a href="http://localhost/html/checkout.php?step=1">checkout</a></li>
			    <li><a href="http://localhost/html/cart.php?action=view">cart</a></li>
                            <li><a href="http://localhost/html/profile.php">profile</a></li>
			    <li><a href="#">Contact</a></li>
			</ul>
		</div>
		<!-- End Navigation -->
	</div>
	<!-- End Header -->
	
	<!-- Main -->
	<div id="main">
		<div class="cl">&nbsp;</div>
		
		<!-- Content -->
		<div id="contents">
			
			<!-- Content Slider -->
<!--			<div id="slider" class="box">
				<div id="slider-holder">
					<ul>
					    <li><a href="#"><img src="css/images/slide1.jpg" alt="" /></a></li>
					    <li><a href="#"><img src="css/images/slide1.jpg" alt="" /></a></li>
					    <li><a href="#"><img src="css/images/slide1.jpg" alt="" /></a></li>
					    <li><a href="#"><img src="css/images/slide1.jpg" alt="" /></a></li>
					</ul>
				</div>
				<div id="slider-nav">
					<a href="#" class="active">1</a>
					<a href="#">2</a>
					<a href="#">3</a>
					<a href="#">4</a>
				</div>
			</div>-->
			<!-- End Content Slider -->
			
			<!-- Products -->
			<div class="products">
<!--				<div class="cl">&nbsp;</div>
				<ul>
				    <li>
				    	<a href="#"><img src="css/images/big1.jpg" alt="" /></a>
				    	<div class="product-info">
				    		<h3>LOREM IPSUM</h3>
				    		<div class="product-desc">
								<h4>WOMEN’S</h4>
				    			<p>Lorem ipsum dolor sit<br />amet</p>
				    			<strong class="price">$58.99</strong>
				    		</div>
				    	</div>
			    	</li>
			    	<li>
				    	<a href="#"><img src="css/images/big1.jpg" alt="" /></a>
				    	<div class="product-info">
				    		<h3>LOREM IPSUM</h3>
				    		<div class="product-desc">
								<h4>WOMEN’S</h4>
				    			<p>Lorem ipsum dolor sit<br />amet</p>
				    			<strong class="price">$58.99</strong>
				    		</div>
				    	</div>
			    	</li>
			    	<li class="last">
				    	<a href="#"><img src="css/images/big1.jpg" alt="" /></a>
				    	<div class="product-info">
				    		<h3>LOREM IPSUM</h3>
				    		<div class="product-desc">
								<h4>WOMEN’S</h4>
				    			<p>Lorem ipsum dolor sit<br />amet</p>
				    			<strong class="price">$58.99</strong>
				    		</div>
				    	</div>
			    	</li>
				</ul>
				<div class="cl">&nbsp;</div>-->
<?php

 
require_once 'library/config.php';
require_once 'library/cart-functions.php';

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

$pageTitle = 'Shopping Cart';
require_once 'include/header.php';

// show the error message ( if we have any )
displayError();

if ($numItem > 0 ) {
?>
<form action="<?php echo $_SERVER['PHP_SELF'] . "?action=update"; ?>" method="post" name="frmCart" id="frmCart">
 <table width="780" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
  <tr class="entryTableHeader"> 
   <td colspan="2" align="center">Item</td>
   <td align="center">Unit Price</td>
   <td width="75" align="center">Quantity</td>
   <td align="center">Total</td>
  <td width="75" align="center">&nbsp;</td>
 </tr>
 <?php
$subTotal = 0;
for ($i = 0; $i < $numItem; $i++) {
	extract($cartContent[$i]);
	$productUrl = "main.php?c=$cat_id&p=$pd_id";
	$subTotal += $pd_price * $ct_qty;



 
 
     
 
?>
 <tr class="content"> 
  <td width="80" align="center"><a href="<?php echo $productUrl; ?>"><img src="<?php echo $pd_thumbnail; ?>" border="0"></a></td>
  <td><a href="<?php echo $productUrl; ?>"><?php echo $pd_name; ?></a></td>
   <td align="right"><?php echo displayAmount($pd_price); ?></td>
  <td width="75"><input name="txtQty[]" type="text" id="txtQty[]" size="5" value="<?php echo $ct_qty; ?>" class="box" onKeyUp="checkNumber(this);">
  <input name="hidCartId[]" type="hidden" value="<?php echo $ct_id; ?>">
  <input name="hidProductId[]" type="hidden" value="<?php echo $pd_id; ?>">
  </td>
  <td align="right"><?php echo displayAmount($pd_price * $ct_qty); ?></td>
  <td width="75" align="center"> <input name="btnDelete" type="button" id="btnDelete" value="Delete" onClick="window.location.href='<?php echo $_SERVER['PHP_SELF'] . "?action=delete&cid=$ct_id"; ?>';" class="box"> 
  </td>
 </tr>
 <?php
}
?>
 <tr class="content"> 
  <td colspan="4" align="right">Sub-total</td>
  <td align="right"><?php echo displayAmount($subTotal); ?></td>
  <td width="75" align="center">&nbsp;</td>
 </tr>
<tr class="content"> 
   <td colspan="4" align="right">Shipping </td>
  <td align="right"><?php echo displayAmount($shopConfig['shippingCost']); ?></td>
  <td width="75" align="center">&nbsp;</td>
 </tr>
<tr class="content"> 
   <td colspan="4" align="right">Total </td>
   <?php $ss=displayAmount($subTotal + $shopConfig['shippingCost']);
 
   ?>
  <td align="right"><?php echo $ss; ?></td>
  <td width="75" align="center">&nbsp;</td>
 </tr>  
 <tr class="content"> 
  <td colspan="5" align="right">&nbsp;</td>
  <td width="75" align="center">
<input name="btnUpdate" type="submit" id="btnUpdate" value="Update Cart" class="box"></td>
 </tr>
</table>
</form>
<?php
} else {
	
?>
<p>&nbsp;</p><table width="550" border="0" align="center" cellpadding="10" cellspacing="0">
 <tr>
  <td><p align="center">You shopping cart is empty</p>
   <p>If you find you are unable to add anything to your cart, please ensure that 
    your internet browser has cookies enabled and that any other security software 
    is not blocking your shopping session.</p></td>
 </tr>
</table>
<?php
}

$shoppingReturnUrl = isset($_SESSION['shop_return_url']) ? $_SESSION['shop_return_url'] : 'main.php';
?>
<table width="550" border="0" align="center" cellpadding="10" cellspacing="0">
 <tr align="center"> 
  <td><input name="btnContinue" type="button" id="btnContinue" value="&lt;&lt; Continue Shopping" onClick="window.location.href='<?php echo $shoppingReturnUrl; ?>';" class="box"></td>
<?php 
if ($numItem > 0) {
?>  
  <td><input name="btnCheckout" type="button" id="btnCheckout" value="Proceed To Checkout &gt;&gt;" onClick="window.location.href='checkout.php?step=1';" class="box"></td>
<?php
}
?>  
 </tr>
</table>
<!--  <td>
<?php
if ($pdId) {
	require_once 'include/productDetail.php';
} else if ($catId) {
	require_once 'include/productList.php';
} else {
	require_once 'include/categoryList.php';
}
?>  
  </td>-->
  <td width="130" align="center"><?php require_once 'include/miniCart.php'; ?></td>
 
			</div>
			<!-- End Products -->
			
		</div>
		<!-- End Content -->
		
		<!-- Sidebar -->
		<div id="sidebar">
			
			<!-- Search -->
<!--			<div class="box search">
				<h2>Search by <span></span></h2>
				<div class="box-content">
					<form action="" method="post">
						
						<label>Keyword</label>
						<input type="text" class="field" />
						
						<label>Category</label>
						<select class="field">
							<option value="">-- Select Category --</option>
						</select>
						
						<div class="inline-field">
							<label>Price</label>
							<select class="field small-field">
								<option value="">$10</option>
							</select>
							<label>to:</label>
							<select class="field small-field">
								<option value="">$50</option>
							</select>
						</div>
						
						<input type="submit" class="search-submit" value="Search" />
						
						<p>
							<a href="#" class="bul">Advanced search</a><br />
							<a href="#" class="bul">Contact Customer Support</a>
						</p>
	
					</form>
				</div>
			</div>
			 End Search -->
			
			<!-- Categories -->
			<div class="box categories">
				<h2>Categories <span></span></h2>
				<div class="box-content">

				</div>
			</div>
			<!-- End Categories -->
			
		</div>
		<!-- End Sidebar -->
		
		<div class="cl">&nbsp;</div>
	</div>
	<!-- End Main -->
	
	<!-- Side Full -->
	<div class="side-full">
		
		<!-- More Products -->
<!--		<div class="more-products">
			<div class="more-products-holder">
				<ul>
				    <li><a href="#"><img src="css/images/small1.jpg" alt="" /></a></li>
				    <li><a href="#"><img src="css/images/small2.jpg" alt="" /></a></li>
				    <li><a href="#"><img src="css/images/small3.jpg" alt="" /></a></li>
				    <li><a href="#"><img src="css/images/small4.jpg" alt="" /></a></li>
				    <li><a href="#"><img src="css/images/small5.jpg" alt="" /></a></li>
				    <li><a href="#"><img src="css/images/small6.jpg" alt="" /></a></li>
				    <li><a href="#"><img src="css/images/small7.jpg" alt="" /></a></li>
				    <li><a href="#"><img src="css/images/small1.jpg" alt="" /></a></li>
				    <li><a href="#"><img src="css/images/small2.jpg" alt="" /></a></li>
				    <li><a href="#"><img src="css/images/small3.jpg" alt="" /></a></li>
				    <li><a href="#"><img src="css/images/small4.jpg" alt="" /></a></li>
				    <li><a href="#"><img src="css/images/small5.jpg" alt="" /></a></li>
				    <li><a href="#"><img src="css/images/small6.jpg" alt="" /></a></li>
				    <li><a href="#"><img src="css/images/small7.jpg" alt="" /></a></li>
				    <li><a href="#"><img src="css/images/small1.jpg" alt="" /></a></li>
				    <li><a href="#"><img src="css/images/small2.jpg" alt="" /></a></li>
				    <li><a href="#"><img src="css/images/small3.jpg" alt="" /></a></li>
				    <li><a href="#"><img src="css/images/small4.jpg" alt="" /></a></li>
				    <li><a href="#"><img src="css/images/small5.jpg" alt="" /></a></li>
				    <li><a href="#"><img src="css/images/small6.jpg" alt="" /></a></li>
				    <li class="last"><a href="#"><img src="css/images/small7.jpg" alt="" /></a></li>
				</ul>
			</div>
			<div class="more-nav">
				<a href="#" class="prev">previous</a>
				<a href="#" class="next">next</a>
			</div>
		</div>-->
		<!-- End More Products -->
		
		<!-- Text Cols -->
		<div class="cols">
			<div class="cl">&nbsp;</div>
			<div class="col">
				<h3 class="ico ico1">Donec imperdiet</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec imperdiet, metus ac cursus auctor, arcu felis ornare dui.</p>
				<p class="more"><a href="#" class="bul">Lorem ipsum</a></p>
			</div>
			<div class="col">
				<h3 class="ico ico2">Donec imperdiet</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec imperdiet, metus ac cursus auctor, arcu felis ornare dui.</p>
				<p class="more"><a href="#" class="bul">Lorem ipsum</a></p>
			</div>
			<div class="col">
				<h3 class="ico ico3">Donec imperdiet</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec imperdiet, metus ac cursus auctor, arcu felis ornare dui.</p>
				<p class="more"><a href="#" class="bul">Lorem ipsum</a></p>
			</div>
			<div class="col col-last">
				<h3 class="ico ico4">Donec imperdiet</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec imperdiet, metus ac cursus auctor, arcu felis ornare dui.</p>
				<p class="more"><a href="#" class="bul">Lorem ipsum</a></p>
			</div>
			<div class="cl">&nbsp;</div>
		</div>
		<!-- End Text Cols -->
		
	</div>
	<!-- End Side Full -->
	
	<!-- Footer -->
	<div id="footer">
	     
 
		<p class="right">
			&copy; 2010 Shop Around.
			Design by <a href="http://chocotemplates.com" target="_blank" title="The Sweetest CSS Templates WorldWide">Chocotemplates.com</a>
		</p>
	</div>
	<!-- End Footer -->
	
</div>	
<!-- End Shell -->
	
	
</body>
</html>