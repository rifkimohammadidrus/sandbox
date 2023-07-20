<?php include ("template/header.php");?>
<?php include("template/navbar.php"); ?>


<section id="content" style="margin-bottom: 0px; ">
<div class="content-wrap">
		<div id="title-mob" class="container mb-2">
			<h2>Keranjang</h2>
		</div>
		<div id="mobile" class="container clearfix" style="">
			
			
			<div class="row">
				<div class="col-auto mr-auto mt-3" >
					<div class="form-check mb-3">
						<input class="form-check-input" type="checkbox" value="" id="checkAll">
						<label class="form-check-label" for="flexCheckDefault">
							Pilih Semua
						</label>
					</div>
				</div>		
				<div class="col" >
					<input type="button" id="btn-hapus-semua" value="Hapus Semua">
				</div>		
			</div>
			<!-- Post Content
			============================================= -->

			<div class="row" style="border-top:2px solid #d9d9d9;">
				<div id="keranjang"class="col-auto mr-auto mt-3" >
					<input class="checkItem check1" type="checkbox" value="" id="flexCheckDefault" style="">
					<img class="img-keranjang" src="assets/foto_produk/a.jpg" >	
				</div>

				<div id="mob-produk-keranjang" class="col mt-3">
					<h4 class="margin0 keranjang-nama">Nama Produk Jika panjang namanya</h4>
					<p class="margin0 keranjang-ukuran" style="">Hitam, XL</p>
					<p class="harga-promo-keranjang">
            <span class="disc">50%</span> 
            <span class="harga-awal">Rp.100.000</span>
            <span class="harga-disc">Rp.50.000</span>
						<input type="hidden" id="harga_item1" value="50000"> 
          </p>
					<div id="keranjang-quantity" class="quantity clearfix " style="" >
						<div class="kuantitas">
              <input type="button" value="-" class="minus btn-sm" style="">
              <input type="text" id="qty1" name="quantity" value="4" class="qty btn-sm" style=" ">
              <input type="button" value="+" class="plus btn-sm" style="">
						</div>
					</div>
          <input type="button" id="keranjang-btn" value="Hapus" style="" >
				</div>
			</div>
      <br>
			<!-- <div class="row" style="border-top:2px solid #d9d9d9;">
				<div id="keranjang"class="col-auto mr-auto mt-3" >
					<input class="checkItem check1" type="checkbox" value="" id="flexCheckDefault" style="">
					<img class="img-keranjang" src="assets/foto_produk/a.jpg" >	
				</div>

				<div id="mob-produk-keranjang" class="col mt-3">
					<h4 class="margin0 keranjang-nama">Nama Produk Jika panjang namanya</h4>
					<p class="margin0 keranjang-ukuran" style="">Hitam, XL</p>
					<p class="harga-promo-keranjang">
            <span class="disc">50%</span> 
            <span class="harga-awal">Rp.100.000</span>
            <span class="harga-disc">Rp.50.000</span> 
						<input type="hidden" id="harga_item2" value="10000">
          </p>
					<div id="keranjang-quantity" class="quantity clearfix " style="" >
						<div class="kuantitas">
              <input type="button" value="-" class="minus btn-sm" style="">
              <input type="text" id="qty2" name="quantity" value="2" class="qty btn-sm" style=" ">
              <input type="button" value="+" class="plus btn-sm" style="">
						</div>
					</div>
          <input type="button" id="keranjang-btn" value="Hapus" style="" >
				</div>
			</div> -->
      <br>
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
			<div class="row" style="border-top:2px solid #d9d9d9;">
				<div id="mob-produk-keranjang " class="col mt-3 center">


				<input type="text" id="total" class="form-control" placeholder="Total" readonly="">


					<button type="button" class="btn btn-outline-secondary btn-cekout" data-toggle="modal" data-target="#cekout_keranjang">Cekout</button>
				</div>
			</div>
      <br>
			<!-- .postcontent end -->
		
		</div>
	</div>
		<!-- Modal -->
	<div class="modal fade" id="cekout_keranjang" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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