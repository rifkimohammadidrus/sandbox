<?php include("template/header.php"); ?>
<?php include("template/navbar.php"); ?>
<?php $terlaris=""; $garis_terlaris="";?>
<?php $promo=""; $garis_promo=""; ?>
<?php $terbaru="aktif"; $garis_terbaru="garis";?>
<?php include("template/slide.php"); ?>
<style>
.aktif{
  color:#b75ae2;
}
</style>
<?php 
$sql="SELECT SQL_CALC_FOUND_ROWS
      jb.kode_jenis,jb.nama,jb.gambar1, o.alias,kot.nama_kota, tdi.barcode 
      FROM jenis_barang as jb INNER JOIN master_barang AS mb ON (jb.kode_jenis = mb.kode_jenis)
        INNER JOIN  outlet as o ON (o.id=mb.id_outlet) 	
          LEFT join kategori as k on (k.kode_kategori=jb.kode_kategori)
          LEFT join tbl_disc_item as tdi on tdi.barcode=jb.kode_jenis
          LEFT join kota as kot on kot.kode_kota=o.kota
        WHERE jb.status=1 and mb.status=1 and mb.id_outlet='$id_outlet'
        GROUP BY jb.kode_jenis  HAVING SUM(mb.stok>0)
    ORDER BY tdi.barcode DESC";
    $query=mysqli_query($connect,$sql) or die ("wrong query kategori");
    
?>
<section id="content" style="margin-bottom: 0px; ">
  <div class="container-fluid" style="background-color:#f5f5f5">

    <div id="mobile" class="container" >

      <div class="row pt-4">
      <?php while(list($idb,$nama,$image, $nama_outlet, $nama_kota)=mysqli_fetch_array($query)){ 
          // $no++;
          $nama=trim($nama);
          $nama_url=str_replace(" ","-",str_replace(".","_",$nama));

          $s="select harga from master_barang where kode_jenis='$idb'";
          $qs=mysqli_query($connect,$s) or die ($s);
          list($hargabarang)=mysqli_fetch_array($qs);

          //GET DISCOUNT PER ITEM IF EXIST
          $qd="SELECT td.disc_value,td.image,td.start,td.end FROM tbl_disc AS td INNER JOIN tbl_disc_item AS ti
                        ON (ti.id_diskon=td.id) WHERE SUBSTRING(barcode,1,7)='$idb' and td.outlet like '%$id_outlet%' and ti.status=1 
              GROUP BY SUBSTRING(barcode,1,7)"; 
          $query_qd=mysqli_query($connect,$qd) or die ($qd);
          list($disc_value,$images_disc,$tglawal,$tglakhir)=mysqli_fetch_array($query_qd);
            
            //IF DISCOUNT PER ITEM NOT EXIST, GET DISC ALL PRODUK IF EXIST 
          if ($disc_value=='')
                  {
          $qd="select disc_value,image,start,end from tbl_disc where status=1 AND outlet like '%$id_outlet%'";
          $query_qd=mysqli_query($connect,$qd) or die ($qd);
          list($disc_value,$images_disc,$tglawal,$tglakhir)=mysqli_fetch_array($query_qd);
          } 

          // cek apakah tanggal skg masih dalam periode diskon
          $now=date('Y-m-d');	
          if (($now>=$tglawal) and ($now<=$tglakhir)){
          $disc_value=$disc_value;	
          } else {
          $disc_value=0;	
          }

          //CONVERT PERCENT DISC TO NOMINAL & GET PRICE AFTER DISCOUNT
          $nilai_diskon=($disc_value/100)*$hargabarang;
          $harga_diskon=$hargabarang-$nilai_diskon; 
          
          if ($disc_value !=0) {
        ?>

        <div class="col pt-2">
        <a href="detail_produk?name=<?php echo $nama_url?>&otl=<?php echo $id_outlet; ?>">
          <div class="card">
            <img class="card-img-top" src="assets/foto_produk/<?php echo $image; ?>" alt="Card image cap">
            <div class="card-footer">
              <h5 class="card-title text-left"><?php echo $nama;?></h5>
              <p class="harga card-text"><?php echo "Rp. ". number_format("$harga_diskon",0,",","."); ?></p>
              <p class="harga-promo"><span><?php echo $disc_value ?></span> <del style="text-decoration: line-through;"><?php echo "Rp. ". number_format("$hargabarang",0,",","."); ?></del></p>
            </div>
            <!-- /<div class="card-footer"> -->
              <div id="responsive-row" class="row mt-auto">
                <div class="col"><p class="lokasi card-text"><i class="icon-location-arrow1" style=" font-size: 10px; color:#b75ae2"> </i> <?php echo $nama_kota; ?></p></div>
                <div class="col"> <p class="terjual card-text text-right">5,7RB Terjual</p></div>
              </div>
            <!-- </div> -->
          </div>
          </a>
        </div>
        <?php }
      }?>
      <!-- <?php if ($disc_value==0) {
         ?>
        <div class="col pt-2">
          <p>Empty Item</p>
        </div>
        <?php
      }?> -->
        
      </div>


    </div>
    <div class="container mt-5">

    </div>
  </div>
</section>

<?php include("template/footer.php"); ?>