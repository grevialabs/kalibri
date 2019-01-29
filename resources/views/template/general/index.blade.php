<?php 
$jsv = '21012019';

$base_url = 'http://localhost/grevia.com/';
?>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	
	<title>{{ $PAGE_TITLE }}</title>
	
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	
	<!-- Package1 Start -->
		<!-- Font Awesome -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css?{{ $jsv }}">
		<!-- Bootstrap core CSS -->
		<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css?{{ $jsv }}" rel="stylesheet">
		<!-- Material Design Bootstrap -->
		<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.9/css/mdb.min.css?{{ $jsv }}" rel="stylesheet">
		
		<link href="<?php echo URL::to('/');?>/public/css/style_default.css?{{ $jsv }}" rel="stylesheet">
		
		<!--
		Placeholder dulu, ga wajib pake
		<script type="text/javascript" src='<?php echo $base_url; ?>asset/js/jquery-ui-1.10.4.js'></script>
		<script type="text/javascript" src='<?php echo $base_url; ?>asset/js/jquery.validate.js'></script>
		<script type="text/javascript" src='<?php echo $base_url; ?>asset/js/ui/jquery.ui.core.js'></script>
		<script type="text/javascript" src='<?php echo $base_url; ?>asset/js/bootstrap.js'></script>
		
		-->
		
	<!-- Package1 End -->
	
</head>
<body>
	
	<div>@include('template.general.header')</div>

	<?php if (isset($BS_TEMPLATE) && $BS_TEMPLATE) { ?>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
	<?php } ?>
	
	<div>
		{!! $CONTENT !!}
	</div>
	
	<div>@include('template.general.footer')</div>
	
	<?php if (isset($BS_TEMPLATE) && $BS_TEMPLATE) { ?>
			</div>
		</div>
	</div>
	<?php } ?>
	<!-- Package1 Start (put on footer for fast rendering -->
		<!-- JQuery -->
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js?{{ $jsv }}"></script>
		<!-- Bootstrap tooltips -->
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.13.0/umd/popper.min.js?{{ $jsv }}"></script>
		<!-- Bootstrap core JavaScript -->
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js?{{ $jsv }}"></script>
		<!-- MDB core JavaScript -->
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.9/js/mdb.min.js?{{ $jsv }}"></script>
	<!-- Package1 End -->
</body>
<script>
function togglebox(){
	if ($('.togglebox').prop('checked')) {
		$('.chkbox').prop('checked',true);
	}
	if (!$('.togglebox').prop('checked')) {
		$('.chkbox').prop('checked',false);
	}
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

</script>
</html>