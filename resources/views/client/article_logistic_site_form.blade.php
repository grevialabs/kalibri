<?php 
// ---------------------------
// Get data 
$data = NULL;
if (isset($get['article_logistic_site_id'])) {
	$api_url = $api_method = $api_param = $api_header = NULL;
	$api_param['token'] = env('API_KEY');
	$api_param['article_logistic_site_id'] = $get['article_logistic_site_id'];

	$api_url = env('API_URL').'article_logistic_site/get';
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

// $PAGE_TITLE = $action .' '. $article_logistic_site_lang['module']; 
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
				
				<form method="post" action="{{ $form_url }}" class="form-horizontal form_submit">

					<?php if (isset($data['article_logistic_site_id'])) { ?>
					
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="article_logistic_site_id" class="control-label col-form-label">{!! $article_logistic_site_lang['article_logistic_site_id'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
							<input type="text" data-toggle="" title="" class="form-control" id="" placeholder="{{ $article_logistic_site_lang['article_logistic_site_id'] }}" required="" data-original-title="" value="{{ $data['article_logistic_site_id'] }}" disabled />
							<input type="hidden" name="article_logistic_site_id" value="{{ $data['article_logistic_site_id'] }}" />
						</div>
					</div>
					<?php } ?>
					
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="site_id" class="control-label col-form-label">{!! $article_logistic_site_lang['site_id'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">							
                            <input type="text" data-toggle="{{ $article_logistic_site_lang['site_id'] }}" title="{{ $article_logistic_site_lang['site_id'] }}" class="form-control" id="site_id" name="site_id" placeholder="{{ $article_logistic_site_lang['site_id'] }}" required="" data-original-title="" />
						</div>
					</div>
					
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="outbound_delivery" class="control-label col-form-label">{!! $article_logistic_site_lang['outbound_delivery'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
                            <input type="text" data-toggle="{{ $article_logistic_site_lang['outbound_delivery'] }}" title="{{ $article_logistic_site_lang['outbound_delivery'] }}" class="form-control" id="outbound_delivery" name="outbound_delivery" placeholder="{{ $article_logistic_site_lang['outbound_delivery'] }}" required="" data-original-title="" />
						</div>
					</div>
										
					<div class="form-group row">
						<div class="col-sm-12">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<?php 
							if ($get['do'] == 'insert') {
							?>
							<!-- <button type="submit" class="btn btn-primary btn-md btn_submit btncreate">{{ $lang['save'] }}</button> -->
							<?php 
							} else if ($get['do'] == 'edit') {
							?>
							<!-- <button type="submit" class="btn btn-primary btn-md btn_submit btnupdate">{{ $lang['update'] }}</button> -->
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