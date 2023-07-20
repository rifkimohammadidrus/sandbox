<?php 
ob_start();
$transno=$_POST['transno'];
header("Content-type: application/vnd.ms-excel");//application/vnd.ms-excel asal application/x-msdownload
header("Content-Disposition: attachment; filename=transaksi_$transno.xls");
header("Pragma: no-cache");
header("Expires: 0");

include"connect.php";

/*$tgl1=$_POST['tgl1'];
$tgl2=$_POST['tgl2'];*/

$sql="SELECT SUBSTRING(pd.id_barang,1,12) AS itemcode, jb.nama,RIGHT(pd.id_barang,3) AS variant,pd.harga,pd.qty,pd.disc,pd.amount 
FROM pesan_detail AS pd LEFT JOIN pesan AS p ON (p.no_transaksi=pd.no_transaksi)
                        LEFT JOIN jenis_barang AS jb ON (jb.kode_jenis=SUBSTRING(pd.id_barang,1,7))
WHERE  p.no_transaksi='$transno'   "; 

//echo $sql;
$query=mysqli_query($connect, $sql)or die($sql);


?>

<table width="0" border="1">
  <tr>
    <td>Items Code</td>
    <td>Items Name</td>
    <td>Vrnt Cd</td>
    <td>Unit Price</td>
    <td>Qty</td>
    <td>Disc</td>
    <td>Sub Total</td>
    <td>POLY_BAG</td>
    <td>POIN</td>
    <td>A</td>
    <td>B</td>
    <td>C</td>
    <td>D</td>
  </tr>
  
<?php 
while (list($itemcode,$nama,$variant,$harga,$qty,$disc,$subtotal)=mysqli_fetch_array($query)){
if ($disc==''){
$disc=0;
}

$persentase_diskon=($disc/$subtotal*100);
$tot_subtotal=$subtotal-$disc;
    ?>
  <tr>
   <td><?php echo  $itemcode; ?></td>
	<td><?php echo  $nama; ?></td>
	<td><?php echo  $variant; ?></td>
    <td align="right"><?php echo  $harga; ?></td>
    <td align="right"><?php echo  $qty; ?></td>
    <td align="right"><?php echo  $persentase_diskon; ?></td>
    <td align="right"><?php echo  $tot_subtotal; ?></td>
    <td align="right"><?php echo  "0";?></td>
    <td align="right"><?php echo  "0"; ?></td>
    <td><?php echo  "-1";?></td>
    <td><?php echo  "0"; ?></td>
    <td><?php echo  "0"; ?></td>
	<td><?php echo  "0"; ?></td>
  </tr>
 <?php } ?> 
</table>
