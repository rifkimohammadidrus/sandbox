<?php 
include("../connect.php");
if (isset($_POST['jenis'])) {
  $id=$_POST['temp_id'];
  $jenis=$_POST['jenis'];
  $kodereshare=$_POST['kodereshare'];
  $namareshare=$_POST['namareshare'];
  $alias=$_POST['alias'];
  $alamat=$_POST['alamat'];
  $provinsi=$_POST['provinsi'];
  $kota=$_POST['kota'];
  $no_telp=$_POST['no_telp'];
  $status=$_POST['status'];
  
  $wha=$_POST['wha'];
  $ig=$_POST['ig'];
}else {
  $id='';
  $jenis='';
  $kodereshare='';
  $namareshare='';
  $alias='';
  $alamat='';
  $provinsi='';
  $kota='';
  $no_telp='';
  $status='';
  
  $wha='';
  $ig='';
}
$date=date('Y-m-d H:i:s');


$fileName = $_FILES['userfile']['name'];  	

$uploaddir ='../../assets/images/outlet/';
$uploadfile = $uploaddir . $fileName;

if ($jenis=="tambahoutlet"){
  
  $sql="INSERT INTO outlet (id,nama,alias,telp,alamat,kota,provinsi,foto,banner,update_date,status,wha,ig)
        VALUES ('$kodereshare','$namareshare','$alias','$no_telp','$alamat','$kota','$provinsi','$fileName','','$date','$status','$wha','$ig')";
  //echo"okes";
  $query=mysqli_query($connect,$sql) or die ($sql);
  
  if($query){
	  move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile);
     echo "Outlet berhasil ditambah";
   } else {
	   
	 echo"gagal input";  
	}
  
  
} else if ($jenis=="editoutlet") {
   //echo"siapppppppppppp";

   if ($fileName!=''){
	   move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile);
        $sql="UPDATE outlet
              SET  foto = '$fileName'
              WHERE id = '$id'";
     //echo"okes";
     $query=mysqli_query($connect,$sql) or die ($sql);	
   }
   
   $sql="UPDATE outlet
          SET nama = '$namareshare',
             alias = '$alias',
              telp = '$no_telp',
            alamat = '$alamat',
              kota = '$kota',
          provinsi = '$provinsi',
       update_date = '$date',
            status = '$status',
               wha = '$wha',
               ig  = '$ig'
    WHERE id = '$id'";
  // echo $sql;
  $query=mysqli_query($connect,$sql) or die ($sql);
  
  if($query){
     echo "Update berhasil";
   } else {
	   
	 echo"gagal edit";  
  }
  
  	
}

?>