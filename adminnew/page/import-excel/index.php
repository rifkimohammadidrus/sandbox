<!DOCTYPE html>
<html>
<head>
 <?php
    include "../../connect.php";
    date_default_timezone_set('Asia/Jakarta');
    $datetime=date('Y-m-d H:i:s');
    $date=date('Y-m-d');
 ?>
</head>
<body>
  <table>
    <form method="post" enctype="multipart/form-data" >
      <tr>
        <td>Pilih File</td>
        <td><input name="filemhsw" type="file" required="required"></td>
        <td align="right"><input type="button" name="kembali" value="Kembali" onclick="window.history.back();"></td>
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

        foreach ($Reader as $Key => $Row){

       // import data excel mulai baris ke-3 (karena ada header pada baris 1 dan 2)
        if ($Key < 2) continue;   

        $s1="SELECT kode_kategori FROM size_chart_kategori WHERE kategori LIKE '%$Row[2]%'";
        $q1=mysql_query($s1);
        list($kode_kategori)=mysql_fetch_array($q1);

        $s2="SELECT kode FROM size_chart_master";
        $q2=mysql_query($s2);

        $nilai=2;

          while(list($kode_size)=mysql_fetch_array($q2)){
            $nilai++;

            $query=mysql_query("REPLACE INTO size_chart(barcode,kategori,size,nilai,upload_date) 

              VALUES ('".$Row[0]."', '".$kode_kategori."','".$kode_size."','".$Row[$nilai]."','".$datetime."')");

          } // end while

        } // end if

      if ($query){
        //echo "Import data berhasil";
      }else{
        echo mysql_error();

      }

  } // end if

 ?>

<table width="80%" align="center">
  <tr bgcolor="#abe7ed">
      <th rowspan="2">No</th>
      <th rowspan="2">Barcode</th>
      <th rowspan="2">Nama Barang</th>
      <th rowspan="2">Keterangan</th>
      <th colspan="5">Size</th>
  </tr>
  <tr bgcolor="#abe7ed">
      <th>1-2</th>
      <th>3-4</th>
      <th>5-6</th>
      <th>7-8</th>
      <th>9-10</th>
  </tr>
  <tr>
      <th colspan="9" style="background:#abe7ed"></th>
  </tr>
  <?php 

    $s="SELECT  jb.kode_jenis,jb.nama
          FROM  jenis_barang AS jb
                INNER JOIN size_chart AS sc ON (sc.`barcode`=jb.`kode_jenis`)
          WHERE sc.upload_date LIKE '$date%'
                GROUP BY jb.kode_jenis 
                ORDER BY jb.nama";
    $q=mysql_query($s);
    $nom;
    while (list($kdj_utama,$nama_utama)=mysql_fetch_array($q)) {
    $nom++;

  ?>
  <tr style="background:#abe7ed">
      <td><?php echo $nom;?></td>
      <td><?php echo $kdj_utama;?></td>
      <td><?php echo $nama_utama;?></td>
      <td><?php echo $kategori;?></td>
      <td align="center" colspan="5"></td>
  </tr>
  <?php
     $sql="SELECT  jb.kode_jenis,jb.nama,sck.kode_kategori,sck.kategori
            FROM  jenis_barang AS jb
                  INNER JOIN size_chart AS sc ON (sc.`barcode`=jb.`kode_jenis`)
                  INNER JOIN size_chart_kategori AS sck ON (sck.`kode_kategori`=sc.`kategori`)
           WHERE  jb.kode_jenis='$kdj_utama' 
                  GROUP BY jb.`kode_jenis`,sck.kategori 
                  ORDER BY jb.`kode_jenis`";
    $query=mysql_query($sql);
    while (list($kdj,$jenis_barang,$kdk,$kategori)=mysql_fetch_array($query)) {
  ?>
  <tr>
      <td></td>
      <td></td>
      <td></td>
      <td><?php echo $kategori;?></td>

      <?php
          $sqls="SELECT   jb.kode_jenis,sc.`nilai`
                    FROM  jenis_barang AS jb
                          INNER JOIN size_chart AS sc ON (sc.`barcode`=jb.`kode_jenis`)
                          INNER JOIN size_chart_master AS scm ON (scm.`kode`=sc.`size`)
                    WHERE   jb.kode_jenis='$kdj' AND sc.kategori='$kdk'
                        GROUP BY sc.`size` 
                        ORDER BY scm.`size`";
          $querys=mysql_query($sqls);
          while (list($jns,$nilai)=mysql_fetch_array($querys)) {
      ?>
      <td align="center"><?php echo $nilai;?></td>
      <?php }?>

  </tr>
  <?php 

    } // end while
  ?>
  <tr>
      <th colspan="9" style="background:#abe7ed"></th>
  </tr>
  <?php

  } // end while

  ?>
 

</table>
</body>

</html>