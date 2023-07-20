<script language="javascript" type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>

<script>
$(document).ready(function(){
    $('#f1').submit(function(evt) {
		//alert('Silahkan tunggu');
                evt.preventDefault();
                var formData = new FormData(this);

                $.ajax({
                type: 'POST',
                url: 'page/member_proses.php',
                data:formData,
                cache:false,
                contentType: false,
                processData: false,
                success: function(data) {
                //alert(data);		  
                    if (data.trim()=='tidak_terdaftar'){
                      alert("Member tidak terdaftar, kemungkinan salah id atau outlet daftar");
                    } else {
                      location.reload();  
                    }
					      // location.reload();				 								
					      // $('#imagedisplay').html("<img src=" + data.url + "" + data.name + ">");
                },
                error: function(data) {
                   // $('#imagedisplay').html("<h2>this file type is not supported</h2>");
                }
                });
            });
 });
 
 
</script>
<?php include"../connect.php";
  
  $id=$_POST[id];
  //echo"id ".$id;
  $sql="SELECT m.email,m.password,m.nama,m.id_level,m.id_customer,c.id_outlet
        FROM member as m left join customer as c on (m.id_customer=c.id)  where m.email='$id'";
  //echo $sql;
  $query=mysqli_query($connect, $sql) or die ($sql);
  list($email,$pasw,$nama,$id_level,$idcust,$id_outlet)=mysqli_fetch_array($query);        
?>
<form method="post" id="f1" name="f1" enctype="multipart/form-data">
  <input type="hidden" name="temp_id" value="<?php echo $email;?>">
          <table class="table table-bordered table-responsive table-striped">
          <tr><td>Email</td>     <td>  <input type=text name='email' class="form-control" value="<?php echo $email;?>" readonly></td></tr>
          <tr><td>Nama</td>     <td>   <input type=text name='nama' size="50" class="form-control" value="<?php echo $nama;?>" readonly></td></tr>
          <tr><td>Jenis member</td><td>        
                <select class="form-control" id="jenis_member" name="jenis_member">
                                       <option value="">-- pilih --</option>
                                       <?php
                                       $sql="SELECT id_level,jenis_member FROM customer_level where status=1";
                                       $query=mysqli_query($connect, $sql) or die ($sql);
                                       while(list($idl,$level)=mysqli_fetch_array($query)){
                                       ?>
                                         <option value="<?php echo "$idl"; ?>" <?php if($idl==$id_level){echo "selected";}?>><?php echo $level; ?>
                                         </option>
                                     <?php } ?>     
                </select>
               </td>
          </tr>
          <tr><td>Nomor Kartu</td>     <td>   <input type=text name='id_member' size="50" class="form-control" value="<?php echo $idcust;?>"></td></tr>
          <tr><td>Outlet tempat daftar</td>
               <td><select class="form-control" id="outlet" name="outlet">
                                       <option value="">-- pilih --</option>
                                       <?php
                                       $sql="SELECT kode_share,nama FROM reshare WHERE `status`=1";
                                       $query=mysqli_query($connect, $sql) or die ($sql);
                                       while(list($id_otl,$otl)=mysqli_fetch_array($query)){
                                       ?>
                                         <option value="<?php echo "$id_otl"; ?>" <?php if($id_otl==$id_outlet){echo "selected";}?>>
                                          <?php echo $otl."[".$id_otl."]"; ?>
                                         </option>
                                     <?php } ?>     
                </select></td>
          </tr>
          
          <tr><td colspan=2>
          <input type="hidden" name="jenis" value="editmember" />
          <input type="submit" value="Edit" class="btn btn-success">
                           </td></tr>
          </table>
</form>