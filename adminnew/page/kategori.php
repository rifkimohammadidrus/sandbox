
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
                                <span>kategori produk</span>
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
                            <div class="portlet box green col-md-6">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-cogs"></i>Kategori</div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                        <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                                        <a href="javascript:;" class="reload"> </a>
                                       <!-- <a href="javascript:;" class="remove"> </a> -->
                                    </div>
                                </div>
                                <div class="portlet-body flip-scroll">
                                    <table class="table table-bordered table-striped table-condensed flip-content">
                                        <thead class="flip-content">
                                            <tr>
                                               <th>Id</th>
                                               <th>Nama </th>
                                               <th widh=10px>Status</th>
                                               <th widh=10px>aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        $sql="SELECT id,name,status FROM tbl_categories ORDER BY id";
                                        $query=mysqli_query($connect, $sql) or die($sql);
                                         while (list($id,$nama,$status)=mysqli_fetch_array($query)){
                                        $i++;
                                        ?>
                                            <tr>
                                              <td><?php echo $id ?></td>
                                              <td><?php echo $nama ?></td>
                                              <td><?php if($status==1)
                                                   { echo"aktif"; } else
                                                   { echo"tidak aktif"; } ?>
                                              </td>
                                              <td><a href=?module=kategori&act=editkategori&id=$r[0]><img src='../images/edit/edit_icon.png' width=15/></a></td>                                             
                                            </tr>
                                          <?php }?> 
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                 
                        </div>
                    </div>
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
            <!-- BEGIN QUICK SIDEBAR -->
           