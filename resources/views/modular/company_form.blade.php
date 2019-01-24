<?php 
// debug($data,1);
// debug($api['param']);
// echo http_build_query($api['param']).'<hr/>';
// die;
// <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
// $json = '{"totaldata":3,"rowdata":[{"company_id":1,"company_name":"PT Yamaha","company_address":"Jl PRJ","company_phone":"021123456","company_pic":"Bejo","status":1,"created_at":null,"created_by":null,"created_ip":null,"updated_at":null,"updated_by":null,"updated_ip":null},{"company_id":2,"company_name":"PT Honda Indah Pertama","company_address":"Jl bidara no 9","company_phone":"11021312","company_pic":"Astra","status":1,"created_at":null,"created_by":null,"created_ip":null,"updated_at":null,"updated_by":null,"updated_ip":null},{"company_id":3,"company_name":"Beogradiant","company_address":"Jl laksa","company_phone":"2250212312","company_pic":"Saiful","status":1,"created_at":null,"created_by":null,"created_ip":null,"updated_at":null,"updated_by":null,"updated_ip":null}]}';

// echo "from company list";
// debug($json,1);
$post = NULL;
if ($_POST)
{
	$post = $_POST;
	
	$param = NULL;
	// $param[''] = $post[''];
	$param['company_name'] = $post['name'];
	$param['company_address'] = $post['address'];
	$param['company_phone'] = $post['phone'];
	$param['company_pic'] = $post['pic'];
	$param['created_at'] = get_datetime();
	$param['created_by'] = 1;
	$param['created_ip'] = get_ip();
	// $param['company_token'] = env('API_KEY');
	
	$api_url = env('API_URL').'company';
	$api_method = 'post';
	
	// $api_header['debug'] = 1;
	$api_header['token'] = env('API_KEY');

	$save = curl_api_liquid($api_url, $api_method, $api_header, $param);
	
	if (isset($save)) {
		$save = json_decode($save,1);
		
		if ($save['is_success']) 
			debug('mantap jiwa');
		else 
			debug('gagal maning');
	}
	
	// debug($save,1);
}	
// debug($);
?>

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
			
			<form method="post">
				<div class="row">
					<div class="col-sm-12">
						<div class="md-form">
							<input type="text" id="name" name="name" class="form-control" required />
							<label for="name" >Name</label>
						</div>
					</div>
					<div class="col-sm-12">
						<div class="md-form">
							<textarea type="text" id="address" name="address" class="form-control md-textarea" required rows="2"></textarea>
							<label for="address" >Address</label>
						</div>
					</div>
					
					<div class="col-sm-12">
						<div class="md-form">
							<input type="text" id="phone" name="phone" class="form-control" required />
							<label for="phone" >Phone</label>
						</div>
					</div>
					<div class="col-sm-12">
						<div class="md-form">
							<input type="text" id="pic" name="pic" class="form-control" required />
							<label for="pic" >PIC</label>
						</div>
					</div>
					
					<div>
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="submit" class="btn btn-primary btn-md" />
					</div>
				</div>
			</form>
		</div>
		<div class="col-sm-2">
		</div>
	</div>
</div>

<script>

</script>