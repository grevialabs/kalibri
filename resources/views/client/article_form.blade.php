<?php 
// ---------------------------
// Get data 
$data = NULL;
if (isset($get['article_id'])) {
	$api_url = $api_method = $api_param = $api_header = NULL;
	$api_param['token'] = env('API_KEY');
	$api_param['article_id'] = $get['article_id'];

	$api_url = env('API_URL').'article/get';
	$api_method = 'get';
	//$api_header['debug'] = 1;
	
	$data = curl_api_liquid($api_url, $api_method, $api_header, $api_param);

	if (! empty($data)) $data = json_decode($data,1);
}
// debug($data,1);

$base_url = base_url();

$list_site = NULL;
$api_url = $api_method = $api_param = $api_header = NULL;
$api_param['token'] = env('API_KEY');
$api_param['paging'] = false;

$api_url = env('API_URL').'site/get_list';
$api_method = 'get';
// $api_header['debug'] = 1;

$temp = curl_api_liquid($api_url, $api_method, $api_header, $api_param);

if (! empty($temp)) $temp = json_decode($temp,1);
$list_site = $temp['data'];


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

// $PAGE_TITLE = $action .' '. $articlelang['module']; 
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

					
					<!--
					<div class="row mb-3 align-items-center">
						<div class="col-lg-3 col-md-12">
							<span>Tooltip Input</span>
						</div>
						<div class="col-lg-6 col-lg-offset-3 col-md-12">
							<input type="text" data-toggle="tooltip" title="" class="form-control" id="validationDefault05" placeholder="Hover For tooltip" required="" data-original-title="A Tooltip for the input !">
						</div>
					</div>
					-->
					
				
					<?php if (isset($data['article_id'])) { ?>
					
					<!--
					<div class="col-lg-12 col-sm-12">
						<div class="md-form">
							<input type="text" id="article_id" class="form-control" value="{{ $data['article_id'] }}" disabled />
							<input type="hidden" name="article_id" value="{{ $data['article_id'] }}" />
							
							<label for="article_id" >Company ID</label>
						</div>
					</div>
					-->
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="article_id" class="control-label col-form-label">{!! $articlelang['article_id'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
							<input type="text" data-toggle="" title="" class="form-control" id="" placeholder="{{ $articlelang['article_id'] }}" required="" data-original-title="" value="{{ $data['article_id'] }}" disabled />
							<input type="hidden" name="article_id" value="{{ $data['article_id'] }}" />
						</div>
					</div>
					<?php } ?>
<!-- 					
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="site_id" class="control-label col-form-label">{!! $articlelang['site_id'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
							<input type="text" data-toggle="{{ $articlelang['site_id'] }}" title="{{ $articlelang['site_id'] }}" class="form-control" id="site_id" name="site_id" placeholder="{{ $articlelang['site_id'] }}" required="" data-original-title="" />
						</div>
					</div> -->
					
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="site_id" class="control-label col-form-label">{!! $articlelang['site_id'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
							
							<select class="select2 form-control custom-select" style="width: 100%; height:36px;" name="site_id" id="site_id">
							<?php 
							if (!empty($list_site)) {?>
								<option value="" /> {{ $lang['please_select'] }} </>
								<?php
								foreach ($list_site as $k => $rs) {
								?>
								<option value="{{ $rs['site_id']}}">{{ $rs['site_name'] . ' - ID ' . $rs['site_id']}}</option>
								<?php 
								} 
							}
							?>
							</select>
						</div>
					</div>
					
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="article" class="control-label col-form-label">{!! $articlelang['article'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
                            <!-- <input type="text" data-toggle="{{ $articlelang['article'] }}" title="{{ $articlelang['article'] }}" class="form-control" id="article" name="article" placeholder="{{ $articlelang['article'] }}" required="" data-original-title="" /> -->
							
                            <input type="text" title="{{ $articlelang['article'] }}" class="form-control" id="article" name="article" placeholder="{{ $articlelang['article'] }}" />
						</div>
					</div>
					
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="customer_article" class="control-label col-form-label">{!! $articlelang['customer_article'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
                            <input type="text" data-toggle="{{ $articlelang['customer_article'] }}" title="{{ $articlelang['customer_article'] }}" class="form-control" id="customer_article" name="customer_article" placeholder="{{ $articlelang['customer_article'] }}" required="" data-original-title="" />
						</div>
					</div>
					
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="description" class="control-label col-form-label">{!! $articlelang['description'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
                            <textarea type="text" data-toggle="{{ $articlelang['description'] }}" title="" class="form-control" id="description" name="description" placeholder="{{ $articlelang['description'] }}" required="" data-original-title="{{ $articlelang['description'] }}"></textarea>
						</div>
					</div>
					
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="uom" class="control-label col-form-label">{!! $articlelang['uom'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
							<input type="text" data-toggle="{{ $articlelang['uom'] }}" title="{{ $articlelang['uom'] }}" class="form-control" id="uom" name="uom" placeholder="{{ $articlelang['uom'] }}" required="" data-original-title="" />
						</div>
					</div>
					
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="conversion_value" class="control-label col-form-label">{!! $articlelang['conversion_value'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
                            <input type="number" data-toggle="{{ $articlelang['conversion_value'] }}" title="{{ $articlelang['conversion_value'] }}" class="form-control" id="conversion_value" name="conversion_value" placeholder="{{ $articlelang['conversion_value'] }}" required="" data-original-title="" />
						</div>
					</div>
					
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="safety_stock" class="control-label col-form-label">{!! $articlelang['safety_stock'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
                            <input type="number" data-toggle="{{ $articlelang['safety_stock'] }}" title="{{ $articlelang['safety_stock'] }}" class="form-control" id="safety_stock" name="safety_stock" placeholder="{{ $articlelang['safety_stock'] }}" required="" data-original-title="" />
						</div>
					</div>
					
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="column" class="control-label col-form-label">{!! $articlelang['column'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
                            <input type="text" data-toggle="{{ $articlelang['column'] }}" title="{{ $articlelang['column'] }}" class="form-control" id="column" name="column" placeholder="{{ $articlelang['column'] }}" required="" data-original-title="" />
						</div>
					</div>

					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="rack" class="control-label col-form-label">{!! $articlelang['rack'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
							<input type="text" data-toggle="{{ $articlelang['rack'] }}" title="{{ $articlelang['rack'] }}" class="form-control" id="rack" name="rack" placeholder="{{ $articlelang['rack'] }}" required="" data-original-title="" />
						</div>
					</div>
					
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="row" class="control-label col-form-label">{!! $articlelang['row'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
                            <input type="text" data-toggle="{{ $articlelang['row'] }}" title="{{ $articlelang['row'] }}" class="form-control" id="row" name="row" placeholder="{{ $articlelang['row'] }}" required="" data-original-title="" />
						</div>
					</div>
					
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="price" class="control-label col-form-label">{!! $articlelang['price'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">						
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text" id="pre-rupiah">IDR</span>
								</div>
								
								<input type="text" data-toggle="{{ $articlelang['price'] }}" title="{{ $articlelang['price'] }}" class="form-control money" id="price" name="price" placeholder="{{ $articlelang['price'] }}" required="" data-original-title="" />
							</div>
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