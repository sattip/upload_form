

 
<div class="shell">
	
	<!-- Header -->	
	<div id="header">
		<h1 id="logo"><a href="#">shoparound</a></h1>	
		
		<!-- Cart -->
		<div id="cart">
			<a href="#" class="cart-link">Your Shopping Cart</a>
			<div class="cl">&nbsp;</div>
			<span>Articles: <strong>4</strong></span>
			&nbsp;&nbsp;
			<span>Cost: <strong>$250.99</strong></span>
		</div>
		<!-- End Cart -->
		
		<!-- Navigation -->
		<div id="navigation">
			<ul>
			    <li><a href="http://localhost/html/main.php" class="active">Home</a></li>
			    <li><a href="#">Support</a></li>
			    <li><a href="http://localhost/html/checkout.php?step=1">checkout</a></li>
			    <li><a href="http://localhost/html/cart.php?action=view">cart</a></li>
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
                    <div class="products">
                    <?php
require_once 'library/config.php';
require_once 'library/cart-functions.php';
require_once 'library/checkout-functions.php';

if (isCartEmpty()) {
	// the shopping cart is still empty
	// so checkout is not allowed
	header('Location: cart.php');
} else if (isset($_GET['step']) && (int)$_GET['step'] > 0 && (int)$_GET['step'] <= 3) {
	$step = (int)$_GET['step'];

	$includeFile = '';
	if ($step == 1) {
		$includeFile = 'shippingAndPaymentInfo.php';
		$pageTitle   = 'Checkout - Step 1 of 2';
	} else if ($step == 2) {
		$includeFile = 'checkoutConfirmation.php';
		$pageTitle   = 'Checkout - Step 2 of 2';
	} else if ($step == 3) {
		$orderId     = saveOrder();
		$orderAmount = getOrderAmount($orderId);
		
		$_SESSION['orderId'] = $orderId;
		
		// our next action depends on the payment method
		// if the payment method is COD then show the 
		// success page but when paypal is selected
		// send the order details to paypal
		if ($_POST['hidPaymentMethod'] == 'cod') {
			header('Location: success.php');
			exit;
		} else {
			$includeFile = 'paypal/payment.php';	
		}
	}
} else {
	// missing or invalid step number, just redirect
	header('Location: index.php');
}

require_once 'include/header.php';
?>
<script language="JavaScript" type="text/javascript" src="library/checkout.js"></script>
<?php
require_once "include/$includeFile";
 
?>
	</div>
			<!-- End Products -->
			
		</div>
                	<div id="footer">
	     
 
		<p class="right">
			&copy; 2010 Shop Around.
			Design by <a href="http://chocotemplates.com" target="_blank" title="The Sweetest CSS Templates WorldWide">Chocotemplates.com</a>
		</p>
	</div>
	<!-- End Footer -->
	
</div>	
<!-- End Shell -->