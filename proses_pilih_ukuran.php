<?php 
include_once('template/koneksi.php'); 

$warna=$_POST['w'];
//$subwarna=substr("$warna",0,1);

$kodejenis=$_POST['k'];
$kodeoutlet=$_POST['o'];


// $cek_warna="SELECT w.warna,mb.stok FROM master_barang AS mb INNER JOIN warna AS w ON (mb.kode_warna=w.kode_warna)
//  WHERE SUBSTRING(mb.kode_warna,1,1)='$warna'  AND  mb.kode_jenis='$kodejenis' AND mb.id_outlet='$kodeoutlet'";
// $qcek_warna=mysql_query($cek_warna) or die ($cek_warna); 
// list($nama_warna,$stok)=mysql_fetch_array($qcek_warna);
$date=date('Y-m-d');
$date_yesterday = date('Y-m-d', strtotime('-1 days', strtotime($date)));
	


$cek_size= mysqli_query($connect,"SELECT mb.kode_ukuran, u.ukuran, u.ket_baru, mb.id_barang 
												FROM master_barang AS mb 
                        INNER JOIN ukuran AS u ON (u.kode_ukuran=mb.kode_ukuran) 
                        WHERE mb.kode_jenis='$kodejenis' AND `status`=1 AND mb.kode_warna='$warna' and mb.stok>0 
                        and mb.id_outlet='$kodeoutlet' GROUP BY u.kode_ukuran");
	// echo "<option value=''>Ukuran tersedia</option>";
	while(list($kodeukuran,$ukuran,$ket,$kodebarang)=mysqli_fetch_array($cek_size)){
			if($ket==''){
				$ket_fix=$ukuran;
			} else {
				$ket_fix=$ket;
			}
			$sql="SELECT stok from master_barang where kode_jenis='$kodejenis' and kode_ukuran IN ('$kodeukuran') and kode_warna='$warna' 
			and status=1 and stok>0 and id_outlet='$kodeoutlet'";

			$query=mysqli_query($connect,$sql); //or die($sql);'300','XNZ7EK0','B04042111150002'
			list($jml)=mysqli_fetch_array($query);


			$sql_cek="SELECT SUM(qty)
            FROM pesan_detail WHERE SUBSTRING(id_barang,1,7)='$kodejenis' 
						AND SUBSTRING(id_barang,8,2)IN ('$kodeukuran')
            AND SUBSTRING(id_barang,13,3)='$warna' and tanggal between '$date_yesterday' and '$date' and id_outlet='$kodeoutlet'";
			$query_cek=mysqli_query($connect,$sql_cek) ; // or die ($sql_cek);
			list($jml_pesan)=mysqli_fetch_array($query_cek);	

		?>
		<style>.disabled_size{
			cursor:auto !important;
			background-color:#D8D8D8;
		}
		.disabled_size:hover {
			box-shadow: #D8D8D8;
			color: black;
			background-color: #D8D8D8;
			border-color:#8d8d8d !important;
		}
		
		.disabled_size:active {
			background-color: #D8D8D8 !important;
			border-color:  #8d8d8d !important;
		}
		</style>
		<div class="button" >
			<input type="radio" id="<?php echo $kodeukuran ?>" name="size" onclick="pilihsize('<?php echo $kodeukuran ?>','<?php echo $kodebarang ?>','<?php echo $kodeoutlet ?>')" value="<?php echo $kodeukuran ?>" <?php if (($jml<=0) or ($jml_pesan >= $jml)){echo"disabled"; }?>/>
			<label class="btn btn-outline-secondary size <?php if (($jml<=0) or ($jml_pesan >= $jml)){echo"disabled_size"; }?>" for="<?php echo $kodeukuran ?>"><?php echo $ket_fix; ?></label>
		</div>
<?php } ?>


