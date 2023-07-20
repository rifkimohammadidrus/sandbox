<?php include("template/header.php"); 
if (isset($_POST['cari'])) {
  $s_cari = $_POST['cari'];
  $id_outlet = $_POST['id_outlet'];
  $outlet = encrypt($id_outlet);

  $nama_toko =$_POST['nama_toko'];
}else{
$s_cari='';
$id_outlet = '';
$nama_toko = '';
$outlet='';
}
?>
<?php include("template/navbar.php"); ?>

<?php 
	
		$kode_beli= $_COOKIE['kode_beli'];
		// $id_outlet='B04042111150002';

    
           
    
    // if ($_GET['kat']) {
    //   # code...
    // }
    
    $search ="and jb.nama like '%$s_cari%'";

  //   $sql="SELECT SQL_CALC_FOUND_ROWS
  //   jb.kode_jenis,jb.nama,jb.gambar1, o.alias,kot.nama_kota, tdi.barcode 
  //   FROM jenis_barang as jb INNER JOIN master_barang AS mb ON (jb.kode_jenis = mb.kode_jenis)
  //     INNER JOIN  outlet as o ON (o.id=mb.id_outlet) 	
  //       LEFT join kategori as k on (k.kode_kategori=jb.kode_kategori)
  //       LEFT join tbl_disc_item as tdi on tdi.barcode=jb.kode_jenis
  //       LEFT join kota as kot on kot.kode_kota=o.kota
  //     WHERE jb.status=1 and mb.status=1 and  mb.id_outlet='$id_outlet' $search
  //     GROUP BY jb.kode_jenis  HAVING SUM(mb.stok>0)
  // ORDER BY tdi.barcode DESC";
  
  $sql="SELECT SQL_CALC_FOUND_ROWS
  jb.kode_jenis
  ,jb.nama
  ,jb.gambar1
  , mb.harga
  , o.alias
  ,kot.nama_kota
  , tdi.barcode
  , t.qty 
  FROM jenis_barang as jb 
    INNER JOIN master_barang AS mb ON (jb.kode_jenis = mb.kode_jenis)
    INNER JOIN  outlet as o ON (o.id=mb.id_outlet) 	
      LEFT join kategori as k on (k.kode_kategori=jb.kode_kategori)
      LEFT join tbl_disc_detail as tdi on tdi.barcode=jb.kode_jenis
      LEFT JOIN terlaris AS t ON t.barcode=jb.kode_jenis
      LEFT join kota as kot on kot.kode_kota=o.kota
    WHERE jb.status=1 and mb.status=1 and  mb.id_outlet='$id_outlet' $search GROUP BY jb.kode_jenis  HAVING SUM(mb.stok>0)
  ORDER BY tdi.barcode DESC";

    $query=mysqli_query($connect,$sql) or die ("wrong query kategori");
    ?>
<!-- <section id="content" style="margin-bottom: 0px; ">
  <div class="container-fluid" style="background-color:#f5f5f5">

    <div id="mobile" class="container" >

      <div class="row pt-4">
        <?php
            //  while(list($idb,$nama,$image, $nama_outlet, $nama_kota)=mysqli_fetch_array($query)){ 
            //   // $no++;
            //   $nama=trim($nama);
            //   $nama_url=str_replace(" ","-",str_replace(".","_",$nama));
    
            //   $s="select harga from master_barang where kode_jenis='$idb'";
            //   $qs=mysqli_query($connect,$s) or die ($s);
            //   list($hargabarang)=mysqli_fetch_array($qs);
              
            //   $sq="SELECT sum(qty) from pesan_detail where id_barang like '$idb%'";
            //   $qsq=mysqli_query($connect,$sq) or die ($sq);
            //   list($terjual)=mysqli_fetch_array($qsq);
    
            //   //GET DISCOUNT PER ITEM IF EXIST
            //   $qd="SELECT td.disc_value,td.image,td.start,td.end FROM tbl_disc AS td INNER JOIN tbl_disc_item AS ti
            //                 ON (ti.id_diskon=td.id) WHERE SUBSTRING(barcode,1,7)='$idb' and td.outlet like '%$id_outlet%' and ti.status=1 
            //       GROUP BY SUBSTRING(barcode,1,7)"; 
            //   $query_qd=mysqli_query($connect,$qd) or die ($qd);
            //   list($disc_value,$images_disc,$tglawal,$tglakhir)=mysqli_fetch_array($query_qd);
                
            //     //IF DISCOUNT PER ITEM NOT EXIST, GET DISC ALL PRODUK IF EXIST 
            //   if ($disc_value=='')
            //           {
            //   $qd="select disc_value,image,start,end from tbl_disc where status=1 AND outlet like '%$id_outlet%'";
            //   $query_qd=mysqli_query($connect,$qd) or die ($qd);
            //   list($disc_value,$images_disc,$tglawal,$tglakhir)=mysqli_fetch_array($query_qd);
            //   } 
    
            //   // cek apakah tanggal skg masih dalam periode diskon
            //   $now=date('Y-m-d');	
            //   if (($now>=$tglawal) and ($now<=$tglakhir)){
            //   $disc_value=$disc_value;	
            //   } else {
            //   $disc_value=0;	
            //   }
    
            //   //CONVERT PERCENT DISC TO NOMINAL & GET PRICE AFTER DISCOUNT
            //   $nilai_diskon=($disc_value/100)*$hargabarang;
            //   $harga_diskon=$hargabarang-$nilai_diskon; 
            ?>
            <div class="col pt-2" >
              
              <a href="detail-<?php echo $nama_toko ?>-url-<?php echo $nama_url?>-<?php echo encrypt($id_outlet); ?>">
              <div class="card">
                <img class="card-img-top" src="assets/foto_produk/<?php echo $image; ?>" alt="Card image cap">
                <div class="card-body">
                  <h5 class="card-title"><?php echo $nama;?></h5>
                  <p class="harga card-text"><?php echo "Rp. ". number_format("$harga_diskon",0,",","."); ?></p>
                </div>
                  <div id="responsive-row" class="row">
                    <div class="col"><p class="lokasi card-text"><i class="icon-location-arrow1" style=" font-size: 10px; color:#b75ae2"> </i> <?php echo $nama_kota; ?></p></div>
                    <div class="col"> <p class="terjual card-text text-right"><?php if ($terjual) { echo $terjual ; }else { echo '0'; } ?> Terjual</p></div>
                  </div>
              </div>
              </a>
            </div>
            <?php //} ?>
            </div>


    </div>
    <div class="container mt-5">

    </div>
  </div>
</section> -->

<section id="content" style="margin-bottom: 0px; ">
  <div class="container-fluid" style="background-color:#f5f5f5">

    <div id="mobile" class="container" >

      <div class="row pt-4 ">
     
        <?php while(list($idb,$nama,$image,$harga, $nama_outlet, $nama_kota,$barcode,$tqty)=mysqli_fetch_array($query)){ 
          
          $nama=trim($nama);
          $nama_url=str_replace(" ","-",str_replace(".","_",$nama));

         // GET DISCOUNT PER ITEM IF EXIST
          $qd="SELECT ti.persen_diskon,ti.potongan_harga,td.start,td.end 
          FROM tbl_disc AS td 
          LEFT JOIN tbl_disc_detail AS ti
            ON (ti.id_diskon=td.id) WHERE SUBSTRING(barcode,1,7)='$idb' and td.outlet like '%$id_outlet%' and td.status=1 
              GROUP BY SUBSTRING(barcode,1,7)"; 
          $query_qd=mysqli_query($connect,$qd) or die ($qd);
          list($persen_disc,$potongan_harga, $tglawal,$tglakhir)=mysqli_fetch_array($query_qd);
          
          // cek apakah tanggal skg masih dalam periode diskon
          $now=date('Y-m-d');	
          if (($now>=$tglawal) and ($now<=$tglakhir) and $persen_disc!=0){
            $nilai_diskon=($persen_disc/100)*$harga;
            $harga_diskon=$harga-$nilai_diskon;
          } elseif(($now>=$tglawal) and ($now<=$tglakhir) and $potongan_harga!=0) {
            $harga_diskon=$harga-$potongan_harga;
          }else{
            $persen_disc=0;	
            $potongan_harga=0;
            $harga_diskon=$harga;
            
            
          }
         
          //CONVERT PERCENT DISC TO NOMINAL & GET PRICE AFTER DISCOUNT
          // $nilai_diskon=($persen_disc/100)*$hargabarang;
          // $harga_diskon=$hargabarang-$nilai_diskon;
           ?>
          
            <div class="col pt-2 text-center">
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
        <?php
      } ?>
      </div>


    </div>
    <div class="container mt-5"> 
    </div>
  </div>
</section>

<?php include("template/footer.php"); ?>