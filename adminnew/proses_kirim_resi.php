 <?php require_once("connect.php");
                              $email=$_POST['temp_email'];
                              $no_transaksi=$_POST['no_trans'];
                              $resi=$_POST['resi'];
                              $message="<strong>http://www.banibatuta.co.id</strong> <br>
                              =================================================================<br>
                              ";
                              $sql="SELECT p.no_transaksi,k.nama_kurir,kl.nama_layanan
                              FROM pengiriman AS p INNER JOIN kurir_layanan AS kl ON (p.kode_layanan = kl.id) 
                                                   INNER JOIN kurir AS k ON (k.id_kurir=kl.id_kurir)  
                              WHERE no_transaksi='$no_transaksi'";
                                  $query=mysqli_query($connect, $sql)or die($sql);
                                  list($transaksi,$layanan,$jenis)=mysqli_fetch_array($query);
                                  

                              $message="<b>Banibatuta Online shop</b><br>";
                              $message=$message."No Transaksi anda : $transaksi<br>
                              Layanan yang di gunakan :$layanan<br>
                              Jenis Layanan yang di gunakan:$jenis
                              <br><br>
                              <b>No Resi Anda :$_POST[resi]</b>";


                              $headers = "info@banibatuta.co.id";
                              $headers .= "Reply-to: batuta.rabbani@gmail.com.sg\r\n";
                              $headers .= "MIME-Version: 1.0\r\n";
                              $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
                              $kirim = @mail("$email", "No Resi Pengiriman https://www.banibatuta.co.id", $message, $headers);

                              $sql="update pengiriman set no_resi='$resi' where no_transaksi='$no_transaksi'";
                              $query=mysqli_query($connect, $sql)or die($sql);
                              //echo $sql;
                                     echo"No Resi berhasil dikirim ke email pemesan";
                                 
             ?>