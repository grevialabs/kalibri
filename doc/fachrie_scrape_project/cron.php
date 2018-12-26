<?php 
require ('core.php');

$q = "
SELECT scrape_id, username 
FROM scr_scrape s
WHERE 1 AND s.is_scrape = 0
LIMIT 1
";

$data = orm_get($q);

// orm_save($table,$paramdata);
// 
// orm_update($table,primary_key,$update_id,$paramdata);
//

// No data process, die
if (empty($data)) {
	$output['message'] = 'no data to process';
	echo json_encode($output);
	die;
}

// ==============================================
// Do curl start  

$username = $data['username'];

// example
// $url = 'https://twitter.com/ARLJ4';
$url = 'https://twitter.com/'.$username.'?lang=id';
$content = curlf($url);
// debug($content,1);

$content = preg_replace('/\s{2,}+/', '',$content);
$tutup = ' data-is-compact';

$objusername = NULL;
$objusername['username'] = $username;

$tweet = '<span class="u-hiddenVisually">Tweet, halaman saat ini.</span><span class="ProfileNav-value"data-count=';
$out['tweet'] = ambilkata($content,$tweet,$tutup);
$objusername['sumtweets'] = $out['tweet'];

$following = '<span class="u-hiddenVisually">Mengikuti</span><span class="ProfileNav-value" data-count=';
$out['following'] = ambilkata($content,$following,$tutup);
$objusername['following'] = $out['following'];

$follower = '<span class="u-hiddenVisually">Pengikut</span><span class="ProfileNav-value" data-count=';
$out['follower'] = ambilkata($content,$follower,$tutup);
$objusername['follower'] = $out['follower'];

// $objusername-> = $out[''];
$like = '<span class="u-hiddenVisually">Suka</span><span class="ProfileNav-value" data-count=';
$out['like'] = ambilkata($content,$like,$tutup);
$objusername['sumlikes'] = $out['like'];

$location = '<span class="ProfileHeaderCard-locationText u-dir" dir="ltr">';
$tutup = '</span>';
$out['location'] = ambilkata($content,$location,$tutup);

$fullname = 'class="ProfileHeaderCard-nameLink u-textInheritColor js-nav">';
$tutup = '</a>';
$out['fullname'] = ambilkata($content,$fullname,$tutup);

$biodata = '<p class="ProfileHeaderCard-bio u-dir" dir="ltr">';
$tutup = '</p>';
$out['biodata'] = ambilkata($content,$biodata,$tutup);

// example output : 22.21 - 2 Sep 2011
$join_date = 'class="ProfileHeaderCard-joinDateText js-tooltip u-dir" dir="ltr" title="';
$tutup = '"';
$join_date = ambilkata($content,$join_date,$tutup);

if (isset($join_date) && $join_date != '') {
	
	$join_date = explode(' - ',$join_date);
	$join_date = $join_date[1].','.$join_date[0];
	$join_date = date('Y-m-d H:i:s', strtotime($join_date));
}

$objusername['location'] = $out['location'];
$objusername['fullname'] = $out['fullname'];
$objusername['biodata'] = htmlentities($out['biodata']);
$objusername['join_date'] = $join_date;
$objusername['is_scrape'] = 1;
$objusername['creator_date'] = get_datetime();

$image = '<img class="ProfileAvatar-image " src="';
$tutup = '"';
$objusername['profilepic'] = ambilkata($content,$image,$tutup);

$save = orm_save('scr_username',$objusername);

// ------------------------------
// update table scrape

$tmp = array();
$tmp['is_scrape'] = 1;
$update = orm_update('scr_scrape','scrape_id',$data['scrape_id'],$tmp);

$response = NULL;
$response['message'] = 'Scrape failed';
if ($update) $response['message'] = 'Scrape success for '.$username;

echo json_encode($response);
die;
// Do curl end  
// ==============================================

?>