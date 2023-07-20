
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
<?php include"../connect.php";?>
<form method="post" id="f1" name="f1" enctype="multipart/form-data">
  <input type="hidden" name="temp_id" value="<?php echo $_POST['id'];?>">
          <table class="table table-bordered table-responsive table-striped">
          <tr><td>Kurir</td><td>        
                <select class="form-control" id="kurir" name="kurir">
                                       <option value="">-- pilih --</option>
                                        <?php 
                                        $sql="select id_kurir,nama_kurir from kurir where status=1";
                                        $query=mysqli_query($connect, $sql) or die ($sql);
                                        while(list($idk,$nama)=mysqli_fetch_array($query)){
                                        ?>
                                       <option value="<?php echo $idk;?>"><?php echo $nama; ?> </option>
                                     <?php } ?>     
                                    </select>
               </td>
          </tr>
          <tr><td>Paket layanan</td><td>        
	               <select id="layanan" name="layanan" class="form-control required">
                      <option value="">-- Pilih --</option>                     
                    </select>
               </td>
		      </tr>
          <tr><td>Origin</td><td>      
                <?php 
                  $sql="SELECT
                                              kc.kode_jne
                                              , kc.nama
                                          FROM
                                              kecamatan AS kc
                                              INNER JOIN kota AS k 
                                                  ON (kc.kode_kota = k.kode_kota)
                                              INNER JOIN provinsi AS p 
                                                  ON (p.kode_provinsi = k.kode_provinsi)
                                          WHERE p.kode_provinsi IN ('9','6','10','11') LIMIT 2000";
                                        $query=mysqli_query($connect, $sql) or die ($sql);
                ?>  
                <select class="form-control" id="origin" name="origin">
                                       <option value="">-- pilih --</option>
                                        <?php 
                                        while(list($kode,$nama_origin)=mysqli_fetch_array($query)){
                                        ?>
                                       <option value="<?php echo $kode;?>"><?php echo $nama_origin."-".$kode; ?> </option>
                                     <?php } ?>     
                                    </select>
               </td>
          </tr>
		      <tr><td>Status</td><td> <select name="status" class="form-control">
		                           <option value=''>-- pilih --</option>
		                           <option value='1'>aktif</option>
								   <option value='0'>tidak aktif</option></select></td></tr>
        
          <tr><td colspan=2>
          <input type="hidden" name="jenis" value="tambahoutletkurir" />
          <input type="submit" value="Tambah" class="btn btn-success">
                           </td></tr>
          </table></form>