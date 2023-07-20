<?php
include"connect.php";

$provinsi = $_GET['provinsi'];
$kota =mysqli_query($connect, "SELECT kode_kota,nama_kota FROM kota WHERE kode_provinsi='$provinsi'");
echo "<option value=''>Pilih Kota</option>";
while(list($kodekota,$namakota)=mysqli_fetch_array($kota)){
    echo "<option value=$kodekota>$namakota</option> \n";
}
?>
