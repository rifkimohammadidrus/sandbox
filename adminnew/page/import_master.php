
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
                                <span>Import Master barang</span>
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
                                        <i class="fa fa-cogs"></i>Import Master barang</div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                        <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                                        <a href="javascript:;" class="reload"> </a>
                                       <!-- <a href="javascript:;" class="remove"> </a> -->
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <form method="post" action="proses_import_master.php" enctype="multipart/form-data">
                                      <table class="table table-responsive table-bordered table-stripe" style="width:50%">
                                        <tr><td>File Upload</td><td><input type="file" name="userfile" id="userfile" /></td></tr>
                                         <tr><td style="width: 200px;">Outlet </td>
                                                <td>
                                                    <input type="text" name="outlet" value="<?php echo $_SESSION['id_outlet']; ?>" disabled>
                                                <!-- <select name="outlet" id="outlet" class="form-control">
                                                    <option value=""><?php echo $_SESSION['id_outlet'];?></option>
                                                        <?php 
                                                        $sql="select id,nama from outlet where status=1 $filter_outlet1";
                                                        $query=mysqli_query($connect, $sql);
                                                        while(list($ido,$namaoutlet)=mysqli_fetch_array($query)){
                                                        ?>
                                                    <option value="<?php echo $ido;?>" <?php if($outlet==$ido){echo"selected";}?> >
                                                        <?php echo $namaoutlet; ?> </option>
                                                    <?php }?>
                                                    </select> -->
                                                </td>
                                            </tr>
                                        <tr><td>&nbsp;</td><td><input type="submit" value="proses" onclick="return validasi()" /></td></tr>
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
               function validasi(){
                  var otl =$("#outlet").val();
                  var userfile =$("#userfile").val();
                  
                  if (userfile==''){
                    alert('File upload tidak boleh kosong');
                    return false;
                  } else 
                  if (otl==''){
                    alert('Silahkan pilih outlet');
                    return false;
                  }
                  return true
               }
            
            </script>
            <!-- END CONTENT -->
            <!-- BEGIN QUICK SIDEBAR -->
           