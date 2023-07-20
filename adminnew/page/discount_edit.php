<style>
select, .text {
  width: 20%;
  padding: 8px 10px;
  border: 1px solid #e7ecf1;
  border-radius: 4px;
  background-color: #fff;
}

</style>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
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
                        <?php $sql="SELECT td.id,td.start,td.end,td.status,tdd.barcode, tdd.persen_diskon, tdd.potongan_harga from tbl_disc as td LEFT JOIN tbl_disc_detail as tdd on (td.id=tdd.id_diskon) where td.id='$_GET[kode]'";
                            $query=mysqli_query($connect, $sql)or die($sql);
                            list($kode,$tgl1,$tgl2,$status,$barcode,$persen, $potongan_harga)=mysqli_fetch_array($query);
                            ?>
                        <form name="formedit" method="post" action="proses.php" id="f1">
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
                                <td >Barcode</td>
                                <td width="2">:</td>
                                <td>
                                    <input type="hidden" name="kode_diskon" class="text"  value="<?php echo $kode?>" readonly="true"/>
                                    <input type="text" name="barcode" class="text"  value="<?php echo $barcode?>" readonly="true"/>
                                    <input type="hidden" name="kode_discount_lama" class="text"  value="<?php echo $kode?>"/>
                                </td>
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
                                    <td>Jenis Diskon</td>
                                    <td>:</td>
                                    <td>
                                        <select name="diskon" id="diskon" required>
                                        <?php if($potongan_harga=='0'){?>
                                                <option value="persen_disc" selected="selected">Persen</option>
                                                <option value="potongan_harga">Potongan Harga</option>
                                            <?php } else {?>
                                                <option value="persen_disc">Persen</option>
                                                <option value="potongan_harga" selected="selected">Potongan Harga</option>
                                            <?php }?>
                                        </select>
                                    </td>
                                </tr>
                                <tr class="persen_disc disc">
                                    <td></td>
                                    <td></td>
                                    <td><input type="number" name="persen_disc" class="text" placeholder="%" max="100" min="0" value="<?php echo $persen ?>"/></td>
                                </tr>  
                                <tr class="potongan_harga disc">
                                    <td></td>
                                    <td></td>
                                    <td><input type="text" name="potongan_harga" class="text" placeholder="Rp. " value="<?php echo $potongan_harga ?>"/></td>
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
                                <td><input type="submit" name="editdiscount" value="Edit discount" class="btn btn-success"  /><input type="button" name="kembali" value="Kembali" class="btn btn-secondary" onclick="window.history.go(-1); return false;" /></td> 
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
    
    
    $(document).ready(function(){
        var persen_disc = $('input[name="persen_disc"]').val();
        var potongan_harga = $('input[name="potongan_harga"]').val();
        if (persen_disc==0) {
            $(".persen_disc").hide();
        }else if(potongan_harga==0){
            $(".potongan_harga").hide();
        }
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
<!-- END CONTENT -->
<!-- BEGIN QUICK SIDEBAR -->
           