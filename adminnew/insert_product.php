<?php 
include("connect.php");

$barcode=$_POST['b'];
$outlet=$_POST['o'];
$kodemodel=substr("$barcode",0,7);
$size=substr("$barcode",7,3);
$supplier=substr("$barcode",9,3);
$date=date('Y-m-d');
$datenow=date('Y-m-d h:i:s');
$time=date('Ymdhis');
//echo"$kodemodel";
$sql="select gambar1,gambar2,kode_kategori from jenis_barang where kode_jenis='$kodemodel'";
$query=mysqli_query($connect, $sql) or die ($sql);
list($image1,$image2,$kategori)=mysqli_fetch_array($query);
// jika model produk & foto produk sudah diupload
if ($image1!=''){

   $c="select id_barang from master_barang where id_barang='$barcode'";
   $qc=mysqli_query($connect, $c) or die ($c);
   list($ada_barcode)=mysqli_fetch_array($qc);
   if ($ada_barcode!='')
   {
   
    $sql="update master_barang set kode_kategori='$kategori',stok=stok+1,updatedate='$datenow',status=1,kode_satuan='pcs' 
          where id_barang='$barcode' and id_outlet='$outlet'";
    $query=mysqli_query($connect, $sql) or die ($sql); 
	
	   if ($query){
	       $tampil="SELECT m.id_barang, j.nama,u.ukuran,w.warna, m.harga,m.stok 
                    FROM master_barang AS m LEFT JOIN jenis_barang AS j ON (j.kode_jenis=m.kode_jenis)  
                                            LEFT JOIN ukuran AS u ON u.kode_ukuran=m.kode_ukuran
                                            LEFT JOIN warna AS w ON (w.kode_warna=m.kode_warna)
                     WHERE m.id_barang='$barcode' and m.id_outlet='$outlet'";
	       $qtampil=mysqli_query($connect, $tampil) or die ($tampil);
	       list($tbarcode,$tnama,$tsize,$twarna,$tharga,$tstok)=mysqli_fetch_array($qtampil);
	       
	       echo"$tbarcode;$tnama;$tsize;$twarna;$tharga;$tstok;$outlet;$time";
		   
		   
		   include("no_stockcard.php");
		   $no_transaksi=no_transaksi_stock();
           //echo"$no_transaksi";
		 
		   $qinsert="INSERT INTO stock_in (transno,barcode,`in`,tgl,tgl2,id_outlet)
                      VALUES ('$no_transaksi','$barcode','1','$date','$datenow','$outlet')
                      ON DUPLICATE KEY UPDATE `in`=`in`+1,tgl2='$datenow'";	
		   $query_insert=mysqli_query($connect, $qinsert) or die ($qinsert);			  	  
	     } 
		 
	} else {
	
	echo"barcode kosong";
	
	}	 
       
} else {
echo"model kosong";
} 



?>