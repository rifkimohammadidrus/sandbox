<!DOCTYPE html>

<html>

<head>

 <title>Mari Belajar Coding</title>

 <?php

    $server = "localhost";

    $username = "rabbanico_bani";

    $password="matakhade2021";

    $database = "rabbanico_banimp"; 

    mysql_connect($server,$username,$password) or die("Koneksi gagal");

    mysql_select_db($database) or die("Database tidak bisa dibuka");

 ?>

</head>

<body>



 <table>

                

  <form method="post" enctype="multipart/form-data" >

   <tr>

    <td>Pilih File</td>

    <td><input name="filemhsw" type="file" required="required"></td>

   </tr>

   <tr>

    <td></td>

    <td><input name="upload" type="submit" value="Import"></td>

   </tr>

  </form>

 </table>

 <?php

 if (isset($_POST['upload'])) {



  require('php-excel-reader/excel_reader2.php');

  require('SpreadsheetReader.php');



  //upload data excel kedalam folder uploads

  $target_dir = "uploads/".basename($_FILES['filemhsw']['name']);

  

  move_uploaded_file($_FILES['filemhsw']['tmp_name'],$target_dir);



  $Reader = new SpreadsheetReader($target_dir);



  foreach ($Reader as $Key => $Row)

  {

   // import data excel mulai baris ke-2 (karena ada header pada baris 1)

   if ($Key < 2) continue;   



   $s1="SELECT kode_kategori FROM size_chart_kategori WHERE kategori LIKE '%$Row[2]%'";

   $q1=mysql_query($s1);

   list($kode_kategori)=mysql_fetch_array($q1);



   $s2="SELECT kode FROM size_chart_master";

   $q2=mysql_query($s2);



     $nilai=2;

     while(list($kode_size)=mysql_fetch_array($q2)){



        $nilai++;

         $query=mysql_query("INSERT INTO size_chart(barcode,kategori,size,nilai) 

          VALUES ('".$Row[0]."', '".$kode_kategori."','".$kode_size."','".$Row[$nilai]."')");





     }





  }

  if ($query) {

    echo "Import data berhasil";

   }else{

    echo mysql_error();

   }

 }

 ?>

 <h2>Data Size Chart Kategori</h2>

 <table border="1">

  <tr>

   <th>No</th>

   <th>Barcode</th>

   <th>Kategori</th>

   <th>size</th>
   <th>nilai</th>   

  </tr>

  <?php   

  $no=1;

  $data = mysql_query("select * from size_chart");

  while($d = mysql_fetch_array($data)){

   ?>

   <tr>

    <td><?=$no++; ?></td>

    <td><?=$d['barcode']; ?></td>

    <td><?=$d['kategori']; ?></td>

    <td><?=$d['size']; ?></td>    

    <td><?=$d['nilai']; ?></td>

   </tr>

   <?php 

  }

  ?>

 </table>

</body>

</html>