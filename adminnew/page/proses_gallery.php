<?php 
include"../connect.php";
//echo"okeeeeeeeee";
$jenis=$_GET['jenis'];
$judul=$_POST['judul'];
$status=$_POST['status'];
$date=date('Y-m-d H:i:s');
$temp_id=$_POST['temp_id'];


if ($jenis=='ambasador'){
    // echo"hade";
	$foto=$_FILES['userfile']['name'];
	//$folder="../images/program_banner";
	if($foto!=""){
		move_uploaded_file($_FILES[userfile][tmp_name],"../../page/images/ambasador/$foto");
	}
	
	$sql="INSERT INTO tbl_ambasador
            (judul,
             images,
             update_date,
             update_user,
             `status`)
VALUES ('$judul',
        '$foto',
        '$date',
        'admin',
        '$status')";
$query=mysql_query($sql) or die ($sql);
if ($query){
	  echo"Foto berhasil di upload";
	} else {
	  echo"gagal";	
	}
		
	
} else if ($jenis=='ambasador_edit'){
	
	$foto=$_FILES['userfile']['name'];
	//$folder="../images/program_banner";
	if($foto!=""){
		move_uploaded_file($_FILES[userfile][tmp_name],"../../page/images/ambasador/$foto");
		$e="UPDATE tbl_ambasador SET images = 'images'
            WHERE id = '$temp_id'";
		$qe=mysql_query($e) or die ($e); 
	}
	
	$sql="UPDATE tbl_ambasador set judul='$judul',
          update_date = '$date',
          status = '$status'
          WHERE id = '$temp_id'";
    $query=mysql_query($sql) or die ($sql);  
    if ($query){
	    echo"Foto berhasil di edit";
	} else {
	    echo"gagal";	
	}
	
}
  


?>
