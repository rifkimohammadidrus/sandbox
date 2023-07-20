<?php  session_start();
include("template/koneksi.php");
include_once('template/global_variables.php');

$datetime=date('Y-m-d H:i:s');
$date=date('Y-m-d');
$date_yesterday = date('Y-m-d', strtotime('-1 days', strtotime($date)));

$kode_jenis=$_POST['kode_jenis'];
$sess_id=$_POST['sess_id'];
// $_SESSION['kode_beli']= $sess_id;
$outlet=$_POST['outlet'];
$warna=$_POST['warna'];
$size=$_POST['size'];
$qty=$_POST['qty'];
  // echo $outlet; die;
  // cek di stok barang
  $sql="select stok from master_barang where kode_jenis='$kode_jenis' and kode_ukuran='$size' and kode_warna='$warna' 
        and status=1 and stok>0 and id_outlet='$outlet'";
  // $sql="select stok from master_barang where kode_jenis='XNZ7EK0' and kode_ukuran='95' and kode_warna='300' 
  // and status=1 and stok>0 and id_outlet='B04042111150002'";
  $query=mysqli_query($connect,$sql); //or die($sql);'300','XNZ7EK0','B04042111150002'
  list($jml)=mysqli_fetch_array($query);
  
  // cek apakah barang tsb sudah di pesan pada tanggal skg dan kmarin
  $sql_cek="SELECT SUM(qty)
            FROM pesan_detail WHERE SUBSTRING(id_barang,1,7)='$kode_jenis' AND SUBSTRING(id_barang,8,2)='$size'
            AND SUBSTRING(id_barang,13,3)='$warna' and tanggal between '$date_yesterday' and '$date' and id_outlet='$outlet'";
  $query_cek=mysqli_query($connect,$sql_cek) ; // or die ($sql_cek);
  list($jml_pesan)=mysqli_fetch_array($query_cek);			
	// echo $jml; echo $jml_pesan; die;
  // cek jika stok 0 atw barang yg di pesan oleh dia atau konsumen lain di hari ini sudah sama dengan total stok nya
  if (($jml<=0) or ($jml_pesan >= $jml)){ 
    echo"Stok Tidak mencukupi-";
    exit(); 
  }
    
	// ambil data dari master barang
	$c="select id_barang,harga from master_barang where kode_jenis='$kode_jenis' and kode_ukuran='$size' and kode_warna='$warna'
	    and status=1 and id_outlet='$outlet'";
	$q=mysqli_query($connect,$c) or die ($c);
	list($id_barang_cek,$harga)=mysqli_fetch_array($q);

	$q_disc="SELECT tdd.persen_diskon,tdd.potongan_harga,tdd.harga_diskon,td.start,td.end  FROM tbl_disc AS td 
						LEFT JOIN tbl_disc_detail AS tdd ON (tdd.id_diskon = td.id)
						WHERE  tdd.barcode='$kode_jenis'  and td.outlet like '%$outlet%' AND td.status=1";
		$query_disc=mysqli_query($connect,$q_disc); 
		list($persentase_disc,$potongan_harga,$harga_diskon,$tglawal,$tglakhir)=mysqli_fetch_array($query_disc);

		$now=date('Y-m-d');	
		if (($now>=$tglawal) and ($now<=$tglakhir)){
			if ($persentase_disc != 0) {
				$nilai_disc=($persentase_disc/100)*$harga;
        $harga_disc=$harga-$nilai_disc;
			}else {
				$nilai_disc=$potongan_harga;	
				$harga_disc=$harga-$nilai_disc;
			}
		} else {
			$nilai_disc=0;
			$harga_disc=$harga;
		}
	// $qdisc="SELECT td.disc_value,td.start,td.end FROM
  //           tbl_disc_item AS ti INNER JOIN tbl_disc AS td ON (ti.id_diskon = td.id)
  //           WHERE SUBSTRING(ti.barcode,1,7)='$kode_jenis' AND ti.status=1 AND td.outlet like '%$outlet%'";
	// $query_disc=mysqli_query($connect,$qdisc);// or die ($qdisc);
	// list($persen_diskon,$tglawal,$tglakhir)=mysqli_fetch_array($query_disc);

	
	//JIKA DISKON SELECTED ITEM KOSONG, LALU CEK DISKON ALL ITEM 
	// if ($persen_diskon=='')
	// {
	// 	$q="select disc_value,start,end from tbl_disc where status=1 AND outlet like '%$outlet%'";
	// 	$query_q=mysqli_query($connect,$q);// or die ($q);
	// 	list($persen_diskon,$tglawal,$tglakhir)=mysqli_fetch_array($query_q);
	// }

	// cek apakah tanggal skg masih dalam periode diskon
	// $now=date('Y-m-d');	
	// if (($now>=$tglawal) and ($now<=$tglakhir)){
	// 	$persen_diskon=$persen_diskon;	
	// } else {
	// 	$persen_diskon=0;	
	// }
	

	$code7=substr($id_barang_cek,0,7);	

	// Proses Input Barcode Terlaris
	$sql1="SELECT barcode from terlaris where barcode ='$code7' and outlet='$outlet'";
	$query1=mysqli_query($connect, $sql1);
	// Proses Input Barcode Terlaris
	if(mysqli_num_rows($query1)<1){
		$sql="INSERT INTO terlaris (`barcode`,`qty`,`outlet`) VALUES ('$code7','0','$outlet')";
		$query=mysqli_query($connect, $sql) or die ($sql);
	}




	//proses masuk keranjang
	// apakah barang tsb sudah dipesan dalam pesanan yg sama
	$sql="select * from pesan_detail where no_transaksi='$sess_id' and id_barang='$id_barang_cek' and id_outlet='$outlet'"; 
	$query=mysqli_query($connect,$sql);//or die($sql);

	

	  if(mysqli_num_rows($query)==0){
	    // $nilai_diskon=($persen_diskon/100)*$harga;

	    $sql="insert into pesan_detail(no_transaksi,id_barang,harga,qty,amount,tanggal,disc,id_outlet,tanggal_waktu) 
	          values('$sess_id','$id_barang_cek','$harga','$qty','$harga',NOW(),'$nilai_disc','$outlet','$datetime')";	
	    }else{
		     $data=mysqli_fetch_array($query);
		     $qty=$data["qty"]+1;  
			 
			 $amount=($qty*$harga);
			 $amount_disc=$nilai_disc*$amount;
			 
		     $sql="update pesan_detail set qty='$qty',amount='$amount',disc='$amount_disc'
			       where no_transaksi='$sess_id' and  id_barang='$id_barang_cek' and id_outlet='$outlet'";
	    }
	$query=mysqli_query($connect,$sql);//or die($sql);
    





















	// cek total pembelanjaan 
	$s="select SUM(amount) from pesan_detail where no_transaksi='$sess_id' and id_outlet='$outlet'";
	$qs=mysqli_query($connect,$s);// or die ($s);
	list($amount)=mysqli_fetch_array($qs);
	//echo"AMMOUNYTTTTTTTTTTTTTTTTTTTTTTTTTTTT: $amount";
	
	// if ($persen_diskon=='')
	// {
	// 	if ($id_cek=''){
	// 	    if ($level_cek=='MBN'){ 
	// 		    if ($amount<=1199999){
	// 	              $discvalue=10;
	// 	        } else if ($amount>=1200000){
	// 	             $discvalue=15;	
	// 	        }
	// 	     } else if ($level_cek=='BBN'){
	// 		   $discvalue=30;
	// 	     }
	// 	     //hitung diskon member jika produk tsb tidak ada diskon all atau diskon selected
	// 	     $hasil="select id_barang,qty,harga from pesan_detail where no_transaksi='$sess_id' and id_outlet='$outlet' 
	// 	             and id_barang='$id_barang_cek'";
	// 		 $qhasil=mysqli_query($connect,$hasil) or die ($hasil);
	// 		 list($s_id,$s_qty,$s_harga)=mysqli_fetch_array($qhasil);

	// 	     $s_amount=($s_qty*$s_harga);
	// 		 $s_amount_disc=($discvalue/100)*$s_amount;
	// 		 $u="update pesan_detail set disc=$s_amount_disc where no_transaksi='$sess_id' and id_barang='$s_id' and id_outlet='$outlet'";
	// 		 $qu=mysqli_query($connect,$u);

	// 		//CEK DISKON BERJENJANG
	// 		$hasil2="select id_barang,qty,harga from pesan_detail where no_transaksi='$sess_id' and id_outlet='$outlet' ";
	// 		$qhasil2=mysqli_query($connect,$hasil2) or die ($hasil2);
	// 		while(list($h_id,$h_qty,$h_harga)=mysqli_fetch_array($qhasil2))
	// 		{ 
	// 		  $barcode7=substr($h_id,0,7);	
	// 		  $cekdisc="SELECT ti.barcode,td.end FROM tbl_disc_item AS ti INNER JOIN tbl_disc AS td ON (ti.id_diskon = td.id)
  //                       WHERE td.end>NOW() AND ti.barcode='$barcode7'";
  //             $qcekdisc=mysqli_query($connect,$cekdisc);
  //             list($barcode_disc)=mysqli_fetch_array($qcekdisc);          	

  //             //jika $barcode_disc tidak ada maka update diskon sesuai diskon berjenjang member
  //             if ($barcode_disc==''){
	// 			  $amount=($h_qty*$h_harga);
	// 			  $amount_disc=($discvalue/100)*$amount;
	// 			  $u="update pesan_detail set disc=$amount_disc where no_transaksi='$sess_id' and id_barang='$h_id' and id_outlet='$outlet'";
	// 			  $qu=mysqli_query($connect,$u);// or die ($u);
	// 	  	  }//end if barcode_disc
	// 	  	}//end while
	//     } // end if($id_cek<>'')
	// } // end if($persentase_disc)
	 /*echo"<script>alert('Barang Telah Masuk ke Keranjang');</script>";*/
	 
	 $t="select sum(qty) from pesan_detail where  no_transaksi='$sess_id' and id_outlet='$outlet'";
	 $qt=mysqli_query($connect,$t);// or die ($t);
	 list($tot_qty)=mysqli_fetch_array($qt);
	 
	 if($data_global['isBlockMultiAccess']=="1" && empty($_SESSION['lock_store'])){
	    $_SESSION['lock_store']=$outlet;		 
	 }
	 
	 echo"berhasil";
// }	
?>
	