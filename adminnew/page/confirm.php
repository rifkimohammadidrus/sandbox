<?php
	// session_start();
	include("../connect.php");

	$no_transaksi=$_POST['no_transaksi'];
	

  // PB23052020-1
  // $depan="PB";
  // $tanggal=date("Ymd");
	// $trans=$depan.$tanggal;
	// $sql="SELECT SUBSTRING(id_bayar,12,3)+1 FROM pesan_bayar WHERE id_bayar LIKE '$trans%' ORDER BY id_bayar DESC 
	//       LIMIT 1";
	// $sql="SELECT COUNT(id_bayar)+1 FROM pesan_bayar WHERE tanggal LIKE CONCAT(DATE_FORMAT(NOW(),'%Y-%m-%d'),'%') AND id_bayar LIKE CONCAT('$depan',DATE_FORMAT(NOW(),'%Y%m%d'),'%');"; 	  
  //   $query=mysqli_query($connect, $sql);//or die($sql);
  //   list($number)=mysqli_fetch_array($query);
	// $kode=$trans.$temp.'-'.$number;

 

	function postCurl($dataJSON){
    $options = array(
      CURLOPT_URL => 'https://103.14.21.57/back_end/microservices/wha/send',
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
$tanda=$_POST['tanda'];
if ($tanda=='confirm') {
  // echo $total_transfer;die;
  $total_harga=$_POST['total_harga'];
	$total_harga1=str_replace(",", "", $total_harga);
	$ongkir=$_POST['ongkir'];

  $total_belanja=$_POST['total_belanja'];
  $atas_nama=$_POST['atas_nama'];
	$ongkir1=number_format("$ongkir",0,".",",");
	$norek=$_POST['norek'];
	$bank=$_POST['bank'];
	// $pesan=$_POST['pesan'];
	$no_penerima=$_POST['no_penerima'];
	$id_pesanbayar=$_POST['id_pesanbayar'];
	$kd_unik=substr($no_penerima,10);
  
  $total=number_format("$total_belanja",0,".",",");

  // jika total_transfer sama maka angka uniknya +1
  $sql="SELECT angka_unik from pesan_bayar where 
  amount='$total_belanja' ORDER BY angka_unik DESC LIMIT 1";
  $query=mysqli_query($connect, $sql) or die ($sql);
  list($a_unik)=mysqli_fetch_array($query);
  echo $a_unik+1;
  if ($a_unik) {
    $angka_unik=$a_unik+1;
  }else{
    $angka_unik=$kd_unik;
  }

  $total_transfer=$total_belanja+$angka_unik;
 
  $sql_pb="INSERT INTO `pesan_bayar`(`id_bayar`, `jenis_bayar`, `tanggal`, `total_belanja`, `total_ongkir`, `amount`, `angka_unik`, `total_transfer`,`id_customer`, `status`, `is_batal`) VALUES ('$id_pesanbayar',0,now(),'$total_harga1','$ongkir','$total_belanja','$angka_unik','$total_transfer','$no_penerima',0,0)";
  $query1=mysqli_query($connect, $sql_pb) or die ($sql_pb);

  $sql="UPDATE pesan set status=1 where no_transaksi='$no_transaksi'";
  $query=mysqli_query($connect, $sql) or die ($sql);
	$message="Pesanan Dikonfirmasi\nTotal pesanan : Rp. $total_harga \n Ongkir Rp. $ongkir1 \n Kode unik:  $angka_unik \n Total transfer: Rp. $total \n Silahkan transfer ke \n $norek  \n $bank \n $atas_nama ";
  // $no_wa='082213031299';
  $data = new stdClass();
  $data->token = "M00zwEyiemojKR9ilsECaE81QUjpdfNP5Bdp";
  $data->phone = $no_penerima;
  $data->msg = $message;

  $dataJSON = json_encode($data);
  $curl = curl_init();
				$options = postCurl($dataJSON);  
				curl_setopt_array($curl, $options); 
				$response = json_decode(curl_exec($curl),true);
  echo 'berhasil';
  //  echo"<script>alert('Pesanan berhasil dikonfirmasi');
  //          document.location=\"approve.php\";
  //        </script>";
}
elseif ($tanda=='approve') {
  $outlet=$_POST['outlet'];
  
  $barcode = $_POST['barcode'];
  $qty=$_POST['qty']; 

  $sqlno=0;
  for ($i=0; $i < count($barcode); $i++) { 
    $c[$i] = $barcode[$i].','.$qty[$i]; // gabungkan masing" isi array dg (,)
    $c[$i] = explode(',',$c[$i]); 
    $sql1="UPDATE terlaris set qty=qty+$qty[$i] where barcode='$barcode[$i]' and  outlet='$outlet'";
    echo $sql;
    $query=mysqli_query($connect, $sql1) or die ($sql1);
  }
  
 

  //$sql="INSERT INTO terlaris (`barcode`,`qty`,`outlet`) VALUES ('$barcode','$qty','$outlet')";
  // print_r($data_barcode);die;
  // die;
  $sql="update pesan_bayar set jenis_bayar='1', status='1' where id_bayar='$id_pesanbayar'";
  $query=mysqli_query($connect, $sql);//or die($sql);


  $sql="UPDATE pesan set status=2, jenis_bayar=1, approve_date=now() where no_transaksi='$no_transaksi'";
  $query=mysqli_query($connect, $sql) or die ($sql);
	
  
  $message="Pembayaran berhasil dikonfirmasi.";
  // $no_wa='082213031299';
  $data = new stdClass();
  $data->token = "M00zwEyiemojKR9ilsECaE81QUjpdfNP5Bdp";
  $data->phone = $no_penerima;
  $data->msg = $message;

  $dataJSON = json_encode($data);
  $curl = curl_init();
				$options = postCurl($dataJSON);  
				curl_setopt_array($curl, $options); 
				$response = json_decode(curl_exec($curl),true);
  echo 'berhasil';
  
}