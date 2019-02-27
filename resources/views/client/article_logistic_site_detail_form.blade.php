<?php 
// ---------------------------
// Get data 
$data = NULL;
if (isset($get['article_logistic_site_detail_id'])) {
	$api_url = $api_method = $api_param = $api_header = NULL;
	$api_param['token'] = env('API_KEY');
	$api_param['article_logistic_site_detail_id'] = $get['article_logistic_site_detail_id'];

	$api_url = env('API_URL').'article_logistic_site_detail/get';
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

// $PAGE_TITLE = $action .' '. $article_logistic_site_detail_lang['module']; 
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

					<?php if (isset($data['article_logistic_site_detail_id'])) { ?>
					
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="article_logistic_site_detail_id" class="control-label col-form-label">{!! $article_logistic_site_detail_lang['article_logistic_site_detail_id'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
							<input type="text" data-toggle="" title="" class="form-control" id="" placeholder="{{ $article_logistic_site_detail_lang['article_logistic_site_detail_id'] }}" required="" data-original-title="" value="{{ $data['article_logistic_site_detail_id'] }}" disabled />
							<input type="hidden" name="article_logistic_site_detail_id" value="{{ $data['article_logistic_site_detail_id'] }}" />
						</div>
					</div>
					<?php } ?>
					
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="outbound_delivery" class="control-label col-form-label">{!! $article_logistic_site_detail_lang['outbound_delivery'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
                            <input type="text" data-toggle="{{ $article_logistic_site_detail_lang['outbound_delivery'] }}" title="{{ $article_logistic_site_detail_lang['outbound_delivery'] }}" class="form-control" id="outbound_delivery" name="outbound_delivery" placeholder="{{ $article_logistic_site_detail_lang['outbound_delivery'] }}" required="" data-original-title="" />
						</div>
					</div>
							
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="article" class="control-label col-form-label">{!! $article_logistic_site_detail_lang['article'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
                            <input type="text" data-toggle="{{ $article_logistic_site_detail_lang['article'] }}" title="{{ $article_logistic_site_detail_lang['article'] }}" class="form-control" id="article" name="article" placeholder="{{ $article_logistic_site_detail_lang['article'] }}" required="" data-original-title="" />
						</div>
					</div>
							
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="customer_article" class="control-label col-form-label">{!! $article_logistic_site_detail_lang['customer_article'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
                            <input type="text" data-toggle="{{ $article_logistic_site_detail_lang['customer_article'] }}" title="{{ $article_logistic_site_detail_lang['customer_article'] }}" class="form-control" id="customer_article" name="customer_article" placeholder="{{ $article_logistic_site_detail_lang['customer_article'] }}" required="" data-original-title="" />
						</div>
					</div>
							
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="description" class="control-label col-form-label">{!! $article_logistic_site_detail_lang['description'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
                            <input type="text" data-toggle="{{ $article_logistic_site_detail_lang['description'] }}" title="{{ $article_logistic_site_detail_lang['description'] }}" class="form-control" id="description" name="description" placeholder="{{ $article_logistic_site_detail_lang['description'] }}" required="" data-original-title="" />
						</div>
					</div>
							
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="qty_issue" class="control-label col-form-label">{!! $article_logistic_site_detail_lang['qty_issue'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
                            <input type="text" data-toggle="{{ $article_logistic_site_detail_lang['qty_issue'] }}" title="{{ $article_logistic_site_detail_lang['qty_issue'] }}" class="form-control" id="qty_issue" name="qty_issue" placeholder="{{ $article_logistic_site_detail_lang['qty_issue'] }}" required="" data-original-title="" />
						</div>
					</div>
							
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="conv_uom" class="control-label col-form-label">{!! $article_logistic_site_detail_lang['conv_uom'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
                            <input type="text" data-toggle="{{ $article_logistic_site_detail_lang['conv_uom'] }}" title="{{ $article_logistic_site_detail_lang['conv_uom'] }}" class="form-control" id="conv_uom" name="conv_uom" placeholder="{{ $article_logistic_site_detail_lang['conv_uom'] }}" required="" data-original-title="" />
						</div>
					</div>
							
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="qty_receive_actual" class="control-label col-form-label">{!! $article_logistic_site_detail_lang['qty_receive_actual'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
                            <input type="text" data-toggle="{{ $article_logistic_site_detail_lang['qty_receive_actual'] }}" title="{{ $article_logistic_site_detail_lang['qty_receive_actual'] }}" class="form-control" id="qty_receive_actual" name="qty_receive_actual" placeholder="{{ $article_logistic_site_detail_lang['qty_receive_actual'] }}" required="" data-original-title="" />
						</div>
					</div>
							
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="qty_receive" class="control-label col-form-label">{!! $article_logistic_site_detail_lang['qty_receive'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
                            <input type="text" data-toggle="{{ $article_logistic_site_detail_lang['qty_receive'] }}" title="{{ $article_logistic_site_detail_lang['qty_receive'] }}" class="form-control" id="qty_receive" name="qty_receive" placeholder="{{ $article_logistic_site_detail_lang['qty_receive'] }}" required="" data-original-title="" />
						</div>
					</div>
							
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="disc_minus" class="control-label col-form-label">{!! $article_logistic_site_detail_lang['disc_minus'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
                            <input type="text" data-toggle="{{ $article_logistic_site_detail_lang['disc_minus'] }}" title="{{ $article_logistic_site_detail_lang['disc_minus'] }}" class="form-control" id="disc_minus" name="disc_minus" placeholder="{{ $article_logistic_site_detail_lang['disc_minus'] }}" required="" data-original-title="" />
						</div>
					</div>
							
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="disc_plus" class="control-label col-form-label">{!! $article_logistic_site_detail_lang['disc_plus'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
                            <input type="text" data-toggle="{{ $article_logistic_site_detail_lang['disc_plus'] }}" title="{{ $article_logistic_site_detail_lang['disc_plus'] }}" class="form-control" id="disc_plus" name="disc_plus" placeholder="{{ $article_logistic_site_detail_lang['disc_plus'] }}" required="" data-original-title="" />
						</div>
					</div>
							
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="conversion_diff" class="control-label col-form-label">{!! $article_logistic_site_detail_lang['conversion_diff'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
                            <input type="text" data-toggle="{{ $article_logistic_site_detail_lang['conversion_diff'] }}" title="{{ $article_logistic_site_detail_lang['conversion_diff'] }}" class="form-control" id="conversion_diff" name="conversion_diff" placeholder="{{ $article_logistic_site_detail_lang['conversion_diff'] }}" required="" data-original-title="" />
						</div>
					</div>
							
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="dashboard_received_date" class="control-label col-form-label">{!! $article_logistic_site_detail_lang['dashboard_received_date'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
                            <input type="text" data-toggle="{{ $article_logistic_site_detail_lang['dashboard_received_date'] }}" title="{{ $article_logistic_site_detail_lang['dashboard_received_date'] }}" class="form-control" id="dashboard_received_date" name="dashboard_received_date" placeholder="{{ $article_logistic_site_detail_lang['dashboard_received_date'] }}" required="" data-original-title="" />
						</div>
					</div>
							
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="qty_chamber" class="control-label col-form-label">{!! $article_logistic_site_detail_lang['qty_chamber'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
                            <input type="text" data-toggle="{{ $article_logistic_site_detail_lang['qty_chamber'] }}" title="{{ $article_logistic_site_detail_lang['qty_chamber'] }}" class="form-control" id="qty_chamber" name="qty_chamber" placeholder="{{ $article_logistic_site_detail_lang['qty_chamber'] }}" required="" data-original-title="" />
						</div>
					</div>
							
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="chamber_disc_minus" class="control-label col-form-label">{!! $article_logistic_site_detail_lang['chamber_disc_minus'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
                            <input type="text" data-toggle="{{ $article_logistic_site_detail_lang['chamber_disc_minus'] }}" title="{{ $article_logistic_site_detail_lang['chamber_disc_minus'] }}" class="form-control" id="chamber_disc_minus" name="chamber_disc_minus" placeholder="{{ $article_logistic_site_detail_lang['chamber_disc_minus'] }}" required="" data-original-title="" />
						</div>
					</div>
							
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="chamber_disc_plus" class="control-label col-form-label">{!! $article_logistic_site_detail_lang['chamber_disc_plus'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
                            <input type="text" data-toggle="{{ $article_logistic_site_detail_lang['chamber_disc_plus'] }}" title="{{ $article_logistic_site_detail_lang['chamber_disc_plus'] }}" class="form-control" id="chamber_disc_plus" name="chamber_disc_plus" placeholder="{{ $article_logistic_site_detail_lang['chamber_disc_plus'] }}" required="" data-original-title="" />
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