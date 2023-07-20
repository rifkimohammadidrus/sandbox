<script language="javascript" type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script>
 $(document).ready(function(){
    $('#f1').submit(function(evt) {
		$("#loader").show();
		$("#btntambah").hide();
                evt.preventDefault();
                var formData = new FormData(this);

                $.ajax({
                type: 'POST',
                url: 'page/proses_gallery.php?jenis=ambasador_edit',
                data:formData,
                cache:false,
                contentType: false,
                processData: false,
                success: function(data) {
                       alert(data);	
					   $("#loader").hide();
		              $("#btntambah").show();	  
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

<form method=POST   enctype="multipart/form-data" id="f1">
         <?php //include"editor.php";
		  include"../connect.php";
		  $id=$_POST[id];
		  $sql="SELECT judul,images,status FROM tbl_ambasador where id='$id'";
		  $query=mysqli_query($connect, $sql) or die ($sql);
		  list($judul,$images,$status)= mysqli_fetch_array($query);
		  
		 ?>
          <table class="table table-bordered table-responsive table-striped">
        
		        <tr><td>Nama foto</td>           <td><input type="text" name="judul" value="<?php echo $judul;?>"/>
                <input type="hidden" name="temp_id" value="<?php echo $id; ?>" /></td></tr>
                <tr><td>File Image Baru</td>     <td>
                <img src="../page/images/ambasador/<?php echo $images?>"  width="200"/>
                <br /><input type="file" name="userfile"/></td></tr>
              
                <tr><td>Status</td><td><select name="status" class="form-control">
                                        <?php if($status==1){?>
                                         <option value="1" selected="selected">Tampil</option>
                                         <option value="0">Tidak tampil</option>
                                        <?php } else {?>
                                          <option value="1" >Tampil</option>
                                         <option value="0" selected="selected">Tidak tampil</option>
                                        <?php }?>
                                      </select>
               </td></tr>
          <tr><td colspan=2>
		                   
							<input type="submit" value="Edit" id="btntambah">
                            <input type="button" value="Batal" onclick="self.history.back()">
			   </td>
	      </tr>
          
          </table>
		  </form>
          <span id="loader" style="display:none;"><img src="images/Loader.gif" width="300" /></span>