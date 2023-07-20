
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
                                <span>Tracking order </span>
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
                                        <i class="fa fa-cogs"></i>Tracking Order</div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                        <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                                        <a href="javascript:;" class="reload"> </a>
                                       <!-- <a href="javascript:;" class="remove"> </a> -->
                                    </div>
                                </div>
                                <div class="portlet-body">
                                 <?
                                if($_POST['submit'])  {
                                    
                                    $statustrack=$_POST['statustrack'];
                                    // echo"okkkkkkkkkkkkkkkkkkkkkkkkkkkkkk:   $statustrack<br><br><br>";
                                    if($statustrack!=''){
                                        $filter_tracking="and p.kode_track='$statustrack'";
                                    }
                                }                                           
                                                       
                                ?>   
                                <form method="post" action="tracking.php?action=sjkdfhjkdshfjkdsf">
                                    <table class="table table-striped table-bordered table-hover" style="font-size:12px;">
                                        <tr>
                                            <td width="150">Status Tracking : </td>
                                            <td><?php 
                                                    $sql="SELECT  id,tracking FROM tracking ORDER BY urutan ASC";
                                                    $query=mysqli_query($connect, $sql);
                                                ?>
                                                <select name="statustrack"> 
                                                    <option value="">-- Semua -- </option>
                                                    <?php 
                                                      while(list($idt,$trackname)=mysqli_fetch_array($query)){?>
                                                        <option value="<?php echo $idt;?>" <?php if($statustrack==$idt){echo"selected";}?>>
                                                            <?php echo $trackname; ?></option>
                                                      <?php }
                                                    ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr><td>&nbsp;</td><td><input type="submit" name="submit" value="Lihat" class="btn btn-info"></td></tr>
                                        
                                    </table>
                                </form>    

                                
                                <form name="f1" method="post" id="f1" style="display: none;">
                                    <input type="hidden" id="temp_no" name="temp_no"/>
                                    <input type="submit" name="submit" value="proses" id="submit"/>
                                </form>    
                                <table class="table table-responsive table-bordered">
                                <tr class="bg-success">
                                    <td align="left" height="25" width="130">No Transaksi</td>
                                    <td align="left" width="200">Customer</td>
                                    <td align="left" width="200">Tanggal & jam</td>
                                    <td align="left" width="50">Qty</td>
                                    <td align="left" width="100">Amount</td>
                                    <td align="left" width="100">Ongkos</td> 
                                    <td align="left" width="100">Total Bayar</td>
                                    <td align="left" width="200">Status Tracking</td>
                                   <!--  <td align="left" width="200">Tracking</td> -->
                                    <td align="left" width="100">Aksi</td> 
                                    
                                </tr>
                                <?php 
                                $sql="SELECT
                                        p.no_transaksi
                                        , p.email
                                        , p.tanggal
                                        , p.status
                                        , p.jmlproduk
                                        , p.amount
                                        , p.ongkos
                                        , p.biaya_seluruh
                                        , p.jenis_bayar
                                        , p.kode_track
                                        , p.retur
                                        , p.kode_bank
                                        , p.approve_date
                                        , t.tracking
                                    FROM
                                        pesan AS p
                                        LEFT JOIN tracking AS t 
                                            ON (p.kode_track = t.id) where substring(p.no_transaksi,1,3)='T20' AND status=2 $filter_tracking order by no_transaksi desc";     
                                $query=mysqli_query($connect, $sql)or die($sql);
                                while(list($no_transaksi,$email,$tanggal,$status,$jmlproduk,$amount,$ongkos,$seluruh,$jenisbayar,$kode_track,$retur,$bank,$approvedate,$trackname)=mysqli_fetch_array($query)){?>
                                <tr class="isi-tabel">
                                    <td ><?php echo $no_transaksi?></td>
                                    <td><?php echo $email ?></td>
                                    <td ><?php echo $tanggal?></td>
                                    <td align="center"><?php echo $jmlproduk ?></td>
                                    <td align="right"><?php echo number_format("$amount",0,",",".");?></td>
                                    <td align="right"><?php  echo number_format("$ongkos",0,",","."); ?></td>
                                    <td align="right"><?php echo number_format("$seluruh",0,",",".");?></td>
                                    <td align="right"><?php echo $trackname;?></td>
                                   <!--  <td ><?php echo $_GET['kondisi'];
                                    ?></td> -->
                                    <td align="center"><a href="#" onclick="pindah('<?php echo $no_transaksi;?>')"> Detail </a></td>
                                    </tr>
                                <?php }?>
                                <tr class="bg-success">
                                    <td colspan="9">&nbsp;</td>
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
           