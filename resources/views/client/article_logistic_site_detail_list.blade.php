<?php 
$get = $getkeyword = $getorder_allowed_list = $getorderby_allowed_list = $getorder_list = $getorder = $getorderby = $offset = $page = $perpage = NULL;
// $perpage = 20;
$perpage = PERPAGE;
// $offset = OFFSET;
$offset = 0;
$page = 1;

// $perpage_allowed = array(2,40,60);
$article_logistic_site_detail_model = new ArticleLogisticSiteDetailModel();
$general_model = new GeneralModel();

$getorder_allowed_list = $article_logistic_site_detail_model->getorder_allowed_list();
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

$api_url = env('API_URL').'article_logistic_site_detail/get_list';
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
				
				<!-- <a href="<?php //echo $base_url.Request::segment(1).DS.Request::segment(2) . '?do=insert' ?>" class="btn btn-primary btn-sm btninsert"><i class="fa fa-plus" aria-hidden="true"></i> {{ $article_logistic_site_detail_lang['add_new'] }}</a><br/><br/> -->

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
								<td width="150px"><a class="{{ $arrsort['article_logistic_site_detail_id']['class'] }}" title="{{ $arrsort['article_logistic_site_detail_id']['title'] }}" href="{{ $arrsort['article_logistic_site_detail_id']['url'] }}">{{ $article_logistic_site_detail_lang['article_logistic_site_detail_id'] }} {!! $arrsort['article_logistic_site_detail_id']['icon'] !!}</a></td>
								<td width="180px"><a class="{{ $arrsort['outbound_delivery']['class'] }}" title="{{ $arrsort['outbound_delivery']['title'] }}" href="{{ $arrsort['outbound_delivery']['url'] }}">{{ $article_logistic_site_detail_lang['outbound_delivery'] }} {!! $arrsort['outbound_delivery']['icon'] !!}</a></td>
								<td width="150px"><a class="{{ $arrsort['article']['class'] }}" title="{{ $arrsort['article']['title'] }}" href="{{ $arrsort['article']['url'] }}">{{ $article_logistic_site_detail_lang['article'] }} {!! $arrsort['article']['icon'] !!}</a></td>
								<td width="150px"><a class="{{ $arrsort['customer_article']['class'] }}" title="{{ $arrsort['customer_article']['title'] }}" href="{{ $arrsort['customer_article']['url'] }}">{{ $article_logistic_site_detail_lang['customer_article'] }} {!! $arrsort['customer_article']['icon'] !!}</a></td>
								<td width="150px"><a class="{{ $arrsort['description']['class'] }}" title="{{ $arrsort['description']['title'] }}" href="{{ $arrsort['description']['url'] }}">{{ $article_logistic_site_detail_lang['description'] }} {!! $arrsort['description']['icon'] !!}</a></td>
								<td width="150px"><a class="{{ $arrsort['qty_issue']['class'] }}" title="{{ $arrsort['qty_issue']['title'] }}" href="{{ $arrsort['qty_issue']['url'] }}">{{ $article_logistic_site_detail_lang['qty_issue'] }} {!! $arrsort['qty_issue']['icon'] !!}</a></td>
								<td width="150px"><a class="{{ $arrsort['conv_uom']['class'] }}" title="{{ $arrsort['conv_uom']['title'] }}" href="{{ $arrsort['conv_uom']['url'] }}">{{ $article_logistic_site_detail_lang['conv_uom'] }} {!! $arrsort['conv_uom']['icon'] !!}</a></td>
								<td width="150px"><a class="{{ $arrsort['qty_receive_actual']['class'] }}" title="{{ $arrsort['qty_receive_actual']['title'] }}" href="{{ $arrsort['qty_receive_actual']['url'] }}">{{ $article_logistic_site_detail_lang['qty_receive_actual'] }} {!! $arrsort['qty_receive_actual']['icon'] !!}</a></td>
								<td width="150px"><a class="{{ $arrsort['qty_receive']['class'] }}" title="{{ $arrsort['qty_receive']['title'] }}" href="{{ $arrsort['qty_receive']['url'] }}">{{ $article_logistic_site_detail_lang['qty_receive'] }} {!! $arrsort['qty_receive']['icon'] !!}</a></td>
								<td width="150px"><a class="{{ $arrsort['disc_minus']['class'] }}" title="{{ $arrsort['disc_minus']['title'] }}" href="{{ $arrsort['disc_minus']['url'] }}">{{ $article_logistic_site_detail_lang['disc_minus'] }} {!! $arrsort['disc_minus']['icon'] !!}</a></td>
								<td width="150px"><a class="{{ $arrsort['disc_plus']['class'] }}" title="{{ $arrsort['disc_plus']['title'] }}" href="{{ $arrsort['disc_plus']['url'] }}">{{ $article_logistic_site_detail_lang['disc_plus'] }} {!! $arrsort['disc_plus']['icon'] !!}</a></td>
								<td width="150px"><a class="{{ $arrsort['conversion_diff']['class'] }}" title="{{ $arrsort['conversion_diff']['title'] }}" href="{{ $arrsort['conversion_diff']['url'] }}">{{ $article_logistic_site_detail_lang['conversion_diff'] }} {!! $arrsort['conversion_diff']['icon'] !!}</a></td>
								<td width="150px"><a class="{{ $arrsort['dashboard_received_date']['class'] }}" title="{{ $arrsort['dashboard_received_date']['title'] }}" href="{{ $arrsort['dashboard_received_date']['url'] }}">{{ $article_logistic_site_detail_lang['dashboard_received_date'] }} {!! $arrsort['dashboard_received_date']['icon'] !!}</a></td>
								<td width="150px"><a class="{{ $arrsort['qty_chamber']['class'] }}" title="{{ $arrsort['qty_chamber']['title'] }}" href="{{ $arrsort['qty_chamber']['url'] }}">{{ $article_logistic_site_detail_lang['qty_chamber'] }} {!! $arrsort['qty_chamber']['icon'] !!}</a></td>
								<td width="150px"><a class="{{ $arrsort['chamber_disc_minus']['class'] }}" title="{{ $arrsort['chamber_disc_minus']['title'] }}" href="{{ $arrsort['chamber_disc_minus']['url'] }}">{{ $article_logistic_site_detail_lang['chamber_disc_minus'] }} {!! $arrsort['chamber_disc_minus']['icon'] !!}</a></td>
								<td width="150px"><a class="{{ $arrsort['chamber_disc_plus']['class'] }}" title="{{ $arrsort['chamber_disc_plus']['title'] }}" href="{{ $arrsort['chamber_disc_plus']['url'] }}">{{ $article_logistic_site_detail_lang['chamber_disc_plus'] }} {!! $arrsort['chamber_disc_plus']['icon'] !!}</a></td>
								
								<td width="2">Status</td>
								<!-- <td width="30px" class="talCnt">Option</td> -->
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
									$id = $rs['article_logistic_site_detail_id'];
									$idcol = 'article_logistic_site_detail_id';
							?>
							
							<tr>
								<td class="parentcheckbox"><input type="checkbox" name="chkbox[]" id="chkbox[]" class="chkbox" value="<?php echo $i?>"/></td>
								<td>{{ $i }}</td>
								<td>{{ $rs['article_logistic_site_detail_id'] or '' }} <br/> <a style="margin-right:6px" href="<?php echo Request::segment(2).'?do=edit&'.$idcol.'='.$id; ?>" title="Edit data" alt="Edit data"><i class="clrBlu fa fa-pencil-square-o fa-lg btnedit"></i></a> </td>
								<td>{{ $rs['outbound_delivery'] or '' }}</td>
								<td>{{ $rs['article'] or '' }}</td>
								<td>{{ $rs['customer_article'] or '' }}</td>
								<td>{{ $rs['description'] or '' }}</td>
								<td>{{ $rs['qty_issue'] or '' }}</td>
								<td>{{ $rs['conv_uom'] or '' }}</td>
								<td>{{ $rs['qty_receive_actual'] or '' }}</td>
								<td>{{ $rs['qty_receive'] or '' }}</td>
								<td>{{ $rs['disc_minus'] or '' }}</td>
								<td>{{ $rs['disc_plus'] or '' }}</td>
								<td>{{ $rs['conversion_diff'] or '' }}</td>
								<td>{{ $rs['dashboard_received_date'] or '' }}</td>
								<td>{{ $rs['qty_chamber'] or '' }}</td>
								<td>{{ $rs['chamber_disc_minus'] or '' }}</td>
								<td>{{ $rs['chamber_disc_plus'] or '' }}</td>
                                
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

