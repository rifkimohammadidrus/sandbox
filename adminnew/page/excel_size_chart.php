<?php
	ob_start();

	include "../../connect.php";
	$jenis=$_GET['jenis'];

	if($jenis=='baju'){
		$bagian="('B')";
	}elseif($jenis=='celana'){
		$bagian="('C')";
	}elseif($jenis=='kerudung'){
		$bagian="('K')";
	}elseif($jenis=='mukena'){
		$bagian="('M')";
	}elseif($jenis=='ikhwan'){
		$bagian="('B','C')";
	}elseif($jenis=='akhwat'){
		$bagian="('B','C','K')";
	}elseif($jenis=='gamis'){
		$bagian="('B','K')";
	}

	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=size_chart_$jenis.xls");
	header("Pragma: no-cache");
	header("Expires: 0");
?>
<table border="1">
	<tr align="center">
		<td rowspan="2" bgcolor="yellow">Barcode</td>
		<td rowspan="2" bgcolor="yellow">Nama</td>
		<td rowspan="2" bgcolor="yellow">kategori</td>
		<td colspan="5" bgcolor="yellow">Size</td>
	</tr>
	<tr align="center">
		<td bgcolor="yellow"><font color="yellow">'</font>1-2</td>
		<td bgcolor="yellow"><font color="yellow">'</font>3-4</td>
		<td bgcolor="yellow"><font color="yellow">'</font>5-6</td>
		<td bgcolor="yellow"><font color="yellow">'</font>7-8</td>
		<td bgcolor="yellow"><font color="yellow">'</font>9-10</td>
	</tr>
	<?php 
		$sql="SELECT kategori FROM size_chart_kategori WHERE bagian IN $bagian";
		$query=mysqli_query($connect, $sql);
		while(list($kategori)=mysqli_fetch_array($query)){
	?>
	<tr>
		<td>XN00000</td>
		<td>Bani Sample</td>
		<td bgcolor="yellow"><?php echo $kategori;?></td>

		<td align="center">0</td>
		<td align="center">0</td>
		<td align="center">0</td>
		<td align="center">0</td>
		<td align="center">0</td>
	</tr>
	<?php
		}
	?>
</table>
<?php
	mysql_close();
?>