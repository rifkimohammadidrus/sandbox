<?php 
    session_start();
		include_once('template/koneksi.php'); 
    //include"anti_injection.php";
	
    @$username=$_SESSION['email'];
   // if(empty($username)){
        //die('You can\'t see this page');
    //}
		$kode_beli= $_COOKIE['kode_beli'];
		// $outlet='B04042111150002';
	//$idbeli=anti_injection($_POST['ib']);
	$id_barang=$_POST['sku'];
	$id_outlet=$_POST['io'];
	$jenis=$_POST['j'];


	//tambahan iwan 2020-06-04
	$date=date('Y-m-d');
	$sub_id=substr($id_barang,0,7);
    $date_yesterday = date('Y-m-d', strtotime('-1 days', strtotime($date)));

    // cek apakah member yg belanja terdaftar sebagai member global atau biro
	// $ck="SELECT c.id,c.id_level FROM customer AS c INNER JOIN customer_level AS cl ON (c.id_level=cl.id_level)
	//          INNER JOIN member AS m ON m.id_customer=c.id
  //            WHERE m.email='$_SESSION[email]' and m.verifikasi=1 ";
	// $qck=mysqli_query($connect, $ck) or die ($ck);
	// list($id_cek,$level_cek)=mysqli_fetch_array($qck);
	
    //cek diskon per item
  //   $cek_disk="SELECT td.disc_value,td.start,td.end FROM
  //              tbl_disc_item AS ti INNER JOIN tbl_disc AS td ON (ti.id_diskon = td.id)
  //              WHERE  ti.barcode='$sub_id' AND ti.status=1 AND td.outlet like '%$id_outlet%'";
  //   $q_cek_disk=mysqli_query($connect, $cek_disk) or die ($cek_disk);
	// list($persentase_disc,$tglawal,$tglakhir)=mysqli_fetch_array($q_cek_disk);
	
	// //cek diskon all item
	// if ($persentase_disc=='')
	// {
	// 	$q="select disc_value,start,end from tbl_disc where status=1 AND outlet like '%$id_outlet%'";
	// 	$query_q=mysqli_query($connect, $q);// or die ($q);
	// 	list($persentase_disc,$tglawal,$tglakhir)=mysqli_fetch_array($query_q);
	// }

	// // Cek apakah tanggal skg masih dalam periode diskon
	// if (($date>=$tglawal) and ($date<=$tglakhir)){
	//     $persentase_disc=$persentase_disc;	
	// } else {
	//     $persentase_disc=0;	
	// }

	$c="select stok,harga from master_barang where id_barang='$id_barang' and id_outlet='$id_outlet'";
    $qc=mysqli_query($connect, $c);
    list($stok,$harga)=mysqli_fetch_array($qc);
        
    // $disc_update=(($persentase_disc/100)*$harga);
		
		$q_disc="SELECT tdd.persen_diskon,tdd.potongan_harga,tdd.harga_diskon,td.start,td.end  FROM tbl_disc AS td 
		LEFT JOIN tbl_disc_detail AS tdd ON (tdd.id_diskon = td.id)
		WHERE  tdd.barcode='$sub_id'  and td.outlet like '%$id_outlet%' AND td.status=1";
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
	
	$idbeli=$kode_beli;
	if($jenis=='addP'){
		//tambahan iwan 2020-06-04
		//get stok from master barang
		
		//get stok from customer who order yasterday and now
		$cek="SELECT SUM(qty) FROM pesan_detail WHERE id_barang='$id_barang' 
			   and '$date' and id_outlet='$id_outlet'";
		$qcek=mysqli_query($connect, $cek);      
		list($qty_terpesan)=mysqli_fetch_array($qcek);
		// jika stok diatas 0 dan qty terpesan antara kemarin dan sekarang lebih kecil dari stok, maka eksekusi
		if (($stok>=0) && ($qty_terpesan<$stok)){
			$sql_debug='';
			// $sql="UPDATE pesan_detail SET qty=qty+1,amount=(harga * ((100-disc)/100) * (qty) ) WHERE no_transaksi='$idbeli' AND id_barang='$id_barang' AND id_outlet='$id_outlet';";

			//1. update dulu qty & subtotal barang tsb.
			$sql="UPDATE pesan_detail SET qty=qty+1,amount=(harga * qty),disc=disc+$nilai_disc  WHERE no_transaksi='$idbeli' AND id_barang='$id_barang' AND id_outlet='$id_outlet';";
			$sql_debug.=$sql."\n";
			mysqli_query($connect, $sql);
			$sql_debug.=$sql."\n";

			//2. Get total nett untuk cek diskon berjenjang member
			// $s="select SUM(amount) from pesan_detail where no_transaksi='$idbeli' AND id_outlet='$id_outlet' ";
			//     $qs=mysqli_query($connect, $s) or die ($s);
			// list($amounts)=mysqli_fetch_array($qs);
			// if($level_cek=='MBN'){ 
			// 	      if ($amounts<=1199999){
			//                 $discvalue=10;
			//            } else if ($amounts>=1200000){
			//                 $discvalue=15;	
			//            }
			//        } else if ($level_cek=='BBN'){
			// 	       $discvalue=30;
			//        }
			//3. jika tidak ada diskon per produk tidak ada lalu cek jika terdaftar sbgai member/biro
			// $discvalue=0;
			// if ($persentase_disc=='')
	    //     {
			//     //if($id_cek!=''){
			// 	  	//4 update disc, pada produk bersangkutan di transaksi ybs
			// 	   	$hasil="select id_barang,qty,harga from pesan_detail where no_transaksi='$idbeli' AND id_outlet='$id_outlet' 
			// 	   	        and id_barang='$id_barang'";
			// 	    $qhasil=mysqli_query($connect, $hasil) or die ($hasil);
			// 	    list($s_id,$s_qty,$s_harga)=mysqli_fetch_array($qhasil);

			//      	$s_amount=($s_qty*$s_harga);
			// 	 	$s_amount_disc=($discvalue/100)*$s_amount;
			// 	 	$u="update pesan_detail set disc=$s_amount_disc where no_transaksi='$kode_beli' and id_barang='$s_id' 
			// 	 	    and id_outlet='$id_outlet'";
			// 	 	$qu=mysqli_query($connect, $u);
			//    //}// end if id_cek
		  //  	} // end if $persentase_disc
		   	
		   	//proses update diskon berjenjang 
				
			// $hasil2="select id_barang,qty,harga from pesan_detail where no_transaksi='$kode_beli' and id_outlet='$id_outlet' ";
			// $qhasil2=mysqli_query($connect, $hasil2) or die ($hasil2);
			// while(list($h_id,$h_qty,$h_harga)=mysqli_fetch_array($qhasil2))
			// { 
			// 	$barcode7=substr($h_id,0,7);
			// 	//cek jika produk masuk ke selected produk diskon, maka tidak akan di update diskon berjenjang nya	
			//     $cekdisc="SELECT ti.barcode,td.end FROM tbl_disc_item AS ti INNER JOIN tbl_disc AS td ON (ti.id_diskon = td.id)
		  //                       WHERE td.end>NOW() AND ti.barcode='$barcode7'";
		  //       $qcekdisc=mysqli_query($connect, $cekdisc);
		  //       list($barcode_disc)=mysqli_fetch_array($qcekdisc);          
		  //             //jika $barcode_disc tidak ada maka update diskon sesuai diskon berjenjang member
		  //             if ($barcode_disc==''){
			// 			  $amount=($h_qty*$h_harga);
			// 			  $amount_disc=($discvalue/100)*$amount;
			// 			  $u="update pesan_detail set disc=$amount_disc where no_transaksi='$kode_beli' and id_barang='$h_id' and id_outlet='$id_outlet'";
			// 			  $qu=mysqli_query($connect, $u);// or die ($u);
			// 	  	  }//end if barcode_disc
			// 	  	}//end while
		  //  	// $disc_update=(($persentase_disc/100)*$harga*$qty_update);
		  //  	// $tot_amount=$uang-$disc_update;


			$sql="select qty,amount,disc 
			      from pesan_detail where no_transaksi='$idbeli' AND id_barang='$id_barang' AND id_outlet='$id_outlet';";
			$res=mysqli_query($connect, $sql);
			list($qty,$amount,$disc)=mysqli_fetch_array($res);
			$nett_amount=$amount-$disc;
			$discpersen=$disc/$amount*100;
			#die("{\"total\":\"$qty\",\"debug\":\"$sql_debug\"}");
			die("{\"qty\":\"$qty\",\"amount\":\"$nett_amount\",\"disc\":\"$discpersen\"}");
			
		}

	}elseif($jenis=='delP'){
		//tambahan iwan 2020-06-04
		//get stok from this customer
		$cek="SELECT SUM(qty) FROM pesan_detail WHERE id_barang='$id_barang' 
			   and id_outlet='$id_outlet' and no_transaksi='$idbeli'";
		$qcek=mysqli_query($connect, $cek);
		list($qty_terpesan)=mysqli_fetch_array($qcek);
	

		// $sql_debug='';
		if ($qty_terpesan>1){

			//1. update dulu qty & subtotal barang tsb.
			$sql="UPDATE pesan_detail SET qty=qty-1,amount=(harga * qty),disc=disc-$nilai_disc WHERE no_transaksi='$idbeli' AND id_barang='$id_barang' AND id_outlet='$id_outlet';";
			// $sql_debug.=$sql."\n";
			mysqli_query($connect, $sql);		

			//2. Get total nett untuk cek diskon berjenjang member
			// $s="select sum(amount) from pesan_detail where no_transaksi='$idbeli' AND id_outlet='$id_outlet' ";
		  //   $qs=mysqli_query($connect, $s) or die ($s);
		  //   list($amounts)=mysqli_fetch_array($qs);
		  //   if($level_cek=='MBN'){ 
			// 	      if ($amounts<=1199999){
			//                 $discvalue=10;
			//            } else if ($amounts>=1200000){
			//                 $discvalue=15;	
			//            }
			// } else if ($level_cek=='BBN'){
			// 	       $discvalue=30;
			// }

		    //3. jika tidak ada diskon per produk tidak ada lalu cek jika terdaftar sbgai member/biro
				// $discvalue=0;
		    // if ($persentase_disc=='')
	      //   {
			  //   // if($id_cek!=''){
			  // 	    //4 update disc, pada produk bersangkutan di transaksi ybs
				//    	$hasil="select id_barang,qty,harga from pesan_detail where no_transaksi='$idbeli' AND id_outlet='$id_outlet' 
				//    	        and id_barang='$id_barang'";
				//     $qhasil=mysqli_query($connect, $hasil) or die ($hasil);
				//     list($s_id,$s_qty,$s_harga)=mysqli_fetch_array($qhasil);

			  //    	$s_amount=($s_qty*$s_harga);
				// 		$s_amount_disc=($discvalue/100)*$s_amount;
				// 		$u="update pesan_detail set disc=$s_amount_disc where no_transaksi='$kode_beli' and id_barang='$s_id' 
				// 				and id_outlet='$id_outlet'";
				// 		$qu=mysqli_query($connect, $u);
				    	     
					
				// 	// } // end if $id_cek
		    // } // end if $persentase_disc
		    // //proses update diskon berjenjang 
				// 	$hasil2="select id_barang,qty,harga from pesan_detail where no_transaksi='$kode_beli' and id_outlet='$id_outlet' ";
				// 	$qhasil2=mysqli_query($connect, $hasil2) or die ($hasil2);
				// 	while(list($h_id,$h_qty,$h_harga)=mysqli_fetch_array($qhasil2))
				// 	{ 
				// 	  $barcode7=substr($h_id,0,7);	
				// 	  //cek jika produk masuk ke selected produk diskon, maka tidak akan di update diskon berjenjang nya	
				// 	  $cekdisc="SELECT ti.barcode,td.end FROM tbl_disc_item AS ti INNER JOIN tbl_disc AS td ON (ti.id_diskon = td.id)
		    //                     WHERE td.end>NOW() AND ti.barcode='$barcode7'";
		    //           $qcekdisc=mysqli_query($connect, $cekdisc);
		    //           list($barcode_disc)=mysqli_fetch_array($qcekdisc);          	
		    //           //jika $barcode_disc tidak ada maka update diskon sesuai diskon berje
		    //           if ($barcode_disc==''){
				// 		  $amount=($h_qty*$h_harga);
				// 		  $amount_disc=($discvalue/100)*$amount;
				// 		  $u="update pesan_detail set disc=$amount_disc where no_transaksi='$kode_beli' and id_barang='$h_id' and id_outlet='$id_outlet'";
				// 		  $qu=mysqli_query($connect, $u);// or die ($u);
				//   	  }//end if barcode_disc
				//   	}//end while	
		   	// $disc_update=(($persentase_disc/100)*$harga*$qty_update);
		   	// $tot_amount=$uang-$disc_update;


			$sql="select qty,amount,disc from pesan_detail where no_transaksi='$idbeli' AND id_barang='$id_barang' AND id_outlet='$id_outlet';";
			$res=mysqli_query($connect, $sql);
			list($qty,$amount,$disc)=mysqli_fetch_array($res);
			$nett_amount=$amount-$disc;
			$discpersen=$disc/$amount*100;
			#die("{\"total\":\"$qty\",\"debug\":\"$sql_debug\"}");
			die("{\"qty\":\"$qty\",\"amount\":\"$nett_amount\",\"disc\":\"$discpersen\"}");
		}	
	}elseif($jenis=='cekout'){
		$value_id=explode("-", $_POST['dt']);
		for ( $i = 0; $i < count( $value_id ); $i++ ) {
			echo $value_id[$i] . "<br />";
			die;
		}
	}else{
	   die('emptyChoice');	
	}
	
	
?>