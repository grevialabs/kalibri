<?php 
$get = $getkeyword = $getorder_allowed_list = $getorderby_allowed_list = $getorder_list = $getorder = $getorderby = $offset = $page = $perpage = NULL;
// $perpage = 20;
$perpage = PERPAGE;
// $offset = OFFSET;
$offset = 0;
$page = 1;

// $perpage_allowed = array(2,40,60);
$user_model = new UserModel();
$general_model = new GeneralModel();

$getorder_allowed_list = $user_model->getorder_allowed_list();
$getorderby_allowed_list = $general_model->getorderby_allowed_list();
$perpage_allowed = $general_model->perpage_allowed();

if (isset($_GET)) $get = $_GET;
if (isset($get['page']) && $get['page'] > 1) $page = $get['page'];
if (isset($get['perpage']) && in_array($get['perpage'],$perpage_allowed)) $perpage = $get['perpage'];
if (isset($get['keyword'])) $getkeyword = $get['keyword'];
if (isset($get['order']) && in_array($get['order'],$getorder_allowed_list)) $getorder = $get['order'];
if (isset($get['orderby']) && in_array($get['orderby'],$getorderby_allowed_list)) $getorderby = $get['orderby'];

if ($page > 0) $offset = ($page - 1) * $perpage;

// Hit api
$api_url = $api_method = $api_param = $api_header = $data = $listdata = $total_rows = $arrsort = NULL;
$api_param['token'] = env('API_KEY');
$api_param['perpage'] = $perpage;
$api_param['offset'] = $offset;
if (isset($getkeyword)) $api_param['keyword'] = $getkeyword; 
if (isset($getorder)) $api_param['order'] = $getorder; else $getorder = $getorder_allowed_list[0];
if (isset($getorderby)) $api_param['orderby'] = $getorderby; else $getorderby = $getorderby_allowed_list[0];
$arrsort = $general_model->arrsort($get,$getorder,$getorderby,$getorder_allowed_list);

$api_url = env('API_URL').'user/get_list';
$api_method = 'get';
// $api_header['debug'] = 1;
$data = curl_api_liquid($api_url, $api_method, $api_header, $api_param);

if (! empty($data)) $data = json_decode($data,1);
if (isset($data['data'])) $listdata = $data['data'];
if (isset($data['total_rows'])) $total_rows = $data['total_rows'];

$reget = NULL;
if (! empty($get)) {
	$reget = $get;
}

if (isset($perpage)) {
	$reget = $get;
	$reget['perpage'] = '';
}

$reget = http_build_query($reget);

$resubmit_url = current_url().'?'.$reget;

$base_url = base_url();
?>

<style>

</style>

<!-- CONTENT AREA -->
<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-body">
				<div class="card-title">
					<h3 class="b text-capitalize">{{ $PAGE_HEADER }}</h3>
				</div>
				
				@if (session('message'))
					{!! session('message') !!}
				@endif
				
				<a href="<?php echo $base_url.Request::segment(1).DS.Request::segment(2) . '?do=insert' ?>" class="btn btn-primary btn-sm insert"><i class="fa fa-plus" aria-hidden="true"></i> {{ $userlang['add_new'] }}</a><br/><br/>

				<form method="get" action="{{ $current_url }}">
					<input type="search" name="keyword" class="input wdt30-pct display-inline"  placeholder="{{ $lang['search_input'] }}" value="<?php echo (isset($getkeyword) ? $getkeyword : NULL ); ?>" />
					<button class="btn btn-default btn-md" type="submit">{{ $lang['search'] }}</button><br/><br/>
				
					<div>
						<div class="pull-left" style="padding-top: 8px">
							{{ $lang['found'] }} <?php echo $total_rows ?> {{ $lang['data'] }}
						</div>
						<div class="pull-right">
							{{ $lang['showing'] }}
							<select name="perpage" class="input" onchange="return resubmit('{{ $resubmit_url }}',this)">
								<option <?php if (isset($perpage) && $perpage == 20) echo "selected" ?>>20</option>
								<option <?php if (isset($perpage) && $perpage == 40) echo "selected" ?>>40</option>
								<option <?php if (isset($perpage) && $perpage == 60) echo "selected" ?>>60</option>
							</select>
						</div>
						<div class="clearfix"></div>
					</div>
				</form>
				
				<form method="post" action="{{ $current_url . DS . 'bulk' }}">
					<div class="table-responsive">
						<table class="table table-striped table-bordered" id="table_user">
							<tr class="b">
							
								<td width=1><input type="checkbox" class="chkbox togglebox" onclick="togglebox()" /></td>
								<td width=1>#</td>
								<td width="150px"><a class="{{ $arrsort['user_id']['class'] }}" title="{{ $arrsort['user_id']['title'] }}" href="{{ $arrsort['user_id']['url'] }}">userID {!! $arrsort['user_id']['icon'] !!}</a></td>
								<td width="180px"><a class="{{ $arrsort['user_code']['class'] }}" title="{{ $arrsort['user_code']['title'] }}" href="{{ $arrsort['user_code']['url'] }}">{{ $userlang['user_code'] }} {!! $arrsort['firstname']['icon'] !!}</a></td>
								<td width="180px"><a class="{{ $arrsort['site_id']['class'] }}" title="{{ $arrsort['site_id']['title'] }}" href="{{ $arrsort['site_id']['url'] }}">{{ $userlang['site_id'] }} {!! $arrsort['site_id']['icon'] !!}</a></td>
								<td width="180px"><a class="{{ $arrsort['parent_user_id']['class'] }}" title="{{ $arrsort['parent_user_id']['title'] }}" href="{{ $arrsort['parent_user_id']['url'] }}">{{ $userlang['parent_user_id'] }} {!! $arrsort['parent_user_id']['icon'] !!}</a></td>
								<td width="180px"><a class="{{ $arrsort['level_id']['class'] }}" title="{{ $arrsort['level_id']['title'] }}" href="{{ $arrsort['level_id']['url'] }}">{{ $userlang['level_id'] }} {!! $arrsort['level_id']['icon'] !!}</a></td>
								<td width="180px"><a class="{{ $arrsort['firstname']['class'] }}" title="{{ $arrsort['firstname']['title'] }}" href="{{ $arrsort['firstname']['url'] }}">{{ $userlang['firstname'] }} {!! $arrsort['firstname']['icon'] !!}</a></td>
								<td width="180px"><a class="{{ $arrsort['lastname']['class'] }}" title="{{ $arrsort['lastname']['title'] }}" href="{{ $arrsort['lastname']['url'] }}">{{ $userlang['lastname'] }} {!! $arrsort['lastname']['icon'] !!}</a></td>
								<td width="180px"><a class="{{ $arrsort['quota_initial']['class'] }}" title="{{ $arrsort['quota_initial']['title'] }}" href="{{ $arrsort['quota_initial']['url'] }}">{{ $userlang['quota_initial'] }} {!! $arrsort['quota_initial']['icon'] !!}</a></td>
								<td width="180px"><a class="{{ $arrsort['quota_additional']['class'] }}" title="{{ $arrsort['quota_additional']['title'] }}" href="{{ $arrsort['quota_additional']['url'] }}">{{ $userlang['quota_additional'] }} {!! $arrsort['quota_additional']['icon'] !!}</a></td>
								<td width="180px"><a class="{{ $arrsort['quota_remaining']['class'] }}" title="{{ $arrsort['quota_remaining']['title'] }}" href="{{ $arrsort['quota_remaining']['url'] }}">{{ $userlang['quota_remaining'] }} {!! $arrsort['quota_remaining']['icon'] !!}</a></td>
								<td width="180px"><a class="{{ $arrsort['job_title']['class'] }}" title="{{ $arrsort['job_title']['title'] }}" href="{{ $arrsort['job_title']['url'] }}">{{ $userlang['job_title'] }} {!! $arrsort['job_title']['icon'] !!}</a></td>
								<td width="180px"><a class="{{ $arrsort['division']['class'] }}" title="{{ $arrsort['division']['title'] }}" href="{{ $arrsort['division']['url'] }}">{{ $userlang['division'] }} {!! $arrsort['division']['icon'] !!}</a></td>
								<td width="180px"><a class="{{ $arrsort['email']['class'] }}" title="{{ $arrsort['email']['title'] }}" href="{{ $arrsort['email']['url'] }}">{{ $userlang['email'] }} {!! $arrsort['email']['icon'] !!}</a></td>
								<td width="180px"><a class="{{ $arrsort['user_category']['class'] }}" title="{{ $arrsort['user_category']['title'] }}" href="{{ $arrsort['user_category']['url'] }}">{{ $userlang['user_category'] }} {!! $arrsort['user_category']['icon'] !!}</a></td>
								<td width="180px"><a class="{{ $arrsort['password']['class'] }}" title="{{ $arrsort['password']['title'] }}" href="{{ $arrsort['password']['url'] }}">{{ $userlang['password'] }} {!! $arrsort['password']['icon'] !!}</a></td>
								<td width="180px"><a class="{{ $arrsort['counter_wrong_pass']['class'] }}" title="{{ $arrsort['counter_wrong_pass']['title'] }}" href="{{ $arrsort['counter_wrong_pass']['url'] }}">{{ $userlang['counter_wrong_pass'] }} {!! $arrsort['counter_wrong_pass']['icon'] !!}</a></td>
								<td width="180px"><a class="{{ $arrsort['locked_time']['class'] }}" title="{{ $arrsort['locked_time']['title'] }}" href="{{ $arrsort['locked_time']['url'] }}">{{ $userlang['locked_time'] }} {!! $arrsort['locked_time']['icon'] !!}</a></td>
								<td width="180px"><a class="{{ $arrsort['reset_by']['class'] }}" title="{{ $arrsort['reset_by']['title'] }}" href="{{ $arrsort['reset_by']['url'] }}">{{ $userlang['reset_by'] }} {!! $arrsort['reset_by']['icon'] !!}</a></td>
								<td width="180px"><a class="{{ $arrsort['reset_time']['class'] }}" title="{{ $arrsort['reset_time']['title'] }}" href="{{ $arrsort['reset_time']['url'] }}">{{ $userlang['reset_time'] }} {!! $arrsort['reset_time']['icon'] !!}</a></td>
								<td width="2">Status</td>
								<td width="50px" class="talCnt">Option</td>
							</tr>
							<?php 
							if (! empty($listdata)) 
							{
								$i = 0;
								if (is_numeric($page) && $page > 0) {
									$i = ($page - 1) * $perpage;
								}
								
								foreach ($listdata as $key => $rs) 
								{
									$i++;
									$id = $rs['user_id'];
									$idcol = 'user_id';
							?>
							
							<tr>
								<td class="parentcheckbox"><input type="checkbox" name="chkbox[]" id="chkbox[]" class="chkbox" value="<?php echo $i?>"/></td>
								<td>{{ $i }}</td>
								<td>{{ $rs['user_id'] }} <br/> <a style="margin-right:6px" href="<?php echo Request::segment(2).'?do=edit&'.$idcol.'='.$id; ?>" title="Edit data" alt="Edit data"><i class="clrBlu fa fa-pencil-square-o fa-lg btnedit"></i></a> </td>								
								<td>{{ $rs['user_code'] or '' }}</td>
								<td>{{ $rs['site_id'] or '' }}</td>
								<td>{{ $rs['parent_user_id'] or '' }}</td>
								<td>{{ $rs['level_id'] or '' }}</td>
								<td>{{ $rs['firstname'] or '' }}</td>
								<td>{{ $rs['lastname'] or '' }}</td>								
								<td>{{ $rs['quota_initial'] or '' }}</td>
								<td>{{ $rs['quota_additional'] or '' }}</td>
								<td>{{ $rs['quota_remaining'] or '' }}</td>
								<td>{{ $rs['job_title'] or '' }}</td>
								<td>{{ $rs['division'] or '' }}</td>
								<td>{{ $rs['email'] or '' }}</td>
								<td>{{ $rs['user_category'] or '' }}</td>
								<td>{{ $rs['password'] or '' }}</td>
								<td>{{ $rs['counter_wrong_pass'] or '' }}</td>
								<td>{{ $rs['locked_time'] or '' }}</td>
								<td>{{ $rs['reset_by'] or '' }}</td>
								<td>{{ $rs['reset_time'] or '' }}</td>

								<td class="talCnt">{!! $general_model->show_record_status($rs['status']) !!}</td>
								<td class="talCnt">								
								<a href="<?php echo Request::segment(2).DS.'delete?'.$idcol.'='.$id; ?>" onclick=""><i class="clrRed fa fa-trash fa-lg btndelete" title="Delete data" alt="Delete data"  onclick="return doConfirm()"></i></a>
								</td>
							</tr>
							<?php
								}
							?>
							<tr>
								<td colspan="100%">
									<div id="group_action" class="btnedit">With checked do 
									<select class="input" name="lst_group_action">
										<option class="" value="1">Active</option>
										<option class="" value="0">Inactive</option>
										<option class="" value="-1">Delete</option>
									</select>
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<button class="btn btn-default btn-sm" name="btn_group_action" value="1">Action</button></div>
								</td>
							</tr>	
							<?php
							}
							else 
							{
								?>
								<tr>
									<td colspan="100%">{{ $lang['data_not_found'] }}</td>
								</tr>
								<?php
							}
							?>
						</table>
					</div>
				</form>
				
				<?php if ( ! empty($listdata)) echo common_paging($total_rows, $perpage); ?>
			</div>
		</div>	
	</div>	
</div>

<script>

	
// Placeholder
$(document).ready( function() {
	
	/* INSERT class parentcheckbox in wrapper checkbox to activate */
	// $("img.lazy").lazyload({ effect: "fadeIn" });
		
	// $('[data-toggle="popover"]').popover();
	
	// $( ".datepicker").datepicker({
		// dateFormat: 'dd-mm-yy',
		// changeMonth: true,
		// changeYear: true,
		// showAnim: "slideDown",
		// yearRange: '1950:+10' 
	// });

});
</script>

