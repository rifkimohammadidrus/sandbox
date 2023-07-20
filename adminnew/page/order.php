
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
                                <span>Order</span>
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
                                       
                                    <style>
                                      .judul td{
                                        font-family: Verdana, Arial, Helvetica, sans-serif;
                                        font-size: 12px;
                                        color: #FFFFFF;
                                        padding-left: 10px;
                                        background-color: #5970B2;
                                        padding-bottom:5px;
                                      }
                                      .isi-tabel td{
                                        padding-left: 10px;
                                        font-family: Verdana, Arial, Helvetica, sans-serif;
                                        font-size: 12px;
                                      }
                                      
                                    .border-judul{
                                      border-right-width: medium;
                                      border-right-style: solid;
                                      border-left-style: solid;
                                      border-right-color: #298EFF;
                                      border-left-color: #298EFF;
                                      border-left-width: medium;
                                      border-bottom-width: medium;
                                      border-bottom-style: solid;
                                      border-bottom-color: #298EFF;
                                      border-top-width: medium;
                                      border-top-style: solid;
                                      border-top-color: #298EFF;
                                    } 
                                    </style>
                                    <?php
                                    
                                   
                                    $outlet=$_SESSION['id_outlet'];
                                   

                                   if(isset($_POST['submit'])){
                                      $tgl1=$_POST['tgl1'];
                                      $tgl2=$_POST['tgl2'];
                                      $status_approve=$_POST['status_approve'];
                                      
                                      $cari=$_POST['cari'];
                                      $_SESSION['tgl1']=$tgl1;
                                      $_SESSION['tgl2']=$tgl2;
                                      $_SESSION['status_approve']=$status_approve;
                                      

                                    } else {
                                      unset($_SESSION['tgl1']);
                                      unset($_SESSION['tgl2']);
                                      unset($_SESSION['status_approve']); 
                                     
                                      $tgl1=date('Y-m-01');
                                      $tgl2=date('Y-m-d');
                                      $cari='';
                                    }

                                        //$benar=false;
                                    if ($_GET['menu']=='modul_order'){
                                      $lanjutan="p.tanggal between '$tgl1 00:00:00' and '$tgl2 23:59:59'";
                                      $orderby="ORDER BY  p.tanggal DESC";
                                      $status1="and p.status=0";
                                      $report="<h4><font color=red>Daftar Order yang belum konfirmasi</font></h4>";
                                    }elseif($_GET['menu']=='modul_order_confirm') {
                                      $lanjutan="p.tanggal between '$tgl1 00:00:00' and '$tgl2 23:59:59'";
                                      $status1="and p.status=1";
                                      $orderby="ORDER BY  p.tanggal DESC";
                                      $report="<h4><font color=blue>Daftar Order yang sudah konfirmasi</font></h4>";   
                                    }elseif($_GET['menu']=='modul_order_approve') {
                                      $lanjutan="p.approve_date between '$tgl1 00:00:00' and '$tgl2 23:59:59'";
                                      $orderby="ORDER BY  p.approve_date DESC";
                                      $status1="and p.status=2 and p.jenis_bayar>=1";
                                      $report="<h4>Pesanan yang sudah menjadi omset </h4>";     
                                    } elseif ($_GET['menu']=='expired'){
                                      $lanjutan="p.tanggal between '$tgl1 00:00:00' and '$tgl2 23:59:59' and p.jenis_bayar<1";
                                      $report="<h4><font color=red>Daftar Order yang sudah Expired</font></h4>"; 
                                    }

                                    // if ($status_approve==0) {
                                    //   $lanjutan="p.tanggal between '$tgl1 00:00:00' and '$tgl2 23:59:59'";
                                    //   $orderby="ORDER BY  p.tanggal DESC";
                                    //   $status1="and p.status=0";
                                    //   $report="<h4><font color=red>Daftar Order yang belum konfirmasi</font></h4>";
                                    // }elseif ($status_approve==1) {
                                    //   $lanjutan="p.tanggal between '$tgl1 00:00:00' and '$tgl2 23:59:59'";
                                    //   $status1="and p.status=1";
                                    //   $orderby="ORDER BY  p.tanggal DESC";
                                    //   $report="<h4><font color=blue>Daftar Order yang sudah konfirmasi</font></h4>";  
                                    // }else{
                                    //   $lanjutan="p.approve_date between '$tgl1 00:00:00' and '$tgl2 23:59:59'";
                                    //   $orderby="ORDER BY  p.approve_date DESC";
                                    //   $status1="and p.status=2 and p.jenis_bayar>=1";
                                    //   $report="<h4>Pesanan yang sudah menjadi omset </h4>"; 
                                    // }


                                    // if($jenismember!=''){
                                    //   $lanjutan2="AND c.id_level='$jenismember'"; 
                                    // } else {
                                    //   $lanjutan2="";  
                                    // }

                                    // if ($statustrack!=''){
                                    //   $text_tracking="AND p.kode_track='$statustrack'"; 
                                    // }

                                    // if ($banktrf!=''){
                                    //   $text_bank="AND p.kode_bank='$banktrf'";  
                                    // }

                                    // if ($outlet!=''){
                                    //   $text_outlet="p.id_outlet='$outlet'";
                                    // }

                                    $kondisi=$_GET['menu'];



                                    $array_jenis= array('2'=>'Approve','1'=>'Sudah Konfirmasi', '0'=>'Belum Konfirmasi');
                                    ?>
                                    <p></p>
                                    <script>
                                     function pindah(kode){
                                      //alert(kode);
                                      $("#temp_no").val(kode);
                                      $("#f1").attr("action","detail_transaksi.php");// mengirim variable dalam form melalui post
                                      $("#f1").attr("target","");
                                      $("#submit").click();
                                      $("#f1").attr("action","konfirm.php?menu=<?php echo $kondisi; ?>");
                                      $("#f1").attr("target",""); 
                                    }

                                    function pindah2(kodebayar,kodetrans){
                                        // alert(kode);
                                      $("#temp_no").val(kodebayar);
                                      $("#temp_trans").val(kodetrans);
                                      $("#f1").attr("action","pembayaran.php");// mengirim variable dalam form melalui post
                                      $("#f1").attr("target","");
                                      $("#submit").click();
                                      $("#f1").attr("action","konfirm.php?menu=<?php echo $kondisi; ?>");
                                      $("#f1").attr("target","");   
                                    }
                                    </script>
                                    <?php 
                                    //echo"$tgl1-$tgl2";
                                    ?>
                                    <form name="f1" method="post" action="?menu=<?php echo $kondisi; ?>&log=<?php echo $log;?>" id="f1" >
                                    <table  class="table table-striped table-bordered table-hover" style="font-size:12px;">
                                   
                                    <tr>
                                      <td width="150">No trans / nama</td>
                                      
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
                                      <tr>
                                        <td>Status Approve</td>

                                      <td>
                                          <select name="status_approve">
                                         
                                           <?php 
                                           foreach($array_jenis as $key => $value){
                                              if($key==$status_approve){
                                               echo  "<option value='$key' selected>$value</option>";
                                            } else {
                                             echo  "<option value='$key'>$value</option>";
                                            }
                                            }
                                           ?>
                                        </select>
                                       &nbsp;&nbsp;&nbsp;
                                            
                                             
                                      </td>
                                      
                                      </tr>
                                      <tr>
                                       
                                          <?php 
                                          // Jika yang masuk adalah admin superuser, pilihan outlet ditampilkan
                                          if ($_SESSION['id_outlet']==''){?>
                                              Outlet
                                              <select  id="outlet" name="outlet">
                                              <option value="">--pilih--</option>
                                              <?php 
                                                $sql="SELECT id,nama,status FROM outlet where status=1";
                                                $query=mysqli_query($connect, $sql) or die ($sql);
                                                while(list($id,$nama_otl,$status)=mysqli_fetch_array($query)){
                                                ?>
                                                <option value="<?php echo $id?>" <?php if($outlet==$id){echo"selected";}?>><?php echo $nama_otl;?></option>
                                                      <?php } ?>
                                                </select> 
                                            <?php } ?>
                                          </td>
                                      </tr>
                                      <tr>
                                        <td>&nbsp;</td>

                                        <td>
                                          <input type="hidden" id="temp_no" name="temp_no"/>
                                          <input type="hidden" id="temp_trans" name="temp_trans"/>
                                          <input type="submit" name="submit" value="proses" id="submit" class="btn btn-info"/></td>
                                      
                                      </tr>
                                    </table>
                                    <br />
                                    <div class="pull-left"><?php echo $report; ?></div>
                                    
                                  
                                    <!--* klik no transaksi untuk melihat detail order
                                    <br />-->
                                    <table class="table table-bordered table-striped table-condensed flip-content z">
                                    <thead class="flip-content ">
                                      <tr class="portlet box green" style="color: #fff;" >
                                        <td>No Transaksi</td>
                                        <td>Customer ID</td>
                                        <td>Qty</td>
                                        <td>Total</td>
                                        <td>Status</td>
                                        <td>Nama</td>
                                        <td align='center'>No WhatsApp</td>
                                        <td align='center'>Metode Pengiriman</td>
                                        <td align='center'>Alamat</td>
                                                                              
                                      </tr>

                                    <?php 
                                    // $dataPerPage = 50;
                                    //        if(isset($_GET['page'])) 
                                    //        {
                                    //             $noPage = $_GET['page'];
                                    //          } 
                                    //            else $noPage = 1;
                                    //        $offset = ($noPage - 1) * $dataPerPage;
                                      
                                    $sql="SELECT p.no_transaksi, p.email, p.tanggal, p.status, p.jmlproduk, p.amount, 
                                           p.biaya_seluruh,
                                          p.voucher, p.nama, p.no_hp, p.metode_pengiriman, p.alamat, pd.id_barang
                                           FROM pesan AS p  INNER JOIN pesan_detail as pd on (pd.no_transaksi=p.no_transaksi)  where p.id_outlet='$outlet' and $lanjutan $status1 and (p.no_transaksi like '%$cari%' or p.email like '%$cari%' or p.nama like '%$cari%') group by p.no_transaksi $orderby ";  
                                    //  echo $sql;
                                    //  $lanjutan="p.tanggal between '$tgl1 00:00:00' and '$tgl2 23:59:59' and p.jenis_bayar<1";
                                    
                                    $query=mysqli_query($connect, $sql)or die($sql); 


                                    //echo $sql;
                                    // untuk pagging hitung jumlah data di tabel reshare
                                          // $count    = "SELECT COUNT(p.no_transaksi) AS jumData FROM pesan as p inner join customer as c on (p.id_customer=c.id)
                                          //            WHERE  
                                          //            (p.no_transaksi<>p.email) and p.status like '%$status_approve%' and 
                                          //      $lanjutan and no_transaksi not like '%BTL%' 
                                          //      and (p.no_transaksi like '%$cari%' or p.email like '%$cari%') $expired_text2  $lanjutan2 $text_tracking
                                          //       $text_bank $text_outlet";
                                          //   $hasil    = mysqli_query($connect, $count) or die ($count);
                                          //   $data     = mysqli_fetch_array($hasil);
                                          //   $jumData  = $data['jumData'];
                                          //   $jumPage = ceil($jumData/$dataPerPage);
                                          
                                    while(list($no_transaksi,$email,$tanggal,$status,$jmlproduk,$amount,$seluruh,$voucher,$nama, $no_hp, $metode_pengiriman, $alamat, $id_barang)=mysqli_fetch_array($query))
                                    { ?>
                                      <tr >
                                      <td rowspan=""><a href="#" onclick="pindah('<?php echo $no_transaksi;?>')"><?php echo $no_transaksi?></a>
                                      <br><font style="font-size: 12px;"><?php echo $tanggal?></font></td>
                                      <td><?php echo $no_hp."<br>" ?></td>
                                     <!--  <td ><?php echo $tanggal?></td> -->
                                      <td align="center"><?php echo $jmlproduk ?></td>
                                      <td align="right"><?php echo number_format("$amount",0,",",".");?></td>
                                      <!-- <td align="right"><?php echo number_format("$ongkos",0,",","."); ?></td> -->
                                      <!--<td align="right"><?php //echo number_format("$seluruh",0,",",".");?></td>-->
                                     
                                        <td align="center">
                                            <?php
                                            if($status==2)
                                            {
                                                echo "Approve";
                                            }elseif ($status==1) {
                                              echo "Konfirmasi";
                                            }else{
                                                echo"<font color='#FF0000'>Belum Konfirmasi</font><br>";
                                            }
                                             ?>
                                        </td>
                                        <td>
                                          <?php echo $nama ?>
                                        </td>
                                        <td style="text-align:center">
                                          <?php echo $no_hp ?>
                                        </td>
                                        <td style="text-align:center">
                                          <?php echo $metode_pengiriman ?>
                                        </td>
                                        <td>
                                          <?php echo $alamat ?>
                                        </td>
                                        
                                      <?php
                                    }?>

                                    <div class="modal fade" id="ajax-konfirmasi-admin" role="basic" aria-hidden="true" >
                                        <div class="modal-dialog" style="width:60%;">
                                            <div class="modal-content">
                                                 <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" 
                                                    aria-hidden="true" ></button>
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
                          url :  'page/konfirmasi_admin_reshare.php?log=<?php echo $time;?>',
                          cache: false,
                          data :  'id='+ idx,
                          success : function(data){
                           // alert('ok');
                           $('.fetched-data').html(data);
                          }
                      });
                   });

                   
                });   

                function edit_tracking(notrans,trackcode,status){
                  if (status=='2'){
                    $("#track_"+notrans).load("form_edit_tracking.php?no="+notrans);  
                  } else {
                    alert('Pesanan Belum Diapprove, tidak bisa input tracking');
                  }
                  
                }

                function update_tracking(notrans){
                  var kodetrack=$("#combotrack_"+notrans).val();
                  // alert(notrans+'-'+kodetrack);
                   $.ajax({
                          type : 'POST',
                          url :  'form_edit_tracking_proses.php?log=<?php echo $time;?>',
                          cache: false,
                          dataType:'text',
                          data:{nt:notrans, kt:kodetrack},
                          // data :  'notrans='+ notrans+',kodetrack='+kodetrack,
                          success : function(data){
                              var subdata=data.split("-");
                              // alert(subdata[0]);
                              $("#track_"+notrans).text(subdata[1]);
                          }
                      });

                }

                function edit_resi(notrans,status,resi){
                  if (status=='2'){
                    $("#resi_"+notrans).load("form_edit_resi.php?no="+notrans+"&r="+resi);  
                  } else {
                    alert('Pesanan Belum Diapprove, tidak bisa input resi');
                  }
                }

                function input_resi(notrans){
                   $("#inputresi_"+notrans).keydown(function(event){
                     if(event.keyCode == 13){
                         var resi=$.trim($("#inputresi_"+notrans).val()); 
                         // alert(resi);
                         $.ajax({
                            url:"form_edit_resi_proses.php",
                            type:"POST",
                            cache: false,
                            dataType:'text',
                            data:{r:resi, nt:notrans},
                            success: function(data) {
                              alert(data);
                              var subdata=data.split("-");
                              // alert(subdata[0]);
                              $("#resi_"+notrans).text(subdata[1]);
                            }// END SUCSESS
                        }); // end ajax
                     }
                  });
               }                            
              // function hide_modal(){
              //   alert('ok');
              //   $('#ajax-konfirmasi-admin').modal().hide();
              // }
            </script>      
            
            
