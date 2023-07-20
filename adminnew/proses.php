<?php session_start();

include("connect.php");
$username = $_SESSION['namauser']; 

if($_POST['editdiscount']){

      $link="discount.php";
      $outlet=$_SESSION['id_outlet'];
      // $jenisproduk=$_POST['item_disc'];
      $kode_diskon=$_POST['kode_diskon'];
      $barcode=$_POST['barcode'];
      $start=$_POST['tgl1'];
      $end=$_POST['tgl2'];
      $diskon=$_POST['diskon'];
     
      $status=$_POST['status'];
      
      //$jenisproduk=str_replace("\'","'",$jenisproduk);
      // echo $start.'-'.$end; die;
      $s="select harga from master_barang where kode_jenis='$barcode'";
      $qs=mysqli_query($connect,$s) or die ($s);
      list($hargabarang)=mysqli_fetch_array($qs);

      if ($diskon=='persen_disc'){
            $persen_diskon=$_POST['persen_disc'];
            $potongan_harga=0;	
            $nilai_diskon=($persen_diskon/100)*$hargabarang;
            $harga_diskon=$hargabarang-$nilai_diskon;
      } else {
            $persen_diskon=0;
            $potongan_harga=$_POST['potongan_harga'];
            $harga_diskon=$hargabarang-$potongan_harga;
      }
      echo $kode_diskon.' Harga: '.$hargabarang.' potongan: '.$potongan_harga.'-'.$persen_diskon.'% Total: '.$harga_diskon;
      
      // die;

      $sql="UPDATE tbl_disc set start='$start',end='$end',status='$status'
            where id='$kode_diskon'";
      $query=mysqli_query($connect, $sql);

        
     
      $sql1="UPDATE tbl_disc_detail set id_diskon='$kode_diskon',persen_diskon='$persen_diskon',potongan_harga='$potongan_harga',harga_diskon='$harga_diskon'
      where barcode='$barcode'";

      $query1=mysqli_query($connect, $sql1);



      //echo $update_master;

      echo"<script>alert('Discount Berhasil Di Setting');

      document.location=\"disc.php\";

      </script>";

      

}  else if ($_POST['tambahdiscount']){

      // $discvalue=$_POST['discvalue'];
      $tgl1=$_POST['tgl1'];
      $tgl2=$_POST['tgl2'];	
      $barcode=$_POST['barcode'];	
       
      $status=$_POST['status'];
      $outlet=$_SESSION['id_outlet'];
      $diskon=$_POST['diskon'];
      $persen_disc=$_POST['persen_disc'];	
      $potongan_harga=$_POST['potongan_harga'];	
      // echo $diskon;
      if ($diskon=="persen_disc") {
            $potongan_harga=0;
      }elseif ($diskon=='potongan_harga') {
       
            $persen_disc=0;
      }
      // echo $persen_disc;
      // echo $potongan_harga;
      // die;
      // mengambil data barang dengan kode paling besar
      $sql= "SELECT max(id) as terbesar FROM tbl_disc";
      $query = mysqli_query($connect, $sql);
      // $data = mysqli_fetch_array($query);
      list($id_diskon)=mysqli_fetch_array($query);
      // $kode = $data['terbesar'];
      
      
     
      $id_diskon++;
      
      $s="select harga from master_barang where kode_jenis='$barcode'";
      $qs=mysqli_query($connect,$s) or die ($s);
      list($hargabarang)=mysqli_fetch_array($qs);
      if ($persen_disc !='') {
            $nilai_diskon=($persen_disc/100)*$hargabarang;
            $harga_diskon=$hargabarang-$nilai_diskon;
      }else{
            $harga_diskon=$hargabarang-$potongan_harga;
      }

      $sql="INSERT INTO tbl_disc (id,start,end,status,outlet)
            VALUES ('$id_diskon','$tgl1','$tgl2','$status','$outlet')";  

      $query=mysqli_query($connect, $sql) or die ($sql);	

      $sql1="INSERT INTO tbl_disc_detail (barcode,id_diskon,persen_diskon,potongan_harga,harga_diskon)
            VALUES ('$barcode','$id_diskon','$persen_disc','$potongan_harga','$harga_diskon')";  

      $query1=mysqli_query($connect, $sql1) or die ($sql1);	

      if ($query1){
            // echo $sql;
            echo"<script>alert('Data Berhasil di Simpan'); 
                  document.location=\"disc.php?log=\";
            </script>";  
      }   
} 