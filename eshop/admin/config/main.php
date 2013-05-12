<?php
if (!defined('WEB_ROOT')) {
	exit;
}

// get current configuration
$sql = "SELECT sc_name, sc_address, sc_phone, sc_email, sc_shipping_cost, sc_currency, sc_order_email
        FROM tbl_shop_config";
$result = dbQuery($sql);

// extract the shop config fetched from database
// make sure we query return a row
if (dbNumRows($result) > 0) {
	extract(dbFetchAssoc($result));
} else {
	// since the query didn't return any row ( maybe because you don't run plaincart.sql as is )
	// we just set blank values for all variables
	$sc_name = $sc_address = $sc_phone = $sc_email = $sc_shipping_cost = $sc_currency = '';
	$sc_order_email = 'y';
}

// get available currencies
$sql = "SELECT cy_id, cy_code
        FROM tbl_currency
		ORDER BY cy_code";
$result = dbQuery($sql);

$currency = '';
while ($row = dbFetchAssoc($result)) {
	extract($row);
	$currency .= "<option value=\"$cy_id\"";
	if ($cy_id == $sc_currency) {
		$currency .= " selected";
	}
	
	$currency .= ">$cy_code</option>\r\n";
}		
?>
<p>&nbsp;</p>
<form action="processConfig.php?action=modify" method="post" name="frmConfig" id="frmConfig">
 <table width="100%" border="0" cellspacing="1" cellpadding="2" class="entryTable">
  <tr id="entryTableHeader"> 
   <td colspan="2">Shop Configuration</td>
  </tr>
  <tr> 
   <td width="150" class="label">Shop Name</td>
   <td class="content"><input name="txtShopName" type="text" class="box" id="txtShopName" value="<?php echo $sc_name; ?>" size="50" maxlength="50"></td>
  </tr>
  <tr> 
   <td width="150" class="label">Address</td>
   <td class="content"><textarea name="mtxAddress" cols="50" rows="3" id="mtxAddress" class="box"><?php echo $sc_address; ?></textarea></td>
  </tr>
  <tr> 
   <td width="150" class="label">Telephone</td>
   <td class="content"><input name="txtPhone" type="text" class="box" id="txtPhone" value="<?php echo $sc_phone; ?>" size="30" maxlength="30"></td>
  </tr>
  <tr> 
   <td class="label">Email</td>
   <td class="content"><input name="txtEmail" type="text" class="box" id="txtEmail" value="<?php echo $sc_email; ?>" size="30" maxlength="30"></td>
  </tr>
 </table>
 <p>&nbsp;</p>
 <table width="100%" border="0" cellspacing="1" cellpadding="2" class="entryTable">
  <tr id="entryTableHeader"> 
   <td colspan="2">Misc. Configuration</td>
  </tr>
  <tr> 
   <td width="150" class="label">Currency</td>
   <td class="content"><select name="cboCurrency" id="cboCurrency" class="box">
<?php echo $currency; ?>
    </select>   </td>
  </tr>
  <tr> 
   <td width="150" class="label">Shipping Cost</td>
   <td class="content"><input name="txtShippingCost" type="text" class="box" id="txtShippingCost" value="<?php echo $sc_shipping_cost; ?>" size="5"></td>
  </tr>
  <tr>
    <td class="label">Send Email on New Order </td>
    <td class="content"><input name="optSendEmail" type="radio" value="y" id="optEmail" <?php echo $sc_order_email == 'y' ? 'checked' : ''; ?> />
      <label for="optsEmail">Yes </label>
      <input name="optSendEmail" type="radio" value="n" id="optNoEmail" <?php echo $sc_order_email == 'n' ? 'checked' : ''; ?> />
      <label for="optNoEmail">No</label></td>
  </tr>
 </table>
 <p align="center"> 
  <input name="btnUpdate" type="submit" id="btnUpdate" value="Update Config" class="box">
 </p>
</form>
