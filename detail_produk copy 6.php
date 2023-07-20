<?php include ("template/header.php");?>
<?php include("template/navbar.php"); ?>
<?php 


// diskon persentase cekout Langsung

    // $id_outlet=decrypt($_GET['otl']);
    $name=$_GET['produk'];
		$name=str_replace("-"," ",str_replace("_",".",$name));
	
		$modelproduk="SELECT kode_jenis,nama,gambar1,gambar2,bahan_dasar,berat,deskripsi,gambar3,gambar4,gambar5,kode_kategori
									FROM jenis_barang WHERE nama='$name'";
		$qmodelproduk=mysqli_query($connect,$modelproduk);
		// echo $modelproduk;
		list($idb,$nama,$image1,$image2,$bahan,$berat,$deskripsi,$image3,$image4,$imagekiri,$kategori)=mysqli_fetch_array( 
		$qmodelproduk ); 
		$nama_url=str_replace(" ","-",$nama);

		$otl="select nama from outlet where id='$id_outlet'";
		$q_otl=mysqli_query($connect,$otl);
		list($namaoutlet)=mysqli_fetch_array($q_otl);
		

		// Cek Qty Jenis Barang Vs Size Chart

		$s_cp="SELECT SUM(a.cek) AS cek 
			FROM (	SELECT 	a.barcode,jb.kode_jenis,
					IF(a.barcode=jb.kode_jenis,0,1) AS cek
				FROM (	SELECT barcode 
					FROM 	size_chart 
						GROUP BY barcode
					) AS a
				LEFT JOIN jenis_barang AS jb ON (jb.kode_jenis=a.barcode)
				) AS a";
		$q_cp=mysqli_query($connect,$s_cp);
		list($cp)=mysqli_fetch_array($q_cp);


		//  Cek Setting Show Hide Size Chart

		$s_set="SELECT nilai FROM size_chart_setting";
		$q_set=mysqli_query($connect,$s_set);
		list($set)=mysqli_fetch_array($q_set);

  ?>
	<?php 
		// GET HARGA TERENDAH BESERTA HARGA DISKONNYA JIKA ADA
		$qharga="SELECT harga, disc,substring(id_barang,1,7) 
					FROM master_barang WHERE kode_jenis='$idb' and status=1 and stok>0 
					group by harga order by harga ASC LIMIT 1";
		$query_harga=mysqli_query($connect,$qharga);//or die ($qharga);
		// echo $qharga."<br><br>";
		list($harga1,$disc1,$barcode1)=mysqli_fetch_array($query_harga);            
				
		$q_disc="SELECT td.disc_value,td.start,td.end  FROM tbl_disc_item AS ti 
						INNER JOIN tbl_disc AS td ON (ti.id_diskon = td.id)
						WHERE  ti.barcode='$barcode1'  and td.outlet like '%$id_outlet%' AND ti.status=1";
		$query_disc=mysqli_query($connect,$q_disc); 
		list($persentase_disc1,$tglawal,$tglakhir)=mysqli_fetch_array($query_disc);

		if ($persentase_disc1==''){
			$qd="select disc_value,start,end from tbl_disc where status=1 AND outlet like '%$id_outlet%' ";
			$query_qd=mysqli_query($connect,$qd); 
			list($persentase_disc1,$tglawal,$tglakhir)=mysqli_fetch_array($query_qd);
		} 

		// cek apakah tanggal skg masih dalam periode diskon
		$now=date('Y-m-d');	
		if (($now>=$tglawal) and ($now<=$tglakhir)){
			$persentase_disc1=$persentase_disc1;	
		} else {
			$persentase_disc1=0;	
		}
  ?>
	<style>
		@media (max-width: 767px){
			
			.img-indikator{
				display:none;
			}
			.carousel-indicators{
				display:none;
			}
		}
	</style>
<section id="content" style="margin-bottom: 0px; ">

	<div class="content-wrap">
		<div id="title-mob" class="container mb-2">
			<!-- <a href="#">Kerudung Sekolah /</a> -->
			<a href="#"><?= $name ?></a>
		</div>
		<div id="mobile" class="container clearfix" style="background-color:#fff; border-radius:8px">

			<!-- Post Content
			============================================= -->
			<div class="row">
				<div class="col-md-6" >
					<div id="indikator" class="carousel slide" data-ride="carousel" data-interval="false">
						<div class="carousel-inner">
							<?php if ($image1!=''){?>
								<div class="carousel-item active">
									<img id="img-preview" src="assets/foto_produk/<?php echo $image1; ?>">
								</div>
							<?php }

							if ($image2!=''){?>
								<div class="carousel-item">
									<img id="img-preview" src="assets/foto_produk/<?php echo $image2; ?>">
								</div>
							<?php }
							if ($image3!=''){?>
								<div class="carousel-item">
									<img id="img-preview" src="assets/foto_produk/<?php echo $image3; ?>">
								</div>
							<?php }
							if ($image4!=''){?>
								<div class="carousel-item">
									<img id="img-preview" src="assets/foto_produk/<?php echo $image4; ?>">
								</div>
							<?php }?>
						</div>
						<ol class="carousel-indicators ">
							<?php if ($image1!=''){?>
								<li data-target="#indikator" data-slide-to="0" class="active"><img class="img-indikator" src="assets/foto_produk/<?= $image1 ?>">-</li>
							<?php }

							if ($image2!=''){?>
								<li data-target="#indikator" data-slide-to="1" class="active"><img class="img-indikator" src="assets/foto_produk/<?= $image2 ?>">-</li>
							<?php }
							if ($image3!=''){?>
								<li data-target="#indikator" data-slide-to="2"><img class="img-indikator" src="assets/foto_produk/<?= $image3 ?>">-</li>
							<?php }
							if ($image4!=''){?>
								<li data-target="#indikator" data-slide-to="3"><img class="img-indikator" src="assets/foto_produk/<?= $image4 ?>">-</li>
							<?php }?>
							
							
							
						</ol>
					</div>
				</div>
				<?php 
					$nilai_diskon1=($persentase_disc1/100)*$harga1;
					$harga_diskon1=$harga1-$nilai_diskon1; 

							// GET HARGA TERtinggi BESERTA HARGA DISKONNYA JIKA ADA
					$qharga2="SELECT harga, disc,substring(id_barang,1,7) 
										FROM master_barang WHERE kode_jenis='$idb' and status=1 and stok>0 
										group by harga order by harga DESC LIMIT 1";
					$query_harga2=mysqli_query($connect,$qharga2);// or die ($qharga2);
					list($harga2,$disc2,$barcode2)=mysqli_fetch_array($query_harga2);
							
					$q_disc2="SELECT td.disc_value,td.start,td.end  FROM tbl_disc_item AS ti 
											INNER JOIN tbl_disc AS td ON (ti.id_diskon = td.id)
											WHERE  ti.barcode='$barcode2' AND ti.status=1";
					$query_disc2=mysqli_query($connect,$q_disc2);// or die ($q_disc2);
					list($persentase_disc2,$tglawal2,$tglakhir2)=mysqli_fetch_array($query_disc2);
							
					if ($persentase_disc2==''){
						$qa2="select disc_value,start,end from tbl_disc where status=1 and outlet like '%$id_outlet%'";
						
						$query_qa2=mysqli_query($connect,$qa2);// or die ("salah query2");
						list($persentase_disc2,$tglawal2,$tglakhir2)=mysqli_fetch_array($query_qa2);    
					}

					if (($now>=$tglawal2) and ($now<=$tglakhir2)){
						$persentase_disc2=$persentase_disc2;	
					} else {
						$persentase_disc2=0;	
					}

					$nilai_diskon2=($persentase_disc2/100)*$harga2;
					$harga_diskon2=$harga2-$nilai_diskon2;	
					// echo"$harga1-$harga2-$nilai_diskon1-$nilai_diskon2";
				?>       				

			
				<div id="mob-produk" class="col detail-p">
					<h3 class="margin0" style="font-size: 20px; margin-top:16px"><?= $name ?></h3>
					<!-- <p class="margin0 hilang"><?php echo $persentase_disc2 ;?></p> -->
					<h1 class="rp" id="show_price">Rp. <?php 
						echo number_format("$harga_diskon1",0,".",",");
						if($harga_diskon2>$harga_diskon1){
						echo " - ".number_format("$harga_diskon2",0,".",",");	
						}
						?></h1>
					<input type="hidden" name="harga1" id="harga1">
					<!-- <p class="margin0">50% <del>Rp.100.000</del></p> -->

					
					
					<p class="pilih">Pilih Warna</p>
					<div>
					<?php 
					$sqlw="SELECT mb.kode_warna,w.css,w.warna,w.images,mb.supplier 
						FROM master_barang AS mb INNER JOIN warna AS w ON (mb.kode_warna=w.kode_warna) 
						WHERE kode_jenis='$idb' and mb.status=1 and mb.stok>0 and mb.id_outlet='$id_outlet' 
						group by mb.kode_warna";
						$queryw=mysqli_query($connect,$sqlw);
						while(list($kdw,$kcss,$warna,$wimages,$wsupp)=mysqli_fetch_array($queryw)){
							?>
							<div class="button">
								<input type="radio" class="warna" id="<?php echo $kdw;?>" name="warna" value="<?php echo $kdw;?>" onclick="pilihwarna('<?php echo $kdw;?>','<?php echo $idb ?>','<?php echo $id_outlet ?>');" />
								<label class="btn btn-default" for="<?php echo $kdw;?>"><?php echo $warna?></label>
							</div>
						<?php 
						}
						?>
						
					</div>

					<p class="pilih">Pilih Size</p>
					<?php
						$sql_scm="SELECT 	jb.kode_jenis,scm.`size`
									FROM 	jenis_barang AS jb
											INNER JOIN size_chart AS sc ON (sc.`barcode`=jb.`kode_jenis`)
											INNER JOIN size_chart_master AS scm ON (scm.`kode`=sc.`size`)
									WHERE 	jb.kode_jenis='$idb' 
											GROUP BY sc.`size` 
											ORDER BY scm.`size`";
						$query_scm=mysqli_query($connect,$sql_scm);
					?>
					<div id="size_choise">

						<?php while (list($kd_scm,$size_scm)=mysqli_fetch_array($query_scm)) { ?>
							<div class="button" >
								<input type="radio" id="<?= $size_scm;?>" name="size"  value="<?= $size_scm;?>"  />
								<label class="btn btn-outline-secondary size" for="<?= $size_scm;?>"><?= $size_scm;?></label>
							</div>
						<?php } ?>

					</div>
					<div id="tampil_ukuran">
						
					</div>
					<?php 
						// $c="select stok,harga from master_barang where id_barang='$idb' and id_outlet='$id_outlet'";
						// $qc=mysqli_query($connect, $c);
						// list($stok,$harga)=mysqli_fetch_array($qc); 
					?>
					<p class="pilih">Kuantitas</p>
					<div class="quantity clearfix" >
						<div class="kuantitas">
							<input type="button" value="-" class="minus btn-sm">
							<input type="text" id="qty" name="quantity" value="1" class="qty btn-sm">
							<input type="button" value="+" class="plus btn-sm">
						</div>
					</div><br><br><br>
					<button type="button" class="btn btn-outline-secondary tebal" onclick="masukanKeranjang('<?php echo $idb?>','<?php echo $id_outlet;?>', '<?php echo $kode_beli;?>')"><i class="icon-shopping-cart"></i> Masukan Keranjang</button> &emsp;
					<button type="button" onclick="beliSekarang()" class="btn btn-outline-secondary tebal" >Beli Sekarang</button>
				</div>
			</div>
			<div id="mob-share" class="share">
				<a href="" style="color:black"><i class="icon-share1"></i>&nbsp; Share</a> &emsp;&emsp;
				<a href="" style="color:black"><i class="icon-line-heart"></i> &nbsp; Favorit</a>
			</div>
			<!-- .postcontent end -->
			<br>
		</div>

		<div id="mobile" class="container clearfix mt-2" style="background-color:#fff; border-radius:8px ">

			<!-- Post Content
			============================================= -->
			<div class="row">
				<div id="mob-produk" class="col mt-3">
					<!-- <h4 style="margin-bottom: 0px !important;">Spesifikasi Produk</h4>
					<p style="margin-bottom: 0px !important;">Bahan: Katun</p> -->
					
					<p class="pilih">Deskripsi Produk</p>
					<p style="margin-bottom: 0px !important;"><?= $deskripsi;?>
					</p>
				</div>
			</div>
			<!-- .postcontent end -->
			<br>
		</div>
	</div>

	<!-- Button trigger modal -->


	<!-- Modal -->
	<div class="modal fade" id="cekout" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				
				<div class="modal-body">
					<div id="mobile" class="container">
						<h4 class="cekout-proses">Proses Pembelian</h4>
						<div class="row" style="border-bottom:1px solid #d9d9d9;">
							<div id="keranjang"class="col-auto mr-auto mt-3" >
								<img class="img-cekout" src="assets/foto_produk/<?= $image1 ?>" style="width:61px; height:61px; margin-bottom:3px">	
							</div>

							<div id="mob-produk-keranjang" class="col mt-3">
								<h4 class="margin0 cekout-nama"><?php echo $name;?></h4>
								<span class="margin0 keranjang-ukuran" id="warna_terpilih"  style="font-size: 12px;"></span> 
								<span class="margin0 keranjang-ukuran" style="font-size: 12px;">,</span> 
								<span class="margin0 keranjang-ukuran" id="size_terpilih"  style="font-size: 12px;"></span>&nbsp;
								<span class="margin0 keranjang-ukuran" id="qty_terpilih"  style="font-size: 12px;"></span>
								<span class="margin0 keranjang-ukuran" style="font-size: 12px;">Barang</span>
							</div>
							<div id="mob-produk-cekout" class="col-auto ml-auto mt-3">
								<!-- <p class="harga-promo-cekout"> 
									<span class="harga-awal">Rp.100.000</span>
								</p> -->
								<p class="harga-promo-cekout">
									<span class="harga-disc" id="total_harga">Rp.</span> 
								</p>
							</div>
						</div>
					</div>
					<br>
					<form method="post" id="formPesanLangsung">
						<input type="hidden" name="kode" id="kode" value="<?php echo $idb;?>">
						<input type="hidden" name="id_outlet" id="id_outlet" value="<?php echo $id_outlet;?>">
						<input type="hidden" name="color_selected" id="color_selected">
						<input type="hidden" name="size_selected" id="size_selected">
						<input type="hidden" name="qty_selected" id="qty_selected">
						<input type="hidden" name="total_selected" id="total_selected">
						<input type="hidden" name="harga" id="harga">
						<input type="hidden" name="disc" id="disc" value="<?php echo $persentase_disc2 ;?>">
						<input type="hidden" name="tanda" id="tanda" value="cekoutLangsung">
						<input type="hidden" name="sess_id" value="<?php echo $kode_beli ?>">
						<div class="form-group mt-1">
							<label class="label" for="exampleFormControlInput1">No Handphone (WhatsApp)</label>
							<input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="0812xxxx" required>
						</div>
						<div class="form-group">
							<label class="label" for="FormControlInput1">Nama Lengkap</label>
							<input type="text" class="form-control cekout" id="nama" name="nama" placeholder="Nama Lengkap Pemesan" required>
						</div>
						<div class="custom-control custom-radio custom-control-inline">
							<input type="radio" id="cod" name="metode_pengiriman" class="custom-control-input" value="cod" required>
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
							<button type="submit" id="" class="btn btn-outline-secondary btn-custom" style="float:right">Lanjut Pembelian</button>
						</div>
					</form>
				</div>
				
			</div>
		</div>
	</div>

	<div class="modal fade" id="error" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				
				<div class="modal-body">
					<div id="mobile" class="container">
						<h4 class="cekout-proses" style="color: red !important">Pilih Ukuran dan Warna yang tersedia</h4>
					</div>
					<br>
					<form>
						<div class=" text-center">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						</div>
					</form>
				</div>
				
			</div>
		</div>
	</div>

	<div class="modal fade" id="notif" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-body">
					<div id="mobile" class="container">
						<h4 class="cekout-proses">Pesanan Diproses</h4>
							<div id="mob-produk-cekout" class="col-auto ml-auto mt-3">
								<p class="text-center" style="font-family: 'Inter Tight', sans-serif !important; font-weight:600 !important;">
									Terima kasih telah berbelanja di toko kami<br>
									Silahkan tunggu beberapa saat, admin toko kami akan mengirim pesan whatsapp untuk metode pembayaran
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
<script type="text/javascript" src="assets/js/detailproduk.js"></script>
<script src="assets/js/format.number.min.js"></script>	
