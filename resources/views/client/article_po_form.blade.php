<?php 
// ---------------------------
// Get data 
$data = NULL;
if (isset($get['article_po_id'])) {
	$api_url = $api_method = $api_param = $api_header = NULL;
	$api_param['token'] = env('API_KEY');
	$api_param['article_po_id'] = $get['article_po_id'];

	$api_url = env('API_URL').'article_po/get';
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

// $PAGE_TITLE = $action .' '. $article_po_lang['module']; 

$list_site = $list_article = NULL;
$api_url = $api_url_article = $api_method = $api_param = $api_header = NULL;
$api_param['token'] = env('API_KEY');
$api_param['paging'] = false;

$api_url = env('API_URL').'site/get_list';
$api_url_article = env('API_URL').'article/get_list';
$api_method = 'get';
// $api_header['debug'] = 1;

$temp = curl_api_liquid($api_url, $api_method, $api_header, $api_param);
$temp_article = curl_api_liquid($api_url_article, $api_method, $api_header, $api_param);


if (! empty($temp)) $temp = json_decode($temp,1);
$list_site = $temp['data'];
if (! empty($temp_article)) $temp_article = json_decode($temp_article,1);
$list_article = $temp_article['data'];

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

// $source = array('article_po_id', 'customer_article', 'pic_address', 'po_created_date', 'pic_pic', 'status', 'created_at', 'created_by','created_ip','updated_at','updated_by','updated_ip');
// $target = array('mantap' => 'gokil', 'customer_article' => 'harusmasuknih');
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
				
				<form method="post" action="{{ $form_url }}" class="form-horizontal form_submit">

					
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
					
				
					<?php if (isset($data['article_po_id'])) { ?>
					
					<!--
					<div class="col-lg-12 col-sm-12">
						<div class="md-form">
							<input type="text" id="article_po_id" class="form-control" value="{{ $data['article_po_id'] }}" disabled />
							<input type="hidden" name="article_po_id" value="{{ $data['article_po_id'] }}" />
							
							<label for="article_po_id" >Company ID</label>
						</div>
					</div>
					-->
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="article_po_id" class="control-label col-form-label">{!! $article_po_lang['article_po_id'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
							<input type="text" data-toggle="" title="" class="form-control" id="" placeholder="{{ $article_po_lang['article_po_id'] }}" required="" data-original-title="" value="{{ $data['article_po_id'] }}" disabled />
							<input type="hidden" name="article_po_id" value="{{ $data['article_po_id'] }}" />
						</div>
					</div>
					<?php } ?>
					
                    <div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="site_id" class="control-label col-form-label">{!! $article_po_lang['site_id'] !!}</label>
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
							<label for="article" class="control-label col-form-label">{!! $article_po_lang['article'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
						<select class="select2 form-control custom-select" style="width: 100%; height:36px;" name="article" id="article">
							<?php 
							if (!empty($list_article)) {?>
								<option value="" /> {{ $lang['please_select'] }} </>
								<?php
								foreach ($list_article as $k => $rs) {
								?>
								<option value="{{ $rs['article']}}">{{ $rs['article'] . ' - ID ' . $rs['article_id']}}</option>
								<?php 
								} 
							}
							?>
							</select>
						</div>
					</div>
					
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="customer_article" class="control-label col-form-label">{!! $article_po_lang['customer_article'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
							<input type="text" data-toggle="{{ $article_po_lang['customer_article'] }}" title="{{ $article_po_lang['customer_article'] }}" class="form-control" id="customer_article" name="customer_article" placeholder="{{ $article_po_lang['customer_article'] }}" required="" data-original-title="" />
						</div>
					</div>
					
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="description" class="control-label col-form-label">{!! $article_po_lang['description'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
                            <input type="text" data-toggle="{{ $article_po_lang['description'] }}" title="{{ $article_po_lang['description'] }}" class="form-control" id="description" name="description" placeholder="{{ $article_po_lang['description'] }}" required="" data-original-title="" />
						</div>
					</div>
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="po_blanket_number" class="control-label col-form-label">{!! $article_po_lang['po_blanket_number'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
                            <input type="text" data-toggle="{{ $article_po_lang['po_blanket_number'] }}" title="{{ $article_po_lang['po_blanket_number'] }}" class="form-control" id="po_blanket_number" name="po_blanket_number" placeholder="{{ $article_po_lang['po_blanket_number'] }}" required="" data-original-title="" />
						</div>
					</div>
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="po_blanket_qty" class="control-label col-form-label">{!! $article_po_lang['po_blanket_qty'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
                            <input type="text" data-toggle="{{ $article_po_lang['po_blanket_qty'] }}" title="{{ $article_po_lang['po_blanket_qty'] }}" class="form-control numeric" id="po_blanket_qty" name="po_blanket_qty" placeholder="{{ $article_po_lang['po_blanket_qty'] }}" required="" data-original-title="" />
						</div>
					</div>
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="po_created_date" class="control-label col-form-label">{!! $article_po_lang['po_created_date'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
                            <input type="text" data-toggle="{{ $article_po_lang['po_created_date'] }}" title="{{ $article_po_lang['po_created_date'] }}" class="form-control" id="po_created_date" name="po_created_date" placeholder="{{ $article_po_lang['po_created_date'] }}" required="" data-original-title="" />
						</div>
					</div>
										
					<div class="form-group row">
						<div class="col-sm-12">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<?php 
							if ($get['do'] == 'insert') {
							?>
							<button type="submit" class="btn btn-primary btn-md btn_submit btncreate">{{ $lang['save'] }}</button>
							<?php 
							} else if ($get['do'] == 'edit') {
							?>
							<button type="submit" class="btn btn-primary btn-md btn_submit btnupdate">{{ $lang['update'] }}</button>
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