<?php include ("template/header.php");?>
<?php include("template/navbar.php"); ?>


<section id="content" style="margin-bottom: 0px; ">

	<div class="content-wrap">
		<div id="title-mob" class="container mb-2">
			<a href="#">Kerudung Sekolah /</a>
			<a href="#">Kerudung Helmi</a>
		</div>
		<div id="mobile" class="container clearfix" style="background-color:#fff; border-radius:8px">

			<!-- Post Content
			============================================= -->
			<div class="row">
				<div class="col" >
					<div id="indikator" class="carousel slide" data-ride="carousel" data-interval="false">
						<div class="carousel-inner">
							<div class="carousel-item active">
								<img id="img-preview" src="assets/foto_produk/a.jpg">
							</div>
							<div class="carousel-item">
								<img id="img-preview" src="assets/foto_produk/a.jpg">
							</div>
							<div class="carousel-item">
								<img id="img-preview" src="assets/foto_produk/a.jpg">
							</div>
						</div>
						<ol class="carousel-indicators ">
							<li data-target="#indikator" data-slide-to="0" class="active"><img src="assets/foto_produk/a.jpg"></li>
							<li data-target="#indikator" data-slide-to="1"><img src="assets/foto_produk/a.jpg"></li>
							<li data-target="#indikator" data-slide-to="2"><img src="assets/foto_produk/a.jpg"></li>
						</ol>
					</div>
				</div>

				<div id="mob-produk" class="col mt-3">
					<h3 class="margin0">Nama Produk</h3>
					<p class="margin0 hilang" style="">Terjual 500++</p>
					<h1 class="rp">Rp.50.000</h1>
					<p class="margin0">50% <del>Rp.100.000</del></p>

					<p class="pilih">Pilih Size</p>
					<div>
						<div class="button">
							<input type="radio" id="a25" name="Size" />
							<label class="btn btn-outline-secondary size" for="a25">S</label>
						</div>
						<div class="button">
							<input type="radio" id="a50" name="Size" />
							<label class="btn btn-outline-secondary size" for="a50">M</label>
						</div>
						<div class="button">
							<input type="radio" id="a75" name="Size" />
							<label class="btn btn-outline-secondary size" for="a75">L</label>
						</div>
					</div>
				
					<p class="pilih">Pilih Warna</p>
					<div>
						<div class="button">
							<input type="radio" id="w1" name="warna" />
							<label class="btn btn-default" for="w1">Coklat</label>
						</div>
						<div class="button">
							<input type="radio" id="w2" name="warna" />
							<label class="btn btn-default" for="w2">Navy</label>
						</div>
						<div class="button">
							<input type="radio" id="w3" name="warna" />
							<label class="btn btn-default" for="w3">Hitam</label>
						</div>
						<div class="button">
							<input type="radio" id="w4" name="warna" />
							<label class="btn btn-default" for="w4">Putih</label>
						</div>
					</div>
					<p class="pilih">Kuantitas</p>
					<div class="quantity clearfix" >
						<div class="kuantitas">
							<input type="button" value="-" class="minus btn-sm" style="">
							<input type="text" name="quantity" value="1" class="qty btn-sm" style=" ">
							<input type="button" value="+" class="plus btn-sm" style="">
						</div>
					</div><br><br><br>
					<button type="button" class="btn btn-outline-secondary tebal">Masukan Keranjang</button> &emsp;
					<button type="button" class="btn btn-outline-secondary tebal" data-toggle="modal" data-target="#cekout">Beli Sekarang</button>
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
					<h4 style="margin-bottom: 0px !important;">Spesifikasi Produk</h4>
					<p style="margin-bottom: 0px !important;">Bahan: Katun</p>
					
					<p class="pilih">Deskripsi Produk</p>
					<p style="margin-bottom: 0px !important;">porttitor magna, vitae venenatis dolor consectetur sit amet. Morbi velit nulla, pharetra sed magna sit amet, condimentum dignissim elit. Curabitur auctor ligula sed arcu porta, eget feugiat felis venenatis. Suspendisse sed porttitor leo. Donec at nisl arcu. Ut non nisi sollicitudin, ultrices metus quis, pulvinar odio. In suscipit ex nec est rhoncus scelerisque. Morbi nisl velit, gravida a sapien ut, elementum imperdiet lacus. Pellentesque venenatis metus lectus, vitae suscipit arcu faucibus ornare. Nullam et felis sapien. Curabitur euismod nisi in convallis venenatis. Fusce quis pulvinar nunc. Phasellus pretium volutpat enim quis egestas. In dui mi, pharetra eu nunc sed, porttitor consectetur ante. In ligula turpis, cursus ac velit sed, fermentum efficitur urna.
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
								<img class="img-cekout" src="assets/foto_produk/a.jpg" style="width:61px; height:61px; margin-bottom:3px">	
							</div>

							<div id="mob-produk-keranjang" class="col mt-3">
								<h4 class="margin0 cekout-nama">Nama Produk Jika panjang namanya</h4>
								<p class="margin0 keranjang-ukuran" style="font-size: 12px;">Hitam, XL  1 Barang</p>
							</div>
							<div id="mob-produk-cekout" class="col-auto ml-auto mt-3">
								<p class="harga-promo-cekout"> 
									<span class="harga-awal">Rp.100.000</span>
								</p>
								<p class="harga-promo-cekout">
									<span class="harga-disc">Rp. 50.000</span> 
								</p>
							</div>
						</div>
					</div>
					<br>
					<form>
						<!-- <div class="container"> -->
							<div class="form-group">
								<label class="label" for="FormControlInput1">Nama Lengkap</label>
								<input type="text" class="form-control cekout" id="nama" placeholder="Nama Lengkap Pemesan">
							</div>
							<div class="form-group">
								<label class="label" for="exampleFormControlInput1">No Handphone (WhasApp)</label>
								<input type="text" class="form-control" id="no_hp" placeholder="0812xxxx">
							</div>
							<div class="custom-control custom-radio custom-control-inline">
								<input type="radio" id="cod" name="rd" class="custom-control-input" value="cod">
								<label class="custom-control-label custom" for="cod">COD (Ambil Ditoko)</label>
							</div>
							<div class="custom-control custom-radio custom-control-inline radio-kirim">
								<input type="radio" id="kirim_pesanan" name="rd" class="custom-control-input" value="kirim">
								<label class="custom-control-label custom" for="kirim_pesanan">Kirim Pesanan</label>
							</div>
							<div id="alamat" class="form-group mt-2" >
								<label class="label" for="exampleFormControlInput1">Alamat Rumah</label>
								<input type="text" class="form-control" id="no_hp" placeholder="Jl.Citarum ..">
							</div>
						<!-- </div> -->
						<div class=" mt-4">
							<button type="button" class="btn btn-outline-secondary btn-custom" data-dismiss="modal">Kembali Ke Menu</button>
							<button type="button" class="btn btn-outline-secondary btn-custom" style="float:right">Lanjut Pembelian</button>
						</div>
					</form>
				</div>
				
			</div>
		</div>
	</div>
</section><!-- #content end -->
<?php include ("template/footer.php");?>