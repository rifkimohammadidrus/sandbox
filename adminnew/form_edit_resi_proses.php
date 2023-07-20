 <?php 
    require_once("connect.php");
    $notrans=$_POST['nt'];
    $resi=$_POST['r'];

    // echo"$notrans-$resi";

    $sql="update pengiriman set no_resi='$resi' where no_transaksi='$notrans'";
    $query=mysqli_query($connect, $sql);
    if($query){
      echo "sukses-$resi";
    } else {
      echo "gagal";
    }
                            
  ?>