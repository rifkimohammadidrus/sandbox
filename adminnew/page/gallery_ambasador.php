<script src="jquery.lazyload.js?v=1.9.1"></script>
  <!-- <script src="http://www.appelsiini.net/js/demo.js"></script> --> 
  
  <script type="text/javascript" charset="utf-8">
  jQuery.noConflict();
  jQuery(function() {
    jQuery("img.lazy").lazyload({
         effect : "fadeIn"
     });

  });
</script>
     <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEADER-->
                    <!-- BEGIN THEME PANEL -->
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
                                <span>Gallery</span>
                            </li>
                        </ul>
                        <div class="page-toolbar">
                            <div class="btn-group pull-right">
                                <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> &nbsp;
                                   
                                </button>
                               
                            </div>
                        </div>
                    </div>
                    <!-- END THEME PANEL -->
                    
                    <!-- END PAGE HEADER-->
                    <div class="row">
                        <div class="col-md-12">
                           
                            <div class="portlet light box green">
                                <div class="portlet-body" id="main">
                                         <?php 
										    $hal=$_GET['hal'];
			                                $jmlHal=12;
			                                $page=$hal;
											
											$kat=$_GET['kat'];
											if($kat!=''){
											 $tambahan="where k.kategori='$kat'";	
											}
										 
										    $skat="select name from tbl_categories where id='$kat'";
											$qskat=mysqli_query($connect, $skat) or die ($skat);
											list($nama_kategori)= mysqli_fetch_array($qskat);
										 ?>
                                         <h3 class="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                   Ambasador Gallery 
                                          </h3>
                                          <div class="m-grid m-grid-responsive-md m-grid-demo">
                                           <div class="col-sm-12">
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <a href="page/ambasador_tambah.php?id=jsd1h3srsjsad" data-target="#ajax-entry" 
                                            data-toggle="modal"> 
                                            <button type="button" class="btn btn-success">
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                            Tambah</button>
                                            </a>
                                           </div>
                                           <div class="col-sm-12">
                                            
											<?php 
		                                    $sql="SELECT SQL_CALC_FOUND_ROWS
											      id,judul,images,update_date,status FROM tbl_ambasador order by update_user
												  DESC LIMIT ".($page*$jmlHal).",".$jmlHal;
											$query=mysqli_query($connect, $sql) or die ($sql);
											
											//echo $sql;
											
											$sql2="SELECT FOUND_ROWS()";
			                                $query2=mysqli_query($connect, $sql2) or die ($sql2);	
                                            list($jmlData[0])=mysqli_fetch_array($query2);
                                            $no=($hal*$jmlHal);	  
											
											while(list($id,$judul,$images,$updatedate,$status)= mysqli_fetch_array($query)){
												
												
												?>   
                                                    <div class="col-sm-3" 
                                                    style="padding: 20px; height: 350px; width:270px;">
                                                        <div class="m-grid m-grid-full-height">
                                                            <div class="m-grid-col m-grid-col-bottom m-grid-col-center 
                                                            bg-light font-green" style="padding: 20px;">
                                              
                                  <!--           <img src="../<?php echo $image; ?>" class="img-responsive blog-img-thumb"/>  -->
                                                           
                                           <img class="lazy img-responsive" 
                                           data-original="../page/images/ambasador/<?php echo $images; ?>"/>
                                              <br />
                                             <a href="#ajax" data-id="<?php echo $id;?>" data-toggle="modal">
                                               
                                               <button class="btn red" style="font-size:12px;"><?php echo $judul;?>
                                               </button><br />
                                               <strong style="font-size:12px;"><?php echo $updatedate; ?></strong>
                                               <br />
                                               <?php if($status==1){?>
											      <span class="badge badge-success">Publish
                                                  
                                                  &nbsp;<i class="fa fa-check" aria-hidden="true"></i>
</span>                                           
											    <?php } else {?>
											      <span class="badge badge-danger">Not publish &nbsp;
                                                  <i class="fa fa-times" aria-hidden="true"></i>
</span>
											    <?php }?>
                                              
                                               </a>
                                               
                                               </div>
                                                        </div>
                                                    </div>
                                            <?php }?> 
                                              
                                                    
                                                    
                                                    
                                                </div>
                                            </div>
                                     
                                               </a>
                                            <!--end: Demo 5 -->
                                            <p>&nbsp;</p>
                                     <div class="modal fade" id="ajax" role="basic" aria-hidden="true" >
                                        <div class="modal-dialog" style="width:60%;">
                                            <div class="modal-content">
                                                 <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" 
                                                    aria-hidden="true"></button>
                                                    <h4 class="modal-title">Edit Produk</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="fetched-data"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="modal fade" id="ajax-entry" role="basic" aria-hidden="true" >
                                        <div class="modal-dialog" style="width:60%;">
                                            <div class="modal-content">
                                                 <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" 
                                                    aria-hidden="true"></button>
                                                    <h4 class="modal-title">Tambah Produk</h4>
                                                </div>
                                                <div class="modal-body">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                            <!-- Paging -->
                         <nav style="margin-left:35px;">
						<ul class="pagination">
							<li class="disabled"><a href="index.php?menu=modul_katalog&kat=<?php echo $kat;?>&hal=0" 
                            aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
							 <?php 
for($i=0;$i<($jmlData[0]/$jmlHal);$i++){ 
								if($hal<=0){ ?>
									<li class="<?php if($i==$hal) echo "aktif"; else echo "hal"; ?>">
                                       <a href="index.php?menu=modul_katalog&kat=<?php echo $kat;?>&hal=<?php echo $i; ?><?php echo $tambah?>" ><?php echo ($i+1); ?></a>
                                    </li>
									<?php if($i>=4) break;
								}else if(($hal+1)>=($jmlData[0]/$jmlHal)){
									if($i>=(($jmlData[0]/$jmlHal)-5)){ ?>
										<li>
										   <a href="index.php?menu=modul_katalog&hal=<?php echo $i; ?><?php echo $tambah?>">
										   <?php echo ($i+1); ?>
                                           </a>
                                        </li>
									<?php } 
								}else{
									if($i<=($hal+2)and $i>=($hal-2)){ ?>
										<li>
										  <a href="index.php?menu=modul_katalog&hal=<?php echo $i; ?><?php echo $tambah?>">
										  <?php echo ($i+1); ?>
                                          </a>
                                        </li>
								  <?php }
								}
							} ?>
							
					
							
							<li><a href="index.php?menu=modul_katalog&hal=<?php echo intval(($jmlData[0]/$jmlHal)); ?><?php echo $tambah?>&n=<?php echo $nama_pr?>" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
						
                       
                        
                        
                        
                        </ul>
					</nav>
                                            <!-- End paging -->     
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
            
            
 <script src="jquery-3.1.1.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){
        $('#ajax').on('show.bs.modal', function (e) {
			var idx = $(e.relatedTarget).data('id');
			//alert(rowid);	
            $.ajax({
                type : 'POST',
                url :  'page/ambasador_edit.php?ID=SJDKSD',
				cache: false,
                data :  'id='+ idx,
                success : function(data){
				 $('.fetched-data').html(data);
                }
            });
         });
    });
  
 
  
  </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>