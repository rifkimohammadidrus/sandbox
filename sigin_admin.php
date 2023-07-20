<!DOCTYPE html>
    <html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>staff only | web reseller</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css2?family=Inter+Tight:wght@200&family=Roboto:ital,wght@0,300;0,400;1,100&display=swap" rel="stylesheet"> 
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> </head>
    <!-- END HEAD -->
  
<style>


.form-control:not(select) {
    padding: 1.5rem 0.5rem;
}

.form-control::placeholder {
    color: #ccc;
    font-weight: bold;
    font-size: 0.9rem;
}
.form-control:focus {
    box-shadow: none;
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
a:link { text-decoration: none; color:white !important; }

a:visited { text-decoration: none; color:white !important; }

a:hover { text-decoration: none; color:white !important; }

a:active { text-decoration: none; color:white !important; }
.btn-custom{
    background-color: #b75ae2; border-color: #b75ae2; color: #fff;
}
.btn-custom:hover{
    color: #fff;
    background-color: #a748d2;
    border-color: #aa16ee;
}
.nav-b{
 font-size:24px; float:left;
 font-family: 'Roboto', sans-serif;
}
.img-logo{
    width:50px;
    height:50px;
    margin-right:20px;
}
p.keterangan{
    color:#b75ae2; margin-top:-20px; margin-bottom:15px;
    font-size:12px;font-family: 'Roboto', sans-serif;
}
.login-font{
    margin-right:14px;
}

@media (max-width: 767px){
    .brand{
        padding-top:30px; margin-bottom:-70px;
    }
    /* .login-font{
        display:none;
    } */
    .nav-b{
        float:none; font-size:18px; 
        margin-bottom:10px;
    }
    .nav-link{
      
        text-align:center;
    }
    .login-form{
        margin-top:-60px;
    }
    .nav{
        height:100px;
        border-bottom-left-radius:20px;
        border-bottom-right-radius:20px;
    }
    .img-logo{
        width:40px;
        height:40px;
        margin-right:10px;
    }
    img.img-log{
        margin-top:28px;
        display: block;
        margin-left: auto;
        margin-right: auto;
        width:70%;
        height:70%
    }
    .login-form1{
        margin-top:-30px;
    }
    .nav-b::after{
        content: "\a";
        white-space: pre;
    }
    .login-font{
        font-size:10px;
        margin-right:5px;
    }
    
}
</style>
<body>
<div class='nav'>
    <div class="container nav-link">
        <img class="nav-b img-logo" src="assets/images/logo/ico_logo_rabbani.png" alt="">
        <a class="nav-b">Reseller Rabbani</a>
           
    <!-- </div>
    <div class="container nav-link"> -->
       
            <a href="https://reseller.rabbani.id/info/"><font class="login-font">Info</font></a>				
            <a href="https://wa.me/628112346165?text"><font class="login-font">Hubungi Seller</font></a>					
            <a href="https://wa.me/628112346165?tex"><font class="login-font">Gabung Reseller</font></a>
            <a href="https://member.rabbani.id/"><font class="login-font">Gabung Member Digital</font></a> 
            <!-- <?php if ($_SESSION['id_outlet']) { ?>
            &nbsp;&nbsp;&nbsp;<a href="http://reseller.rabbani.id/adminnew/"><font class="login-font">Kelola Toko</font></a>
            <?php
            } ?> --> 
    </div>
</div>
<div class="container login-form">

    <div class="row py-5 align-items-center">
        <!-- For Demo Purpose -->
        
        <div class="col-md-5 pr-lg-5 mb-5 mb-md-0">
            <img src="assets/images/login.png" alt="" class="img-log img-fluid mb-3 d-md-block">
            <!-- <img src="https://bootstrapious.com/i/snippets/sn-registeration/illustration.svg" alt="" class="img-fluid mb-3 d-none d-md-block"> -->
            
        </div>

        <!-- Registeration Form -->
        <div class="col-md-7 col-lg-6 ml-auto login-form1">
            <p class="keterangan">SILAHKAN LOGIN MENGGUNAKAN AKUN RPOS ANDA</p>
            <form class=""  method="post" id="f1">
                <div class="row">
                    <!-- User Name -->
                    <div class="input-group col-lg-12 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-user text-muted"></i>
                            </span>
                        </div>
                        <input id="username" type="text" name="username" placeholder="Username" class="form-control bg-white border-left-0 border-md">
                    </div>

               
                    <!-- Password -->
                    <div class="input-group col-lg-12 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-lock text-muted"></i>
                            </span>
                        </div>
                        <input id="pass" type="password" name="pass" placeholder="Password" class="form-control bg-white border-left-0 border-md">
                    </div>

                   
                    <!-- Submit Button -->
                    <div class="form-group col-lg-12 mx-auto mb-0">
                        <button type="button" class="btn  btn-block py-2 btn-custom"  onclick="ex_proses()">Login</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js" type="text/javascript"></script>
<script src="adminnew/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="adminnew/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="adminnew/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="adminnew/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="adminnew/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="adminnew/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="adminnew/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="adminnew/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
<script src="adminnew/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="adminnew/assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="adminnew/assets/pages/scripts/login.min.js" type="text/javascript"></script>

<script>
    function ex_proses(){
    var user=$("#username").val();
    var pass=$("#pass").val();

    if (user==''){
        alert('Silahkan isi username');
    } else if (pass==''){
        alert('Silahkan isi password');
    } else {
    //alert(user+'-'+pass);
    var data=$("#f1").serialize(); 
        $.post("adminnew/konfirmasi_login.php",data,function(response){ 
        // alert(response);
            if (response.trim()=='gagal'){
                //alert('login berhasil');
                alert ('Email Atau Password yang anda masukan belum terdaftar');
                $('#username').val(user);
                $('#pass').val('');
            } else if (response.trim()=='expired'){
                alert ('Akun Expired, silahkan perpanjang masa aktifnya!');
                $('#username').val(user);
                $('#pass').val('');
            } else{
                document.location=response;
            }     
        }); 
        
    }
    }
    </script>
    </body>

</html>