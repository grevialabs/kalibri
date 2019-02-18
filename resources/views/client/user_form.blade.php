<?php 
// ---------------------------
// Get data 
$data = NULL;
if (isset($get['user_id'])) {
	$api_url = $api_method = $api_param = $api_header = NULL;
	$api_param['token'] = env('API_KEY');
	$api_param['user_id'] = $get['user_id'];

	$api_url = env('API_URL').'user/get';
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

// $PAGE_TITLE = $action .' '. $userlang['module']; 
$list_site = $list_level = NULL;
$api_url = $api_url_level = $api_method = $api_param = $api_header = NULL;
$api_param['token'] = env('API_KEY');
$api_param['paging'] = false;

$api_url = env('API_URL').'site/get_list';
$api_url_level = env('API_URL').'level/get_list';
$api_method = 'get';
// $api_header['debug'] = 1;

$temp = curl_api_liquid($api_url, $api_method, $api_header, $api_param);
$temp_level = curl_api_liquid($api_url_level, $api_method, $api_header, $api_param);


if (! empty($temp)) $temp = json_decode($temp,1);
$list_site = $temp['data'];
if (! empty($temp_level)) $temp_level = json_decode($temp_level,1);
$list_level = $temp_level['data'];

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

// $source = array('user_id', 'user_name', 'user_address', 'division', 'user_category', 'status', 'created_at', 'created_by','created_ip','updated_at','updated_by','updated_ip');
// $target = array('mantap' => 'gokil', 'user_name' => 'harusmasuknih');
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
					
				
					<?php if (isset($data['user_id'])) { ?>
					
					<!--
					<div class="col-lg-12 col-sm-12">
						<div class="md-form">
							<input type="text" id="user_id" class="form-control" value="{{ $data['user_id'] }}" disabled />
							<input type="hidden" name="user_id" value="{{ $data['user_id'] }}" />
							
							<label for="user_id" >user ID</label>
						</div>
					</div>
					-->
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="" class="control-label col-form-label">{!! $userlang['user_id'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
							<input type="text" data-toggle="" title="" class="form-control" id="" placeholder="{{ $userlang['user_id'] }}" required="" data-original-title="" value="{{ $data['user_id'] }}" disabled />
							<input type="hidden" name="user_id" value="{{ $data['user_id'] }}" />
						</div>
					</div>
					<?php } ?>
										
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="firstname" class="control-label col-form-label">{!! $userlang['firstname'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
							<input type="text" data-toggle="{{ $userlang['firstname'] }}" title="{{ $userlang['firstname'] }}" class="form-control" id="firstname" name="firstname" placeholder="{{ $userlang['firstname'] }}" required="" data-original-title="" />
						</div>
					</div>
					
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="lastname" class="control-label col-form-label">{!! $userlang['lastname'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
							<input type="text" data-toggle="{{ $userlang['lastname'] }}" title="{{ $userlang['lastname'] }}" class="form-control" id="lastname" name="lastname" placeholder="{{ $userlang['lastname'] }}" required="" data-original-title="" />
						</div>
					</div>

					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="job_title" class="control-label col-form-label">{!! $userlang['job_title'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
							<input type="text" data-toggle="{{ $userlang['job_title'] }}" title="{{ $userlang['job_title'] }}" class="form-control" id="job_title" name="job_title" placeholder="{{ $userlang['job_title'] }}" required="" data-original-title="" />
						</div>
					</div>
					
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="division" class="control-label col-form-label">{!! $userlang['division'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
							<input type="text" data-toggle="{{ $userlang['division'] }}" title="{{ $userlang['division'] }}" class="form-control" id="division" name="division" placeholder="{{ $userlang['division'] }}" required="" data-original-title="" />
						</div>
					</div>
					
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="email" class="control-label col-form-label">{!! $userlang['email'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
							<input type="text" data-toggle="{{ $userlang['email'] }}" title="{{ $userlang['email'] }}" class="form-control" id="email" name="email" placeholder="{{ $userlang['email'] }}" required="" data-original-title="" />
						</div>
					</div>
					
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="user_category" class="control-label col-form-label">{!! $userlang['user_category'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
							<input type="text" data-toggle="{{ $userlang['user_category'] }}" title="{{ $userlang['user_category'] }}" class="form-control" id="user_category" name="user_category" placeholder="{{ $userlang['user_category'] }}" required="" data-original-title="" />
						</div>
					</div>
					
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="level_id" class="control-label col-form-label">{!! $userlang['level_id'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">							
							<select class="select2 form-control custom-select" style="width: 100%; height:36px;" name="level_id" id="level_id">
							<?php 
							if (!empty($list_level)) {
								foreach ($list_level as $k => $rs) {
								?>
								<option value="{{ $rs['level_id']}}">{{ $rs['level_name'] . ' - ID ' . $rs['level_id']}}</option>
								<?php 
								} 
							}
							?>
							</select>
						</div>
					</div>
					
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="site_id" class="control-label col-form-label">{!! $userlang['site_id'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">							
							<select class="select2 form-control custom-select" style="width: 100%; height:36px;" name="site_id" id="site_id	">
							<?php 
							if (!empty($list_site)) {
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
							<label for="user_code" class="control-label col-form-label">{!! $userlang['user_code'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
							<input type="text" data-toggle="{{ $userlang['user_code'] }}" title="{{ $userlang['user_code'] }}" class="form-control" id="user_code" name="user_code" placeholder="{{ $userlang['user_code'] }}" required="" data-original-title="" />
						</div>
					</div>					
					
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="parent_user_id" class="control-label col-form-label">{!! $userlang['parent_user_id'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
							<input type="text" data-toggle="{{ $userlang['parent_user_id'] }}" title="{{ $userlang['parent_user_id'] }}" class="form-control" id="parent_user_id" name="parent_user_id" placeholder="{{ $userlang['parent_user_id'] }}" required="" data-original-title="" />
						</div>
					</div>
										
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="quota_initial" class="control-label col-form-label">{!! $userlang['quota_initial'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
							<input type="text" data-toggle="{{ $userlang['quota_initial'] }}" title="{{ $userlang['quota_initial'] }}" class="form-control numeric" id="quota_initial" name="quota_initial" placeholder="{{ $userlang['quota_initial'] }}" required="" data-original-title="" />
						</div>
					</div>
					
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="quota_additional" class="control-label col-form-label">{!! $userlang['quota_additional'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
							<input type="text" data-toggle="{{ $userlang['quota_additional'] }}" title="{{ $userlang['quota_additional'] }}" class="form-control" id="quota_additional" name="quota_additional" placeholder="{{ $userlang['quota_additional'] }}" required="" data-original-title="" />
						</div>
					</div>
					
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="quota_remaining" class="control-label col-form-label">{!! $userlang['quota_remaining'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
							<input type="text" data-toggle="{{ $userlang['quota_remaining'] }}" title="{{ $userlang['quota_remaining'] }}" class="form-control" id="quota_remaining" name="quota_remaining" placeholder="{{ $userlang['quota_remaining'] }}" required="" data-original-title="" />
						</div>
					</div>
					
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="password" class="control-label col-form-label">{!! $userlang['password'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
							<input type="text" data-toggle="{{ $userlang['password'] }}" title="{{ $userlang['password'] }}" class="form-control" id="password" name="password" placeholder="{{ $userlang['password'] }}" required="" data-original-title="" />
						</div>
					</div>
					
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="counter_wrong_pass" class="control-label col-form-label">{!! $userlang['counter_wrong_pass'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
							<input type="text" data-toggle="{{ $userlang['counter_wrong_pass'] }}" title="{{ $userlang['counter_wrong_pass'] }}" class="form-control" id="counter_wrong_pass" name="counter_wrong_pass" placeholder="{{ $userlang['counter_wrong_pass'] }}" required="" data-original-title="" />
						</div>
					</div>
					
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="locked_time" class="control-label col-form-label">{!! $userlang['locked_time'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
							<input type="text" data-toggle="{{ $userlang['locked_time'] }}" title="{{ $userlang['locked_time'] }}" class="form-control" id="locked_time" name="locked_time" placeholder="{{ $userlang['locked_time'] }}" required="" data-original-title="" />
						</div>
					</div>
					
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="reset_by" class="control-label col-form-label">{!! $userlang['reset_by'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
							<input type="text" data-toggle="{{ $userlang['reset_by'] }}" title="{{ $userlang['reset_by'] }}" class="form-control" id="reset_by" name="reset_by" placeholder="{{ $userlang['reset_by'] }}" required="" data-original-title="" />
						</div>
					</div>
					
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="reset_time" class="control-label col-form-label">{!! $userlang['reset_time'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
							<input type="text" data-toggle="{{ $userlang['reset_time'] }}" title="{{ $userlang['reset_time'] }}" class="form-control" id="reset_time" name="quota_initial" placeholder="{{ $userlang['quota_initial'] }}" required="" data-original-title="" />
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