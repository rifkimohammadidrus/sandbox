<?php 
$nama_cookie='kode_beli';

if (empty($_COOKIE['kode_beli'])) {
	session_start();
	$sess_id=session_id();
	setcookie($nama_cookie, $sess_id, time()+(60*60*24*365), '/' );
	$kode_beli= $_COOKIE['kode_beli'];
}else {
	session_start();
	$kode_beli=$_COOKIE['kode_beli'];
}
?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="SemiColonWeb" />

	<!-- Stylesheets
	============================================= -->
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700|Raleway:300,400,500,600,700|Crete+Round:400i" rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/css2?family=Inter+Tight:wght@200&family=Roboto:ital,wght@0,300;0,400;1,100&display=swap" rel="stylesheet"> 
  <link rel="stylesheet" href="assets/css/bootstrap.css" type="text/css" />
	<link rel="stylesheet" href="assets/style.css" type="text/css" />
	<link rel="stylesheet" href="assets/css/dark.css" type="text/css" />
	<link rel="stylesheet" href="assets/css/font-icons.css" type="text/css" />
	<link rel="stylesheet" href="assets/css/animate.css" type="text/css" />
	<link rel="stylesheet" href="assets/css/magnific-popup.css" type="text/css" />
  
	<link rel="stylesheet" href="assets/css/responsive.css" type="text/css" />
	<link rel="stylesheet" href="assets/new_style.css" type="text/css" />
	<link rel="stylesheet" href="assets/new_style_responsive.css" type="text/css" />
		<!-- External JavaScripts
	============================================= -->
	<script src="assets/js/jquery.js"></script>
	<script src="assets/js/plugins.js"></script>
	

	<!-- Footer Scripts
	============================================= -->
	<script src="assets/js/functions.js"></script>
	<script src="assets/js/script.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	

	<!-- Document Title
	============================================= -->
	<title>Reseller.id</title>
</head>
<?php 

//session_start();

// $kode_beli=session_id();
include_once('koneksi.php'); 
include_once('global_variables.php'); 
include_once('encrypt.php'); 


if (isset($_GET['name'])) {
	$nama_toko=$_GET['name'];
}else if ($_SESSION['nama_toko']) {
	$nama_toko=$_SESSION['nama_toko'];
}else{
	$nama_toko='';
}
if (isset($_GET['otl'])) {
	$outlet=$_GET['otl'];
	$id_outlet=decrypt($outlet);
}else if ($_SESSION['id_outlet']) {
		$id_outlet=$_SESSION['id_outlet'];
		$outlet=$_SESSION['id_outlet'];
}else{
	$id_outlet='';
	$outlet='';
}


?>

<body class="stretched no-transition">
