<?php

        // This page contains the connection routine for the
	// database as well as getting the ID of the cart, etc

        $jsonStr = file_get_contents("config.json");
        $config = json_decode($jsonStr);

	$dbServer = $config->database->host;
	$dbUser = $config->database->user;
	$dbPass = $config->database->password;
	$dbName = $config->database->dbname;

	function ConnectToDb ($server, $user, $pass, $database) {
		// Connect to the database and return
		// true/false depending on whether or
		// not a connection could be made.
		$link   = mysql_pconnect($server, $user, $pass);
		$select = mysql_select_db($database, $link);
		mysql_query('set character set utf-8',$link);       
        mysql_query("SET NAMES 'utf-8'",$link);
		if (!$link || !$select)
			return false;
		else
			return $link;
	}
	
	$link = ConnectToDb ($dbServer, $dbUser, $dbPass, $dbName);
?>
