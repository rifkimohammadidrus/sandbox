
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
                                <span>Outlet Marketplace Bani</span>
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
                                        <i class="fa fa-cogs"></i>Outlet Marketplace Bani</div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                        <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                                        <a href="javascript:;" class="reload"> </a>
                                       <!-- <a href="javascript:;" class="remove"> </a> -->
                                    </div>
                                </div>
                                <div class="portlet-body flip-scroll">
                                    <?php

                                        $sql="SELECT o.id,o.nama,o.alias,o.telp,o.alamat,k.nama_kota,p.nama_provinsi,o.foto,o.banner,o.update_date,o.status,o.wha,o.ig, o.no_rek, o.bank 
                                            FROM outlet as o 
                                            INNER join kota as k 
                                                on k.kode_kota=o.kota 
                                            INNER join provinsi as p 
                                                on p.kode_provinsi=o.provinsi 
                                            INNER join user_reseller AS ur
                                                ON (o.alias = ur.member_id)
                                            INNER JOIN member_reseller AS mr 
                                                ON (ur.member_id = mr.id_alias)
                                            where o.alias = '$_SESSION[id_outlet]'";
                                            $query=mysqli_query($connect,$sql) or die($sql);

                                            

                                    ?>
                                    
                                    <div class="pull-right"><a href="#ajax-entry-outlet" data-id="<?php echo $kode;?>" data-toggle="modal">
                                            <button type="button" class="btn btn-success">
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                            Tambah</button>
                                            </a></div>
                                            <p>&nbsp;</p>

    
                                    <table class="table table-bordered table-striped table-condensed flip-content z">
                                        <thead class="flip-content ">
                                            <tr >
                                                <th>No</th>
                                                <th style="width: 210px;">Foto</th>
                                                <th>ID & Nama Outlet</th>
                                                <th>Alamat</th>
                                                <th>URl & Medsos</th>
                                                <th>Bank</th>
                                                <th>status</th>
                                                <th align="center">aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                     <?php    $i=0;                   
                                      while (list($id,$nama,$alias,$telp,$alamat,$kota,$prov,$foto,$banner,$date,$status,$wha,$ig, $norek, $bank)=mysqli_fetch_array($query)){
                                      $i++;
                                      $k="SELECT k.nama_kurir,ok.id_origin FROM outlet_kurir AS ok INNER JOIN kurir AS k 
                                          ON (ok.id_kurir = k.id_kurir) where ok.id_outlet='$id'";
                                      $qk=mysqli_query($connect,$k);
                                      list($nama_kurir,$id_origin)=mysqli_fetch_array($qk);    
                                      include('../template/encrypt.php');
                                      $id_encrypt=encrypt($id);
                                    //   $id_decrypt=decrypt($id_encrypt);
									  ?> 
                                            <tr>
                                               <td><?php echo $i ?></td>
                                               <td><img src="../assets/images/outlet/<?php echo $foto;?>" style="width: 200px;"></td>
                                               <td><strong><?php echo $id ?></strong><br>
                                                   <?php echo $nama; ?></td>
                                               <td><?php echo $alamat."<br>".$kota."-".$prov."<br>".$telp;?></td>
                                               <td>
                                                <!-- <a href="http://mp.banibatuta.co.id/outlet-<?php echo $alias?>">mp.banibatuta.co.id/<?php echo $alias;?></a><br> -->
                                                <a href="http://reseller.rabbani.id/store/toko-<?php echo $nama;?>-<?php echo $id_encrypt;?>">http://reseller.rabbani.id/store/toko-<?php echo $nama;?>-<?php echo $id_encrypt;?></a><br>
                                                  <img src="../assets/images/icons/wa.png" style="width: 20px;">&nbsp;<?php echo $wha; ?><br>
                                                  <img src="../assets/images/icons/ig.png" style="width: 20px;">&nbsp;<?php echo $ig; ?><br></td>
                                               <td><?php echo $norek."<br>".$bank; ?></td>
                                               <td><?php if($status==1) { echo"AKtif"; } else { echo"Non aktif"; } ?></td>
                                              
                                               <td> 
                                                    <a href="#ajax-edit-outlet" data-toggle="modal" data-id="<?php echo $id;?>" title="Edit">
                                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                                    </a> 

                                                    | 
                                                    <a href="whatsapp://send?text=http://reseller.rabbani.id/store/toko-<?php echo $nama;?>-<?php echo $id_encrypt;?>" data-action="share/whatsapp/share"title="Share Toko" > <i class="fa fa-share-alt" aria-hidden="true"></i></a> 
                                                  <!-- <a href="index.php?menu=outlet_kurir&id=<?php echo $id?>" data-toggle="modal" title="Setting kurir">
                                                      <i class="fa fa-truck" aria-hidden="true"></i>
                                                  </a>  -->
                                              </td>                                              
                                            </tr>
                                          <?php }?> 
                                        </tbody>
                                    </table>
                                    
                    
                                    <div class="modal fade" id="ajax-entry-outlet" role="basic" aria-hidden="true" >
                                        <div class="modal-dialog" style="width:60%;">
                                            <div class="modal-content">
                                                 <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" 
                                                    aria-hidden="true"></button>
                                                    <h4 class="modal-title"><strong>Tambah Outlet</strong></h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="fetched-data"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="modal fade" id="ajax-edit-outlet" role="basic" aria-hidden="true" >
                                        <div class="modal-dialog" style="width:60%;">
                                            <div class="modal-content">
                                                 <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" 
                                                    aria-hidden="true"></button>
                                                    <h4 class="modal-title"><strong>Edit Outlet</strong></h4>
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
        $('#ajax-entry-outlet').on('show.bs.modal', function (e) {
			//alert(rowid);	
            $.ajax({
                type : 'POST',
                url :  'page/outlet_tambah.php',
				        cache: false,
                success : function(data){
				 $('.fetched-data').html(data);
                }
            });
         });
		 
		 $('#ajax-edit-outlet').on('show.bs.modal', function (e) {
			var idx = $(e.relatedTarget).data('id');
			//alert(rowid);	
            $.ajax({
                type : 'POST',
                url :  'page/outlet_edit.php',
				        cache: false,
                data :  'id='+ idx,
                success : function(data){
				 $('.fetched-data2').html(data);
                }
            });
         }); 
		 
		 
    });
  </script>