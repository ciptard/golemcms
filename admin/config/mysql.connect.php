<?php

// BEGIN CONNECT (dbConnect.php)
/////////////////////////////////////////////////
function mysqlConnect() {
	require_once('./config/config.php');
  global $conn;
  $conn = new mysqli(_HOST_, _USERNAME_, _PASSWORD_ , _TABLE_);
	
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
	return $conn;
}
/////////////////////////////////////////////////
// END CONNECT (dbConnect.php)

?>