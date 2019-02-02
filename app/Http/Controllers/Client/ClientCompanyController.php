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
use Request;

class ClientCompanyController extends ClientController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	
	public function __construct()
	{
		$this->themes = env('THEMES','general');
		// $this->themes = env('THEMES','general');
		// debug('mantap',1);
	}
		
	public function company()
	{
		$param = $content = $get = $lang = $companylang = $current_url = NULL;
		
		if ($_GET) $get = $_GET;
		
		$lang = Lang::get('common');
		$companylang = Lang::get('modular/company');
		$themes = env('THEMES','general');
		$current_url = current_url();
		// debug($companylang,1);
		
		$param['get'] = $get;
		$param['lang'] = $lang;
		$param['companylang'] = $companylang;
		$param['PAGE_TITLE'] = ' Halaman' . $companylang['module'];
		$param['PAGE_HEADER'] = $companylang['module'];
		
		if (isset($get['do']) && ($get['do'] == 'insert' || $get['do'] == 'edit' && isset($get['company_id']))) {
			if ($get['do'] == 'insert') { 
				$param['PAGE_HEADER'] = $lang['add'] . ' ' . $lang['page'] . ' ' . $companylang['module'];
				$param['form_url'] = $current_url.DS.'insert';
			} 
			else if($get['do'] == 'edit') { 
				$param['PAGE_HEADER'] = $lang['edit'] . ' ' . $lang['page'] . ' ' . $companylang['module'];
				$param['form_url'] = $current_url.DS.'update';
			}
			
			$viewtarget = 'client.company_form';
		} else {
			$viewtarget = 'client.company_list';
		}
		
		$param['current_url'] = $current_url;
		$content = view($viewtarget,$param);	
		
		$param['CONTENT'] = $content;
		return view('template.' . $themes . '.index',$param);
		die;
	}
	
	public function insert()
	{
		$post = $message = NULL;
		$company_model = new Company_Model();
		$message = 'No data insert';
		if ($_POST)
		{
			$post = $_POST;
			
			// Do validation here
			
			// Action start here
			$param = NULL;
			// $param[''] = $post[''];
			$param['company_name'] = $post['company_name'];
			$param['company_address'] = $post['company_address'];
			$param['company_phone'] = $post['company_phone'];
			$param['company_pic'] = $post['company_pic'];
			$param['created_at'] = get_datetime();
			$param['created_by'] = 1;
			$param['created_ip'] = get_ip();
			// $param['company_token'] = env('API_KEY');
			
			$api_url = env('API_URL').'company';
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
		
		return redirect('company')->with('message', print_message($message));
	}
	
	public function update()
	{
		$message = $url_back = NULL;
		
		$message = 'No data update';
		$url_back = Request::segment(1).DS.Request::segment(2);
		if ($_POST)
		{
			$post = $_POST;
			unset($post['_token']);
			
            // Do validation here with model
            if (! isset($post['company_id'])) {
                $message = 'company_id not exist';
                return redirect($url_back)->with('message', print_message($message));
            } 
			
			// Action start here
			$param = NULL;
			$param['company_id'] = $post['company_id'];
			$param['company_name'] = $post['company_name'];
			$param['company_address'] = $post['company_address'];
			$param['company_phone'] = $post['company_phone'];
			$param['company_pic'] = $post['company_pic'];
			$param['updated_at'] = get_datetime();
			$param['updated_by'] = 1;
			$param['updated_ip'] = get_ip();
			
			$api_url = env('API_URL').'company';
			$api_method = 'put';
			
			// $api_header['debug'] = 1;
			$api_header['token'] = env('API_KEY');

			$update = curl_api_liquid($api_url, $api_method, $api_header, $param);
			
			if (isset($update)) {
				$update = json_decode($update,1);
				
				if ($update['is_success']) $message = 'Update success';
				else $message = 'Update failed. Please try again';

			}
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
            if (! isset($get['company_id'])) {
                $message = 'company_id not exist';
                return redirect($url_back)->with('message', print_message($message));
            } 
			
			// Action start here
			$param = NULL;
			$param['company_id'] = $get['company_id'];
			$param['status'] = -1;
			$param['updated_at'] = get_datetime();
			$param['updated_by'] = 1;
			$param['updated_ip'] = get_ip();
			
			$api_url = env('API_URL').'company';
			$api_method = 'put';
			
			// $api_header['debug'] = 1;
			$api_header['token'] = env('API_KEY');

			$update = curl_api_liquid($api_url, $api_method, $api_header, $param);
			
			if (isset($update)) {
				$update = json_decode($update,1);
				
				if ($update['is_success']) $message = 'Update success';
				else $message = 'Update failed. Please try again';

			}
		}
		
		return redirect($url_back)->with('message', print_message($message));
	}
	
	public function bulk()
	{
		$message = 'Bulk action nodata';
		if ($_POST)
		{
			$post = $_POST;
			
			// Do validation here
			
			// Action start here
			$param = NULL;
			// $param[''] = $post[''];
			$param['company_id'] = $post['company_id'];
			$param['company_name'] = $post['company_name'];
			$param['company_address'] = $post['company_address'];
			$param['company_phone'] = $post['company_phone'];
			$param['company_pic'] = $post['company_pic'];
			$param['updated_at'] = get_datetime();
			$param['updated_by'] = 1;
			$param['updated_ip'] = get_ip();
			// $param['company_token'] = env('API_KEY');
			
			$api_url = env('API_URL').'company';
			$api_method = 'put';
			
			// $api_header['debug'] = 1;
			$api_header['token'] = env('API_KEY');

			$save = curl_api_liquid($api_url, $api_method, $api_header, $param);
			
			if (isset($save)) {
				$save = json_decode($save,1);
				
				if ($save['is_success']) $message = 'Save success';
				else $message = 'Save failed';
				
				// return redirect('company')->with('message', print_message($message));
			}
			
			$message = 'Bulk action success';
		}
		return redirect('company')->with('message', print_message($message));
	}
}
