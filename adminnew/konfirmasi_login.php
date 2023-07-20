<?php 
ob_start();
session_start();

include("connect.php");

// function anti_injection($data){
//   $filter = mysqli_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
//   return $filter;
// }

// $username=anti_injection($_POST['username']);
// $password=anti_injection($_POST['pass']);

$username=$_POST['username'];
$password=$_POST['pass'];
$date=date('Y-m-d');
$sql="SELECT
    `ur`.`username`
    , `ur`.`password`
    , `ur`.`level_id`
    , `mr`.`nama`
    , `mr`.`nama_toko`
    , `mr`.`id_alias`
    -- , `mr`.`is_active`
    -- , `mr`.`is_verified`
    , `mr`.`end_date`
FROM
    `user_reseller` AS `ur`
    INNER JOIN `member_reseller` AS `mr` 
        ON (`ur`.`member_id` = `mr`.`id_alias`)
        WHERE ur.username='$username' AND ur.password='$password' AND mr.is_active=1 AND mr.is_verified=1";
        // WHERE ur.username='$username' AND ur.password='$password' AND mr.is_active=1 AND mr.is_verified=1 AND mr.end_date <= now()";


// $sql="SELECT username,password,level_id,nama,id_outlet FROM user WHERE username='$username' AND password='$password' AND status=1";
// $query=mysqli_query($connect,$sql) ;//or die ($sql);
// list($usercek,$password,$levelcek,$namauser,$otl)=mysqli_fetch_array($query);
$query=mysqli_query($connect,$sql) ;//or die ($sql);
list($usercek,$password,$levelcek,$namauser,$namatoko,$id_alias, $end_date)=mysqli_fetch_array($query);
if (($usercek<>'') and ($password<>'')) {
  if ($end_date <= $date) {
    // echo "Akun Expired, silahkan perpanjang masa aktifnya!";
  // }elseif ($is_verified !=1) {
  //   echo "Akun Belum di verifikasi!";
  echo "expired";
  }else{

    $_SESSION['namauser']     = $usercek;
    $_SESSION['namalengkap']  = $namauser;
    $_SESSION['nama_toko']    = $namatoko;
    $_SESSION['passuser']     = $password;
    $_SESSION['leveluser']    = $levelcek;
    $_SESSION['id_outlet']    = $id_alias;

    // echo ("<script> window.location.href='../toko-$namatoko-$id_alias'; </script>");
  
  
    // echo"berhasil";
    include('../template/encrypt.php');
    $id_encrypt=encrypt($_SESSION['id_outlet']);
    echo "toko-$namatoko-$id_encrypt";
  }
} else {
// echo'Email Atau Password yang anda masukan belum terdaftar';
echo 'gagal';
}

//echo"$email-$pwd";
?>