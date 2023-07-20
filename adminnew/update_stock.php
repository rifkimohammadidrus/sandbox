<?php
include"connect.php";
 
$barcode=$_POST['b'];
$qty_update=$_POST['q'];
$tgl=$_POST['t'];

$sql="update stock_in set `in`='$qty_update' where barcode='$barcode' and tgl='$tgl'";
$query=mysqli_query($connect, $sql) or die ($sql);

$sql2="update master_barang set stok='$qty_update' where id_barang='$barcode' and status='1'";
$query2=mysqli_query($connect, $sql2) or die ($sql2);

if (($query) and ($query2)){
echo"sukses";
} else {
echo"gagal";
}

?>