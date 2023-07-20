
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
                                <span>Order Pusat</span>
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
                                <div class="portlet-title">
                                    <div class="caption">
                                       &nbsp;&nbsp;Pemesanan produk
                                    </div>
                                </div>
                                <div class="portlet-body" id="main">
                                       
                                    
                                    <?
                                    $tgl1=date('Y-m-01');
                                    $tgl2=date('Y-m-d');
                                    $cari=$_POST['cari'];
                                    $banktrf=$_POST['banktrf'];
                                    if ($_POST['outlet']==''){
                                     $outlet=$_SESSION['id_outlet'];
                                    } else {
                                     $outlet=$_POST['outlet']; 
                                    }
                                    // echo "SESSION OUTLET = ".$_SESSION[id_outlet];

                                    if ($_GET['page']!='') { 
                                    $tgl1=$_SESSION['tgl1'];
                                    $tgl2=$_SESSION['tgl2'];
                                    $jenismember=$_SESSION['jenismember'];
                                    $status_approve=$_SESSION['status_approve'];
                                    } 

                                    else if($_POST['submit']){
                                    $tgl1=$_POST['tgl1'];
                                    $tgl2=$_POST['tgl2'];
                                    $status_approve=$_POST['status_approve'];
                                    $jenismember=$_POST['jenismember'];
                                    $statustrack=$_POST['statustrack'];

                                    $_SESSION['tgl1']=$tgl1;
                                    $_SESSION['tgl2']=$tgl2;
                                    $_SESSION['status_approve']=$status_approve;
                                    $_SESSION['jenismember']=$jenismember;
                                    //echo $_SESSION['tgl1'];

                                    } else {
                                    unset($_SESSION['tgl1']);
                                    unset($_SESSION['tgl2']);
                                    unset($_SESSION['status_approve']); 
                                    unset($_SESSION['jenismember']);  
                                      
                                    }

                                        //$benar=false;
                                    if ($_GET['menu']=='modul_order_pusat')
                                    {
                                        $lanjutan="AND pb.tanggal between '$tgl1 00:00:00' and '$tgl2 23:59:59'  and pb.jenis_bayar=0";
                                        //$benar=true; 
                                      $report="<h4><font color=red>Daftar Order yang belum konfirmasi</font></h4>";  
                                    }else if($_GET['menu']=='modul_order_confirm_pusat')
                                    {
                                      $lanjutan="AND pb.tanggal between '$tgl1 00:00:00' and '$tgl2 23:59:59'  and pb.jenis_bayar=1 ";
                                        //$benar=true;    
                                      $report="<h4><font color=blue>Daftar Order yang sudah konfirmasi</font></h4>";   
                                    }

                                    if ($cari!=''){
                                      $filter_cari="and (pb.id_bayar like '%$cari%' or pb.id_customer like '%$cari%')";
                                    }

                                    if ($statustrack!=''){
                                      $text_tracking="AND p.kode_track='$statustrack'"; 
                                    }

                                    if ($banktrf!=''){
                                      $text_bank="AND p.kode_bank='$banktrf'";  
                                    }

                                    if ($outlet!=''){
                                      $text_outlet="AND p.id_outlet='$outlet'";
                                    }

                                    $kondisi=$_GET['menu'];



                                    $array_jenis= array('2'=>'Approve','1'=>'Belum Approve');
                                    ?>
                                    <p></p>
                                    <script>
                                     function pindah(kode){
                                      //alert(kode);
                                      $("#temp_no").val(kode);
                                      $("#f1").attr("action","detail_transaksi_pusat.php");// mengirim variable dalam form melalui post
                                      $("#f1").attr("target","_blank");
                                      $("#submit").click();
                                      $("#f1").attr("action","konfirm.php?menu=<?php echo $kondisi; ?>");
                                      $("#f1").attr("target",""); 
                                    }

                                    function pindah2(kode){
                                        // alert(kode);
                                      $("#temp_no").val(kode);
                                      $("#f1").attr("action","pembayaran_pusat.php");// mengirim variable dalam form melalui post
                                      $("#f1").attr("target","");
                                      $("#submit").click();
                                      $("#f1").attr("action","konfirm.php?menu=<?php echo $kondisi; ?>");
                                      $("#f1").attr("target","");   
                                    }

                                    function pindah3(kode){
                                      //alert(kode);
                                      $("#temp_no").val(kode);
                                      $("#f1").attr("action","detail_transaksi.php");// mengirim variable dalam form melalui post
                                      $("#f1").attr("target","_blank");
                                      $("#submit").click();
                                      $("#f1").attr("action","konfirm.php?menu=<?php echo $kondisi; ?>");
                                      $("#f1").attr("target",""); 
                                    }
                                    </script>
                                    <?php 
                                    //echo"$tgl1-$tgl2";
                                    ?>
                                    <form name="f1" method="post" action="?menu=<?php echo $kondisi; ?>" id="f1" >
                                    <table  class="table table-striped table-bordered table-hover" style="font-size:12px;">
                                   
                                    <tr>
                                      <td width="150">No PB / Id customer</td>
                                      
                                      <td><input type="text" id="cari" name="cari" value="<?php echo $cari?>" size="55" /></td>
                                        
                                    </tr>
                                      <tr>
                                        <td>Tanggal</td>

                                        <td><script language="JavaScript" src="../calendar_us.js"></script>
                                                        <link rel="stylesheet" href="../calendar.css">
                                          <input type="text" id="tgl1" name="tgl1" value="<?php echo $tgl1;?>" />
                                            <script language="JavaScript">
                                                  new tcal ({
                                                    // form name
                                                    'formname': 'f1',
                                                    // input name
                                                    'controlname': 'tgl1'
                                                  });
                                                </script>
                                           Sampai 
                                           <input type="text" name="tgl2" id="tgl2" value="<?php echo $tgl2;?>"/>
                                            <script language="JavaScript">
                                                  new tcal ({
                                                    // form name
                                                    'formname': 'f1',
                                                    // input name
                                                    'controlname': 'tgl2'
                                                  });
                                                </script>
                                        </td>

                                      </tr>
                                      
                                      <!-- <tr>
                                         <td>Bank Transfer</td>
                                         <td>
                                                            <select name="banktrf" id="banktrf">
                                               <option value="">-- pilih --</option>
                                               <?php 
                                           $b="select id_bank,nama_bank,rekening,nama from bank where status=1";
                                           $qb=mysqli_query($connect, $b) or die($b);
                                           while(list($idbank,$bank,$rek,$namabank)=mysqli_fetch_array($qb)){
                                           ?>
                                               <option value="<?php echo $idbank;?>" <?php if($idbank==$banktrf){echo"selected";}?>><?php echo $bank." - ".$namabank." [ " .$rek. " ]";?></option>
                                               <?php }?>
                                             </select>&nbsp;&nbsp;&nbsp; 
                                          
                                         
                                          
                                          </td>
                                      </tr> -->
                                      <tr>
                                        <td>&nbsp;</td>
                                        <td>
                                          <input type="hidden" id="temp_no" name="temp_no"/>
                                          <input type="submit" name="submit" value="proses" id="submit"/>
                                        </td>
                                      </tr>
                                    </table>
                                    <br />
                                    <?php 
                                    echo $report;
                                    //echo $sql;?>
                                    <br />
                                    <!--* klik no transaksi untuk melihat detail order
                                    <br />-->
                                    <table class="table table-bordered table-striped" style="font-size: 11px;">
                                    <thead class="flip-content ">
                                      <tr class="portlet box green" style="color: #fff;" >
                                        <td>No PB.</td>
                                        <td>Id Customer</td>
                                        <td>Tanggal</td>
                                        <td>Total Order</td>
                                        <td>Total Ongkos</td> 
                                        <td>Kode unik</td>
                                        <td>Total TRF</td>
                                        <td>Bank</td>
                                        <td>Status TRF</td>
                                        <td>Approve</td>
                                        <!-- <td>Outlet Transaksi</td> -->                  
                                      </tr>
                                  <?php 
                                    $dataPerPage = 50;
                                           if(isset($_GET['page'])) 
                                           {
                                                $noPage = $_GET['page'];
                                             } 
                                               else $noPage = 1;
                                           $offset = ($noPage - 1) * $dataPerPage;
                                      
                                    $sql="SELECT m.nama, pb.id_customer,pb.id_bayar, pb.jenis_bayar, pb.tanggal, pb.total_belanja, 
                                          pb.total_ongkir, pb.amount, pb.angka_unik, pb.total_transfer, b.nama_bank, pb.angka_unik,pb.status
                                          FROM pesan_bayar AS pb INNER JOIN bank AS b  ON (pb.kode_bank = b.id_bank)
                                                                 INNER JOIN member AS m ON (m.email = pb.id_customer) 
                                          where pb.use_rekber=1  $lanjutan  $filter_cari                   
                                                                 ORDER BY pb.tanggal DESC";  

                                    if($_SESSION['username']=='ione'){
                                    echo $sql; 
                                    }
                                    $query=mysqli_query($connect, $sql)or die($sql); 
                                    while(list($email,$nama,$no_pb,$jenisbayar,$tanggal,$amount,$ongkos,$seluruh,$unik,$total_all,$namabank,$kode_unik,$status)=mysqli_fetch_array($query))
                                    {
                                    $i++; 
                                    $bgclr1 = "#EBECF1"; $bgclr2 = "#fff"; $bgcolor = ( $no % 2 ) ? $bgclr1 : $bgclr2;  
                                    $no++;

                                    $ongkos=$seluruh-$amount;
                                    $totaltransfer=$seluruh+$unik;
                                    
                                    //Get no transaksi & outlet seller from table pesan & outlet
                                    $n="SELECT p.no_transaksi, o.alias FROM pesan AS p INNER JOIN outlet AS o 
                                        ON (p.id_outlet = o.id) where id_pesan_bayar='$no_pb'";
                                    $qn=mysqli_query($connect, $n);
                                        
                                    ?>
                                    <tr bgcolor="<?php echo $bgcolor;?>">
                                      <td><a href="#" onclick="pindah('<?php echo $no_pb;?>')"><?php echo $no_pb ?></a></td>
                                      <td><?php echo $email."<br><strong>".$nama."</strong>" ?></td>
                                      
                                      <td ><?php echo $tanggal?></td>
                                      <td align="right"><?php echo number_format("$amount",0,",",".");?></td>
                                      <td align="right"><?php echo number_format("$ongkos",0,",","."); ?></td>
                                      <td align="right"><?php echo number_format("$kode_unik",0,",",".");?></td>
                                      <td align="right" >
                                           <?php echo number_format("$totaltransfer",0,",",".");?>
                                      </td>
                                      <td><?php echo $namabank;?></td>
                                      <td align="center">   
                                        <?php if($jenisbayar<1)
                                            { ?>
                                                 <a href="#ajax-konfirmasi-admin" data-id="<?php echo $no_pb;?>" 
                                                  data-toggle="modal">Not confim</a>
                                            <?php }else if($jenisbayar==1)
                                            { ?>
                                               <a href='#' onclick="pindah2('<?php echo $no_pb;?>')">Confirm</a>
                                            <?php } ?>
                                        </td>
                                        <td>
                                          <?php
                                            if($status<=1)
                                            {
                                                echo "<font color='#FF0000'>Belum</font>";
                                            }else
                                            {
                                                echo"Sudah";
                                            }
                                             ?>
                                        </td>
                                       <!-- <td><?php 
                                           while(list($notrans,$toko)=mysqli_fetch_array($qn)){?>
                                            <a href='#'  onclick="pindah3('<?php echo $notrans;?>')"><?php echo"$notrans - $toko";?></a><br>
                                           <?php }?>
                                      </td> -->
                                      </tr>
                                     
                                    <?php 

                                    $t_amount+=$amount;
                                    $t_ongkos+=$ongkos;
                                    $t_seluruh+=$seluruh;
                                    $t_totaltransfer+=$totaltransfer;

                                    }?>

                                    <?php 
                                    if ($t_amount!=''){
                                    ?>
                                    <tr class="portlet box green" style="color: #fff;">
                                      <td colspan="3"><em>Subtotal perhalaman</em></td>
                                      <td align="right"><?php echo number_format("$t_amount",0,",",".");?></td>
                                      <td align="right"><?php echo number_format("$t_ongkos",0,",",".");?></td>
                                      <td align="right">&nbsp;</td>
                                    <!--  <td align="right"><?php echo number_format("$t_seluruh",0,",",".");?></td> -->
                                      <td align="right"><?php echo number_format("$t_totaltransfer",0,",",".");?></td>
                                      <td colspan="7"></td>
                                    </tr>
                                    <?php } 


                                    $qtotal="SELECT  SUM(pb.total_belanja),SUM(pb.amount), SUM(pb.total_transfer)
                                             FROM pesan_bayar AS pb left join customer as c on (pb.id_customer=c.id)
                                             WHERE pb.id_bayar!='' $lanjutan $text_bank";
                                    $query_total=mysqli_query($connect, $qtotal) or die($qtotal);
                                    //echo $qtotal;
                                    list($tot_amount,$tot_seluruh,$tot_transfer,$tot_voucher)=mysqli_fetch_array($query_total);    
                                    $tot_ongkos=$tot_seluruh-$tot_amount;

                                    if ($t_amount!=''){
                                    ?>
                                    <tr class="portlet box green" style="color: #fff;">
                                      <td colspan="3"><strong><em>Total</em></strong></td>
                                      <td align="right"><?php echo number_format("$tot_amount",0,",",".");?></td>
                                      <td align="right"><?php echo number_format("$tot_ongkos",0,",",".");?></td>
                                     <!-- <td align="right"><?php// echo number_format("$tot_seluruh",0,",",".");?></td> -->
                                     <td align="right">&nbsp;</td>
                                      <td align="right"><?php echo number_format("$tot_transfer",0,",",".");?></td>
                                      <td colspan="7"></td>
                                    </tr>
                                    <?php } ?>

                                    </table>
                                    </form>
                                    <?php 
                                    echo"<div align=center>";
                                          if ($noPage > 1) echo "<a href='".$_SERVER['PHP_SELF']."?menu=$kondisi&page=".($noPage-1)."' class=linkpage onclick='pindah()'>
                                           <font size=2>&lt;&lt; Prev&nbsp;</a>";
                                          // memunculkan nomor halaman dan linknya
                                            for($page = 1; $page <= $jumPage; $page++)
                                           {
                                             if ((($page >= $noPage - 3) && ($page <= $noPage + 3)) || ($page == 1) || ($page == $jumPage)) 
                                             {   
                                                if (($showPage == 1) && ($page != 2)) 
                                           echo "..."; 
                                                if (($showPage != ($jumPage - 1)) && ($page == $jumPage))  echo "...";
                                                if ($page == $noPage) echo " <b><font size=2>".$page."</b> ";
                                                else echo " <font size=2><a href='".$_SERVER['PHP_SELF']."?menu=$kondisi&page=".$page."' class=linkpage onclick='pindah()'>".$page."&nbsp;</a> ";
                                                $showPage = $page;          
                                             }
                                           }
                                          // menampilkan link next
                                         if ($noPage < $jumPage) echo "<a href='".$_SERVER['PHP_SELF']."?kondisi=$kondisi&page=".($noPage+1)."' 
                                           class=linkpage onclick='pindah()'><font 
                                           size=2 >Next    
                                           </a>&nbsp;";
                                         echo"</div>";
                                    ?>

                                    <div class="modal fade" id="ajax-konfirmasi-admin" role="basic" aria-hidden="true" >
                                        <div class="modal-dialog" style="width:60%;">
                                            <div class="modal-content">
                                                 <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" 
                                                    aria-hidden="true"></button>
                                                    <h4 class="modal-title"><strong>Konfirmasi Pembayaran</strong></h4>
                                                    
                                                </div>
                                                <div class="modal-body">
                                                    <div class="fetched-data"></div>
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
            
            <script src="jquery-3.1.1.min.js"></script>
            <script type="text/javascript">
              $(document).ready(function(){
                // alert('hade'); 
                  $('#ajax-konfirmasi-admin').on('show.bs.modal', function (e) {
                    // alert('beuh'); 
                      var idx = $(e.relatedTarget).data('id');
                      $.ajax({
                          type : 'POST',
                          url :  'page/konfirmasi_admin.php?log=<?php echo $time;?>',
                          cache: false,
                          data :  'id='+ idx,
                          success : function(data){
                           // alert('ok');
                           $('.fetched-data').html(data);
                          }
                      });
                   });
                });   
            </script>      
