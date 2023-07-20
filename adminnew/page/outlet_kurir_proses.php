<?php 
include"../connect.php";

$id=$_POST['temp_id'];

$temp_outlet=$_POST['temp_outlet'];
$temp_kurir=$_POST['temp_kurir'];
$temp_layanan=$_POST['temp_layanan'];

$jenis=$_POST['jenis'];
$kurir=$_POST['kurir'];
$layanan=$_POST['layanan'];
$status=$_POST['status'];
$origin=$_POST['origin'];
$date=date('Y-m-d H:i:s');


if ($jenis=="tambahoutletkurir"){
  
  $sql="INSERT INTO outlet_kurir (id_outlet,id_kurir,id_layanan,update_date,status,id_origin)
        VALUES ('$id','$kurir','$layanan','$date','$status','$origin')";
  //echo"okes";
  $query=mysqli_query($connect, $sql) or die ($sql);
  
  if($query){
     echo "kurir seller berhasil ditambah";
   } else {
	   
	 echo"gagal input";  
	}
  
  
} else if ($jenis=="editoutletkurir") {
   //echo"siapppppppppppp";

   $sql="UPDATE outlet_kurir
                SET  update_date = '$date',
                          status = '$status'
          WHERE    id_outlet = '$temp_outlet'
                AND id_kurir = '$temp_kurir'
              AND id_layanan = '$temp_layanan'";
  //echo"okes";
  $query=mysqli_query($connect, $sql) or die ($sql);
  
  if($query){
     echo "Update berhasil";
   } else {
	   
	 echo"gagal edit";  
  }
  
  	
}

?>