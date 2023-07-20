<?php ob_start();
session_start();
include"connect.php";
include "excel_reader2.php";

// nilai awal counter untuk jumlah data yang sukses dan yang gagal diimport
$sukses = 0;
$gagal = 0;

$kode_disc=$_POST['temp_id'];



if(!empty($_FILES['userfile']['name'])) // jika nama file tidak kosong
{
  $extensionList = array("xls"); //ini list tipe file yang akan kita perbolehkan untuk di unggah
  $fileName = $_FILES['userfile']['name']; // pengambilan nama file dari form
  $pecah = explode(".", $fileName); // proses pemecahan nama file untuk pengambilan extension file
  $belah = count($pecah);
  $ekstensi = strtolower($pecah[$belah-1]); //pengambilan extension file sekaligus strtolower untuk merubah string menjadi huruf  kecil semua
  
  // proses untuk pengecekan file extensi, in_array maksudnya apabila data string ada di dalam array maka ...
    if (in_array($ekstensi, $extensionList))
    {	
	/* unset($_SESSION['id_transaksi']);
	 unset($_SESSION['email_trans']);
	 unset($_SESSION['tgl_trans']);
     $_SESSION['id_transaksi']=$no_trans;
	 $_SESSION['email_trans']=$email;  
	 $_SESSION['tgl_trans']=$tgl;*/
	 // membaca file excel yang diupload
     $data = new Spreadsheet_Excel_Reader($_FILES['userfile']['tmp_name']);
     //echo $data."--<br>";
     // membaca jumlah baris dari data excel
     $baris = $data->rowcount($sheet_index=0);
     //echo $baris."--<br>";
	  // import data excel mulai baris ke-2 (karena baris pertama adalah nama kolom)
      for ($i=2; $i<=$baris; $i++)
      {
	   $no=$i-1;
       //echo $i;
       // membaca data dari mulai baris kedua
       $barcode       = $data->val($i, 1);
	   
	   $sql="INSERT INTO tbl_disc_item (barcode,id_diskon,status)
             VALUES ('$barcode','$kode_disc',0)";
       $query=mysqli_query($connect, $sql) or die ($sql);
	   
	   if ($query) {
        /* echo"<br>data sukses diimport-$sql";*/
       } else {
         echo"<br>data gagal diimport-$sql";
       }
     
	   echo"<script>alert('Data berhasil diimport');
	  document.location=\"index.php?menu=disc_perproduk&kode=$kode_disc\";</script>";	
		 
	  } // end for
         
	} else {
	  echo"<script>alert('Format file harus .xls');
	  document.location=\"upload_transaction.html\";</script>";	
	} // end if in_array
	 
}// end main if

?>