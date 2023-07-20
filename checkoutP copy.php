<?php 
	session_start();
	include("template/koneksi.php");
	include_once('no_faktur.php');
	$no_trans=no_transaksi();

	$session_kode_beli= session_id();
	$id_outlet=$_POST['id_outlet'];
	$nama=$_POST['nama'];
	$no_hp=$_POST['no_hp'];
	$metode_pengiriman=$_POST['metode_pengiriman'];
	$alamat=$_POST['alamat'];
	$tanda=$_POST['tanda'];
	

	
	// echo $sql;
	
	if ($tanda="cekoutLangsung") {
		$id_barang_cek=$_POST['kode'];
		$harga=$_POST['harga'];
		$qty=$_POST['qty_selected'];
		$datetime=date('Y-m-d H:i:s');
		$disc=0;
		$sql="INSERT into pesan_detail(`no_transaksi`,`id_barang`,`harga`,`qty`,`amount`,`tanggal`,`disc`,`id_outlet`,`tanggal_waktu`, `status`) 
	          values('$no_trans','$id_barang_cek','$harga','$qty','$harga',NOW(),'$disc','$id_outlet','$datetime','1')";	

		$res=mysqli_query($connect,$sql);//or die($sql);
		if ($res) {
			$biaya_seluruh=$harga*$qty;
			$sumamount_nett=$biaya_seluruh-$disc;
			
			$sql="INSERT INTO `pesan`(`no_transaksi`,`email`, `tanggal`, `status`,  `jmlproduk`,`amount`,`ongkos`, `biaya_seluruh`, `jenis_bayar`,`kode_bank`, `session_beli`,`id_outlet`,  `id_pesan_bayar`,id_layanan, `nama`, `no_hp`, `metode_pengiriman`, `alamat`)
			VALUES ('$no_trans','', NOW(),'0','$qty',  '$sumamount_nett','', '$biaya_seluruh','','', '".$session_kode_beli."-".$id_outlet."','$id_outlet','','','$nama', '$no_hp', '$metode_pengiriman','$alamat')"; 
			$res=mysqli_query($connect, $sql);
			if ($res) {
				echo "berhasil";
			}else{
				die($sql);
			}
		}else{
			die($sql);
		}

	}
	if ($tanda=="cekoutKeranjang") {
		$sql="select sum(qty),sum(amount),sum(disc) from pesan_detail 
         where no_transaksi='$session_kode_beli' AND id_outlet='$id_outlet'";
		$res=mysqli_query($connect,$sql);
		list($sumqty,$sumamount,$sumdisc)=mysqli_fetch_array($res);

		$sumamount_nett=$sumamount-$sumdisc;
		$biaya_seluruh=$sumamount_nett;
		
		$sql="INSERT INTO `pesan`(`no_transaksi`,`email`, `tanggal`, `status`,  `jmlproduk`,`amount`,`ongkos`, `biaya_seluruh`, `jenis_bayar`,`kode_bank`, `session_beli`,`id_outlet`,  `id_pesan_bayar`,id_layanan, `nama`, `no_hp`, `metode_pengiriman`, `alamat`)
		VALUES ('$no_trans','', NOW(),'0','$sumqty',  '$sumamount_nett','', '$biaya_seluruh','','', '".$session_kode_beli."-".$id_outlet."','$id_outlet','','','$nama', '$no_hp', '$metode_pengiriman','$alamat')"; 

		$res=mysqli_query($connect, $sql);
		if ($res) {
			$sql="update pesan_detail set no_transaksi='$no_trans',status='1' where no_transaksi='".$session_kode_beli."' AND id_outlet='".$id_outlet."'";
			//echo $sql;
			$res=mysqli_query($connect,$sql);//or die($sql);
			echo 'berhasil';
		}else{
			die($sql);
		}
	}

 ?>