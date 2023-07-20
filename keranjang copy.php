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
						<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
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
				<input class="check1" type="checkbox" value="" id="flexCheckDefault" style="">
					<img class="img-keranjang" src="assets/foto_produk/a.jpg" >	
				</div>

				<div id="mob-produk-keranjang" class="col mt-3">
					<h4 class="margin0 keranjang-nama">Nama Produk Jika panjang namanya</h4>
					<p class="margin0 keranjang-ukuran" style="">Hitam, XL</p>
					<p class="harga-promo-keranjang">
            <span class="disc">50%</span> 
            <span class="harga-awal">Rp.100.000</span>
            <span class="harga-disc">Rp.50.000</span> 
          </p>
					<div id="keranjang-quantity" class="quantity clearfix " style="" >
						<div class="kuantitas">
              <input type="button" value="-" class="minus btn-sm" style="">
              <input type="text" name="quantity" value="1" class="qty btn-sm" style=" ">
              <input type="button" value="+" class="plus btn-sm" style="">
						</div>
					</div>
          <input type="button" id="keranjang-btn" value="Hapus" style="" >
				</div>
			</div>
      <br>
			<div class="row" style="border-top:2px solid #d9d9d9;">
				<div id="keranjang"class="col-auto mr-auto mt-3" >
				<input class="check1" type="checkbox" value="" id="flexCheckDefault" style="">
					<img class="img-keranjang" src="assets/foto_produk/a.jpg" >	
				</div>

				<div id="mob-produk-keranjang" class="col mt-3">
					<h4 class="margin0 keranjang-nama">Nama Produk Jika panjang namanya</h4>
					<p class="margin0 keranjang-ukuran" style="">Hitam, XL</p>
					<p class="harga-promo-keranjang">
            <span class="disc">50%</span> 
            <span class="harga-awal">Rp.100.000</span>
            <span class="harga-disc">Rp.50.000</span> 
          </p>
					<div id="keranjang-quantity" class="quantity clearfix " style="" >
						<div class="kuantitas">
              <input type="button" value="-" class="minus btn-sm" style="">
              <input type="text" name="quantity" value="1" class="qty btn-sm" style=" ">
              <input type="button" value="+" class="plus btn-sm" style="">
						</div>
					</div>
          <input type="button" id="keranjang-btn" value="Hapus" style="" >
				</div>
			</div>
      <br>
			<!-- .postcontent end -->
			<br>
		</div>
	</div>
</section><!-- #content end -->
<?php include ("template/footer.php");?>