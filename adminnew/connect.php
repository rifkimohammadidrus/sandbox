<?php

  // $server = "localhost";

  // $username = "root";

  // $password = "";

  // $database = "bani_new"; 

  // mysql_connect($server,$username,$password) or die("Koneksi gagal");

  // mysql_select_db($database) or die("Database tidak bisa dibuka");
  
  $server= "localhost";
    $user= "root";
    $pass= "";

    $db= "reseller";
    $connect = mysqli_connect($server, $user, $pass, $db) or die('DB Not Connected'.mysqli_error());
    $dbselect= mysqli_select_db($connect,$db);



    date_default_timezone_set("Asia/Bangkok");

    // include_once('global_variables.php');

?>


