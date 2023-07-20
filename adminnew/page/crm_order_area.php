<?php 
$time=date('YmdHis');

function jumlahHari($month,$year){
      return date("j", strtotime('-1 second',strtotime('+1 month',strtotime($month.'/01/'.$year.' 00:00:00'))));
}
$jpb=jumlahHari(date('m'),date('Y')); 

$tgl1=date('Y-m-01');
$tgl2=date("Y-m-$jpb");


if($_POST['submit']){

  $tgl1=$_POST['tgl1'];
  $tgl2=$_POST['tgl2'];

  $_SESSION['tgl1']=$tgl1;
  $_SESSION['tgl2']=$tgl2;

}?>
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
                                <span>Order berdasarkan Area</span>
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
                                        <i class="fa fa-cogs"></i>Order berdasarkan Area</div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                        <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                                        <a href="javascript:;" class="reload"> </a>
                                       <!-- <a href="javascript:;" class="remove"> </a> -->
                                    </div>
                                </div>
                                <div class="portlet-body">
                                <form name="f1" method="post" action="?id=<?php echo $time;?>" id="f1" >
                                    <table class="table table-bordered" style="width:60%;">
                                      <tr class="bg-success"><td colspan="2">Filter</td></tr>
                                      <tr><td>Approve Date</td><td>
                                         <script language="JavaScript" src="../calendar_us.js"></script>
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
                                                 &nbsp;To&nbsp;
                                                 <input type="text" name="tgl2" id="tgl2" value="<?php echo $tgl2;?>"/>
                                                  <script language="JavaScript">
                                                  new tcal ({
                                                    // form name
                                                    'formname': 'f1',
                                                    // input name
                                                    'controlname': 'tgl2'
                                                  });
                                                </script>
                                      </td></tr>
                                      <tr><td>&nbsp;</td><td> <input type="submit" name="submit" value="proses" id="submit"/></td></tr>
                                    </table>
                                    </form>
                                    <p>&nbsp;</p>
                                    <table class="table table-responsive table-bordered" style="width:50%;">
                                      <thead>
                                       <tr class="bg-success">
                                        <th>No</th>
                                        <th>Area </th>
                                        <th>Total Order</th>
                                      </tr>
                                      <?php 
                                      $sql="SELECT pv.kode_provinsi,pv.nama_provinsi ,SUM(p.amount) FROM pengiriman AS pn INNER JOIN pesan AS p ON (pn.no_transaksi=p.no_transaksi)
                                                                                                   INNER JOIN provinsi as pv ON (pv.kode_provinsi=pn.kode_provinsi)
                                            WHERE p.status=2 AND p.jenis_bayar=1 AND p.approve_date BETWEEN '$tgl1 00:00:00' AND '$tgl2 23:59:59'
                                            and p.no_transaksi not like '%BTL%' and p.delay=0
                                            GROUP BY pn.kode_provinsi ORDER BY SUM(p.amount) DESC  LIMIT 20";
                                      $query=mysqli_query($connect, $sql) or die ($sql);
                                      while(list($kode,$prov,$amount)=mysqli_fetch_array($query)){
                                      $no++;        
                                      ?>
                                      <tr>
                                        <td><?php echo $no;?></td>
                                        <td>
                                          <a href="index.php?menu=crm_area_detail&nama_url=<?php echo $kode;?>&tgl1=<?php echo $tgl1;?>&tgl2=<?php echo $tgl2;?>"><?php echo $prov;?></a></td>
                                        <td align="right"><?php echo number_format("$amount",0,",",".");?></td>
                                      </tr>
                                      <?php }?>
                                      <tr class="bg-success">
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                      </tr>
                                    </table>


                                </div>
                            </div>
                 
                        </div>
                    </div>
                </div>
                <!-- END CONTENT BODY -->
            </div>

            <script src="jquery-3.1.1.min.js"></script>
            <script type="text/javascript">
               
               function pindah(id){
                
                if(id!=''){
                    // alert(id);
                    $("#f1").attr("action","index.php?menu=masterproduk_entry"); // mengirim variable dalam form melalui post
                    // $("#f1").attr("target","_blank");
                    $("#submit").click();
                    $("#f1").attr("action","index.php?menu=masterproduk_entry");
                    $("#f1").attr("target",""); 
                } else {
                    alert("pilih id outlet terlebih dahulu");    
                }    
              }   
            
            </script>
            <!-- END CONTENT -->
            <!-- BEGIN QUICK SIDEBAR -->
           