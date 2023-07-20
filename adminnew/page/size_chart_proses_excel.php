<?php 
  $server= "localhost";
  $user= "tailordigital_user";
  $pass= "d#V1fQ@1q9.p";

  $db= "tailordigital_reseller";
  $connect = mysqli_connect($server, $user, $pass, $db) or die('DB Not Connected'.mysqli_error());
  $dbselect= mysqli_select_db($connect,$db);



//     date_default_timezone_set("Asia/Bangkok");
// $server = "localhost";

// $username = "rabbanico_bani";

// $password="matakhade2021";

// $database = "rabbanico_banimp"; 

// mysql_connect($server,$username,$password) or die("Koneksi gagal");

// mysql_select_db($database) or die("Database tidak bisa dibuka");




require('import-excel/php-excel-reader/excel_reader2.php');

require('import-excel/SpreadsheetReader.php');





//upload data excel kedalam folder uploads

$target_dir = "import-excel/uploads/".basename($_FILES['filemhsw']['name']);



move_uploaded_file($_FILES['filemhsw']['tmp_name'],$target_dir);



$Reader = new SpreadsheetReader($target_dir);



foreach ($Reader as $Key => $Row)

{

 // import data excel mulai baris ke-3 (karena ada header pada baris 1 dan 2)

 if ($Key < 2) continue;   



 $s1="SELECT kode_kategori FROM size_chart_kategori WHERE kategori LIKE '%$Row[2]%'";

 $q1=mysqli_query($connect, $s1);

 list($kode_kategori)=mysqli_fetch_array($q1);



 $s2="SELECT kode FROM size_chart_master";

 $q2=mysqli_query($connect, $s2);



   $nilai=2;

   while(list($kode_size)=mysqli_fetch_array($q2)){



      $nilai++;

       $query=mysqli_query($connect, "INSERT INTO size_chart(barcode,kategori,size,nilai) 

        VALUES ('".$Row[0]."', '".$kode_kategori."','".$kode_size."','".$Row[$nilai]."')");



   }





}



if ($query) {

  echo "Import data berhasil";

}else{

  echo mysqli_error();

}


$log = date('Ymdhis');

echo"<script>document.location=\"size_chart.php?log=$log\";</script>";

 



?>