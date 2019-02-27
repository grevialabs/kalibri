<?php 
// ---------------------------
// Get data 
$data = NULL;
if (isset($get['article_po_history_id'])) { 
	$api_url = $api_method = $api_param = $api_header = NULL;
	$api_param['token'] = env('API_KEY');
	$api_param['article_po_history_id'] = $get['article_po_history_id'];

	$api_url = env('API_URL').'article_po_history/get';
	$api_method = 'get';
	// $api_header['debug'] = 1;
	
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

// $PAGE_TITLE = $action .' '. $article_po_history_lang['module']; 


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
				
					<?php if (isset($data['article_po_history_id'])) { ?>
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="article_po_history_id" class="control-label col-form-label">{!! $article_po_history_lang['article_po_history_id'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
							<input type="text" data-toggle="" title="" class="form-control" id="" placeholder="{{ $article_po_history_lang['article_po_history_id'] }}" required="" data-original-title="" value="{{ $data['article_po_history_id'] }}" disabled />
							<input type="hidden" name="article_po_history_id" value="{{ $data['article_po_history_id'] }}" />
						</div>
					</div>
					<?php } ?>
					
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="article_po_id" class="control-label col-form-label">{!! $article_po_history_lang['article_po_id'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
							<input type="text" data-toggle="{{ $article_po_history_lang['article_po_id'] }}" title="{{ $article_po_history_lang['article_po_id'] }}" class="form-control" id="article_po_id" name="article_po_id" placeholder="{{ $article_po_history_lang['article_po_id'] }}" required="" data-original-title="" />
						</div>
					</div>
					
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="po_usage_qty" class="control-label col-form-label">{!! $article_po_history_lang['po_usage_qty'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
                            <input type="text" data-toggle="{{ $article_po_history_lang['po_usage_qty'] }}" title="{{ $article_po_history_lang['po_usage_qty'] }}" class="form-control" id="po_usage_qty" name="po_usage_qty" placeholder="{{ $article_po_history_lang['po_usage_qty'] }}" required="" data-original-title="" />
						</div>
					</div>
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="po_remaining_qty" class="control-label col-form-label">{!! $article_po_history_lang['po_remaining_qty'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
                            <input type="text" data-toggle="{{ $article_po_history_lang['po_remaining_qty'] }}" title="{{ $article_po_history_lang['po_remaining_qty'] }}" class="form-control" id="po_remaining_qty" name="po_remaining_qty" placeholder="{{ $article_po_history_lang['po_remaining_qty'] }}" required="" data-original-title="" />
						</div>
					</div>
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="po_created_date" class="control-label col-form-label">{!! $article_po_history_lang['po_created_date'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
                            <input type="text" data-toggle="{{ $article_po_history_lang['po_created_date'] }}" title="{{ $article_po_history_lang['po_created_date'] }}" class="form-control numeric" id="po_created_date" name="po_created_date" placeholder="{{ $article_po_history_lang['po_created_date'] }}" required="" data-original-title="" />
						</div>
					</div>
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="status_in_out" class="control-label col-form-label">{!! $article_po_history_lang['status_in_out'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
                            <input type="text" data-toggle="{{ $article_po_history_lang['status_in_out'] }}" title="{{ $article_po_history_lang['status_in_out'] }}" class="form-control" id="status_in_out" name="status_in_out" placeholder="{{ $article_po_history_lang['status_in_out'] }}" required="" data-original-title="" />
						</div>
					</div>
										
					<div class="form-group row">
						<div class="col-sm-12">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<?php 
							if ($get['do'] == 'insert') {
							?>
							<button type="submit" class="btn btn-primary btn-md">{{ $lang['save'] }}</button>
							<?php 
							} else if ($get['do'] == 'edit') {
							?>
							<button type="submit" class="btn btn-primary btn-md">{{ $lang['update'] }}</button>
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
        ?>
	$('#{{ $key }}').val('{{$rs}}');
	$('#{{ $key }}').trigger('change');
	<?php 
        }
    }

    ?>
})
</script>