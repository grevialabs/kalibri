<?php 
// ---------------------------
// Get data 
$data = NULL;
if (isset($get['prepack_bundling_detail_id'])) {
	$api_url = $api_method = $api_param = $api_header = NULL;
	$api_param['token'] = env('API_KEY');
	$api_param['prepack_bundling_detail_id'] = $get['prepack_bundling_detail_id'];

	$api_url = env('API_URL').'prepack_bundling_detail/get';
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

// $PAGE_TITLE = $action .' '. $prepack_bundling_detail_lang['module']; 
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

					<?php if (isset($data['prepack_bundling_detail_id'])) { ?>
					
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="prepack_bundling_detail_id" class="control-label col-form-label">{!! $prepack_bundling_detail_lang['prepack_bundling_detail_id'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
							<input type="text" data-toggle="" title="" class="form-control" id="" placeholder="{{ $prepack_bundling_detail_lang['prepack_bundling_detail_id'] }}" required="" data-original-title="" value="{{ $data['prepack_bundling_detail_id'] }}" disabled />
							<input type="hidden" name="prepack_bundling_detail_id" value="{{ $data['prepack_bundling_detail_id'] }}" />
						</div>
					</div>
					<?php } ?>
										
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="prepack_id" class="control-label col-form-label">{!! $prepack_bundling_detail_lang['prepack_id'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
                            <input type="text" data-toggle="{{ $prepack_bundling_detail_lang['prepack_id'] }}" title="{{ $prepack_bundling_detail_lang['prepack_id'] }}" class="form-control" id="prepack_id" name="prepack_id" placeholder="{{ $prepack_bundling_detail_lang['prepack_id'] }}" required="" data-original-title="" />
						</div>
					</div>
										
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="outbound_delivery" class="control-label col-form-label">{!! $prepack_bundling_detail_lang['outbound_delivery'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
                            <input type="text" data-toggle="{{ $prepack_bundling_detail_lang['outbound_delivery'] }}" title="{{ $prepack_bundling_detail_lang['outbound_delivery'] }}" class="form-control" id="outbound_delivery" name="outbound_delivery" placeholder="{{ $prepack_bundling_detail_lang['outbound_delivery'] }}" required="" data-original-title="" />
						</div>
					</div>
										
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="article" class="control-label col-form-label">{!! $prepack_bundling_detail_lang['article'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
                            <input type="text" data-toggle="{{ $prepack_bundling_detail_lang['article'] }}" title="{{ $prepack_bundling_detail_lang['article'] }}" class="form-control" id="article" name="article" placeholder="{{ $prepack_bundling_detail_lang['article'] }}" required="" data-original-title="" />
						</div>
					</div>
										
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="line_id" class="control-label col-form-label">{!! $prepack_bundling_detail_lang['line_id'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
                            <input type="text" data-toggle="{{ $prepack_bundling_detail_lang['line_id'] }}" title="{{ $prepack_bundling_detail_lang['line_id'] }}" class="form-control" id="line_id" name="line_id" placeholder="{{ $prepack_bundling_detail_lang['line_id'] }}" required="" data-original-title="" />
						</div>
					</div>
										
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="qty_dashboard" class="control-label col-form-label">{!! $prepack_bundling_detail_lang['qty_dashboard'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
                            <input type="text" data-toggle="{{ $prepack_bundling_detail_lang['qty_dashboard'] }}" title="{{ $prepack_bundling_detail_lang['qty_dashboard'] }}" class="form-control" id="qty_dashboard" name="qty_dashboard" placeholder="{{ $prepack_bundling_detail_lang['qty_dashboard'] }}" required="" data-original-title="" />
						</div>
					</div>
										
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="reference" class="control-label col-form-label">{!! $prepack_bundling_detail_lang['reference'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
                            <input type="text" data-toggle="{{ $prepack_bundling_detail_lang['reference'] }}" title="{{ $prepack_bundling_detail_lang['reference'] }}" class="form-control" id="reference" name="reference" placeholder="{{ $prepack_bundling_detail_lang['reference'] }}" required="" data-original-title="" />
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