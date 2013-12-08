<?php
if (!defined('WEB_ROOT')) {
	exit;
}

// make sure a product id exists
if (isset($_GET['productId']) && $_GET['productId'] > 0) {
	$productId = $_GET['productId'];
} else {
	// redirect to index.php if product id is not present
	header('Location: index.php');
}

// get product info
$sql = "SELECT pd.cat_id, pd_name, pd_description, pd_price, pd_qty, pd_image, pd_thumbnail
        FROM tbl_product pd, tbl_category cat
		WHERE pd.pd_id = $productId AND pd.cat_id = cat.cat_id";
$result = mysql_query($sql) or die('Cannot get product. ' . mysql_error());
$row    = mysql_fetch_assoc($result);
extract($row);

// get category list
$sql = "SELECT cat_id, cat_parent_id, cat_name
        FROM tbl_category
		ORDER BY cat_id";
$result = dbQuery($sql) or die('Cannot get Product. ' . mysql_error());

$categories = array();
while($row = dbFetchArray($result)) {
	list($id, $parentId, $name) = $row;
	
	if ($parentId == 0) {
		$categories[$id] = array('name' => $name, 'children' => array());
	} else {
		$categories[$parentId]['children'][] = array('id' => $id, 'name' => $name);	
	}
}	

//echo '<pre>'; print_r($categories); echo '</pre>'; exit;

// build combo box options
$list = '';
foreach ($categories as $key => $value) {
	$name     = $value['name'];
	$children = $value['children'];
	
	$list .= "<optgroup label=\"$name\">"; 
	
	foreach ($children as $child) {
		$list .= "<option value=\"{$child['id']}\"";
		
		if ($child['id'] == $cat_id) {
			$list .= " selected";
		}
		$list .= ">{$child['name']}</option>";
	}
	
	$list .= "</optgroup>";
}
?> 
<form action="processProduct.php?action=modifyProduct&productId=<?php echo $productId; ?>" method="post" enctype="multipart/form-data" name="frmAddProduct" id="frmAddProduct">
 <p align="center" class="formTitle">Modify Product</p>
 
 <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
  <tr> 
   <td width="150" class="label">Category</td>
   <td class="content"> <select name="cboCategory" id="cboCategory" class="box">
     <option value="" selected>-- Choose Category --</option>
<?php
	echo $list;
?>	 
    </select></td>
  </tr>
  <tr> 
   <td width="150" class="label">Product Name</td>
   <td class="content"> <input name="txtName" type="text" class="box" id="txtName" value="<?php echo $pd_name; ?>" size="50" maxlength="100"></td>
  </tr>
  <tr> 
   <td width="150" class="label">Description</td>
   <td class="content"> <textarea name="mtxDescription" cols="70" rows="10" class="box" id="mtxDescription"><?php echo $pd_description; ?></textarea></td>
  </tr>
  <tr> 
   <td width="150" class="label">Price</td>
   <td class="content"><input name="txtPrice" type="text" class="box" id="txtPrice" value="<?php echo $pd_price; ?>" size="10" maxlength="7"> </td>
  </tr>
  <tr> 
   <td width="150" class="label">Qty In Stock</td>
   <td class="content"><input name="txtQty" type="text" class="box" id="txtQty" value="<?php echo $pd_qty;  ?>" size="10" maxlength="10"> </td>
  </tr>
  <tr> 
   <td width="150" class="label">Image</td>
   <td class="content"> <input name="fleImage" type="file" id="fleImage" class="box">
<?php
	if ($pd_thumbnail != '') {
?>
    <br>
    <img src="<?php echo WEB_ROOT . PRODUCT_IMAGE_DIR . $pd_thumbnail; ?>"> &nbsp;&nbsp;<a href="javascript:deleteImage(<?php echo $productId; ?>);">Delete 
    Image</a> 
    <?php
	}
?>    
    </td>
  </tr>
 </table>
 <p align="center"> 
  <input name="btnModifyProduct" type="button" id="btnModifyProduct" value="Modify Product" onClick="checkAddProductForm();" class="box">
  &nbsp;&nbsp;<input name="btnCancel" type="button" id="btnCancel" value="Cancel" onClick="window.location.href='index.php';" class="box">  
 </p>
</form>