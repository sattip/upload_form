<?php
include("database.php");

$first_name = mysql_real_escape_string($_POST["first_name"]);
$last_name = mysql_real_escape_string($_POST["last_name"]);

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


mysql_query("INSERT INTO `uploadform`.`users` (`id`, `firstname`, `lastname`, `photo`) VALUES (NULL, '$first_name', '$last_name', '$imagepath');") or die(mysql_error());

// display the output
  echo "<p>";
  echo "First Name: $first_name<br />";
  echo "Last Name: $last_name<br />";
  echo "</p>";


?>
<img src="<?php echo $imagepath; ?>" width="200px">
