
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
                                    <form name="f1" method="post" action="<?php echo $link?>">
                                    <a href="body.php?menu=disc_tambah"><img src="images/8.png" alt="Add" border="0" width="30" /></a>
                                   
                                    <table class="table table-responsive table-bordered">
                                    <tr class="bg-success">
                                        <td align="left" height="25"><strong>ID</strong></td>
                                        <td align="left" ><strong>Nilai Discount</strong></td>
                                        <td align="left" ><strong>Nama program</strong></td>
                                        <td align="center"><strong>start</strong></td>
                                        <td align="center"><strong>end</strong></td>
                                        <td align="center"><strong>Discout All</strong></td>
                                        <td align="center"><strong>Discount Perproduk</strong></td>
                                        <td align="center"  colspan="2"><strong>Aksi</strong></td>
                                    </tr>

                                    <?php $sql="select id,disc_value,start,end,status,item_disc from tbl_disc"; 
                                    $query=mysqli_query($connect, $sql)or die($sql);
                                    while(list($id,$value,$startdate,$enddate,$status,$item_disc)=mysqli_fetch_array($query)){
                                    if ($status==1){
                                    $status='aktif';
                                    } else {
                                    $status='tidak aktif';
                                    }

                                    $detail="select status from tbl_disc_item where status=1 and id_diskon=$id";
                                    $qdetail=mysqli_query($connect, $detail)or die($detail);
                                    list($statusdisc)=mysqli_fetch_array($qdetail);

                                    if ($statusdisc==''){
                                      $status_text="tidak aktif";   
                                    } else {
                                      $status_text="aktif"; 
                                    }
                                    ?>
                                    <tr class="isi-tabel" height="25">
                                        <td ><?php echo $id; ?></td>
                                        <td><?php echo $value; ?></td>
                                        <td><?php echo $item_disc; ?></td>
                                        <td><?php echo $startdate; ?></td>
                                        <td><?php echo $enddate; ?></td>
                                        <td align="center"><?php echo $status; ?></td>
                                        <td align="center" class="link-isi"><?php echo $status_text;?></td>
                                        <td align="center" class="link-isi"><a href="index.php?menu=disc_edit&kode=<?php echo $id?>">Set All disc</a></td>
                                        <td align="center" class="link-isi"><a href="index.php?menu=disc_perproduk&kode=<?php echo $id?>">disc item</a></td>
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
           