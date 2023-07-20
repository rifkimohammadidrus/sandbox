<?php include ("template/header.php");?>
<?php include("template/navbar.php"); ?>
<link rel="stylesheet" href="assets/style_detail_produk.css" type="text/css" />

<section id="content" style="margin-bottom: 0px; ">

	<div class="content-wrap">
		<div id="title-mob" class="container mb-2">
			<a href="#">Kerudung Sekolah /</a>
			<a href="#">Kerudung Helmi</a>
		</div>
		<div id="mobile" class="container clearfix" >

			<!-- Post Content
			============================================= -->
			<div class="row">
				<div class="col" >
					<div class="tabs  clearfix" id="tab-9">
						<div class="tab-container">
							<div class="tab-content clearfix" id="tabs-33">
							<img class="img-fluid" src="assets/foto_produk/a.jpg" >
							</div>
							<div class="tab-content clearfix" id="tabs-34">
							<img src="assets/foto_produk/a.jpg">
							</div>
							<div class="tab-content clearfix" id="tabs-35">
							<img src="assets/foto_produk/a.jpg">
							</div>
						</div>
						<ul class="tab-nav clearfix" style="overflow-x: auto !important;">
							<li><a href="#tabs-33"><img src="assets/foto_produk/a.jpg"></a></li>
							<li><a href="#tabs-34"><img src="assets/foto_produk/a.jpg"></a></li>
							<li><a href="#tabs-35"><img src="assets/foto_produk/a.jpg"></a></li>
						</ul>
					</div>
				</div>

				<div id="mob-produk" class="col mt-3">
					<h3 class="margin0">Nama Produk</h3>
					<p class="margin0 hilang" style="">Terjual 500++</p>
					<h1 class="rp">Rp.50.000</h1>
					<p class="margin0">50% <del>Rp.100.000</del></p>

					<p class="pilih">Pilih Size</p>
					<button type="button" class="btn btn-outline-secondary size">S</button>
					<button type="button" class="btn btn-outline-secondary size">M</button>
					<button type="button" class="btn btn-outline-secondary size">L</button>

					<p class="pilih">Pilih Warna</p>
					<button type="button" class="btn btn-outline-secondary">Merah</button>
					<button type="button" class="btn btn-outline-secondary">Kuning</button>
					<button type="button" class="btn btn-outline-secondary">Hijau</button>

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
	<style>
		h4.cekout-proses{
			margin: 15px 0;
			font-family: 'Roboto', sans-serif;
			font-size: 24px;
			line-height: 1;
			text-align: center;
			color: #b75ae2;
		}
		h4.cekout-nama{
			
			font-family: 'Roboto', sans-serif;  
			font-size: 14px;

			font-weight: normal;

			font-stretch: condensed;

			font-style: normal;

			line-height: 1.08;

			letter-spacing: normal;
			text-align: left;
			color: #000;
		}
		.harga-promo-cekout{
			margin-bottom: 10px !important;
		}
		.harga-promo-cekout span.harga-awal{ 
			margin-bottom: 10px !important;
			text-decoration: line-through;
    	font-family: 'Roboto', sans-serif;
			font-size: 13px;
			font-weight: bold;
			line-height: 1;
			float:right;
			color: #a7a7a7;
		}
		.harga-promo-cekout span.harga-disc{ 
    	font-family: 'Roboto', sans-serif;
			font-size: 16px;
			font-weight: bold;
			font-stretch: condensed;
			font-style: normal;
			line-height: 1;
			letter-spacing: normal;
			float:right;
			color: #000;
		}
		label {
			text-transform:capitalize !important;
			cursor:default !important;
			font-family: 'Inter Tight', sans-serif !important; 
			font-size: 16px !important;
			line-height: 1.5;
			letter-spacing: normal;
			text-align: left;
			color: #525252 !important;
			font-size: 16px;

			
		}
		#nama,#no_hp, #cod, #kirim_pesanan{
			background-color: #f4effd;
		}
		::-webkit-input-placeholder { /* Edge */
		color:#b75ae2 !important;
		}

		:-ms-input-placeholder { /* Internet Explorer */
		color:#b75ae2 !important;
		}

		::placeholder {
		color:#b75ae2 !important;
		}
		
		.custom-control-input:checked~.custom-control-label::before {
			color: #b75ae2;
			border-color: #b75ae2;
			box-shadow:none;
		}
		.custom-control-input:checked~label.custom-control-label.custom::before{
			background-color: #b75ae2;
			box-shadow:none;
		}
		.custom-control-input:checked~label.custom-control-label.custom{
			color: #b75ae2 !important;
		}
		.btn-custom{
			padding: 13px 34px 13px 35px;
			font-size: 18px;
			font-weight: 500 !important;
			border-color: #b75ae2 !important;
			color:#b75ae2 !important;
		}
		.btn-outline-secondary{
			font-family: 'Roboto', sans-serif !important;
		}
		@media (min-width:412px) and (max-width: 767px){
			.btn-custom{
				padding: 9.6px 20.3px 8.4px 25.9px;
				font-size: 14px;
			}
			label {
				font-size: 14px !important;
		}
	}@media (max-width:411px){
		.btn-custom{
				padding: 8.6px 15.3px;
				font-size: 14px;
			}
			label {
				font-size: 14px !important;
		}
	}
	</style>

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
				<div class="modal-footer">
				</div>
			</div>
		</div>
	</div>
</section><!-- #content end -->
<?php include ("template/footer.php");?>