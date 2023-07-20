<?php 
include("connect.php");
$date=date('Y-m-d');
$outlet=$_GET['outlet'];
                                      $dataPerPage = 25;
                                             if(isset($_GET['page'])) 
                                             {
                                                $noPage = $_GET['page'];
                                             } 
                                               else $noPage = 1;
                                             $offset = ($noPage - 1) * $dataPerPage;
                                      
                                      $sql="SELECT s.tgl,m.id_barang, j.nama,u.ukuran,w.warna, m.harga,m.stok,(m.harga*m.stok) 
                                                        FROM master_barang AS m LEFT JOIN jenis_barang AS j ON (j.kode_jenis=m.kode_jenis)  
                                                                                LEFT JOIN ukuran AS u ON u.kode_ukuran=m.kode_ukuran
                                                                                LEFT JOIN warna AS w ON (w.kode_warna=m.kode_warna)
                                                                                LEFT JOIN stock_in AS s ON (s.barcode=m.id_barang)
                                                         WHERE s.tgl='$date' AND m.status=1 and m.id_outlet='$outlet' ORDER BY s.tgl2 DESC limit $offset,$dataPerPage";
                                      $query=mysqli_query($connect, $sql) or die ($sql);
                                      
                                      // echo $sql;
                                     // untuk pagging hitung jumlah data di tabel reshare
                                            $count    = "SELECT COUNT(id_barang) AS jumData FROM master_barang WHERE status=1 
                                                         and id_outlet='$outlet'";
                                            $hasil    = mysqli_query($connect, $count) or die ($count);
                                            $data     = mysqli_fetch_array($hasil);
                                            $jumData  = $data['jumData'];
                                            $jumPage = ceil($jumData/$dataPerPage); 
                                            
                                            
                                    $qtotal="select sum(harga*stok),sum(stok) from master_barang where status=1 and id_outlet='$outlet' and updatedate LIKE '%$date%'";
                                    $querytotal=mysqli_query($connect, $qtotal) or die ($qtotal);
                                    list($totalharga,$totalqty)=mysqli_fetch_array($querytotal);     

                                    ?>
                                    <table class="table table-responsive table-bordered table-striped" style="width:80%;">
                                      <tr>
                                        <td>No</td>
                                        <td>Tanggal</td>
                                        <td>Barcode</td>
                                        <td>Nama</td>
                                        <td>Ukuran</td>
                                        <td>Warna</td>
                                        <td>Harga</td>
                                        <td>Stok</td>
                                        <td>Subtotal</td>
                                      </tr>
                                      <?php 
                                      $no=$offset;
                                      $totharga=0;
                                      $totstok=0;
                                      $total_all=0;
                                      while(list($tgl,$barcode,$nama,$size,$warna,$harga,$stok,$subtotal)=mysqli_fetch_array($query)){   
                                      $no++;    
                                      ?>
                                      <tr class="text-edit" style="height:25">
                                        <td><?php echo $no;?></td>
                                        <td id="tbarcode"><?php echo $tgl;?></td>
                                        <td id="tbarcode"><?php echo $barcode;?></td>
                                        <td id="tnama"><?php echo $nama;?></td>
                                        <td id="tsize"><?php echo $size;?></td>
                                        <td id="twarna">&nbsp;<?php echo $warna;?></td>
                                        <td id="tharga" align="right"><?php echo number_format("$harga",2,",",".");?></td>
                                        <td id="tstok_<?php echo $no;?>"  align="right"  
                                        ondblclick="tampil_edit('<?php echo $barcode?>','<?php echo $no;?>','<?php echo $stok;?>','<?php echo $tgl;?>')">
                                        <?php echo $stok;?></td>
                                        <td id="tsubtotal"  align="right"><?php echo number_format("$subtotal",2,",",".");?></td>
                                      </tr>
                                      
                                      <?php
                                      $totharga+=$harga;
                                      $totstok+=$stok;
                                      $total_all+=$subtotal;
                                      
                                       } ?>
                                      <tr>
                                         <td colspan="7"><em><strong>Total Perhalaman</strong></em></td>
                                         <td align="right"><strong><?php echo $totstok;?></strong></td>
                                         <td align="right"><strong><?php 
                                         if ($total_all!=''){
                                         echo number_format("$total_all",2,",",".");
                                         }
                                         ?></strong></td>
                                         
                                      </tr>
                                      <tr>
                                         <td colspan="7"><em><strong>Total </strong></em></td>
                                         <td align="right"><strong><?php echo $totalqty;?></strong></td>
                                         <td align="right"><strong><?php
                                           if ($totalharga!=''){
                                          echo number_format("$totalharga",2,",",".");
                                          }
                                          ?></strong></td> 
                                      
                                      </tr>
                                    </table>
                                    <br />
                                    <?php 
                                    echo"<div align=center>";
                                            if ($noPage > 1) echo "<a href='".$_SERVER['PHP_SELF']."?menu=master_tambah&page=".($noPage-1)."' class=linkpage onclick='pindah()'>
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
                                                else echo " <font size=2><a href='".$_SERVER['PHP_SELF']."?menu=master_tambah&page=".$page."' class=linkpage onclick='pindah()'>".$page."&nbsp;</a> ";
                                                $showPage = $page;          
                                             }
                                           }
                                          // menampilkan link next

                                         if ($noPage < $jumPage) echo "<a href='".$_SERVER['PHP_SELF']."?menu=master_tambah&page=".($noPage+1)."' 
                                             class=linkpage onclick='pindah()'><font 
                                             size=2 >Next    
                                             </a>&nbsp;";
                                             echo"</div>";
                                    ?>

                                    <form name="formedit" method="post" action="proses.php" enctype="multipart/form-data" id="formID" class="formular">
                                    </form>