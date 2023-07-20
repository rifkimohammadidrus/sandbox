
<script language="javascript" type="text/javascript" src="jquery.min.js"></script>

<script>
$(document).ready(function(){
    $('#f1').submit(function(evt) {
		//alert('Silahkan tunggu');
      evt.preventDefault();
      var formData = new FormData(this);

      $.ajax({
        type: 'POST',
        url: 'page/outlet_proses.php',
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

     $("#provinsi").change(function(){
    //alert('oce');
    var propinsi = $("#provinsi").val();
    $.ajax({
        url: "proses_kota.php",
        data: "provinsi=" + propinsi,
        success: function(data){
      
            // jika data sukses diambil dari server, tampilkan di <select id=kota>
            $("#kota").html(data);
        } // end succses
    }); // end ajax
  }); // end change 

 });
 
 
</script>
<?php 
include("../connect.php");

$id=$_POST['id'];
$sql="SELECT id,nama,alias,telp,alamat,kota,provinsi,foto,banner,status FROM outlet WHERE id='$id'";
$query=mysqli_query($connect,$sql) or die ($sql);
list($kode,$reshare,$alias,$telp,$alamat,$kota,$prov,$foto,$banner,$status)=mysqli_fetch_array($query);	  
?>
<form method="post" id="f1" name="f1" enctype="multipart/form-data">
         <table class="table table-bordered table-responsive table-striped">
          <input type="hidden" name="temp_id" value="<?php echo $kode;?>">
          <tr><td>Kode reSHARE</td>     <td>  <input type=text name='kodereshare' class="form-control" value="<?php echo $kode;?>"></td></tr>
          <tr><td>Nama reSHARE</td>     <td>  <input type=text name='namareshare' size="50" class="form-control" value="<?php echo $reshare;?>"></td></tr>
          <tr><td>Nama Url </td>     <td>  <input type=text name='alias' size="50" class="form-control" value="<?php echo $alias;?>"></td></tr>
          <tr><td>Alamat</td> <td>  <textarea name='alamat' size=50 class="form-control"><?php echo $alamat;?></textarea></td></tr>  
          <tr><td>Provinsi</td><td>        
                <select class="form-control" id="provinsi" name="provinsi">
                  <option value="">-- pilih --</option>
                  <?php
                      $sql_provinsi=mysqli_query($connect,"select kode_provinsi,nama_provinsi from provinsi") or die($sql);
                      while($provinsi=mysqli_fetch_array($sql_provinsi))
                      {
                        $provinceValue = $provinsi[0];
                        $defaultProvince = $provinsi[1];
                        ?>
                        <option value="<?php echo "$provinceValue"; ?>" <?php if($provinceValue==$prov){echo "selected";}?>><?php echo "$defaultProvince"; ?>
                        </option>
                  <?php } ?>     
                </select>
               </td>
          </tr>
          <tr><td>Kota</td><td>        
                 <select id="kota" name="kota" class="form-control required">
                      <?php 
                      $sql="select kode_kota,nama_kota from kota where kode_provinsi='$prov'";
                      $query=mysqli_query($connect,$sql) or die ($sql);
                      while(list($idkota,$namakota)=mysqli_fetch_array($query)){
                      ?>
                      <option value="<?php echo $idkota;?>" <?php if($idkota==$kota){echo "selected";}?>><?php echo $namakota;?></option>                     
                      <?php }?>
                    </select>
               </td>
          </tr>
          <tr><td>No.Telp/HP</td>   <td> <input type=text name='no_telp' class="form-control" value="<?php echo $telp;?>"></td></tr>
          <tr><td>Status</td><td> <select name="status" class="form-control">
              <?php if($status==1){?>
              <option value='1' selected="selected">aktif</option>
              <option value='0'>tidak aktif</option>
              <?php } else {?>
              <option value='1'>aktif</option>
              <option value='0'  selected="selected">tidak aktif</option>
              <?php }?>
          </select></td></tr>
          <tr><td>Foto</td><td>
              <img src="../assets/images/outlet/<?php echo $foto?>" style="width: 300px;"><br>
              <input type="file" name="userfile" /></td>
          </tr>
          <tr><td>No.Whatsapp</td>   <td> <input type=text name='wha' class="form-control"></td></tr>
          <tr><td>Instagram</td>   <td> <input type=text name='ig' class="form-control"></td></tr>
          <tr><td colspan=2>
          <input type="hidden" name="jenis" value="editoutlet" />
          <input type="submit" value="Edit" class="btn btn-success">
                           </td></tr>
          </table></form>