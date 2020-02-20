<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <link href="<?=base_url()?>images/logo_fav.ico"  type="image/ico" rel="icon" />
    <title>Administrator | AfricaNewsUpdate</title>
    
    <link href="<?=base_url()?>admin_lib/dist/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <input type="hidden" value="<?=base_url();?>" id="txtsite_url">

    <div class="main-wrapper">
        
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center bg-dark">
            <div class="auth-box bg-dark border-top border-secondary">
                <div id="loginform">
                    <div class="text-center p-t-10 p-b-10">
                        <span class="db"><img style="width: 200px" src="<?=base_url()?>images/logo-black.png" alt="RightFIndera Logo" /></span><br>
                        <p style="margin: 10px 0 -10px 0; color: #ddd; font-size: 20px;">ADMINISTRATOR</p>
                    </div>
                    <!-- Form -->
                    <form class="form-horizontal m-t-20 login_form" id="loginform" action="" autocomplete="off">
                        <div class="row p-b-20">
                            <div class="col-12">

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-warning text-white" id="basic-addon1"><i class="ti-user"></i></span>
                                    </div>
                                    <input type="text" name="username" class="form-control form-control-lg" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" required="">
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-warning text-white" id="basic-addon2"><i class="ti-pencil"></i></span>
                                    </div>
                                    <input type="password" name="pass" class="form-control form-control-lg" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" required="">
                                </div>

                            </div>
                        </div>

                        <div class="row border-top border-secondary">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="p-t-20">
                                        <button class="btn btn-block btn-lg btn-success cmd_login_admin" type="button">Login</button>
                                    </div>
                                </div>
                                <div class="alert alert-danger alert_msgs alert_msg"></div>
                            </div>
                        </div>
                    </form>
                </div>

                
            </div>
        </div>
        
    </div>

    <script src="<?=base_url()?>admin_lib/assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="<?=base_url()?>admin_lib/assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?=base_url()?>admin_lib/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?=base_url()?>js/jscripts.js"></script>

    <script>

    $('[data-toggle="tooltip"]').tooltip();
    $(".preloader").fadeOut();
    
    </script>

</body>

</html>