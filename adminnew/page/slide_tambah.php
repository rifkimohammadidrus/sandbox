
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
<?php include"../connect.php";?>
<form method="post" id="f1" name="f1" enctype="multipart/form-data">
          <table class="table table-bordered table-responsive table-striped">
          <tr><td>Judul slide</td>     <td>  <input type=text name='judul' class="form-control"></td></tr>
          <tr><td>Foto</td><td><input type="file" name="userfile" /></td></tr>
          <tr><td>Url tujuan </td>     <td>  <input type=text name='link' size="50" class="form-control"></td></tr>
		      <tr><td>Status</td><td> <select name="status" class="form-control">
		                           <option value=''>-- pilih --</option>
		                           <option value='1'>aktif</option>
								   <option value='0'>tidak aktif</option></select></td></tr>
          
          <tr><td colspan=2>
          <input type="hidden" name="jenis" value="tambahslide" />
          <input type="submit" value="Tambah" class="btn btn-success">
                           </td></tr>
          </table></form>