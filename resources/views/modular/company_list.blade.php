<?php 
// getorder_list
$arrsort = NULL;
$get = $getkeyword = $getorder_allowed_list = $getorderby_allowed_list = $getorder_list = $getorder = $getorderby = $offset = $page = $perpage = NULL;
$perpage = 2;
	
$offset = 0;
$page = 1;
// $getorder_allowed_list = array('company_id','company_name','company_phone','company_address','company_pic');
// $getorder_allowed_list = GeneralModel::getOrderAllowedList();

// $perpage_allowed = array(2,40,60);
$company_model = new CompanyModel();
$general_model = new GeneralModel();

$getorder_allowed_list = $company_model->getorder_allowed_list();
$getorderby_allowed_list = $general_model->getorderby_allowed_list();
$perpage_allowed = $general_model->perpage_allowed();

// debug($getorder_allowed_list,1);

if (isset($_GET)) $get = $_GET;
if (isset($get['page']) && $get['page'] > 1) $page = $get['page'];
if (isset($get['perpage']) && in_array($get['perpage'],$perpage_allowed)) $perpage = $get['perpage'];
if (isset($get['keyword'])) $getkeyword = $get['keyword'];
if (isset($get['order']) && in_array($get['order'],$getorder_allowed_list)) $getorder = $get['order'];
if (isset($get['orderby']) && in_array($get['orderby'],$getorderby_allowed_list)) $getorderby = $get['orderby'];

if ($page > 0) $offset = ($page - 1) * $perpage;

// Hit api
$api_url = $api_method = $api_param = $api_header = NULL;
$api_param['token'] = env('API_KEY');
$api_param['perpage'] = $perpage;
$api_param['offset'] = $offset;
if (isset($getkeyword)) $api_param['keyword'] = $getkeyword; 
if (isset($getorder)) $api_param['order'] = $getorder; else $getorder = $getorder_allowed_list[0];
if (isset($getorderby)) $api_param['orderby'] = $getorderby; else $getorderby = $getorderby_allowed_list[0];

$api_url = env('API_URL').'company/get_list';
$api_method = 'get';
// $api_header['debug'] = 1;

$data = NULL;
$data = curl_api_liquid($api_url, $api_method, $api_header, $api_param);
// debug($data);

$dataraw = $listdata = $total_rows = NULL;
if (! empty($data)) $data = json_decode($data,1);

if (isset($data['data'])) $listdata = $data['data'];
if (isset($data['total_rows'])) $total_rows = $data['total_rows'];

// $arrsort
foreach ($getorder_allowed_list as $k => $rso) {
	$icon = '<i class="fa fa-arrow-down"></i>';
	// $icon = 'ladwad';
	$tmporderby = '';
	$tmpget = NULL;
	$tmpget = $get;
	
	$arrsort[$rso]['class'] = 'text-info b';
	
	if (isset($getorder) && $getorder == $rso) {
		
		$arrsort[$rso]['class'] = 'text-danger b';
		if ($getorderby == ASC) {
			$icon = '<i class="fa fa-arrow-down"></i>';
			$tmpget['orderby'] = DESC;
		} elseif ($getorderby == DESC) {
			// debug($rso. ' : '.$getorder);
			$icon = '<i class="fa fa-arrow-up"></i>';
			$tmpget['orderby'] = ASC;
		}
	} else {
		$tmpget['orderby'] = DESC;
		$icon = '<i class="fa fa-arrow-down"></i>';
	}
	$tmpget['order'] = $rso;
	$arrsort[$rso]['url'] = current_url().'?'.http_build_query($tmpget);
	$arrsort[$rso]['icon'] = $icon;
	$arrsort[$rso]['title'] = 'Sort by ' . $rso . ' '. $tmpget['orderby'];
// debug($arrsort,1);
}

// debug($current_full_url,1);

$companylang = $commonlang = NULL;
$companylang = Lang::get('modular/company');
$commonlang = Lang::get('common');
// debug($commonlang,1);

$reget = NULL;
if (! empty($get)) {
	$reget = $get;
}

if (isset($perpage)) {
	$reget = $get;
	$reget['perpage'] = '';
}

$reget = http_build_query($reget);

?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.3/vue.min.js"></script>

<script>
function resubmit(obj)
{
	var url = obj.value;
	var reget = '<?php echo current_url().'?'.$reget?>';
	window.location = reget + url;
}
</script>

<!-- CONTENT AREA -->
<div class="container">
	<div class="row">
		<div class="col-sm-12 talCnt" style="padding-top: 35px">
			<h3 class="b">{{ $PAGE_TITLE}}</h3>
		</div>
		
		<div class="col-sm-2">
			
		</div>
		<div class="col-sm-10">
			@if (session('message'))
				{!! session('message') !!}
			@endif
			
			<a href="<?php echo base_url().'company_form'.DS.'insert' ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> {{ $companylang['add_new'] }}</a><br/><br/>
			
			<form method="get" action="<?php echo current_full_url()?>">
				<input type="search" name="keyword" class="form-control wdt30-pct display-inline"  placeholder="{{ $commonlang['search'] }}" value="<?php echo (isset($getkeyword) ? $getkeyword : NULL ); ?>" />
				<button class="btn btn-default btn-sm" type="submit">{{ $commonlang['search'] }}</button><br/><br/>
			
				Showing
				<select name="perpage" class="input" onchange="return resubmit(this)">
					<option <?php if (isset($perpage) && $perpage == 2) echo "selected" ?>>2</option>
					<option <?php if (isset($perpage) && $perpage == 40) echo "selected" ?>>40</option>
					<option <?php if (isset($perpage) && $perpage == 60) echo "selected" ?>>60</option>
				</select>
				
				{{ $commonlang['found'] }} <?php echo $total_rows ?> {{ $commonlang['data_found'] }}<br/>
				
			</form>
			<table class="table table-striped" id="table_company">
				<tr>
					<td>#</td>
					<td><a class="{{ $arrsort['company_name']['class'] }}" title="{{ $arrsort['company_name']['title'] }}" href="{{ $arrsort['company_name']['url'] }}">CompanyName {!! $arrsort['company_name']['icon'] !!}</a></td>
					<td><a class="{{ $arrsort['company_address']['class'] }}" title="{{ $arrsort['company_address']['title'] }}" href="{{ $arrsort['company_address']['url'] }}">CompanyAddress {!! $arrsort['company_address']['icon'] !!}</a></td>
					<td><a class="{{ $arrsort['company_phone']['class'] }}" title="{{ $arrsort['company_phone']['title'] }}" href="{{ $arrsort['company_phone']['url'] }}">CompanyPhone {!! $arrsort['company_phone']['icon'] !!}</a></td>
					<td><a class="{{ $arrsort['company_pic']['class'] }}" title="{{ $arrsort['company_pic']['title'] }}" href="{{ $arrsort['company_pic']['url'] }}">CompanyPIC {!! $arrsort['company_pic']['icon'] !!}</a></td>
					<td>Status</td>
					<td>Option</td>
				</tr>
				<?php 
				if (! empty($listdata)) 
				{

					$i = 0;
					if (is_numeric($page) && $page > 0) 
					{
						$i = ($page - 1) * $perpage;
					}
					
					foreach ($listdata as $key => $rs) 
					{
						$i++;
				?>
				
				<tr>
					<td>{{ $i }}</td>
					<td>{{ $rs['company_name'] }}</td>
					<td>{{ $rs['company_address'] }}</td>
					<td>{{ $rs['company_phone'] }}</td>
					<td>{{ $rs['company_pic'] }}</td>
					<td>{{ $rs['status'] }}</td>
					<td>{{ $rs['status'] }}</td>
				</tr>
				<?php
					}
				} 
				else 
				{
					?>
					<tr>
						<td colspan="100%">{{ $commonlang['data_not_found'] }}</td>
					</tr>
					<?php
				}
				?>
			</table>
			
			<?php if ( ! empty($listdata)) echo common_paging($total_rows, $perpage); ?>
			
		</div>	
	</div>
</div>

