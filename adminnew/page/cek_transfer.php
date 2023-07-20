<?php 
//session_start();
// include"../connect.php";
include"anti_injection.php";
$kode=anti_injection($_POST['k']);
$email=anti_injection($_POST['e']);

if ($kode!=''){

 #$cek="select no_transaksi,total_transfer from pesan where no_transaksi='$kode' and jenis_bayar='0' and email='$email'";
 $cek="select id_bayar,total_transfer from pesan_bayar where id_bayar='$kode' and jenis_bayar='0' and id_customer='$email'";
 $qcek=mysqli_query($connect, $cek) or die ('Data invalid');	
 list($cek_notrans,$nilaitransfer)=mysqli_fetch_array($qcek) ;
 if ($cek_notrans!=''){
 	echo"$cek_notrans|$nilaitransfer";
 } else {
 	echo"gagal";
 }

} 
?>
