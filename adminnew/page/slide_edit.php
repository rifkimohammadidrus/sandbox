
<script language="javascript" type="text/javascript" src="jquery.min.js"></script>

<script>
$(document).ready(function(){
    $('#f1').submit(function(evt) {
		//alert('Silahkan tunggu');
                evt.preventDefault();
                var formData = new FormData(this);

                $.ajax({
                type: 'POST',
                url: 'page/slide_proses.php',
                data:formData,
                cache:false,
                contentType: false,
                processData: false,
                success: function(data) {
                    //   alert(data);		  
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
  $sql="SELECT id,judul,images,link,update_date,`status` FROM slide_home where id=$id";
  $query=mysqli_query($connect, $sql) or die ($sql);
  list($ids,$judul,$foto,$link,$date,$status)=mysqli_fetch_array($query);  
?>
<form method="post" id="f1" name="f1" enctype="multipart/form-data">
          <input type="hidden" name="temp_id" value="<?php echo $ids;?>">
          <table class="table table-bordered table-responsive table-striped">
          <tr><td>Judul slide</td>     <td>  <input type=text name='judul' class="form-control" value="<?php echo $judul?>"></td></tr>
          <tr><td>Foto</td><td>
           <?php if($foto!=''){?>
              <img src="../images/dm/<?php echo $foto?>" width="300"><br>
           <?php }?>
           <input type="file" name="userfile" />
          </td></tr>
          <tr><td>Url tujuan </td>     <td>  <input type=text name='link' size="50" class="form-control" value="<?php echo $link?>"></td></tr>
		       <tr><td>Status</td><td> <select name="status" class="form-control">
                                     <?php if($status==1){?>
                                     <option value='1' selected="selected">aktif</option>
                                     <option value='0'>tidak aktif</option>
                                     <?php } else {?>
                                     <option value='1'>aktif</option>
                                     <option value='0'  selected="selected">tidak aktif</option>
                                     <?php }?>
                                  </select></td></tr>
          
          <tr><td colspan=2>
          <input type="hidden" name="jenis" value="editslide" />
          <input type="submit" value="Edit" class="btn btn-success">
                           </td></tr>
          </table></form>