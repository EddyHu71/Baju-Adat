<?php
	$db_host = "localhost";
	$db_user = "root";
	$db_pass = "";
	$db_name = "db_bajuadat";
	
	$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
	if ($conn) {
		echo "Connection success";
	} else {
		die ("Connection failed" .mysqli_connect_error());
	}

?>