

<script src="../../libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script>    
    $(document).ready(function(){ 
      //$('#tglbayar').date 
    
     $("#datetimepicker1").datepicker({
           format: "yyyy-mm-dd",
         todayHighlight: true, 
         autoclose: true,
           })
     .attr("readonly", "readonly").css({"cursor":"pointer", "background":"white"});
     
      })    
     </script>
<?php 
include("../connect.php");

if($_POST['transfer']){//check transfer
          $datenow=date('Y-m-d H:i:s');
          $kode_pemesanan=$_POST['kode_pemesanan'];
          $bank=$_POST['bank'];
          $nama=$_POST['atasnama'];
          $rek=$_POST['no_rekening'];
          $jumlahuang=$_POST['jumlah_uang'];
          $jumlahuang=str_replace(",","",$jumlahuang);
          $bankasal=$_POST['bankasal'];
          $tglbayar=$_POST['tglbayar'];

          // echo"<script>alert('OK bro');</script>";
              
           $cek="select no_transaksi,tanggal from pesan where no_transaksi='$kode_pemesanan' and jenis_bayar='0' and email='$_SESSION[email]'";
           
           $cek="select id_bayar,date_format(tanggal,'%Y-%m-%d') tanggal from pesan_bayar where id_bayar='$kode_pemesanan' and jenis_bayar='0' and id_customer='$_SESSION[email]'";
           $qcek=mysqli_query($connect, $cek);// or die ($cek);  
           if(!$qcek){
              echo "Error 110";  
           }
           list($cek_notrans,$tanggal_pesan)=mysqli_fetch_array($qcek) ;
           
           include("datetime2.php");
           
           //echo $tanggal_pesan;
           $selisih_waktu=timeAgo($tanggal_pesan);
           //echo $selisih_waktu;
           
          
          // if ($selisih_waktu<=120){
           if($jumlahuang==$_POST['uang_asli']){    
                
                // cek no trans di tabel pembayaran
                $cek_pembayaran="select no_transaksi from pembayaran where no_transaksi='$kode_pemesanan'";
                $qcek_pembayaran=mysqli_query($connect, $cek_pembayaran);
                if(!$qcek_pembayaran){
                  echo "Error Code 130";
                }
                
                
                list($no_bayar)=mysqli_fetch_array($qcek_pembayaran);
                
                if ($no_bayar!=''){
                    echo"<script>alert('Pembayaran untuk kode pemesanan ini sudah di verifikasi');</script>";
                } else {
                
                /*
                $sql="update pesan set jenis_bayar='1' where no_transaksi='$kode_pemesanan'";
                $query=mysqli_query($connect, $sql)or die($sql);
                */
                $sql="update pesan_bayar set jenis_bayar='1' where id_bayar='$kode_pemesanan'";
                $query=mysqli_query($connect, $sql);//or die($sql);
                
                
                $sql="update pesan set jenis_bayar='1' where id_pesan_bayar='$kode_pemesanan'";
                $query=mysqli_query($connect, $sql);//or die($sql);
                
                if(!$query){
                   echo "Error Code 148"; 
                }
                  
                $sql="insert into pembayaran (no_transaksi,keterangan,kode_bank,no_transfer,no_rekening,uang,tanggal,bankasal,tanggal_transfer,tokens)
                    values ('$kode_pemesanan','1','$bank','$nama','$rek','$jumlahuang','$datenow','$bankasal','$tglbayar','$token')";
                $query=mysqli_query($connect, $sql);//
                if(!$query){
                   echo "Error code 155"; 
                }
                //or die($sql);
                
                 $sqlx="select nama_bank,rekening from bank where id_bank='$_POST[bank]'";
                 $queryx=mysqli_query($connect, $sqlx);
                 if(!$queryx){
                   echo "Error code 155"; 
                }
                 //or die($sqlx);
                 list($nambank,$rekning)=mysqli_fetch_array($queryx);
                  
                  if ($query){
                    // include_once"email_konfirmasi_FAI.php";
                     //include_once"email_konfirmasi_admin.php";
                     include_once("email_email_konfirmasi.php");
                     //echo $sql."<br><br>".$sqlx;
                     /*echo"<script>alert('Konfirmasi Pembayaran Sukses,silahkan lihat history belanja anda');</script>";
                     echo"<script>document.location=\"history-order\";</script>";*/
                  } else {
                     echo"<script>alert('Konfirmasi Pembayaran Gagal, silahkan dicoba sekali lagi');</script>";
                     echo"<script>document.location=\"../not_confirm_pusat.php\";</script>";
                  }
                   
                  /*echo"<script>alert('Konfirmasi Pembayaran Sukses,silahkan lihat history belanja anda');</script>";*/
                  echo"<script>document.location=\"../confirm_pusat.php\";</script>";
                   ?><?
                }
                
                }else{
                  echo"<script>alert('Maaf Pembayaran anda masukan tidak sesuai dengan jumlah transfer anda $jumlahuang==$_POST[uang_asli]) ');</script>";
                  echo"<script>document.location=\"../not_confirm_pusat.php\";</script>";
                } //if($_POST['jumlah_uang']>=$uang_asli)
           } else {
           // echo"<script>alert('MAAF BATAS WAKTU KONFIMASI ANDA SUDAH LEWAT DARI 48 JAM');</script>";
           //  echo"<script>document.location=\"../not_confirm_pusat.php\";</script>";
           // }
        } 


$kode=$_POST['id'];
$ambil="select kode_bank,total_transfer from pesan_bayar where id_bayar='$kode'";
$qambil=mysqli_query($connect, $ambil);;
list($banks,$total_transfer)=mysqli_fetch_array($qambil);
?>
<form method="post" id="f1" name="f1"  action="page/konfirmasi_admin.php">
          <table class="table table-bordered table-responsive table-striped">
          <tr><td>Kode Pemesanan</td>     <td>  <input type=text name='kode_pemesanan' id='kode_pemesanan' class="form-control" value="<?php echo $kode?>" readonly>
           </td></tr>
          <tr><td>Bank Pembayaran</td>
          <td> <select name="bank" id="bank" class="form-control" readonly>
                <?php 
                $sql="select id_bank,nama_bank,rekening from bank where status=1";
                $query=mysqli_query($connect, $sql);//or die($sql);
                if(!$query){
                   echo "Error Code 20";   
                 }
                      while(list($kode,$nama,$rek)=mysqli_fetch_array($query))
                      {
                        ?><option value="<?php echo $kode?>" <?php if ($banks==$kode){echo"selected";}?>>
                            <?php echo $nama." - no rek - ".$rek;?>
                          </option>
                <? }?>
                </select>

          </td></tr>
          <tr><td>Jumlah Transfer</td>     <td>   <input type=text name='jumlah_uang' id='jumlah_uang' size="50" class="form-control" value="<?php echo number_format($total_transfer,"0",".",",")?>" ></td></tr>
          <tr><td>Transfer dari  </td>     
              <td>
                 <select class="form-control" id="bankasal" name="bankasal">
                  <option value="">-- pilih --</option>
                   <?php 
                   $sql="select id,nama_bank from bank_asal where status=1 order by id ASC";
                   $query=mysqli_query($connect, $sql);// or die ($sql);
                   while(list($idbank,$bank_asal)=mysqli_fetch_array($query)){
                   ?>
                   <option value="<?php echo $idbank;?>">  <?php echo $bank_asal; ?> </option>
                   <?php } ?>
                  </select>
              </td>
          </tr>  
          <tr><td>Tanggal bayar</td><td>        
                <div class='input-group date' id='datetimepicker1'>
                        <input type="text" name="tglbayar" class="form-control" readonly id="tglbayar" value="<?php echo date('Y-m-d'); ?>" size="16" />
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                     <font color="#FF0000"> &nbsp;* wajib diisi sesuai tanggal transfer</font>
               </td>
          </tr>
          <tr><td>Rekening konsumen</td>     <td>   <input type="text" name="no_rekening" id="no_rekening" class="form-control" />
          <input type="hidden" name="uang_asli" value="<?php echo $total_transfer?>" id="uang_asli" /></td></tr>  
          <tr><td>Atas Nama</td>     <td>   <input type="text" name="atasnama"  id="atasnama" class="form-control"/></td></tr>
          <tr><td colspan=2>
       <!--   <input type="button" class="btn btn-danger btn-sm" style="text-transform:lowercase;" onclick="cek_notrans()" value="konfirmasi"> -->
         <input type="submit" class="btn btn-danger btn-sm" style="text-transform:lowercase;" name="transfer"  id="konfirmasi" onclick="return validasi_pembayaran()" value="konfirmasi" />
                           </td></tr>
          </table></form>
          <script src="jquery-3.1.1.min.js"></script>

<script>

 function validasi_pembayaran(){
  var kode=$("#kode_pemesanan").val();
  var tglbayar=$("#tglbayar").val();
  var bank=$("#bank").val();
  var bankasal=$("#bankasal").val();
  var rek=$("#no_rekening").val();
  var nama=$("#atasnama").val();
  // var uang=$("#jumlah_uang").val();
  //     uang=uang.replace(",","");
  
  // alert(kode);
  
  if (kode=='') {
    alert("Silahkan isi kode pemesanan");
    $("#kode_pemesanan").focus();
    return false;
  } else
  if (tglbayar=='') {
    alert("Silahkan isi tanggal transfer terlebih dahulu");
    $("#tglbayar").focus();
    return false;
  } else if (bank=='') {
    alert("Silahkan isi Bank Tujuan Transfer terlebih dahulu");
    $("#bank").focus();
    return false;
  } else if (bankasal=='') {
    alert("Silahkan isi Bank sumber transfer terlebih dahulu");
    $("#bankasal").focus();
    return false;
  } else if (rek=='') {
    alert("Silahkan isi Rekening terlebih dahulu");
    $("#rek").focus();
    return false;
  } else if (nama=='') {
    alert("Silahkan isi atas nama terlebih dahulu ");
    $("#nama").focus();
    return false;
  }
   return true;
}



 
</script>