<?php 
$outlet=$_POST[outlet];
$date=date('Y-m-d');
?>
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
                                <span>Stok produk marketplace rabbani</span>
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
                                        <i class="fa fa-cogs"></i>Entry stok  <?php echo $outlet;?></div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                        <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                                        <a href="javascript:;" class="reload"> </a>
                                       <!-- <a href="javascript:;" class="remove"> </a> -->
                                    </div>
                                </div>
                                <div class="portlet-body">
                                   
                                      <table class="table table-responsive table-bordered" style="width:50%;">
                                        <tr class="judul">
                                          <td colspan="3" height="30">Form tambah stok barang manual</td>
                                        </tr>
                                        
                                         <tr class="text-edit">
                                          <td width="210" class="sisi">Barcode</td>
                                          
                                          <td><input type="text" name="barcode" id="barcode_stok" />
                                              <input type="hidden" id="outlet" value="<?php echo $outlet ?>"></td>
                                         </tr> 
                                          
                                      </table>
                                      <p></p>
                                      <div id="main_table">
                                          <?php 
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
                                    </div>
                                </div>
                            </div>
                 
                        </div>
                    </div>
                </div>
                <!-- END CONTENT BODY -->
            </div>

            <script src="jquery-3.1.1.min.js"></script>
               <script>
                                    $(document).ready(function(){

                                    $("#barcode_stok").focus();
                                         $("#barcode_stok").keydown(function(event){
                                            if(event.keyCode == 13){
                                             var barcode=$.trim($("#barcode_stok").val()); 
                                             var outlet=$.trim($("#outlet").val()); 
                                               // alert(barcode);
                                               $.ajax({
                                                 url:"insert_product.php",
                                                 type:"POST",
                                                 cache: false,
                                                 dataType:'text',
                                                 data:{b:barcode, o:outlet},
                                                 success: function(data) {
                                                 // alert(data);
                                                 if (data=='model kosong'){
                                                   alert('Silahkan Input kode model & upload Foto produk terlebih dahulu !');
                                                   $("#barcode").val('');
                                                 } else if (data=='barcode kosong'){
                                                    alert('Master Produk ini belum masuk ke database !');
                                                    $("#barcode").val('');
                                                 } else {
                                                   var data=data.split("-");
                                                   // $("#tbarcode").text(data[0]);
                                                   // $("#tnama").text(data[1]);
                                                   // $("#tsize").text(data[2]);
                                                   // $("#twarna").html("&nbsp;"+data[3]);
                                                   // $("#tharga").text(data[4]);
                                                   // $("#tstok").text(data[5]);
                                                   // $("#barcode_stok").val(''); 
                                                   //alert(data[0]);
                                                   // location.reload();
                                                   $("#main_table").load("masterproduk_entry_load.php?outlet="+outlet);
                                                   }
                                                 }// END SUCSESS
                                               }); // end ajax
                                           }
                                         });

                                        
                                    });

                                    function tampil_edit(barcode,no,qty,tgl){
                                    //alert(barcode+'-'+no+'-'+qty+'-'+tgl);
                                    $("#tstok_"+no).html("<input type=text id='qty_"+no+"' size=3 value='"+qty+"'>");
                                      $("#qty_"+no).keydown(function(event){ 
                                         if(event.keyCode == 13){
                                         var qty_update=$("#qty_"+no).val();
                                        // alert(qty_update);
                                           $.ajax({
                                                 url:"update_stock.php",
                                                 type:"POST",
                                                 cache: false,
                                                 dataType:'text',
                                                 data:{b:barcode,q:qty_update,t:tgl},
                                                 success: function(data) {
                                                  if (data=='sukses'){
                                                  location.reload();
                                                  }
                                                  }// END SUCSESS
                                               }); // end ajax 
                                         } // end event
                                      }); // end keydown function
                                    }
                </script>
            <!-- END CONTENT -->
            <!-- BEGIN QUICK SIDEBAR -->
           