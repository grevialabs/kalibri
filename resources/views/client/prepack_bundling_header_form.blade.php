<?php 
// ---------------------------
// Get data 
$data = NULL;
if (isset($get['prepack_id'])) {
	$api_url = $api_method = $api_param = $api_header = NULL;
	$api_param['token'] = env('API_KEY');
	$api_param['prepack_id'] = $get['prepack_id'];

	$api_url = env('API_URL').'prepack_bundling_header/get';
	$api_method = 'get';
	//$api_header['debug'] = 1;
	
	$data = curl_api_liquid($api_url, $api_method, $api_header, $api_param);

	if (! empty($data)) $data = json_decode($data,1);
}
// debug($data,1);

$base_url = base_url();
// Insert log
// $postlog = NULL;
// $postlog['name'] = current_url();
// $postlog['url'] = current_url();
// $postlog['data'] = json_encode(array('name' => 'ujang'));
// $postlog['json'] = json_encode(array('name' => 'ujang'));
// $log = new GeneralModel();
// $log = $log->insert_log($postlog);
// debug($postlog,1);

// if ($get['do'] == 'insert') $action = $lang['add'];
// else if ($get['do'] == 'edit') $action = $lang['edit'];

// $PAGE_TITLE = $action .' '. $prepack_bundling_header_lang['module']; 
function validate_column($arrsource,$arrtarget) {
	
	if (empty($arrsource) || empty($arrtarget)) {
		return 'helper error: validate_column error parameter';
	}	
	
	$temp = NULL;
	foreach ($arrsource as $rs) {
		if (isset($arrtarget[$rs])) $temp[$rs] = $arrtarget[$rs];
	}
	
	return $temp;
}

?>

<!-- Article AREA -->
<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-body">
				<div class="card-title">
					<h3 class="b text-capitalize">{{ $PAGE_HEADER }}</h3>
				</div>
				
				<div><a href="{{ base_url().''.Request::segment(1).DS.Request::segment(2) }}" class="btn btn-info">{!! $lang['back_icon'] . ' ' . $lang['back'] !!}</a></div>{!! BR.BR !!}
				
				@if (session('message'))
					{!! session('message') !!}
				@endif
				
				<form method="post" action="{{ $form_url }}" class="form-horizontal">

					<?php if (isset($data['prepack_id'])) { ?>
					
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="prepack_id" class="control-label col-form-label">{!! $prepack_bundling_header_lang['prepack_id'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
							<input type="text" data-toggle="" title="" class="form-control" id="" placeholder="{{ $prepack_bundling_header_lang['prepack_id'] }}" required="" data-original-title="" value="{{ $data['prepack_id'] }}" disabled />
							<input type="hidden" name="prepack_id" value="{{ $data['prepack_id'] }}" />
						</div>
					</div>
					<?php } ?>
										
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="outbound_delivery" class="control-label col-form-label">{!! $prepack_bundling_header_lang['outbound_delivery'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
                            <input type="text" data-toggle="{{ $prepack_bundling_header_lang['outbound_delivery'] }}" title="{{ $prepack_bundling_header_lang['outbound_delivery'] }}" class="form-control" id="outbound_delivery" name="outbound_delivery" placeholder="{{ $prepack_bundling_header_lang['outbound_delivery'] }}" required="" data-original-title="" />
						</div>
					</div>
										
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="site_created_on" class="control-label col-form-label">{!! $prepack_bundling_header_lang['site_created_on'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
                            <input type="text" data-toggle="{{ $prepack_bundling_header_lang['site_created_on'] }}" title="{{ $prepack_bundling_header_lang['site_created_on'] }}" class="form-control" id="site_created_on" name="site_created_on" placeholder="{{ $prepack_bundling_header_lang['site_created_on'] }}" required="" data-original-title="" />
						</div>
					</div>
										
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="status_prepack" class="control-label col-form-label">{!! $prepack_bundling_header_lang['status_prepack'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
                            <input type="text" data-toggle="{{ $prepack_bundling_header_lang['status_prepack'] }}" title="{{ $prepack_bundling_header_lang['status_prepack'] }}" class="form-control" id="status_prepack" name="status_prepack" placeholder="{{ $prepack_bundling_header_lang['status_prepack'] }}" required="" data-original-title="" />
						</div>
					</div>
										
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="conv_uom" class="control-label col-form-label">{!! $prepack_bundling_header_lang['conv_uom'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
                            <input type="text" data-toggle="{{ $prepack_bundling_header_lang['conv_uom'] }}" title="{{ $prepack_bundling_header_lang['conv_uom'] }}" class="form-control" id="conv_uom" name="conv_uom" placeholder="{{ $prepack_bundling_header_lang['conv_uom'] }}" required="" data-original-title="" />
						</div>
					</div>
										
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="combine_qty" class="control-label col-form-label">{!! $prepack_bundling_header_lang['combine_qty'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
                            <input type="text" data-toggle="{{ $prepack_bundling_header_lang['combine_qty'] }}" title="{{ $prepack_bundling_header_lang['combine_qty'] }}" class="form-control" id="combine_qty" name="combine_qty" placeholder="{{ $prepack_bundling_header_lang['combine_qty'] }}" required="" data-original-title="" />
						</div>
					</div>
										
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="user_id" class="control-label col-form-label">{!! $prepack_bundling_header_lang['user_id'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
                            <input type="text" data-toggle="{{ $prepack_bundling_header_lang['user_id'] }}" title="{{ $prepack_bundling_header_lang['user_id'] }}" class="form-control" id="user_id" name="user_id" placeholder="{{ $prepack_bundling_header_lang['user_id'] }}" required="" data-original-title="" />
						</div>
					</div>
										
					<div class="form-group row">
						<div class="col-sm-12">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<?php 
							if ($get['do'] == 'insert') {
							?>
							<!-- <button type="submit" class="btn btn-primary btn-md">{{ $lang['save'] }}</button> -->
							<?php 
							} else if ($get['do'] == 'edit') {
							?>
							<!-- <button type="submit" class="btn btn-primary btn-md">{{ $lang['update'] }}</button> -->
							<?php 
							}
							?>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
$(document).ready( function() {
	
	<?php 
    if (! empty($data)) 
    {
        foreach ($data as $key => $rs) 
        { 
			if (isset($rs)) {
        ?>
	$('#{{ $key }}').val('{{ $rs }}');
	$('#{{ $key }}').trigger('change');
	<?php 
			}
		}
    }

    ?>
})
</script>