<?php 
// debug($data,1);
?>

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
			
			<table class="table table-striped">
				<tr>
					<td>#</td>
					<td>Name</td>
					<td>Slug</td>
					<td>Status</td>
					<td>Option</td>
				</tr>
				<?php 
				$listdata = $total_rows = NULL;
				if (isset($data['data'])) $listdata = $data['data'];
				if (isset($data['total_rows'])) $total_rows = $data['total_rows'];
				
				if (! empty($listdata)) 
				{
					// debug('jalannih');
					// debug($listdata,1);
					$ct = 0;
					foreach ($listdata as $data) 
					{
						$ct++;
				?>
				<tr>
					<td><?php echo $ct; ?></td>
					<td>{{ $data['category_name'] }}</td>
					<td>{{ $data['category_slug'] }}</td>
					<td>{{ $data['title'] }}</td>
					<td>{{ $data['slug'] }}</td>
				</tr>
				<?php 
					}
				}
				?>
			</table>
			
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
var app = angular.module('myApp', []);
app.controller('customersCtrl', function($scope) {
    $scope.names = [
      { "Name" : "Max Joe", "City" : "Lulea", "Country" : "Sweden" },
      { "Name" : "Manish", "City" : "Delhi", "Country" : "India" },
      { "Name" : "Koniglich", "City" : "Barcelona", "Country" : "Spain" },
      { "Name" : "Wolski", "City" : "Arhus", "Country" : "Denmark" }
    ];
});
</script>