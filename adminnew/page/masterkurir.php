
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
                                <span>Master Expedisi  Marketplace</span>
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
                                        <i class="fa fa-cogs"></i>Data Expedisi Marketplace Rabbani</div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                        <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                                        <a href="javascript:;" class="reload"> </a>
                                       <!-- <a href="javascript:;" class="remove"> </a> -->
                                    </div>
                                </div>
                                <div class="portlet-body">
                               
                                
                                    <?php
									   $sql="SELECT id_kurir,nama_kurir,images,update_date,`status` FROM kurir order by update_date DESC";
                                       $query=mysqli_query($connect, $sql) or die($sql);
									?>
                                    <div class="pull-right"><a href="#ajax-entry-kurir" data-toggle="modal">
                                            <button type="button" class="btn btn-success">
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                            Tambah</button>
                                            </a></div>
                                            <p>&nbsp;</p><br>
                                    <table class="table table-bordered table-striped table-condensed flip-content z" style="width: 70%;">
                                        <thead class="flip-content ">
                                            <tr >
                                                <th>No</th>
                                                <th>Nama expedisi </th>
                                                <th style="width: 210px;">Logo</th>
                                                <th>Update date</th>
                                                <th>status</th>
                                                <th align="center">aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                     <?php        $i=0;               
                                      while (list($id,$kurir,$foto,$date,$status)=mysqli_fetch_array($query)){
                                      $i++;
                                      
									  ?>
                                            <tr>
                                               <td><?php echo $i ?></td>
                                               <td><?php echo $kurir ?></td>
                                               <td><img src="../assets/images/<?php echo $foto;?>" style="width: 100px;"></td>
                                               <td><?php echo $date;?></td>
                                               <td><?php if($status==1) { echo"AKtif"; } else { echo"Non aktif"; } ?></td>
                                              
                                               <td> 
                                                    <a href="#ajax-edit-kurir" data-toggle="modal" data-id="<?php echo $id;?>" title="Edit">
                                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                                    </a> |

                                                    <a href="index.php?menu=kurir_detail"  title="Detail Kurir">
                                                        <i class="fa fa-file" aria-hidden="true"></i>
                                                    </a> 
                                                 
                                              </td>                                              
                                            </tr>
                                          <?php }?> 
                                        </tbody>
                                    </table>
                                    
                                    
                                   
                    
                    
                                    <div class="modal fade" id="ajax-entry-kurir" role="basic" aria-hidden="true" >
                                        <div class="modal-dialog" style="width:60%;">
                                            <div class="modal-content">
                                                 <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" 
                                                    aria-hidden="true"></button>
                                                    <h4 class="modal-title"><strong>Tambah Kurir</strong></h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="fetched-data"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="modal fade" id="ajax-edit-slide" role="basic" aria-hidden="true" >
                                        <div class="modal-dialog" style="width:60%;">
                                            <div class="modal-content">
                                                 <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" 
                                                    aria-hidden="true"></button>
                                                    <h4 class="modal-title"><strong>Edit Slide</strong></h4>
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
            <!-- END CONTENT -->
            <!-- BEGIN QUICK SIDEBAR -->
 <script src="jquery-3.1.1.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){
        $('#ajax-entry-kurir').on('show.bs.modal', function (e) {
			//alert(rowid);	
            $.ajax({
                type : 'POST',
                url :  'page/kurir_tambah.php',
				cache: false,
                success : function(data){
				 $('.fetched-data').html(data);
                }
            });
         });
		 
		 $('#ajax-edit-slide').on('show.bs.modal', function (e) {
			var idx = $(e.relatedTarget).data('id');
			//alert(rowid);	
            $.ajax({
                type : 'POST',
                url :  'page/slide_edit.php',
				cache: false,
                data :  'id='+ idx,
                success : function(data){
				 $('.fetched-data2').html(data);
                }
            });
         }); 
		 
		 
    });
  </script>