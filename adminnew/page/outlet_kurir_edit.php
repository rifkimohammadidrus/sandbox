
<script language="javascript" type="text/javascript" src="jquery.min.js"></script>

<script>
$(document).ready(function(){
    $('#f1').submit(function(evt) {
		//alert('Silahkan tunggu');
                evt.preventDefault();
                var formData = new FormData(this);

                $.ajax({
                type: 'POST',
                url: 'page/outlet_kurir_proses.php',
                data:formData,
                cache:false,
                contentType: false,
                processData: false,
                success: function(data) {
                       //alert(data);		  
					        location.reload();				 								
					//$('#imagedisplay').html("<img src=" + data.url + "" + data.name + ">");
                },
                error: function(data) {
                   // $('#imagedisplay').html("<h2>this file type is not supported</h2>");
                }
                });
            });

    $("#kurir").change(function(){
    //alert('oce');
    var kurir = $("#kurir").val();
    $.ajax({
        url: "proses_load_kurir.php",
        data: "kurir=" + kurir,
        success: function(data){
    //alert(data);
            // jika data sukses diambil dari server, tampilkan di <select id=kota>
            $("#layanan").html(data);
        } // end succses
    }); // end ajax
  }); // end change 

 });
 
 
</script>
<?php 
  include"../connect.php";
  $temp_id=$_POST['id'];
  $pecah_id=explode(";",$temp_id,5);
  $id_kurir=$pecah_id[0];
  $id_outlet=$pecah_id[1];
  $id_layanan=$pecah_id[2];

  $s="SELECT id_outlet,id_kurir,id_layanan,`status` FROM outlet_kurir where id_outlet='$id_outlet' and id_kurir='$id_kurir' and id_layanan='$id_layanan'";
  $qs=mysqli_query($connect, $s) or die ($s);
  list($ido,$idk,$idl,$status)=mysqli_fetch_array($qs);
?>
<form method="post" id="f1" name="f1" enctype="multipart/form-data">
  <input type="hidden" name="temp_outlet" value="<?php echo $id_outlet;?>">
  <input type="hidden" name="temp_kurir" value="<?php echo $id_kurir;?>">
  <input type="hidden" name="temp_layanan" value="<?php echo $id_layanan;?>">
          <table class="table table-bordered table-responsive table-striped">
          <tr><td>Kurir</td><td>        
                <select class="form-control" id="kurir" name="kurir">
                                       <option value="">-- pilih --</option>
                                        <?php 
                                        $sql="select id_kurir,nama_kurir from kurir where status=1";
                                        $query=mysqli_query($connect, $sql) or die ($sql);
                                        while(list($idkurir,$nama)=mysqli_fetch_array($query)){
                                        ?>
                                       <option value="<?php echo $idkurir;?>" <?php if($idk==$idkurir) {echo"selected";} ?> ><?php echo $nama; ?> </option>
                                     <?php } ?>     
                                    </select>
               </td>
          </tr>
          <tr><td>Paket layanan</td><td>        
	               <select id="layanan" name="layanan" class="form-control required">
                      <option value="">-- Pilih --</option>
                      <?php 
                                        $sql="select id,nama_layanan from kurir_layanan where id_kurir=$idk and status=1";
                                        $query=mysqli_query($connect, $sql) or die ($sql);
                                        while(list($idlayan,$namalayan)=mysqli_fetch_array($query)){
                                        ?>
                                       <option value="<?php echo $idlayan;?>" <?php if($idl==$idlayan) {echo"selected";} ?> ><?php echo $namalayan; ?> </option>
                                     <?php } ?>                       
                    </select>
               </td>
		      </tr>
		      <tr><td>Status</td><td> <select name="status" class="form-control">
		                                    <?php 
                                        if($status==1){
                                        ?>    
                                         <option value='1' selected="selected">aktif</option>
								                         <option value='0'>tidak aktif</option>
                                        <?php } else {?> 
                                         <option value='1'>aktif</option>
                                         <option value='0' selected="selected">tidak aktif</option>
                                        <?php }?>
                                  </select>
                             </td></tr>
        
          <tr><td colspan=2>
          <input type="hidden" name="jenis" value="editoutletkurir" />
          <input type="submit" value="Update" class="btn btn-success">
                           </td></tr>
          </table></form>