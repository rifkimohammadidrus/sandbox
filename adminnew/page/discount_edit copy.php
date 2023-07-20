
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
                                <span>Setting Discount </span>
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
                                        <i class="fa fa-cogs"></i>Setting Diskon</div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                        <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                                        <a href="javascript:;" class="reload"> </a>
                                       <!-- <a href="javascript:;" class="remove"> </a> -->
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <?php $sql="select id,disc_value,start,end,status from tbl_disc where id='$_GET[kode]'";
                                        $query=mysqli_query($connect, $sql)or die($sql);
                                        list($kode,$value,$tgl1,$tgl2,$status)=mysqli_fetch_array($query);
                                        ?><form name="formedit" method="post" action="proses.php" id="f1">
                                        <table border="0" class="table table-responsive table-bordered">
                                        <tr class="judul">
                                            <td colspan="3" height="30">Form Edit diskon</td>
                                        </tr>
                                        <tr>
                                            <td height="5"></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr class="text-edit">
                                            <td >Id</td>
                                            <td width="2">:</td>
                                            <td><input type="text" name="kode_discount" class="text"  value="<?php echo $kode?>" readonly="true"/>
                                            <input type="hidden" name="kode_discount_lama" class="text"  value="<?php echo $kode?>"/>
                                            </td>
                                        </tr>
                                        <tr class="text-edit">
                                            <td>Nilai Discount</td>
                                            <td>:</td>
                                            <td><input type="text" name="discvalue" class="text" value="<?php echo $value?>"  /></td>
                                        </tr>
                                        <tr>
                                            <td height="5">Periode Discount</td>
                                            <td>:</td>
                                            <td><script language="JavaScript" src="../calendar_us.js"></script>
                                                            <link rel="stylesheet" href="../calendar.css">
                                                <input type="text" id="tgl1" name="tgl1" value="<?php echo $tgl1;?>"  class="text"/>
                                                  <script language="JavaScript">
                                                      new tcal ({
                                                        // form name
                                                        'formname': 'f1',
                                                        // input name
                                                        'controlname': 'tgl1'
                                                      });
                                                    </script>
                                                     Sampai 
                                                     <input type="text" name="tgl2" id="tgl2" value="<?php echo $tgl2;?>" class="text"/>
                                                      <script language="JavaScript">
                                                      new tcal ({
                                                        // form name
                                                        'formname': 'f1',
                                                        // input name
                                                        'controlname': 'tgl2'
                                                      });
                                                    </script></td>
                                        </tr>
                                        <tr>
                                          <td>Kategori Produk</td>
                                          <td>:</td>
                                          <td>
                                            <?php 
                                            $q="SELECT kode_kategori,nama_kategori FROM kategori where status=1";
                                            $qq=mysqli_query($connect, $q) or die ('salah query select'); ?>
                                             <select name="item_disc">
                                               <option value="ALL">--All--</option>
                                               <?php 
                                               while(list($kode_kat,$nama_kat)=mysqli_fetch_array($qq)){
                                               ?>
                                               <option value="<?php echo $kode_kat?>"><?php echo $nama_kat; ?></option>
                                               <?php } ?>
                                             </select>
                                          </td>
                                        </tr>
                                        <tr>
                                           <td>Status</td>
                                           <td>:</td>
                                           <td>
                                                <select name="status">
                                                <?php if($status=='1'){?>
                                                   <option value="1" selected="selected">Aktif</option>
                                                   <option value="0">Tidak Aktif</option>
                                                <?php } else {?>
                                                    <option value="0" selected="selected">Tidak Aktif</option>
                                                   <option value="1">Aktif</option>
                                                <?php }?>
                                                </select>
                                           </td>
                                        </tr>
                                        <tr>
                                            <td height="5"></td>
                                            <td></td>
                                            <td><input type="submit" name="editdiscount" value="Edit discount" class="button"  /><input type="button" name="kembali" value="Kembali" class="button" onclick="sendRequest('kategori.php','isi')" /></td> 
                                        </tr>
                                        <? if(isset($_GET['berhasil'])){
                                        ?>
                                        <tr>
                                            <td height="10"></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <?
                                        }?>
                                        <tr class="text-edit">
                                            <td height="5" colspan="3" class="sisi" ><?php if(isset($_GET['berhasil'])){
                                            echo"<blink><font color='red'>Ubah Data Berhasil</font></blink>, klik kembali untuk melihat hasil perubahan";
                                            }?></td>
                                        </tr>
                                        </table>
                                        </form>
                                
                                
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
            
            </script>
            <!-- END CONTENT -->
            <!-- BEGIN QUICK SIDEBAR -->
           