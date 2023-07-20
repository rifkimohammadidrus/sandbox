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

}

if ($_SESSION['id_outlet']!=''){
  $filter_outlet="and p.id_outlet='$_SESSION[id_outlet]'";
} else {
  $filter_outlet="";
}

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
                                <span>Konsumen yang paling banyak order</span>
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
                                        <i class="fa fa-cogs"></i>Konsumen yang paling banyak order</div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                        <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                                        <a href="javascript:;" class="reload"> </a>
                                       <!-- <a href="javascript:;" class="remove"> </a> -->
                                    </div>
                                </div>
                                <div class="portlet-body">
                                <script>
                                        function pindah(kode){
                                        //alert(kode);
                                        $("#temp_no").val(kode);
                                        $("#f1").attr("action","transaction_detail.html");// mengirim variable dalam form melalui post
                                        $("#f1").attr("target","");
                                        $("#submit").click();
                                        
                                    }
                                    </script>
                                    <?php 
                                    $nama_url=$_GET['nama_url'];
                                    $tgl1=$_GET['tgl1'];
                                    $tgl2=$_GET['tgl2'];
                                    ?>
                                    <p>&nbsp;</p>
                                    <h4>List order atas nama <?php echo $nama_url?> Periode <?php echo $tgl1." sampai dengan ".$tgl2;?></h4>
                                    <p>&nbsp;</p>
                                    <?php 
                                    $sql="SELECT
                                        p.no_transaksi
                                        , pn.nama
                                        , p.tanggal
                                        , p.jmlproduk
                                        , p.amount
                                        , p.ongkos
                                        , p.total_transfer
                                    FROM
                                        pengiriman AS pn
                                        INNER JOIN pesan AS p 
                                            ON (pn.no_transaksi = p.no_transaksi)
                                    WHERE pn.nama LIKE '%$nama_url%'  AND tanggal BETWEEN '$tgl1' AND '$tgl2' and p.no_transaksi not like '%BTL%' and p.delay=0  $filter_outlet order by p.tanggal DESC";
                                    $query=mysqli_query($connect, $sql) or die ($sql);
                                    ?>
                                    <form method="post" id="f1" name="f1" style="display:none;">
                                       <input type="text" name="temp_no" id="temp_no">
                                       <input type="submit" name="submit" value="proses" id="submit"/>
                                    </form>
                                    <table class="table table-responsive table-bordered">
                                     <thead>
                                      <tr class="bg-success">
                                        <th>No</th>
                                        <th>No transaksi</th>
                                        <th>Nama</th>
                                        <th>Tanggal</th>
                                        <th>Qty</th>
                                        <th>Subtotal</th>
                                        <th>Ongkos kirim</th>
                                        <th>Total transfer</th>
                                      </tr>
                                       <thead>

                                     <?php 
                                     while(list($notrans,$nama,$date,$qty,$amount,$ongkos,$transfer)=mysqli_fetch_array($query)){
                                     $no++;
                                     ?>  
                                      <tr>
                                        <td><?php echo $no;?></td>
                                        <td><a href="#" onclick="pindah('<?php echo $notrans;?>')"><?php echo $notrans;?></a></td>
                                        <td><?php echo $nama;?></td>
                                        <td><?php echo $date;?></td>
                                        <td align="center"><?php echo $qty;?></td>
                                        <td align="right"><?php echo number_format("$amount",0,",",".");?></td>
                                        <td align="right"><?php echo number_format("$ongkos",0,",",".");?></td>
                                        <td align="right"><?php echo number_format("$transfer",0,",",".");?></td>
                                      </tr>
                                      <?php 
                                      $t_qty+=$qty;
                                      $t_amount+=$amount;
                                      $t_ongkir+=$ongkos;
                                      $t_transfer+=$transfer;
                                      } ?>

                                      <tr class="bg-success">
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td align="right"><strong><?php echo number_format("$t_amount",0,",",".");?></strong></td>
                                        <td align="right"><strong><?php echo number_format("$t_ongkir",0,",",".");?></strong></td>
                                        <td align="right"><strong><?php echo number_format("$t_transfer",0,",",".");?></strong></td>
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
           