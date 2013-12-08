<html>
    <body>

 
<?php
 
 
require_once 'library/config.php';
require_once 'library/category-functions.php';
require_once 'library/product-functions.php';
require_once 'library/cart-functions.php';
require_once 'admin/library/functions.php';
if (isset($_GET['function'])){
      doLogout();
}
 $name =$_SESSION["user_name"];
 
//$_SESSION['shop_return_url'] = $_SERVER['REQUEST_URI'];

$catId  = (isset($_GET['c']) && $_GET['c'] != '1') ? $_GET['c'] : 0;
$pdId   = (isset($_GET['p']) && $_GET['p'] != '') ? $_GET['p'] : 0;

require_once 'include/header.php';

?>

<!-- Shell -->	
<div class="shell">
     <div id="signup" style='color:red;'>
         <?php
if(isset( $_SESSION["user_name"]) &&  $_SESSION["user_name"]!="")
{
   echo('<a href="?function">Logout</a></br> WElCOME '); 
           echo $_SESSION["user_name"]; 
}
else
{
      echo('<a href="http://localhost/html/admin/login_new.php">login</a>/<a href="register.php">register</a> ');
}
?>
        
        </div>	
    <div id="wrapper">
	<style>
            #signup{
                float:right;
            }
                #wrapper{
                float:right;
            }
           </style> 
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
                                    <?php
if(isset( $_SESSION["user_name"]) &&  $_SESSION["user_name"]!="")
{
                           echo'<li><a href="http://localhost/html/profile.php">profile</a></li>';
}?>
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
		<div id="content">
			
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
  </td>
  <td width="130" align="center"><?php require_once 'include/miniCart.php'; ?></td>-->
<?php
$user_name=$_SESSION["user_name"];
  $sql = "SELECT *
        FROM  tbl_user  where user_name='$user_name'";
$result = dbQuery($sql);

// extract the shop config fetched from database
// make sure we query return a row
if (dbNumRows($result) > 0) {
	extract(dbFetchAssoc($result));
} else {
	// since the query didn't return any row ( maybe because you don't run plaincart.sql as is )
	// we just set blank values for all variables
	$user_name = $address = $phone = $email= '';
 
}
?>
<form action="library/profilefun.php?action=modify" method="post" name="frmConfig" id="frmConfig">
 <table width="100%" border="0" cellspacing="1" cellpadding="2" class="entryTable">
  <tr id="entryTableHeader"> 
   <td colspan="2">Shop Configuration</td>
  </tr>
  
  <tr> 
   <td width="150" class="label">Address</td>
   <td class="content"><textarea name="mtxAddress" cols="50" rows="3" id="mtxAddress" class="box"><?php echo $address; ?></textarea></td>
  </tr>
  <tr> 
   <td width="150" class="label">Telephone</td>
   <td class="content"><input name="txtPhone" type="text" class="box" id="txtPhone" value="<?php echo $phone; ?>" size="30" maxlength="30"></td>
  </tr>
  <tr> 
   <td class="label">Email</td>
   <td class="content"><input name="txtEmail" type="text" class="box" id="txtEmail" value="<?php echo $email; ?>" size="30" maxlength="30"></td>
  </tr>
 </table>
     <p align="center"> 
         <input type="hidden" name="id" value="<?php echo $user_id; ?>">
  <input name="btnUpdate" type="submit" id="btnUpdate" value="Update Config" class="box">
 </p>
</form>
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
<!--			<div class="box categories">
				<h2>Categories <span></span></h2>
				<div class="box-content">
<?php
require_once 'include/leftNav.php';
?>
				</div>
			</div>-->
			<!-- End Categories -->
			
		</div>
		<!-- End Sidebar -->
		
		<div class="cl">&nbsp;</div>
	</div>
	<!-- End Main -->
	
	<!-- Side Full -->
	<div class="side-full">
		
		<!-- More Products -->
		<div class="more-products">
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
		</div>
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
</div>	
<!-- End Shell -->
	
	
</body>
</html>