<?php 
// ---------------------------
// Get data 
$data = NULL;
if (isset($get['article_attribute_value_id'])) {
	$api_url = $api_method = $api_param = $api_header = NULL;
	$api_param['token'] = env('API_KEY');
	$api_param['article_attribute_value_id'] = $get['article_attribute_value_id'];

	$api_url = env('API_URL').'article_attribute_value/get';
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

// $PAGE_TITLE = $action .' '. $article_attribute_value_lang['module']; 
$list_article = NULL;
$list_article_attribute = NULL;
$api_url_article = $api_url_article_attribute = $api_method = $api_param = $api_header = NULL;
$api_param['token'] = env('API_KEY');
$api_param['paging'] = false;

$api_url_article = env('API_URL').'article/get_list';
$api_url_article_attribute = env('API_URL').'article_attribute/get_list';
$api_method = 'get';
// $api_header['debug'] = 1;

$temp_article = curl_api_liquid($api_url_article, $api_method, $api_header, $api_param);
$temp_article_attribute = curl_api_liquid($api_url_article_attribute, $api_method, $api_header, $api_param);

if (! empty($temp_article)) $temp_article = json_decode($temp_article,1);
$list_article = $temp_article['data'];


if (! empty($temp_article_attribute)) $temp_article_attribute = json_decode($temp_article_attribute,1);
$list_article_attribute = $temp_article_attribute['data'];


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

// $source = array('article_attribute_value_id', 'article_id', 'article_attribute_id', 'value', 'company_pic', 'status', 'created_at', 'created_by','created_ip','updated_at','updated_by','updated_ip');
// $target = array('mantap' => 'gokil', 'article_id' => 'harusmasuknih');
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
					
				
					<?php if (isset($data['article_attribute_value_id'])) { ?>
					
					<!--
					<div class="col-lg-12 col-sm-12">
						<div class="md-form">
							<input type="text" id="article_attribute_value_id" class="form-control" value="{{ $data['article_attribute_value_id'] }}" disabled />
							<input type="hidden" name="article_attribute_value_id" value="{{ $data['article_attribute_value_id'] }}" />
							
							<label for="article_attribute_value_id" >Company ID</label>
						</div>
					</div>
					-->
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="article_attribute_value_id" class="control-label col-form-label">{!! $article_attribute_value_lang['article_attribute_value_id'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
							<input type="text" data-toggle="" title="" class="form-control" id="" placeholder="{{ $article_attribute_value_lang['article_attribute_value_id'] }}" required="" data-original-title="" value="{{ $data['article_attribute_value_id'] }}" disabled />
							<input type="hidden" name="article_attribute_value_id" value="{{ $data['article_attribute_value_id'] }}" />
						</div>
					</div>
					<?php } ?>
					
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="article_id" class="control-label col-form-label">{!! $article_attribute_value_lang['article_id'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
							
							<select class="select2 form-control custom-select" style="width: 100%; height:36px;" name="article_id" id="article_id">
							<?php 
							if (!empty($list_article)) {?>
								<option value="" /> {{ $lang['please_select'] }} </>
								<?php
								foreach ($list_article as $k => $rs) {
								?>
								<option value="{{ $rs['article_id']}}">{{ $rs['article'] . ' - ID ' . $rs['article_id']}}</option>
								<?php 
								} 
							}
							?>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="article_attribute_id" class="control-label col-form-label">{!! $article_attribute_value_lang['article_attribute_id'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
							
							<select class="select2 form-control custom-select" style="width: 100%; height:36px;" name="article_attribute_id" id="article_attribute_id">
							<?php 
							if (!empty($list_article_attribute)) {?>
								<option value="" /> {{ $lang['please_select'] }} </>
								<?php
								foreach ($list_article_attribute as $k => $rs) {
								?>
								<option value="{{ $rs['article_attribute_id']}}">{{ $rs['attribute_name'] . ' - ID ' . $rs['article_attribute_id']}}</option>
								<?php 
								} 
							}
							?>
							</select>
						</div>
					</div>

					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="value" class="control-label col-form-label">{!! $article_attribute_value_lang['attribute_value'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
							<input type="text" data-toggle="" title="" class="form-control" id="attribute_value" name="attribute_value" placeholder="{{ $article_attribute_value_lang['attribute_value'] }}" required="" data-original-title="" />
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