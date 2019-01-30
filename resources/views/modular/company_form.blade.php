<?php 
// ---------------------------
// Get data 
$api_url = $api_method = $api_param = $api_header = $data = NULL;
$api_param['token'] = env('API_KEY');
$api_param['company_id'] = $get['company_id'];

$api_url = env('API_URL').'company/get';
$api_method = 'get';
// $api_header['debug'] = 1;
$data = curl_api_liquid($api_url, $api_method, $api_header, $api_param);
// debug('gebleg<hr/>');
// debug($data);
// debug('<br/>gebleg2<hr/>');
if (! empty($data)) $data = json_decode($data,1);
// debug($data,1);

$action = '';

// if ($get['do'] == 'insert') $action = $commonlang['add'];
// else if ($get['do'] == 'edit') $action = $commonlang['edit'];

// $PAGE_TITLE = $action .' '. $companylang['module']; 

?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.3/vue.min.js"></script>

<!-- Article AREA -->
<div class="container">
	<div class="row">
		<div class="col-sm-12 talCnt" style="padding: 35px 0 15px 0">
			<h3 class="b">{{ $PAGE_HEADER }}</h3>
		</div>
		
		<!--
		-->
		<div class="col-sm-2">
			
		</div>
		
		<div class="col-sm-8 col-sm-offset-2">
			@if (session('message'))
				{!! session('message') !!}
			@endif
			
			<form method="post" action="{{ $form_url }}">
				<div class="row">
					<?php if (isset($data['company_id'])) { ?>
					<div class="col-sm-12">
						<div class="md-form">
							<input type="text" id="company_id" class="form-control" value="{{ $data['company_id'] }}" disabled />
							<input type="hidden" name="company_id" value="{{ $data['company_id'] }}" />
							
							<label for="company_id" >Company ID</label>
						</div>
					</div>
					<?php } ?>
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
						<?php 
						if ($get['do'] == 'insert') {
						?>
						<button type="submit" class="btn btn-primary btn-md">{{ $commonlang['insert'] }}</button>
						<?php 
						} else if ($get['do'] == 'edit') {
						?>
						<button type="submit" class="btn btn-primary btn-md">{{ $commonlang['update'] }}</button>
						<?php 
						}
						?>
					</div>
				</div>
			</form>
		</div>
		<div class="col-sm-2">
		</div>
	</div>
</div>

<script>
$(document).ready( function() {
	
	<?php 
    if (! empty($data)) 
    {
        foreach ($data as $key => $rs) 
        { 
        ?>
	$('#{{ $key }}').val('{{$rs}}');
	$('#{{ $key }}').trigger('change');
	<?php 
        }
    }

    ?>
})
</script>