<?php 
$jsv = time();
// $jsv = '21012019';
$themes = 'matrix';

if (! isset($PAGE_TITLE)) $PAGE_TITLE = 'Admin dashboard';
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../public/matrix/assets/images/favicon.png?{{ $jsv }}">
    <title>{{ $PAGE_TITLE }}</title>
    <!-- Custom CSS -->
	
	<link rel="stylesheet" type="text/css" href="../public/matrix/assets/libs/select2/dist/css/select2.min.css?{{ $jsv }}">
	
	<link rel="stylesheet" type="text/css" href="../public/css/bootstrap-toggle.2.2.2.min.css?{{ $jsv }}">
	<link rel="stylesheet" type="text/css" href="../public/matrix/assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css?{{ $jsv }}">

	<link href="<?php echo URL::to('/');?>/public/css/style_default.css?{{ $jsv }}" rel="stylesheet">
    <link href="../public/matrix/dist/css/style.min.css?{{ $jsv }}" rel="stylesheet">
	
	<!-- START OWN CUSTOM STYLE-->
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css?{{ $jsv }}">
	<!-- Bootstrap core CSS 
	<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css?{{ $jsv }}" rel="stylesheet">
	-->
	<!-- Material Design Bootstrap 
	<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.9/css/mdb.min.css?{{ $jsv }}" rel="stylesheet">
	-->
	
	
	<script src="../public/matrix/assets/libs/jquery/dist/jquery.min.js?{{ $jsv }}"></script>
	<!-- CONFLICT BRO
	<!-- JQuery -->
	<!-- Bootstrap tooltips -->
	<!-- Bootstrap core JavaScript -->
	<!--
	COMMENT SEMENTARA
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.13.0/umd/popper.min.js?{{ $jsv }}"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js?{{ $jsv }}"></script>
	
	-->
	
	<!-- CONFLICT BRO
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js?{{ $jsv }}"></script>
	-->
	<!-- END OWN CUSTOM STYLE-->
	
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
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
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        
		@include('template.' . $themes . '.sidemenu')
		
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title text-capitalize">{{ $PAGE_TITLE }}</h4>
                        <div class="ml-auto text-right">
                            <!-- <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Library</li>
                                </ol>
                            </nav> -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
				<div>
					{!! $CONTENT !!}
				</div>
				
				<!--
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Full Width</h5>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                            </div>
                        </div>
                    </div>
                </div>
				-->
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center">
                All Rights Reserved by Matrix-admin. Designed and Developed by <a href="https://wrappixel.com">WrapPixel</a>.
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    
    <!-- Bootstrap tether Core JavaScript -->
    <script type="text/javascript" src="../public/matrix/assets/libs/popper.js/dist/umd/popper.min.js?{{ $jsv }}"></script>
    <script type="text/javascript" src="../public/matrix/assets/libs/bootstrap/dist/js/bootstrap.min.js?{{ $jsv }}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script type="text/javascript" src="../public/matrix/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js?{{ $jsv }}"></script>
    <script type="text/javascript" src="../public/matrix/assets/extra-libs/sparkline/sparkline.js?{{ $jsv }}"></script>
    <!--Wave Effects -->
    <script type="text/javascript" src="../public/matrix/dist/js/waves.js?{{ $jsv }}"></script>
    <!--Menu sidebar -->
    <script type="text/javascript" src="../public/matrix/dist/js/sidebarmenu.js?{{ $jsv }}"></script>
    <!--Custom JavaScript -->
    <script type="text/javascript" src="../public/matrix/dist/js/custom.min.js?{{ $jsv }}"></script>
	
	
	<script type="text/javascript" src="../public/matrix/assets/libs/inputmask/dist/min/jquery.inputmask.bundle.min.js?{{ $jsv }}"></script>
	<script type="text/javascript" src="../public/js/jquery.maskMoney.min.js?{{ $jsv }}"></script>

    <script type="text/javascript" src="../public/matrix/dist/js/pages/mask/mask.init.js?{{ $jsv }}"></script>
    <script type="text/javascript" src="../public/matrix/assets/libs/select2/dist/js/select2.full.min.js?{{ $jsv }}"></script>
    <script type="text/javascript" src="../public/matrix/assets/libs/select2/dist/js/select2.min.js?{{ $jsv }}"></script>
    <script type="text/javascript" src="../public/matrix/assets/libs/jquery-asColor/dist/jquery-asColor.min.js?{{ $jsv }}"></script>
    <script type="text/javascript" src="../public/matrix/assets/libs/jquery-asGradient/dist/jquery-asGradient.js?{{ $jsv }}"></script>
    <script type="text/javascript" src="../public/matrix/assets/libs/jquery-asColorPicker/dist/jquery-asColorPicker.min.js?{{ $jsv }}"></script>
    <script type="text/javascript" src="../public/matrix/assets/libs/jquery-minicolors/jquery.minicolors.min.js?{{ $jsv }}"></script>
    <script type="text/javascript" src="../public/matrix/assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js?{{ $jsv }}"></script>
	<script type="text/javascript" src="../public/js/jquery.shiftcheckbox.js"></script>
	
	<script type="text/javascript" src="../public/js/bootstrap-toggle.2.2.2.min.js?{{ $jsv }}"></script>
	
	<script>
	$(document).ready(function(){
		
		// $(".form_submit").submit(function(e){
			// // call blocker from footer 
			// modal_loading_block();
		// });

	<?php 
	// Activate menu on sidebar if uri segment 1 & 2 exist
	if (Request::segment(1) && Request::segment(2)) { 
	?>
			$('#{{ Request::segment(1)."_".Request::segment(2) }}').parent('li').addClass('selected')
	<?php 
	}
	?>
		// minify menu active
		// $('.sidebartoggler').click();
		
		// $('.datetimepicker').datetimepicker();
		
		$(".numeric").keypress(function(e){
			if (e.which != 8 && e.which != 13 && e.which != 0 && (e.which < 48 || e.which > 57)) {
				return false;
			}
		});

	
	});
	
    // For select 2
	$(".select2").select2();
	
	// Datepicker
	jQuery('.datepicker').datepicker();
	jQuery('.datepicker-autoclose').datepicker({
		autoclose: true,
		todayHighlight: true
	});

	// Shift checkbox
	$('.parentcheckbox').shiftcheckbox({
		checkboxSelector : ':checkbox',
		//selectAll        : $('.chkbox '),
		ignoreClick      : 'a',
	});
	
	// Block button inside form
	$('.btn_submit').css('width','150');
	$(".form_submit").submit(function(e){
		
		$('.btn_submit').attr('disabled','true');
		$('.btn_submit').html('<i class="fa fa-spinner fa-spin"></i>');
	});
	
	// money format
	$('.money').maskMoney({precision:0, thousand:',',allowNegative: false});

	// $('.btnview').hide(); // no access for view data
	// $('.btninsert').hide(); // no access for save data
	// $('.btnedit').hide(); // no access for edit data	
	// $('.btndelete').hide(); // no access for delete data
	
	</script>
	
	<!-- Start modal block -->
	<div id="modalLoading" class="modal fade" role="dialog" style="padding-top:200px;z-index:9999;background-color:rgba(0, 0, 0, 0.4)">
	  <div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
		  <div class="modal-body">
			<div class="talCnt" style="padding:25px 10px">
				<i class="fa fa-cog fa-spin fa-3x fa-fw"></i><br/>
				Mohon menunggu.
			</div>
		  </div>
		</div>

	  </div>
	</div>
	<!-- End modal block -->

	<script>
	function modal_loading_block()
	{
		$('#modalLoading').modal({
			show: 'false',
			keyboard: false,
			backdrop: 'static'
		});
	}
	</script>

	
</body>

<script>
<!-- Basic function -->

function togglebox(){
	if ($('.togglebox').prop('checked')) {
		$('.chkbox').prop('checked',true);
	}
	if (!$('.togglebox').prop('checked')) {
		$('.chkbox').prop('checked',false);
	}
}

function resubmit(target, obj){
	var url = obj.value;
	window.location = target + url;
}

$('#group_action').hide();
$('.chkbox').click(function(){
	var count = $("[type='checkbox']:checked").length;
	if (count >= 1) {
		 $('#group_action').show();
	} else if(count <= 0){
		$('#group_action').hide();
	}
});

function doConfirm(str = 'delete') {
	if (str == 'delete') {
		str = 'Yakin menghapus data ini ?'
	} else 
		str = 'Yakin melakukan aksi ini ?'
	return confirm(str)
}

</script>

</html>