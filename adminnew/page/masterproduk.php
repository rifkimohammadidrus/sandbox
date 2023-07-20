
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
                                <span>Stok produk marketplace Bani batuta</span>
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
                                        <i class="fa fa-cogs"></i>Stok produk</div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                        <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                                        <a href="javascript:;" class="reload"> </a>
                                       <!-- <a href="javascript:;" class="remove"> </a> -->
                                    </div>
                                </div>
                                <div class="portlet-body">
                                <?php 
                                    $time=date('Ymdhis');
                                    
                                    if (isset($_POST['cari'])) {
                                        $cari=$_POST['cari'];
                                    }else {
                                        $cari='';
                                    }
                                    // jika yang masuk admin outlet
                                    if ($_SESSION['id_outlet']!=''){
                                        $outlet=$_SESSION['id_outlet'];    
                                        $filter_outlet1="and id='$outlet'";
                                    } else {
                                        if(isset($_POST['outlet'])){
                                            $outlet=$_POST['outlet'];
                                        } else{
                                            $outlet='';
                                        }
                                        $filter_outlet1='';     
                                    }

                                    $filter_outlet2="and id_outlet='$outlet'";

                                    $hal=isset($_GET['hal']);
                                    $jmlHal=25;
                                    $page=$hal;

                                    $sql2="select id,nama from outlet where status=1 $filter_outlet1";
                                    $query2=mysqli_query($connect, $sql2) or die ($sql2);

                                    // echo $sql2;
                                ?>    
                                    <form method="post" action="index.php?menu=masterproduk" id="f1">
                                        <table class="table table-bordered table-striped table-condensed" style="width: 70%;">      
                                            <tr><td style="width: 200px;">Outlet </td>
                                                <td><select name="outlet" class="form-control">
                                                    <option value="">-- semua --</option>
                                                        <?php 
                                                       
                                                        while(list($ido,$namaoutlet)=mysqli_fetch_array($query2)){
                                                        ?>
                                                    <option value="<?php echo $ido;?>" <?php if($outlet==$ido){echo"selected";}?> >
                                                        <?php echo $namaoutlet; ?> </option>
                                                    <?php }?>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr><td>Barcode/nama produk</td>
                                                <td><input type="text" name="cari" class="form-control" value="<?php echo $cari; ?>" /></td></tr>
                                            <tr><td>&nbsp;</td><td><input type="submit" class="btn btn-success" id="submit" value="Cari">
                                                    <a href="#" onclick="pindah('<?php echo $outlet; ?>')">
                                                        <input type="button" class="btn btn-success" value="Entry Stok">
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                    </form>   
                                    <p>&nbsp;</p>
                                    <table class="table table-bordered table-striped table-condensed flip-content">
                                        <thead class="flip-content">
                                            <tr class="bg-success">
                                                <th>no</th>
                                                <th>Barcode</th>
                                                <th>Foto</th>
                                                <th>Nama</th>
                                                <th>Size</th>
                                                <th>Variant</th>
                                                <th>Harga</th>
                                                <th>Stok</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        $sql="SELECT SQL_CALC_FOUND_ROWS mb.id_barang,k.nama_kategori,jb.nama,mb.kode_ukuran,mb.kode_warna,
                                              mb.kode_satuan,sum(mb.stok),sum(mb.stok_min),mb.harga,w.warna,u.ket_baru,jb.gambar1
                                              FROM master_barang AS mb LEFT JOIN kategori AS k ON (mb.kode_kategori=k.kode_kategori)
                                                                       LEFT JOIN jenis_barang AS jb ON (jb.kode_jenis=mb.kode_jenis) 
                                                                       LEFT JOIN ukuran AS u ON (mb.kode_ukuran=u.kode_ukuran)
                                                                       LEFT JOIN warna AS w ON (w.kode_warna=mb.kode_warna)
                                               WHERE (mb.id_barang LIKE '%$cari%' OR jb.nama LIKE '%$cari%')  $filter_outlet2 GROUP BY mb.id_barang 
                                               ORDER BY mb.stok desc";
                                        $query=mysqli_query($connect, $sql) or die($sql);
                                        // echo $sql;
                                        $i=0;
                                        while(list($id_barang,$kategori,$nama,$size,$warna,$satuan,$stok,$stok_minimal,$harga,$nama_warna,$nama_ukuran
                                                   ,$gambar)=mysqli_fetch_array($query))
                                        {
                                        $i++;
                                         if ($nama==''){
                                            $nama="<font color='blue'>Produk blm di upload</font>";
                                         }

                                         if ($nama_ukuran==''){
                                            $nama_ukuran="All Size";
                                         }
                                        ?>
                                            <tr>
                                               <td><?php echo $i ?></td>
                                               <td><?php echo $id_barang ?></td>
                                               <td align="center">
                                                    <?php if ($gambar!=''){?>
                                                      <img src="../assets/foto_produk/thumbnail/<?php echo $gambar;?>?log=<?php echo $time;?>" style="width: 50px;">
                                                    <?php } ?>
                                               </td>
                                               <td><?php echo $nama ?></td>
                                               <td><?php echo $nama_ukuran ?></td>
                                               <td><?php echo $nama_warna  ?></td>
                                               <td align="right"><?php echo number_format($harga, 0,",","."); ?></td>
                                               <td align="right"><?php echo $stok ?></td>
                                               <td>&nbsp;</td>                            
                                            </tr>
                                        <?php }?> 
                                        </tbody>
                                    </table>

                                    <div class="modal fade" id="ajax-entry-user" role="basic" aria-hidden="true" >
                                        <div class="modal-dialog" style="width:60%;">
                                            <div class="modal-content">
                                                 <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" 
                                                    aria-hidden="true"></button>
                                                    <h4 class="modal-title"><strong>Tambah User</strong></h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="fetched-data"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="ajax-edit-user" role="basic" aria-hidden="true" >
                                        <div class="modal-dialog" style="width:60%;">
                                            <div class="modal-content">
                                                 <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" 
                                                    aria-hidden="true"></button>
                                                    <h4 class="modal-title"><strong>Edit User</strong></h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="fetched-data2"></div>
                                                </div>
                                            </div>
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
            <script type="text/javascript">
               
               function pindah(id){
                
                if(id!=''){
                    // alert(id);
                    $("#f1").attr("action","index.php?menu=masterproduk_entry"); // mengirim variable dalam form melalui post
                    // $("#f1").attr("target","_blank");
                    $("#submit").click();
                    $("#f1").attr("action","index.php?menu=masterproduk_entry");
                    $("#f1").attr("target",""); 
                } else {
                    alert("pilih id outlet terlebih dahulu");    
                }    
              }   
            
            </script>
            <!-- END CONTENT -->
            <!-- BEGIN QUICK SIDEBAR -->
           