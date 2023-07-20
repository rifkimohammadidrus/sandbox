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
        // alert(response);
        if (response.trim()=='berhasil'){
            //alert('login berhasil');
            document.location="index.php";
        } else {
        alert (response);
        $('#username').val('');
        $('#pass').val('');
        }       
        }); 
        
    }
    }
    </script>
<style>
    body{
    margin-top:20px;
    background: #f6f9fc;
}
.account-block {
    padding: 0;
    background-image: url(https://bootdey.com/img/Content/bg1.jpg);
    background-repeat: no-repeat;
    background-size: cover;
    height: 100%;
    position: relative;
}
.account-block .overlay {
    -webkit-box-flex: 1;
    -ms-flex: 1;
    flex: 1;
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    background-color: rgba(0, 0, 0, 0.4);
}
.account-block .account-testimonial {
    text-align: center;
    color: #fff;
    position: absolute;
    margin: 0 auto;
    padding: 0 1.75rem;
    bottom: 3rem;
    left: 0;
    right: 0;
}

.text-theme {
    color: #5369f8 !important;
}

.btn-theme {
    background-color: #5369f8;
    border-color: #5369f8;
    color: #fff;
}
.login{
    background-color: #f6f9fc !important;
    top:30%;
    bottom:30%;
}
</style>
        <body class=" login">
            <!-- BEGIN LOGO -->
            <div class="logo">
                <a href="index.html">
                <!-- <img src="assets//pages/img/logo-big.png" alt="" /> --> 
                </a>
            </div>
            <!-- END LOGO -->
            <!-- BEGIN LOGIN -->
            <!-- <div class="content"> -->
                <!-- BEGIN LOGIN FORM -->
<div id="main-wrapper" class="container">
    <div class="row justify-content-center">
        <div class="col-xl-10">
            <div class="card border-0">
                <div class="card-body p-0">
                    <div class="row no-gutters">
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="mb-5">
                                    <h3 class="h4 font-weight-bold text-theme">Login</h3>
                                </div>

                                <h6 class="h5 mb-0">Welcome back!</h6>
                                <p class="text-muted mt-2 mb-5">Enter your email address and password to access admin panel.</p>

                                <form>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email address</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1">
                                    </div>
                                    <div class="form-group mb-5">
                                        <label for="exampleInputPassword1">Password</label>
                                        <input type="password" class="form-control" id="exampleInputPassword1">
                                    </div>
                                    <button type="submit" class="btn btn-theme">Login</button>
                                    <a href="#l" class="forgot-link float-right text-primary">Forgot password?</a>
                                </form>
                            </div>
                        </div>

                        <div class="col-lg-6 d-none d-lg-inline-block">
                            <div class="account-block rounded-right">
                                <div class="overlay rounded-right"></div>
                                <div class="account-testimonial">
                                    <h4 class=" mb-4">This  beautiful theme yours!</h4>
                                    <p class="lead ">"Best investment i made for a long time. Can only recommend it for other users."</p>
                                    <p>- Admin User</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- end card-body -->
            </div>
            <!-- end card -->


            <!-- end row -->

        </div>
        <!-- end col -->
    </div>
    <!-- Row -->
</div>
                <!-- END LOGIN FORM -->
            <!-- </div> -->
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