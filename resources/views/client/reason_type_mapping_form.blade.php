<?php 
// ---------------------------
// Get data 
$data = NULL;
if (isset($get['reason_type_mapping_id'])) {
	$api_url = $api_method = $api_param = $api_header = NULL;
	$api_param['token'] = env('API_KEY');
	$api_param['reason_type_mapping_id'] = $get['reason_type_mapping_id'];

	$api_url = env('API_URL').'reason_type_mapping/get';
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

// $PAGE_TITLE = $action .' '. $reason_type_mapping_lang['module']; 
$list_reason = $list_reason_type = NULL;
$api_url_reason = $api_url_reason_type = $api_method = $api_param = $api_header = NULL;
$api_param['token'] = env('API_KEY');
$api_param['paging'] = false;

$api_url_reason = env('API_URL').'reason/get_list';
$api_url_reason_type = env('API_URL').'reason/get_list';
$api_method = 'get';
 //$api_header['debug'] = 1;

$temp_reason = curl_api_liquid($api_url_reason, $api_method, $api_header, $api_param);
$temp_reason_type = curl_api_liquid($api_url_reason_type, $api_method, $api_header, $api_param);


if (! empty($temp_reason)) $temp_reason = json_decode($temp_reason,1);
$list_reason = $temp_reason['data'];
if (! empty($temp_reason_type)) $temp_reason_type = json_decode($temp_reason_type,1);
$list_reason_type = $temp_reason_type['data'];


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

// $source = array('reason_type_mapping_id', 'reason_id', 'company_address', 'company_phone', 'company_pic', 'status', 'created_at', 'created_by','created_ip','updated_at','updated_by','updated_ip');
// $target = array('mantap' => 'gokil', 'reason_id' => 'harusmasuknih');
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
					
				
					<?php if (isset($data['reason_type_mapping_id'])) { ?>
					
					<!--
					<div class="col-lg-12 col-sm-12">
						<div class="md-form">
							<input type="text" id="reason_type_mapping_id" class="form-control" value="{{ $data['reason_type_mapping_id'] }}" disabled />
							<input type="hidden" name="reason_type_mapping_id" value="{{ $data['reason_type_mapping_id'] }}" />
							
							<label for="reason_type_mapping_id" >Company ID</label>
						</div>
					</div>
					-->
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="reason_type_mapping_id" class="control-label col-form-label">{!! $reason_type_mapping_lang['reason_type_mapping_id'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
							<input type="text" data-toggle="" title="" class="form-control" id="" placeholder="{{ $reason_type_mapping_lang['reason_type_mapping_id'] }}" required="" data-original-title="" value="{{ $data['reason_type_mapping_id'] }}" disabled />
							<input type="hidden" name="reason_type_mapping_id" value="{{ $data['reason_type_mapping_id'] }}" />
						</div>
					</div>
					<?php } ?>
					
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="reason_type_id" class="control-label col-form-label">{!! $reason_type_mapping_lang['reason_type_id'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">							
							<select class="select2 form-control custom-select" style="width: 100%; height:36px;" name="reason_type_id" id="reason_type_id">
							<?php 
							if (!empty($list_reason_type)) {
								foreach ($list_reason_type as $k => $rs) {
								?>
								<option value="{{ $rs['reason_id']}}">{{ $rs['reason_type_id'] . ' - ID ' . $rs['reason_type_mapping_id']}}</option>
								<?php 
								} 
							}
							?>
							</select>
						</div>
					</div>
					
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="reason_id" class="control-label col-form-label">{!! $reason_type_mapping_lang['reason_id'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">							
							<select class="select2 form-control custom-select" style="width: 100%; height:36px;" name="reason_id" id="reason_id">
							<?php 
							if (!empty($list_reason)) {
								foreach ($list_reason as $k => $rs) {
								?>
								<option value="{{ $rs['reason_id']}}">{{ $rs['reason_name'] . ' - ID ' . $rs['reason_id']}}</option>
								<?php 
								} 
							}
							?>
							</select>
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