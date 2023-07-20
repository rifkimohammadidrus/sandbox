<?php include("template/header.php"); ?>
<?php include("template/navbar.php"); ?>

<?php 
if ($id_outlet) {

$kategori=$_GET['kat'];
if ($kategori=='all') {
  $judul='Semua Produk';
  $filter_kategori="GROUP BY jb.kode_jenis  HAVING SUM(mb.stok>0)
  ORDER BY tdi.barcode DESC";
}elseif ($kategori=='promo') {
  $promo="aktif"; $garis_promo="border-bottom: 4px solid #b75ae2;";
  $terlaris=""; $garis_terlaris="";$terbaru=""; $garis_terbaru="";
  $judul='Promo Toko';
  // $filter_kategori="and tdi.barcode <>'' and td.outlet like '%$id_outlet%'";
  $filter_kategori="GROUP BY jb.kode_jenis  HAVING SUM(mb.stok>0)
  ORDER BY tdi.barcode DESC";

}elseif ($kategori=='terlaris') {
  $terlaris="aktif"; $garis_terlaris="border-bottom: 4px solid #b75ae2;";
  $terbaru=""; $garis_terbaru="";$promo=""; $garis_promo=""; 
  $judul='Produk Terlaris';
  $filter_kategori="and t.qty>0 GROUP BY jb.kode_jenis  HAVING SUM(mb.stok>0)
  ORDER BY t.qty DESC";
}elseif ($kategori=='terbaru') {
  $terbaru="aktif"; $garis_terbaru="border-bottom: 4px solid #b75ae2;";
  $terlaris=""; $garis_terlaris="";$promo=""; $garis_promo=""; 
  $judul='Produk Terbaru';
  $filter_kategori="GROUP BY jb.kode_jenis  HAVING SUM(mb.stok>0)
  ORDER BY tdi.barcode DESC";
}else { 
  $terlaris=""; $garis_terlaris="";$terbaru=""; $garis_terbaru=""; $promo=""; $garis_promo=""; 
  $judul=$kategori;
  $filter_kategori="and k.nama_kategori like'%$kategori%' GROUP BY jb.kode_jenis  HAVING SUM(mb.stok>0)
  ORDER BY tdi.barcode DESC ";
}
include("template/slide.php"); ?>
<?php 
// if ($kategori=='promo') {
//   include('promo.php');
// }else{

$sql="SELECT SQL_CALC_FOUND_ROWS
      jb.kode_jenis
      , jb.nama
      , jb.gambar1
      , mb.harga
      , o.alias
      , kot.nama_kota
      , tdi.barcode
      , t.qty 
      , tdi.persen_diskon
      , tdi.potongan_harga
      , tdi.harga_diskon
      , td.start
      , td.end
      FROM jenis_barang as jb 
        INNER JOIN master_barang AS mb ON (jb.kode_jenis = mb.kode_jenis)
        INNER JOIN  outlet as o ON (o.id=mb.id_outlet) 	
          LEFT join kategori as k on (k.kode_kategori=jb.kode_kategori)
          LEFT join tbl_disc_detail as tdi on tdi.barcode=jb.kode_jenis
          LEFT join tbl_disc as td on td.outlet=mb.id_outlet
          LEFT JOIN terlaris AS t ON t.barcode=jb.kode_jenis
          LEFT join kota as kot on kot.kode_kota=o.kota
        WHERE jb.status=1 and mb.status=1 and  mb.id_outlet='$id_outlet' $filter_kategori";

  
    // echo $sql; die;
    $query=mysqli_query($connect,$sql) or die ("wrong query kategori");
  
?>
<section id="content" style="margin-bottom: 0px; ">
  <div class="container-fluid" style="background-color:#f5f5f5">

    <div id="mobile" class="container" >

      <div class="row pt-4 ">
        <?php while(list($idb,$nama,$image,$harga, $nama_outlet, $nama_kota,$barcode,$tqty,$persen_disc,$potongan_harga,$harga_diskon, $tglawal,$tglakhir)=mysqli_fetch_array($query)){ 
          

          // $no++;
          // echo $kategori; die;
          $nama=trim($nama);
          $nama_url=str_replace(" ","-",str_replace(".","_",$nama));

       

          
          //GET DISCOUNT PER ITEM IF EXIST
          // $qd="SELECT ti.persen_diskon,ti.potongan_harga,ti.harga_diskon, td.start,td.end FROM tbl_disc AS td LEFT JOIN tbl_disc_detail AS ti
          //   ON (ti.id_diskon=td.id) WHERE SUBSTRING(barcode,1,7)='$idb' and td.outlet like '%$id_outlet%' and td.status=1 
          //     GROUP BY SUBSTRING(barcode,1,7)"; 
          // $query_qd=mysqli_query($connect,$qd) or die ($qd);
          // list($persen_disc,$potongan_harga,$harga_diskon, $tglawal,$tglakhir)=mysqli_fetch_array($query_qd);
          
          // cek apakah tanggal skg masih dalam periode diskon
          $now=date('Y-m-d');	
          if (($now>=$tglawal) and ($now<=$tglakhir)){
            $persen_disc=$persen_disc;
            $potongan_harga=$potongan_harga;	
            $periode=1;
          } else {
            $persen_disc=0;	
            $potongan_harga=0;
            $periode=0;
          }
          if ($harga_diskon!='' and $periode==1) {
            $harga_diskon= $harga_diskon;
          }else{
            $harga_diskon=$harga;
          }
          //CONVERT PERCENT DISC TO NOMINAL & GET PRICE AFTER DISCOUNT
          // $nilai_diskon=($persen_disc/100)*$hargabarang;
          // $harga_diskon=$hargabarang-$nilai_diskon;
           ?>
          <?php 
           if ($kategori=='promo' && ($persen_disc ==0 && $potongan_harga==0)) {  
            
          // } else if ($kategori=='terlaris' && $tqty <1) {
            
          }else{
           ?>
            <div class="col pt-2 text-center" style="">
              <a href="detail-<?php echo $nama_toko ?>-url-<?php echo $nama_url?>-<?php echo $outlet; ?>">
              
              <div class="card"> 
                <img class="card-img-top" src="assets/foto_produk/<?php echo $image; ?>" alt="<?php echo $nama;?>">
                <div class="card-footer">
                  <h5 class="card-title text-left"><?php echo $nama;?></h5>
                  <p class="harga card-text text-left"><?php echo "Rp. ". number_format("$harga_diskon",0,",","."); ?></p>
                  <?php if ($persen_disc!=0) {
                  ?>
                    <p class="harga-promo text-left"><span id='persen_disc'><?php echo $persen_disc ?></span> <del style="text-decoration: line-through;"><?php echo "Rp. ". number_format("$harga",0,",","."); ?></del></p>
                  <?php
                  }else if ($potongan_harga!=0) {
                    ?>
                    <p class="harga-promo text-left"> <del style="text-decoration: line-through;"><?php echo "Rp. ". number_format("$harga",0,",","."); ?></del></p>
                  <?php
                  }?>
                </div>
                  <div id="responsive-row" class="row mt-auto">
                    <div class="col"><p class="lokasi card-text text-left"><i class="icon-location-arrow1" style=" font-size: 10px; color:#b75ae2"> </i> <?php echo $nama_kota; ?></p></div>
                    <div class="col"><p class="terjual card-text text-right"><?php if ($tqty) { echo $tqty ; }else { echo '0'; } ?> Terjual</p></div>
                  </div>
              </div>
              </a>
            </div> 
        <?php } 
      } ?>
      </div>


    </div>
    <div class="container mt-5"> 
    </div>
  </div>
</section>

<?php include("template/footer.php");  } else{
  echo "<script>window.location.href='sigin'</script>";
} ?>
