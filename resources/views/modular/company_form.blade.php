<?php 
// debug($data,1);
// debug($api['param']);
// echo http_build_query($api['param']).'<hr/>';
// die;
// <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
// $json = '{"totaldata":3,"rowdata":[{"company_id":1,"company_name":"PT Yamaha","company_address":"Jl PRJ","company_phone":"021123456","company_pic":"Bejo","status":1,"created_at":null,"created_by":null,"created_ip":null,"updated_at":null,"updated_by":null,"updated_ip":null},{"company_id":2,"company_name":"PT Honda Indah Pertama","company_address":"Jl bidara no 9","company_phone":"11021312","company_pic":"Astra","status":1,"created_at":null,"created_by":null,"created_ip":null,"updated_at":null,"updated_by":null,"updated_ip":null},{"company_id":3,"company_name":"Beogradiant","company_address":"Jl laksa","company_phone":"2250212312","company_pic":"Saiful","status":1,"created_at":null,"created_by":null,"created_ip":null,"updated_at":null,"updated_by":null,"updated_ip":null}]}';

// echo "from company list";
// debug($json,1);
// debug($);
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.3/vue.min.js"></script>

<!-- Article AREA -->
<div class="container">
	<div class="row">
		<div class="col-sm-12 talCnt" style="padding: 35px 0 15px 0">
			<h3 class="b">{{ $PAGE_TITLE}}</h3>
		</div>
		
		<!--
		-->
		<div class="col-sm-2">
		</div>
		
		<div class="col-sm-8 col-sm-offset-2">
			@if (session('message'))
				{!! session('message') !!}
			@endif
			
			<form method="post" action="{{ base_url().Request::segment(1).DS.'insert' }}">
				<div class="row">
					<div class="col-sm-12">
						<div class="md-form">
							<input type="text" id="company_name" name="company_name" class="form-control" required />
							<label for="company_name" >Company Name</label>
						</div>
					</div>
					<div class="col-sm-12">
						<div class="md-form">
							<textarea type="text" id="company_address" name="company_address" class="form-control md-textarea" required rows="2"></textarea>
							<label for="company_address" >Company Address</label>
						</div>
					</div>
					
					<div class="col-sm-12">
						<div class="md-form">
							<input type="text" id="company_phone" name="company_phone" class="form-control" required />
							<label for="company_phone" >Company Phone</label>
						</div>
					</div>
					<div class="col-sm-12">
						<div class="md-form">
							<input type="text" id="company_pic" name="company_pic" class="form-control" required />
							<label for="company_pic" >Company PIC</label>
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