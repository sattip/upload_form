<?php
 
require_once '../library/config.php';
require_once './library/functions.php';
//require_once './library/session.php';
 
$errorMessage = '&nbsp;';

if (isset($_POST['txtUserName'],$_POST['txtPassword'])) {
	$result = doLogin();
	
	if ($result != '') {
		$errorMessage = $result;
	}
}

?>
<html>
<head>


<link rel="shortcut icon" href="stylesheet/img/devil-icon.png"> <!--Pemanggilan gambar favicon-->
<link rel="stylesheet" type="text/css" href="mos-css/mos-style.css"> <!--pemanggilan file css-->
</head>

<body>
<div id="header">
	<div class="inHeaderLogin"></div>
</div>

<div id="loginForm">
	<div class="headLoginForm">
	Login Administrator
	</div>
	<div class="fieldLogin">
	 <form method="post" name="frmLogin" id="frmLogin">
	<label>Username</label><br>
	<input name="txtUserName" type="text" class="login" value="admin" size="10" maxlength="20"> <br>
	<label>Password</label><br>
	<input name="txtPassword" type="password" class="login" value="admin" > <br>
        <input name="btnLogin" type="submit" class="button" value="Login"><br>
	</form>
	</div>
</div>
</body>
</html>