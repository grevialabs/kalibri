<?php 
$get = $getkeyword = $getorder_allowed_list = $getorderby_allowed_list = $getorder_list = $getorder = $getorderby = $offset = $page = $perpage = NULL;
// $perpage = 20;
$perpage = PERPAGE;
// $offset = OFFSET;
$offset = 0;
$page = 1;

// $perpage_allowed = array(2,40,60);
$company_model = new CompanyModel();
$general_model = new GeneralModel();

$getorder_allowed_list = $company_model->getorder_allowed_list();
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

$api_url = env('API_URL').'company/get_list';
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.3/vue.min.js"></script>
	
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	
<script type="text/javascript" src="{{ $base_url }}public/js/jquery.shiftcheckbox.js"></script>

<style>

</style>

<!-- CONTENT AREA -->
<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-body">
				<div class="card-title">
					<h3 class="b">{{ $PAGE_TITLE}}</h3>
				</div>
				
				@if (session('message'))
					{!! session('message') !!}
				@endif
				
				<a href="<?php echo $base_url.Request::segment(1).DS.Request::segment(2) . '?do=insert' ?>" class="btn btn-primary btn-sm insert"><i class="fa fa-plus" aria-hidden="true"></i> {{ $companylang['add_new'] }}</a><br/><br/>

				<form method="get" action="<?php echo current_full_url()?>">
					<input type="search" name="keyword" class="form-control wdt30-pct display-inline"  placeholder="{{ $lang['search_input'] }}" value="<?php echo (isset($getkeyword) ? $getkeyword : NULL ); ?>" />
					<button class="btn btn-default btn-sm" type="submit">{{ $lang['search'] }}</button><br/><br/>
				
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
				
				<form method="post" action="{{ base_url().Request::segment(1).DS.'bulk' }}">
					<div class="table-responsive">
						<table class="table table-striped table-bordered" id="table_company">
							<tr class="b">
								<td width=1><input type="checkbox" class="chkbox togglebox" onclick="togglebox()" /></td>
								<td width=1>#</td>
								<td width="150px"><a class="{{ $arrsort['company_id']['class'] }}" title="{{ $arrsort['company_id']['title'] }}" href="{{ $arrsort['company_id']['url'] }}">CompanyID {!! $arrsort['company_id']['icon'] !!}</a></td>
								<td width="180px"><a class="{{ $arrsort['company_name']['class'] }}" title="{{ $arrsort['company_name']['title'] }}" href="{{ $arrsort['company_name']['url'] }}">CompanyName {!! $arrsort['company_name']['icon'] !!}</a></td>
								<td><a class="{{ $arrsort['company_address']['class'] }}" title="{{ $arrsort['company_address']['title'] }}" href="{{ $arrsort['company_address']['url'] }}">CompanyAddress {!! $arrsort['company_address']['icon'] !!}</a></td>
								<td width="180px"><a class="{{ $arrsort['company_phone']['class'] }}" title="{{ $arrsort['company_phone']['title'] }}" href="{{ $arrsort['company_phone']['url'] }}">CompanyPhone {!! $arrsort['company_phone']['icon'] !!}</a></td>
								<td width="180px"><a class="{{ $arrsort['company_pic']['class'] }}" title="{{ $arrsort['company_pic']['title'] }}" href="{{ $arrsort['company_pic']['url'] }}">CompanyPIC {!! $arrsort['company_pic']['icon'] !!}</a></td>
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
									$id = $rs['company_id'];
									$idcol = 'company_id';
							?>
							
							<tr>
								<td class="parentcheckbox"><input type="checkbox" name="chkbox[]" id="chkbox[]" class="chkbox" value="<?php echo $i?>"/></td>
								<td>{{ $i }}</td>
								<td>{{ $rs['company_id'] }}</td>
								<td>{{ $rs['company_name'] }}</td>
								<td>{{ $rs['company_address'] }}</td>
								<td>{{ $rs['company_phone'] }}</td>
								<td>{{ $rs['company_pic'] }}</td>
								<td class="talCnt">{!! $general_model->show_record_status($rs['status']) !!}</td>
								<td class="talCnt">
								<a style="margin-right:6px" href="<?php echo Request::segment(2).'?do=edit&'.$idcol.'='.$id; ?>" title="Edit data" alt="Edit data"><i class="clrBlu fa fa-pencil-square-o fa-lg"></i></a> 
								<a href="<?php echo Request::segment(2).DS.'delete?'.$idcol.'='.$id; ?>" onclick=""><i class="clrRed fa fa-times fa-lg" title="Delete data" alt="Delete data"  onclick="return doConfirm()"></i></a>
								</td>
							</tr>
							<?php
								}
							?>
							<tr>
								<td colspan="100%">
									<div id="group_action">With checked do 
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
// Shift checkbox
$('.parentcheckbox').shiftcheckbox({
	checkboxSelector : ':checkbox',
	//selectAll        : $('.chkbox '),
	ignoreClick      : 'a',
});

function doConfirm(str = 'delete') {
	if (str == 'delete') {
		str = 'Yakin menghapus data ini ?'
	} else 
		str = 'Yakin melakukan aksi ini ?'
	return confirm(str)
}
	
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

