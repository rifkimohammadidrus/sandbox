<?php 
include("connect.php");
$notrans=$_GET[no];

$cek="select kode_track from pesan where no_transaksi='$notrans'";
$qcek=mysqli_query($connect, $cek);
list($kode_track)=mysqli_fetch_array($qcek);

$sql="SELECT id,tracking FROM tracking ORDER BY urutan ASC";
$query=mysqli_query($connect, $sql);
?>
<select onchange="update_tracking('<?php echo $notrans?>')" id="combotrack_<?php echo $notrans;?>">
	<?php while(list($idt,$trackname)=mysqli_fetch_array($query)){?>
		<option value='<?php echo $idt ?>' <?php if($kode_track==$idt){ echo"selected"; }?> ><?php echo $trackname ?></option>
	 <?php }
	?>
</select>
