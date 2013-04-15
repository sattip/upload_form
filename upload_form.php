<?php

$first_name = $_POST["first_name"];
$last_name = $_POST["last_name"];

if ($_FILES["file"]["error"] > 0){
   echo "Error: " . $_FILES["file"]["error"] . "<br>";
}else{
   echo "Upload: " . $_FILES["file"]["name"] . "<br>";
   echo "Type: " . $_FILES["file"]["type"] . "<br>";
   echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
   move_uploaded_file($_FILES["file"]["tmp_name"],"upload/" . $_FILES["file"]["name"]);
   echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
   $imagepath = "upload/" . $_FILES["file"]["name"];
}


// display the output
  echo "<p>";
  echo "First Name: $first_name<br />";
  echo "Last Name: $last_name<br />";
  echo "</p>";


?>
<img src="<? echo $imagepath; ?>">
