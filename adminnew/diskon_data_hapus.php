<?php session_start();
include"connect.php";
$kode=$_POST['b'];


$sql="delete from tbl_disc_item where id_diskon='$kode'";
$query=mysqli_query($connect, $sql) or die ($sql);




if ($query){
  echo"sukses";	
}



?>