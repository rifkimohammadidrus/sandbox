
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
                                <span>Produk</span>
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
                                        <i class="fa fa-cogs"></i>All produk Marketplace Rabbani</div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                        <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                                        <a href="javascript:;" class="reload"> </a>
                                       <!-- <a href="javascript:;" class="remove"> </a> -->
                                    </div>
                                </div>
                                <div class="portlet-body flip-scroll">
                               
                                
                       <?php
							$sql="SELECT jb.kode_jenis, jb.nama, jb.gambar1, k.nama_kategori, jb.update_date, jb.status
                                  FROM kategori AS k INNER JOIN jenis_barang AS jb  ON (k.kode_kategori = jb.kode_kategori)
                                  order by jb.update_date DESC limit 150";
                            $query=mysqli_query($connect, $sql) or die($sql);
									?>
                          <div class="pull-right"><a href="#ajax-entry-produk" data-toggle="modal">
                                            <button type="button" class="btn btn-success">
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                            Tambah</button>
                                            </a></div>
                                            <p>&nbsp;</p>
                                    <table class="table table-bordered table-striped table-condensed flip-content z">
                                        <thead class="flip-content ">
                                            <tr >
                                                <th>No</th>
                                                <th>Kode model</th>
                                                <th>Nama</th>
                                                <th style="width: 210px;">Foto</th>
                                                <th>Kategori</th>
                                                <th>Terjual</th>
                                                <th>Stok</th>
                                                <th>Tgl upload</th>
                                                <th>Status</th>
                                                <th align="center" colspan="2">aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                     <?php $i=0;                      
                                      while (list($id,$nama,$foto,$kategori,$date,$status)=mysqli_fetch_array($query)){
                                      $i++;
                                      if($foto==''){
                                        $foto="kosong.jpg";
                                      }
                                      
									  ?>
                                            <tr>
                                               <td><?php echo $i ?></td>
                                               <td><strong><?php echo $id ?></strong></td>
                                               <td><?php echo $nama;?></td>
                                               <td><img src="../assets/foto_produk/<?php echo $foto;?>" style="width: 150px;"></td>
                                               <td><?php echo $kategori;?></td>
                                               <td>&nbsp;</td>
                                               <td>&nbsp;</td>
                                               <td><?php echo $date;?></td>
                                               <td><?php if($status==1) { echo"AKtif"; } else { echo"Non aktif"; } ?></td>
                                              
                                               <td> 
                                                    <a href="#ajax-edit-produk" data-toggle="modal" data-id="<?php echo $id;?>" title="Edit">
                                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                                    </a> 
                                          
                                              </td>                                              
                                            </tr>
                                          <?php }?> 
                                        </tbody>
                                    </table>
                                    
                                    
                                   
                    
                    
                                    <div class="modal fade" id="ajax-entry-produk" role="basic" aria-hidden="true" >
                                        <div class="modal-dialog" style="width:70%;">
                                            <div class="modal-content">
                                                 <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" 
                                                    aria-hidden="true"></button>
                                                    <h4 class="modal-title"><strong>Tambah Produk</strong></h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="fetched-data"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="modal fade" id="ajax-edit-produk" role="basic" aria-hidden="true" >
                                        <div class="modal-dialog" style="width:60%;">
                                            <div class="modal-content">
                                                 <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" 
                                                    aria-hidden="true"></button>
                                                    <h4 class="modal-title"><strong>Edit Produk</strong></h4>
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
        $('#ajax-entry-produk').on('show.bs.modal', function (e) {
			//alert(rowid);	
            $.ajax({
                type : 'POST',
                url :  'page/produk_tambah.php',
				cache: false,
                success : function(data){
				 $('.fetched-data').html(data);
                }
            });
         });
		 
		 $('#ajax-edit-produk').on('show.bs.modal', function (e) {
			var idx = $(e.relatedTarget).data('id');
			//alert(rowid);	
            $.ajax({
                type : 'POST',
                url :  'page/produk_edit.php',
				cache: false,
                data :  'id='+ idx,
                success : function(data){
				 $('.fetched-data2').html(data);
                }
            });
         }); 
		 
		 
    });
  </script>