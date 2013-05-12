<?php
if (!defined('WEB_ROOT')) {
	exit;
}

$self = WEB_ROOT . 'index.php';
?>
<html>
<head>
<title><?php echo $pageTitle; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-7">
<link href="<?php echo WEB_ROOT;?>include/admin.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="<?php echo WEB_ROOT;?>library/common.js"></script>
<?php
$n = count($script);
for ($i = 0; $i < $n; $i++) {
	if ($script[$i] != '') {
		echo '<script language="JavaScript" type="text/javascript" src="' . WEB_ROOT. 'library/' . $script[$i]. '"></script>';
	}
}
?>
</head>
<body>
<table width="750" border="0" align="center" cellpadding="0" cellspacing="1" class="graybox">
  <tr>
    <td colspan="2"><img src="<?php echo WEB_ROOT; ?>include/banner-top.gif" width="750" height="75"></td>
  </tr>
  <tr>
    <td width="150" valign="top" class="navArea"><p>&nbsp;</p>
      <a href="<?php echo WEB_ROOT; ?>" class="leftnav">Αρχική</a> 
	  <a href="<?php echo WEB_ROOT; ?>category/" class="leftnav">Κατηγορίες</a>
	  <a href="<?php echo WEB_ROOT; ?>product/" class="leftnav">Προϊόντα</a> 
	  <a href="<?php echo WEB_ROOT; ?>order/?status=Paid" class="leftnav">Παραγγελίες</a> 
	  <a href="<?php echo WEB_ROOT; ?>config/" class="leftnav">Ρυθμίσεις</a> 
	  <a href="<?php echo WEB_ROOT; ?>user/" class="leftnav">Χρήστες</a> 
	  <a href="<?php echo $self; ?>?logout" class="leftnav">Έξοδος</a>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="600" valign="top" class="contentArea"><table width="100%" border="0" cellspacing="0" cellpadding="20">
        <tr>
          <td>
<?php
require_once $content;	 
?>
          </td>
        </tr>
      </table></td>
  </tr>
</table>
<p>&nbsp;</p>
<p align="center">Copyright &copy; 2010 - <?php echo date('Y'); ?></p>
</body>
</html>
