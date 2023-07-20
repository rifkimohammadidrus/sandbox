<?php 
include"../connect.php";
include"resize.php";

if( isset($_POST['temp_id'])){
  $id=$_POST['temp_id'];
}
$kode=$_POST['kode'];
$nama=$_POST['nama'];
$kategori=$_POST['kategori'];
$bahan=$_POST['bahan'];
$desc=$_POST['desc'];
$berat=$_POST['berat'];
$date=date('Y-m-d H:i:s');
$jenis=$_POST['jenis'];
$status=$_POST['status'];
$tanggal_rilis=$_POST['tanggal_rilis'];


$fileName  = $_FILES['userfile']['name'];
$fileName2 = $_FILES['userfile2']['name'];
$fileName3 = $_FILES['userfile3']['name'];  	
$fileName4 = $_FILES['userfile4']['name'];
$fileThumb = $_FILES['userThumb']['name'];

$uploaddir ='../../assets/foto_produk/';
$uploaddirThumb ='../../assets/foto_produk/thumbnail/';

$uploadfile = $uploaddir . $fileName;
$uploadfile2 = $uploaddir . $fileName2;
$uploadfile3 = $uploaddir . $fileName3;
$uploadfile4 = $uploaddir . $fileName4;
// nama thumbnaik disamakan dengan gambar ke 1
$uploadfileThumb = $uploaddirThumb . $fileName;

move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile);
move_uploaded_file($_FILES['userfile2']['tmp_name'], $uploadfile2);
move_uploaded_file($_FILES['userfile3']['tmp_name'], $uploadfile3);
move_uploaded_file($_FILES['userfile4']['tmp_name'], $uploadfile4);
move_uploaded_file($_FILES['userThumb']['tmp_name'], $uploadfileThumb);

// if ($fileName!=""){
//   resizeImage(70, 70, "../../foto_produk/$fileName", 'jpg', "../../foto_produk/thumbnail/$fileName");
// }



if ($jenis=="tambahproduk"){
  
  $sql="INSERT INTO jenis_barang (kode_jenis,nama,kode_kategori,deskripsi,bahan_dasar,gambar1,gambar2,gambar3,gambar4,berat,release_date,update_date,status,headline)
        VALUES ('$kode','$nama','$kategori','$desc','$bahan','$fileName','$fileName2','$fileName3','$fileName4','$berat','$tanggal_rilis','$date','$status','')";
  //echo"okes";
  $query=mysqli_query($connect,$sql) or die ($sql);
  
  if($query){
	  
     echo "Produk berhasil ditambah";
   } else {
	   
	 echo"gagal input";  
	}
  
  
} else if ($jenis=="editproduk") {
   //echo"siapppppppppppp";

   if ($fileName!=''){
	   move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile);
        $sql="UPDATE jenis_barang
              SET gambar1 = '$fileName'
              WHERE kode_jenis = '$id'";
        //echo"okes";
        $query=mysqli_query($connect,$sql) or die ($sql);	
   }

   if ($fileName2!=''){
     move_uploaded_file($_FILES['userfile2']['tmp_name'], $uploadfile2);
        $sql="UPDATE jenis_barang
              SET gambar2 = '$fileName2'
              WHERE kode_jenis = '$id'";
         //echo"okes";
        $query=mysqli_query($connect,$sql) or die ($sql);  
   }

   if ($fileName3!=''){
     move_uploaded_file($_FILES['userfile3']['tmp_name'], $uploadfile3);
        $sql="UPDATE jenis_barang
              SET gambar3 = '$fileName3'
              WHERE kode_jenis = '$id'";
        //echo"okes";
        $query=mysqli_query($connect,$sql) or die ($sql);  
   }

   if ($fileName4!=''){
     move_uploaded_file($_FILES['userfile4']['tmp_name'], $uploadfile4);
        $sql="UPDATE jenis_barang
              SET gambar4 = '$fileName4'
              WHERE kode_jenis = '$id'";
      //echo"okes";
      $query=mysqli_query($connect,$sql) or die ($sql);  
   }

   if ($fileThumb!=''){
      unlink("$uploadfileThumb");
      move_uploaded_file($_FILES['userThumb']['tmp_name'], $uploadfileThumb);  
   }
   
   $sql="UPDATE jenis_barang
          SET kode_jenis = '$kode',
            nama = '$nama',
            kode_kategori = '$kategori',
            deskripsi = '$desc',
            bahan_dasar = '$bahan',
            berat = '$berat',
            release_date = '$tanggal_rilis',
            status = '$status'
          WHERE kode_jenis = '$id'";
  //echo"okes";
  $query=mysqli_query($connect,$sql) or die ($sql);
  
  if($query){
     echo "Update berhasil";
   } else {
	   
	 echo"gagal edit";  
  }
  
  	
}

?>