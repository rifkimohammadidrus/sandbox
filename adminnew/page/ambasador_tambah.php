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
                url: 'page/proses_gallery.php?jenis=ambasador',
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
		 ?>
          <table class="table table-bordered table-responsive table-striped">
        
		        <tr><td>Nama foto</td>           <td><input type="text" name="judul"/></td></tr>
                <tr><td>File Image Baru</td>     <td><input type="file" name="userfile"/></td></tr>
              
                <tr><td>Status</td><td><select name="status" class="form-control">
                                         <option value="1">Tampil</option>
                                         <option value="0">Tidak tampil</option>
                                      </select>
               </td></tr>
          <tr><td colspan=2>
		                   
							<input type="submit" value="Tambah" id="btntambah">
                            <input type="button" value="Batal" onclick="self.history.back()">
			   </td>
	      </tr>
          
          </table>
		  </form>
          <span id="loader" style="display:none;"><img src="images/Loader.gif" width="300" /></span>