
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
                                <span>Member </span>
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
                            <?php 
                                if ($_POST['submit']){
                                    $cari=$_POST['cari'];
                                     if ($cari!=''){
                                          $tambahan="where (m.nama like '%$cari%' or m.email like '%$cari%' or m.hp like '%$cari%')";
                                     } else {
                                          $tambahan="";  
                                     }    
                                }
                                ?>
                           
                            <!-- BEGIN SAMPLE TABLE PORTLET-->
                            <div class="portlet box green">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-cogs"></i>DATA MEMBER</div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                        <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                                        <a href="javascript:;" class="reload"> </a>
                                       <!-- <a href="javascript:;" class="remove"> </a> -->
                                    </div>
                                </div>
                                <div class="portlet-body">
                                
                                <form name="f1" method="post" action="member.php?id=<?php echo $time;?>" id="form_member">
                                   <table class="table table-striped table-bordered table-hover">
                                  <tr class="judul">
                                    <td colspan="2">&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td>Pencarian</td><td><input type="text" name="cari" id="cari" class="form-control" placeholder="Nama member/email/no hp" 
                                    value="<?php echo $cari;?>" />&nbsp;&nbsp;&nbsp;<!--Jenis member
                                       <select name="level">
                                          <option value="">--Semua--</option>
                                          <?php 
                                          $sql="SELECT id_level,jenis_member FROM customer_level where status=1";
                                          $query=mysqli_query($connect, $sql) or die($sql);
                                          while(list($idl,$jenis)=mysqli_fetch_array($query)){
                                          ?>
                                          <option value="<?php echo $idl?>"><?php echo $jenis;?></option>
                                          <?php }?>
                                       </select> -->
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td><input type="submit" class="btn btn-info" value="Cari member" name="submit" /></td>
                                  </tr>
                                  
                                </table>
                                </form>
                                

                                <table  class="table table-responsive table-bordered" >
                                    <tr class="bg-success">
                                        <td align="left"><strong>Nama member</strong></td>
                                        <td align="left"><strong>Alamat</strong></td>
                                        <td align="left"><strong>No telp</strong></td>
                                        <td align="left"><strong>Password</strong></td>
                                        <td align="left"><strong>Jenis Member</strong></td>
                                        <td align="left"><strong>No kartu</strong></td>
                                        <td align="left"><strong>Aksi</strong></td>
                                    </tr> 
                                    <?php
                                        $hal=$_GET['hal'];
                                        $jmlHal=20;
                                        $page=$hal;

                                        $sql="select SQL_CALC_FOUND_ROWS 
                                              m.email,concat(nama,' ',akhiran) as nama,k.nama_kota,m.alamat,m.tlp,m.hp,m.psw,m.id_level
                                              ,m.id_customer from member as m LEFT JOIN kota as k on (m.kode_kota=k.kode_kota)
                                               $tambahan 
                                              LIMIT ".($page*$jmlHal).",".$jmlHal;
                                        $query=mysqli_query($connect, $sql)or die($sql);
                                        
                                        //echo $sql;
                                        
                                        $sql2="SELECT FOUND_ROWS()";
                                        $query2=mysqli_query($connect, $sql2) or die ($sql2);  
                                        list($jmlData[0])=mysqli_fetch_array($query2);
                                        $no=($hal*$jmlHal); 
                                            
                                        while(list($email,$nama,$kota,$alamat,$tlp,$hp,$psw,$idlevel,$idcust)=mysqli_fetch_array($query))
                                        {
                                        // if ($idlevel=='DBN'){
                                        //   $text_level="DROPSHIPER"; 
                                        // } else 

                                        if ($idlevel=='BBN'){
                                          $text_level="BIRO BANI"; 
                                        } else if ($idlevel=='MBN'){
                                          $text_level="MEMBER BANI";    
                                        } else if ($idlevel=='014'){
                                          $text_level="KARYAWAN";    
                                        } else if ($idlevel==''){
                                          $text_level="End user";   
                                        }   ?>
                                          <tr class='bacaan'>
                                            <td><strong>Email: </strong><?php echo $email;?><br>
                                                <strong>Nama: </strong><?php echo $nama;?></td>
                                            <td><?php echo $alamat."<br>".$kota;?></td>    
                                            <td><?php echo $hp; ?></td>
                                            <td><?php echo $psw; ?></td>
                                            <td><?php echo $text_level; ?></td>
                                            <td><?php echo $idcust; ?></td>
                                            <td><a href="#ajax-edit-member" data-toggle="modal" data-id="<?php echo $email;?>" title="Edit">
                                                  <i class="fa fa-edit" aria-hidden="true"></i></a></td>
                                          </tr>  
                                            
                                    <?php
                                    } //endwhile ?>
                                    </table>

                                    <div class="modal fade" id="ajax-edit-member" role="basic" aria-hidden="true" >
                                        <div class="modal-dialog" style="width:60%;">
                                            <div class="modal-content">
                                                 <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" 
                                                    aria-hidden="true"></button>
                                                    <h4 class="modal-title"><strong>Edit Member</strong></h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="fetched-data"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row" align="center">
                                                    <div class="col-md-12">
                                                        <nav>
                                                            <ul class="pagination">
                                                                <li class="disabled"><a href="member-hal-1.php" 
                                                                aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
                                                                 <?php 
                                    for($i=0;$i<($jmlData[0]/$jmlHal);$i++){ 
                                                                    if($hal<=0){ ?>
                                                                        <li class="<?php if($i==$hal) echo "aktif"; else echo "hal"; ?>">
                                                                           <a href="member-hal-<?php echo $i; ?><?php echo $tambah?>.php" ><?php echo ($i+1); ?></a>
                                                                        </li>
                                                                        <?php if($i>=4) break;
                                                                    }else if(($hal+1)>=($jmlData[0]/$jmlHal)){
                                                                        if($i>=(($jmlData[0]/$jmlHal)-5)){ ?>
                                                                            <li>
                                                                               <a href="member-hal-<?php echo $i; ?><?php echo $tambah?>.php">
                                                                               <?php echo ($i+1); ?>
                                                                               </a>
                                                                            </li>
                                                                        <?php } 
                                                                    }else{
                                                                        if($i<=($hal+2)and $i>=($hal-2)){ ?>
                                                                            <li>
                                                                              <a href="member-hal-<?php echo $i; ?><?php echo $tambah?>.php">
                                                                              <?php echo ($i+1); ?>
                                                                              </a>
                                                                            </li>
                                                                      <?php }
                                                                    }
                                                                } ?>
                                                                
                                                        
                                                                
                                                                <li><a href="member-hal-<?php echo intval(($jmlData[0]/$jmlHal)); ?><?php echo $tambah?>.php" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
                                                            
                                                           
                                                            
                                                            
                                                            
                                                            </ul>
                                                        </nav>
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
               
                function pindah(kode){
                                      //alert(kode);
                                      $("#temp_no").val(kode);
                                      $("#f1").attr("action","detail_transaksi.php");// mengirim variable dalam form melalui post
                                      $("#f1").attr("target","");
                                      $("#submit").click();
                                    
                
                }

                $(document).ready(function(){
                  $('#ajax-edit-member').on('show.bs.modal', function (e) {
                      var email = $(e.relatedTarget).data('id');
                      $.ajax({
                          type : 'POST',
                          url :  'page/member_edit.php',
                          cache: false,
                          data :  'id='+ email,
                          success : function(data){
                            $('.fetched-data').html(data);
                          }
                      });
                   });
                });
            
            </script>
            <!-- END CONTENT -->
            <!-- BEGIN QUICK SIDEBAR -->
           