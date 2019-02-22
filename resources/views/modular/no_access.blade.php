<!-- LOGIN AREA -->
<!--
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
			
			<div class="talCnt">
				You dont have access to this page
			</div>
		</div>
		<div class="col-sm-2">
		</div>
	</div>
</div>
-->

<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-body">
				<div class="card-title" style="min-height:300px">
					<div class="talCnt" style="font-size:18px; padding:125px 0 0 0">
						You don't have access to this page.<br/>
						Please contact administrator or superior if you need access.<br/>
						<a href="javascript:history.go(-1)" class="btn btn-primary btn-md">Back to page</a>
					</div>
				
				</div>
			</div>
		</div>
	</div>
</div>