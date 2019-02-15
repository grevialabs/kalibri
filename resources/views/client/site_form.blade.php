<?php 
// ---------------------------
// Get data 
$data = NULL;
if (isset($get['site_id'])) {
	$api_url = $api_method = $api_param = $api_header = NULL;
	$api_param['token'] = env('API_KEY');
	$api_param['site_id'] = $get['site_id'];

	$api_url = env('API_URL').'site/get';
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

// $PAGE_TITLE = $action .' '. $sitelang['module']; 

// if (isset($get['do'])) 
$list_company = NULL;
$api_url = $api_method = $api_param = $api_header = NULL;
$api_param['token'] = env('API_KEY');
$api_param['paging'] = false;

$api_url = env('API_URL').'company/get_list';
$api_method = 'get';
// $api_header['debug'] = 1;

$temp = curl_api_liquid($api_url, $api_method, $api_header, $api_param);

if (! empty($temp)) { 
	$temp = json_decode($temp,1);
	$list_company = $temp['data'];
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
							<label for="site_id" class="control-label col-form-label">{!! $sitelang['site_id'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
							<input type="text" data-toggle="" title="" class="form-control" id="" placeholder="{{ $sitelang['site_id'] }}" required="" data-original-title="" value="{{ $data['site_id'] }}" disabled />
							<input type="hidden" name="site_id" value="{{ $data['site_id'] }}" />
						</div>
					</div>
					<?php } ?>
					
					
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="site_name" class="control-label col-form-label">{!! $sitelang['site_name'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
							<input type="text" data-toggle="{{ $sitelang['site_name'] }}" title="{{ $sitelang['site_name'] }}" class="form-control" id="site_name" name="site_name" placeholder="{{ $sitelang['site_name'] }}" required="" data-original-title="" />
						</div>
					</div>
					
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="company_id" class="control-label col-form-label">{!! $sitelang['company_name'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
							<!--
							<input type="text" data-toggle="{{ $sitelang['company_id'] }}" title="{{ $sitelang['company_id'] }}" class="form-control" id="company_id" name="company_id" placeholder="{{ $sitelang['company_id'] }}" required="" data-original-title="" />
							-->
							
							<select class="select2 form-control custom-select" style="width: 100%; height:36px;" id="company_id">
							<?php 
							if (!empty($list_company)) {
								foreach ($list_company as $k => $rs) {
								?>
								<option>{{ $rs['company_name'] . ' - ID ' . $rs['company_id']}}</option>
								<?php 
								} 
							}
							?>
							</select>
						</div>
					</div>
					
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="site_address" class="control-label col-form-label">{!! $sitelang['site_address'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
							<textarea type="text" data-toggle="{{ $sitelang['site_address'] }}" title="" class="form-control" id="site_address" name="site_address" placeholder="{{ $sitelang['site_address'] }}" required="" data-original-title="{{ $sitelang['site_address'] }}"></textarea>
						</div>
					</div>
					
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="site_qty_value" class="control-label col-form-label">{!! $sitelang['site_qty_value'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
							<input type="text" data-toggle="{{ $sitelang['site_qty_value'] }}" title="{{ $sitelang['site_qty_value'] }}" class="form-control" id="site_qty_value" name="site_qty_value" placeholder="{{ $sitelang['site_qty_value'] }}" required="" data-original-title="" />
						</div>
					</div>
					
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="flag_qty_value" class="control-label col-form-label">{!! $sitelang['flag_qty_value'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
							<input type="text" data-toggle="{{ $sitelang['flag_qty_value'] }}" title="{{ $sitelang['flag_qty_value'] }}" class="form-control" id="flag_qty_value" name="flag_qty_value" placeholder="{{ $sitelang['flag_qty_value'] }}" required="" data-original-title="" />
						</div>
					</div>
					
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="method_calc" class="control-label col-form-label">{!! $sitelang['method_calc'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
							<input type="text" data-toggle="" title="" class="form-control" id="method_calc" name="method_calc" placeholder="{{ $sitelang['method_calc'] }}" required="" data-original-title="" />
						</div>
					</div>
					
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="start_date_counting" class="control-label col-form-label">{!! $sitelang['start_date_counting'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
							<input type="text" data-toggle="" title="" class="datetimepicker form-control" id="start_date_counting" name="start_date_counting" placeholder="{{ $sitelang['start_date_counting'] }}" required="" data-original-title="" />
						</div>
					</div>
					
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="reset_days" class="control-label col-form-label">{!! $sitelang['reset_days'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
							<input type="text" data-toggle="" title="" class="form-control" id="reset_days" name="reset_days" placeholder="{{ $sitelang['reset_days'] }}" required="" data-original-title="{{ $sitelang['reset_days'] }}" />
						</div>
					</div>
					
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="logo_file_name" class="control-label col-form-label">{!! $sitelang['logo_file_name'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
							<input type="file" data-toggle="" title="" class="form-control" id="logo_file_name" name="logo_file_name" placeholder="{{ $sitelang['logo_file_name'] }}" data-original-title="{{ $sitelang['logo_file_name'] }}" />
						</div>
					</div>
					
					<div class="form-group row">
						<div class="col-sm-12">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<?php 
							if ($get['do'] == 'insert') {
							?>
							<button type="submit" class="btn btn-primary btn-md btnaction">{{ $lang['save'] }}</button>
							<?php 
							} else if ($get['do'] == 'edit') {
							?>
							<button type="submit" class="btn btn-primary btn-md btnaction">{{ $lang['update'] }}</button>
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