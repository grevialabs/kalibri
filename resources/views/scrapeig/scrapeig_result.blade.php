<br/>
<br/>
<h2>{!! $PAGE_TITLE !!}</h2>
@if (! empty($data))
	<table class="table table-bordered">
	<tr class="bgBlu b clrWht">
		<td>#</td>
		<td>username</td>
		<td>fullname</td>
		<td>follower</td>
		<td>following</td>
		<td>biodata</td>
		<td>location</td>
		<td>joindate</td>
		<td>profilepic</td>
		<td>sumlikes</td>
		<td>sumtweets</td>
		<td>url</td>
	</tr>
	@foreach ($data as $key => $rs) 
		<tr>
			<td>{!! $key+=1; !!}</td>
			<td>{!! $rs['username'] !!}</td>
			<td>{!! html_entity_decode($rs['fullname']) !!}</td>
			<td>{!! $rs['follower'] !!}</td>
			<td>{!! $rs['following'] !!}</td>
			<td>{!! html_entity_decode($rs['biodata']) !!}</td>
			<td>{!! html_entity_decode($rs['location']) !!}</td>
			<td>{!! $rs['join_date'] !!}</td>
			<td>{!! $rs['profilepic'] !!}</td>
			<td>{!! $rs['sumlikes'] !!}</td>
			<td>{!! $rs['sumtweets'] !!}</td>
			<td>{!! $rs['url'] !!}</td>
		</tr>
	@endforeach
	
	</table>
@endif
