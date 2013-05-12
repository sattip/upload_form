<?php
require_once 'config.php';

/*********************************************************
*                 CATEGORY FUNCTIONS 
*********************************************************/

/*
	Return the current category list which only shows
	the currently selected category and it's children.
	This function is made so it can also handle deep 
	category levels ( more than two levels )
*/
function formatCategories($categories, $parentId)
{
	// $navCat stores all children categories
	// of $parentId
	$navCat = array();
	
	// expand only the categories with the same parent id
	// all other remain compact
	$ids = array();
	foreach ($categories as $category) {
		if ($category['cat_parent_id'] == $parentId) {
			$navCat[] = $category;
		}
		
		// save the ids for later use
		$ids[$category['cat_id']] = $category;
	}	

	$tempParentId = $parentId;
	
	// keep looping until we found the 
	// category where the parent id is 0
	while ($tempParentId != 0) {
		$parent    = array($ids[$tempParentId]);
		$currentId = $parent[0]['cat_id'];

		// get all categories on the same level as the parent
		$tempParentId = $ids[$tempParentId]['cat_parent_id'];
		foreach ($categories as $category) {
		    // found one category on the same level as parent
			// put in $parent if it's not already in it
			if ($category['cat_parent_id'] == $tempParentId && !in_array($category, $parent)) {
				$parent[] = $category;
			}
		}
		
		// sort the category alphabetically
		array_multisort($parent);
	
		// merge parent and child
		$n = count($parent);
		$navCat2 = array();
		for ($i = 0; $i < $n; $i++) {
			$navCat2[] = $parent[$i];
			if ($parent[$i]['cat_id'] == $currentId) {
				$navCat2 = array_merge($navCat2, $navCat);
			}
		}
		
		$navCat = $navCat2;
	}


	return $navCat;
}

/*
	Get all top level categories
*/
function getCategoryList()
{
	$sql = "SELECT cat_id, cat_name, cat_image
	        FROM tbl_category
			WHERE cat_parent_id = 0
			ORDER BY cat_name";
    $result = dbQuery($sql);
    
    $cat = array();
    while ($row = dbFetchAssoc($result)) {
		extract($row);
		
		if ($cat_image) {
			$cat_image = WEB_ROOT . 'images/category/' . $cat_image;
		} else {
			$cat_image = WEB_ROOT . 'images/no-image-small.png';
		}
		
		$cat[] = array('url'   => $_SERVER['PHP_SELF'] . '?c=' . $cat_id,
		               'image' => $cat_image,
					   'name'  => $cat_name);

    }
	
	return $cat;			
}

/*
	Fetch all children categories of $id. 
	Used for display categories
*/
function getChildCategories($categories, $id, $recursive = true)
{
	if ($categories == NULL) {
		$categories = fetchCategories();
	}
	
	$n     = count($categories);
	$child = array();
	for ($i = 0; $i < $n; $i++) {
		$catId    = $categories[$i]['cat_id'];
		$parentId = $categories[$i]['cat_parent_id'];
		if ($parentId == $id) {
			$child[] = $catId;
			if ($recursive) {
				$child   = array_merge($child, getChildCategories($categories, $catId));
			}	
		}
	}
	
	return $child;
}

function fetchCategories()
{
    $sql = "SELECT cat_id, cat_parent_id, cat_name, cat_image, cat_description
	        FROM tbl_category
			ORDER BY cat_id, cat_parent_id ";
    $result = dbQuery($sql);
    
    $cat = array();
    while ($row = dbFetchAssoc($result)) {
        $cat[] = $row;
    }
	
	return $cat;
}

?>