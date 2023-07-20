<style>
  .img-fluid {
    width: 100%;
    height: 338px !important;
    border-radius: 8px;
    
  }
  .breadcrumb-item + .breadcrumb-item::before {
    display: inline-block;
    color: #6c757d;
    content: none !important;
    
  }
  .breadcrumb a {
    font-size:16px !important;
    font-family: 'Inter Tight', sans-serif;
    font-size: 14px;
    color: #6a6a6a;
    font-weight: 600;
  }
  .breadcrumb li {
  text-align:center;
  padding-left:30px !important;
  }

  p.jenis-kategori{
    font-family: 'Roboto', sans-serif;
    font-size: 24px;
    font-weight: bold;
    color: #525252;
  }
  .aktif{
    color:#b75ae2 !important;
  }
  .garis{
    margin-top:8px;
    width:85px;
    display:block;
    margin-left: 4px;
    
  }
  .link-dropdown:active{
    background-color:#fff;
    color: #b75ae2;
    font-weight:300px;
  }
  .link-dropdown:hover{
    background-color:#fff;
    color: #b75ae2;
    font-weight:300px;
  }
  .dropdown-item:hover, .dropdown-item:focus {
    
    background-color: #fff !important;
  }
  .btn-outline-dropdown:focus{
    background-color: #b75ae2 !important;
    box-shadow: 0 0 0 0.2rem  #b75ae2 !important;
    color:#fff !important;
  }
  @media (min-width:412px) and (max-width: 767px){
    .img-fluid {
      height:200px !important;
    }
    .breadcrumb a {
      font-size:12px !important;
      font-family: 'Inter Tight', sans-serif;
      color: #6a6a6a;
      font-weight: 400;
    }
    .breadcrumb li {
    text-align:center;
    margin-left:10px !important;
    height: 30px;
    }

    p.jenis-kategori{
      font-family: 'Roboto', sans-serif;
      font-size: 16px;
      font-weight: bold;
      color: #525252;
    }
    .btn-outline-dropdown{
      font-size:12px !important;
      font-weight: 400 !important;
    }
    .garis{
      width:40px;
      margin-left: 0px;
    }
    .breadcrumb-item + .breadcrumb-item {
      padding-left: 1.2rem !important;
    }
  }
  @media (max-width:411px){
    .img-fluid {
      height: 146px !important;
    }
    .breadcrumb {
      flex-wrap: nowrap;
    }
    .breadcrumb a {
      font-size:12px !important;
      font-family: 'Inter Tight', sans-serif;
      color: #6a6a6a;
      font-weight: 400;
    }
    .breadcrumb li {
    text-align:center;
    margin-left:0px !important;
    }

    p.jenis-kategori{
      font-family: 'Roboto', sans-serif;
      font-size: 14px;
      font-weight: bold;
      color: #525252;
    }
    .btn-outline-dropdown{
      font-size:11.5px !important;
      font-weight: 400 !important;
    }
    .garis{
      width:40px;
      margin-left: 0px;
    }
    .breadcrumb-item + .breadcrumb-item {
      padding-left: 1.2rem !important;
    }
    .boxed-slider{
      padding-top: 8px !important;
    }
    .box-slide{
      padding-left: 8px !important;
      padding-right: 8px !important;
    }
    .content-wrap {
      margin-top: -70px;
    }
  }
</style>
<section id="slider" class="slider-element boxed-slider">
  <div id="mobile-slider" class="container clearfix box-slide">
      <img src="assets/images/banner.png" class="img-fluid" alt="Responsive image">
  </div>
</section>


<section id="page-title">

  <div class="container clearfix">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="promo-<?php echo $nama_toko ?>-<?= $outlet ?>" class="<?php echo $promo ?> text-center" >Promo</a> <div class="garis " style="<?php echo $garis_promo ?>"></div></li>
      <li class="breadcrumb-item"><a href="terlaris-<?php echo $nama_toko ?>-<?= $outlet ?>" class="<?php echo $terlaris ?>" >Terlaris</a> <div class="garis " style="<?php echo $garis_terlaris ?>"></div></li>
      <li class="breadcrumb-item"><a href="terbaru-<?php echo $nama_toko ?>-<?= $outlet ?>" class="<?php echo $terbaru ?>">Terbaru</a><div class="garis " style="<?php echo $garis_terbaru ?>"></div></li>
      
      <li class="breadcrumb-item options">
      <div class="btn-group" style="margin-top:-7px; font-family: 'Inter Tight', sans-serif; ">
        <button type="button" id="btn-outline-dropdown" class="btn-outline-dropdown btn  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style=" font-weight: 600;   color: #6a6a6a;">
          Kategori
        </button>
        <div class="dropdown-menu dropdown-menu-right text-center"> 
          <?php $sql="SELECT kode_kategori,nama_kategori,images FROM kategori WHERE `status`=1 order by  urutan ASC";
							$query=mysqli_query($connect,$sql) or die ('wrong command category mobile');
							while(list($idk,$kat,$image)=mysqli_fetch_array($query)){
								$kat=strtolower($kat);
								$url_kat=str_replace(" ","-", $kat);
                ?>
            <a class="dropdown-item link-dropdown" style="font-family: 'Inter Tight', sans-serif; font-size: 14px !important;font-weight: 500; text-transform: capitalize;" href="produk-<?= $nama_toko ?>-<?= $outlet ?>-category-<?php echo $url_kat;?>"><?php echo $kat;?></a>
          <?php } ?>
          
        </div>
      </div>
      <div class="<?php //echo $garis_kategori ?>"></div>
      </li>
     
    </ol>
    <p class="jenis-kategori"><?php echo $judul ?></p >
  </div>
  
</section>


