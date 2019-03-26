<?php 
$get = $getkeyword = $getorder_allowed_list = $getorderby_allowed_list = $getorder_list = $getorder = $getorderby = $offset = $page = $perpage = NULL;
// $perpage = 20;
$perpage = PERPAGE;
// $offset = OFFSET;
$offset = 0;
$page = 1;

// $perpage_allowed = array(2,40,60);
$transaction_model = new TransactionModel();
$general_model = new GeneralModel();

$getorder_allowed_list = $transaction_model->getorder_allowed_list();
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
// debug($arrsort['transaction_id']['class'],1);

$api_url = env('API_URL').'transaction/get_list';
$api_method = 'get';
// $api_header['debug'] = 1;
$data = curl_api_liquid($api_url, $api_method, $api_header, $api_param);

if (! empty($data)) $data = json_decode($data,1);
if (isset($data['data'])) $listdata = $data['data'];
if (isset($data['total_rows'])) $total_rows = $data['total_rows'];

// debug($listdata,1);

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
				
				<!-- <a href="<?php //echo $base_url.Request::segment(1).DS.Request::segment(2) . '?do=insert' ?>" class="btn btn-primary btn-sm insert"><i class="fa fa-plus" aria-hidden="true"></i> {{ $transactionlang['add_new'] }}</a><br/><br/> -->

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
						<table class="table table-striped table-bordered" id="table_transaction">
							<tr class="b">
								<td width=1><input type="checkbox" class="chkbox togglebox" onclick="togglebox()" /></td>
								<td width=1>#</td>
								<td width="150px"><a class="{{ $arrsort['transaction_id']['class'] or '' }}" title="{{ $arrsort['transaction_id']['title'] or '' }}" href="{{ $arrsort['transaction_id']['url'] or '' }}">{{ $transactionlang['transaction_id'] or '' }} {!! $arrsort['transaction_id']['icon'] or '' !!}</a></td>
								<td width="150px"><a class="{{ $arrsort['site_id']['class'] or '' }}" title="{{ $arrsort['site_id']['title'] or '' }}" href="{{ $arrsort['site_id']['url'] or '' }}">{{ $transactionlang['site_id'] or '' }} {!! $arrsort['site_id']['icon'] or '' !!}</a></td>
								<td width="150px"><a class="{{ $arrsort['qty']['class'] or '' }}" title="{{ $arrsort['qty']['title'] or '' }}" href="{{ $arrsort['qty']['url'] or '' }}">{{ $transactionlang['qty'] or '' }} {!! $arrsort['qty']['icon'] or '' !!}</a></td>
								<td width="150px"><a class="{{ $arrsort['value']['class'] or '' }}" title="{{ $arrsort['value']['title'] or '' }}" href="{{ $arrsort['value']['url'] or '' }}">{{ $transactionlang['value'] or '' }} {!! $arrsort['value']['icon'] or '' !!}</a></td>
								<td width="150px"><a class="{{ $arrsort['status_in_out']['class'] or '' }}" title="{{ $arrsort['status_in_out']['title'] or '' }}" href="{{ $arrsort['status_in_out']['url'] or '' }}">{{ $transactionlang['status_in_out'] or '' }} {!! $arrsort['status_in_out']['icon'] or '' !!}</a></td>
								<td width="150px"><a class="{{ $arrsort['wo_wbs']['class'] or '' }}" title="{{ $arrsort['wo_wbs']['title'] or '' }}" href="{{ $arrsort['wo_wbs']['url'] or '' }}">{{ $transactionlang['wo_wbs'] or '' }} {!! $arrsort['wo_wbs']['icon'] or '' !!}</a></td>
								<td width="150px"><a class="{{ $arrsort['article']['class'] or '' }}" title="{{ $arrsort['article']['title'] or '' }}" href="{{ $arrsort['article']['url'] or '' }}">{{ $transactionlang['article'] or '' }} {!! $arrsort['article']['icon'] or '' !!}</a></td>
								<td width="150px"><a class="{{ $arrsort['customer_article']['class'] or '' }}" title="{{ $arrsort['customer_article']['title'] or '' }}" href="{{ $arrsort['customer_article']['url'] or '' }}">{{ $transactionlang['customer_article'] or '' }} {!! $arrsort['customer_article']['icon'] or '' !!}</a></td>
							    <td width="200px">{{ $lang['created_at'] }}</td>
								<td width="200px">{{ $lang['updated_at'] }}</td>
								<td width="2">Status</td>
								<td width="50px" class="talCnt">{{ $lang['option'] }}</td>
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
									$id = $rs['transaction_id'];
									$idcol = 'transaction_id';
							?>
							
							<tr>
								<td class="parentcheckbox"><input type="checkbox" name="chkbox[]" id="chkbox[]" class="chkbox" value="<?php echo $i?>"/></td>
								<td>{{ $i }}</td>
								<td>{{ $rs['transaction_id'] or '' }}  <br/> <a style="margin-right:6px" href="<?php echo Request::segment(2).'?do=edit&'.$idcol.'='.$id; ?>" title="Edit data" alt="Edit data"><i class="clrBlu fa fa-pencil-square-o fa-lg btnedit"></i></a> </td>
								<td>{{ $rs['site_id'] or '' }}</td>
								<td>{{ $rs['qty'] or '' }}</td>
								<td>{{ $rs['value'] or '' }}</td>
								<td>{{ $rs['status_in_out'] or '' }}</td>
								<td>{{ $rs['wo_wbs'] or '' }}</td>
								<td>{{ $rs['article'] or '' }}</td>
								<td>{{ $rs['customer_article'] or '' }}</td>							
								<td>{{ $rs['created_at'] or '' }}</td>							
								<td>{{ $rs['updated_at'] or '' }}</td>							
								<td class="talCnt">{!! $general_model->show_record_status($rs['status']) !!}</td>
                                <td class="talCnt">
								<!-- <a href="<?php //echo Request::segment(2).DS.'delete?'.$idcol.'='.$id; ?>" onclick=""><i class="clrRed fa fa-trash fa-lg btndelete" title="Delete data" alt="Delete data"  onclick="return doConfirm()"></i></a> -->
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

