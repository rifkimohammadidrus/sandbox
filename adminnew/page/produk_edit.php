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
      // alert(data);		  
      location.reload();				 								
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

  $id=$_POST['id'];
  $sql="SELECT kode_jenis,nama,kode_kategori,deskripsi,bahan_dasar,gambar1,gambar2,gambar3,gambar4,berat,release_date,`status`
        FROM jenis_barang where kode_jenis='$id'";
  //echo $sql;
  $query=mysqli_query($connect,$sql) or die ($sql);
  list($kode,$nama,$idkat,$desc,$bahan,$foto1,$foto2,$foto3,$foto4,$berat,$tanggal_rilis,$status)=mysqli_fetch_array($query);        
?>
<form method="post" id="f1" name="f1" enctype="multipart/form-data">
  <input type="hidden" name="temp_id" value="<?php echo $kode;?>">
  <table class="table table-bordered table-responsive table-striped">
    <tr><td>Kode Jenis Produk </td>     <td>  <input type=text name='kode' class="form-control" value="<?php echo $kode;?>"></td></tr>
    <tr><td>Nama Jenis Produk</td>     <td>   <input type=text name='nama' size="50" class="form-control" value="<?php echo $nama;?>"></td></tr>
    <tr>
      <td>Kategori</td><td>        
        <select class="form-control" id="kategori" name="kategori">
          <option value="">-- pilih --</option>
          <?php
          $sql="SELECT kode_kategori,nama_kategori FROM kategori where status=1";
          $query=mysqli_query($connect,$sql) or die ($sql);
          while(list($kodekat,$kat)=mysqli_fetch_array($query)){
          ?>
            <option value="<?php echo "$kodekat"; ?>" <?php if($kodekat==$idkat){echo "selected";}?>><?php echo $kat; ?>
            </option>
          <?php } ?>     
        </select>
      </td>
    </tr>
    <tr><td>Bahan dasar</td>   <td> <textarea name="bahan" id="bahan" class="form-control"><?php echo $bahan; ?></textarea>
                                    <script>//CKEDITOR.replace('bahan');</script></td></tr>
    <tr><td>Deskripsi produk</td>   <td> <textarea name="desc" id="desc" class="form-control"><?php echo $desc; ?></textarea>
                                    <script>//CKEDITOR.replace('desc');</script></td></tr>
    <tr><td>Berat</td>     <td><input type=text name='berat' size="50" class="form-control" value="<?php echo $berat;?>"></td></tr>
    <tr>
        <td>Foto 1</td>
        <td>
            <?php 
            if($foto1!=''){
            ?>
              <img src="../assets/foto_produk/<?php echo $foto1;?>?log=<?php echo $time;?>" width="200"><br>
            <?php } ?>
            <input type="file" name="userfile" />
        </td>
    </tr>
    <tr><td>Foto 2</td>
        <td>
          <?php if ($foto2!=''){ ?>
              <img src="../assets/foto_produk/<?php echo $foto2;?>?log=<?php echo $time;?>" width="200"><br>
          <?php } ?>
            <input type="file" name="userfile2" />
        </td>
    </tr>
    <tr>
        <td>Foto 3</td>
        <td>
          <?php if ($foto3!=''){ ?>
              <img src="../assets/foto_produk/<?php echo $foto3;?>?log=<?php echo $time;?>" width="200"><br>
          <?php } ?>
            <input type="file" name="userfile3" />
          
          </td>
    </tr>
    <tr>
        <td>Foto 4</td>
        <td>
          <?php if ($foto4!=''){ ?>
              <img src="../assets/foto_produk/<?php echo $foto4;?>?log=<?php echo $time;?>" width="200"><br>
          <?php } ?>
            <input type="file" name="userfile4" />
        </td>
    </tr>
    <tr>
        <td>Foto Thumbnail</td>
        <td>
          <?php if ($foto1!=''){ ?>
              <img src="../assets/foto_produk/thumbnail/<?php echo $foto1;?>?log=<?php echo $time;?>" width="70"><br>
          <?php } ?>
            <input type="file" name="userThumb" />
        </td>
    </tr>
    <tr><td>Status publish</td><td> <select name="status" class="form-control">
      <?php if ($status==1){?>  
        <option value='1' selected="selected">aktif</option>
        <option value='0'>tidak aktif</option>
      <?php } else {?>
        <option value='1'>aktif</option>
        <option value='0' selected="selected">tidak aktif</option>
      <?php }?>  
      </select></td>
    </tr>
    <tr>
      <td>Tanggal Rilis</td>
      <td><input type="date" name="tanggal_rilis" id="tanggal_rilis" style="width:200px" class="form-control" value="<?php echo $tanggal_rilis ?>"></td>
    </tr>
    <tr>
      <td colspan=2>
        <input type="hidden" name="jenis" value="editproduk" />
        <input type="submit" value="Edit" class="btn btn-success">
      </td>
    </tr>
  </table>
</form>