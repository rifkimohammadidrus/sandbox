
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
                                    if ($_GET['menu']=='modul_order')
                                    {
                                        $lanjutan="p.tanggal between '$tgl1 00:00:00' and '$tgl2 23:59:59' and p.jenis_bayar<1";
                                        $orderby="ORDER BY  p.tanggal DESC";
                                        //$benar=true; 
                                      $report="<h4><font color=red>Daftar Order yang belum konfirmasi</font></h4>";  
                                      $expired_text="and pb.expired=0"; 
                                      $expired_text2="and expired=0";
                                    }else if($_GET['menu']=='modul_order_confirm')
                                    {
                                        $lanjutan="p.tanggal between '$tgl1 00:00:00' and '$tgl2 23:59:59' and p.jenis_bayar>=1 and p.status=0";
                                        $orderby="ORDER BY  p.tanggal DESC";
                                        //$benar=true;    
                                      $report="<h4><font color=blue>Daftar Order yang sudah konfirmasi</font></h4>";   
                                    }else if($_GET['menu']=='modul_order_approve')
                                    {
                                        $lanjutan="p.approve_date between '$tgl1 00:00:00' and '$tgl2 23:59:59' and p.jenis_bayar>=1";
                                        $orderby="ORDER BY  p.approve_date DESC";
                                        $text_keterangan="<font style='font-size:12px;'><i>* Double klik kolom tracking/no resi untuk update tracking/no resi</i></font>";
                                        //$benar=true;  
                                      $report="<h4>Pesanan yang sudah menjadi omset </h4>";     
                                    } else if ($_GET['menu']=='expired'){
                                        $lanjutan="p.tanggal between '$tgl1 00:00:00' and '$tgl2 23:59:59' and p.jenis_bayar<1";
                                        //$benar=true; 
                                      $report="<h4><font color=red>Daftar Order yang sudah Expired</font></h4>";    
                                      $expired_text="and pb.expired=1";
                                      $expired_text2="and expired=1";
                                    }

                                    if($jenismember!=''){
                                      $lanjutan2="AND c.id_level='$jenismember'"; 
                                    } else {
                                      $lanjutan2="";  
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
                                          <option value="">--All--</option>
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
                                            Status tracking : <select name="statustrack">
                                                           <option value="">-- semua --</option>
                                                 <?php 
                                                 $sql="SELECT id,tracking FROM tracking order by urutan asc";
                                                 $query=mysqli_query($connect, $sql) or die ($sql);
                                                 while(list($id,$tracking)=mysqli_fetch_array($query)){
                                                 ?>   
                                                              <option value="<?php echo $id;?>" <?php if ($statustrack==$id){echo"selected";}?>>
                                                  <?php echo $tracking;?></option>
                                                           <?php } ?>
                                                           </select>
                                         &nbsp;&nbsp;&nbsp;    
                                           <!--  Jenis member : <select name="jenismember">
                                                           <option value="">-- semua --</option>
                                                 <?php 
                                                 $sql="SELECT id_level,jenis_member FROM customer_level";
                                                 $query=mysqli_query($connect, $sql) or die ($sql);
                                                 while(list($idl,$jenis)=mysqli_fetch_array($query)){
                                                 ?>   
                                                              <option value="<?php echo $idl;?>" <?php if ($jenismember==$idl){echo"selected";}?>><?php echo $jenis;?></option>
                                                           <?php } ?>
                                                           </select> -->
                                                     
                                             
                                      </td>
                                      
                                      </tr>
                                      <!-- <tr>
                                         <td>&nbsp;</td>
                                         <td>Bank Transfer
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
                                      </tr> -->
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
                                    <div class="pull-right"><?php echo $text_keterangan;?></div>
                                  
                                    <!--* klik no transaksi untuk melihat detail order
                                    <br />-->
                                    <table class="table table-bordered table-striped table-condensed flip-content z">
                                    <thead class="flip-content ">
                                      <tr class="portlet box green" style="color: #fff;" >
                                        <td>No Transaksi</td>
                                        <td>Customer ID</td>
                                        <!-- <td>Tanggal</td> -->
                                        <td>Qty</td>
                                        <td>Nett Sales</td>
                                        <td>Ongkir</td> 
                                        <!--<td>Total Bayar</td>-->
                                        <td>Total</td>
                                        <td>Bank</td>
                                        <td>Status</td>
                                        <td>Approve</td>
                                     <!--    <td>Tgl Approve</td> -->
                                        <!--<td>Media</td>-->
                                        <!-- <td>Media order</td> -->
                                        <!-- <td>Outlet</td> -->
                                        <td align='center'>Service</td>
                                        <td align='center'>Tracking</td>  
                                        <td align='center'  width="120">No.resi</td> 
                                                                              
                                      </tr>

                                    <?php 
                                    $dataPerPage = 50;
                                           if(isset($_GET['page'])) 
                                           {
                                                $noPage = $_GET['page'];
                                             } 
                                               else $noPage = 1;
                                           $offset = ($noPage - 1) * $dataPerPage;
                                      
                                    $sql="SELECT p.no_transaksi, p.email, p.tanggal, p.status, p.jmlproduk, p.amount, p.ongkos,
                                           p.biaya_seluruh, p.jenis_bayar, p.approve_date, p.android, mt.nama_from_trx, mm.nama, 
                                           t.tracking, c.id, c.id_level, p.voucher, o.alias, b.nama_bank,p.id_pesan_bayar,pb.use_rekber,p.status,pk.keterangan,kl.nama_layanan,pn.no_resi
                                           FROM pesan AS p 
                                                      LEFT JOIN member AS mm ON (mm.email=p.email) 
                                                      LEFT JOIN mst_transaksi_from AS mt ON (mt.kode_from_trx=p.dari_transaksi) 
                                                      LEFT JOIN tracking AS t ON (t.id=p.kode_track) 
                                                      LEFT JOIN customer AS c ON c.id=p.id_customer 
                                                      LEFT JOIN pengiriman AS pn ON (pn.no_transaksi=p.no_transaksi) 
                                                      LEFT JOIN outlet AS o ON (o.id=p.id_outlet) 
                                                      LEFT JOIN bank AS b ON (b.id_bank=p.kode_bank)
                                                      LEFT JOIN pesan_keterangan as pk on (pk.no_transaksi=p.no_transaksi)
                                                      LEFT JOIN kurir_layanan as kl on (kl.id=p.id_layanan) 
                                                      INNER JOIN pesan_bayar as pb on (pb.id_bayar=p.id_pesan_bayar) 
                                    where (p.no_transaksi<>p.email) and p.status like '%$status_approve%' and 
                                        $lanjutan and p.no_transaksi not like '%BTL%'  and (p.no_transaksi like '%$cari%' or p.email like '%$cari%' or pn.nama like '%$cari%')
                                        and delay=0 and pb.is_batal=0 $expired_text  $lanjutan2 $text_tracking $text_bank $text_outlet
                                     $orderby LIMIT $offset,$dataPerPage";  
                                     // echo $sql;
                                    if($_SESSION['username']=='ione'){
                                    echo $sql; 
                                    }
                                    $query=mysqli_query($connect, $sql)or die($sql); 

                                    //echo $sql;
                                    // untuk pagging hitung jumlah data di tabel reshare
                                          $count    = "SELECT COUNT(p.no_transaksi) AS jumData FROM pesan as p inner join customer as c on (p.id_customer=c.id)
                                                     WHERE  
                                                     (p.no_transaksi<>p.email) and p.status like '%$status_approve%' and 
                                               $lanjutan and no_transaksi not like '%BTL%' 
                                               and (p.no_transaksi like '%$cari%' or p.email like '%$cari%') $expired_text2  $lanjutan2 $text_tracking
                                                $text_bank $text_outlet";
                                            $hasil    = mysqli_query($connect, $count) or die ($count);
                                            $data     = mysqli_fetch_array($hasil);
                                            $jumData  = $data['jumData'];
                                            $jumPage = ceil($jumData/$dataPerPage);
                                          
                                    while(list($no_transaksi,$email,$tanggal,$status,$jmlproduk,$amount,$ongkos,$seluruh,$jenisbayar,$tglapprove,$media,$submedia,$nama,$status_track,$idcust,$idlevel,$voucher,$otl_trx,$namabanks,
                                      $pesanbayar,$use_rekber,$status,$keterangan_pesan,$nama_layanan,$no_resi)=mysqli_fetch_array($query))
                                    { 

                                    if($submedia==''){
                                       $submedia="Web";
                                    }



                                    $i++; 
                                    $bgclr1 = "#EBECF1"; $bgclr2 = "#fff"; $bgcolor = ( $no % 2 ) ? $bgclr1 : $bgclr2;  
                                    $no++;

                                    $cekhp="select RIGHT(hp,2) from pengiriman where no_transaksi='$no_transaksi'";
                                    $query_hp=mysqli_query($connect, $cekhp) or die ($cekhp);
                                    list($hp)=mysqli_fetch_array($query_hp);

                                    $amount=$amount-$voucher;
                                    $seluruh=$amount+$ongkos;
                                   
                                    if ($use_rekber==0){
                                      $txt_bank="reshare";
                                      $totaltransfer=$seluruh+$hp;
                                      $t_hp+=$hp;
                                    } else {
                                      $txt_bank="pusat";
                                      $totaltransfer=$seluruh;
                                    }

                                    $tglapprove=substr($tglapprove,0,10);
                                    ?>
                                    <tr bgcolor="<?php echo $bgcolor;?>">
                                      <td rowspan="2"><a href="#" onclick="pindah('<?php echo $no_transaksi;?>')"><?php echo $no_transaksi?></a>
                                      <br><font style="font-size: 12px;"><?php echo $tanggal?></font></td>
                                      <td><?php echo $email."<br><strong>".$nama."</strong><br>".$id_dropship; ?></td>
                                     <!--  <td ><?php echo $tanggal?></td> -->
                                      <td align="center"><?php echo $jmlproduk ?></td>
                                      <td align="right"><?php echo number_format("$amount",0,",",".");?></td>
                                      <td align="right"><?php echo number_format("$ongkos",0,",","."); ?></td>
                                      <!--<td align="right"><?php //echo number_format("$seluruh",0,",",".");?></td>-->
                                      <td align="right" >
                                           <?php echo number_format("$totaltransfer",0,",",".");?>
                                        </td>
                                        <td><?php echo $namabanks."<br>".$txt_bank;?></td>
                                        <td align="center">   
                                        <?php 
                                         // echo"$jenisbayar-$status";   
                                         if($jenisbayar<1)
                                            { 
                                               if ($use_rekber==0){?>
                                                 <a href="#ajax-konfirmasi-admin" data-id="<?php echo $pesanbayar;?>" 
                                                  data-toggle="modal">belum<br> konfirmasi</a>
                                            <?php } else {
                                                      echo"not confirm";
                                                  }

                                               } else if (($jenisbayar==1) && ($status==0))
                                               { ?>
                                               <a href='#' onclick="pindah2('<?php echo $pesanbayar;?>','<?php echo $no_transaksi;?>')">Sudah<br> konfirmasi</a>
                                            <?php }  else if (($jenisbayar==1) && ($status==2)) {?>
                                                 <a href='#' onclick="pindah2('<?php echo $pesanbayar;?>','<?php echo $no_transaksi;?>')">Lunas</a>
                                            <?php } ?>
                                        </td>
                                        <td align="center">
                                            <?php
                                            if($status<=1)
                                            {
                                                echo "<font color='#FF0000'>Belum</font>";
                                            }else
                                            {
                                                echo"Sudah<br>$tglapprove";
                                            }
                                             ?>
                                        </td>
                                      <td><?php echo "JNE ". $nama_layanan;?></td>
                                        <td align="center" id="track_<?php echo $no_transaksi;?>"  
                                          ondblclick="edit_tracking('<?php echo $no_transaksi;?>','<?php echo $status_track;?>','<?php echo $status?>')" style="cursor: pointer;"> 
                                        <?php echo $status_track;?>
                                         </td>
                                         <td id="resi_<?php echo $no_transaksi;?>"  ondblclick="edit_resi('<?php echo $no_transaksi;?>','<?php echo $status?>','<?php echo $no_resi?>')" style="cursor: pointer;"><?php echo $no_resi?></td>
                                         
                                      </tr>
                                      <tr bgcolor="<?php echo $bgcolor;?>"><td colspan="13">Pesan tambahan : <?php echo $keterangan_pesan;?></td></tr>
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
                                    <!--  <td align="right"><?php echo number_format("$t_seluruh",0,",",".");?></td> -->
                                      <td align="right"><?php echo number_format("$t_totaltransfer",0,",",".");?></td>
                                      <td colspan="7"></td>
                                    </tr>
                                    <?php } 


                                    $qtotal="SELECT  SUM(p.jmlproduk),SUM(p.amount), SUM(p.ongkos), SUM(p.biaya_seluruh),sum(p.voucher)
                                             FROM pesan AS p left join customer as c on (p.id_customer=c.id)
                                         WHERE (p.no_transaksi<>p.email) AND p.status LIKE '%$status_approve%'
                                             AND $lanjutan and delay=0 and p.no_transaksi not like '%BTL%' $lanjutan2 $text_tracking $text_bank $text_outlet ";
                                    $query_total=mysqli_query($connect, $qtotal) or die($qtotal);
                                    // echo $qtotal;
                                    list($tot_qty,$tot_amount,$tot_ongkos,$tot_seluruh,$tot_voucher)=mysqli_fetch_array($query_total);    

                                    $tot_amount=$tot_amount-$tot_voucher;
                                    $tot_seluruh=$tot_seluruh+$t_hp;
                                    if ($t_amount!=''){
                                    ?>
                                    <tr class="portlet box green" style="color: #fff;">
                                      <td colspan="3"><strong><em>Total</em></strong></td>
                                      <td align="right"><?php echo number_format("$tot_amount",0,",",".");?></td>
                                      <td align="right"><?php echo number_format("$tot_ongkos",0,",",".");?></td>
                                     <!-- <td align="right"><?php// echo number_format("$tot_seluruh",0,",",".");?></td> -->
                                      <td align="right"><?php echo number_format("$tot_seluruh",0,",",".");?></td>
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
            
            
