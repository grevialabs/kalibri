<?php 
// debug(currentPageUrl(),1);

// debug($data,1);
// debug($api['param']);
// echo http_build_query($api['param']).'<hr/>';
// die;
// <script src="https://unpkg.com/axios/dist/axios.min.js"></script>


// $json = 'awe';
// $data = json_decode($data,1);
// echo "from company list";
// debug($data,1);
// debug($PAGE_TITLE,1);

$offset = 0;
$page = 1;
if (isset($_GET['page']) && $_GET['page'] > 1) $page = $_GET['page'];

$total_rows = $list_data = NULL;
$dataperpage = 1;
if ($page > 0) $offset = ($page - 1) * $dataperpage;

$api_param = NULL;
// $api_param['secretkey'] = env('API_KEY');
$api_param['token'] = env('API_KEY');
$api_param['perpage'] = $dataperpage;
$api_param['offset'] = $offset;
// debug($api_param);

$api_url = env('API_URL').'company/get_list';
$api_method = 'get';
// $api_header['debug'] = 1;

$data = curl_api_liquid($api_url, $api_method, NULL, $api_param);
// debug($data);

$obj_list_company = NULL;

$obj_list_company = $data;

?>

<style>
.pagination{display:inline-block;padding-left:0;margin:20px 0;border-radius:4px}.pagination>li{display:inline}.pagination>li>a,.pagination>li>span{position:relative;float:left;padding:6px 12px;margin-left:-1px;line-height:1.42857143;color:#337ab7;text-decoration:none;background-color:#fff;border:1px solid #ddd}.pagination>li:first-child>a,.pagination>li:first-child>span{margin-left:0;border-top-left-radius:4px;border-bottom-left-radius:4px}.pagination>li:last-child>a,.pagination>li:last-child>span{border-top-right-radius:4px;border-bottom-right-radius:4px}.pagination>li>a:focus,.pagination>li>a:hover,.pagination>li>span:focus,.pagination>li>span:hover{z-index:2;color:#23527c;background-color:#eee;border-color:#ddd}.pagination>.active>a,.pagination>.active>a:focus,.pagination>.active>a:hover,.pagination>.active>span,.pagination>.active>span:focus,.pagination>.active>span:hover{z-index:3;color:#fff;cursor:default;background-color:#337ab7;border-color:#337ab7}.pagination>.disabled>a,.pagination>.disabled>a:focus,.pagination>.disabled>a:hover,.pagination>.disabled>span,.pagination>.disabled>span:focus,.pagination>.disabled>span:hover{color:#777;cursor:not-allowed;background-color:#fff;border-color:#ddd}.pagination-lg>li>a,.pagination-lg>li>span{padding:10px 16px;font-size:18px;line-height:1.3333333}.pagination-lg>li:first-child>a,.pagination-lg>li:first-child>span{border-top-left-radius:6px;border-bottom-left-radius:6px}.pagination-lg>li:last-child>a,.pagination-lg>li:last-child>span{border-top-right-radius:6px;border-bottom-right-radius:6px}.pagination-sm>li>a,.pagination-sm>li>span{padding:5px 10px;font-size:12px;line-height:1.5}.pagination-sm>li:first-child>a,.pagination-sm>li:first-child>span{border-top-left-radius:3px;border-bottom-left-radius:3px}.pagination-sm>li:last-child>a,.pagination-sm>li:last-child>span{border-top-right-radius:3px;border-bottom-right-radius:3px}
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.3/vue.min.js"></script>

<!-- Article AREA -->
<div class="container">
	<div class="row">
		<div class="col-sm-12 talCnt" style="padding-top: 35px">
			<h3 class="b">{{ $PAGE_TITLE}}</h3>
		</div>
		
		<div class="col-sm-2">
		</div>
		<div class="col-sm-8">
			@if (session('message'))
				{!! session('message') !!}
			@endif
			
			<table class="table table-striped" id="table_company">
				<tr>
					<td>#</td>
					<td>Name</td>
					<td>Address</td>
					<td>Phone</td>
					<td>PIC</td>
					<td>Status</td>
					<td>Option</td>
				</tr>
				<?php 
				$dataraw = $listdata = $total_rows = NULL;
				if (! empty($data)) $data = json_decode($data,1);
				
				if (isset($data['data'])) $listdata = $data['data'];
				if (isset($data['total_rows'])) $total_rows = $data['total_rows'];
				
				// debug($total_rows);
				// debug($listdata,1);
				if (! empty($listdata)) 
				{

					$i = 0;
					if (is_numeric($page) && $page > 0) 
					{
						$i = ($page - 1) * $dataperpage;
					}
					
					foreach ($listdata as $key => $rs) 
					{
				?>
				
				<tr>
					<td>{{ $key + 1}}</td>
					<td>{{ $rs['company_name'] }}</td>
					<td>{{ $rs['company_address'] }}</td>
					<td>{{ $rs['company_phone'] }}</td>
					<td>{{ $rs['company_pic'] }}</td>
					<td>{{ $rs['status'] }}</td>
					<td>{{ $rs['status'] }}</td>
				</tr>
				<?php 
					}
				
					// <tr v-for="(rs, key) in listdata">
						// <td>@{{ key + 1}}</td>
						// <td>@{{ rs.company_name}}</td>
						// <td>@{{ rs.company_address}}</td>
						// <td>@{{ rs.company_phone}}</td>
						// <td>@{{ rs.company_pic}}</td>
						// <td>@{{ rs.status}}</td>
						// <td>@{{ rs.status}}</td>
					// </tr>
				} 
				else 
				{
					?>
					<tr>
						<td colspan="100%">Data tidak tersedia</td>
					</tr>
					<?php
				}
				// debug($data,1);
				?>
			</table>
			
			<?php if ( ! empty($obj_list_company)) echo common_paging($total_rows, $dataperpage); ?>
			
			<!--
			<div id="company">
				<div id="div_table_company">
					<i class="fa fa-cog fa-spin fa-2x fa-fw"></i> Loading...
					<span class="sr-only">Loading...</span>
				</div>
			</div>
			
			<form method="post">
				<div class="md-form">
					<i class="fa fa-user prefix"></i>
					<input type="text" id="email" class="form-control" name="email" required>
					<label for="email" >Email</label>
				</div>
				
				<div class="md-form">
					<i class="fa fa-lock prefix"></i>
					<input type="password" id="inputValidationEx2" class="form-control validate" name="password" required>
					<label for="inputValidationEx2" data-error="wrong" data-success="right">Password</label>
				</div>
				
				<div>
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="submit" class="btn btn-primary btn-md" />
				</div>
			</form>
			-->
		</div>
		<div class="col-sm-2">

		</div>
	</div>
</div>

<script>

<?php 

// $dataraw = $listdata = $total_rows = NULL;
// if (! empty($data)) $data = $dataraw = json_decode($data,1);
if (!empty($data['data'])) $listdata = $data['data'];
// if (isset($data['total_rows'])) $total_rows = $data['total_rows'];
?>
var listdata = <?php echo json_encode($listdata) ?>


var vue = new Vue({
  el:'#table_company', 
  data: {
	  
  }
})

</script>