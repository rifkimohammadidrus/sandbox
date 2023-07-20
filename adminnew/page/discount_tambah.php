
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<style>
        select, .text {
  width: 20%;
  padding: 8px 10px;
  border: 1px solid #e7ecf1;
  border-radius: 4px;
  background-color: #fff;
}

.select2-container .select2-selection--single {
    padding-left: 0px;
    padding-bottom: 8px;
    padding-top:8px;
    border: 1px solid #e7ecf1;
    border-radius: 4px;
    background-color: #fff;
    height: 37px !important;
    
}
.select2-results {
  display: block;
  overflow-y: scroll;
  max-height: 200px;
}
/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
    </style>
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
                                    <?php //$sql="select id,start,end,status from tbl_disc where id='$_GET[kode]'";
                                       //$query=mysqli_query($connect, $sql)or die($sql);
                                       //list($kode,$tgl1,$tgl2,$status)=mysqli_fetch_array($query);
                                        ?>

                                        <form name="formtambah" method="post" action="proses.php" id="f1">
                                            <table border="0"   class="table table-responsive table-bordered"bgcolor="#CCCCCC">
                                            <tr class="judul">
                                                <td colspan="3" height="30">Form Tambah Diskon</td>
                                            </tr>
                                            <tr>
                                                <td height="5">Periode Discount</td>
                                                <td>:</td>
                                                <td><script language="JavaScript" src="../calendar_us.js"></script>
                                                    <link rel="stylesheet" href="../calendar.css">
                                                    <input type="text" id="tgl1" name="tgl1"  class="text" required />
                                                      <script language="JavaScript">
                                                          new tcal ({
                                                            // form name
                                                            'formname': 'f1',
                                                            // input name
                                                            'controlname': 'tgl1'
                                                          });
                                                        </script>
                                                         Sampai 
                                                         <input type="text" name="tgl2" id="tgl2" class="text" required />
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
                                            <tr class="text-edit">
                                                <td>Produk</td>
                                                <td>:</td>
                                                <td>
                                                    <?php 
                                                    $id_outlet=$_SESSION['id_outlet'];
                                                    $sql="SELECT SQL_CALC_FOUND_ROWS
                                                    jb.kode_jenis
                                                    ,jb.nama
                                                    FROM jenis_barang as jb 
                                                      INNER JOIN master_barang AS mb ON (jb.kode_jenis = mb.kode_jenis)
                                                      WHERE jb.status=1 and mb.status=1 and  mb.id_outlet='$id_outlet' and jb.kode_jenis NOT IN (SELECT barcode FROM tbl_disc_detail) 
                                                      GROUP BY jb.kode_jenis  HAVING SUM(mb.stok>0)
                                                  ORDER BY jb.nama ASC";
                                                  $query=mysqli_query($connect,$sql);
                                                    ?>
                                                    <select name="barcode" id="barcode" class="barcode" required>
                                                        <option value="">Pilih</option>
                                                        <?php while(list($idb,$nama)=mysqli_fetch_array($query)){ ?>
                                                        <option value="<?php echo $idb; ?>" ><?php echo $nama; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                               <td>Jenis Diskon</td>
                                               <td>:</td>
                                               <td>
                                                    <select name="diskon" id="diskon" required>
                                                        <option value="">Pilih</option>
                                                        <option value="persen_disc" >Persen</option>
                                                        <option value="potongan_harga">Potongan Harga</option>
                                                   
                                                    </select>
                                               </td>
                                            </tr>
                                            <tr class="persen_disc disc">
                                              <td></td>
                                                <td></td>
                                                <td><input type="number" name="persen_disc" class="text" placeholder="%" min='0' max="100"/></td>
                                            </tr>  
                                            <tr class="potongan_harga disc">
                                              <td></td>
                                                <td></td>
                                                <td><input type="text" name="potongan_harga" class="text" placeholder="Rp. "/></td>
                                            </tr>  
                                            <tr>
                                               <td>Status</td>
                                               <td>:</td>
                                               <td>
                                                    <select name="status">
                                                        <option value="1" >Aktif</option>
                                                        <option value="0">Tidak Aktif</option>
                                                   
                                                    </select>
                                               </td>
                                            </tr>
                                            <!-- <tr class="text-edit">
                                                <td>Kode Outlet</td>
                                                <td>:</td>
                                                <td> -->
                                                    <input type="hidden" id="outlet" name="outlet"  value="<?php echo $_SESSION['id_outlet'] ?> " disabled />
                                                    <!-- <textarea name="outlet" cols="50"></textarea><br><font style="font-size: 11px;"><i>* Kode outlet pisahkan dengan tanda ;</i></font> -->
                                                <!-- </td>
                                            </tr> -->
                                            <tr>
                                                <td height="5"></td>
                                                <td></td>
                                                <td><input type="submit" name="tambahdiscount" class="btn btn-success" value="Tambah discount" class="button"  /></td> 
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
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
            
           <script type="text/javascript">
           $(document).ready(function(){
                    
                    $(".barcode").select2();
                }); 
                function pindah(kode){
                                      //alert(kode);
                                      $("#temp_no").val(kode);
                                      $("#f1").attr("action","detail_transaksi.php");// mengirim variable dalam form melalui post
                                      $("#f1").attr("target","");
                                      $("#submit").click();
                                    
                
                }
            	$(document).ready(function(){
                    $(".disc").hide();
                    $("#diskon").change(function(){
                        $(this).find("option:selected").each(function(){
                            var optionValue = $(this).attr("value");
                            if(optionValue){
                                $(".disc").not("." + optionValue).hide().find(':input').attr('required', false);
                                $("." + optionValue).show().find(':input').attr('required', true);
                                // $('.name').show()
                            } else{
                                $(".disc").hide();
                            }
                        });
                    });
                }); 
               
		   
            </script>
           