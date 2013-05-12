//Plaincart shop index.php file: "shop_controller.php"
//Adapted from PlainCart from http://www.phpwebcommerce.com/plaincart/";
/*
Plaincart is free to use, modify or enchance. Just 
remember that it's created as an example for
the shopping cart tutorial in www.phpwebcommerce.com 
so i disclaim anything if you want to use it on a 
live site
*/
//Etomised by Cris D 2008/02/02 for Etomite V 0.6.1.4

// Stops the script being sent to paypal  set to true to turn on sandbox mode.  Default is off.
$sandbox=isset($sandbox)? $sandbox:false;// [true || false] default:false;

//How many categories per row in your shop front?
$categoriesPerRow=isset($categoriesPerRow) ? $categoriesPerRow : 1;//default 3.

//How many products per row when browsing by category?
$productsPerRow  = isset($productsPerRow)  ? $productsPerRow: 1;//default 2.

//How many products per page when browsing by category?
$productsPerPage = isset($productsPerPage) ? $productsPerPage: 1;//default 4.

require_once 'plaincart/library/common_in_etomite.php';
require_once 'plaincart/library/config.php';
require_once 'plaincart/library/category-functions.php';
require_once 'plaincart/library/product-functions.php';
require_once 'plaincart/library/cart-functions.php';

//create a admin login link if you have already logged into etomite.
//otherwise you can access the admin page (which is NOT run through Etomite and does NOT share authentication) from 
//http://www.yourdomain.com/plaincart/admin
//test to get the shop Cofig shipping costs out from the function.

$adminLogin="<!--shop_controller snippet-->
             <a href=\"".$etomite->config['www_base_path']."plaincart/admin\" target=\"_blank\" >Shop Admin Login</a>\n";
        
         if(!$_SESSION['validated']) $adminLogin='';

$output =$adminLogin;

$catId  = (isset($_GET['c']) && $_GET['c'] != '1') ? $_GET['c'] : 0;
$pdId   = (isset($_GET['p']) && $_GET['p'] != '')  ? $_GET['p'] : 0;

//Set navigation variables
if($_GET['nav'] == 'cart' 
|| $_GET['nav'] == 'checkout' 
|| $_GET['nav'] == 'error' 
|| $_GET['nav'] == 'success')
{

   $nav = $_GET['nav'];
   
}else{

   $nav='';
}

$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

if($action !='' || $nav !=''){

//process ipn
 if($action == 'ipn'){
 
 $output = $etomite->runSnippet('shop_paypal.ipn',$params=array('action'=>$action, 
                                                                'shopConfig'=>$shopConfig ));
   //if ipn sent, process it only.                                                            
return $output;

 }

//show the error page
 if($nav =='error'){
     
      $output = $etomite->runSnippet('shop_error.php',$params=array('shopConfig'=>$shopConfig));
    }

//show the successful payment page
 if($nav =='success'){
     
      $output = $etomite->runSnippet('shop_success.php',$params=array('shopConfig'=>$shopConfig));
    }

//show the cart
    if($nav =='cart'){
     
      $output = $etomite->runSnippet('shop_cart.php',$params=array('catId'=>$catId, 
                                                                'pdId'=>$pdId, 
                                                                'action'=>$action, 
                                                                'nav'=>$nav, 
                                                                'shopConfig'=>$shopConfig));
    }

//show the checkout
   if($nav=='checkout' && !isCartEmpty() ){
      
      $step=$_GET['step'];
  
      $snippetName = '';

	if($step == 1){
		
		$snippetName = 'shop_shippingAndPaymentInfo.php';
		$params=array('step'=>$step, 
		              'shopConfig'=>$shopConfig);
		$message   = 'Checkout - Step 1 of 2';
		
	} else if ($step == 2) {
		
		$snippetName = 'shop_checkoutConfirmation.php';
		$params=array('step'=>$step, 
		              'shopConfig'=>$shopConfig);
		$message   = 'Checkout - Step 2 of 2';
		
	} else if ($step == 3) {
require_once 'plaincart/library/checkout-functions.php';
		
		$orderId     = saveOrder();
		$orderAmount = getOrderAmount($orderId);
		$_SESSION['orderId'] = $orderId;
		
		// our next action depends on the payment method
		// if the payment method is COD then show the 
		// success page but when paypal is selected
		// send the order details to paypal
	if ($_POST['hidPaymentMethod'] == 'cod') {
		
		$output.=$etomite->runSnippet('shop_success.php', $params=array('shopConfig'=>$shopConfig));
		
		
		
		} else {
		
		$snippetName = 'shop_paypal_payment.php';
		$params=array('orderId'=>$orderId, 
		              'orderAmount'=>$orderAmount, 
		              'step'=>$step, 
		              'sandbox'=>$sandbox, 
		              'shopConfig'=>$shopConfig);
		}
		
		
     }//end if step 3

  $output .= $etomite->runSnippet($snippetName,$params);
  
  }//end if checkout

//we have our error, success, cart or checkout, go no further.
return $output;

}//end if action or nav

//Not a cart or checkout, show the main shop pages

#### DEFINE THE TOP OF THE SHOP #####

$output .=
<<<SHOPTOP
<!--shop_controller snippet-->
<div id='shopwrapper' >
<table  width='780' border='1' align='center' cellpadding='0' cellspacing='0'>
 <tr> 
  <td colspan='3'>
    <img src='plaincart/images/grass.jpg' alt='header' width='780px' height='100px' />
  </td>
 </tr>
SHOPTOP;
 
$output .=
<<<LEFTNAV
<!--shop_controller snippet-->
<tr valign='top'> 
  <td width='150' height='400' id='leftnav'> 
LEFTNAV;

// get all categories
$categories = fetchCategories();

// format the categories for display
$categories = formatCategories($categories, $catId);
$output .= "<!--shop_controller snippet-->
        <ul> 
           <li>
       <a href=\"".$etomite->makeURL($etomite->documentIdentifier,'','')."\">All Category</a></li>\n";

foreach ($categories as $category) {
	extract($category);
	// now we have $cat_id, $cat_parent_id, $cat_name
	
	$level = ($cat_parent_id == 0) ? 1 : 2;
        $url   = $etomite->makeURL($etomite->documentIdentifier,'',"?c=".$cat_id);

	// for second level categories we print extra spaces to give
	// indentation look
	if ($level == 2) {
		$cat_name = '&nbsp;&raquo;&nbsp;' . $cat_name;// '__>>' indent at menu
	}
	
	// assign id="current" for the currently selected category
	// this will highlight the category name
	$listId = '';
	if ($cat_id == $catId) {
		$listId = ' id="current"';
	}
$output .="<li$listId><a href=\"$url\">$cat_name</a></li>\n";
 }
$output .="</ul> \r\n 
        </td>\n 
       <td>\n";

//Find out what to show in the shop depending on user navigation
if ($pdId) {//looking at a product

	$output .= $etomite->runSnippet('shop_productDetail.php', $params=array('catId'=>$catId, 
	                                                                        'pdId'=>$pdId, 
	                                                                        'shopConfig'=>$shopConfig) );

} else if ($catId) {//browsing a category

	$output .= $etomite->runSnippet('shop_productList.php', $params=array('catId'=>$catId, 
	                                                                       'pdId'=>$pdId,
	                                                                       'productsPerRow'=>$productsPerRow,
	                                                                       'productsPerPage'=>$productPerPage,
	                                                                       'shopConfig'=>$shopConfig ) );

} else {//viewing the shop front
        
        $output .= $etomite->runSnippet('shop_categoryList.php', $params=array('categoriesPerRow'=>$categoriesPerRow,
                                                                               'shopConfig'=>$shopConfig) );
}
$output .="<!--shop_controller snippet--></td>\n";

//Now start creating the right side section to hold the mini cart
$output .="<!--shop_controller snippet-->
         <td width=\'130\' align=\'center\'>\n";

$output .=$etomite->runSnippet('shop_miniCart.php', $params=array('catId'=>$catId, 
                                                                  'pdId'=>$pdId,
                                                                  'shopConfig'=>$shopConfig));
$output .="<!--shop_controller snippet-->
         </td>\n
       </tr>\n
     </table>\n</div><!--end shop_controller snippet-->";

return $output;