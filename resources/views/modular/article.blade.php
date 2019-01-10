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
				<table class="table table-striped">
					<tr>
						<td>#</td>
						<td>Name</td>
						<td>Slug</td>
						<td>Status</td>
						<td>Option</td>
					</tr>
					<?php 
					$dataraw = $listdata = $total_rows = NULL;
					if (! empty($data)) $data = $dataraw = json_decode($data,1);
					if (isset($data['data'])) $listdata = $data['data'];
					if (isset($data['total_rows'])) $total_rows = $data['total_rows'];
					
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
					?>
				</table>
				
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
var listdata = <?php echo json_encode($listdata)?>;
var vue = new Vue({
  el:'#article',
  // data: listdata
});

var api_secretkey = '<?php echo $api['secretkey'] ?>'

var data = [];
// let headers = {
axios.defaults.headers = {
	'Content-Type': 'application/json',
	Secretkey: api_secretkey
}

var api_url = '<?php echo $api['url'] ?>'
// var test = []
// test['article_id'] = 1
// console.log(test)
const getListArticle = async () => {
  var url = '<?php echo env('API_URL').'article/get_list'; ?>';
  // var api_method = '<?php echo $api['method'] ?>'
  try {
    await axios.get(api_url)
	.then(response => {
		console.log('Response ', response.data)
	})
	.catch(e => {
		console.log('Error: ', e.response.data)
	})

	
  } catch (error) {
    console.error(error)
  }
} 

getListArticle()


// --------------------------------------

// const hitApi = async () => {
  // var api_url = '<?php echo $api['url'] ?>?article_id=1';
  // try {
    // return await axios.get(api_url)
  // } catch (error) {
    // console.error(error)
  // }
// }

// const getData = async () => {
  // const listArticle = await hitApi()
  // console.log(listArticle)
  // if (listArticle.data.message) {
    // console.log(`Got ${Object.entries(listArticle.data.message).length} listArticle`)
  // }
// }

// getData()
// --------------------------------------
// const getBreeds = async () => {
  // try {
    // return await axios.get('https://dog.ceo/api/breeds/list/all')
  // } catch (error) {
    // console.error(error)
  // }
// }
// getBreeds()

// const countBreeds = async () => {
  // const breeds = await getBreeds()
  // console.log(breeds)
  // if (breeds.data.message) {
    // console.log(`Got ${Object.entries(breeds.data.message).length} breeds`)
  // }
// }

// countBreeds()
// --------------------------------------

// const getBreeds = () => {
  // try {
    // return axios.get('https://dog.ceo/api/breeds/list/all')
  // } catch (error) {
    // console.error(error)
  // }
// }

// const countBreeds = async () => {
  // const breeds = getBreeds()
    // .then(response => {
      // if (response.data.message) {
        // console.log(response.data)
		// console.log(`Got ${Object.entries(response.data.message).length} breeds`)
      // }
    // })
    // .catch(error => {
      // console.log(error)
    // })
// }

// countBreeds()
</script>