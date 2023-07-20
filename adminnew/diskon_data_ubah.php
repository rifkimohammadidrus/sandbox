<?php session_start();
include"connect.php";
$kode=$_POST['b'];
$status=$_POST['s'];


$sql="update tbl_disc_item set status=$status where id_diskon='$kode'";
$query=mysqli_query($connect,$sql) or die ($sql);




if ($query){
  echo"sukses";	
}



?>