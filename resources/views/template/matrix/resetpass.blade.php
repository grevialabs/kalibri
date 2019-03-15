<?php 
// no use
// $base_url = base_url().'public/matrix/';
$form_url = base_url().'login';
// debug($form_url,1);

?>
<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./public/matrix/assets/images/favicon.png">
    <title>Matrix Template - Login Kalibri</title>
    <!-- Custom CSS -->
    <link href="./public/matrix/dist/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<style>
.bgRed{background: #e11c23 !important}
</style>
</head>

<body>
    <div class="main-wrapper">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center bgRed">
            <div class="auth-box bgRed border-top border-secondary">
                <div id="loginform">
                    <!--
					<div class="text-center p-t-20 p-b-20">
                        <span class="db"><img src="./public/matrix/assets/images/logo.png" alt="logo" /></span>
                    </div>
					-->
					
					@if (session('message'))
						{!! session('message') !!}
					@endif
					
                    <!-- Form -->
					<div align="center" class="text-light">
						<h2 class="">Reset password</h2>
						
						Reset password for email <?php if (isset($_GET['email'])) echo $_GET['email']  ?>
					</div>
                    <form class="form-horizontal m-t-20 form_submit" id="resetform" action="{{ current_full_url() }}" method="post" >
                        <div class="row p-b-30">
                            <div class="col-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-info text-white" id="basic-addon1"><i class="ti-user"></i></span>
                                    </div>
                                    <input type="password" class="form-control form-control-lg" name="new_password" placeholder="New Password" aria-label="New Password" aria-describedby="basic-addon1" required="">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-info text-white" id="basic-addon2"><i class="ti-pencil"></i></span>
                                    </div>
                                    <input type="password" class="form-control form-control-lg" name="confirm_new_password" placeholder="Confirm New Password" aria-label="Confirm New Password" aria-describedby="basic-addon1" required="">
									<input type="hidden" name="uri" value="{{ $_GET['uri'] or '' }}">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<input type="hidden" name="token" value="{{ $_GET['token'] }}">
									<input type="hidden" name="email" value="{{ $_GET['email'] or '' }}">
                                </div>
                            </div>
                        </div>
                        <div class="row border-top border-secondary">
                            <div class="col-12">
                                <div class="form-group" align="center">
                                    <div class="p-t-20">
                                        <!-- <button class="btn btn-info" id="to-recover" type="button"><i class="fa fa-lock m-r-5"></i> Lost password?</button> -->
                                        <button class="btn btn-success btn_submit" type="submit" name="btn_submit">Reset Password</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div id="recoverform">
                    <div class="text-center">
                        <span class="text-white">Enter your e-mail address below and we will send you instructions how to recover a password.</span>
                    </div>
                    <div class="row m-t-20">
                        <!-- Form -->
                        <form class="col-12" action="{{ base_url().'forgotpass'}}" method="post">
                            <!-- email -->
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-danger text-white" id="basic-addon1"><i class="ti-email"></i></span>
                                </div>
                                <input type="text" class="form-control form-control-lg" placeholder="Email Address" aria-label="Email" aria-describedby="basic-addon1" name="email">
                            </div>
                            <!-- pwd -->
                            <div class="row m-t-20 p-t-20 border-top border-secondary">
                                <div class="col-12">
                                    <a class="btn btn-success" href="#" id="to-login" name="action">Back To Login</a>
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button class="btn btn-info float-right" type="submit" name="action">Recover</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper scss in scafholding.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper scss in scafholding.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right Sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right Sidebar -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="./public/matrix/assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="./public/matrix/assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="./public/matrix/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <script>

    $('[data-toggle="tooltip"]').tooltip();
    $(".preloader").fadeOut();
    // ============================================================== 
    // Login and Recover Password 
    // ============================================================== 
    $('#to-recover').on("click", function() {
        $("#loginform").slideUp();
        $("#recoverform").fadeIn();
    });
    $('#to-login').click(function(){
        
        $("#recoverform").hide();
        $("#loginform").fadeIn();
    });
	
	$('.btn_submit').css('width','150');
	$(".form_submit").submit(function(e){
		
		$('.btn_submit').attr('disabled','true');
		$('.btn_submit').html('<i class="fa fa-spinner fa-spin"></i>');
	});

	
	// $('#resetform').submit(function(){
		// alert('kirim');
	// })
    </script>

</body>

</html>