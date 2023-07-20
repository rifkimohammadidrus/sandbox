<?php 
function no_transaksi()
{
	include("template/koneksi.php");
	$depan="T";
	$tanggal=date("Ymd");
	$trans=$depan.$tanggal;
	$jmltrans=strlen($trans);
	$sql="SELECT SUBSTRING(no_transaksi,12,3)+1 FROM pesan WHERE no_transaksi LIKE '$trans%' ORDER BY no_transaksi DESC 
	      LIMIT 1";
	$sql="SELECT COUNT(no_transaksi)+1 FROM pesan WHERE tanggal LIKE CONCAT(DATE_FORMAT(NOW(),'%Y-%m-%d'),'%') AND no_transaksi LIKE CONCAT('$depan',DATE_FORMAT(NOW(),'%Y%m%d'),'%');"; 	  
    $query=mysqli_query($connect, $sql);//or die($sql);
    list($number)=mysqli_fetch_array($query);
	
	if($number<10){
		$temp='000';
	}elseif($number<100){
		$temp='00';
	}elseif($number<1000){
		$temp='0';
	}else{
		$temp='';
	}
	
	return $kode=$trans.$temp.$number;
	
}
?>