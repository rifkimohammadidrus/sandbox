
<?php 
$nama_url=$_GET['nama_url'];
$s="select nama_provinsi from provinsi where kode_provinsi='$nama_url'";
$qs=mysqli_query($connect, $s) or die ($s);
list($nama_prov)=mysqli_fetch_array($qs);

$tgl1=$_GET['tgl1'];
$tgl2=$_GET['tgl2'];
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
                                <span>List order Area <?php echo $nama_prov;?> Periode <?php echo $tgl1." sampai dengan ".$tgl2;?></span>
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
                                        <i class="fa fa-cogs"></i>List order Area <?php echo $nama_prov;?> Periode <?php echo $tgl1." sampai dengan ".$tgl2;?></div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                        <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                                        <a href="javascript:;" class="reload"> </a>
                                       <!-- <a href="javascript:;" class="remove"> </a> -->
                                    </div>
                                </div>
                                <div class="portlet-body">
                                <?php 
                                    $sql="SELECT
                                        p.no_transaksi
                                        , pn.nama
                                        , p.tanggal
                                        , p.jmlproduk
                                        , p.amount
                                        , p.ongkos
                                        , p.total_transfer
                                        , k.nama_kota
                                    FROM
                                        pengiriman AS pn
                                        INNER JOIN pesan AS p 
                                            ON (pn.no_transaksi = p.no_transaksi)
                                            INNER JOIN kota as k on (pn.kode_kota=k.kode_kota)
                                    WHERE pn.kode_provinsi='$nama_url'  AND tanggal BETWEEN '$tgl1' AND '$tgl2' and p.status=2 and p.jenis_bayar=1 
                                    and p.no_transaksi not like '%BTL%' and p.delay=0 order by k.kode_kota,p.tanggal DESC";
                                    $query=mysqli_query($connect, $sql) or die ($sql);
                                    //echo $sql;
                                    ?>
                                    <form method="post" id="f1" name="f1" style="display:none;">
                                       <input type="text" name="temp_no" id="temp_no">
                                       <input type="submit" name="submit" value="proses" id="submit"/>
                                    </form>
                                    <table class="table table-responsive table-bordered">
                                     <thead>
                                      <tr class="bg-success">
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Kota</th>
                                        <th>No transaksi</th>
                                        <th>Nama</th> 
                                        <th>Qty</th>
                                        <th>Subtotal</th>
                                        <th>Ongkos kirim</th>
                                        <th>Total transfer</th>
                                      </tr>
                                       <thead>

                                     <?php 
                                     while(list($notrans,$nama,$date,$qty,$amount,$ongkos,$transfer,$kota)=mysqli_fetch_array($query)){
                                     $no++;
                                     ?>  
                                      <tr>
                                        <td><?php echo $no;?></td>
                                        <td><?php echo $date;?></td>
                                        <td><?php echo $kota;?></td>
                                        <td><a href="#" onclick="pindah('<?php echo $notrans;?>')"><?php echo $notrans;?></a></td>
                                        <td><?php echo $nama;?></td>
                                        
                                        <td align="center"><?php echo $qty;?></td>
                                        <td align="right"><?php echo number_format("$amount",0,",",".");?></td>
                                        <td align="right"><?php echo number_format("$ongkos",0,",",".");?></td>
                                        <td align="right"><?php echo number_format("$transfer",0,",",".");?></td>
                                      </tr>
                                      <?php 
                                      $t_qty+=$qty;
                                      $t_amount+=$amount;
                                      $t_ongkir+=$ongkos;
                                      $t_transfer+=$transfer;
                                      } ?>

                                      <tr class="bg-success">
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td align="right"><strong><?php echo number_format("$t_amount",0,",",".");?></strong></td>
                                        <td align="right"><strong><?php echo number_format("$t_ongkir",0,",",".");?></strong></td>
                                        <td align="right"><strong><?php echo number_format("$t_transfer",0,",",".");?></strong></td>
                                      </tr>
                                    </table>


                                </div>
                            </div>
                 
                        </div>
                    </div>
                </div>
                <!-- END CONTENT BODY -->
            </div>

            <script src="jquery-3.1.1.min.js"></script>
            <script>
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
           