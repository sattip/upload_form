<?php
include("database.php");

$content = "";
$query = mysql_query("SELECT  * FROM `users`") or die(mysql_error()); 
while ($entry = mysql_fetch_array($query)) {
	$first_name = $entry["firstname"];
	$last_name = $entry["lastname"];
	$photo = $entry["photo"];
	$content .= "<li>";
	$content .= "<p>$first_name $last_name</p>";
	$content .= "<img src=\"$photo\" width=\"200px\">";
	$content .= "</li>";
}

?>

<!DOCTYPE>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Display Data</title>
	</head>
	<body>
		<ul>
			<?=$content ?>
		</ul>
	</body>
</html>