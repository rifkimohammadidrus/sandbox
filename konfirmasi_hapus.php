<?php 
ob_start();
session_start();

include_once('template/koneksi.php'); 
include_once("template/global_variables.php");
$kode_beli=$_COOKIE['kode_beli'];
$item=$_POST['i'];
$id=$_POST['id'];
if ($item=='satu_item') {
	$sql="DELETE from pesan_detail where id_barang='$id' and no_transaksi='$kode_beli'";
	$query=mysqli_query($connect, $sql);
	
	if($query){
		echo"berhasil";
	} else {
		echo $sql;
	}
}elseif ($item=='all_item') {
	$value_id=explode("-", $id);
	
	 for ( $i = 0; $i < count( $value_id ); $i++ ) {
		 $id_barang = $value_id[$i];
		 $sql="DELETE from pesan_detail where id_barang IN ('$value_id[$i]') and no_transaksi='$kode_beli'";
			$query=mysqli_query($connect, $sql);
			
			if($query){
				echo"berhasil";
			} else {
				echo $sql;
			}
	 }
}



//echo"$email-$pwd";
?>