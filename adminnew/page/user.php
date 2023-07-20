
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
                                <span>User admin marketplace rabbani</span>
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
                                        <i class="fa fa-cogs"></i>User</div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                        <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                                        <a href="javascript:;" class="reload"> </a>
                                       <!-- <a href="javascript:;" class="remove"> </a> -->
                                    </div>
                                </div>
                                <div class="portlet-body flip-scroll">
                                      <div class="pull-right"><a href="#ajax-entry-user" data-id="<?php echo $kode;?>" data-toggle="modal">
                                            <button type="button" class="btn btn-success">
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                            Tambah</button>
                                            </a></div>
                                            <p>&nbsp;</p>
                                    <table class="table table-bordered table-striped table-condensed flip-content">
                                        <thead class="flip-content">
                                            <tr>
                                                <th>no</th>
                                                <th>username</th>
                                                <th>password</th>
                                                <th>nama lengkap</th>
                                                <th>Level</th>
                                                <th>Status</th>
                                                <th>aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        $sql="SELECT u.username, u.password, u.level, ul.nama, u.nama, u.status 
                                              FROM user AS u INNER JOIN user_level AS ul ON (u.level = ul.id)";
                                        $query=mysqli_query($connect,$sql) or die($sql);
                                        $i=0;
                                        while (list($user,$pass,$idlevel,$level,$nama,$status)=mysqli_fetch_array($query)){
                                        $i++;
                                        ?>
                                            <tr>
                                               <td><?php echo $i ?></td>
                                               <td><?php echo $user ?></td>
                                               <td><?php echo $pass ?></td>
                                               <td><?php echo $nama ?></td>
                                               <td><?php echo $level ?></td>
                                               <td><?php if($status==1){echo"aktif";} else {echo"tidak aktif";} ?></td>
                                               <td>
                                                  <a href="#ajax-edit-user" data-toggle="modal" data-id="<?php echo $user;?>">
                                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                                  </a>
                                               </td>
                                                                           
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
    $(document).ready(function(){
        $('#ajax-entry-user').on('show.bs.modal', function (e) {
            //alert(rowid); 
            $.ajax({
                type : 'POST',
                url :  'page/user_tambah.php',
                cache: false,
                success : function(data){
                 $('.fetched-data').html(data);
                }
            });
         });
         
         $('#ajax-edit-user').on('show.bs.modal', function (e) {
            var idx = $(e.relatedTarget).data('id');
            //alert(rowid); 
            $.ajax({
                type : 'POST',
                url :  'page/user_edit.php',
                cache: false,
                data :  'id='+ idx,
                success : function(data){
                 $('.fetched-data2').html(data);
                }
            });
         }); 
         
         
    });
  </script>
            <!-- END CONTENT -->
            <!-- BEGIN QUICK SIDEBAR -->
           