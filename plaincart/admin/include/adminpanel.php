<?php

if (!defined('WEB_ROOT')) {
	exit;
}
if (isset($_GET['function'])){
      doLogout();
}

$self = WEB_ROOT . 'admin/main.php';
?>
<html>
<head>
    <?php
$n = count($script);
for ($i = 0; $i < $n; $i++) {
	if ($script[$i] != '') {
		echo '<script language="JavaScript" type="text/javascript" src="' . WEB_ROOT. 'admin/library/' . $script[$i]. '"></script>';
	}
}
?>
<title>Admin MOS Template</title>
 <link href="<?php echo WEB_ROOT;?>admin/include/admin.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="<?php echo WEB_ROOT;?>library/common.js"></script>
<link rel="shortcut icon" href="stylesheet/img/devil-icon.png"> <!--Pemanggilan gambar favicon-->
<link rel="stylesheet" type="text/css" href="mos-css/mos-style.css"> <!--pemanggilan file css-->
</head>

<body>
<div id="header">
	<div class="inHeader">
		<div class="mosAdmin">
                     <?php $name =$_SESSION['user_name']; ?>
		Hallo, <?php echo $name; ?><br>
		<a href=""supa website</a> | <a href="">supasite</a> 
	<div class="clear"></div>
	</div>
</div>

<div id="wrapper">
	<div id="leftBar">
	<ul>
            <tr>
    <td width="150" valign="top" class="navArea"><p>&nbsp;</p>
		<li> <a href="<?php echo WEB_ROOT; ?>admin/">Home</a></li>
		<li><a href="<?php echo WEB_ROOT; ?>admin/category/" >MainCategory</a></li>
             <li><a href="<?php echo WEB_ROOT; ?>admin/subcategory/" >SubCategory</a></li>
<!--                <li><a href="<?php echo WEB_ROOT; ?>admin/sub/" >SubCatadd</a></li>-->
		<li><a href="<?php echo WEB_ROOT; ?>admin/product/" >Product</a></li>
                
		<li><a href="<?php echo WEB_ROOT; ?>admin/order/?status=Paid" >Order</a> </li>
		<li><a href="<?php echo WEB_ROOT; ?>admin/config/" >Shop Config</a></li>
		<li><a href="<?php echo WEB_ROOT; ?>admin/user/" >User</a></li>
                 <li><a href="?function">Logout</a></li>
                    <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p></td>
	</ul>   
	</div>
	<div id="rightContent">
             <td width="600" valign="top" class="contentArea"><table width="100%" border="0" cellspacing="0" cellpadding="20">
        <tr>
          <td>
            <?php
require_once $content;	 
?>
<!--	<h3>Dashboard</h3>
	<div class="quoteOfDay">
	<b>Quote of the day :</b><br>
	<i style="color: #5b5b5b;">"If you think you can, you really can"</i>
	</div>
		<div class="shortcutHome">
		<a href=""><img src="mos-css/img/posting.png"><br>Tambah Posting</a>
		</div>
		<div class="shortcutHome">
		<a href=""><img src="mos-css/img/photo.png"><br>Upload Foto</a>
		</div>
		<div class="shortcutHome">
		<a href=""><img src="mos-css/img/halaman.png"><br>Tambah Halaman</a>
		</div>
		<div class="shortcutHome">
		<a href=""><img src="mos-css/img/template.png"><br>Pengaturan Template</a>
		</div>
		<div class="shortcutHome">
		<a href=""><img src="mos-css/img/quote.png"><br>Tambah QOD</a>
		</div>
		<div class="shortcutHome">
		<a href=""><img src="mos-css/img/bukutamu.png"><br>Data Buku Tamu</a>
		</div>
		
		<div class="clear"></div>
		
		<div id="smallRight"><h3>Informasi web anda</h3>
		<table style="border: none;font-size: 12px;color: #5b5b5b;width: 100%;margin: 10px 0 10px 0;">
			<tr><td style="border: none;padding: 4px;">Jumlah posting</td><td style="border: none;padding: 4px;"><b>12</b></td></tr>
			<tr><td style="border: none;padding: 4px;">Jumlah kategori</td><td style="border: none;padding: 4px;"><b>12</b></td></tr>
			<tr><td style="border: none;padding: 4px;">Jumlah komentar diterbitkan</td><td style="border: none;padding: 4px;"><b>12</b></td></tr>
			<tr><td style="border: none;padding: 4px;">Jumlah komentar belum diterbitkan</td><td style="border: none;padding: 4px;"><b>12</b></td></tr>
			<tr><td style="border: none;padding: 4px;">Jumlah foto dalam galeri</td><td style="border: none;padding: 4px;"><b>12</b></td></tr>
			<tr><td style="border: none;padding: 4px;">Jumlah data buku tamu</td><td style="border: none;padding: 4px;"><b>12</b></td></tr>
		</table>
		</div>
		<div id="smallRight"><h3>Statistik pengunjung web</h3>
		
		<table style="border: none;font-size: 12px;color: #5b5b5b;width: 100%;margin: 10px 0 10px 0;">
			<tr><td style="border: none;padding: 4px;">Pengunjung online</td><td style="border: none;padding: 4px;"><b>12</b></td></tr>
			<tr><td style="border: none;padding: 4px;">Pengunjung hari ini</td><td style="border: none;padding: 4px;"><b>12</b></td></tr>
			<tr><td style="border: none;padding: 4px;">Total pengunjung</td><td style="border: none;padding: 4px;"><b>12</b></td></tr>
			<tr><td style="border: none;padding: 4px;">Hit hari ini</td><td style="border: none;padding: 4px;"><b>12</b></td></tr>
			<tr><td style="border: none;padding: 4px;">Total hit</td><td style="border: none;padding: 4px;"><b>12</b></td></tr>
		</table>
		</div>-->
          </td>
        </tr>
      </td>
  </tr>
</table>
	</div>
<div class="clear"></div>
<div id="footer">
	
</div>
</div>
</body>
</html>