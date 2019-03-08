<?php 
// ---------------------------
// Get data 
$data = $obj_list_user = NULL;
if (isset($get['user_role_id'])) {
	$api_url = $api_method = $api_param = $api_header = NULL;
	$api_param['token'] = env('API_KEY');
	$api_param['user_role_id'] = $get['user_role_id'];

	$api_url = env('API_URL').'user_role/get';
	$api_method = 'get';
	// $api_header['debug'] = 1;
	
	$data = curl_api_liquid($api_url, $api_method, $api_header, $api_param);

	if (! empty($data)) $data = json_decode($data,1);
	
	
}

// -------------------------------
// get data user


// debug('ayamberak ');
// debug($temp,1);
// debug($obj_list_user,1);
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

// $PAGE_TITLE = $action .' '. $user_role_lang['module']; 

// $obj_list_user = NULL;

$api_url_user = $list_user =$api_url_role = $list_role = $api_method = $api_param = $api_header = NULL;
$api_param['token'] = env('API_KEY');
$api_param['paging'] = false;

$api_url_user = env('API_URL').'user/get_list_dropdown';
$api_url_role = env('API_URL').'role/get_list';
$api_method = 'get';
// $api_header['debug'] = 1;

$list_user = curl_api_liquid($api_url_user, $api_method, $api_header, $api_param);
$list_role = curl_api_liquid($api_url_role, $api_method, $api_header, $api_param);

if (! empty($list_user)) $list_user = json_decode($list_user,1);
if (! empty($list_user['data'])) $list_user = $list_user['data'];

if (! empty($list_role)) $list_role = json_decode($list_role,1);
if (! empty($list_role['data'])) $list_role = $list_role['data'];

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
					
				
					<?php if (isset($data['user_role_id'])) { ?>
					
					<!--
					<div class="col-lg-12 col-sm-12">
						<div class="md-form">
							<input type="text" id="user_id" class="form-control" value="{{ $data['user_id'] }}" disabled />
							<input type="hidden" name="user_id" value="{{ $data['user_id'] }}" />
							
							<label for="user_id" >Company ID</label>
						</div>
					</div>
					-->
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="" class="control-label col-form-label">{!! $user_role_lang['user_role_id'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
							<input type="text" data-toggle="" title="" class="form-control" id="" placeholder="{{ $user_role_lang['user_role_id'] }}" required="" data-original-title="" value="{{ $data['user_role_id'] }}" disabled />
							<input type="hidden"  name="user_role_id" value="{{ $data['user_role_id'] }}" />
						</div>
					</div>
					<?php } ?>
					
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="role_id" class="control-label col-form-label">{!! $user_role_lang['role_id'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
							<select id="role_id" name="role_id"  title="{{ $user_role_lang['role_id'] }}"  class="select2 form-control custom-select" placeholder="{{ $user_role_lang['role_id'] }}" style="width:100%" required>
								<?php if (! empty($list_role)) { ?>
									<option value="" /> {{ $lang['please_select'] }} </>
									<?php foreach ($list_role as $key => $obj) { ?>
										<option value="{{ $obj['role_id']}}">{{ $obj['role_name'] . ' - ID ' . $obj['role_id']}}</option>
									<?php } ?>
								<?php } ?>
							</select>
							
						</div>
					</div>
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="user_id" class="control-label col-form-label">{!! $user_role_lang['user_id'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
							<select id="user_id" name="user_id"  title="{{ $user_role_lang['user_id'] }}"  class="select2 form-control custom-select" placeholder="{{ $user_role_lang['user_id'] }}" style="width:100%" required>
								<?php if (! empty($list_user)) { ?>
									<option value="" /> {{ $lang['please_select'] }} </>
									<?php foreach ($list_user as $key => $obj) { ?>
										<option value="{{ $obj['user_id']}}">{{ $obj['fullname'] . ' - ID ' . $obj['user_id']}}</option>
									<?php } ?>
								<?php } ?>
							</select>
							
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