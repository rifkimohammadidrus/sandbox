<?php
$nama_cookie='kode_beli';
if ($_COOKIE[$nama_cookie]!='') {
  // unset($_COOKIE['kode_beli']); 
	$kode_beli1=$_COOKIE[$nama_cookie];
  echo $kode_beli1;
}else{
	$sess_id=session_id();
	setcookie($nama_cookie, $sess_id, time()+(60*60*24*365)  ); // 1year
	$_COOKIE[$nama_cookie]=$sess_id;
  $kode_beli2=$_COOKIE[$nama_cookie];
}

// if ($_COOKIE["kode_beli"] !='') {
// 	$kode_beli=$_COOKIE["kode_beli"];
// }else{
// 	$sess_id=session_id();
// 	$_COOKIE['kode_beli'] = $sess_id;
// 	setcookie("kode_beli", $sess_id, time() + (86400 * 30), "/"); // 1year
// 	$kode_beli=$_COOKIE['kode_beli'];
// }
?>