
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
                                <span>Setting Size Chart </span>
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
                                        <i class="fa fa-cogs"></i>Upload Size Chart</div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                        <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                                        <a href="javascript:;" class="reload"> </a>
                                       <!-- <a href="javascript:;" class="remove"> </a> -->
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-responsive table-bordered">
                                        <tr class="bg-success">
                                            <td align="center" height="25"><strong>Baju</strong></td>
                                            <td align="center" height="25"><strong>Celana</strong></td>
                                            <td align="center" height="25"><strong>Kerudung</strong></td>
                                            <td align="center" height="25"><strong>Mukena</strong></td>
                                            <td align="center" height="25"><strong>St Ikhwan</strong></td>
                                            <td align="center" height="25"><strong>St Akhwat</strong></td>
                                            <td align="center" height="25"><strong>St Gamis</strong></td>
                                        </tr>

                                        <tr class="isi-tabel" height="25" align="center">
                                            <td height="25">
                                                <img src="..\..\assets\images\excel.png" width="30px" height="30px"       onclick="window.open('page/excel_size_chart.php?jenis=baju','Export To Excel','width=500,height=100,menubar=yes,scrollbars=yes');">
                                            </td>
                                            <td>
                                                <img src="..\..\assets\images\excel.png" width="30px" height="30px"       onclick="window.open('page/excel_size_chart.php?jenis=celana','Export To Excel','width=500,height=100,menubar=yes,scrollbars=yes');">
                                            </td>
                                            <td>
                                                <img src="..\..\assets\images\excel.png" width="30px" height="30px"       onclick="window.open('page/excel_size_chart.php?jenis=kerudung','Export To Excel','width=500,height=100,menubar=yes,scrollbars=yes');">
                                            </td>
                                            <td>
                                                <img src="..\..\assets\images\excel.png" width="30px" height="30px"       onclick="window.open('page/excel_size_chart.php?jenis=mukena','Export To Excel','width=500,height=100,menubar=yes,scrollbars=yes');">
                                            </td>
                                            <td>
                                                <img src="..\..\assets\images\excel.png" width="30px" height="30px"       onclick="window.open('page/excel_size_chart.php?jenis=ikhwan','Export To Excel','width=500,height=100,menubar=yes,scrollbars=yes');">
                                            </td>
                                            <td>
                                                <img src="..\..\assets\images\excel.png" width="30px" height="30px"       onclick="window.open('page/excel_size_chart.php?jenis=akhwat','Export To Excel','width=500,height=100,menubar=yes,scrollbars=yes');">
                                            </td>
                                            <td>
                                                <img src="..\..\assets\images\excel.png" width="30px" height="30px"       onclick="window.open('page/excel_size_chart.php?jenis=gamis','Export To Excel','width=500,height=100,menubar=yes,scrollbars=yes');">
                                            </td>
                                        </tr>
                                        <tr class="isi-tabel" height="25">
                                            <td height="25">
                                                - Baju
                                            </td>
                                            <td>
                                                - Celana
                                            </td>
                                            <td>
                                                - Kerudung
                                            </td>
                                            <td>
                                                - Atasan <br> - Bawahan
                                            </td>
                                            <td>
                                                - Baju <br> - Celana
                                            </td>
                                            <td>
                                                - Baju <br> - Celana <br> - Kerudung
                                            </td>
                                            <td>
                                                - Gamis <br> - Kerudung
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="portlet-body">
                                    <a href="page/import-excel/index.php">
                                        IMPORT SIZE CHART
                                    </a>
                                </div>

                            </div>
                 
                        </div>
                    </div>

           
            <!-- END CONTENT -->

                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN SAMPLE TABLE PORTLET-->
                            <div class="portlet box green">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-cogs"></i>Setting Size Chart</div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                        <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                                        <a href="javascript:;" class="reload"> </a>
                                       <!-- <a href="javascript:;" class="remove"> </a> -->
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <form name="f1" method="post" action="<?php echo $link?>">

                                    <table class="table table-responsive table-bordered">
                                     <?php
                                        $sql="SELECT    nilai,IF(nilai=1,'Sedang Ditampilkan','Sedang Ditutup') AS cek 
                                                FROM    size_chart_setting";
                                        $query=mysqli_query($connect, $sql);
                                        list($nilai,$hasil)=mysqli_fetch_array($query);

                                        if($nilai==1){
                                            $gantinilai=0;
                                        }else{
                                            $gantinilai=1;
                                        }
                                    ?>
                                    <tr>
                                        <td colspan="3" align="right">

                                            <a href="size_chart_proses.php">
                                                <?php 
                                                    if($nilai==1){
                                                        echo "Tutup Size Chart";
                                                    }else{
                                                        echo "Tampilkan Size Chart";
                                                    }
                                                ?>
                                            </a>
                                        </td>
                                        <td <?php if($nilai==1){?> style="color:black; background:#abe7ed "  <?php }else{ ?> style="color:white; background:#C36 " <?php }?> align="center"><?php echo $hasil;?></td>
                                    </tr>             
                                    <tr>
                                        <td colspan="3"></td>
                                    </tr>
                                    <tr class="bg-success">
                                        <td align="left" height="25"><strong>No</strong></td>
                                        <td align="left" height="25"><strong>Barcode</strong></td>
                                        <td align="left" ><strong>Nama Barang</strong></td>
                                        <td align="center" ><strong>Status</strong></td>
                                    </tr>
                                    <?php

                                        $s_cp=" SELECT a.kode_jenis,a.nama,a.cek 
                                                FROM (
                                                        SELECT  a.kode_jenis,sc.barcode,a.nama,
                                                                IF(a.kode_jenis=sc.barcode,'ok','belum') AS cek
                                                          FROM (  SELECT kode_jenis,nama 
                                                                    FROM  jenis_barang
                                                                         GROUP BY kode_jenis
                                                               ) AS a
                                                               LEFT JOIN size_chart AS sc ON (sc.barcode=a.kode_jenis)
                                                        ) AS a GROUP BY a.kode_jenis ORDER BY a.cek,a.nama";
                                        $q_cp=mysqli_query($connect, $s_cp);
                                        $no=0;
                                        while(list($barcode,$nama,$cek)=mysqli_fetch_array($q_cp)){
                                        $no++;

                                    ?>
                                    <tr class="isi-tabel" height="25">
                                        <td><?php echo $no; ?></td>
                                        <td><?php echo $barcode; ?></td>
                                        <td><?php echo $nama; ?></td>
                                        <td <?php if($cek=='ok'){?> bgcolor="#abe7ed" <?php }else{ ?> bgcolor="#C36" style="color:#FFFFFF" <?php }?>align="center">
                                            <?php echo $cek; ?>    
                                        </td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                   
                                    </table>
                                    </form>
                                
                                
                                </div>
                            </div>
                 
                        </div>
                    </div>
                </div>
                <!-- END CONTENT BODY -->
            </div>
           
            <!-- END CONTENT -->
            <!-- BEGIN QUICK SIDEBAR -->
           