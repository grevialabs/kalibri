<?php 
// ---------------------------
// Get data 
$data = $total_rows = $listdata = NULL;
if (isset($get['role_id'])) {
	$api_url = $api_method = $api_param = $api_header = NULL;
	$api_param['token'] = env('API_KEY');
	$api_param['role_id'] = $get['role_id'];
	$api_param['paging'] = false;

	$api_url = env('API_URL').'role_capability/get_list_detail';
	$api_method = 'get';
	// $api_header['debug'] = 1;
	
	$data = curl_api_liquid($api_url, $api_method, $api_header, $api_param);

	if (! empty($data)) $data = json_decode($data,1);
	if (isset($data['data'])) $listdata = $data['data'];
	if (isset($data['total_rows'])) $total_rows = $data['total_rows'];
}

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

// --------------------------
// check access group and insert if not exist
$api_url = $api_url_capability = $api_method = $api_param = $api_header = NULL;
$api_param['token'] = env('API_KEY');
$api_param['role_id'] = get_user_cookie('role_id');

$api_url = env('API_URL').'role_capability/cron_insert_role';
$api_method = 'get';
// $api_header['debug'] = 1;
$list_role = curl_api_liquid($api_url, $api_method, $api_header, $api_param);
// --------------------------

// $PAGE_TITLE = $action .' '. $role_capability_lang['module']; 
$list_role = NULL;
$api_url = $api_method = $api_param = $api_header = NULL;
$api_param['token'] = env('API_KEY');
$api_param['paging'] = false;

$api_url = env('API_URL').'role/get_list';
$api_method = 'get';
//  $api_header['debug'] = 1;
$list_role = curl_api_liquid($api_url, $api_method, $api_header, $api_param);
if (! empty($list_role)) $list_role = json_decode($list_role,1);
if (! empty($list_role['data'])) $list_role = $list_role['data'];

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
				
				<form method="post" action="{{ $form_url }}" class="form-horizontal form_submit">
					<?php if (isset($data['role_id'])) { ?>
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="" class="control-label col-form-label">{!! $role_capability_lang['role_id'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">
							<input type="text" data-toggle="" title="" class="form-control" id="" placeholder="{{ $role_capability_lang['role_id'] }}" required="" data-original-title="" value="{{ $data['role_id'] }}" disabled />
							<input type="hidden" name="role_id" value="{{ $data['role_id'] }}" />
						</div>
					</div>
					<?php } ?>					
					
					<div class="form-group row">
						<div class="col-lg-2 col-md-3 col-sm-12">
							<label for="role_id" class="control-label col-form-label">{!! $role_capability_lang['role_id'] !!}</label>
						</div>
						<div class="col-lg-7 col-lg-offset-3 col-md-9 col-sm-12">							
							<select class="select2 form-control custom-select" style="width: 100%; height:36px;" id="" disabled>
							<?php 
							if (!empty($list_role)) {
								foreach ($list_role as $k => $rs) {
								?>
								<option <?php if (isset($_GET['role_id']) && $rs['role_id'] == $_GET['role_id']) echo 'selected'; ?>>{{ $rs['role_name'] . ' - ID ' . $rs['role_id']}}</option>
								<?php 
								} 
							}
							?>
                            </select>
                            <?php if (isset($get['role_id'])) { ?>
                            <input type="hidden" name="role_id" value="{{ $get['role_id'] }}" />
                            <?php } ?>
						</div>
					</div>	
					
					<table class="table table-striped table-bordered" id="table_level">
						<tr class="b">
							<td width=1>#</td>
							<td width="">MenuName</td>
							<td width="100px">Create</td>
							<td width="100px">Read</td>
							<td width="100px">Update</td>
							<td width="100px">Delete</td>
						</tr>
						<?php 
						if (!empty($listdata)) {
							foreach ($listdata as $i => $rs) {
								$i++;
							?>
						<tr class="b">
							<td class="talCnt">{{ $i }}</td>
							<td>{{ $rs['capability'] or '' }}</td>
                            <td class="talCnt"><div class="custom-control custom-checkbox ">
                            <input type="hidden" name="rcid[{{ $rs['role_capability_id'] }}][capability_id]" value="{{ $rs['capability_id'] }}" class="custom-control-input" />
                                
                                <input type="checkbox" name="rcid[{{ $rs['role_capability_id'] }}][create]" class="custom-control-input" id="createCheck{{ $i }}" <?php if ($rs['create']) echo "checked"; ?> value="1" /> <label class="custom-control-label" for="createCheck{{ $i }}"></label></div></td>
							<td class="talCnt"><div class="custom-control custom-checkbox "><input type="checkbox" name="rcid[{{ $rs['role_capability_id'] }}][read]" class="custom-control-input" id="readCheck{{ $i }}" <?php if ($rs['read']) echo "checked"; ?> value="1" /> <label class="custom-control-label" for="readCheck{{ $i }}"></label></div></td>
							<td class="talCnt"><div class="custom-control custom-checkbox "><input type="checkbox" name="rcid[{{ $rs['role_capability_id'] }}][edit]" class="custom-control-input" id="updateCheck{{ $i }}" <?php if ($rs['update']) echo "checked"; ?> value="1" /> <label class="custom-control-label" for="updateCheck{{ $i }}"></label></div></td>
							<td class="talCnt"><div class="custom-control custom-checkbox "><input type="checkbox" name="rcid[{{ $rs['role_capability_id'] }}][delete]" class="custom-control-input" id="deleteCheck{{ $i }}" <?php if ($rs['delete']) echo "checked"; ?> value="1" /> <label class="custom-control-label" for="deleteCheck{{ $i }}"></label></div></td>
						</tr>
						<?php 
							}
						}
						?>
					</table>

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
	
})
</script>