
<script language="javascript" type="text/javascript" src="jquery.min.js"></script>

<script>
$(document).ready(function(){
    $('#f1').submit(function(evt) {
		//alert('Silahkan tunggu');
                evt.preventDefault();
                var formData = new FormData(this);

                $.ajax({
                type: 'POST',
                url: 'page/user_proses.php',
                data:formData,
                cache:false,
                contentType: false,
                processData: false,
                success: function(data) {
                       alert(data);		  
					             location.reload();				 								
					//$('#imagedisplay').html("<img src=" + data.url + "" + data.name + ">");
                },
                error: function(data) {
                   // $('#imagedisplay').html("<h2>this file type is not supported</h2>");
                }
                });
            });


 });
 
 
</script>
<?php include"../connect.php";

  $id=$_POST['id'];
  $sql="SELECT username,`password`,`level`,nama,email,id_outlet,`status` FROM  user where username='$id'";
  $query=mysqli_query($connect,$sql) or die ($sql);
  list($user,$pass,$lvl,$nama,$email,$id_outlet,$status)=mysqli_fetch_array($query);
?>
<form method="post" id="f1" name="f1" enctype="multipart/form-data">
          <input type="hidden" name="temp_id" value="<?php echo $user;?>">
          <table class="table table-bordered table-responsive table-striped">
          <tr><td>Username</td>     <td>  <input type=text name='username' class="form-control" value="<?php echo $user;?>"></td></tr>
          <tr><td>Password</td>     <td>  <input type=text name='password' size="50" class="form-control" value="<?php echo $pass;?>"></td></tr>
          <tr><td>Level</td>       
          <td>  <select name="level" class="form-control">
                                           
            <option value="">-- pilih --</option>
                <?php
              $sql_l=mysqli_query($connect,"select id,nama from user_level where status=1") or die($sql_l);
                while(list($idl,$level)=mysqli_fetch_array($sql_l))
                {   
                ?>
                  <option value="<?php echo "$idl"; ?>" <?php if($lvl==$idl){echo "selected";}?>><?php echo "$level"; ?>
                  </option>
              <?php } ?> 
                         
          </select></td></tr>
          <tr><td>Nama</td>     <td>  <input type=text name='nama' size="50" class="form-control" value="<?php echo $nama;?>"></td></tr>  
          <tr><td>Outlet</td><td>        
                <select class="form-control" id="outlet" name="outlet">
                                       <option value="">-- pilih --</option>
                                       <?php
                                          $sql_o=mysqli_query($connect,"select id,nama from outlet where status=1") or die($sq_o);
                                       while(list($ido,$otl)=mysqli_fetch_array($sql_o))
                                       {
                                         
                                       ?>
                                         <option value="<?php echo "$ido"; ?>" <?php if($id_outlet==$ido){echo "selected";}?>><?php echo "$otl"; ?>
                                         </option>
                                     <?php } ?>     
                                    </select>
               </td>
          </tr>
          <tr><td>Status</td>     <td> 
                                    <select name="status" class="form-control">
                                       <?php if($status==1){?>
                                        <option value="1">Aktif </option>
                                        <option value="0">Tidak aktif </option>
                                       <?php } else {?> 
                                        <option value='1'>aktif</option>
                                        <option value='0'  selected="selected">tidak aktif</option>
                                        <?php }?> 
                                    </select>
                                </td></tr>  
         
          <tr><td colspan=2>
          <input type="hidden" name="jenis" value="edituser" />
          <input type="submit" value="Edit" class="btn btn-success">
                           </td></tr>
          </table></form>