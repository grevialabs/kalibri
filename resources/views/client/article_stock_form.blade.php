<?php 
// ---------------------------
// Get data 
$data = NULL;
if (isset($get['site_id'])) {
	$api_url = $api_method = $api_param = $api_header = NULL;
	$api_param['token'] = env('API_KEY');
	$api_param['site_id'] = $get['site_id'];

	$api_url = env('API_URL').'article_stock/get';
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

// $PAGE_TITLE = $action .' '. $Article_stock_lang['module']; 

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

// $source = array('site_id', 'stock_qty', 'company_address', 'company_phone', 'company_pic', 'status', 'created_at', 'created_by','created_ip','updated_at','updated_by','updated_ip');
// $target = array('mantap' => 'gokil', 'stock_qty' => 'harusmasuknih');
// // $test = array('ayam','bebek');
// // $target = array('ayam' => 'goreng', 'kambing' => 'guling', 'semut' => 'rebus');
// $a = validate_column($source,$target);
// debug($a,1);
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
					
				
					<?php if (isset($data['site_id'])) { ?>
					
					<!--
					<div class="col-lg-12 col-sm-12">
						<div class="md-form">
							<input type="text" id="site_id" class="form-control" value="{{ $data['site_id'] }}" disabled />
							<input type="hidden" name="site_id" value="{{ $data['site_id'] }}" />
							
							<label for="site_id" >Company ID</label>
						</div>
					</div>
					-->
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="site_id" class="control-label col-form-label">{!! $Article_stock_lang['site_id'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
							<input type="text" data-toggle="" title="" class="form-control" id="" placeholder="{{ $Article_stock_lang['site_id'] }}" required="" data-original-title="" value="{{ $data['site_id'] }}" disabled />
							<input type="hidden" name="site_id" value="{{ $data['site_id'] }}" />
						</div>
					</div>
					<?php } ?>
					
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="article" class="control-label col-form-label">{!! $Article_stock_lang['article'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
							<input type="text" data-toggle="{{ $Article_stock_lang['article'] }}" title="{{ $Article_stock_lang['article'] }}" class="form-control" id="article" name="article" placeholder="{{ $Article_stock_lang['article'] }}" required="" data-original-title="" />
						</div>
					</div>
					
                    <div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="customer_article" class="control-label col-form-label">{!! $Article_stock_lang['customer_article'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
							<input type="text" data-toggle="{{ $Article_stock_lang['customer_article'] }}" title="{{ $Article_stock_lang['customer_article'] }}" class="form-control" id="customer_article" name="customer_article" placeholder="{{ $Article_stock_lang['customer_article'] }}" required="" data-original-title="" />
						</div>
					</div>
					
                    <div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="description" class="control-label col-form-label">{!! $Article_stock_lang['description'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
							<input type="text" data-toggle="{{ $Article_stock_lang['description'] }}" title="{{ $Article_stock_lang['description'] }}" class="form-control" id="description" name="description" placeholder="{{ $Article_stock_lang['description'] }}" required="" data-original-title="" />
						</div>
					</div>

					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="stock_qty" class="control-label col-form-label">{!! $Article_stock_lang['stock_qty'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
							<input type="text" data-toggle="{{ $Article_stock_lang['stock_qty'] }}" title="{{ $Article_stock_lang['stock_qty'] }}" class="form-control" id="stock_qty" name="stock_qty" placeholder="{{ $Article_stock_lang['stock_qty'] }}" required="" data-original-title="" />
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