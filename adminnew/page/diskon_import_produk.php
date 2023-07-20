<?php 
$id=$_GET['kode'];
//echo"uideeeeeee $id";
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
                                <span>Import Discount</span>
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
                                        <i class="fa fa-cogs"></i>Import Diskon Item</div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                        <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                                        <a href="javascript:;" class="reload"> </a>
                                       <!-- <a href="javascript:;" class="remove"> </a> -->
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <form method="post" action="proses_import_disc_produk.php" enctype="multipart/form-data" name="form1">
                                        <input type="hiddens" name="temp_id" value="<?php echo $id;?>" />
                                        <table class="table table-striped table-bordered table-hover" style="width:50%">
                                        <tr class="judul">
                                            <td colspan="3" height="30">Import Produk Diskon <?php echo $nama?></td>
                                        </tr>
                                        <tr>
                                            <td height="5"></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr class="text-edit">
                                            <td>Import File</td>
                                            <td>:</td>
                                               
                                            <td><input type="file" name="userfile" /></td>
                                        </tr>



                                        <tr>
                                            <td height="5"></td>
                                            <td></td>
                                            <td>
                                               <input type="submit" name="import" value="proses" class="button"  />
                                               <input type="button" name="kembali" value="Kembali" class="button" onclick="self.history.back()" /></td> 
                                        </tr>



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
           