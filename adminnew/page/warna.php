
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
                                <span>Master variant marketplace rabbani</span>
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
                                        <i class="fa fa-cogs"></i>Variant</div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                        <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                                        <a href="javascript:;" class="reload"> </a>
                                       <!-- <a href="javascript:;" class="remove"> </a> -->
                                    </div>
                                </div>
                                <div class="portlet-body">
                                      <div class="pull-right">
                                            <button type="button" class="btn btn-success">Sincronize</button>
                                      </div>
                                            <p>&nbsp;</p>
                                    <table class="table table-bordered table-striped table-condensed flip-content" style="width: 60%;">
                                        <thead class="flip-content">
                                            <tr>
                                                <th>no</th>
                                                <th>Kode</th>
                                                <th>Warna</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i=0;
                                        $sql="SELECT kode_warna,warna FROM warna";
                                        $query=mysqli_query($connect, $sql) or die($sql);
                                        while (list($kode,$warna)=mysqli_fetch_array($query)){
                                        $i++;
                                        ?>
                                            <tr>
                                               <td><?php echo $i ?></td>
                                               <td><?php echo $kode ?></td>
                                               <td><?php echo $warna ?></td>
                                                                                                                
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
           