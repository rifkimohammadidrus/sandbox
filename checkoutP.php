<?php 
	// session_start();
	include("template/koneksi.php");
	include_once('no_faktur.php');
	$no_trans=no_transaksi();
  $depan="PB";
  $tanggal=date("Ymd");
	$trans=$depan.$tanggal;
	$sql="SELECT SUBSTRING(id_pesan_bayar,12,3)+1 FROM pesan WHERE id_pesan_bayar LIKE '$trans%' ORDER BY id_pesan_bayar DESC 
	      LIMIT 1";
	$sql="SELECT COUNT(id_pesan_bayar)+1 FROM pesan WHERE tanggal LIKE CONCAT(DATE_FORMAT(NOW(),'%Y-%m-%d'),'%') AND id_pesan_bayar LIKE CONCAT('$depan',DATE_FORMAT(NOW(),'%Y%m%d'),'%');"; 	  
    $query=mysqli_query($connect, $sql);//or die($sql);
    list($number)=mysqli_fetch_array($query);
	$id_pesanbayar=$trans.$temp.'-'.$number;

	$session_kode_beli= $_POST['sess_id'];
	$id_outlet=$_POST['id_outlet'];
	$nama=$_POST['nama'];
	$no_hp=$_POST['no_hp'];
	$metode_pengiriman=$_POST['metode_pengiriman'];
	$alamat=$_POST['alamat'];
	$sql_m="SELECT email FROM member where email='$no_hp'";
	$query=mysqli_query($connect, $sql_m);
	list($email)=mysqli_fetch_array($query);
	if ($email) {
		$sql="UPDATE member set nama='$nama', alamat='$alamat' WHERE email='$no_hp'";
		$res=mysqli_query($connect,$sql);
	}else{
		$sql="INSERT INTO member(email, nama, alamat)
					VALUES ('$no_hp', '$nama','$alamat')";
		$res=mysqli_query($connect,$sql);
	}
	function postCurl($dataJSON){
    $options = array(
      CURLOPT_URL => 'https://rsys.systems/back_end/microservices/wha/send',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_SSL_VERIFYPEER => false,
	    CURLOPT_SSL_VERIFYHOST => false,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => array("data" => $dataJSON), 
    );
    return $options; 
  }
	$sql="SELECT wha from outlet where id='$id_outlet'";
	$res=mysqli_query($connect,$sql);
	list($wha_outlet)=mysqli_fetch_array($res);
	
	switch ($_GET['action']) {
    case 'cekoutLangsung':
			$kode_jenis=$_POST['kode'];
			$size=$_POST['size_selected'];
			$warna=$_POST['color_selected'];
			$harga=$_POST['harga'];
			$qty=$_POST['qty_selected'];
			$datetime=date('Y-m-d H:i:s');
			// $disc=0;
			$biaya_seluruh=$harga*$qty;
			$sumamount_nett=$biaya_seluruh;

			$c="SELECT id_barang,harga from master_barang where kode_jenis='$kode_jenis' and kode_ukuran='$size' and kode_warna='$warna'
	    and status=1 and id_outlet='$id_outlet'";
			$q=mysqli_query($connect,$c) or die ($c);
			list($id_barang_cek,$harga)=mysqli_fetch_array($q);

			

			$sql_in="INSERT into pesan_detail(`no_transaksi`,`id_barang`,`harga`,`qty`,`amount`,`tanggal`,`disc`,`id_outlet`,`tanggal_waktu`, `status`) 
							values('$no_trans','$id_barang_cek','$harga','$qty','$harga',NOW(),'$disc','$id_outlet','$datetime','1')";	

			$res=mysqli_query($connect,$sql_in);//or die($sql);

			$sql_in1="INSERT INTO `pesan`(`no_transaksi`, `tanggal`, `status`,  `jmlproduk`,`amount`, `biaya_seluruh`, `session_beli`,`id_outlet`,  `id_pesan_bayar`, `nama`, `no_hp`, `metode_pengiriman`, `alamat`)
			VALUES ('$no_trans', NOW(),'0','$qty',  '$sumamount_nett', '$biaya_seluruh','".$session_kode_beli."-".$id_outlet."','$id_outlet','$id_pesanbayar','$nama', '$no_hp', '$metode_pengiriman','$alamat')"; 
// echo $sql_in; die;
			$result=mysqli_query($connect, $sql_in1);
			$code7=substr($id_barang_cek,0,7);
			// Proses Input Barcode Terlaris
			$sql1="SELECT barcode from terlaris where barcode ='$code7' and outlet='$id_outlet'";
			$query1=mysqli_query($connect, $sql1);
			if(mysqli_num_rows($query1)<1){
				$sql="INSERT INTO terlaris (`barcode`,`qty`,`outlet`) VALUES ('$code7','0','$id_outlet')";
				$query=mysqli_query($connect, $sql) or die ($sql);
			}

			if ($res && $result) {
				echo "berhasil";
				
				$message="Pesanan Diproses\nTerima kasih telah berbelanja di toko kami\nSilahkan tunggu beberapa saat, admin toko kami akan mengirim pesan whatsapp untuk metode pembayaran";
				// $no_wa='082213031299';
				$data = new stdClass();
				$data->token = "M00zwEyiemojKR9ilsECaE81QUjpdfNP5Bdp";
				$data->phone = $no_hp;
				$data->msg = $message;

				$dataJSON = json_encode($data);
				
				$message1="Pesanan masuk dari $nama dengan no whatsapp $no_hp\nSilahkan cek di http://reseller.rabbani.id/adminnew ";
				// $no_wa='082213031299';
				$data1 = new stdClass();
				$data1->token = "M00zwEyiemojKR9ilsECaE81QUjpdfNP5Bdp";
				$data1->phone = $wha_outlet;
				$data1->msg = $message1;

				$dataJSON1 = json_encode($data1);


				$curl = curl_init();
				$options = postCurl($dataJSON);  
				curl_setopt_array($curl, $options); 
				$response = json_decode(curl_exec($curl),true);
				
				$options1 = postCurl($dataJSON1);  
				curl_setopt_array($curl, $options1); 
				$response1 = json_decode(curl_exec($curl),true);
			}else{
				die($sql_pesan);
			}
			break;
		case 'cekoutKeranjang':

			$id_barang = implode("','", $_POST['id_barang']);
			$sql="SELECT sum(qty),sum(amount),sum(disc) from pesan_detail where no_transaksi='$session_kode_beli' AND id_outlet='$id_outlet'";
			$res=mysqli_query($connect,$sql);
			list($sumqty,$sumamount,$sumdisc)=mysqli_fetch_array($res);

			$sumamount_nett=$sumamount-$sumdisc;
			$biaya_seluruh=$sumamount_nett;
			
			$sql_in="INSERT INTO `pesan`(`no_transaksi`, `tanggal`, `status`,  `jmlproduk`,`amount`, `biaya_seluruh`, `session_beli`,`id_outlet`,  `id_pesan_bayar`, `nama`, `no_hp`, `metode_pengiriman`, `alamat`)
			VALUES ('$no_trans', NOW(),'0','$sumqty',  '$sumamount_nett', '$biaya_seluruh','".$session_kode_beli."-".$id_outlet."','$id_outlet','$id_pesanbayar','$nama', '$no_hp', '$metode_pengiriman','$alamat')"; 

			$res=mysqli_query($connect, $sql_in);




 	
		// for ( $i = 0; $i < count( $id_barang ); $i++ ) {
		// 	$id_barang = $value_id[$i];
		// }
			
			$sql_update="UPDATE pesan_detail set no_transaksi='$no_trans',status='1' where no_transaksi='$session_kode_beli' AND id_outlet='$id_outlet' AND id_barang IN ('$id_barang')";
			// die($sql_update);
			//echo $sql_update;
			$reslt=mysqli_query($connect,$sql_update);//or die($sql_update);
			if ($res && $reslt) {
				echo 'berhasil';

				$message="Pesanan Diproses\nTerima kasih telah berbelanja di toko kami\nSilahkan tunggu beberapa saat, admin toko kami akan mengirim pesan whatsapp untuk metode pembayaran";
				// $no_wa='082213031299';
				$data = new stdClass();
				$data->token = "M00zwEyiemojKR9ilsECaE81QUjpdfNP5Bdp";
				$data->phone = $no_hp;
				$data->msg = $message;
				$dataJSON = json_encode($data);
				
				$message1="Pesanan masuk dari $nama dengan no whatsapp $no_hp \nSilahkan cek di http://reseller.rabbani.id/adminnew ";
				// $no_wa='082213031299';
				$data1 = new stdClass();
				$data1->token = "M00zwEyiemojKR9ilsECaE81QUjpdfNP5Bdp";
				$data1->phone = $wha_outlet;
				$data1->msg = $message1;
				$dataJSON1 = json_encode($data1);

				$curl = curl_init();

				$options = postCurl($dataJSON);  
				curl_setopt_array($curl, $options); 
				$response = json_decode(curl_exec($curl),true);
				
				$options1 = postCurl($dataJSON1);  
				curl_setopt_array($curl, $options1); 
				$response1 = json_decode(curl_exec($curl),true);
			}else{
				die($sql_in);
			}
			break;
	}
 ?>