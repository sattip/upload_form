<?php
if (!defined('WEB_ROOT')) {
	exit;
}

if (!isset($_GET['oid']) || (int)$_GET['oid'] <= 0) {
	header('Location: index.php');
}

$orderId = (int)$_GET['oid'];

// get ordered items
$sql = "SELECT pd_name, pd_price, od_qty
	    FROM tbl_order_item oi, tbl_product p 
		WHERE oi.pd_id = p.pd_id and oi.od_id = $orderId
		ORDER BY od_id ASC";

$result = dbQuery($sql);
$orderedItem = array();
while ($row = dbFetchAssoc($result)) {
	$orderedItem[] = $row;
}


// get order information
$sql = "SELECT od_date, od_last_update, od_status, od_shipping_first_name, od_shipping_last_name, od_shipping_address1, 
               od_shipping_address2, od_shipping_phone, od_shipping_state, od_shipping_city, od_shipping_postal_code, od_shipping_cost, 
			   od_payment_first_name, od_payment_last_name, od_payment_address1, od_payment_address2, od_payment_phone,
			   od_payment_state, od_payment_city , od_payment_postal_code,
			   od_memo
	    FROM tbl_order 
		WHERE od_id = $orderId";

$result = dbQuery($sql);
extract(dbFetchAssoc($result));

$orderStatus = array('New', 'Paid', 'Shipped', 'Completed', 'Cancelled');
$orderOption = '';
foreach ($orderStatus as $status) {
	$orderOption .= "<option value=\"$status\"";
	if ($status == $od_status) {
		$orderOption .= " selected";
	}
	
	$orderOption .= ">$status</option>\r\n";
}
?>
<p>&nbsp;</p>
<form action="" method="get" name="frmOrder" id="frmOrder">
    <table width="550" border="0"  align="center" cellpadding="5" cellspacing="1" class="detailTable">
        <tr> 
            <td colspan="2" align="center" id="infoTableHeader">&Pi;&lambda;&eta;&rho;&omicron;&phi;&omicron;&rho;?&epsilon;&sigmaf; &Pi;&alpha;&rho;&alpha;&gamma;&gamma;&epsilon;&lambda;?&alpha;&sigmaf;</td>
        </tr>
        <tr> 
            <td width="150" class="label">&Alpha;&rho;&iota;&theta;&mu;u&sigmaf; &Pi;&alpha;&rho;&alpha;&alpha;&gamma;&gamma;&epsilon;&lambda;?&alpha;&sigmaf;</td>
            <td class="content"><?php echo $orderId; ?></td>
        </tr>
        <tr> 
            <td width="150" class="label">&Eta;&mu;&epsilon;&rho;&omicron;&mu;&eta;&nu;?&alpha; &Pi;&alpha;&rho;&alpha;&gamma;&gamma;&epsilon;&lambda;?&alpha;&sigmaf;</td>
            <td class="content"><?php echo $od_date; ?></td>
        </tr>
        <tr> 
            <td width="150" class="label">&Tau;&epsilon;&lambda;&epsilon;&upsilon;&tau;&alpha;?&alpha; &Epsilon;&nu;&eta;&mu;Y&rho;&omega;&sigma;&eta;</td>
            <td class="content"><?php echo $od_last_update; ?></td>
        </tr>
        <tr> 
            <td class="label">&Kappa;&alpha;&tau;U&sigma;&tau;&alpha;&sigma;&eta;</td>
            <td class="content"> <select name="cboOrderStatus" id="cboOrderStatus" class="box">
                    <?php echo $orderOption; ?> </select> <input name="btnModify" type="button" id="btnModify" value="Aeeaa? EaoUooaoco" class="box" onClick="modifyOrderStatus(<?php echo $orderId; ?>);"></td>
        </tr>
    </table>
</form>
<p>&nbsp;</p>
<table width="550" border="0"  align="center" cellpadding="5" cellspacing="1" class="detailTable">
    <tr id="infoTableHeader"> 
        <td colspan="3">&Pi;&rho;&omicron;uu&nu;&tau;&alpha; &Pi;&alpha;&rho;&alpha;&gamma;&gamma;&epsilon;&lambda;?&alpha;&sigmaf;</td>
    </tr>
    <tr align="center" class="label"> 
        <td>&Pi;&rho;&omicron;uu&nu;</td>
        <td>&Tau;&iota;&mu;? &Tau;&epsilon;&mu;&alpha;&chi;&epsilon;?&omicron;&upsilon;</td>
        <td>&Sigma;y&nu;&omicron;&lambda;&omicron;</td>
    </tr>
    <?php
$numItem  = count($orderedItem);
$subTotal = 0;
for ($i = 0; $i < $numItem; $i++) {
	extract($orderedItem[$i]);
	$subTotal += $pd_price * $od_qty;
?>
    <tr class="content"> 
        <td><?php echo "$od_qty X $pd_name"; ?></td>
        <td align="right"><?php echo displayAmount($pd_price); ?></td>
        <td align="right"><?php echo displayAmount($od_qty * $pd_price); ?></td>
    </tr>
    <?php
}
?>
    <tr class="content"> 
        <td colspan="2" align="right">&Upsilon;&pi;&omicron;-&sigma;y&nu;&omicron;&lambda;&omicron;</td>
        <td align="right"><?php echo displayAmount($subTotal); ?></td>
    </tr>
    <tr class="content"> 
        <td colspan="2" align="right">&Mu;&epsilon;&tau;&alpha;&phi;&omega;&rho;&iota;&kappa;U</td>
        <td align="right"><?php echo displayAmount($od_shipping_cost); ?></td>
    </tr>
    <tr class="content"> 
        <td colspan="2" align="right">&Sigma;y&nu;&omicron;&lambda;&omicron;</td>
        <td align="right"><?php echo displayAmount($od_shipping_cost + $subTotal); ?></td>
    </tr>
</table>
<p>&nbsp;</p>
<table width="550" border="0"  align="center" cellpadding="5" cellspacing="1" class="detailTable">
    <tr id="infoTableHeader"> 
        <td colspan="2">&Pi;&lambda;&eta;&rho;&omicron;&phi;&omicron;&rho;?&epsilon;&sigmaf; &Pi;&alpha;&rho;U&delta;&omega;&sigma;&eta;&sigmaf;</td>
    </tr>
    <tr> 
        <td width="150" class="label">&Epsilon;&pi;?&nu;&upsilon;&mu;&omicron;</td>
        <td class="content"><?php echo $od_shipping_first_name; ?> </td>
    </tr>
    <tr> 
        <td width="150" class="label">?&nu;&omicron;&mu;&alpha;</td>
        <td class="content"><?php echo $od_shipping_last_name; ?> </td>
    </tr>
    <tr> 
        <td width="150" class="label">&Delta;&iota;&epsilon;y&theta;&upsilon;&nu;&sigma;&eta;</td>
        <td class="content"><?php echo $od_shipping_address1; ?> </td>
    </tr>
    
<tr> 
        <td width="150" class="label">&Tau;&eta;&lambda;Y&phi;&omega;&nu;&omicron;</td>
        <td class="content"><?php echo $od_shipping_phone; ?> </td>
    </tr>
    <tr> 
        <td width="150" class="label">&Chi;?&rho;&alpha;</td>
        <td class="content"><?php echo $od_shipping_state; ?> </td>
    </tr>
    <tr> 
        <td width="150" class="label">&Pi;u&lambda;&eta;</td>
        <td class="content"><?php echo $od_shipping_city; ?> </td>
    </tr>
    <tr> 
        <td width="150" class="label">&Tau;&alpha;&chi;&upsilon;&delta;&rho;&omicron;&mu;&iota;&kappa;u&sigmaf; &Kappa;?&delta;&iota;&kappa;&alpha;&sigmaf;</td>
        <td class="content"><?php echo $od_shipping_postal_code; ?> </td>
    </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p align="center"> 
    <input name="btnBack" type="button" id="btnBack" value="A?eoonio?" class="box" onClick="window.history.back();">
</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
