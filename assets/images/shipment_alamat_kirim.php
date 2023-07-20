<?php
    session_start();
    $mail=$_SESSION[email];

    $kecamatan="24";
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $("p").hide();

        $(".tg").click(function(){
        $("p").toggle();
      });
    });
</script>
<?php 
$sql="SELECT nama,alamat,kodepos,hp,kode_provinsi,kode_kota,kode_kecamatan 
 FROM member where email='$_SESSION[email]'";
 
$sql="SELECT   `m`.`nama` , `m`.`alamat`   , `m`.`kodepos` , `m`.`hp` , `m`.`kode_provinsi` ,";
$sql.=" `m`.`kode_kota` , `m`.`kode_kecamatan` , `kt`.`nama_kota` , `p`.`nama_provinsi`, `kc`.`nama` AS kecamatan, kc.kode_jne ";
$sql.=" FROM  `member` AS `m`  LEFT JOIN `kota` AS `kt`     ON (`m`.`kode_kota` = `kt`.`kode_kota`) ";
$sql.=" LEFT JOIN `kecamatan` AS `kc`    ON (`m`.`kode_kecamatan` = `kc`.`kode_kecamatan`) ";
$sql.=" LEFT JOIN `provinsi` AS `p`  ON (`m`.`kode_provinsi` = `p`.`kode_provinsi`) ";
$sql.=" WHERE  m.email='$_SESSION[email]'";  
$query=mysql_query($sql);// or die ($sql);
echo "<!-- SQL $sql -->";
list($nama_member,$alamat,$kodepos,$hp,$kprov,$kkota,$kkec,$kota,$provinsi,$kecamatan,$destination)=mysql_fetch_array($query);
?>
<section id="content">
    <div class="content-wrap" style="padding: 0px !important">
        <div class="container clearfix" style="background-color: #fafafa; padding: 40px;">
             <h4 style="margin-bottom: 0px !important;"> <img src="images/icons/location.png" style="width:20px;"> Alamat Pengiriman </h4>
             <div class="row clearfix" style="background-color: #fafafa; padding: 25px;">
                <?php
                    $sql="SELECT     p.nama,p.telp,
                                        UPPER(prov.nama_provinsi) AS prov,
                                        UPPER(k.nama_kota) AS kota,
                                        UPPER(kec.nama_baru) AS kec,
                                        p.alamat,p.kode_post,p.utama,p.urut
                                FROM    alamat_pengiriman AS p
                                        INNER JOIN provinsi AS prov ON (prov.kode_provinsi=p.provinsi)
                                        INNER JOIN kota AS k ON (k.kode_kota=p.kota)
                                        INNER JOIN kecamatan AS kec ON (kec.kode_kecamatan=p.kecamatan)
                                WHERE   p.email='$mail' AND p.sts=1 AND p.utama=1
                                        ORDER BY p.utama DESC";
                    $query=mysql_query($sql);
                    list($nama_member,$hp,$sa_prov,$sa_kota,$sa_kec,
                        $sa_alamat,$kodepos,$sa_utama,$sa_urut)=mysql_fetch_array($query);
                ?>
                <div class="col-md-12 clearfix">
                    <strong><?php echo $nama_member." (".$hp." )";?></strong>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <?php echo $alamat.", ";?>
                    <?php echo $kota."-".$kec.", ";?>
                    <?php echo $prov.", ID ".$kodepos;?>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="content">
    <div class="content-wrap" style="padding: 0px !important">
        <div class="container clearfix" style="background-color: #fafafa; padding: 40px;">
             <h4 style="margin-bottom: 0px !important;"> <img src="images/icons/location.png" style="width:20px;"> Alamat Pengiriman </h4>
             <div class="row clearfix" style="background-color: #fafafa; padding: 25px;">
                <?php
                    $sql_sa="SELECT     p.nama,p.telp,
                                        UPPER(prov.nama_provinsi) AS prov,
                                        UPPER(k.nama_kota) AS kota,
                                        UPPER(kec.nama_baru) AS kec,
                                        p.alamat,p.kode_post,p.utama,p.urut
                                FROM    alamat_pengiriman AS p
                                        INNER JOIN provinsi AS prov ON (prov.kode_provinsi=p.provinsi)
                                        INNER JOIN kota AS k ON (k.kode_kota=p.kota)
                                        INNER JOIN kecamatan AS kec ON (kec.kode_kecamatan=p.kecamatan)
                                WHERE   p.email='$mail' AND p.sts=1
                                        ORDER BY p.utama DESC";
                    $query_sa=mysql_query($sql_sa);
                    while (list($sa_nama,$sa_telp,$sa_prov,$sa_kota,$sa_kec,
                        $sa_alamat,$sa_post,$sa_utama,$sa_urut)=mysql_fetch_array($query_sa)) {
                ?>
                <div class="col-md-12 clearfix">
                    <input type="radio" name="almt" id="almt">
                    <strong><?php echo $sa_nama." (".$sa_telp." )";?></strong>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <?php echo $sa_alamat.", ";?>
                    <?php echo $sa_kota."-".$sa_kec.", ";?>
                    <?php echo $sa_prov.", ID ".$sa_post;?>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</section>