<?php
 require_once '../library/config.php';

 

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
	
    case 'modify' :
        modifyprofile();
        break;
    

    default :
        // if action is not defined or unknown
        // move to main page
//        header('Location: index.php');
        echo 'failure';
}



function modifyprofile()
{
         $id = $_POST['id'];
	 
	$address   = $_POST['mtxAddress'];
	$phone     = $_POST['txtPhone'];
	$email     = $_POST['txtEmail'];
	
	
    $sql = "UPDATE  tbl_user
            SET  address='$address',phone='$phone',email='$email'  WHERE user_id='$id'";
    $result = mysql_query($sql);
 
 	header("Location: ../profile.php");    
}

?>