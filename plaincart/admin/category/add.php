<?php
if (!defined('WEB_ROOT')) {
	exit;
}


$parentId = (isset($_GET['parentId']) && $_GET['parentId'] > 0) ? $_GET['parentId'] : 0;
?> 

<form action="processCategory.php?action=add" method="post" enctype="multipart/form-data" name="frmCategory" id="frmCategory">
 <p align="center" class="formTitle">Add Category</p>
 
 <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
  <tr> 
   <td width="150" class="label">Category Name</td>
   <td class="content"> <input name="txtName" type="text" class="box" id="txtName" size="30" maxlength="50"></td>
  </tr>
  <tr> 
   <td width="150" class="label">Description</td>
   <td class="content"> <textarea name="mtxDescription" cols="50" rows="4" class="box" id="mtxDescription"></textarea></td>
  </tr>
  <tr> 
   <td width="150" class="label">Image</td>
   <td class="content"> <input name="fleImage" type="file" id="fleImage" class="box"> 
    <input name="hidParentId" type="hidden" id="hidParentId" value="<?php echo $parentId; ?>"></td>
  </tr>
 </table>
 <p align="center"> 
  <input name="btnAddCategory" type="button" id="btnAddCategory" value="Add Category" onClick="checkCategoryForm();" class="box">
  &nbsp;&nbsp;<input name="btnCancel" type="button" id="btnCancel" value="Cancel" onClick="window.location.href='index.php?catId=<?php echo $parentId; ?>';" class="box">  
 </p>
</form>