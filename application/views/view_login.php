<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Boighor CMS | Login</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?php echo base_url(); ?>images/favicon.png" rel="icon">

    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="dist/js/adminlte.js"></script>


    <style media="screen">

    .bg-login {
        <?php if (preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"])): ?>
        background-image: url("<?php echo base_url() ?>images/bg-background-mobile.jpg");
        background-position: center;
        height: 100%;
        <?php else: ?>
        background-image: url("<?php echo base_url() ?>images/bg-background.jpg");
        background-position: center;
        height: 100%;
        <?php endif; ?>
        background-repeat: no-repeat;
        background-size: cover;
    }

    .vertical-center {
        <?php if (preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"])): ?>
        top: 44%;
        <?php else: ?>
        top: 50%;
        <?php endif; ?>
        margin: 0;
        position: absolute;
        -ms-transform: translateY(-50%);
        transform: translateY(-50%);
    }

    .horizontal-center {
        margin: 0;
        position: absolute;
        left: 40%;
        -ms-transform: translateY(-50%);
        transform: translateY(-50%);
    }

    .box-shadow{
        /* box-shadow: 0px 0px 10px rgba(0,0,0,1); */
        -moz-box-shadow: 0px 1px 20px rgba(0, 0, 0, 0.5);
        -webkit-box-shadow: 0px 1px 20px rgba(0, 0, 0, .5);
        box-shadow: 0px 1px 20px rgba(0, 0, 0, 0.5);
    }
    .r-25 {
        border-radius: 25px;
    }
    .card-secondary.card-outline {
        border-top: 3px solid #1966ac;
    }
    .btn-secondary {
        color: #fff;
        background-color: #009de0;
        border-color: #09b2d8;
        box-shadow: none;
    }
    .btn-secondary:hover, .btn-secondary:focus, .btn-secondary:active, .btn-secondary.active, .open>.dropdown-toggle.btn-secondary {
        color: #fff;
        background-color: #007eb3;
        border-color: #007eb3; /*set the color you want here*/
    }
    </style>

</head>


<body class="hold-transition login-page bg-login pace-secondary">
    <div class="login-box vertical-center">
        <div class="card box-shadow card-outline card-secondary r-25">
            <div class="card-body login-card-body r-25">
                <div class="login-logo mb-2">
                    <a href="<?= base_url() ?>">
                        <img src="<?= base_url('images/bg-logo.svg') ?>" style="width: 60%;">
                    </a>
                </div>
                <small class="login-box-msg text-center">Enter your email and password to access Boighor</small>
                <form id="frm_login" class="mt-2" method="post">
                    <div class="input-group mb-3">
                        <input required id="txt_email" type="email" class="form-control" placeholder="username@email.com">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input required id="txt_password" type="password" class="form-control" placeholder="******">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <label id="red_text" class="text-center" style="color: red"></label>
                    <div class="row justify-content-center">
                        <div class="col-8">
                            <button id="btn_signin" type="submit" class="btn btn-secondary btn-block">
                                <span id="loader" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display:none"></span>
                                <b id="btn_signin_text">Sign In</b>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo base_url() ?>plugins/jquery/jquery.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url() ?>dist/js/adminlte.min.js"></script>

    <script type="text/javascript">


    $('#frm_login').on('submit', function(e) {
        e.preventDefault();

        var email = $("#txt_email").val();
        var password = $("#txt_password").val();

        $('#btn_signin_text').html('Signing in...');
        $('#loader').show()
        $('#btn_signin').attr('disabled', true);

        $.ajax({
            url: "<?= base_url('login/validateuser') ?>",
            type: "POST",
            data: {
                email: email,
                password : password
            },
            success: function(data){
                data = JSON.parse(data);
                // console.log(data);
                if(data['result']==1){
                    $("#red_text").css("color", "green");
                    $('#red_text').html('<i class="fas fa-check-circle"></i> Login Successful. Please Wait...');
                    document.location = data['referer'];
                } else {
                    $('#btn_signin_text').html('Sign in');
                    $('#loader').hide()
                    $('#btn_signin').attr('disabled', false);
                    $('#red_text').html('<i class="fas fa-exclamation-triangle"></i> Incorrect Credentials.');
                }
            },
            error: function() {
                $('#btn_signin_text').html('Sign in');
                $('#loader').hide()
                $('#btn_signin').attr('disabled', false);
                $('#red_text').text('Server Error. Report Developer.');
            }
        });
    });

    </script>

</body>
</html>
