<?php 
// ---------------------------
// Get data 
$data = NULL;
if (isset($get['role_capability_id'])) {
	$api_url = $api_method = $api_param = $api_header = NULL;
	$api_param['token'] = env('API_KEY');
	$api_param['role_capability_id'] = $get['role_capability_id'];

	$api_url = env('API_URL').'role_capability/get';
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

// $PAGE_TITLE = $action .' '. $role_capability_lang['module']; 
$list_role = $list_capability = NULL;
$api_url_role = $api_url_capability = $api_method = $api_param = $api_header = NULL;
$api_param['token'] = env('API_KEY');
$api_param['paging'] = false;

$api_url_role = env('API_URL').'role/get_list';
$api_url_capability = env('API_URL').'capability/get_list';
$api_method = 'get';
//  $api_header['debug'] = 1;

$temp_role = curl_api_liquid($api_url_role, $api_method, $api_header, $api_param);
$temp_capability = curl_api_liquid($api_url_capability, $api_method, $api_header, $api_param);


if (! empty($temp_role)) $temp_role = json_decode($temp_role,1);
$list_role = $temp_role['data'];
if (! empty($temp_capability)) $temp_capability = json_decode($temp_capability,1);
$list_capability = $temp_capability['data'];

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

// $source = array('role_capability_id', 'level_name', 'level_address', 'level_phone', 'level_pic', 'status', 'created_at', 'created_by','created_ip','updated_at','updated_by','updated_ip');
// $target = array('mantap' => 'gokil', 'level_name' => 'harusmasuknih');
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
					<?php if (isset($data['role_capability_id'])) { ?>
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="" class="control-label col-form-label">{!! $role_capability_lang['role_capability_id'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
							<input type="text" data-toggle="" title="" class="form-control" id="" placeholder="{{ $role_capability_lang['role_capability_id'] }}" required="" data-original-title="" value="{{ $data['role_capability_id'] }}" disabled />
							<input type="hidden" name="role_capability_id" value="{{ $data['role_capability_id'] }}" />
						</div>
					</div>
					<?php } ?>					
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="role_id" class="control-label col-form-label">{!! $role_capability_lang['role_id'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">							
							<select class="select2 form-control custom-select" style="width: 100%; height:36px;" id="role_id">
							<?php 
							if (!empty($list_role)) {
								foreach ($list_role as $k => $rs) {
								?>
								<option>{{ $rs['role_name'] . ' - ID ' . $rs['role_id']}}</option>
								<?php 
								} 
							}
							?>
							</select>
						</div>
					</div>								
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="capability_id" class="control-label col-form-label">{!! $role_capability_lang['capability_id'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">							
							<select class="select2 form-control custom-select" style="width: 100%; height:36px;" id="capability_id">
							<?php 
							if (!empty($list_capability)) {
								foreach ($list_capability as $k => $rs) {
								?>
								<option>{{ $rs['capability'] . ' - ID ' . $rs['capability_id']}}</option>
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