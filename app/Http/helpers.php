<?php 
function get_datetime()
{
	return date('Y-m-d H:i:s');
}

function debug($data,$die = 0)
{
	echo "<pre>";
	print_r($data);
	echo "</pre>";
	
	if ($die) die;
}

function curl_api_lumen($url, $attr = NULL)
{
	$httpheader = $param = array();
	$httpheader[] = 'Token: macbook';
	
	//
	if (isset($attr['debug'])) $param['debug'] = $attr['debug'];
	
	$param['httpheader'] = $httpheader;
	$param['useragent'] = 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/32.0.1700.107 Chrome/32.0.1700.107 Safari/537.36';
	// $param[''] = ;
	
	$return = curl($url, $param);
	
	return $return;
}

function curl_api_grevia($url, $attr = NULL)
{
	$httpheader = $param = array();
	$httpheader[] = 'Secretkey: grevia';
	
	//
	if (isset($attr['debug'])) $param['debug'] = $attr['debug'];
	
	$param['httpheader'] = $httpheader;
	$param['useragent'] = 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/32.0.1700.107 Chrome/32.0.1700.107 Safari/537.36';
	// $param[''] = ;
	
	$return = curl($url, $param);
	
	return $return;
}

function curl($url, $attr = NULL)
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	
	// curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/32.0.1700.107 Chrome/32.0.1700.107 Safari/537.36');
	
	if (isset($attr['useragent'])) {
		curl_setopt($ch, CURLOPT_USERAGENT,$attr['useragent']);
	}
	
	if (isset($attr['httpheader'])) {
		curl_setopt($ch, CURLOPT_HTTPHEADER,$attr['httpheader']);
	}
	// curl_setopt($ch, CURLOPTGET, true);	
	//curl_setopt($ch, CURLOPT_POST, true);
	//curl_setopt($ch, CURLOPT_POSTFIELDS, "username=XXXXX&password=XXXXX");
	
	// // Using proxy
	// $arr_proxy = array(
		// // '187.44.1.167:8080', // BZ
		// // '123.205.131.69:21776', // taiwan
		// // '139.59.207.66:8080', // SG
		// // '163.47.11.113:3128', // SG
		
		// '36.67.85.3:8080', // all local indo proxy
		// '150.107.251.26:8080',
		// '182.30.225.36:8080',
		// '182.253.130.178:8080',
		// // '',
	// );
	// curl_setopt($ch, CURLOPT_PROXY , $arr_proxy[mt_rand(0,count($arr_proxy)-1)]);     // return web page
	
	// curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER , true);     // return web page
	curl_setopt($ch, CURLOPT_HEADER         , false);    // don't return headers
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION , true);     // follow redirects
	curl_setopt($ch, CURLOPT_ENCODING       , "");       // handle all encodings
	curl_setopt($ch, CURLOPT_USERAGENT      , "spider"); // who am i
	curl_setopt($ch, CURLOPT_AUTOREFERER    , true);     // set referer on redirect
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT , 120);      // timeout on connect
	curl_setopt($ch, CURLOPT_TIMEOUT        , 120);      // timeout on response
	curl_setopt($ch, CURLOPT_MAXREDIRS      , 10);       // stop after 10 redirects
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER , false);    // Disabled SSL Cert checks
	curl_setopt($ch, CURLOPT_VERBOSE 		, true);     // Show info
	
	
	if (isset($attr['debug'])) {
		// debugging process
		$resp['ouput'] = curl_exec($ch);
		$resp['info'] = curl_getinfo($ch);
		$resp['error'] = curl_error($ch);
		debug($resp,1);
	} else {
		
		// Normal process
		$resp = curl_exec($ch);
	}
	
	if (curl_error($ch)) {
		echo curl_error($ch);
	}
	curl_close($ch);
	
	if (! isset($resp)) $resp = NULL;
	
	return $resp;
}


DEFINE('ENCRYPTION_KEY', 'PrsQNb6H9a15578a0a');
function doencrypt($str){
	return simple_crypt(ENCRYPTION_KEY, $str, 'encrypt');
}
function dodecrypt($str){
	return simple_crypt(ENCRYPTION_KEY, $str, 'decrypt');
}

/**
 * http://www.westhost.com/contest/php/function/simple-encrypt-decrypt-using-a-key/227
 * Simple Encrypt / Decrypt using a key, specify the action
 * which defaults to encrypt or we assume it is to decrypt
 * the encrypted text can be saved into cookies, with out
 * being afraid of getting it cracked, provided the key is
 * long enough
 *
 * @param {$key} string - key to be used while string is encoded or decoded
 * @param {$string} string - string to be encoded or decoded
 * @param {$action} [encrypt/decrypt] - the action to be performed
 */
function simple_crypt($key, $string, $action = 'encrypt'){
		$res = '';
		if($action !== 'encrypt'){
			$string = base64_decode($string);
		} 
		for( $i = 0; $i < strlen($string); $i++){
				$c = ord(substr($string, $i));
				if($action == 'encrypt'){
					$c += ord(substr($key, (($i + 1) % strlen($key))));
					$res .= chr($c & 0xFF);
				}else{
					$c -= ord(substr($key, (($i + 1) % strlen($key))));
					$res .= chr(abs($c) & 0xFF);
				}
		}
		if($action == 'encrypt'){
			$res = base64_encode($res);
		} 
		return $res;
}

function print_message($string, $type = 'info'){
	$return = '';
	if ($type == "info") {
		$return = '<div class="alert alert-info b"><i class="fa fa-exclamation-circle"></i> &nbsp;&nbsp;'.$string.'</div>';
	}
	if ($type == "success") {
		$return = '<div class="alert alert-success b"><i class="fa fa-check-circle"></i> &nbsp;&nbsp;'.$string.'</div>';
	}
	if ($type == "error") {
		$return = '<div class="alert alert-danger b"><i class="fa fa-remove"></i> &nbsp;&nbsp;'.$string.'</div>';
	}
	
	// if ($type == "info") {
		// $return = '<div class="message-info b"> <i class="fa fa-exclamation-circle"></i> &nbsp;&nbsp;'.$string.'</div>';
	// }
	// if ($type == "success") {
		// $return = '<div class="message-success b"><i class="fa fa-check-circle"></i> &nbsp;&nbsp;'.$string.'</div>';
	// }
	// if ($type == "error") {
		// $return = '<div class="message-danger b"><i class="fa fa-remove"></i> &nbsp;&nbsp;'.$string.'</div>';
	// }
	return $return;
}

function currentPageUrl() {
    $curpageURL = 'http';
    //if ($_SERVER["HTTPS"] == "on") {$curpageURL.= "s";}
		$curpageURL.= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
		$curpageURL.= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
    } else {
		$curpageURL.= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    }
    return $curpageURL;
	// return http://localhost/kisi-kisi.com/showcategoryarticle.php?aid=6&title=iniabsurd&wewew=hehe&jablay=gila
}

function get_cookie($name, $column = NULL)
{
	$temp = Cookie::get($name);
	if (isset($temp)) 
		$temp = explode('||',$temp);
	else 
		return FALSE;
	
	// debug($temp,1);
	if (! empty($temp)) 
	{
		$cookie = array(
			'member_id' =>	$temp[0],
			'name'		=>	$temp[1],
			'email'		=>	$temp[2]
		);	
	}
	// $cookie['member_id'] = $temp[0];
	// debug($cookie,1);
	// $cookie['name'] = $temp[1];
	// $cookie['email'] = $temp[2];

	if (isset($column) && in_array($column,array('member_id','name','email')) == TRUE)
		return $cookie[$column]; 
	else
		return $cookie;
}

function is_member()
{
	// No cookies then false
	if (! isset($_COOKIE['tokenhash']) || $_COOKIE['tokenhash'] == '') return FALSE;
	
	return 'break';
	// $tokenhash = NULL;
	// $tokenhash = get_cookie('tokenhash','member_id');
	// return (isset($tokenhash) && $tokenhash != '') ? TRUE : FALSE;
}

function orm_get($q)
{
	$data = DB::select($q);
	if (! empty($data)) $data = $data[0];
	$data = json_decode(json_encode($data),1);
	
	// $data = DB::select($q)->get();
	// $data = $data->toArray();
	// if (! empty($data)) $data = $data[0];
	return $data;
}

function orm_get_list($q)
{
	$data = DB::select($q);
	$data = json_decode(json_encode($data),1);
	return $data;
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

// Hit curl project for scraper fachrie 12 september 2018
function curlf($url)
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/32.0.1700.107 Chrome/32.0.1700.107 Safari/537.36');
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

function base_url()
{
	return URL::to('/').'/';
}

?>