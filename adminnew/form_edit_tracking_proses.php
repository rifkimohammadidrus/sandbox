 <?php 
    require_once("connect.php");
    $notrans=$_POST['nt'];
    $kodetrack=$_POST['kt'];

    // echo"$notrans-$kodetrack";
    $get="select `tracking` from tracking where id='$kodetrack'";
    $qget=mysqli_query($connect, $get);
    list($namaTracking)=mysqli_fetch_array($qget);

    $sql="update pesan set kode_track='$kodetrack' where no_transaksi='$notrans'";
    $query=mysqli_query($connect, $sql);
    if($query){
      echo "sukses-$namaTracking";
    } else {
      echo "gagal";
    }
                            
  ?>