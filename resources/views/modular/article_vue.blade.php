<?php 
// debug($data,1);
// debug($api['param']);
// echo http_build_query($api['param']).'<hr/>';
// die;
// <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
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
			
			<table class="table table-striped" id="table_article">
				<tr>
					<td>#</td>
					<td>Nameaa</td>
					<td>Slug</td>
					<td>Status</td>
					<td>Option</td>
				</tr>
				<?php 
				$dataraw = $listdata = $total_rows = NULL;
				if (! empty($data)) $data = $dataraw = json_decode($data,1);
				if (isset($data['data'])) $listdata = $data['data'];
				if (isset($data['total_rows'])) $total_rows = $data['total_rows'];
				
				
				// debug($listdata);
				if (! empty($dataraw)) 
				{

				?>
				<tr v-for="(rs, key) in listdata">
					<td>@{{ key + 1}}</td>
					<td>@{{ rs.title}}</td>
					<td>@{{ rs.category_name}}</td>
					<td>@{{ rs.view}}</td>
					<td>@{{ rs.view}}</td>
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
			</table>
			
			<div id="article">
				<div id="div_table_article">
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
		</div>
	</div>
</div>

<script>

<?php 

// $dataraw = $listdata = $total_rows = NULL;
// if (! empty($data)) $data = $dataraw = json_decode($data,1);
if (isset($data['data'])) $listdata = $data['data'];
// if (isset($data['total_rows'])) $total_rows = $data['total_rows'];
?>
var listdata = <?php echo json_encode($listdata) ?>


var vue = new Vue({
  el:'#table_article', 
  data: {
	  
  }
})

</script>