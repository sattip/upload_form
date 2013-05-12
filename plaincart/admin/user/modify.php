<?php
if (!defined('WEB_ROOT')) {
	exit;
}

if (isset($_GET['userId']) && (int)$_GET['userId'] > 0) {
	$userId = (int)$_GET['userId'];
} else {
	header('Location: index.php');
}

$errorMessage = (isset($_GET['error']) && $_GET['error'] != '') ? $_GET['error'] : '&nbsp;';

$sql = "SELECT user_name
        FROM tbl_user
        WHERE user_id = $userId";
$result = dbQuery($sql);		
extract(dbFetchAssoc($result));


?> 
<p class="errorMessage"><?php echo $errorMessage; ?></p>
<form action="processUser.php?action=modify" method="post" enctype="multipart/form-data" name="frmAddUser" id="frmAddUser">
 <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
  <tr> 
   <td width="150" class="label">Ό&nu;&omicron;&mu;&alpha; &Chi;&rho;ή&sigma;&tau;&eta;</td>
   <td class="content"><input name="txtUserName" type="text" class="box" id="txtUserName" value="<?php echo $user_name; ?>" size="20" maxlength="20">
    <input name="hidUserId" type="hidden" id="hidUserId" value="<?php echo $userId; ?>"> </td>
  </tr>
  <tr> 
   <td width="150" class="label">&Kappa;&omega;&delta;&iota;&kappa;ό&sigmaf;</td>
   <td class="content"> <input name="txtPassword" type="password" class="box" id="txtPassword" size="20" maxlength="20"></td>
  </tr>
 </table>
 <p align="center"> 
  <input name="btnModifyUser" type="button" id="btnModifyUser" value="Αποθήκευση" onClick="checkAddUserForm();" class="box">
  &nbsp;&nbsp;<input name="btnCancel" type="button" id="btnCancel" value="¶κυρο" onClick="window.location.href='index.php';" class="box">  
 </p>
</form>