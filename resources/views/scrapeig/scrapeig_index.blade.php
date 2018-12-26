<?php 

$get = NULL;
if ($_GET) $get = $_GET;
?>
<h2>Scrape Instagram</h2>
<form>
	<input type="text" class="input br wdtFul" name="username" value="<?php if (isset($get['username'])) echo $get['username']; ?>" />
	<input type="submit" class="btn btn btn-submit" value="Submit" />
</form>

<?php 
// $q = "
// SELECT scrape_id, username 
// FROM scr_scrape s
// WHERE 1 AND s.is_scrape = 0
// LIMIT 1
// ";

// $data = orm_get($q);

// // No data process, die
// if (empty($data)) {
	// $output['message'] = 'no data to process';
	// echo json_encode($output);
	// die;
// }

if (! $get) die;
// ==============================================
// Do curl start  

$username = $get['username'];

// example
// $url = 'https://instagram.com/rusdikarsandi';
// $url = 'http://localhost/patriot/scrapeig_sampledata';
// 
// $url = 'http://grevialabs.com/scrapeig_sampledata';
$url = 'https://www.instagram.com/'.$username.'/?hl=en';
// https://www.instagram.com/rusdikarsandi/?hl=en
debug($url);
$content = curlf($url);

$content = preg_replace('/\s{2,}+/', '',$content);
// $tutup = ' data-is-compact';

// $objusername = NULL;
// $objusername = new Patriot\Models\Scrapetw\Username;
// $objusername->username = $username;

// open = 'window._sharedData = {';
// close = '};<span';
// debug($content,1);

$jsondata = 'window._sharedData = {';
$tutup = '};<';
$jsondata = '{'.ambilkata($content,$jsondata,$tutup).'}';
$jsondata = json_decode($jsondata,1);

if (isset($jsondata['entry_data'])) $get = $jsondata['entry_data']['ProfilePage'][0]['graphql']['user'];

// $predata[''] = 
// $follower = ;
// $following = ;
debug('hasildata<hr/>');
debug($get,1);
// debug('<hr/>');
// debug($content,1);
// debug($jsondata,1);
// $objusername->sumtweets = $out['tweet'];

// $tweet = '<span class="u-hiddenVisually">Tweet, halaman saat ini.</span><span class="ProfileNav-value"data-count=';
// $out['tweet'] = ambilkata($content,$tweet,$tutup);
// $objusername->sumtweets = $out['tweet'];

// $location = '<span class="ProfileHeaderCard-locationText u-dir" dir="ltr">';
// $tutup = '</span>';
// $out['location'] = ambilkata($content,$location,$tutup);

// example output : 22.21 - 2 Sep 2011
$join_date = 'class="ProfileHeaderCard-joinDateText js-tooltip u-dir" dir="ltr" title="';
$tutup = '"';
$join_date = ambilkata($content,$join_date,$tutup);

if (isset($join_date) && $join_date != '') {
	
	$join_date = explode(' - ',$join_date);
	$join_date = $join_date[1].','.$join_date[0];
	$join_date = date('Y-m-d H:i:s', strtotime($join_date));
}

// $objusername->location = $out['location'];
// $objusername->fullname = $out['fullname'];
// $objusername->biodata = htmlentities($out['biodata']);
// // $objusername->biodata = htmlentities($out['biodata'], ENT_QUOTES, "UTF-8");
// $objusername->join_date = $join_date;
// $objusername->is_scrape = 1;
// $objusername->creator_date = get_datetime();

// $save = $objusername->save();

// ------------------------------
// update table scrape
// $objscrape = Patriot\Models\Scrapetw\Scrape::find($data['scrape_id']);
// // $objscrape->get_user = 1; // scrape done
// $objscrape->is_scrape = 1; // scrape done
// $update = $objscrape->save();

$response = NULL;
$response['message'] = 'Scrape failed';
if ($update) $response['message'] = 'Scrape success';

echo json_encode($response);
die;
// Do curl end  
// ==============================================

?>