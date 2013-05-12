//Adapted for Etomite by Cris D
//save as a snippet called "shop_productList.php"

$productsPerRow  = isset($productsPerRow)  ? $productsPerRow: 2;//set in shop_controller snippet
$productsPerPage = isset($productsPerPage) ? $productsPerPage: 4;//set in shop_conroller snippet

//$productList    = getProductList($catId);
$children = array_merge(array($catId), getChildCategories(NULL, $catId));
$children = ' (' . implode(', ', $children) . ')';

$sql = "SELECT pd_id, pd_name, pd_price, pd_thumbnail, pd_qty, c.cat_id
		FROM tbl_product pd, tbl_category c
		WHERE pd.cat_id = c.cat_id AND pd.cat_id IN $children 
		ORDER BY pd_name";
$result     = dbQuery(getPagingQuery($sql, $productsPerPage));
$pagingLink = getPagingLink($sql, $productsPerPage, "c=$catId");
$numProduct = dbNumRows($result);

// the product images are arranged in a table. to make sure
// each image gets equal space set the cell width here
$columnWidth = (int)(100 / $productsPerRow);
$output .="
<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"20\">";

if ($numProduct > 0 ) {

	$i = 0;
	while ($row = dbFetchAssoc($result)) {
	
		extract($row);
		if ($pd_thumbnail) {
			$pd_thumbnail = WEB_ROOT . 'images/product/' . $pd_thumbnail;
		} else {
			$pd_thumbnail = WEB_ROOT . 'images/no-image-small.png';
		}
	
		if ($i % $productsPerRow == 0) {
			$output .= '<tr>';
		}

		// format how we display the price
		$pd_price = displayAmount($pd_price);
		
		$output .= "<td width=\"$columnWidth%\" align=\"center\"><a href=\"" . $etomite->makeURL($etomite->documentIdentifier,'',"?c=".$catId."&p=".$pd_id."") . "\"><img src=\"$pd_thumbnail\" border=\"0\"><br>$pd_name</a><br>Price : $pd_price";

		// if the product is no longer in stock, tell the customer
		if ($pd_qty <= 0) {
			$output .= "<br>Out Of Stock";
		}
		
		$output .= "</td>\r\n";
	
		if ($i % $productsPerRow == $productsPerRow - 1) {
			$output .= '</tr>';
		}
		
		$i += 1;
	}
	
	if ($i % $productsPerRow > 0) {
		$output .= '<td colspan="' . ($productsPerRow - ($i % $productsPerRow)) . '">&nbsp;</td>';
	}
	
} else {

	$output .="<tr><td width=\"100%\" align=\"center\" valign=\"center\">No products in this category</td></tr>";

}	
$output .="</table>";
$output .="<p align=\"center\">$pagingLink</p>";

return $output;