     <!-- BEGIN CONTENT -->
      <?php
        if ($_POST['temp_no']!=''){
              $no_pb=$_POST['temp_no'];
          } else {
              $no_pb=$_GET['no_transaksi'];
          }
      ?>
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
                                <a href="#">Order </a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                                <span><strong>ID PEMBAYARAN : <?php echo $no_pb; ?></strong></span>
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
                         <?php   
                         //MAIN QUERY
                         $main="select no_transaksi from pesan where id_pesan_bayar='$no_pb'";
                         $qmain=mysqli_query($connect, $main);
                         while(list($no_transaksi)=mysqli_fetch_array($qmain))
                         { 


                                if($_POST[simpan])
                                {
                                     $sql="update pesan set kode_track='$_POST[status]' where no_transaksi='$no_transaksi'";
                                   
                                     $query=mysqli_query($connect, $sql) or die ($sql);
                                  
                                   echo"<script>alert('Tracking berhasil dirubah');
                                           document.location=\"approve.php\";
                                         </script>";
                                }
                                    $sql="SELECT pn.nama,pn.alamat,kc.nama,k.nama_kota,pn.kodepos,p.nama_provinsi,pn.hp,lp.nama_layanan, 
                                          jl.nama_layanan, pn.no_resi
                                              FROM layanan_pengiriman AS lp LEFT JOIN pengiriman AS pn ON (lp.kode_layanan = pn.kode_layanan)
                                                                            LEFT JOIN kurir_layanan AS jl ON (jl.id = pn.kode_jenis)
                                                                            LEFT JOIN kota AS k ON (k.kode_kota = pn.kode_kota)
                                                                            LEFT JOIN provinsi AS p ON (p.kode_provinsi = pn.kode_provinsi)
                                                                            LEFT JOIN kecamatan AS kc ON (kc.kode_kecamatan = pn.kode_kecamatan) 
                                                      where no_transaksi='$no_transaksi'";
                                    // echo $sql;                  
                                    $query=mysqli_query($connect, $sql);
                                    list($nama,$alamat,$kec,$kota,$kodepos,$prov,$hp,$kurir,$jenislayananjne,$resi)=mysqli_fetch_array($query);

                                        $s="SELECT p.kode_track,p.jenis_bayar,p.status,b.nama_bank,c.id_level,m.email,c.id,c.nama, p.id_pesan_bayar, o.nama,o.alamat,k.nama_kota,pv.nama_provinsi, pk.keterangan  
                                            FROM pesan AS p  LEFT JOIN bank AS b ON (p.kode_bank=b.id_bank)
                                                             LEFT JOIN member AS m ON (m.email=p.email)                               
                                                             LEFT JOIN customer AS c ON (p.id_customer=c.id)  
                                                             LEFT JOIN pesan_keterangan as pk on (pk.no_transaksi=p.no_transaksi) 
                                                             INNER JOIN outlet as o on (o.id=p.id_outlet)
                                                             INNER JOIN kota as k on (k.kode_kota=o.kota)
                                                             INNER JOIN provinsi as pv on (pv.kode_provinsi=o.provinsi)       
                                            where p.no_transaksi='$no_transaksi'";
                                        $q=mysqli_query($connect, $s)or die($s);
                                    //echo $s;
                                        list($tracking,$pembayaran,$approve,$namabank,$id_level,$emailcek,$idcek,$namacek,$pesanbayar,$namaoutlet,$alamatoutlet,$kotaoutlet,$provinsioutlet,$keterangan_pesan)=mysqli_fetch_array($q);
                                    
                                    $p="SELECT m.nama, m.alamat, kc.nama, k.nama_kota, m.kodepos, p.nama_provinsi, m.hp, m.id_customer
                                            FROM kecamatan AS kc INNER JOIN member AS m ON (kc.kode_kecamatan = m.kode_kecamatan)
                                                                 INNER JOIN provinsi AS p ON (p.kode_provinsi = m.kode_provinsi)
                                                                 INNER JOIN kota AS k ON (k.kode_kota = m.kode_kota)
                                        WHERE m.email='$emailcek'";
                                     $qp=mysqli_query($connect, $p)or die($p); 
                                     //echo $p;
                                         list($nama_p,$alamat_p,$kec_p,$kota_p,$kodepos_p,$prov_p,$hp_p,$idcust)=mysqli_fetch_array($qp);
                                  
                                ?>  

                                <script>
                                 function cetak_dropship(kode,idlevel){
                                   if (idlevel=='DBN'){
                                   var url="cetakpengiriman_dropship.php";      
                                   } else {
                                   var url="cetakpengiriman.php"; 
                                   }
                                   
                                   $("#temp_kode").val(kode);
                                   $("#f1").attr("action",url); // mengirim semua variable dalam form melalui method post 
                                   $("#f1").attr("target","_blank");
                                   $("#submit").click();
                                     
                                 }
                                 
                                 function export_exel(){
                                   //alert('test');
                                        $('#f2').attr('action','cetakpengiriman_exel.php');
                                      $('#f2').submit();
                                }


                                </script>

                                <div class="portlet light box green">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-cogs"></i>Order Detail
                                        </div>
                                    </div>
                                </div>
                                  <form id="f2" method="post" style="display:none;">
                                       <input type="hidden" name="notrans" id="notrans" value="<?php echo $no_transaksi?>" />
                                       
                                    </form>
                                    
                                    <div class="row">
                                    <!-- <div style="padding-left:15px;"><h3>Detail Order</h3></div> -->
                                    
                                    <form name="f1" method="post" action="<?php echo $link?>" id="f1" style="display:none;">
                                      <input type="hidden" name="temp_kode" value="<?php echo $no_transaksi?>" />
                                      <input type="submit" id="submit"  />
                                    </form>

                                  <form method="post" action="transaction_detail.php">
                                    <div class="col-sm-4">
                                    <input type="hidden" name="temp_no" value="<?php echo $no_transaksi?>" />
                                      <table class="table table-striped table-bordered table-hover" >
                                      <tr style="background-color:#E2E2E2">
                                        <td><strong>Penerima</strong></td>
                                      </tr>
                                        <tr>
                                           <td><?php echo $nama; ?>
                                               <br /><br />
                                             <?php echo $alamat; ?>
                                               <br />
                                               <?php echo $kec; ?>-<?php echo $kota; ?>&nbsp;<?php echo $kodepos; ?>
                                               <br /> 
                                               <?php echo $prov; ?>
                                               <br /><br />
                                               <?php echo $hp; ?>
                                               </td>
                                      </tr>
                                        <tr>
                                        <td>&nbsp;</td>
                                        </tr>
                                        <tr style="background-color:#E2E2E2">
                                        <td><strong>Pengirim</strong></td>
                                      </tr>
                                        <tr>
                                        <td>
                                            <?php 
                                        
                                        if ($id_level=='DBN'){
                                          
                                           if($emailcek=='admin@banibatuta.co.id'){
                                           
                                           echo $namacek; ?>&nbsp;&nbsp; <strong>(ID dropshipper : <?php echo $idcek;?> )</strong>  
                                             
                                             
                                          <?php  } else {
                                          
                                           echo $nama_p; ?>&nbsp;&nbsp; <strong>(ID dropshipper : <?php echo $idcust;?> )</strong>
                                               <br /><br />
                                             <?php echo $alamat_p; ?>
                                               <br />
                                               <?php echo $kec_p; ?>-<?php echo $kota_p; ?>&nbsp;<?php echo $kodepos_p; ?>
                                               <br /> 
                                               <?php echo $prov_p; ?>
                                               <br /><br />
                                               <?php echo $hp_p; 
                                          }
                                           
                                        } else {
                                           echo"$namaoutlet<br>
                                                $alamatoutlet<br>
                                                $kotaoutlet - $provinsioutlet";                                              

                                        } ?>
                                            </td>
                                        </tr>
                                        <tr>
                                        <td>&nbsp;</td>
                                        </tr>
                                      <tr style="background-color:#E2E2E2">
                                        <td><strong><span>Delivery service</span></strong></td>
                                        </tr>
                                        <tr>    
                                        <td><?php echo $kurir; ?> <?php echo $jenislayananjne; ?></td>
                                      </tr>
                                       
                                      <tr>
                                        <td><span>Nomor AWB/Resi : <strong><?php echo $resi; ?></strong></span></td>
                                      </tr>
                                         <tr>
                                        <td>&nbsp;</td>
                                        </tr>
                                      <tr  style="background-color:#E2E2E2">
                                        <td  ><span   ><strong>Bank trf</strong> : <?php echo $namabank;?></span></td>
                                        
                                        
                                      </tr>
                                      
                                      
                                        <tr>
                                        <td  ><strong><span>Status Kiriman</span></strong>
                                        
                                        <?php if($tracking!=3)
                                            {                    
                                                ?>
                                            <select name="status">
                                              <?php if($tracking==1) // jika tracking dipersiapkan 
                                                  {?>
                                                  <option value="1" <?php if($tracking==1){?> selected<?php }?>>Dipersiapkan</option>
                                                  <option value="4" <?php if($tracking==4){?> selected<?php }?>>Siap kirim</option>
                                              <?php 
                                                  }
                                                  else if($tracking==4) // jika tracking siapkirim
                                                  { ?> 
                                                  <option value="4" <?php if($tracking==4){?> selected<?php }?>>Siap kirim</option>
                                              <option value="2" <?php if($tracking==2){?> selected<?php }?>>Perjalanan</option>
                                                  <option value="3" <?php if($tracking==3){?> selected<?php }?>>Diterima</option> 
                                            <?php 
                                                  } else if ($tracking==2) // jika tracking diperjalanan
                                            {?> 
                                                      <option value="2" <?php if($tracking==2){?> selected<?php }?>>Perjalanan</option>
                                                  <option value="3" <?php if($tracking==3){?> selected<?php }?>>Diterima</option>
                                             <?php }  else {?>
                                                <option value="">Belum Approve</option>
                                            <?php }
                                            }
                                        else{
                                        $isi="DIterima";
                                        }?>
                                          </select>
                                        </span> <span class="style12"><?php echo $isi?></span></td>
                                      </tr>  
                                      </table>
                                    <p>&nbsp;</p>
                                    </div>
                                    
                                  <div class="col-sm-8">
                                  <table class="table table-striped table-bordered" >
                                    <tr bgcolor="#999999">
                                        <td colspan="9">No Order : <strong><?php echo $no_transaksi;?></strong> &nbsp;&nbsp;&nbsp; ID Pemesan :<strong><?php echo $emailcek;?></strong><div class="pull-right"> Outlet :<strong><?php echo $namaoutlet;?></strong></div></td>
                                    </tr>
                                  <tr class="judul">
                                        <td height="28">No</td>
                                    <td>Kode Barang</td>
                                        <td>Nama Barang</td>    
                                    <td>Ukuran</td>
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
                                        pd.disc,
                                        u.ukuran,
                                      u.ket2,
                                      u.ket_baru
                                          FROM pesan_detail AS pd LEFT JOIN jenis_barang AS jb ON (SUBSTRING(pd.id_barang,1,7)=jb.kode_jenis)
                                                                  LEFT JOIN warna AS w ON (SUBSTRING(pd.id_barang,13,3)=w.kode_warna)
                                                      LEFT JOIN ukuran as u on (SUBSTRING(pd.id_barang,8,2)=u.kode_ukuran)
                                          where pd.no_transaksi='$no_transaksi' ";
                                  $query=mysqli_query($connect, $sql)or die($sql);
                                  
                                  while(list($id,$nama,$warna,$harga,$qty,$amount,$disc,$ukuran,$ketlama,$ketbaru)=mysqli_fetch_array($query))
                                  {  
                                    $no++;
                                    $persentase_disc=(($disc/($harga*$qty))*100);
                                      $sub_total=$amount-$disc;
                                    
                                    $jenisproduk=substr("$id",3,1);
                                    if ($jenisproduk>=7){
                                        $ukuran_text=$ketbaru;  
                                     } else {
                                        $ukuran_text=$ketlama;  
                                     } 
                                    ?>
                                    <tr height="25">
                                    <td><?php echo $no?></td>
                                    <td><?php echo $id?></td>
                                    <td><?php echo $nama?></td>
                                        <td><?php echo $ukuran_text?></td>
                                    <td align="center"><?php echo $warna?></td>
                                    <td align="right"><?php echo number_format("$harga",0,",",".");?></td>
                                    <td align="center"><?php echo $qty?></td>
                                    <td align="center"><?php echo $persentase_disc.' %'; ?></td>
                                    <td align="right"><?php echo number_format("$sub_total",0,",",".");?></td>
                                    </tr>
                                    <?php
                                  }
                                  $sql="select jmlproduk,amount,ongkos,biaya_seluruh,jenis_bayar,voucher from pesan where no_transaksi='$no_transaksi'";
                                  $query=mysqli_query($connect, $sql)or die($sql);
                                  list($jumlah_barang,$jumlah_uang,$ongkos,$semua,$pembayaran,$voucher)=mysqli_fetch_array($query);
                                  

                                $qhp="SELECT RIGHT (hp,2) FROM pengiriman where no_transaksi='$no_transaksi'";
                                $query_hp=mysqli_query($connect, $qhp) or die ($qhp);
                                list($hp)=mysqli_fetch_array($query_hp);

                                $totaltransfer=($semua+$hp)-$voucher;
                                  ?>
                                  
                                  <tr bgcolor="#999999">
                                      <td colspan="8"><span class="style12 style3"><strong>Total belanja</strong></span></td>
                                    <td align="right"><span class="style12 style3"><strong><?php echo number_format("$jumlah_uang",0,".",",");?></strong></span></td>
                                    </tr>
                                   <tr bgcolor="#999999">
                                    <td colspan="2"><span class="style12 style3"><strong>Keterangan tambahan</strong></span></td>
                                    <td colspan="7"><span class="style12 style3"><?php echo $keterangan_pesan;?></span></td>
                                  </tr>  
                                  <tr bgcolor="#999999">
                                    <td colspan="8"><span class="style12 style3"><strong>Ongkos</strong></span></td>
                                    <td align="right"><span class="style12 style3"><strong><?php echo number_format("$ongkos",0,".",",");?></strong></span></td>
                                  </tr>
                                  <tr bgcolor="#999999">
                                    <td colspan="8"><span class="style12 style3"><strong>Total Bayar</strong></span></td>
                                    <td align="right"><span class="style12 style3"><strong><?php echo number_format("$semua",0,".",",");?></strong></span></td>  
                                  </tr>
                                    <tr bgcolor="#999999">
                                    <td colspan="8"><span class="style12 style3"><strong>Voucher / potongan promo</strong></span></td>
                                    <td align="right"><span class="style12 style3"><strong>-<?php echo number_format("$voucher",0,".",",");?></strong></span></td>
                                  </tr>
                                  <?php 
                                  //cek jika transfer ke rekber (1 konsumen beli dari beberapa outlet)
                                  $ber="select use_rekber from pesan_bayar where id_bayar='$pesanbayar'";
                                  $qber=mysqli_query($connect, $ber);
                                  list($use_rekber)=mysqli_fetch_array($qber);
                                  // echo"rekber : $use_rekber";
                                  if ($use_rekber==0){
                                  ?>
                                  <tr bgcolor="#999999">
                                    <td colspan="8"><span class="style12 style3"><em><strong>Total Transfer</strong></em></span></td>
                                    <td align="right"><span class="style12 style3"><strong><?php echo number_format("$totaltransfer",0,".",",");?></strong></span></td>
                                  </tr>
                                  <?php } ?>
                                  </table>
                                    
                                   <!--  <div >

                                  
                                  <?php 
                                  if ($id_level=='DBN'){
                                  ?>
                                        <input type="button" name="cetak" value="Print dropship" onclick="cetak_dropship('<?php echo $no_transaksi;?>','<?php echo $id_level?>')"  >
                                        
                                  <?php } else {?>
                                        <input type="button" name="cetak" value="Print" onclick="cetak_dropship('<?php echo $no_transaksi;?>','<?php echo $id_level?>')"  >&nbsp;&nbsp;
                                        <input type="button" name="cetak" value="Export Excel" onclick="export_exel()"  >
                                    <?php }
                                  
                                  if($tracking!=3){
                                  
                                  ?>
                                  <input type="submit" name="simpan" value="Simpan" ><?php 
                                  }?>
                                  <input type="button" name="kembali" value="Kembali" onClick="self.history.back();" ></div> -->
                                    
                                    </div>
                                    </form>  

                                    </div>
                             <?php 
                             $total_semua+=$semua;

                           } 
                           $total_all=$total_semua+$hp// end main query ?>       
                                <div class="portlet light box green">
                                    <div class="portlet-title">
                                       
                                          
                                               <div class="pull-right">&nbsp;<div class="caption"><b>TOTAL TRANSFER + kode unik : &nbsp;&nbsp;&nbsp;<?php echo number_format("$total_all",0,".",",");?>&nbsp;&nbsp;&nbsp;</b></div></div>

                                         
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
            
            
