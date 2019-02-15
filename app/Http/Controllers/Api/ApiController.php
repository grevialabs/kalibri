<?php

namespace Patriot\Http\Controllers\Api;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Patriot\Http\Controllers\Controller;

class ApiController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	
	// Prepare for this
	
	public function __construct()
	{	
		
		// Lvl 1 : check token exist
		if (! isset($_GET['token'])) {
			
			// Lvl 1.1 check header with token exist
			// if () {
				
			// }
			
			$this->auth_api(array('error' => 'invalid_token'));
		}
		
		// Lvl 2 : check token expired or not via cookies / session / jwt
		// if () {
			
		// }
		
		// Lvl 3 : check request per day exceed limit
		
		// Lvl 4 :
	}
	
	// Authentication layer for API
	public function auth_api($param)
	{
		
		if (empty($param)) {
			return 'method harus diisi';
		}
		
		$message = $status = NULL;
		
		$status = 401;
		
		switch($param['error'])
		{
			case 'invalid_token':
				$message = 'Token is Invalid';
				break;
			case 'token_expired':
				$message = 'Token has expired. Please generate token';
				break;
			case 'data_not_found':
				$message = 'Data not found';
				break;
		}
		
		if (! isset($message)) $status = 200;
		
		$response['message'] = $message;
		$response['status'] = $status;
		
		// return $response;
		echo json_encode($response);
		die;
	}
	
	// Handle output api for method child inside / below Api controller
	// Ex : ApiArticleController, etc
	// @data = data
	// 
	// get parameter : @format : json(default), debug, xml
	public function response($data)
	{
		if (empty($data)) return 'response: data required';
		
		$format = 'json';
		
		if (isset($_GET['format']) && in_array($_GET['format'],array('json','array','xml'))) {
			$format = $_GET['format'];
		}
		
		switch($format)
		{
			case 'json':
				// do here
				$response = json_encode($data);
				break;
			case 'array':
				// ga mempan
				// $response = debug($data,1);
				echo "<pre>";
				print_r($data);
				echo "</pre>";
				die;
				break;
			case 'xml':
				$response = 'pura pura data xml ya';
				break;
		}

		echo $response;
		die;
	}
	
	public function ayamgoreng()
	{
		echo "ini ayamgoreng dari parent";
	}
}
