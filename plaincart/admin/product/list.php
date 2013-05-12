<?php
if (!defined('WEB_ROOT')) {
	exit;
}


if (isset($_GET['catId']) && (int)$_GET['catId'] > 0) {
	$catId = (int)$_GET['catId'];
	$sql2 = " AND p.cat_id = $catId";
	$queryString = "catId=$catId";
} else {
	$catId = 0;
	$sql2  = '';
	$queryString = '';
}

// for paging
// how many rows to show per page
$rowsPerPage = 5;

$sql = "SELECT pd_id, c.cat_id, cat_name, pd_name, pd_thumbnail
        FROM tbl_product p, tbl_category c
		WHERE p.cat_id = c.cat_id $sql2
		ORDER BY pd_name";
$result     = dbQuery(getPagingQuery($sql, $rowsPerPage));
$pagingLink = getPagingLink($sql, $rowsPerPage, $queryString);

$categoryList = buildCategoryOptions($catId);

?> 
<p>&nbsp;</p>
<form action="processProduct.php?action=addProduct" method="post"  name="frmListProduct" id="frmListProduct">
 <table width="100%" border="0" cellspacing="0" cellpadding="2" class="text">
  <tr>
   <td align="right">&Pi;&rho;&omicron;ϊό&nu;&tau;&alpha; &sigma;&epsilon; : 
     <select name="cboCategory" class="box" id="cboCategory" onChange="viewProduct();">
     <option selected>Όλες οι κατηγορίες</option>
	<?php echo $categoryList; ?>
   </select>
 </td>
 </tr>
</table>
<br>
 <table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" class="text">
  <tr align="center" id="listTableHeader"> 
   <td>Ό&nu;&omicron;&mu;&alpha; &Pi;&rho;&omicron;ϊό&nu;&tau;&omicron;&sigmaf;</td>
   <td width="75">&Epsilon;&iota;&kappa;ό&nu;&alpha;</td>
   <td width="75">&Kappa;&alpha;&tau;&eta;&gamma;&omicron;&rho;ί&alpha;</td>
   <td width="70">&Epsilon;&pi;&epsilon;&xi;&epsilon;&rho;&gamma;&alpha;&sigma;ί&alpha;</td>
   <td width="70">&Delta;&iota;&alpha;&gamma;&rho;&alpha;&phi;ή</td>
  </tr>
  <?php
$parentId = 0;
if (dbNumRows($result) > 0) {
	$i = 0;
	
	while($row = dbFetchAssoc($result)) {
		extract($row);
		
		if ($pd_thumbnail) {
			$pd_thumbnail = WEB_ROOT . 'images/product/' . $pd_thumbnail;
		} else {
			$pd_thumbnail = WEB_ROOT . 'images/no-image-small.png';
		}	
		
		
		
		if ($i%2) {
			$class = 'row1';
		} else {
			$class = 'row2';
		}
		
		$i += 1;
?>
  <tr class="<?php echo $class; ?>"> 
   <td><a href="index.php?view=detail&productId=<?php echo $pd_id; ?>"><?php echo $pd_name; ?></a></td>
   <td width="75" align="center"><img src="<?php echo $pd_thumbnail; ?>"></td>
   <td width="75" align="center"><a href="?c=<?php echo $cat_id; ?>"><?php echo $cat_name; ?></a></td>
   <td width="70" align="center"><a href="javascript:modifyProduct(<?php echo $pd_id; ?>);">&Epsilon;&pi;&epsilon;&xi;&epsilon;&rho;&gamma;&alpha;&sigma;ί&alpha;</a></td>
   <td width="70" align="center"><a href="javascript:deleteProduct(<?php echo $pd_id; ?>, <?php echo $catId; ?>);">&Delta;&Iota;&alpha;&gamma;&rho;&alpha;&phi;ή</a></td>
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
   <td colspan="5" align="center">&Delta;&epsilon;&nu; &upsilon;&pi;ά&rho;&chi;&omicron;&upsilon;&nu; &Pi;&rho;&omicron;ϊό&nu;&tau;&alpha; &alpha;&kappa;ό&mu;&alpha;</td>
  </tr>
  <?php
}
?>
  <tr> 
   <td colspan="5">&nbsp;</td>
  </tr>
  <tr> 
   <td colspan="5" align="right"><input name="btnAddProduct" type="button" id="btnAddProduct" value="&Pi;&rho;&omicron;&sigma;&theta;ή&kappa;&eta; &Pi;&rho;&omicron;ϊό&nu;&tau;&omicron;&sigmaf;" class="box" onClick="addProduct(<?php echo $catId; ?>)"></td>
  </tr>
 </table>
 <p>&nbsp;</p>
</form>