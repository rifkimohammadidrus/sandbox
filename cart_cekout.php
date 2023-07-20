<?php 
    session_start();
		include_once('template/koneksi.php'); 
	
		$kode_beli= session_id();
		$outlet=$_POST['o'];
	
		$jenis=$_POST['j'];
		$value_id=explode("-", $_POST['dt']);

 	if($jenis=='cekout'){
		for ( $i = 0; $i < count( $value_id ); $i++ ) {
			$id_barang = $value_id[$i];
			// echo $id_barang;
			$sql="SELECT mb.id_barang,jb.nama,u.ket_baru,w.warna,jb.gambar1,pd.harga,pd.qty,pd.amount,jb.berat,
			mb.kode_jenis,mb.kode_ukuran,mb.kode_warna,pd.disc,mb.disc,pd.id_outlet ,IFNULL(mb.stok,0)-pd.qty AS sisa  
			FROM master_barang AS mb  INNER JOIN pesan_detail AS pd ON (mb.id_barang=pd.id_barang) and (mb.id_outlet=pd.id_outlet)
			INNER JOIN jenis_barang AS jb ON (jb.kode_jenis=mb.kode_jenis)
			INNER JOIN ukuran AS u ON (u.kode_ukuran=mb.kode_ukuran)
			INNER JOIN warna AS w 	ON (w.kode_warna=mb.kode_warna)
			AND pd.no_transaksi='$kode_beli' and pd.id_barang IN ('$value_id[$i]')";
			$query=mysqli_query($connect,$sql);
			while(list($id,$nama,$ukuran,$warna,$gambar,$harga,$qty,$amount,$berat,$kodejenis,$kodeukuran, $kodewarna,$diskon,$kode_diskon,$id_outlet,$sisa_stok)=mysqli_fetch_array($query)){
				?>
				<div  class="row" style="border-bottom:1px solid #d9d9d9;" >
					<div id="keranjang"class="col-auto mr-auto mt-3" >
						<img class="img-cekout" src="assets/foto_produk/<?= $gambar ?>" style="width:61px; height:61px; margin-bottom:3px">	
					</div>
					<div id="mob-produk-keranjang" class="col mt-3">
						<h4 class="margin0 cekout-nama"><?= $nama ?></h4>
						<p class="margin0 keranjang-ukuran" style="font-size: 12px;"><?= $warna.', '.$ukuran.' '.$qty ?> Barang</p>
					</div>
					<div id="mob-produk-cekout" class="col-auto ml-auto mt-3">
						<!-- <p class="harga-promo-cekout"> 
							<span class="harga-awal">Rp.100.000</span>
						</p> -->
						<p class="harga-promo-cekout">
							<span class="">Rp. <?= number_format($harga,"0",".",",");  ?></span> 
						</p>
						<p class="harga-promo-cekout">
							<span class="harga-disc">Rp. <?= number_format($amount,"0",".",",");  ?></span> 
						</p>
					</div>
				</div>
				<input type="hidden" class="form-control" id="id_barang" name="id_barang[]" value="<?= $value_id[$i] ?>">
				<?php
			}
		}
			?>
			<input type="hidden" class="form-control" id="id_outlet" name="id_outlet" value="<?= $outlet ?>">
			<?php

	}else{
	   die('emptyChoice');	
	}
	
	
?>