<style>
  @media (min-width:200px) and (max-width: 767px){
          .nama-biro{
            display:none;
          }
          .mob-l{
            display:none;
          }
          .link-search-style{
            background-color: #b75ae2; 
            width: 100%; 
            height: 100px;
            top:0%
          }
          .nama-biro-mob{
            margin-top:-40px;
            margin-left:25px; font-size:13px;
            color:#fff;
            text-transform: capitalize;
            font-weight:350;
            font-family: Roboto;
            margin-bottom: 9px;
          }
        }
        @media (min-width: 768px) and (max-width: 1200px){
          .nama-biro{
            display:none;
          }
          .nama-biro-mob{
            display:none;
          }
        }
        @media (min-width:1201px){
          .nama-biro-mob{
            display:none;
          }
        }
</style>
<div class="topbar animated fadeOutRight"></div>
	<!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="clearfix">

<header class="full-header static-sticky header-style">
<header id="header" class="full-header static-sticky header-style akunmobile">
		
		<div class="link-style">
			<div class="link-style-right akunmobile">
					<a href="https://wa.me/628112346165?text" class="seller"><font class="login-font">Hubungi Seller</font></a> &nbsp;&nbsp;&nbsp;					
					<a href="https://wa.me/628112346165?tex" class="seller"><font class="login-font">Gabung Reseller</font></a> &nbsp;&nbsp;&nbsp;
					<a href="https://member.rabbani.id/" class="seller"><font class="login-font">Gabung Member Digital</font></a> 
          <?php if ($_SESSION['id_outlet']) { ?>
            &nbsp;&nbsp;&nbsp;<a href="adminnew"><font class="login-font">Kelola Toko</font></a>
          <?php
          } ?>
			</div>
		</div>

		<div class="link-search-style" style="border-bottom:5px solid #ff3eb2;  
    border-bottom-left-radius: 20px;
    border-bottom-right-radius: 20px;">
      <?php 
        $kode_beli=session_id();
        $t="SELECT no_transaksi from pesan_detail where  no_transaksi='$kode_beli'";
        $qt=mysqli_query($connect,$t) or die ($t);
	      $rowcount=mysqli_num_rows($qt);
        if ($nama_toko) { $link= 'toko-'.$nama_toko.'-'.$outlet;}else {  $link= ''; }
      ?>   
			<div class="link-search-style-right">
				<form action="produk.php" id="cari_produk" method="POST">
          <a href="<?php echo $link; ?>" class="mob-r"><img src="assets/images/logo/ico_logo_rabbani.png" alt="rabbani"></a>
          <a href="<?php echo $link; ?>" class="mob-l"><img src="assets/images/logo/biro.png" alt="biro"></a>
          <a href="<?php echo $link; ?>" class="mob-l"><img src="assets/images/logo/wani.png" alt="wani"></a>
          <a href="<?php echo $link; ?>" class="nama-biro"><span><?php if ($nama_toko) { echo '| Biro ' .$nama_toko;} ?></span></a>
          <input type="hidden" name="id_outlet" value='<?= $id_outlet?>'>
          <input type="hidden" name="nama_toko" value='<?= $nama_toko?>'>
          <input type="text" name="cari" id="cari"  class="input-cari place akunmobile" placeholder="Cari Produk">
          <button class="button-cari akunmobile">CARI</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <a href="cart.php"><i class="icon-shopping-cart icon-13xx"></i>
            <?php 
            if( $rowcount!=''){ ?>
            <span class='badge badge-warning' id='lblCartCount'><?php echo  $rowcount;?></span>
            <?php 
              }
            ?>
          </a>
        </form>
		  </div>
		</div>
    <div class="nama-biro-mob"  >
    <i class="icon-map-marker1">&nbsp;</i><span > <?php if ($nama_toko) { echo 'Biro' .$nama_toko;} ?></span>
    </div>
		
	<!-- </div> -->
</header>
</div>