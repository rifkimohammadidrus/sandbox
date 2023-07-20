<?php ob_start();
session_start();
include"../connect.php";
include"resize.php";

$email=$_POST['temp_id'];
$jenis_member=$_POST['jenis_member'];
$nama=$_POST['nama'];
$id_member=$_POST['id_member'];
$outlet=$_POST['outlet'];
$date=date('Y-m-d H:i:s');
$user_input=$_SESSION['namauser'];
$jenis=$_POST['jenis'];

if ($jenis=="editmember"){

      if($jenis_member!='014'){
        $cek="select id from customer where id='$id_member' and id_outlet='$outlet'";
        $qcek=mysqli_query($connect, $cek);
        list($ada_id)=mysqli_fetch_array($qcek);
      }

      if($ada_id==''){
        echo"tidak_terdaftar";
      } else {
          $sql="UPDATE member set id_customer='$id_member',
                                  id_level='$jenis_member',
                                  update_date='$user_input',
                                  update_user='$date'
                where email='$email' ";             
          //echo"okes";
          $query=mysqli_query($connect, $sql) or die ($sql);
          if($query){
             echo "member berhasil diedit";
           } else {
        	   echo"member gagal diedit";  
        	 }
      }
} 


?>