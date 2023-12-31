<!DOCTYPE html>
    <html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>Staff Only | User Login 1</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Preview page of Metronic Admin Theme #2 for " name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="assets//global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="assets//global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets//global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets//global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="assets//global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="assets//global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="assets//global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="assets//global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="assets//pages/css/login.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> </head>
    <!-- END HEAD -->
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
        $.post("konfirmasi_login.php",data,function(response){ 
            // // alert(response);
            // if (response.trim()=='berhasil'){
            //     //alert('login berhasil');
            //     document.location="index.php";
            // } else {
            // alert (response);
            // $('#username').val('');
            // $('#pass').val('');
            // }      
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
                var loc="../"+response;
                document.location=loc;
            }   
        }); 
        
    }
    }
    </script>

        <body class=" login">
            <!-- BEGIN LOGO -->
            <div class="logo">
                <a href="index.html">
                <!-- <img src="assets//pages/img/logo-big.png" alt="" /> --> 
                </a>
            </div>
            <!-- END LOGO -->
            <!-- BEGIN LOGIN -->
            <div class="content">
                <!-- BEGIN LOGIN FORM -->
                <form class="login-form"  method="post" id="f1">
                    <h3 class="form-title font-green">Staff Only</h3>
                    <div class="alert alert-danger display-hide">
                        <button class="close" data-close="alert"></button>
                        <span> Enter any username and password. </span>
                    </div>
                    <div class="form-group">
                        <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                        <label class="control-label visible-ie8 visible-ie9">Username</label>
                        <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" 
                        name="username" id="username" /> </div>
                    <div class="form-group">
                        <label class="control-label visible-ie8 visible-ie9">Password</label>
                        <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="pass"
                        id="pass" /> </div>
                    <div class="form-actions">
                        <button type="button" class="btn green uppercase" onclick="ex_proses()">Login</button>
                    </div>
                    
                    
                </form>
                <!-- END LOGIN FORM -->
            </div>
        <!--  <div class="copyright"> 2014 © Metronic. Admin Dashboard Template. </div> -->
            <!--[if lt IE 9]>
    <script src="assets//global/plugins/respond.min.js"></script>
    <script src="assets//global/plugins/excanvas.min.js"></script> 
    <script src="assets//global/plugins/ie8.fix.min.js"></script> 
    <![endif]-->
            <!-- BEGIN CORE PLUGINS -->
            <script src="assets//global/plugins/jquery.min.js" type="text/javascript"></script>
            <script src="assets//global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
            <script src="assets//global/plugins/js.cookie.min.js" type="text/javascript"></script>
            <script src="assets//global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
            <script src="assets//global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
            <script src="assets//global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
            <!-- END CORE PLUGINS -->
            <!-- BEGIN PAGE LEVEL PLUGINS -->
            <script src="assets//global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
            <script src="assets//global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
            <script src="assets//global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
            <!-- END PAGE LEVEL PLUGINS -->
            <!-- BEGIN THEME GLOBAL SCRIPTS -->
            <script src="assets//global/scripts/app.min.js" type="text/javascript"></script>
            <!-- END THEME GLOBAL SCRIPTS -->
            <!-- BEGIN PAGE LEVEL SCRIPTS -->
            <script src="assets//pages/scripts/login.min.js" type="text/javascript"></script>
            <!-- END PAGE LEVEL SCRIPTS -->
            <!-- BEGIN THEME LAYOUT SCRIPTS -->
            <!-- END THEME LAYOUT SCRIPTS -->
        
    </body>

</html>