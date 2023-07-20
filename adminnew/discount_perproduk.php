<?php

if($_POST['proses_cari']){  
   $cari=$_POST['cari'];
}

if ($cari!=''){
$tambahan="and jb.nama like '%$cari%'"; 
} else {
$tambahan="";       
}

$iddisk=$_GET['kode'];
$hal=$_GET['hal'];
$jmlHal=30;
$page=$hal;

$sql="SELECT SQL_CALC_FOUND_ROWS tdi.barcode, jb.nama, td.disc_value, tdi.status
      FROM  tbl_disc_item AS tdi INNER JOIN jenis_barang AS jb ON (SUBSTRING(tdi.barcode,1,7) = jb.kode_jenis)
                                 INNER JOIN tbl_disc AS td ON (td.id=tdi.id_diskon)
where tdi.id_diskon='$iddisk' $tambahan LIMIT ".($page*$jmlHal).",".$jmlHal;
$query=mysqli_query($connect, $sql);
//echo $sql;
$sql2="SELECT FOUND_ROWS()";
$query2=mysqli_query($connect, $sql2) or die ($sql2);  
list($jmlData[0])=mysqli_fetch_array($query2);
$no=($hal*$jmlHal);



?>
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEADER-->
                    <!-- BEGIN THEME PANEL -->
                  
                    <!-- END THEME PANEL -->
                    <h1 class="page-title">
                       
                    </h1>
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <i class="icon-home"></i>
                                <a href="index.html">Home</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                                <span>Setting Discount </span>
                            </li>
                        </ul>
                        <div class="page-toolbar">
                            <div class="btn-group pull-right">
                                <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> &nbsp;
                                   
                                </button>
                               
                            </div>
                        </div>
                    </div>
                    <!-- END PAGE HEADER-->
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN SAMPLE TABLE PORTLET-->
                            <div class="portlet box green">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-cogs"></i>Setting Diskon</div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                        <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                                        <a href="javascript:;" class="reload"> </a>
                                       <!-- <a href="javascript:;" class="remove"> </a> -->
                                    </div>
                                </div>
                                <div class="portlet-body">
                                   <form method="post" action="index.php?menu=disc_perproduk&kode=<?php echo $iddisk?>">
                                       <input type="text" size="40" name="cari" value="<?php echo $cari;?>" />
                                       <input type="submit" value="cari produk" name="proses_cari" />
                                    </form>
                                    <p></p>
                                    <?php 
                                    $cek="select status from tbl_disc_item where id_diskon='$iddisk' and status=1";
                                    $qcek=mysqli_query($connect, $cek) or die ($cek);
                                    list($statusaktif)=mysqli_fetch_array($qcek);
                                    ?>
                                    <input type="button" value="hapus semua" class="btn btn-info" onclick="hapus('<?php echo $iddisk ?>')"/>&nbsp;&nbsp;
                                    <a href="index.php?menu=disc_import&kode=<?php echo $iddisk?>">
                                    <input type="button" value="import produk" class="btn btn-info"/>
                                    </a>&nbsp;&nbsp;
                                    <?php 
                                    if ($statusaktif==''){
                                    ?>
                                    <input type="button" value="Aktifkan diskon" class="btn btn-info" onclick="ubah_aktif('<?php echo $iddisk; ?>','1')"/>
                                    <?php } else {?>
                                    <input type="button" value="Nonaktifkan diskon" class="btn btn-info" onclick="ubah_aktif('<?php echo $iddisk; ?>','0')"/>
                                    <?php }?>
                                    <p></p>
                                    <table class="table table-responsive table-bordered" style="width:50%;" >
                                      <tr class="judul">
                                        <td>No</td>
                                        <td>Barcode</td>
                                        <td>Nama</td>
                                        <td>Discount</td>
                                        <td>Status</td>
                                      </tr>
                                      <?php 
                                      while(list($barcode,$nama,$disc,$status)=mysqli_fetch_array($query))  {
                                      $i++;
                                      ?>  
                                      <tr>
                                        <td><?php echo $i;?></td>
                                        <td><?php echo $barcode;?></td>
                                        <td><?php echo $nama;?></td>
                                        <td align="center"><?php echo $disc;?></td>
                                        <td align="center"><?php if($status==0){echo"tidak aktif";} else {echo"aktif";}?></td>
                                      </tr>
                                      <?php } ?>
                                    </table>
                                    <p>&nbsp;</p>
                                    <div class="row" align="center">
                                                    <div class="col-md-12">
                                                    <nav>
                                                            <ul class="pagination">
                                                                <li class="disabled"><a href="body.php?menu=disc_perproduk&kode=12&hal=0" 
                                                                aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
                                                                 <?php 
                                                                for($i=0;$i<($jmlData[0]/$jmlHal);$i++){ 
                                                                    if($hal<=0){ ?>
                                                                        <li class="<?php if($i==$hal) echo "aktif"; else echo "hal"; ?>">
                                                                           <a href="body.php?menu=disc_perproduk&kode=12&hal=<?php echo ($i+1); ?>"><?php echo ($i+1); ?></a>
                                                                        </li>
                                                                        <?php if($i>=4) break;
                                                                    }else if(($hal+1)>=($jmlData[0]/$jmlHal)){
                                                                        if($i>=(($jmlData[0]/$jmlHal)-5)){ ?>
                                                                            <li>
                                                                               <a href="body.php?menu=disc_perproduk&kode=12&hal=<?php echo $i; ?>">
                                                                               <?php echo ($i+1); ?>
                                                                               </a>
                                                                            </li>
                                                                        <?php } 
                                                                    }else{
                                                                        if($i<=($hal+2)and $i>=($hal-2)){ ?>
                                                                            <li>
                                                                              <a href="body.php?menu=disc_perproduk&kode=12&hal=<?php echo $i; ?>">
                                                                              <?php echo ($i+1); ?>
                                                                              </a>
                                                                            </li>
                                                                      <?php }
                                                                    }
                                                                } ?>
                                                                
                                                        
                                                                
                                                               <li><a href="body.php?menu=disc_perproduk&kode=12&hal=<?php echo intval(($jmlData[0]/$jmlHal));?>" aria-label="Next"><span aria-hidden="true">&raquo;</span></a>
                                                               </li>
                                                            
                                                           
                                                            
                                                            
                                                            
                                                            </ul>
                                                        </nav>
                                                    </div>
                                                </div>
                                
                                </div>
                            </div>
                 
                        </div>
                    </div>
                </div>
                <!-- END CONTENT BODY -->
            </div>

            <script src="jquery-3.1.1.min.js"></script>
            <script>
            function hapus(kode){
                 // alert(barcode);
            var msg;
            msg="Anda yakin akan menghapus semua produk ini?";
            var agree=confirm(msg);
            if (agree)
            {
                  $.ajax({
                         url:"diskon_data_hapus.php",
                         type:"POST",
                         cache: false,
                         dataType:'text',
                         data:{b:kode},
                         success: function(data) {
                          if (data=='sukses'){
                            location.reload();
                          }
                         
                          }// END SUCSESS
                       }); // end ajax 
                 } 
              }
              
             function ubah_aktif(kode,status){
                 // alert(barcode);
            var msg;
            if (status==1){
            msg="Anda yakin akan mengaktifkan semua produk diskon ini?";
            } else {
            msg="Anda yakin akan menonaktifkan semua produk diskon ini?";   
            }

            var agree=confirm(msg);
            if (agree)
            {
                  $.ajax({
                         url:"diskon_data_ubah.php",
                         type:"POST",
                         cache: false,
                         dataType:'text',
                         data:{b:kode, s:status},
                         success: function(data) {
                          if (data=='sukses'){
                            location.reload();
                          }
                         
                          }// END SUCSESS
                       }); // end ajax 
                 } 
              } 
            </script>
            <!-- END CONTENT -->
            <!-- BEGIN QUICK SIDEBAR -->
           