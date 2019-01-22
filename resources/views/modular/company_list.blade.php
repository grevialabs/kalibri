<?php 
// debug($data,1);
// debug($api['param']);
// echo http_build_query($api['param']).'<hr/>';
// die;
// <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
$data = '{"totaldata":3,"data":[{"company_id":1,"company_name":"PT Yamaha","company_address":"Jl PRJ","company_phone":"021123456","company_pic":"Bejo","status":1,"created_at":null,"created_by":null,"created_ip":null,"updated_at":null,"updated_by":null,"updated_ip":null},{"company_id":2,"company_name":"PT Honda Indah Pertama","company_address":"Jl bidara no 9","company_phone":"11021312","company_pic":"Astra","status":1,"created_at":null,"created_by":null,"created_ip":null,"updated_at":null,"updated_by":null,"updated_ip":null},{"company_id":3,"company_name":"Beogradiant","company_address":"Jl laksa","company_phone":"2250212312","company_pic":"Saiful","status":1,"created_at":null,"created_by":null,"created_ip":null,"updated_at":null,"updated_by":null,"updated_ip":null}]}';
// $json = 'awe';
// $data = json_decode($data,1);
// echo "from company list";
// debug($data,1);
// debug($PAGE_TITLE,1);
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
				// debug('yamete',1);
				if (isset($data['data'])) $listdata = $data['data'];
				if (isset($data['total_rows'])) $total_rows = $data['total_rows'];
				
				
				// debug($listdata,1);
				// debug($total_rows);
				if (! empty($listdata)) 
				{

				?>
				<tr v-for="(rs, key) in listdata">
					<td>@{{ key + 1}}</td>
					<td>@{{ rs.company_name}}</td>
					<td>@{{ rs.company_address}}</td>
					<td>@{{ rs.company_phone}}</td>
					<td>@{{ rs.company_pic}}</td>
					<td>@{{ rs.status}}</td>
					<td>@{{ rs.status}}</td>
				</tr>
				<?php 
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
			</-------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
			
			<div id="company">
				<div id="div_table_company">
					<i class="fa fa-cog fa-spin fa-2x fa-fw"></i> Loading...
					<span class="sr-only">Loading...</span>
				</div>
			</div>
			
			<!--
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
		<?php // debug($data); ?>
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