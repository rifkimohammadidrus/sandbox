
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
                                <span>Detail Bayar Rekber</span>
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
                                        <i class="fa fa-cogs"></i>Detail Pembayaran
                                    </div>
                                </div>
                            </div>    
                            <?php 
                              $no_pb=$_POST['temp_no'];
                              $no_transaksi=$_POST['temp_trans'];
                              $uid=$_GET['uid'];
                              $username=$_SESSION['namauser'];
                              if ($no_transaksi==""){
                              $no_transaksi=$_GET['no_transaksi'];
                              //echo $no_transaksi; 
                              }
                              ?>
                              <style>
                                .head td{
                                font-family: Verdana, Arial, Helvetica, sans-serif;
                                font-size: 12px;
                                font-weight: bolder;    
                                }
                                
                                .bacaan td{
                                font-family: Verdana, Arial, Helvetica, sans-serif;
                                font-size: 12px;  
                                }
                                
                                .box {
                                border: thin solid #21599E;
                                }
                              </style>
                              <form action="index.php?menu=modul_detailbayar_pusat&no_pb=<?php echo $no_pb;?>" method="post" name="f1">
                              <table border="0" cellspacing="0" cellpadding="0"  width="800">
                              <tr class="head">
                                <td class="headjudul" height="35" valign="middle"> &nbsp;&nbsp;<font color="#FF0000">T</font>ransaksi</td>
                              </tr>
                              <tr>
                                <td height="8"></td>
                              </tr>
                              <tr>
                                <td>
                                <?php 
                                $cek="select use_rekber from pesan_bayar where id_bayar='$no_pb'";
                                $qcek=mysqli_query($connect, $cek);
                                list($use_rekber)=mysqli_fetch_array($qcek); 


                                $sql="SELECT pm.no_transaksi,
                                       b.nama_bank,
                                       b.rekening,
                                       pm.no_transfer,
                                       pm.no_rekening,
                                       pm.uang,
                                       pm.tanggal,
                                       ba.nama_bank,
                                       pm.kode_bank 
                                FROM  pembayaran AS pm left JOIN bank AS b ON (pm.kode_bank=b.id_bank)
                                                       left JOIN bank_asal as ba ON (pm.bankasal=ba.id)
                                WHERE pm.no_transaksi='$no_pb' ";

                                

                                //echo $sql;
                                $query=mysqli_query($connect, $sql)or die($sql);
                                list($no_pb,$bank,$rekbank,$no_transfer,$rekening,$uang,$tanggal,$bankasal,$kodebank)=mysqli_fetch_array($query);
                                $datetime=date('Y-m-d h:i:s');
                                
                                $s="select o.nama,biaya_seluruh,o.id from pesan as p left join outlet as o on (p.id_outlet=o.id) 
                                where p.no_transaksi='$no_transaksi'";
                                $qs=mysqli_query($connect, $s)or die($s);
                                list($outlet_transaksi,$totaltransfer_outlet,$id_outlet)=mysqli_fetch_array($qs);
                                //echo "status=".$cek_status;

                                if($use_rekber==0){
                                    $ba="SELECT b.nama_bank, ob.no_rekening
                                         FROM outlet_bank AS ob INNER JOIN bank AS b 
                                         ON (ob.id_bank = b.id_bank) where id='$id_outlet'";
                                    // echo $ba;     
                                    $qba=mysqli_query($connect, $ba);
                                    list($bankoutlet,$rek_outlet)=mysqli_fetch_array($qba);     
                                    $bank="$bankoutlet";
                                    $rekbank="$rek_outlet";
                                }
                                ?>
                                <table  class="table table-responsive table-bordered table-striped" style="border: solid 3px #ccc;">
                                <tr class="bacaan">
                                  <td width="230">  No Pembayaran  </td>
                                  <td width="2">  :  </td>
                                  <td>  <?php echo $no_pb?>  <input type="hidden" id="temp_no" name="temp_no" value="<?php echo $no_transaksi;?>"/></td>
                                </tr>
                                <!-- <tr class="bacaan">
                                  <td width="230">  No Order  </td>
                                  <td width="2">  :  </td>
                                  <td>  <?php echo $no_transaksi?>  <input type="hidden" id="temp_trans" name="temp_trans" value="<?php echo $no_transaksi;?>"/></td>
                                </tr> -->
                                <tr class="bacaan">
                                  <td>  Bank Pembayar  </td>
                                  <td>  :  </td>
                                  <td>  <?php echo $bankasal?>  </td>
                                </tr>
                                <tr class="bacaan">
                                  <td>  No Rekening Pembayar  </td>
                                  <td>  :  </td>
                                  <td>  <?php echo $rekening?>  </td>
                                </tr>
                                <tr class="bacaan">
                                  <td>  Atas Nama  </td>
                                  <td>  :  </td>
                                  <td>  <?php echo $no_transfer?>  </td>
                                </tr>
                                
                                
                                <tr class="bacaan">
                                  <td>  Bayar Ke Bank  </td>
                                  <td>  :  </td>
                                  <td>   <?php echo $bank." - ".$rekbank;?><input type="hidden" name="bankt" value="<?php echo $kodebank?>"><!-- <select  id="bankt" name="bankt">
                                            <?php 
                                      /*$sql="SELECT id_bank,rekening,nama,nama_bank FROM bank ";
                                      $query=mysqli_query($connect, $sql) or die ($sql);
                                      while(list($idbank,$rek,$atasnama,$bank)=mysqli_fetch_array($query)){
                                      ?>
                                            <option value="<?php echo $idbank?>" <?php if($idbank==$kodebank){echo"selected";}?>><?php echo $bank." [ ".$rek." ] ".$atasnama;?></option>
                                            <?php } */?>
                                            </select>-->  
                                      
                                      </td>
                                </tr>
                               <!--  <tr class="bacaan">
                                  <td>  Outlet transaksi  </td>
                                  <td>  :  </td>
                                  <td> <?php echo" $outlet_transaksi"; ?></td>
                                </tr>  -->
                                
                                <tr class="bacaan">
                                  <td>  Total Transfer </td>
                                  <td>  :  </td>
                                  <td>  <?php echo number_format("$uang",0,".",",");?>  </td>
                                </tr>
                             
                                <tr class="bacaan">
                                  <td>  Tanggal Konfirmasi  </td>
                                  <td>  :  </td>
                                  <td>  <?php 
                                  /*$tanggal=explode("-",$tanggal);
                                  echo $tanggal[2]."-".$tanggal[1]."-".$tanggal[0];*/
                                  echo $tanggal;
                                  ?>  </td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td></td>
                                  <td>
                                      <?php
                                  $sql="select status from pesan_bayar where id_bayar='$no_pb'";

                                  $query=mysqli_query($connect, $sql)or die($sql);
                                  list($status)=mysqli_fetch_array($query);
                                  if ($status<2)
                                  {
                              ?>
                                      <input type="submit" value="Approve" name="approve"><?php
                                  }
                              ?><input type="button" onClick="javascript:history.back();" value="Kembali"></td>
                                </tr>
                                </table><br />
                                
                                
                                  
                                 </td>
                              </tr>
                              </table>
                              </form>
                              <?php if($_POST['approve'])
                              { 
                                $no_pb=$_GET[no_pb];
                                // echo"NO PESAN BAYAR : $no_pb";
                                     $bankt=$_POST[bankt];
                                     // $outlet=$_POST[outlet];
                                     $main="update pesan_bayar set status='2' where id_bayar='$no_pb'";
                                     $qmain=mysqli_query($connect, $main);

                                     $qpesan="select no_transaksi,id_outlet from pesan where id_pesan_bayar='$no_pb'";
                                     $query_qpesan=mysqli_query($connect, $qpesan);


                                     while(list($notrans,$otl)=mysqli_fetch_array($query_qpesan))
                                     {

                                         $sql="update pesan set status='2',kode_track='1',kode_bank='$bankt',approve_date='$datetime',approve_by='$username'
                                             where no_transaksi='$notrans'";
                                         //echo $sql;
                                         $query=mysqli_query($connect, $sql)or die($sql);
                                         
                                         $sql="select id_barang,qty,voucher_stat from pesan_detail where no_transaksi='$notrans'";
                                         $query=mysqli_query($connect, $sql);
                                         while(list($id_barang,$qty,$status_voucher)=mysqli_fetch_array($query))
                                         {
                                        // $s="select tipe from jenis_barang where kode_jenis=SUBSTRING('$id_barang',1,7)"; 
                                        //     $qs=mysqli_query($connect, $s) or die ($s);
                                        // list($tipe)=mysqli_fetch_array($qs);
                                          
                                            if($status_voucher==1){
                                              $sql="select stok from master_barang_voucher where id_barang='$id_barang' 
                                                    and id_outlet='$otl'";
                                                    $res=mysqli_query($connect, $sql)or die($sql);
                                                    list($stok)=mysqli_fetch_array($res);  
                                                    $sisa=$stok-$qty;
                                                    $sql="update master_barang_voucher set stok='$sisa' where id_barang='$id_barang' 
                                                          and id_outlet='$otl'";
                                                    $res=mysqli_query($connect, $sql);  
                                            } else {     
                                              $sql="select stok from master_barang where id_barang='$id_barang' and id_outlet='$otl'";
                                                    $res=mysqli_query($connect, $sql)or die($sql);
                                                    list($stok)=mysqli_fetch_array($res);  
                                                    $sisa=$stok-$qty;
                                                    $sql="update master_barang set stok='$sisa' where id_barang='$id_barang' and id_outlet='$otl'";
                                                    $res=mysqli_query($connect, $sql);      
                                            }
                                       
                                         } // end while per pesan_detail
                                     }// while per pesan
                                     
                                     $sql="select email from pengiriman where no_transaksi='$no_pb'";
                                     $query=mysqli_query($connect, $sql)or die($sql);
                                     list($email)=mysqli_fetch_array($query);   
                                     
                                     $sql="SELECT
                                        `p`.`uang`
                                        , `b`.`nama_bank`
                                    FROM
                                        `pembayaran` as p
                                        INNER JOIN `bank` as b 
                                            ON (`p`.`kode_bank` = `b`.`id_bank`) WHERE p.no_transaksi='$no_pb'"; 
                                      $query=mysqli_query($connect, $sql)or die($sql);list($uang,$bang)=mysqli_fetch_array($query);               
                                    $message="<table style='width:100%; border: solid 1px #ccc; text-align:justify; padding:5px; line-height:25px;'>
                                    <tr>
                                      <td align='center'><img src='https://banibatuta.co.id/t3stingg/images/logo_bani.png'></td>
                                    </tr>
                                    <tr>
                                      <td>Transfer anda ke banibatuta dengan detail transaksi sebagai berikut :<br>
                                      <table border='0'>
                                      <tr>
                                        <td>No Transaksi</td>
                                        <td>:</td>
                                        <td>$no_transaksi</td>
                                      </tr>
                                      <tr>
                                        <td>Jumlah Uang </td>
                                        <td>:</td>
                                        <td>$uang</td>
                                      </tr>
                                      <tr>
                                        <td>Ke Bank</td>
                                        <td>:</td>
                                        <td>$bang</td>
                                      </tr>
                                      </table><br>
                                      Telah kami terima, dan kami sekarang sedang mempersiapkan barang yang anda pesan pada kami,
                                      
                                      <br>
                                      <br>
                                      <u>Admin Bani Batuta</u>
                                      </td>
                                    </tr>
                                    </table>";

                                    $headers = 'From: <info@banibatuta.co.id>' . "\r\n";
                                    $headers .= 'Cc: info@banibatuta.co.id' . "\r\n";
                                    $headers .= "MIME-Version: 1.0\r\n";
                                    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
                                    $kirim = @mail("$email", "Konfirmasi Transaksi Bani Batuta", $message, $headers);

                                          echo"<script>document.location=\"confirm_pusat.php\";</script>";
                                         $_SESSION['email']=$email;
                                    }

                              ?>


                              <br>

                              <?php 
                              //echo"$uid";
                              if ($uid==''){
                              ?>
                              <form action="index.php?menu=modul_detailbayar_pusat&no_transaksi<?php echo $no_transaksi?>" method="post" name="f1">
                                <table border="0" cellspacing="0" cellpadding="0"  width="500">
                                  <tr class="head">
                                     <td class="headjudul" height="35" valign="middle" colspan="3"> &nbsp;&nbsp;<font color="#FF0000">K</font>irim informasi Resi </td>
                                  </tr>
                                  <tr>
                                     <td height="8"></td>
                                  </tr>
                                  <?php  
                                  $sql="select email,no_resi from pengiriman where no_transaksi='$no_transaksi'";
                                    $query=mysqli_query($connect, $sql)or die($sql);
                                    list($email,$resitext)=mysqli_fetch_array($query);?>
                                    <tr class="bacaan">
                                      <td width="150">  Alamat Email   </td>
                                     
                                      <td>  :  </td>
                                      <td>  <?php 
                                     echo $email;
                                      ?>  </td>
                                  </tr>
                                   <tr class="bacaan">
                                      <td>  Nomor Resi</td>
                                      <td>  :  </td>
                                      <td><input type="text" name="resi" size="40" value="<?php echo $resitext;?>" /></td>
                                  </tr>
                                  <?php 
                                if ($resitext==""){
                                ?>
                                  <tr>
                                      <td></td>
                                      <td></td>
                                      <td><input type="submit" value="kirim Informasi Resi" name="resi_insert"></td>
                                  </tr>
                                  <?php } ?>
                                  </table>
                                 </td>
                              </tr>
                              </table>
                              </form>
                              <?php } else {?>
                              <table border="1" cellpadding="0" cellspacing="0"  width="600" style="font-size:14px;">
                                <tr   class="judul">
                                  <td height="28">No</td>
                                  <td>Kode Barang</td>
                                  <td>Nama Barang</td>
                                  <td>Warna</td>
                                  <td>Harga</td>
                                  <td>Qty</td>
                                  <td>Discount</td>
                                  <td>Amount</td> 
                                </tr>
                                <? 
                                
                                $sql="SELECT pd.id_barang,
                                     jb.nama,
                                     w.warna,
                                     pd.harga,
                                     pd.qty,
                                     pd.amount,
                                   pd.disc
                              FROM pesan_detail AS pd LEFT JOIN jenis_barang AS jb ON (SUBSTRING(pd.id_barang,1,7)=jb.kode_jenis)
                                                      LEFT JOIN warna AS w ON (SUBSTRING(pd.id_barang,13,3)=w.kode_warna)
                              where pd.no_transaksi='$no_transaksi' ";
                                $query=mysqli_query($connect, $sql)or die($sql);
                                
                                
                                
                                
                                
                                while(list($id,$nama,$warna,$harga,$qty,$amount,$disc)=mysqli_fetch_array($query))
                                {  
                                  $no++;
                                  $persentase_disc=(($disc/($harga*$qty))*100);
                                    $sub_total=$amount-$disc;
                                  ?>
                                  <tr height="25">
                                  <td><?php echo $no?></td>
                                  <td><?php echo $id?></td>
                                  <td><?php echo $nama?></td>
                                  <td align="center"><?php echo $warna?></td>
                                  <td align="right"><?php echo number_format("$harga",0,".",",");?></td>
                                  <td align="center"><?php echo $qty?></td>
                                  <td align="center"><?php echo $persentase_disc.' %'; ?></td>
                                  <td align="right"><?php echo number_format("$sub_total",0,".",",");?></td>
                                  </tr>
                                  <?php
                                  
                                }
                                $sql="select jmlproduk,amount,ongkos,biaya_seluruh,jenis_bayar from pesan where no_transaksi='$no_transaksi'";
                                $query=mysqli_query($connect, $sql)or die($sql);
                                list($jumlah_barang,$jumlah_uang,$ongkos,$semua,$pembayaran)=mysqli_fetch_array($query);
                                

                              $qhp="SELECT RIGHT (p.hp,2) 
                              FROM pesan_detail AS pd INNER JOIN jenis_barang AS jb ON (SUBSTRING(pd.id_barang,1,7)=jb.kode_jenis)
                                                      INNER JOIN warna AS w ON (SUBSTRING(pd.id_barang,13,3)=w.kode_warna)
                                                INNER JOIN pengiriman AS p ON (p.no_transaksi=pd.no_transaksi)
                                                      INNER JOIN member AS m ON (m.email=p.email) 
                              WHERE pd.no_transaksi='$no_transaksi'";
                              $query_hp=mysqli_query($connect, $qhp) or die ($qhp);
                              list($hp)=mysqli_fetch_array($query_hp);

                              $totaltransfer=$semua+$hp;
                                ?>
                                <tr bgcolor="#999999">
                                    <td colspan="6"><span class="style12 style3"><strong>Total belanja</strong></span></td>
                                  <td align="center"><span class="style12 style3"><strong><?php echo $jumlah_barang?></strong></span></td>
                                  <td align="right"><span class="style12 style3"><strong><?php echo number_format("$jumlah_uang",0,".",",");?></strong></span></td>
                                  </tr>
                                <tr bgcolor="#999999">
                                  <td colspan="7"><span class="style12 style3"><strong>Ongkos</strong></span></td>
                                  <td align="right"><span class="style12 style3"><strong><?php echo number_format("$ongkos",0,".",",");?></strong></span></td>
                                </tr>
                                <tr bgcolor="#999999">
                                  <td colspan="7"><span class="style12 style3"><strong>Total Bayar</strong></span></td>
                                  <td align="right"><span class="style12 style3"><strong><?php echo number_format("$semua",0,".",",");?></strong></span></td>
                                </tr>
                                <tr bgcolor="#999999">
                                  <td colspan="7"><span class="style12 style3"><em><strong>Total Transfer</strong></em></span></td>
                                  <td align="right"><span class="style12 style3"><strong><?php echo number_format("$totaltransfer",0,".",",");?></strong></span></td>
                                </tr>
                                </table>

                              <?php } ?>

                              <?php if($_POST[resi_insert])
                              {
                                $no_transaksi=$_GET['no_transaksi'];
                              $message="<strong>http://www.banibatuta.co.id</strong> <br>
                              =================================================================<br>
                              ";
                              $sql="SELECT pengiriman.no_transaksi,
                                 layanan_pengiriman.nama_layanan, 
                                 jenis_layanan.nama_jenis 
                              FROM pengiriman INNER JOIN jenis_layanan ON (pengiriman.kode_jenis = jenis_layanan.kode_jenis) 
                                              INNER JOIN layanan_pengiriman ON (pengiriman.kode_layanan = layanan_pengiriman.kode_layanan) 
                              WHERE no_transaksi='$_GET[no_transaksi]'";
                                  $query=mysqli_query($connect, $sql)or die($sql);
                                  list($transaksi,$layanan,$jenis)=mysqli_fetch_array($query);
                                  

                              $message="<b>Banibatuta Online shop</b><br>";
                              $message=$message."No Transaksi anda : $transaksi<br>
                              Layanan yang di gunakan :$layanan<br>
                              Jenis Layanan yang di gunakan:$jenis
                              <br><br>
                              <b>No Resi Anda :$_POST[resi]</b>";


                              $headers = "info@banibatuta.co.id";
                              $headers .= "Reply-to: batuta.rabbani@gmail.com.sg\r\n";
                              $headers .= "MIME-Version: 1.0\r\n";
                              $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
                              $kirim = @mail("$email", "No Resi Pengiriman https://www.banibatuta.co.id", $message, $headers);

                              $sql="update pengiriman set no_resi='$_POST[resi]' where no_transaksi='$no_transaksi'";
                              $query=mysqli_query($connect, $sql)or die($sql);
                              //echo $sql;
                                     echo"<script>alert('No Resi berhasil dikirim ke email pemesan');</script>";
                                   echo"<script>document.location=\"?menu=modul_detailbayar&no_transaksi=$no_transaksi\";</script>";
                              }?>

                        </div>
                    </div>
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
            
            
