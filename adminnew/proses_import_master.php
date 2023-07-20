<?php ob_start();
session_start();
include("connect.php");
include("excel_reader2.php");
	
// nilai awal counter untuk jumlah data yang sukses dan yang gagal diimport
$sukses = 0;
$gagal = 0;

$outlet=$_SESSION['id_outlet'];
$date=date('Y-m-d H:i:s');
/*$no_trans=$_POST['no_trans'];
$email=$_POST['email'];
$tgl=$_SESSION['tgl_trans'];*/

if(!empty($_FILES['userfile']['name'])) // jika nama file tidak kosong
{
  $extensionList = array("xls"); //ini list tipe file yang akan kita perbolehkan untuk di unggah
  $fileName = $_FILES['userfile']['name']; // pengambilan nama file dari form
  $pecah = explode(".", $fileName); // proses pemecahan nama file untuk pengambilan extension file
  $belah = count($pecah);
  $ekstensi = strtolower($pecah[$belah-1]); //pengambilan extension file sekaligus strtolower untuk merubah string menjadi huruf  kecil semua
  
  // proses untuk pengecekan file extensi, in_array maksudnya apabila data string ada di dalam array maka ...
  if (in_array($ekstensi, $extensionList)) {	
	 // membaca file excel yang diupload
     $data = new Spreadsheet_Excel_Reader($_FILES['userfile']['tmp_name']);
     //echo $data."--<br>";
     // membaca jumlah baris dari data excel
     $baris = $data->rowcount($sheet_index=0);
     //echo $baris."--<br>";

	  // import data excel mulai baris ke-2 (karena baris pertama adalah nama kolom)
    for ($i=2; $i<=$baris; $i++){
	    $no=$i-1;
       //echo $i;
       // membaca data dari mulai baris kedua
       $barcode     = $data-> val($i, 1);
       $harga       = $data-> val($i, 2);
       $kode_kategori = substr($barcode,0,3);
       $kode_jenis    = substr($barcode,0,7);
       $kode_size     = substr($barcode,7,2);
       $kode_warna    = substr($barcode,12,3);
       $kode_satuan   ="pcs";
       $stok          = 0;
       $stok_min      = 0;
       $supplier      = substr($barcode,9,3);
       $status        = 0;


	     $sql="INSERT IGNORE INTO master_barang (id_barang,id_outlet,kode_kategori,kode_jenis,kode_ukuran,kode_warna,kode_satuan,stok,
             stok_min,harga,updatedate,supplier,status,disc)
             VALUES ('$barcode','$outlet','$kode_kategori','$kode_jenis','$kode_size','$kode_warna','$kode_satuan','$stok','$stok_min',
                    '$harga','$date','$supplier','$status','')";
       $query=mysqli_query($connect, $sql);
	   
	    if ($query) {
           echo"<br>data sukses diimport-$sql";
      } else {
           echo"<br>data gagal diimport-$sql";
      }
      header('location:index.php?menu=masterproduk'); 	 
		 
	  } // end for
         
	} else {
	  echo"<script>alert('Format file harus .xls');
	  document.location=\"upload_transaction.php\";</script>";	
	} // end if in_array
	 
}// end main if

?>