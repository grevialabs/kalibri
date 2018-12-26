<?php 
require ('core.php');

$q = "SELECT * FROM scr_username ORDER BY username_id DESC";
$PAGE_TITLE = 'Preview';
$PAGE_DESCRIPTION = 'Hal yang menampilkan user twitter yang telah dicrawl datanya';
$listdata = orm_get_list($q);

$data = $listdata['data'];
?>

<?php include('layout_header.php');?>

<div class="col-sm-12">
	<br/>
    <h2><?php echo $PAGE_TITLE ?></h2>
    <h6><?php echo $PAGE_DESCRIPTION ?></h6>
	<?php if (! empty($data)) { ?>
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
			<td>Scrapedate</td>
		</tr>
		<?php foreach ($data as $key => $rs) { ?>
			<tr>
				<td><?php echo $key+=1; ?></td>
				<td><?php echo $rs['username'] ?></td>
				<td><?php echo html_entity_decode($rs['fullname']) ?></td>
				<td><?php echo $rs['follower'] ?></td>
				<td><?php echo $rs['following'] ?></td>
				<td><?php echo html_entity_decode($rs['biodata']) ?></td>
				<td><?php echo html_entity_decode($rs['location']) ?></td>
				<td><?php echo $rs['join_date'] ?></td>
				<td><?php echo $rs['profilepic'] ?></td>
				<td><?php echo $rs['sumlikes'] ?></td>
				<td><?php echo $rs['sumtweets'] ?></td>
				<td><?php echo date('d-m-Y H:i',strtotime($rs['creator_date'])) ?></td>
			</tr>
		<?php } ?>
		
		</table>
	<?php } ?>
</div>

<?php include('layout_footer.php');?>
