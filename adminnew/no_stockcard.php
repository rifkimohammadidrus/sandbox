<?php 
// include"koneksi.php";
function no_transaksi_stock()
{
	include("connect.php");
	$depan="I";
	$tanggal=date("Ymd");
	$trans=$depan.$tanggal;
	$jmltrans=strlen($trans);
	$sql="SELECT SUBSTRING(transno,10,3)+1 FROM stock_in WHERE transno LIKE '%$trans%' ORDER BY transno DESC LIMIT 1";
    $query=mysqli_query($connect, $sql)or die($sql);
    list($transaksi)=mysqli_fetch_array($query);
	if(mysqli_num_rows($query)==0)
	{
		$angka=1;
	}else{
		
		$angka=$transaksi;
	}            
	$temp='';                                           
	for($i=1;$i<12-$jmltrans;$i++)
	{
		$temp=$temp."0";
	}
	return $kode=$trans.$temp.$angka;
	
	
	
}


?>
