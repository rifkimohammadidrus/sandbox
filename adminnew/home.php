<div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <h1 class="page-title"> Admin Dashboard</h1>
                   
                    <div class="clearfix"></div>
                   
                   <?php 
                   $date_begin=date('Y-m-01');
                   $date_now=date('Y-m-d');
                   $id_outlet=$_SESSION['id_outlet'];
                   if ($_SESSION['id_outlet']!=''){
                        $filter_lokasi="and p.id_outlet='$id_outlet'";
                   } else {
                        $filter_lokasi="";
                   }
                   
                   //get not confirm
                   $sql1="SELECT
                            COUNT(p.no_transaksi),sum(p.amount) 
                        FROM
                            pesan AS p
                            INNER JOIN pesan_detail AS pd 
                                ON (p.no_transaksi = pd.no_transaksi)
                        WHERE p.jenis_bayar=0 AND p.tanggal BETWEEN '$date_begin 00:00:00' AND '$date_now 23:59:59' $filter_lokasi";
                    $query1=mysqli_query($connect,$sql1);
                    list($not_confirm,$not_confirm_amount)=mysqli_fetch_array($query1);   
                    if ($not_confirm_amount==''){
                        $not_confirm_amount=0;
                    } 

                    // echo $sql1;

                   //get confirm
                //    $sql2="SELECT
                //             COUNT(p.no_transaksi),sum(p.amount) 
                //         FROM
                //             pesan AS p
                //             INNER JOIN pesan_detail AS pd 
                //                 ON (p.no_transaksi = pd.no_transaksi)
                //         WHERE p.jenis_bayar=1 AND p.status=0 AND p.tanggal BETWEEN '$date_begin 00:00:00' AND '$date_now 23:59:59' $filter_lokasi";
                //     $query2=mysqli_query($connect,$sql2);
                //     list($confirm,$confirm_amount)=mysqli_fetch_array($query2);  
                //      if ($confirm_amount==''){
                //         $confirm_amount=0;
                //     }   
                   $sql2="SELECT
                            COUNT(p.no_transaksi),sum(pd.amount) 
                        FROM
                            pesan AS p
                            INNER JOIN pesan_detail AS pd 
                                ON (p.no_transaksi = pd.no_transaksi)
                        WHERE p.status=1 AND p.tanggal BETWEEN '$date_begin 00:00:00' AND '$date_now 23:59:59' $filter_lokasi";
                    $query2=mysqli_query($connect,$sql2);
                    list($confirm,$confirm_amount)=mysqli_fetch_array($query2);  
                     if ($confirm_amount==''){
                        $confirm_amount=0;
                    }   

                    //get approve
                   $sql3="SELECT
                            COUNT(p.no_transaksi),sum(pd.amount) 
                        FROM
                            pesan AS p
                            INNER JOIN pesan_detail AS pd 
                                ON (p.no_transaksi = pd.no_transaksi)
                        WHERE p.jenis_bayar=1 AND p.status=2 AND p.tanggal BETWEEN '$date_begin 00:00:00' AND '$date_now 23:59:59' $filter_lokasi";
                    $query3=mysqli_query($connect,$sql3);
                    list($approve,$approve_amount)=mysqli_fetch_array($query3);   

                     if ($approve_amount==''){
                        $approve_amount=0;
                    }  
                   ?>
                    
                  
                    <div class="row">
                        <div class="col-lg-12 col-xs-12 col-sm-12">
                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-cursor font-dark hide"></i>
                                        <span class="caption-subject font-dark bold uppercase">Order bulan ini</span>
                                    </div>
                                    <!-- <div class="actions">
                                        <a href="javascript:;" class="btn btn-sm btn-circle red easy-pie-chart-reload">
                                            <i class="fa fa-repeat"></i> Reload </a>
                                    </div> -->
                                </div>
                                <div class="portlet-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="easy-pie-chart">
                                                <div class="number transactions" data-percent="100">
                                                    <span><?php echo $not_confirm;?></span></div>
                                                <a class="title" href="not_confirm.php"> Belum Konfirmasi
                                                    <i class="icon-arrow-right"></i><br>
                                                    <?php echo"Rp. ". number_format("$not_confirm_amount",0,",","."); ?>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="margin-bottom-10 visible-sm"> </div>
                                        <div class="col-md-4">
                                            <div class="easy-pie-chart">
                                                <div class="number visits" data-percent="100">
                                                    <span><?php echo $confirm;?></span></div>
                                                <a class="title" href="confirm.php"> Sudah konfirmasi
                                                    <i class="icon-arrow-right"></i><br>
                                                   <?php echo"Rp. ". number_format("$confirm_amount",0,",","."); ?>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="margin-bottom-10 visible-sm"> </div>
                                        <div class="col-md-4">
                                            <div class="easy-pie-chart">
                                                <div class="number bounce" data-percent="100">
                                                    <span><?php echo $approve;?></span></div>
                                                <a class="title" href="approve.php"> Sudah di approve
                                                    <i class="icon-arrow-right"></i><br>
                                                    <?php echo"Rp. ". number_format("$approve_amount",0,",","."); ?>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                       <!--  <div class="col-lg-6 col-xs-12 col-sm-12">
                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-equalizer font-dark hide"></i>
                                        <span class="caption-subject font-dark bold uppercase">Server Stats</span>
                                        <span class="caption-helper">monthly stats...</span>
                                    </div>
                                    <div class="tools">
                                        <a href="" class="collapse"> </a>
                                        <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                                        <a href="" class="reload"> </a>
                                        <a href="" class="remove"> </a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="sparkline-chart">
                                                <div class="number" id="sparkline_bar5"></div>
                                                <a class="title" href="javascript:;"> Network
                                                    <i class="icon-arrow-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="margin-bottom-10 visible-sm"> </div>
                                        <div class="col-md-4">
                                            <div class="sparkline-chart">
                                                <div class="number" id="sparkline_bar6"></div>
                                                <a class="title" href="javascript:;"> CPU Load
                                                    <i class="icon-arrow-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="margin-bottom-10 visible-sm"> </div>
                                        <div class="col-md-4">
                                            <div class="sparkline-chart">
                                                <div class="number" id="sparkline_line"></div>
                                                <a class="title" href="javascript:;"> Load Rate
                                                    <i class="icon-arrow-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                   
                   
                   
                </div>
                <!-- END CONTENT BODY -->
            </div>