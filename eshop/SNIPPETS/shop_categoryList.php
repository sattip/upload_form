//Adapted for Etomite by Cris D.
//Save in snippet library as "shop_categoryList.php"

$categoryList    = getCategoryList();
$categoriesPerRow = isset($categoriesPerRow) ? $categoriesPerRow: 3;//set in shop_controller snippet
$numCategory     = count($categoryList);
$columnWidth    = (int)(100 / $categoriesPerRow);
$output .="<!--shop_categoryList snippet-->
<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"20\" >";

if ($numCategory > 0) {
	$i = 0;
	for ($i; $i < $numCategory; $i++) {
		if ($i % $categoriesPerRow == 0) {
			$output .= '<tr>';
		}
		
		// we have $url, $image, $name, $price
		extract ($categoryList[$i]);
	
		$output .= "<!--shop_categoryList snippet-->
		<td width=\"$columnWidth%\" align=\"center\"><a href=\"$url\"><img src=\"$image\" border=\"0\"><br>$name</a></td>\r\n";
	
	
		if ($i % $categoriesPerRow == $categoriesPerRow - 1) {
			$output .= '</tr>';
		}
		
	}
	
	if ($i % $categoriesPerRow > 0) {
		$output .='<td colspan="' . ($categoriesPerRow - ($i % $categoriesPerRow)) . '">&nbsp;</td>';
	}

} else {

	$output .= "<!--shop_categoryList snippet--><tr><td width=\"100%\" align=\"center\" valign=\"center\">No categories yet</td></tr>";

}	
$output .="<!--shop_categoryList snippet--></table>";

return $output;