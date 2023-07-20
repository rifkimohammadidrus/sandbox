<?php
    include ('template/koneksi.php');
    $q = $_GET['term'];
    $sql = "SELECT * FROM member WHERE email LIKE '%$q%' limit 5";
    $query=mysqli_query($connect, $sql);
    while ($data = mysqli_fetch_array($query)){
            
            $row['value']    =$data['email'];
            $row['nama']    =$data['nama'];
            $row['alamat']    =$data['alamat'];
            $row_set[]        =$row;
    }
    echo json_encode($row_set);
    ?>

