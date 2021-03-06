<?php

namespace Patriot\Http\Controllers\Client;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Patriot\Http\Controllers\Controller;
use Patriot\Http\Controllers\Client\ClientController;

use Cookie;
use Lang;
// use Request;
// use Patriot\Http\Controllers\Client\Request;
use Illuminate\Http\Request;

class ClientSiteController extends ClientController
{	
	public function __construct()
	{
		$this->themes = env('THEMES','general');
		parent::__construct();
	}
	
	public function ajax()
	{
		$get = $_GET;
		if (! isset($get['site_id']) || $get['site_id'] == '') {
			echo "site_id required";
			die;
		}
		
		$api_url = $api_method = $api_param = $api_header = NULL;
		$api_param['token'] = env('API_KEY');
		$api_param['site_id'] = $get['site_id'];

		$api_url = env('API_URL').'site/get';
		$api_method = 'get';
		// $api_header['debug'] = 1;
		
		$data = curl_api_liquid($api_url, $api_method, $api_header, $api_param);

		if (! empty($data)) $data = json_decode($data,1);

		$message = 'valid';
		if (isset($data['site_id']) && $data['site_id'] != '') $message = 'invalid';		
		
		echo $message;
		die;
	}
	
	public function site()
	{
		$param = $content = $get = $lang = $sitelang = $current_url = NULL;
		
		if ($_GET) $get = $_GET;
		
		$lang = Lang::get('common');

		// Merge multilang
		$sitelang = Lang::get('client/site');
		$companylang = Lang::get('client/company');
		$sitelang = array_merge($companylang,$sitelang);
		$current_url = current_url();
		
		$param['get'] = $get;
		$param['lang'] = $lang;
		$param['sitelang'] = $sitelang;
		$param['PAGE_TITLE'] = $sitelang['module'];
		$param['MODULE'] = $sitelang['module'];
		
		if (isset($get['do']) && ($get['do'] == 'insert' || $get['do'] == 'edit' && isset($get['site_id']))) {
			if ($get['do'] == 'insert') { 
				$param['ACTION'] = $lang['insert'];
				$param['form_url'] = $current_url.DS.'insert';
			} else if($get['do'] == 'edit') {
				$param['ACTION'] = $lang['edit'];
				$param['form_url'] = $current_url.DS.'update';
			}
			
			$viewtarget = 'client.site_form';
		} else {
			$param['ACTION'] = $lang['list'];
			$viewtarget = 'client.site_list';
		}
		
		$param['PAGE_HEADER'] = $param['ACTION'] . ' ' . $sitelang['module'];
		
		$param['current_url'] = $current_url;
		$content = view($viewtarget,$param);	
		
		$param['CONTENT'] = $content;
		return view('template.' . $this->themes . '.index',$param);
		die;
	}
	
	public function insert()
	{
		$post = $message = $url_back = NULL;
		$message = 'No data insert';
		$url_back = Request::segment(1).DS.Request::segment(2);
		if ($_POST)
		{
			$post = $_POST;
			
			// Do validation here
			
			// Action start here
			$param = NULL;
			$param = $post;
			$param['created_at'] = get_datetime();
			$param['created_by'] = 1;
			$param['created_ip'] = get_ip();
			// $param['site_token'] = env('API_KEY');
			
			$api_url = env('API_URL').'site';
			$api_method = 'post';
			
			// $api_header['debug'] = 1;
			$api_header['token'] = env('API_KEY');

			$save = curl_api_liquid($api_url, $api_method, $api_header, $param);
			
			if (isset($save)) {
				$save = json_decode($save,1);
				
				if ($save['is_success']) $message = 'Save success';
				else $message = 'Save failed';
			} else {
				$message = 'Save error. Please try again';
			}
		}
		
		return redirect($url_back)->with('message', print_message($message));
	}
	
	public function update(Request $request)
	{
		$post = $message = $url_back = NULL;
		$message = 'No data update';
		$url_back = $request->segment(1).DS.$request->segment(2);
		// $request = Request::all();
		
		// debug($request->file('logo_file_name'));
		// debug(HR.'ayam',1);
		if ($_POST)
		{
			$post = $_POST;
			unset($post['_token']);
			
            // Do validation here with model
            if (! isset($post['site_id'])) {
                $message = 'site_id not exist';
                return redirect($url_back)->with('message', print_message($message));
            } 
			
			// Check image upload 
			$logo_file_name = NULL;
			if ($request->hasFile('logo_file_name')) {
				$image = $request->file('logo_file_name');
				$logo_file_name = time().'_'.mt_rand(1000,9999).'.'.$image->getClientOriginalExtension();
				$destinationPath = public_path('/images');
				$saveimage = $image->move($destinationPath, $logo_file_name);
				
				if ($saveimage) {
					$message .= BR." Save images successful.";
				} else {
					$message .= BR." Save images failed.";
				}
			}
			
			// Action start here
			$param = NULL;
			$param = $post;
			if (isset($logo_file_name)) $param['logo_file_name'] = $logo_file_name;
			$param['updated_at'] = get_datetime();
			$param['updated_by'] = 1;
			$param['updated_ip'] = get_ip();
			
			$api_url = env('API_URL').'site';
			$api_method = 'put';
			
			// $api_header['debug'] = 1;
			$api_header['token'] = env('API_KEY');

			$update = curl_api_liquid($api_url, $api_method, $api_header, $param);
			
			if (isset($update)) {
				$update = json_decode($update,1);
				
				if ($update['is_success'])
					$message = 'Update success';
				else 
					$message = 'Update failed. Please try again';
			}
			
			// Validation image
			// $this->validate($request, [
				// 'logo_file_name' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
			// ]);

			
		}
		
		return redirect($url_back)->with('message', print_message($message));
	}
	
	public function delete()
	{
		$message = $url_back = NULL;
		
		$message = 'No data delete';
		$url_back = Request::segment(1).DS.Request::segment(2);
		if ($_GET)
		{
			$get = $_GET;
			// unset($post['_token']);
			
            // Do validation here with model
            if (! isset($get['site_id'])) {
                $message = 'site_id not exist';
                return redirect($url_back)->with('message', print_message($message));
            } 
			
			// Action start here
			$param = NULL;
			$param['site_id'] = $get['site_id'];
			$param['status'] = -1;
			$param['updated_at'] = get_datetime();
			$param['updated_by'] = 1;
			$param['updated_ip'] = get_ip();
			
			$api_url = env('API_URL').'site';
			$api_method = 'delete';
			
			// $api_header['debug'] = 1;
			$api_header['token'] = env('API_KEY');

			$delete = curl_api_liquid($api_url, $api_method, $api_header, $param);
			
			if (isset($delete)) {
				$delete = json_decode($delete,1);
				
				if ($delete['is_success']) $message = 'Delete success';
				else $message = 'Delete failed. Please try again';

			}
		}
		
		return redirect($url_back)->with('message', print_message($message));
	}
	
	// Not yet working
	public function bulk()
	{
		$message = 'Bulk action nodata';
		if ($_POST)
		{
			$post = $_POST;
			
			// Do validation here
			
			// Action start here
			$param = NULL;
			$param['updated_at'] = get_datetime();
			$param['updated_by'] = 1;
			$param['updated_ip'] = get_ip();
			// $param['site_token'] = env('API_KEY');
			
			$api_url = env('API_URL').'site';
			$api_method = 'put';
			
			// $api_header['debug'] = 1;
			$api_header['token'] = env('API_KEY');

			$save = curl_api_liquid($api_url, $api_method, $api_header, $param);
			
			if (isset($save)) {
				$save = json_decode($save,1);
				
				if ($save['is_success']) $message = 'Save success';
				else $message = 'Save failed';
				
				// return redirect('site')->with('message', print_message($message));
			}
			
			$message = 'Bulk action success';
		}
		return redirect('site')->with('message', print_message($message));
	}
}
