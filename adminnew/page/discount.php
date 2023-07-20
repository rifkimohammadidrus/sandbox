
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
                                <style>
                                     .input-medium{
                                        width: 50%;
                                        padding: 5px;
                                        border: 1px solid #e7ecf1;
                                        border-radius: 4px;
                                        background-color: #fff;
                                        margin-top:2px;
                                    }
                                   

                                </style>
                                <div class="portlet-body">
                                <?php 
                                    if (isset($_POST['cari'])) {
                                        $val=$_POST['cari'];
                                        $cari="and (jb.nama like '%".$val."%' or dd.barcode like '%".$val."%')";
                                    }else {
                                        $val='';
                                        $cari='';
                                    }
                                ?>
                                <form name="f1" method="post" action="disc.php">
                                    <div class="input-group">
                                        <a  href="disc_tambah.php"><input type="button" class="btn btn-success" value="Tambah"></a>&emsp;&emsp;
                                        <input type="text" class="input-medium" name="cari" style="padding-bottom:8px" value="<?php echo $val ?>">
                                        <input type="submit" class="btn btn-secondary" value="Search">
                                    </div>
                                </form>
                                    <form name="f1" method="post" action="<?php echo $link?>">
                                    <br>
                                    <table class="table table-responsive table-bordered">
                                    <tr class="bg-success">
                                        <td height="25"><strong>ID</strong></td>
                                        <td><strong>Barcode</strong></td>
                                        <td><strong>Nama</strong></td>
                                        <td><strong>Diskon (%)</strong></td>
                                        <td><strong>Diskon (Pot Harga)</strong></td>
                                        <td><strong>Harga Diskon</strong></td>
                                        <td align="center"><strong>Start</strong></td>
                                        <td align="center"><strong>End</strong></td>
                                        <td align="center"><strong>Status</strong></td>
                                        <td align="center"><strong>Edit Disc</strong></td>
                                        <!-- <td align="center"><strong>Setting Disc</strong></td> -->
                                        <!-- <td align="center"  colspan="2"><strong>Aksi</strong></td> -->
                                    </tr>

                                    <?php 
                                    
                                    $sql="SELECT
                                            `d`.`id`
                                            , `d`.`start`
                                            , `d`.`end`
                                            , `d`.`status`
                                            , `dd`.`barcode`
                                            , `dd`.`persen_diskon`
                                            , `dd`.`potongan_harga`
                                            , `dd`.`harga_diskon`
                                            , `jb`.`nama`
                                        FROM
                                            `tbl_disc` AS `d`
                                            INNER JOIN `tbl_disc_detail` AS `dd` 
                                                ON (`d`.`id` = `dd`.`id_diskon`) 
                                            INNER JOIN jenis_barang AS jb ON (jb.kode_jenis = dd.barcode)
                                                    where outlet='$_SESSION[id_outlet]' $cari order by start DESC"; 
                                    $query=mysqli_query($connect, $sql)or die($sql);
                                    while(list($id,$startdate,$enddate,$status,$barcode,$persen,$potongan_harga,$harga_diskon,$nama)=mysqli_fetch_array($query)){
                                        if ($status==1){
                                        $status='aktif';
                                        } else {
                                        $status='tidak aktif';
                                        }

                                        // $detail="select status from tbl_disc_item where status=1 and id_diskon=$id";
                                        // $qdetail=mysqli_query($connect, $detail)or die($detail);
                                        // list($statusdisc)=mysqli_fetch_array($qdetail);

                                        // if ($statusdisc==''){
                                        // $status_text="tidak aktif";   
                                        // } else {
                                        // $status_text="aktif"; 
                                        // }
                                        ?>
                                        <tr class="isi-tabel" height="25">
                                            <td ><?php echo $id; ?></td>
                                            <td><?php echo $barcode; ?></td>
                                            <td><?php echo $nama; ?></td>
                                            <td><?php echo $persen; ?></td>
                                            <td><?php echo $potongan_harga; ?></td>
                                            <td><?php echo $harga_diskon; ?></td>
                                            <td><?php echo $startdate; ?></td>
                                            <td><?php echo $enddate; ?></td>
                                            <td align="center"><?php echo $status; ?></td>
                                            <!-- <td align="center" class="link-isi"><?php echo $status_text;?></td>
                                            <td><?php echo $outlet_list; ?></td> -->
                                            <td align="center" class="link-isi"><a href="index.php?menu=disc_edit&kode=<?php echo $id?>">Edit</a></td>
                                            <!-- <td align="center" class="link-isi"><a href="index.php?menu=disc_perproduk&kode=<?php echo $id?>">Sett disc PerItem</a></td> -->
                                        </tr>
                                    <?php }?>
                                    </table>
                                    </form>
                                
                                
                                </div>
                            </div>
                 
                        </div>
                    </div>
                </div>
                <!-- END CONTENT BODY -->
            </div>

            <script src="jquery-3.1.1.min.js"></script>
            <script type="text/javascript">
               
                function pindah(kode){
                                      //alert(kode);
                                      $("#temp_no").val(kode);
                                      $("#f1").attr("action","detail_transaksi.php");// mengirim variable dalam form melalui post
                                      $("#f1").attr("target","");
                                      $("#submit").click();
                                    
                
                }
            
            </script>
            <!-- END CONTENT -->
            <!-- BEGIN QUICK SIDEBAR -->
           