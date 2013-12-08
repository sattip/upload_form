<?php
if (!defined('WEB_ROOT')) {
	exit;
}

//if (isset($_GET['catId']) && (int)$_GET['catId'] > 0) {
//	$catId = (int)$_GET['catId'];
//	$sql2 = " AND p.cat_id = $catId";
//	$queryString = "catId=$catId";
//} else {
//	$catId = 0;
//	$sql2  = '';
//	$queryString = '';
//}
//$rowsPerPage = 5;
//
//$sql = "SELECT pd_id, c.cat_id, cat_name, pd_name, pd_thumbnail
//        FROM tbl_product p, tbl_category c
//		WHERE p.cat_id = c.cat_id $sql2
//		ORDER BY pd_name";
//$result     = dbQuery(getPagingQuery($sql, $rowsPerPage));
//$pagingLink = getPagingLink($sql, $rowsPerPage, $queryString);

//$categoryList = buildCategoryOptionss($catId);

 
if (isset($_GET['catId']) && (int)$_GET['catId'] >= 0) {
	$catId = (int)$_GET['catId'];
	$queryString = "&catId=$catId";
} else {
	$catId = 0;
	$queryString = '';
}
//	
// for paging
// how many rows to show per page
$rowsPerPage = 5;

$sql = "SELECT cat_id, cat_parent_id, cat_name, cat_description, cat_image
        FROM tbl_category
		WHERE cat_parent_id = $catId
		ORDER BY cat_name";
$result     = dbQuery(getPagingQuery($sql, $rowsPerPage));
$pagingLink = getPagingLink($sql, $rowsPerPage);
?>
 
<form action="processCategory.php?action=addCategory" method="post"  name="frmListCategory" id="frmListCategory">
 <table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" class="text">
  <tr align="center" id="listTableHeader"> 
   <td>Category Name</td>
   <td>Description</td>
   <td width="75">Image</td>
   <td width="75">Modify</td>
   <td width="75">Delete</td>
  </tr>
  <?php
$cat_parent_id = 0;
if (dbNumRows($result) > 0) {
	$i = 0;
	
	while($row = dbFetchAssoc($result)) {
		extract($row);
		
		if ($i%2) {
			$class = 'row1';
		} else {
			$class = 'row2';
		}
		
		$i += 1;
		
		if ($cat_parent_id == 0) {
			$cat_name = "<a href=\"index.php?catId=$cat_id\">$cat_name</a>";
		}
		
		if ($cat_image) {
			$cat_image = WEB_ROOT . 'images/category/' . $cat_image;
		} else {
			$cat_image = WEB_ROOT . 'images/no-image-small.png';
		}		
?>
  <tr class="<?php echo $class; ?>"> 
   <td><?php echo $cat_name; ?></td>
   <td><?php echo nl2br($cat_description); ?></td>
   <td width="75" align="center"><img src="<?php echo $cat_image; ?>"></td>
   <td width="75" align="center"><a href="javascript:modifyCategory(<?php echo $cat_id; ?>);">Modify</a></td>
   <td width="75" align="center"><a href="javascript:deleteCategory(<?php echo $cat_id; ?>);">Delete</a></td>
  </tr>
  <?php
	} // end while


?>
  <tr> 
   <td colspan="5" align="center">
   <?php 
   echo $pagingLink;
   ?></td>
  </tr>
<?php	
} else {
?>
  <tr> 
   <td colspan="5" align="center">No Categories Yet</td>
  </tr>
  <?php
}
?>
  <tr> 
   <td colspan="5">&nbsp;</td>
  </tr>
  <tr> 
   <td colspan="5" align="right"> <input name="btnAddCategory" type="button" id="btnAddCategory" value="Add Category" class="box" onClick="addCategory(<?php echo $catId; ?>)"> 
   </td>
  </tr>
 </table>
 <p>&nbsp;</p>
</form>