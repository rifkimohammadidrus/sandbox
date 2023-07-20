<link rel="stylesheet" href="../css/messageBoxAdmin.css?d=<?php echo date('YmdHis'); ?>">
<style>
.sembunyi{
 /*display:none;	*/
}
</style>
<script type="text/javascript" src="../js/jquery-1.9.0.min.js"></script>
<script src="../js/jquery-ui.min.js" type="text/javascript"></script>
<script type="application/javascript" src="js/monitoring_chat_admin.js?d=<?php echo date('YmdHis');?>"></script>
<script type="application/javascript">
var user_dest='<?php echo 'user_dest';?>';
var user='<?php echo 'user';?>';

</script>
<?php
#echo "$_SESSION[id_outlet] " ;
$sql="SELECT nama FROM outlet WHERE id='".$_SESSION[id_outlet]."'";
$res=mysqli_query($connect, $sql);
list($nama_outlet)=mysqli_fetch_array($res);

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
                    <span>chatting </span>
                </li>
            </ul>
            
        </div>
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
<input name="cbAutoOpen" id="cbAutoOpen" type="checkbox" value="1"/>    AutoMatic Open            
<table width="800" border="1" class="table table-responsive table-bordered" id="myTable">
  <tr class="bg-success">
    <td>No</td>
    <td class="sembunyi">ID ROOM</td>
    <td>TOKO</td>
    <td>CLIENT</td>
    <td>Last Akses</td>
    <td>Last update</td>
    <td>&nbsp;</td>
  </tr>
  <tbody>
  <?php
  //$self='Bani Rawamangun';
  $sql="SELECT chat_id,user1,user2,`user_last_access`, `updatedate` FROM chat_room WHERE user1='$nama_outlet' OR user2='$nama_outlet' 
  order by updatedate desc";
  //echo $sql;
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
  <tr class="isi-tabel" id="dr_<?php echo $chat_room;?>">
    <td id="no_<?php echo $chat_room;?>"><?php echo $no;?></td>
    <td  class="sembunyi" id="cr_<?php echo $chat_room;?>"><?php echo $chat_room;?></td>
    <td id="sl_<?php echo $chat_room;?>"><?php echo $self;?></td>
    <td id="ptnr_<?php echo $chat_room;?>"><?php echo $partner;?></td>
    <td id="ptnr_<?php echo $chat_room;?>"><?php echo $user_last_access;?></td>
    <td id="ptnr_<?php echo $chat_room;?>"><?php echo $updatedate;?></td>    
    <td><input type="button" name="btnTambah<?php echo $no;?>" id="btnTambah<?php echo $no;?>" value="chat" onClick="chat(<?php echo "'$no','$chat_room','$self','$partner'";?>);"></td>
  </tr>
  <?php
  }
  ?>
 </tbody>
</table>
                
               
               
                    
             </div>
        </div>
     
          
    </div>
    <!-- END CONTENT BODY -->
</div>
<script>
var last_access='<?php echo date('Y-m-d H:i:s')?>';
var no='<?php echo $no;?>';
var store_name='<?php echo $nama_outlet;?>';
</script>