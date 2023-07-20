<?php
$tglskg=date('Y-m-d');
  $tgl1=$tglskg;
  $tgl2=$tglskg;

  
if(isset($_GET['transno']))
{
  $transno=$_GET['transno'];
}
?>
<!-- <script src="jquery-1.4.js" type="text/javascript"></script> -->

<!-- <script src="jquery-1.4.js" type="text/javascript"></script> -->

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
                                <span>Report Selling Detail berdasarkan tanggal Approve</span>
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
                                        <i class="fa fa-cogs"></i>Report Selling Detail berdasarkan tanggal Approve</div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                        <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                                        <a href="javascript:;" class="reload"> </a>
                                       <!-- <a href="javascript:;" class="remove"> </a> -->
                                    </div>
                                </div>
                                <div class="portlet-body">
                                  <form name="f1" method="post" action="<?php echo $link?>" id="f1">
                                  <!-- <input type="text" id="test" /> -->
                                    <input type="hidden" name="transno" value="<?php echo $transno?>" />
                                    <input type="button" value="export to excel" onclick="export_exel()" />


                                  <table class="table table-responsive table-bordered">
                                  <tr class="bg-success">
                                    <td align="left" height="25"><strong>Item Code</strong></td>
                                    <td align="left" ><strong>Item Name</strong></td>
                                    <td align="left" ><strong>Vrnt Cd</strong></td>
                                      <td align="left" ><strong>Unit Price</strong></td>
                                      <td align="left" ><strong>Qty</strong></td>
                                      <td align="left" ><strong>Disc</strong></td>
                                      <td align="left" ><strong>Sub Total</strong></td>
                                      <td align="left" ><strong>POLY_BAG</strong></td>
                                      <td align="left" ><strong>POIN</strong></td>
                                      <td align="left" ><strong>A</strong></td>
                                      <td align="left" ><strong>B</strong></td>
                                      <td align="left" ><strong>C</strong></td>
                                    <td align="left" ><strong>D</strong></td>
                                  </tr>
                                 
                                  <?php 

                                  $sql="SELECT SUBSTRING(pd.id_barang,1,12) AS itemcode, jb.nama,RIGHT(pd.id_barang,3) AS variant,pd.harga,pd.qty,pd.disc,pd.amount 
                                  FROM pesan_detail AS pd LEFT JOIN pesan AS p ON (p.no_transaksi=pd.no_transaksi)
                                                          LEFT JOIN jenis_barang AS jb ON (jb.kode_jenis=SUBSTRING(pd.id_barang,1,7))
                                  WHERE p.no_transaksi='$transno' "; 

                                  //echo $sql;
                                  $query=mysqli_query($connect, $sql)or die($sql);
                                  while (list($itemcode,$nama,$variant,$harga,$qty,$disc,$subtotal)=mysqli_fetch_array($query)){
                                  if ($disc==''){
                                  $disc=0;
                                  }

                                  $persentase_diskon=($disc/$subtotal*100);
                                  $tot_subtotal=$subtotal-$disc;
                                      ?>   
                                  <tr>
                                    <td><?php echo  $itemcode; ?></td>
                                    <td><?php echo  $nama; ?></td>
                                    <td><?php echo  $variant; ?></td>
                                      <td align="right"><?php echo  $harga; ?></td>
                                      <td align="right"><?php echo  $qty; ?></td>
                                      <td align="right"><?php echo  $persentase_diskon; ?></td>
                                      <td align="right"><?php echo  number_format("$tot_subtotal",0,",","."); ?></td>
                                      <td align="right"><?php echo  "0";?></td>
                                      <td align="right"><?php echo  "0"; ?></td>
                                      <td><?php echo  "-1";?></td>
                                      <td><?php echo  "0"; ?></td>
                                      <td><?php echo  "0"; ?></td>
                                    <td><?php echo  "0"; ?></td>
                                     </tr>
                                  <?php 
                                  $tot_qty+=$qty;
                                  $total_subtotal+=$tot_subtotal;

                                  }?>
                                  <tr class="bg-success">
                                    <td colspan="4"><strong>Total</strong></td>
                                    <td align="right"><?php echo $tot_qty; ?></td>
                                    <td>&nbsp;</td>
                                    <td align="right"><?php echo number_format("$total_subtotal",0,",",".");?></td>
                                    <td colspan="6">&nbsp;</td>
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
            <script>
            function export_exel(){
            //alert('oke');
            //$("#test").val("okeeeeee");
                    $('#f1').attr('action','export_sales_detail.php');
                  /*$('#f1').attr('target','_blank');*/
                  $('#f1').submit();
            }
            </script>
            
            
            <!-- END CONTENT -->
            <!-- BEGIN QUICK SIDEBAR -->
           