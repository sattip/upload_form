<?php
require_once 'library/config.php';
require_once 'library/category-functions.php';
require_once 'library/product-functions.php';
require_once 'library/cart-functions.php';

$_SESSION['shop_return_url'] = $_SERVER['REQUEST_URI'];

$catId  = (isset($_GET['c']) && $_GET['c'] != '1') ? $_GET['c'] : 0;
$pdId   = (isset($_GET['p']) && $_GET['p'] != '') ? $_GET['p'] : 0;

require_once 'include/header.php';
?>
<style>
    #wrapper{
            background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAQAAAAECAYAAACp8Z5+AAAAIklEQVQIHWNgYGCQ/P//PwMMM4IYyIAJxmFkZJQEsTFUAADQzg8royVN5AAAAABJRU5ErkJggg==");
    padding-bottom: 1.618em;
    }
    </style>

<table width="780" border="1" align="center" cellpadding="0" cellspacing="0">
 <tr> 
  <td colspan="3">
  <?php require_once 'include/top.php'; ?>
  </td>
 </tr>
 <tr valign="top"> 
  <td width="150" height="400" id="leftnav"> 
<?php
require_once 'include/leftNav.php';
?>
  </td>
  <td>
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
  <td width="130" align="center"><?php require_once 'include/miniCart.php'; ?></td>
 </tr>
</table>
    </div>
  
     
<?php
require_once 'include/footer.php';
?>
