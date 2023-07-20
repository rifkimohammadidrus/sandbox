<?php
	$host = "156.67.212.223";
 	$user = "rabbanico_bani";
 	$pass = "matakhade2021";
 	$db   = "rabbanico_posnet";
 	$conn = mysqli_connect($host, $user, $pass, $db);
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

	
?>