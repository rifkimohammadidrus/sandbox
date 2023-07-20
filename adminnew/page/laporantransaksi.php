<?php
$tglawal=date('Y-m-01');
$tglskg=date('Y-m-d');
  $tgl1=$tglawal;
  $tgl2=$tglskg;

  
if(isset($_POST['start']))
{
  $tgl1=$_POST['tgl1'];
  $tgl2=$_POST['tgl2'];
}
?>
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
                                  <table class="table table-responsive table-stripe table-bordered" style="width:60%;font-size: 12px;">
                                    <tr class="second-header">
                                      <td>Tanggal</td>
                                      <td>:</td>
                                      <td><script language="JavaScript" src="../calendar_us.js"></script>
                                                      <link rel="stylesheet" href="../calendar.css">
                                        <input type="text" id="tgl1" name="tgl1" value="<?php echo $tgl1;?>" style="color:#000;" />
                                          <script language="JavaScript">
                                                new tcal ({
                                                  // form name
                                                  'formname': 'f1',
                                                  // input name
                                                  'controlname': 'tgl1'
                                                });
                                              </script>
                                         Sampai 
                                         <input type="text" name="tgl2" id="tgl2" value="<?php echo $tgl2;?>" style="color:#000;" />
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
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td><input type="submit" name="start" value="proses" /></td>
                                    
                                    </tr>
                                  </table>
                                  <br />
                                  <br />
                                  <?php 
                                  $sql="SELECT no_transaksi,tanggal pesan,status,jmlproduk,amount,disc,biaya_seluruh,ongkos,approve_date FROM pesan
                                      where approve_date between '$tgl1 00:00:00' and '$tgl2 23:59:59' and jenis_bayar>=1 and status=2 and delay=0
                                      and no_transaksi not like '%BTL%' and id_outlet='$_SESSION[id_outlet]'";
                                  $query=mysqli_query($connect, $sql) or die ($sql);
                                  ?>
                                  <table class="table table-responsive table-bordered" style="font-size: 12px;">
                                    <tr class="bg-success">
                                      <td>No</td>
                                      <td>No Transaksi</td>
                                      <td>Tanggal</td>
                                      <td>qty</td>
                                      <td>Subtotal</td>
                                      <td>Disc</td>
                                      <td>Total</td>
                                      <td>Ongkir</td>
                                      <td>&nbsp;</td>
                                    </tr>
                                    <?php 
                                    $no=0;
                                    while(list($notrans,$tgl,$status,$qty,$subtotal,$disc,$total,$ongkos,$approvedate)=mysqli_fetch_array($query)){
                                    $no++;
                                    ?>
                                    <tr>
                                      <td><?php echo $no;?></td>
                                      <td><?php echo $notrans;?></td>
                                      <td><?php echo $tgl?></td>
                                      <td><?php echo $qty;?></td>
                                      <td align="right"><?php echo number_format("$subtotal",0,",",",");?></td>
                                      <td align="right"><?php echo number_format("$disc",0,",",",");?></td>
                                      <td align="right"><?php echo number_format("$total",0,",",",");?></td>
                                      <td align="right"><?php echo number_format("$ongkos",0,",",",");?></td>
                                      <td><a href="index.php?menu=laporantransaksidetail&transno=<?php echo $notrans ?>">Detail</a></td>
                                    </tr>
                                    <?php 
                                    $t_subtotal+=$subtotal;
                                    $t_disc+=$disc;
                                    $t_total+=$total;
                                    $t_ongkos+=$ongkos;
                                    } ?>
                                     <tr  class="bg-success">
                                      <td colspan="4"></td>
                                      <td align="right"><strong><?php echo number_format("$t_subtotal",0,",",",");?></strong></td>
                                      <td align="right"><strong><?php echo number_format("$t_disc",0,",",",");?></strong></td>
                                      <td align="right"><strong><?php echo number_format("$t_total",0,",",",");?></strong></td>
                                      <td align="right"><strong><?php echo number_format("$t_ongkos",0,",",",");?></strong></td>
                                      <td>&nbsp;</td>
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
                  $('#f1').attr('target','_blank');
                  $('#f1').submit();
            }
            </script>
            
            
            <!-- END CONTENT -->
            <!-- BEGIN QUICK SIDEBAR -->
           