<?php include ("template/header.php");?>
<?php include("template/navbar.php"); ?>
<?php 


$session_kode_beli= session_id();
	//mengarahkan user untuk belanja di outlet yang sama dengan terakhir dia pesan
	$k="SELECT  o.alias from pesan_detail as pd INNER JOIN outlet as o ON (pd.id_outlet=o.id) 
				where pd.no_transaksi='$session_kode_beli' 
				order by pd.tanggal_waktu DESC LIMIT 1 ";
	$qk=mysqli_query($connect,$k);
	list($url_outlet)=mysqli_fetch_array($qk);
				
	//tampilkan detail barang yang dipesan
	$sql="SELECT mb.id_barang,jb.nama,u.ket_baru,w.warna,jb.gambar1,pd.harga,pd.qty,pd.amount,jb.berat,
				mb.kode_jenis,mb.kode_ukuran,mb.kode_warna,pd.disc,mb.disc,pd.id_outlet ,IFNULL(mb.stok,0)-pd.qty AS sisa  
			FROM master_barang AS mb  INNER JOIN pesan_detail AS pd ON (mb.id_barang=pd.id_barang) and (mb.id_outlet=pd.id_outlet)
			INNER JOIN jenis_barang AS jb ON (jb.kode_jenis=mb.kode_jenis)
			INNER JOIN ukuran AS u ON (u.kode_ukuran=mb.kode_ukuran)
			INNER JOIN warna AS w 	ON (w.kode_warna=mb.kode_warna)
			WHERE pd.no_transaksi='$session_kode_beli' ";
			//ORDER BY pd.id_outlet,pd.amount DESC 
	$query=mysqli_query($connect,$sql);
	// echo $url_outlet;
	// if($_SESSION['email']=='budiyantoro@rabbani.co.id'){
	// 	#echo $sql;	
	// }
	$rowcount=mysqli_num_rows($query);
	?>
<script src="assets/js/cartF.js?d=<?= date('YmdHis');?>"></script>
<script src="assets/js/format.number.min.js"></script>	
<style>
	.btn-cekout{
		font-size: 18px !important;
		padding: 10px 48px;
		font-weight: 500 !important;
		border-color: #b75ae2 !important;
		background-color: #b75ae2 !important;
		color:#b75ae2 !important;
		color:white !important;
	}
	@media (max-width: 767px){
		.btn-cekout{
			font-size: 14px !important; 
		}
	}
	
</style>	
<section id="content" style="margin-bottom: 0px; ">
<div class="content-wrap" style="background-color:white !important">
		<div id="title-mob" class="container mb-2">
			<h2>Keranjang</h2>
		</div>
		<div id="mobile" class="container clearfix">
			
			<?php if ($rowcount !=0) {
				?>
				<div class="row">
					<div class="col-auto mr-auto mt-3" >
						<div class="form-check mb-3">
							<input class="form-check-input" type="checkbox" id="checkAll">
							<label class="form-check-label" for="flexCheckDefault">
								Pilih Semua
							</label>
						</div>
					</div>		
					<div class="col" >
						<button type="button" id="btn-hapus-semua">Hapus Semua</button>
					</div>		
				</div>
				<!-- Post Content
				============================================= -->
				<?php 
				$outlet_sblmnya='';
				$tot_amount=0;
				$no=1;
				while(list($id,$nama,$ukuran,$warna,$gambar,$harga,$qty,$amount,$berat,$kodejenis,$kodeukuran, $kodewarna,$diskon,$kode_diskon,$id_outlet,$sisa_stok)=mysqli_fetch_array($query)){
						$persentase_diskon=(($diskon/$amount)*100);	
					$subtotal=$amount-$diskon;
					$o="select nama,alias from outlet where id='$id_outlet'";
					$qo=mysqli_query($connect,$o);
					list($nama_outlet,$outlet_alias)=mysqli_fetch_array($qo);
					
					$show_outlet=0;
					if($outlet_sblmnya==''){
						$outlet_sblmnya=$nama_outlet;
						$show_outlet=1;
					}
					if($outlet_sblmnya!=$nama_outlet){
						$outlet_sblmnya=$nama_outlet;
						$show_outlet=1;
					}
					if($show_outlet==1){?>
					<!-- <tr>
						<td colspan="6"><a href="outlet-<?= $outlet_alias;?>">Store :<?= $nama_outlet; ?></a></td>
					</tr> -->
					<?php 
					}
					?>
					<div class="row" style="border-top:2px solid #d9d9d9;">
						<div id="keranjang"class="col-auto mr-auto mt-2" >
							<input class="checkItem check1" type="checkbox" id="cek_<?php echo $id.'_'.$id_outlet;?>" name="check" value="<?php echo $id ?>" data-id="<?php echo $subtotal ?>">
							<!-- <input class="checkItem check1" type="checkbox" name="check" id="cek_<?php echo $id.'_'.$id_outlet;?>" value="<?php echo $subtotal ?>"> -->
							<img class="img-keranjang" src="assets/foto_produk/thumbnail/<?= $gambar?>" alt="<?= $nama;?>">	
						</div>
	
						<div id="mob-produk-keranjang" class="col mt-1">
							<h4 class="margin0 keranjang-nama"><?= $nama;?></h4>
							<p class="margin0 keranjang-ukuran"><?= $warna;?>, <?= $ukuran;?></p>
							<p class="harga-promo-keranjang">
								<span class="disc"id="dc_<?= $id.'_'.$id_outlet;?>"><?= $persentase_diskon." %"; ?></span> 
								<!-- <span><?= $session_kode_beli;?>_<?= $id?></span> -->
								<span class="harga-awal">Rp.100.000</span> <br>
								<span class="harga-disc"id="pr_<?= $id.'_'.$id_outlet;?>">Rp. <?= number_format($harga,"0",".",",");?></span> 
<!-- subtotal hide -->
								<span style=" " class=" subtotal" id="am_<?php echo $id.'_'.$id_outlet;?>">Rp. <?php echo number_format($subtotal,"0",".",",");?></span>
								<input type="hidden" name="tot_ammount"  id="subtotal<?= $no++ ?>" value="<?php echo $subtotal ?>">
							</p>
							<div id="keranjang-quantity" class="quantity clearfix " >
								<div class="kuantitas">
	
									<input type="button" value="-" class="minus btn-sm" onClick="del('<?= $id; ?>','<?= $id_outlet; ?>')">
									<input type="text" name="quantity" id="q_<?= $id.'_'.$id_outlet;?>" value="<?= $qty?>" class="qty btn-sm" readonly/>
									<input type="button" value="+" class="plus btn-sm" onClick="add('<?= $id; ?>','<?= $id_outlet; ?>')">
								</div>
							</div>
							<input type="button" id="keranjang-btn" value="Hapus" class="remove" title="Remove this item" onclick="hapus_item('<?= $id;?>')">
						</div>
					</div>
					<br>
					<?php 
				
					$tot_amount+=$subtotal;
				}
				?>
				<br>
				<div class="row" style="border-top:2px solid #d9d9d9;">
					<div id="mob-produk-keranjang " class="col mt-3 center">
					
						<!-- <button style="background-color:transparent; border:none !important; float:left" class><h3 class="rp" id="total"></h3></button> -->
	
						<!-- <button style="background-color:transparent; border:none !important; " class><h1 class="rp" id="show_price1">Rp. <?php echo number_format("$tot_amount",0,".",",");?></h1></button> -->
	
						<button type="button" class="btn btn-outline-secondary btn-cekout"  id="d1" >Cekout</button>
					</div>
				</div>
				<br>
				<!-- .postcontent end -->
			<?php }?>
		
		</div>
	</div>


		<!-- Modal -->
	<div class="modal fade" id="cekout_keranjang" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-body">
					<div id="mobile" class="container">
						<h4 class="cekout-proses">Proses Pembelian</h4>
						<form id="formAdd" action="" method="post">
							<div id="barang_cekout">
							</div>
							<div class="form-group mt-1">
								<label class="label" for="exampleFormControlInput1">No Handphone (WhasApp)</label>
								<input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="0812xxxx" required>
							</div>
							<div class="form-group">
								<label class="label" for="FormControlInput1">Nama Lengkap</label>
								<input type="text" class="form-control cekout" id="nama" name="nama" placeholder="Nama Lengkap Pemesan" required>
							</div>
							<div class="custom-control custom-radio custom-control-inline">
								<input type="radio" id="cod" name="metode_pengiriman" class="custom-control-input" value="cod">
								<label class="custom-control-label custom" for="cod">COD (Ambil Ditoko)</label>
							</div>
							<div class="custom-control custom-radio custom-control-inline radio-kirim">
								<input type="radio" id="kirim_pesanan" name="metode_pengiriman" class="custom-control-input" value="kirim">
								<label class="custom-control-label custom" for="kirim_pesanan">Kirim Pesanan</label>
							</div>
							<div id="alamat" class="form-group mt-2" >
								<label class="label" for="exampleFormControlInput1">Alamat Rumah</label>
								<input type="text" class="form-control" id="alamat" name="alamat" placeholder="Jl.Citarum ..">
							</div>
							<div class=" mt-4">
								<button type="button" class="btn btn-outline-secondary btn-custom" data-dismiss="modal">Kembali Ke Menu</button>
								<button type="submit" class="btn btn-outline-secondary btn-custom" style="float:right" >Lanjut Pembelian</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="modal fade" id="notif" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-body">
					<div id="mobile" class="container">
						<h4 class="cekout-proses">Pembelian Diproses</h4>
						
							
							<div id="mob-produk-cekout" class="col-auto ml-auto mt-3">
								<p class="text-center" style="font-family: 'Inter Tight', sans-serif !important; font-weight:600 !important;">
									Pesanan anda sedang dalam proses <br>
									silahkan tunggu pesan whatsapp dari toko
									untuk metode pembayaran
								</p>
							</div>
							<div class="text-center mt-4">
								<button type="button" class="btn btn-outline-secondary btn-custom"  id="back_to_menu" >Kembali Ke Menu</button>
							</div>
					</div>
					
				</div>
				
			</div>
		</div>
	</div>
</section><!-- #content end -->


	
<?php include ("template/footer.php");?>