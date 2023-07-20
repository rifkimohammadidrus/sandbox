
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
                 url: 'page/proses_katalog.php?jenis=update',
                data:  formData,
                cache: false,
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

<form method=POST  onsubmit='return validasi2(this)' enctype="multipart/form-data" id="f1">
         <?php //include"editor.php";
		  include"../connect.php";
		  $id=$_POST['id'];
		  //echo"IDDDDDDDDDDD: $id";
		  $edit="SELECT  g.id,
		                            k.kode_model,
		                            g.name,
									k.nama,
									k.file,
									k.file2,
									k.status,                            
									k.updatedate,
									k.kategori_class,
									k.kategori_arrival,
									k.kategori_selling,
									k.kategori_segmen,
									k.kategori_kondisi,
									k.bahan_dasar,
									k.deskripsi,
									k.harga,
									k.subkategori_class,
									k.sub_kategori 
                            FROM tbl_kitalog as k,tbl_categories as g  
	                        where k.kategori=g.id and k.id='$id'";
			$query=mysqli_query($connect, $edit) or die ($edit);				
		 list($idkat,$kode,$kategori,$nama,$file,$file2,$status,$updatedate,$class,$arrival,$selling,$segmen,$kondisi,$bahan,$deskripsi,$harga,$subkategoriclass,$subkategori)=mysqli_fetch_array($query);
		 //echo $edit; 
		 ?>
          <table class="table table-bordered table-responsive table-striped">
        
		        <tr><td>Kategori</td><td>
                  <input type="hidden" name="pilih" value="<?php echo $idkat;?>" />
                  <input type="text" class="form-control" value="<?php echo $kategori;?>"> 
				</td></tr>
				<tr><td>Sub kategori</td><td>
				    <select name="sub_kategori" class="form-control">
					<option value="">--pilih--</option>
					<?php 
					//$sql="select id,sub_kategori from tbl_subkategori where status=1 and id_kategori='$idkat'";
					$sql="select id,sub_kategori from tbl_subkategori";
				    $query=mysqli_query($connect, $sql) or die ($sql);
					while(list($idsub,$subkategori)=mysqli_fetch_array($query)){	
					?>
					    <option value =<?php echo $idsub; ?> <?php if($subkategori==$idsub){echo"selected";}?>><?php echo $subkategori;?></option>
					<?php } ?>
					</select>
			    </td></tr>
                <tr><td>Kode Model </td>     <td>  <input type="text" name='kode_model' value='<?php echo $kode; ?>' 
                class="form-control"> </td></tr>
				<tr><td>Nama </td>     <td>  <input type="text" name='nama_produk' value='<?php echo $nama; ?>' class="form-control" > </td></tr>
			<!--	<tr><td>File image </td>     <td>  <img src='../<?php echo $file; ?>' width=250 > </td></tr> -->
                <tr><td>File image Baru </td><td><img src='../<?php echo $file2; ?>' width=250 alt="masih kosong" > </td></tr>
				
                <tr><td>Tanggal post</td>     <td> <?php echo $updatedate; ?></td></tr>
                <tr><td>File Image Baru</td>     <td><input type="file" name="userfile2"/></td></tr>
                <tr>
                <td colspan="2">
                  
                  <table class="table table-bordered table-responsive table-striped">
                    <tr><td colspan="2"><strong>** Optional Ketegori</strong></td></tr>
                    <tr>
                    <td>&nbsp;&nbsp;&nbsp;Kategori kelas</td><td>
                                               <select name="kelas" class="form-control">
                                                 <option value="">None</option>
												 <?php 
												 $sql="select id,nama from tbl_kategori_class where status=1";
												 $query=mysqli_query($connect, $sql) or die ($sql);
												 while(list($id1,$nama1)=mysqli_fetch_array($query)){
												 ?>
                                                 <option value="<?php echo $id1?>" 
												 <?php if ($id1==$class){ echo"selected=selected";} ?> >
												 <?php echo $nama1 ?></option>
                                                 <?php } ?>
                                               </select>
                                           </td>
                     </tr>
                     <tr>
                       <td>&nbsp;&nbsp;&nbsp;**** Sub Class</td>
                       <td>
                           <select name="subclass" id="subclass" class="form-control">
                             <option value="">-- pilih --</option>
                             <?php 
							 $sql="select id,nama from tbl_subkategori_class where id_class='$class'";
							 $query=mysqli_query($connect, $sql) or die ($sql);
							 while(list($idsubclass,$namasubclass)=mysqli_fetch_array($query)){
							 ?>
                               <option value="<?php echo $idsubclass?>" <?php if ($subkategoriclass==$idsubclass){ echo"selected";}?>><?php echo $namasubclass;?></option>
                             <?php }?> 
                           </select>
                       </td>
                     </Tr>
                     <tr>
                    <td>&nbsp;&nbsp;&nbsp;Kategori Arrival</td><td>
                                               <select name="arrival" class="form-control">
                                                 <option value="">None</option>
												 <?php 
												 $sql="select id,nama from tbl_kategori_arrival where status=1";
												 $query=mysqli_query($connect, $sql) or die ($sql);
												 while(list($id2,$nama2)=mysqli_fetch_array($query)){
												 ?>
                                                 <option value="<?php echo $id2?>" <?php if ($id2==$arrival)
												 { echo"selected=selected";} ?>>
												 <?php echo $nama2 ?></option>
                                                 <?php } ?>
                                               </select>
                                           </td>
                     </tr>
                     <tr>
                    <td>&nbsp;&nbsp;&nbsp;Kategori Best Selling</td><td>
                                               <select name="selling" class="form-control">
                                                 <option value="">None</option>
												 <?php 
												 $sql="select id,nama from tbl_kategori_selling where status=1";
												 $query=mysqli_query($connect, $sql) or die ($sql);
												 while(list($id3,$nama3)=mysqli_fetch_array($query)){
												 ?>
                                                 <option value="<?php echo $id3?>" <?php if ($id3==$selling)
												 { echo"selected=selected";} ?>>
												 <?php echo $nama3 ?></option>
                                                 <?php } ?>
                                               </select>
                                           </td>
                     </tr>
                     <tr>
                    <td>&nbsp;&nbsp;&nbsp;Kategori Segmen Gender</td><td>
                                               <select name="gender" class="form-control">
                                                 <option value="">None</option>
												 <?php 
												 $sql="select id,nama from tbl_kategori_segmen where status=1";
												 $query=mysqli_query($connect, $sql) or die ($sql);
												 while(list($id4,$nama4)=mysqli_fetch_array($query)){
												 ?>
                                                 <option value="<?php echo $id4?>" <?php if ($id4==$segmen)
												 { echo"selected=selected";} ?> ><?php echo $nama4 ?></option>
                                                 <?php } ?>
                                               </select>
                                           </td>
                     </tr>
                     <tr>
                     <td>&nbsp;&nbsp;&nbsp;Kategori Kondisi</td><td>
                                               <select name="kondisi" class="form-control">
                                                 <option value="">None</option>
												 <?php 
												 $sql="select id,nama from tbl_kategori_kondisi where status=1";
												 $query=mysqli_query($connect, $sql) or die ($sql);
												 while(list($id5,$nama5)=mysqli_fetch_array($query)){
												 ?>
                                                 <option value="<?php echo $id5?>" <?php if ($id5==$kondisi)
												 { echo"selected=selected";} ?> >
												 <?php echo $nama5 ?></option>
                                                 <?php } ?>
                                               </select>
                                           </td>
                     </tr>
                  </table>
                
                </td>
                </tr>
                <tr>
                  <td colspan="2">
                  <table>
                    <tr><td colspan="2"><strong>** Product Knowledge</strong><p></p></td></tr>
                    <tr><td>Harga</td><td><textarea name="harga" id="text-harga" rows="3" cols="100" class="form-control"><?php echo $harga; ?></textarea>
                          <script>CKEDITOR.replace('text-harga');</script></td></tr>
                    <tr><td>&nbsp;</td><td>&nbsp;</td></tr>
                    <tr><td valign="top">Deskripsi produk</td>
                    <td><textarea name="deskripsi" id="text-deskripsi" rows="3" cols="100" class="form-control"><?php echo $deskripsi;?></textarea>
                       <script>CKEDITOR.replace('text-deskripsi');</script> </td></tr>
                  </table>
                  </td>
                </tr>
		  
		   <tr><td><strong>Status terbit</strong></td><td> <select name='status' class="form-control"><option value=''>--pilih--</option>
                                           <?php if ($status==1){?> 
                                            <option value="1" selected="selected">Tampil</option>
											<option value="0">Tidak Tampil</option>
										  <?php } else {?>
                                            <option value="0" selected="selected">Tidak Tampil</option>
                                            <option value="1">Tampil</option>
                                          <?php } ?>
                                         </select></td></tr>
   <?php $id_data=$r[0]; ?>
          <tr><td colspan=2>
		                    <input type="hidden" name="id_data" value="<?php echo $id; ?>">
							<input type="submit" value="Update" class="btn btn-success">
                            <!-- <input type="button" value="Batal"  class="btn btn-success" onclick="self.history.back()"> -->
			   </td>
	      </tr>
          </table>
		  </form>