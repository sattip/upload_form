<?php
if (!defined('WEB_ROOT')) {
	exit;
}
?>
<p>&nbsp;</p>
<table width="100%" border="0" cellspacing="0" cellpadding="10">
 <tr>
  <td align="center">
   <p>&copy; <?php echo '2005 - ' . date('Y'); ?> <?php echo $shopConfig['name']; ?></p>
   <p>Address : <?php echo $shopConfig['address']; ?><br>
    Phone : <?php echo $shopConfig['phone']; ?><br>
    Email : <a href="mailto:<?php echo $shopConfig['email']; ?>"><?php echo $shopConfig['email']; ?></a></p>
   <p><br>
   </p></td>
 </tr>
</table>
</body>
</html>