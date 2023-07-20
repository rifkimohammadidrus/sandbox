
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
                                <span>Setting kurir</span>
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
                            <?php 
                            $id=$_GET['id'];

                            $o="select nama from outlet where id='$id'";
                            $qo=mysqli_query($connect,$o) or die ($o);
                            list($nama_outlet)=mysqli_fetch_array($qo);
                            ?>
                            <div class="portlet box green">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-cogs"></i>Setting Kurir untuk seller <?php echo $nama_outlet;?></div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                        <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                                        <a href="javascript:;" class="reload"> </a>
                                       <!-- <a href="javascript:;" class="remove"> </a> -->
                                    </div>
                                </div>
                                <div class="portlet-body flip-scroll">
                                      <div class="pull-right"><a href="#ajax-entry-outlet-kurir" data-id="<?php echo $id;?>" data-toggle="modal">
                                            <button type="button" class="btn btn-success">
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                            Tambah</button>
                                            </a></div>
                                            <p>&nbsp;</p>
                                    <table class="table table-bordered table-striped table-condensed flip-content">
                                        <thead class="flip-content">
                                            <tr>
                                                <th>No</th>
                                                <!-- <th>Kode kurir</th> -->
                                                <th>Nama kurir</th>
                                                <th>Kode Origin</th>
                                                <th>Nama Paket</th>
                                                <th>update date</th>
                                                <th>Status</th>
                                                <th>aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        $sql="SELECT ok.id_kurir,ok.id_outlet,ok.id_layanan, k.nama_kurir, kl.nama_layanan, ok.update_date, ok.status, ok.id_origin 
                                              FROM outlet_kurir AS ok INNER JOIN outlet AS o  ON (ok.id_outlet = o.id)
                                                                      INNER JOIN kurir_layanan AS kl ON (ok.id_layanan = kl.id)
                                                                      INNER JOIN kurir AS k ON (ok.id_kurir = k.id_kurir)
                                                                      where id_outlet='$id'";
                                        $query=mysqli_query($connect,$sql) or die($sql);
                                        while (list($idk,$ido,$idl,$kurir,$layanan,$date,$status,$origin)=mysqli_fetch_array($query)){
                                        $i++;
                                        ?>
                                            <tr>
                                               <td><?php echo $i ?></td>
                                              <!--  <td><?php echo $idk ?></td> -->
                                               <td><?php echo $kurir ?></td>
                                               <td><?php echo $origin ?></td>
                                               <td><?php echo $layanan ?></td>
                                               <td><?php echo $date ?></td>
                                               <td><?php if($status==1){echo"aktif";} else {echo"tidak aktif";} ?></td>
                                               <td><a href="#ajax-edit-outlet-kurir" data-toggle="modal" data-id="<?php echo $idk.";".$ido.";".$idl;?>">
                                                    <i class="fa fa-edit" aria-hidden="true"></i>
</a></td>
                                                                           
                                            </tr>
                                          <?php }?> 
                                        </tbody>
                                    </table>

                                    <div class="modal fade" id="ajax-entry-outlet-kurir" role="basic" aria-hidden="true" >
                                        <div class="modal-dialog" style="width:60%;">
                                            <div class="modal-content">
                                                 <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" 
                                                    aria-hidden="true"></button>
                                                    <h4 class="modal-title"><strong>Tambah Kurir seller</strong></h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="fetched-data"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="ajax-edit-outlet-kurir" role="basic" aria-hidden="true" >
                                        <div class="modal-dialog" style="width:60%;">
                                            <div class="modal-content">
                                                 <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" 
                                                    aria-hidden="true"></button>
                                                    <h4 class="modal-title"><strong>Edit kurir seller</strong></h4>
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
        $('#ajax-entry-outlet-kurir').on('show.bs.modal', function (e) {
             var idx = $(e.relatedTarget).data('id');
            //alert(rowid); 
            $.ajax({
                type : 'POST',
                url :  'page/outlet_kurir_tambah.php',
                cache: false,
                data :  'id='+ idx,
                success : function(data){
                 $('.fetched-data').html(data);
                }
            });
         });
         
         $('#ajax-edit-outlet-kurir').on('show.bs.modal', function (e) {
            var idx = $(e.relatedTarget).data('id');
            //alert(rowid); 
            $.ajax({
                type : 'POST',
                url :  'page/outlet_kurir_edit.php',
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
           