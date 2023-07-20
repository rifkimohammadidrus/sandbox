<?php
include_once('connect.php');
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
                                <span>Tracking order </span>
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
                            <?
                                $benar=false;
                                if($_GET['menu']=='siapkan')
                                {
                                    $lanjutan='AND kode_track=1';    
                                }else if($_GET['menu']=='perjalanan')
                                {
                                    $lanjutan='AND kode_track=2';
                                    $benar=true;    
                                }else if($_GET['menu']=='diterima')
                                {
                                    $lanjutan='AND kode_track=3';
                                    $benar=true;    
                                }

                                if ($_SESSION[id_outlet]!=''){
                                    $filter_outlet="AND id_outlet='$_SESSION[id_outlet]'";
                                } else {
                                    $filter_outlet="";
                                }
                                                       
                                ?>
                           
                            <!-- BEGIN SAMPLE TABLE PORTLET-->
                            <div class="portlet box green">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-cogs"></i>Order yang <?php echo $_GET[menu]; ?></div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                        <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                                        <a href="javascript:;" class="reload"> </a>
                                       <!-- <a href="javascript:;" class="remove"> </a> -->
                                    </div>
                                </div>
                                <div class="portlet-body">
                                
                                <form name="f1" method="post" id="f1" style="display: none;">
                                    <input type="hidden" id="temp_no" name="temp_no"/>
                                    <input type="submit" name="submit" value="proses" id="submit"/>
                                </form>    
                                <table class="table table-responsive table-bordered">
                                <tr class="bg-success">
                                    <td align="left" height="25" width="130">No Transaksi</td>
                                    <td align="left" width="270">Email</td>
                                    <td align="left" width="200">Tanggal</td>
                                    <td align="left" width="50">Qty</td>
                                    <td align="left" width="100">Amount</td>
                                    <td align="left" width="100">Ongkos</td> 
                                    <td align="left" width="100">Total Bayar</td>
                                    <td align="left" width="100">Total Trf</td>
                                   <!--  <td align="left" width="200">Tracking</td> -->
                                    <td align="left" width="100">Aksi</td> 
                                    
                                </tr>
                                <?php 

                                  
                                $sql="select * from pesan where no_transaksi!='' $filter_outlet $lanjutan order by no_transaksi desc";     
                                $query=mysqli_query($connect, $sql)or die($sql);
                                while(list($no_transaksi,$email,$tanggal,$status,$jmlproduk,$amount,$ongkos,$seluruh,$jenisbayar,$kode_track,$retur,$bank,$approvedate,$totaltrf)=mysqli_fetch_array($query)){?>
                                <tr class="isi-tabel">
                                    <td ><?php echo $no_transaksi?></td>
                                    <td><?php echo $email ?></td>
                                    <td ><?php echo $tanggal?></td>
                                    <td align="center"><?php echo $jmlproduk ?></td>
                                    <td align="right"><?php echo number_format("$amount",0,",",".");?></td>
                                    <td align="right"><?php  echo number_format("$ongkos",0,",","."); ?></td>
                                    <td align="right"><?php echo number_format("$seluruh",0,",",".");?></td>
                                    <td align="right"><?php echo number_format("$totaltrf",0,",",".");?></td>
                                   <!--  <td ><?php echo $_GET['kondisi'];
                                    ?></td> -->
                                    <td align="center"><a href="#" onclick="pindah('<?php echo $no_transaksi;?>')"> Detail </a></td>
                                    </tr>
                                <?php }?>
                                <tr class="bg-success">
                                    <td colspan="9">&nbsp;</td>
                                </tr>
                                </table>
                                
                                </div>
                            </div>
                 
                        </div>
                    </div>
                </div>
                <!-- END CONTENT BODY -->
            </div>


</head>

<body id="myBody">
<div> 
 
<table width="800" border="1">
  <tr>
    <td>No</td>
    <td>ID ROOM</td>
    <td>TOKO</td>
    <td>CLIENT</td>
    <td>Last Akses</td>
    <td>Last update</td>
    <td>&nbsp;</td>
  </tr>
  <?php
  $self='Bani Rawamangun';
  $sql="SELECT chat_id,user1,user2,`user_last_access`, `updatedate` FROM chat_room WHERE user1='$self' OR user2='$self' order by user_last_access desc";
  echo $sql;
  $res=mysqli_query($connect, $sql);
  $no=0;
  while(list($chat_room,$user1,$user2,$user_last_access, $updatedate)=mysqli_fetch_array($res)){
	  if($user1==$self){
		 $self=$user1;	     
		 $partner=$user2;
	  }else{
		 $self=$user2; 
		 $partner=$user1;
	  }
	  $no++;
	  
  ?>
  <tr>
    <td class="dr" id="<?php echo $no ?>"><?php echo $no;?></td>
    <td id="cr_<?php echo $chat_room;?>"><?php echo $chat_room;?></td>
    <td id="sl_<?php echo $chat_room;?>"><?php echo $self;?></td>
    <td id="ptnr_<?php echo $chat_room;?>"><?php echo $partner;?></td>
    <td id="ptnr_<?php echo $chat_room;?>"><?php echo $user_last_access;?></td>
    <td id="ptnr_<?php echo $chat_room;?>"><?php echo $updatedate;?></td>
    
    <td><input type="button" name="btnTambah2" value="chat" onClick="chat(<?php echo "'$no','$chat_room','$self','$partner'";?>);"></td>
  </tr>
  <?php
  }
  ?>
 
</table>
<link rel="stylesheet" href="../css/messageBox.css?d=<?php echo date('YmdHis'); ?>">
<script type="text/javascript" src="../js/jquery-1.9.0.min.js"></script>
<script src="../js/jquery-ui.min.js" type="text/javascript"></script>
<script type="application/javascript" src="js/monitoring_chat_admin.js?d=<?php echo date('YmdHis');?>"></script>
<script type="application/javascript">
var user_dest='<?php echo 'user_dest';?>';
var user='<?php echo 'user';?>';

</script>
