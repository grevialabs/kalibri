<?php 

function env($attr=NULL)
{
	$file = ".env";
	$myfile = fopen($file, "r") or die("No ENV detected. Please setup env file");
	$read = fread($myfile,filesize($file));
	
	$arr = explode(PHP_EOL,$read);

	$result = array();
	if (! empty($arr)) 
	{
		foreach ($arr as $k => $arrval)
		{
			//check contain = and not contain #
			if (strpos($arrval,'=') !== FALSE && strpos($arrval,'#') !== TRUE) {
				$tmp = NULL;
				$tmp = explode('=',$arrval);
				$result[$tmp[0]] = $tmp[1];
			}
		}
	}
	
	fclose($myfile);
	// debug('jalani',1);
	if (! empty($result) && isset($attr) && isset($result[$attr])) {
		$result = $result[$attr];
	} 

	return $result;
}

function debug($data, $die=false)
{
	echo "<pre>";
	print_r($data);
	echo "<pre>";
    if ($die) die; 
}

function replace_quote($str,$type='num')
{
	$str = "'" . $str . "'";
	return $str;
};

function get_datetime()
{
	return date('Y-m-d H:i:s');
}

// Hit curl project for scraper fachrie 12 september 2018
function curlf($url)
{
	$useragent = NULL;
	// $useragent = 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/32.0.1700.107 Chrome/32.0.1700.107 Safari/537.36';
	// $useragent = '';
	$useragent = '';
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
	// curl_setopt($ch, CURLOPTGET, true);	
	//curl_setopt($ch, CURLOPT_POST, true);
	//curl_setopt($ch, CURLOPT_POSTFIELDS, "username=XXXXX&password=XXXXX");
	
	// Using proxy
	$arr_proxy = array(
		
		// '36.67.85.3:8080', // all local indo proxy
		// '150.107.251.26:8080',
		// '182.30.225.36:8080',
		// '182.253.130.178:8080',
		
		// elite from https://premproxy.com/proxy-by-country/Indonesia-01.htm
		'139.255.112.129:53281',
		'114.7.5.214:53281',
		'182.16.171.1:53281',
	);
	// curl_setopt($ch, CURLOPT_PROXY , $arr_proxy[mt_rand(0,count($arr_proxy)-1)]);     // return web page
	
	// curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER , true);     // return web page
	curl_setopt($ch, CURLOPT_HEADER         , false);    // don't return headers
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION , true);     // follow redirects
	curl_setopt($ch, CURLOPT_ENCODING       , "");       // handle all encodings
	// curl_setopt($ch, CURLOPT_USERAGENT      , "spider"); // who am i
	curl_setopt($ch, CURLOPT_AUTOREFERER    , true);     // set referer on redirect
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT , 120);      // timeout on connect
	curl_setopt($ch, CURLOPT_TIMEOUT        , 120);      // timeout on response
	curl_setopt($ch, CURLOPT_MAXREDIRS      , 10);       // stop after 10 redirects
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER , false);    // Disabled SSL Cert checks
	curl_setopt($ch, CURLOPT_VERBOSE 		, true);     // Disabled SSL Cert checks
	
	$resp = curl_exec($ch);
	if (curl_error($ch)) {
		echo curl_error($ch);
	}
	return $resp;
}

// formula = format string to scrape
function ambilkata($source, $formula,$formula2 = NULL)
{
	$tmp = $tmp2 = $ret = NULL;
	
	$tmp = $source;
	// $tmp = explode($buka.$formula.$tutup,$tmp);
	$tmp = explode($formula,$tmp);
	// debug($tmp,1);
	if (isset($tmp[1])) {
		$tmp2 = explode($formula2,$tmp[1]);
		
		$ret = $tmp2;
		if (isset($tmp2[0])) {
			$ret = $tmp2[0];
			// remove prefix depan
			// $ret = str_replace($buka,'',$ret);
		}
	}
	// debug($ret);
	// die;
	$ret = trim($ret);
	return $ret;
}

function redirect($url)
{
	header('Location: '.$url);
	// header("Location: http://www.yourwebsite.com/user.php"); /* Redirect browser */
	exit();
}
?>