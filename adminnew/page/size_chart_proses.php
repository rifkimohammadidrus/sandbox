<?php 
include"connect.php";

 $sql="SELECT nilai FROM size_chart_setting";
 $query=mysqli_query($connect, $sql);
 list($nilai)=mysqli_fetch_array($query);

if($nilai==1){
	$ganti=0;
}else{
	$ganti=1;
}

$sqlp="UPDATE size_chart_setting SET nilai=$ganti";
$res=mysqli_query($connect, $sqlp) or die($sqlp);


if($ganti==0){
	echo"<script>alert('Size Chart Berhasil ditutup');</script>";
}else{
	echo"<script>alert('Size Chart Berhasil ditampilkan');</script>";
}

$log = date('Ymdhis');
echo"<script>document.location=\"size_chart.php?log=$log\";</script>";
?>