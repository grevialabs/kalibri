<?php 
// ---------------------------
// Get data 
$data = NULL;
if (isset($get['user_id'])) {
	$api_url = $api_method = $api_param = $api_header = NULL;
	$api_param['token'] = env('API_KEY');
	$api_param['user_id'] = $get['user_id'];

	$api_url = env('API_URL').'user_attribute/get';
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

// $PAGE_TITLE = $action .' '. $user_attribute_lang['module']; 

// $cook = Cookie::get('tokenhash');
$cook = $_COOKIE;
debug('yowassap'.HR);
debug($cook,1);
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
					
				
					<?php if (isset($data['user_attribute'])) { ?>
					
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
							<label for="" class="control-label col-form-label">{!! $user_attribute_lang['user_id'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
							<input type="text" data-toggle="" title="" class="form-control" id="" placeholder="{{ $user_attribute_lang['user_id'] }}" required="" data-original-title="" value="{{ $data['user_id'] }}" disabled />
							<input type="hidden" name="user_id" value="{{ $data['user_id'] }}" />
						</div>
					</div>
					<?php } ?>
					
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="attribute" class="control-label col-form-label">{!! $user_attribute_lang['attribute'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
							<input type="text" data-toggle="{{ $user_attribute_lang['attribute'] }}" title="{{ $user_attribute_lang['attribute'] }}" class="form-control" id="attribute" name="attribute" placeholder="{{ $user_attribute_lang['attribute'] }}" required="" data-original-title="" />
						</div>
					</div>
					
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="value" class="control-label col-form-label">{!! $user_attribute_lang['value'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
							<input type="text" data-toggle="{{ $user_attribute_lang['value'] }}" title="{{ $user_attribute_lang['value'] }}" class="form-control" id="value" name="value" placeholder="{{ $user_attribute_lang['value'] }}" required="" data-original-title="" />
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