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
				// debug($data,1);
				// $obj = $data;
				$listdata = $data['rowdata'];
				// $listdata= json_decode($listdata);
				// debug($listdata);
				if (! empty($listdata)) 
				{
					$ct = 0;
					foreach ($listdata as $data) 
					{
						$ct++;
				?>
				<tr>
					<td><?php echo $ct; ?></td>
					<td>{{ $data['name'] }}</td>
					<td>{{ $data['slug'] }}</td>
					<td>{{ $data['status'] }}</td>
					<td>{{ $data['status'] }}</td>
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