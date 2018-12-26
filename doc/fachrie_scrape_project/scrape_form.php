<?php 
require ('core.php');

$PAGE_TITLE = 'Scrapelist';
$PAGE_DESCRIPTION = 'Hal untuk menambahkan user twitter yang ingin diambil datanya';

if ($_POST)
{
	$post = array();
	$post = $_POST;
	// debug($post,1);

	if (isset($post['username'])) 
	{
		$param = NULL;
		$param['username'] = $post['username'];
		$param['creator_date'] = get_datetime();
		$save = orm_save('scr_scrape',$param);

		if ($save) 
			$message = '<div class="alert alert-info">Save data ' . $post['username'] . ' berhasil</div>';
		else 
			$message = '<div class="alert alert-warning">Save gagal. Mohon coba kembali</div>';
	}
}

$q = "SELECT * FROM scr_scrape ORDER BY scrape_id DESC";
$listdata = orm_get_list($q);
$data = $listdata['data'];
?>

<?php include('layout_header.php');?>

<div class="col-sm-12">
	<br/>
    <h2><?php echo $PAGE_TITLE ?></h2>
    <h6><?php echo $PAGE_DESCRIPTION ?></h6>

	<?php if (isset($message)) echo $message; ?>

	<form method="post" action="">
		<div class="md-form">
			<input type="text" id="username" name="username" class="form-control" /><br/>
			<label for="username" >Twitter @</label>
		</div>
		<div class="md-form">
			<input type="submit" class="btn btn-sm btn-primary" />
		</div>
	</form>

	<?php if (! empty($data)) { ?>
		<i class="fa fa-check clrGrn"></i> = sudah scrape<br/>
		<i class="fa fa-times clrRed"></i> = belum scrape
		<table class="table table-bordered">
		<tr class="bgBlu b clrWht talCnt">
			<td width="1px">#</td>
			<td>username</td>
			<td>status</td>
			<td>InputDate</td>
			<td>Option</td>
		</tr>
		<?php foreach ($data as $key => $rs) { ?>
		<?php
			$is_scrape = '<i class="fa fa-check clrGrn"></i>';
			if (!$rs['is_scrape']) $is_scrape = '<i class="fa fa-times clrRed"></i>'; 	
		?>
			<tr>
				<td width="1px"><?php echo $key+=1; ?></td>
				<td><?php echo $rs['username'] ?></td>
				<td class="talCnt"><?php echo $is_scrape ?></td>
				<td class="talCnt"><?php echo date('d-m-Y H:i',strtotime($rs['creator_date'])) ?></td>
				<td>&nbsp;</td>
			</tr>
		<?php } ?>
		
		</table>
	<?php } ?>
</div>

<?php include('layout_footer.php');?>
