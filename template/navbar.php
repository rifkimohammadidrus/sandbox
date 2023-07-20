 <style>

body {
    min-height: 100vh;
}

.brand{
    text-align: center; padding-top:50px; margin-bottom:-10px;
}

.nav{
    width:100%;
    height:100px;
    background-color:#b75ae2;
    border-bottom: 5px solid #ff3eb2;
    border-bottom-left-radius:20px;
    border-bottom-right-radius:20px;

}
.nav-link{
    color:white !important; 
    text-align:right;
    font-family: 'Inter Tight', sans-serif; 
    color: #FFFFFF;
    font-weight: 300;
    font-size: 13px;
    text-transform: capitalize;

}
a.seller:link { text-decoration: none; color:white !important; }

a.seller:visited { text-decoration: none; color:white !important; }

a.seller:hover { text-decoration: none; color:white !important; }

a.seller:active { text-decoration: none; color:white !important; }
/* .btn-custom{
    background-color: #b75ae2; border-color: #b75ae2; color: #fff;
} */
/* .btn-custom:hover{
    color: #fff;
    background-color: #a748d2;
    border-color: #aa16ee;
} */
.nav-b{
 /* font-size:24px;  */
 float:left;
 /* font-family: 'Roboto', sans-serif; */
 text-transform: capitalize;
  color: white;
  font-size: 20px;
  font-family: Arial, Helvetica, sans-serif;
  font-weight: 500;
  margin-top:15px;

}
.img-logo{
    width:37px;
    height:37px;
    margin-right:5px;
    margin-top:15px;
}

.jarak{
    margin-right:8px
}

@media (max-width: 767px){
    .brand{
        padding-top:30px; margin-bottom:-70px;
    }
    
    .nav-b{
        float:none; font-size:18px; 
    }
    .nav-link{
      
        text-align:center;
        padding-bottom:5px;
    }
    .login-form{
        margin-top:-60px;
    }
    .nav{
        height:105px;
        border-bottom-left-radius:20px;
        border-bottom-right-radius:20px;
    }
    .img-logo{
        width:36px;
        height:36px;
        margin-right:10px;
    }
    img.biro{
        display:none;
    }
    img.wani{
        display:none;
    }
    img.rabbani{
        display:none;
    }
    a.toko{
        display:none;
    }
    .mob-name{
       margin-top:-25px;
       float:left;
       margin-left:12px;
    }
    .input-cari{
		padding: 7px; 
		padding-left: 10px;
		padding-left: 10px;
		border-radius:3px; 
		border-color: #FFFFFF; 
		border:0px; 
		margin-left: 5px;
		width: 73%;
		font-size: 12px;
	}
    img.rabbani-mob{
        width: 30px;height: 30.1px;
        margin-right:5px;
    }
    
    .login-font,.kelola{
        font-size:10px;
    }
    .top-nav{
        margin-bottom:10px; margin-top:-5px;
    }
    @media (max-width: 412px){
        .login-font{
            display:none;
        }
        .input-cari{
            padding: 7px; 
            padding-left: 10px;
            padding-left: 10px;
            border-radius:3px; 
            border-color: #FFFFFF; 
            border:0px; 
            margin-left: 5px;
            width: 70%;
            font-size: 12px;
        }
        .mob-name{
           
            margin-left:15px;
        }
        a.seller{
            float:right;
            margin-right:20px;
        }
        .top-nav{
            margin-bottom:5px; 
        }
    }
    
}
</style>
<body>
    
<?php // echo $kode_beli; //die;  ?>
<?php 
    
    $t="SELECT no_transaksi from pesan_detail where  no_transaksi='$kode_beli'";
    $qt=mysqli_query($connect,$t) or die ($t);
        $rowcount=mysqli_num_rows($qt);
    if ($nama_toko) { $link= 'toko-'.$nama_toko.'-'.$outlet;}else {  $link= ''; }
    ?>   
      <?php 
        if (isset($_POST['cari'])) {
            $cari=$_POST['cari'];
        }else {
            $cari='';
        }
    ?>
<div class='nav'>
    <div id="mobile" class="container nav-link">
        <div class="top-nav">
            <!-- <img class="nav-b img-logo" src="assets/images/logo/ico_logo_rabbani.png" alt="">
            <a class="nav-b" >Reseller Rabbani</a> -->
            <a href="https://wa.me/628112346165?text" class="seller"><font class="login-font">Hubungi Seller</font></a> &nbsp;&nbsp;&nbsp;					
            <a href="https://wa.me/628112346165?tex" class="seller"><font class="login-font">Gabung Reseller</font></a> &nbsp;&nbsp;&nbsp;
            <a href="https://member.rabbani.id/" class="seller"><font class="login-font">Gabung Member Digital</font></a> 
            <?php if (isset($_SESSION['id_outlet'])) { ?>
            &nbsp;&nbsp;&nbsp;<a href="adminnew/" class="seller kelola">Kelola Toko</a> &nbsp; <a href="adminnew/logout.php" class="seller kelola"> Logout </a>
            <?php
            } ?> 

        </div>
        <div>
            <a href="<?php echo $link; ?>"><img class="nav-b img-logo rabbani" src="assets/images/logo/ico_logo_rabbani.png" alt="rabbani"></a>
            <a href="<?php echo $link; ?>"><img class="nav-b img-logo biro" src="assets/images/logo/biro.png" alt="biro"></a>
            <a href="<?php echo $link; ?>"><img class="nav-b img-logo wani" src="assets/images/logo/wani.png" alt="wani"></a>
            <a class="nav-b toko" ><?php if ($nama_toko) { echo 'Biro ' .$nama_toko;} ?></a>
            
            <form action="produk.php" id="cari_produk" method="POST">
          
                <input type="hidden" name="id_outlet" value='<?= $id_outlet?>'>
                <input type="hidden" name="nama_toko" value='<?= $nama_toko?>'>
                <a href="<?php echo $link; ?>"><img class="rabbani-mob" src="assets/images/logo/ico_logo_rabbani.png" alt="rabbani" style="  "></a><input type="text" name="cari" id="cari"  class="input-cari place akunmobile jarak" placeholder="Cari Produk" value="<?php echo $cari ?>">
                <button class="button-cari akunmobile jarak"><i class="icon-search"></i></button>
                <a href="cart.php" class="jarak"><i class="icon-shopping-cart icon-13xx"></i>
                    <?php 
                    if( $rowcount!=''){ ?>
                    <span class='badge badge-warning' id='lblCartCount'><?php echo  $rowcount;?></span>
                    <?php 
                    }
                    ?>
                </a>
            </form>
        </div>
        <div class="mob-name">&nbsp;
        <a href="<?php echo $link; ?>" style="color:#fff">
        
            <i class="icon-home icon-13xx"></i>&nbsp;
        </a>


        &nbsp;<i class="icon-map-marker1">&nbsp;</i><span style="font-family: 'Roboto', sans-serif;  font-size: 10px;font-weight: 500;"> <?php if ($nama_toko) { echo 'Biro ' .$nama_toko;} ?></span>
        </div>
    </div>


</div>
