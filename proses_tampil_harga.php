<?php 
include_once('template/koneksi.php'); 


$kodebarang=$_POST['kb'];
$kode_jenis=substr($kodebarang,0,7);
//$subwarna=substr("$warna",0,1);
$kodeoutlet=$_POST['o'];

// echo"$kodebarang-$kodeoutlet";

//cek diskon peritem
// $qdisc="SELECT td.disc_value,td.start,td.end FROM
//             tbl_disc_item AS ti INNER JOIN tbl_disc AS td ON (ti.id_diskon = td.id)
//             WHERE ti.barcode='$kode_jenis' AND ti.status=1 AND td.outlet like '%$kodeoutlet%' ";
//  // echo $qdisc;           
// $query_disc=mysqli_query($connect,$qdisc);// or die ($qdisc);
// list($persen_diskon,$tglawal,$tglakhir)=mysqli_fetch_array($query_disc);


$q_disc="SELECT tdd.persen_diskon,tdd.potongan_harga,tdd.harga_diskon,td.start,td.end  FROM tbl_disc AS td 
						LEFT JOIN tbl_disc_detail AS tdd ON (tdd.id_diskon = td.id)
						WHERE  tdd.barcode='$kode_jenis'  and td.outlet like '%$kodeoutlet%' AND td.status=1";
		$query_disc=mysqli_query($connect,$q_disc); 
		list($persentase_disc1,$potongan_harga,$harga_diskon,$tglawal,$tglakhir)=mysqli_fetch_array($query_disc);
    //IF DISCOUNT PER ITEM NOT EXIST, GET DISC ALL PRODUK IF EXIST 
	// if ($persen_diskon=='')
	// {
	// 	$q="select disc_value,start,end from tbl_disc where status=1 AND outlet like '%$kodeoutlet%'";
	// 	$query_q=mysqli_query($connect,$q);// or die ($q);
	// 	list($persen_diskon,$tglawal,$tglakhir)=mysqli_fetch_array($query_q);
	// }

// cek apakah tanggal skg masih dalam periode diskon

	// if (($now>=$tglawal) and ($now<=$tglakhir)){
	// 	$persen_diskon=$persen_diskon;	
	// } else {
	// 	$persen_diskon=0;	
	// }

$sql="select harga from master_barang where id_barang='$kodebarang' and id_outlet='$kodeoutlet'";
$query=mysqli_query($connect,$sql);
list($harga)=mysqli_fetch_array($query);	
$now=date('Y-m-d');	
if (($now>=$tglawal) and ($now<=$tglakhir)){
	if ($persentase_disc1 != 0) {
		
		$nilai_disc=($persentase_disc1/100)*$harga;
    $harga_disc=$harga-$nilai_disc;
	}else {
		$harga_disc=$harga-$potongan_harga;
	}
} else {
	$diskon=0;
	$harga_disc=$harga;
}
// $nilai_diskon=($persen_diskon/100)*$harga;
$harga_nett=$harga_disc;

echo $harga_nett;








