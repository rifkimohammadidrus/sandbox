<?php 
include"../connect.php";
//echo"okeeeeeeeee";
$jenis=$_GET['jenis'];
$pilih=$_POST['pilih'];
$nama_produk=$_POST['nama_produk'];
$status=$_POST['status'];
$kode=$_POST['kode_model'];
$sub=$_POST['sub_kategori'];
   
$class=$_POST['kelas'];
$arrival=$_POST['arrival'];
$selling=$_POST['selling'];
$gender=$_POST['gender'];
$kondisi=$_POST['kondisi'];
   
$harga=$_POST['harga'];
$deskripsi=$_POST['deskripsi'];
   
$subclass=$_POST['subclass'];
$updatedate=date('Y-m-d H:i:s');
$id=$_POST['id_data'];


if ($jenis=='update'){
// setting nama folder lokasi hasil upload 
 if ($pilih=='1')
 { $uploaddir ='../../images/katalog/kerudung/'; 
   $sub_path  ='/public_html/rabbani.co.id/images/katalog/kerudung';} else
 if ($pilih=='2')
 { $uploaddir ='../../images/katalog/gamis/';
   $sub_path  ='/public_html/rabbani.co.id/images/katalog/gamis'; } else
 if ($pilih=='3')
 { $uploaddir ='../../images/katalog/kastun/';
   $sub_path  ='/public_html/rabbani.co.id/images/katalog/kastun'; } else
 if ($pilih=='4')
 { $uploaddir ='../../images/katalog/kemko/';
   $sub_path  ='/public_html/rabbani.co.id/images/katalog/kemko'; } else
 if ($pilih=='5')
 { $uploaddir ='../../images/katalog/kerudunganak/';
   $sub_path  ='/public_html/rabbani.co.id/images/katalog/kerudunganak'; } else
 if ($pilih=='6')
 { $uploaddir ='../../images/katalog/kazko/';
   $sub_path  ='/public_html/rabbani.co.id/images/katalog/kazko'; } else
  if ($pilih=='7')
 { $uploaddir ='../../images/katalog/accesories/';
   $sub_path  ='/public_html/rabbani.co.id/images/katalog/accesories'; } else
 if ($pilih=='9')
 { $uploaddir ='../../images/katalog/kemkoanak/';
   $sub_path  ='/public_html/rabbani.co.id/images/katalog/kemkoanak'; } 
 if ($pilih=='10')
 { $uploaddir ='../../images/katalog/wedding/';
   $sub_path  ='/public_html/rabbani.co.id/images/katalog/wedding'; }
 if ($pilih=='12')
 { $uploaddir ='../../images/katalog/setelan_anak/';
   $sub_path  ='/public_html/rabbani.co.id/images/katalog/setelan_anak'; } 
  if ($pilih=='13')
 { $uploaddir ='../../images/katalog/tunik/';
   $sub_path  ='/public_html/rabbani.co.id/images/katalog/tunik'; }  
   if ($pilih=='14')
 { $uploaddir ='../../images/katalog/mukena/';
   $sub_path  ='/public_html/rabbani.co.id/images/katalog/mukena'; }        
   

 
// echo"$pilih";
 $tampil_file=substr($uploaddir,6);
 
// membaca nama file yang diupload
$fileName = $_FILES['userfile2']['name'];    
 
// nama file temporary yang akan disimpan di server
$tmpName  = $_FILES['userfile2']['tmp_name'];
 
// membaca ukuran file yang diupload
$fileSize = $_FILES['userfile2']['size'];
 
// membaca jenis file yang diupload
$fileType = $_FILES['userfile2']['type'];

/*include_once("fungsi_resize.php");
$postvars = array( "image_name"    => trim($fileName), "image_tmp"    => $tmpName, "image_size"    => $fileSize,
"image_max_width"    => 60, "image_max_height"   => 24, "filename" => $fileName);
$u=upload_resize_image($postvars);*/

$fileName=str_replace(" ","-",$fileName);

$fileName="2".$fileName;

//echo"nama file :".$fileName;

      
   
   if ($fileName!='2'){
	   
	$update_foto="file2='$tampil_file$fileName',";   
	}
   
   if (!empty($kode)){
   $statusinfo=1;
   } else {$statusinfo=0;}
   $sql="UPDATE  tbl_kitalog  SET        nama='$nama_produk',
                                         kode_model='$kode',
										 status='$status',
										 status_info='$statusinfo',
										 sub_kategori='$sub',
										 $update_foto
										 kategori_class='$class',
										 kategori_arrival='$arrival',
										 kategori_selling='$selling',
										 kategori_segmen='$gender',
										 kategori_kondisi='$kondisi',
										 deskripsi='$deskripsi',
										 harga='$harga',
										 subkategori_class='$subclass'
										 where id='$id' ";
   $query=mysql_query($sql) or die ($sql);
   if ($query){										 
    //echo $sql;
	 // menggabungkan nama folder dan nama file
     $uploadfile = $uploaddir . $fileName;

      // proses upload file ke folder 'data'
      if (move_uploaded_file($_FILES['userfile2']['tmp_name'], $uploadfile)) 
      {
        //echo "upload success<br>";
        //include"email/sent_mail.php";
      } else  {
        //echo "Fail to upload<br>";
      }

      /*if($u=='sukses') {//echo "gambar sukses diupload<br>";
	  }
      else exit($u); */
	  
	  echo"Update berhasil";
	
   /*echo"<script>document.location=\"../../dashboard.php?module=katalog&act=editkatalog&id=$id\";</script>";*/ 
   } else { echo "Update gagal";}
   
   
} else if ($jenis=='insert'){
	
    // setting nama folder lokasi hasil upload 
 if ($pilih=='1')
 { $uploaddir ='../../images/katalog/kerudung/'; 
   $sub_path  ='/public_html/rabbani.co.id/images/katalog/kerudung';} else
 if ($pilih=='2')
 { $uploaddir ='../../images/katalog/gamis/';
   $sub_path  ='/public_html/rabbani.co.id/images/katalog/gamis'; } else
 if ($pilih=='3')
 { $uploaddir ='../../images/katalog/kastun/';
   $sub_path  ='/public_html/rabbani.co.id/images/katalog/kastun'; } else
 if ($pilih=='4')
 { $uploaddir ='../../images/katalog/kemko/';
   $sub_path  ='/public_html/rabbani.co.id/images/katalog/kemko'; } else
 if ($pilih=='5')
 { $uploaddir ='../../images/katalog/kerudunganak/';
   $sub_path  ='/public_html/rabbani.co.id/images/katalog/kerudunganak'; } else
 if ($pilih=='6')
 { $uploaddir ='../../images/katalog/kazko/';
   $sub_path  ='/public_html/rabbani.co.id/images/katalog/kazko'; } else
  if ($pilih=='7')
 { $uploaddir ='../../images/katalog/accesories/';
   $sub_path  ='/public_html/rabbani.co.id/images/katalog/accesories'; } else
 if ($pilih=='9')
 { $uploaddir ='../../images/katalog/kemkoanak/';
   $sub_path  ='/public_html/rabbani.co.id/images/katalog/kemkoanak'; } 
 if ($pilih=='10')
 { $uploaddir ='../../images/katalog/wedding/';
   $sub_path  ='/public_html/rabbani.co.id/images/katalog/wedding'; }
 if ($pilih=='12')
 { $uploaddir ='../../images/katalog/setelan_anak/';
   $sub_path  ='/public_html/rabbani.co.id/images/katalog/setelan_anak'; } 
  if ($pilih=='13')
 { $uploaddir ='../../images/katalog/tunik/';
   $sub_path  ='/public_html/rabbani.co.id/images/katalog/tunik'; }  
   if ($pilih=='14')
 { $uploaddir ='../../images/katalog/mukena/';
   $sub_path  ='/public_html/rabbani.co.id/images/katalog/mukena'; }        
   

 //echo"$pilih";
 $tampil_file=substr($uploaddir,6);
 // membaca nama file yang diupload
 $fileName = $_FILES['userfile']['name'];    
 // nama file temporary yang akan disimpan di server
 $tmpName  = $_FILES['userfile']['tmp_name'];
 // membaca ukuran file yang diupload
 $fileSize = $_FILES['userfile']['size'];
 // membaca jenis file yang diupload
 $fileType = $_FILES['userfile']['type'];

 /*include_once("fungsi_resize.php");
$postvars = array( "image_name"    => trim($fileName), "image_tmp"    => $tmpName, "image_size"    => $fileSize,
"image_max_width"    => 60, "image_max_height"   => 24, "filename" => $fileName);
$u=upload_resize_image($postvars);*/

// untuk cek jika sebelumnya ada kode_model yg sama
$cek="select kode_model from tbl_kitalog where kode_model='$kode_model'"; 
$query_cek=mysql_query ($cek) or die ($cek);
list($cek_kode)=mysql_fetch_array($query_cek);

if (!empty($cek_kode))// jika kode model sudah ada
{
  $statusimage=1; // status image diisi 1 untuk download ulang ke POS gallery 
  $sql="update tbl_kitalog set status='0' where kode_model='$kode_model'";  // non aktifkan image lama
  $query=mysql_query ($sql) or die ($sql);
} else {
  $statusimage=0;
}

if ($kode_model==''){
$statusinfo=0; } else { $statusinfo=1;}

$namauser=$_SESSION['namauser'];

$fileName=str_replace(" ","-",$fileName); // jika nama file ada spasi
$sql="INSERT INTO tbl_kitalog (kategori,nama,file,note,status,updatedate,kode_model,status_info,info_date,status_image,
                               update_user,sub_kategori,file2,kategori_class,kategori_arrival,kategori_selling,
                               kategori_segmen,kategori_kondisi,bahan_dasar,deskripsi,harga,subkategori_class)
      VALUES ('$pilih','$nama_produk','$tampil_file$fileName','','$status','$updatedate','$kode','$statusinfo','$updatedate',
              '$statusimage','$namauser','$sub','$tampil_file$fileName','$class','$arrival','$selling',
              '$gender','$kondisi','','$deskripsi','$harga','$subclass')"; 
$query=mysql_query($sql) or die ($sql); 
//echo "data sukses diinput";
if ($query){  
     // menggabungkan nama folder dan nama file
     $uploadfile = $uploaddir.$fileName;
     // proses upload file ke folder 'data'
     if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) 
     {
          echo "sukses";
          //include"email/sent_mail.php";
     } else  {
          echo "gagal";
     }
}
/*(if($u='sukses') {echo "<canter>gambar sukses diupload</center><br>";}
else exit($u); 
*/  

/*echo"<script>document.location=\"../../dashboard.php?module=$module\";</script>"; 	*/
	
}
  


?>