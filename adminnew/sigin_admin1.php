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
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> </head>
    <!-- END HEAD -->
  
<style>

body {
    min-height: 100vh;
}

.form-control:not(select) {
    padding: 1.5rem 0.5rem;
}

select.form-control {
    height: 52px;
    padding-left: 0.5rem;
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
@media (max-width: 767px){
    .brand{
        padding-top:30px; margin-bottom:-70px;
    }
}
</style>
        <body>

<div class="container">
<h4 class="brand" >Reseller Rabbani</h4>
    <div class="row py-5 mt-4 align-items-center">
        <!-- For Demo Purpose -->
        
        <div class="col-md-5 pr-lg-5 mb-5 mb-md-0">
            <img src="https://bootstrapious.com/i/snippets/sn-registeration/illustration.svg" alt="" class="img-fluid mb-3 d-none d-md-block">
            
        </div>

        <!-- Registeration Form -->
        <div class="col-md-7 col-lg-6 ml-auto">
            <form class="login-form"  method="post" id="f1">
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
                        <button type="button" class="btn btn-info btn-block py-2" onclick="ex_proses()">Login</button>
                        <!-- <a href="#" class="btn btn-info btn-block py-2">
                            <span class="font-weight-bold" onclick="ex_proses()">Login</span>
                        </a> -->
                    </div>

                   

                   
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js" type="text/javascript"></script>
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
<script>// For Demo Purpose [Changing input group text on focus]
$(function () {
    $('input, select').on('focus', function () {
        $(this).parent().find('.input-group-text').css('border-color', '#80bdff');
    });
    $('input, select').on('blur', function () {
        $(this).parent().find('.input-group-text').css('border-color', '#ced4da');
    });
});
</script>
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
            document.location="../index.php";
        } else {
        alert (response);
        $('#username').val(user);
        $('#pass').val('');
        }       
        }); 
        
    }
    }
    </script>
    </body>

</html>