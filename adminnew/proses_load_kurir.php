<?php
include"connect.php";

$kurir = $_GET['kurir'];
$query = mysqli_query($connect, "SELECT id,nama_layanan FROM kurir_layanan WHERE id_kurir='$kurir'");
echo "<option value=''>Pilih Layanan</option>";
while(list($idl,$layanan)=mysqli_fetch_array($query)){
    echo "<option value=$idl>$layanan</option> \n";
}
?>
