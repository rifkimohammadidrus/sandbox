<?php 
include"../connect.php";
if (isset($_POST['temp_id'])) {
  $id=$_POST['temp_id'];
}
$jenis=$_POST['jenis'];
$username=$_POST['username'];
$password=$_POST['password'];
$level=$_POST['level'];
$nama=$_POST['nama'];
$outlet=$_POST['outlet'];
$status=$_POST['status'];
$date=date('Y-m-d H:i:s');




if ($jenis=="tambahuser"){
  
  $sql="INSERT INTO user (username,password,level,nama,email,id_outlet,status)
        VALUES ('$username','$password','$level','$nama','','$outlet','$status')";
  //echo"okes";
  $query=mysqli_query($connect,$sql) or die ($sql);
  
  if($query){
     echo "user berhasil ditambah";
   } else {
	   
	 echo"gagal input";  
	}
  
  
} else if ($jenis=="edituser") {
   //echo"siapppppppppppp";
   
   $sql="UPDATE user
        SET username = '$username',
            password = '$password',
            level = '$level',
            nama = '$nama',
            id_outlet = '$outlet',
            status = '$status'
    WHERE username = '$id';";
  //echo"okes";
  $query=mysqli_query($connect,$sql) or die ($sql);
  
  if($query){
     echo "Update berhasil";
   } else {
	   
	 echo"gagal edit";  
  }
  
  	
}

?>