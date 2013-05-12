<?php
if (!defined('WEB_ROOT')) {
	exit;
}

$sql = "SELECT user_id, user_name, user_regdate, user_last_login
        FROM tbl_user
		ORDER BY user_name";
$result = dbQuery($sql);

?> 
<p>&nbsp;</p>
<form action="processUser.php?action=addUser" method="post"  name="frmListUser" id="frmListUser">
 <table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" class="text">
  <tr align="center" id="listTableHeader"> 
   <td>Ό&nu;&omicron;&mu;&alpha; &Chi;&rho;ή&sigma;&tau;&eta;</td>
   <td width="120">&Eta;&mu;&epsilon;&rho;&omicron;&mu;&eta;&nu;ί&alpha; &Epsilon;&gamma;&gamma;&rho;&alpha;&phi;ή&sigmaf;</td>
   <td width="120">&Tau;&epsilon;&lambda;&epsilon;&upsilon;&tau;&alpha;ί&alpha; &Epsilon;ί&sigma;&omicron;&delta;&omicron;&sigmaf;</td>
   <td width="120">&Alpha;&lambda;&lambda;&alpha;&gamma;ή &Kappa;&omega;&delta;&iota;&kappa;&omicron;ύ</td>
   <td width="70">&Delta;&iota;&alpha;&gamma;&rho;&alpha;&phi;ή</td>
  </tr>
<?php
while($row = dbFetchAssoc($result)) {
	extract($row);
	
	if ($i%2) {
		$class = 'row1';
	} else {
		$class = 'row2';
	}
	
	$i += 1;
?>
  <tr class="<?php echo $class; ?>"> 
   <td><?php echo $user_name; ?></td>
   <td width="120" align="center"><?php echo $user_regdate; ?></td>
   <td width="120" align="center"><?php echo $user_last_login; ?></td>
   <td width="120" align="center"><a href="javascript:changePassword(<?php echo $user_id; ?>);">&Alpha;&lambda;&lambda;&alpha;&gamma;ή &Kappa;&omega;&delta;&iota;&kappa;&omicron;ύ</a></td>
   <td width="70" align="center"><a href="javascript:deleteUser(<?php echo $user_id; ?>);">&Delta;&iota;&alpha;&gamma;&rho;&alpha;&phi;ή</a></td>
  </tr>
<?php
} // end while

?>
  <tr> 
   <td colspan="5">&nbsp;</td>
  </tr>
  <tr> 
   <td colspan="5" align="right"><input name="btnAddUser" type="button" id="btnAddUser" value="Προσθήκη Χρήστη" class="box" onClick="addUser()"></td>
  </tr>
 </table>
 <p>&nbsp;</p>
</form>