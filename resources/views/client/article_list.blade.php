<?php 
$get = $getkeyword = $getorder_allowed_list = $getorderby_allowed_list = $getorder_list = $getorder = $getorderby = $offset = $page = $perpage = NULL;
// $perpage = 20;
$perpage = PERPAGE;
// $offset = OFFSET;
$offset = 0;
$page = 1;

// $perpage_allowed = array(2,40,60);
$article_model = new ArticleModel();
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

$api_url = env('API_URL').'article/get_list';
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

<script>

</script>
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
				
				<a href="<?php echo $base_url.Request::segment(1).DS.Request::segment(2) . '?do=insert' ?>" class="btn btn-primary btn-sm btninsert"><i class="fa fa-plus" aria-hidden="true"></i> {{ $articlelang['add_new'] }}</a><br/><br/>

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
						<table class="table table-striped table-bordered" id="table_article">
							<tr class="b">
								<td width=1><input type="checkbox" class="chkbox togglebox" onclick="togglebox()" /></td>
								<td width=1>#</td>
								<td width="150px"><a class="{{ $arrsort['article_id']['class'] }}" title="{{ $arrsort['article_id']['title'] }}" href="{{ $arrsort['article_id']['url'] }}">{{ $articlelang['article_id'] }} {!! $arrsort['article_id']['icon'] !!}</a></td>
								<td width="150px"><a class="{{ $arrsort['site_id']['class'] }}" title="{{ $arrsort['site_id']['title'] }}" href="{{ $arrsort['site_id']['url'] }}">{{ $articlelang['site_id'] }} {!! $arrsort['site_id']['icon'] !!}</a></td>
								<td width="180px"><a class="{{ $arrsort['article']['class'] }}" title="{{ $arrsort['article']['title'] }}" href="{{ $arrsort['article']['url'] }}">{{ $articlelang['article'] }} {!! $arrsort['article']['icon'] !!}</a></td>
								<td width="180px"><a class="{{ $arrsort['customer_article']['class'] }}" title="{{ $arrsort['customer_article']['title'] }}" href="{{ $arrsort['customer_article']['url'] }}">{{ $articlelang['customer_article'] }} {!! $arrsort['customer_article']['icon'] !!}</a></td>
								<td width="180px"><a class="{{ $arrsort['description']['class'] }}" title="{{ $arrsort['description']['title'] }}" href="{{ $arrsort['description']['url'] }}">{{ $articlelang['description'] }} {!! $arrsort['description']['icon'] !!}</a></td>
								<td width="180px"><a class="{{ $arrsort['uom']['class'] }}" title="{{ $arrsort['uom']['title'] }}" href="{{ $arrsort['uom']['url'] }}">{{ $articlelang['uom'] }} {!! $arrsort['uom']['icon'] !!}</a></td>
								<td width="180px"><a class="{{ $arrsort['conversion_value']['class'] }}" title="{{ $arrsort['conversion_value']['title'] }}" href="{{ $arrsort['conversion_value']['url'] }}">{{ $articlelang['conversion_value'] }} {!! $arrsort['conversion_value']['icon'] !!}</a></td>
								<td width="180px"><a class="{{ $arrsort['safety_stock']['class'] }}" title="{{ $arrsort['safety_stock']['title'] }}" href="{{ $arrsort['safety_stock']['url'] }}">{{ $articlelang['safety_stock'] }} {!! $arrsort['safety_stock']['icon'] !!}</a></td>
								<td width="180px"><a class="{{ $arrsort['column']['class'] }}" title="{{ $arrsort['column']['title'] }}" href="{{ $arrsort['column']['url'] }}">{{ $articlelang['column'] }} {!! $arrsort['column']['icon'] !!}</a></td>
								<td width="180px"><a class="{{ $arrsort['rack']['class'] }}" title="{{ $arrsort['rack']['title'] }}" href="{{ $arrsort['rack']['url'] }}">{{ $articlelang['rack'] }} {!! $arrsort['rack']['icon'] !!}</a></td>
								<td width="180px"><a class="{{ $arrsort['row']['class'] }}" title="{{ $arrsort['row']['title'] }}" href="{{ $arrsort['row']['url'] }}">{{ $articlelang['row'] }} {!! $arrsort['row']['icon'] !!}</a></td>
								<td width="180px"><a class="{{ $arrsort['price']['class'] }}" title="{{ $arrsort['price']['title'] }}" href="{{ $arrsort['price']['url'] }}">{{ $articlelang['price'] }} {!! $arrsort['price']['icon'] !!}</a></td>
								
								<td width="2">Status</td>
								<td width="30px" class="talCnt">Option</td>
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
									$id = $rs['article_id'];
									$idcol = 'article_id';
							?>
							
							<tr>
								<td class="parentcheckbox"><input type="checkbox" name="chkbox[]" id="chkbox[]" class="chkbox" value="<?php echo $i?>"/></td>
								<td>{{ $i }}</td>
								<td>{{ $rs['article_id'] }} <br/> <a style="margin-right:6px" href="<?php echo Request::segment(2).'?do=edit&'.$idcol.'='.$id; ?>" title="Edit data" alt="Edit data"><i class="clrBlu fa fa-pencil-square-o fa-lg btnedit"></i></a> </td>
								<td>{{ $rs['site_id'] }}</td>
								<td>{{ $rs['company_address'] }}</td>
								<td>{{ $rs['company_phone'] }}</td>
								<td>{{ $rs['company_pic'] }}</td>
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
									<button class="btn btn-default btn-sm btnedit" name="btn_group_action" value="1">Action</button></div>
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

