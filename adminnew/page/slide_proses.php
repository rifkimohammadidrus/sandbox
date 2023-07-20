<?php 
include"../connect.php";

$id=$_POST['temp_id'];
$judul=$_POST['judul'];
$link=$_POST['link'];
$status=$_POST['status'];
$date=date('Y-m-d H:i:s');
$jenis=$_POST['jenis'];


$fileName = $_FILES['userfile']['name'];  	
$fileName = str_replace(" ","-",$fileName);

$uploaddir ='../../images/dm/';
$uploadfile = $uploaddir . $fileName;

if ($jenis=="tambahslide"){
  
  $sql="INSERT INTO slide_home (judul,images,`text`,link,update_date,update_user,`status`)
        VALUES ('$judul','$fileName','','$link','$date','admin','$status')";
  //echo"okes";
  $query=mysqli_query($connect, $sql) or die ($sql);
  
  if($query){
	  move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile);
     echo "slide berhasil ditambah";
   } else {
	   
	 echo"gagal input";  
	}
  
  
} else if ($jenis=="editslide") {
   //echo"siapppppppppppp";

   if ($fileName!=''){
	   move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile);
        $sql="UPDATE slide_home SET  images='$fileName' WHERE id = '$id'";
     //echo"okes";
     $query=mysqli_query($connect, $sql) or die ($sql);	
   }
   
   $sql="UPDATE slide_home
         SET 
          judul = '$judul',
          link = '$link',
          `status` = '$status'
        WHERE id = '$id'";
  //echo"okes";
  $query=mysqli_query($connect, $sql) or die ($sql);
  
  if($query){
     echo "Update berhasil";
   } else {
	   
	 echo"gagal edit";  
  }
  
  	
}

?>