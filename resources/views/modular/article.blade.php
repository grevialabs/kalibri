<?php 
// debug($data,1);
// debug($api['param']);
// echo http_build_query($api['param']).'<hr/>';
// die;
?>

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
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

$dataraw = $listdata = $total_rows = NULL;
if (! empty($data)) $data = $dataraw = json_decode($data,1);
if (isset($data['data'])) $listdata = $data['data'];
if (isset($data['total_rows'])) $total_rows = $data['total_rows'];
?>

var api_secretkey = '<?php echo $api['secretkey'] ?>'
var api_url = '<?php echo $api['url'] ?>'
var listdata = []

axios.defaults.headers = {
	'Content-Type': 'application/json',
	Secretkey: api_secretkey
}

var vue = new Vue({
  el:'#article', 
})

const getListArticle = async () => {
	return await axios.get(api_url)
	.then(response => {
		// this.listdata = response.data
		load_article(response.data,'div_table_article')
	})
}

getListArticle()
  
function load_article(objArticle, tableId = 'div_table_article') {
	// var objArticle = this.listdata.data
	// var objArticle = this.listdata.data
	// var totalRows = this.listdata.total_rows
	
	if (! objArticle) return false;
	
	var objlist = objArticle.data
	var totalRows = objArticle.total_rows
	
	var append = ''
	if (objlist) 
	{
		append += 'Total ' + totalRows + ' data'
		append += '<table class="table table-striped" id="table_article">'
		append += '<tr>'
		append += '<td>#</td>'
		append += '<td>Name</td>'
		append += '<td>Slug</td>'
		append += '<td>Status</td>'
		append += '<td>Option</td>'
		append += '</tr>'
		
		var cnt = 0
		for (i in objlist) {
			cnt+=1
			append += '<tr>'
			append += '<td>' + cnt + '</td>'
			append += '<td>' + objlist[i].title + '</td>'
			append += '<td>' + objlist[i].category_name + '</td>'
			append += '<td>' + objlist[i].view + '</td>'
			append += '<td>' + objlist[i].email + '</td>'
			append += '</tr>'
		}
		append += '</table>'
		
	} else {
		append += '<div class="alert alert-warning">Data tidak tersedia</div>'
	}
	$('#' + tableId).html(append)
	
}
</script>