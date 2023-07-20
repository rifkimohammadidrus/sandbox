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
    url: 'page/produk_proses.php',
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
    <tr><td>Kode Jenis Produk </td>     <td>  <input type=text name='kode' class="form-control"></td></tr>
    <tr><td>Nama Jenis Produk</td>     <td>   <input type=text name='nama' size="50" class="form-control"></td></tr>
    <tr><td>Kategori</td>
      <td>        
        <select class="form-control" id="kategori" name="kategori">
          <option value="">-- pilih --</option>
            <?php
            $sql="SELECT kode_kategori,nama_kategori FROM kategori where status=1";
            $query=mysqli_query($connect,$sql) or die ($sql);
            while(list($kodekat,$kat)=mysqli_fetch_array($query)){
            ?>
              <option value="<?php echo "$kodekat"; ?>"><?php echo $kat; ?>
          </option>
          <?php } ?>     
        </select>
      </td>
    </tr>
    <tr><td>Bahan dasar</td>   <td> <textarea name="bahan" id="bahan" class="form-control"></textarea>
                                          <!-- <script>CKEDITOR.replace('bahan');</script> --></td></tr>
    <tr><td>Deskripsi produk</td>   <td> <textarea name="desc" id="desc" class="form-control"></textarea>
                                    <!-- <script>CKEDITOR.replace('desc');</script> --></td></tr>
    <tr><td>Berat</td>     <td>   <input type=text name='berat' size="50" class="form-control"></td></tr>
    
    <tr><td>Foto 1</td><td><input type="file" name="userfile" /></td></tr>
    <tr><td>Foto 2</td><td><input type="file" name="userfile2" /></td></tr>
    <tr><td>Foto 3</td><td><input type="file" name="userfile3" /></td></tr>
    <tr><td>Foto 4</td><td><input type="file" name="userfile4" /></td></tr>
    <tr><td>Foto Thumbnail</td><td><input type="file" name="userThumb" /></td></tr>
    <tr><td>Status publish</td><td> 
      <select name="status" class="form-control">
        <option value=''>-- pilih --</option>
        <option value='1'>aktif</option>
        <option value='0'>tidak aktif</option>
      </select></td>
    </tr>
    <tr>
      <td>Tanggal Rilis</td>
      <td><input type="date" name="tanggal_rilis" id="tanggal_rilis" style="width:200px" class="form-control"></td>
    </tr>
    <tr><td colspan=2>
    <input type="hidden" name="jenis" value="tambahproduk" />
    <input type="submit" value="Tambah" class="btn btn-success">
                      </td></tr>
    </table></form>