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

class ClientTransactionController extends ClientController
{	
	public function __construct()
	{
		$this->themes = env('THEMES','general');
		parent::__construct();
	}
		
	public function transaction()
	{
		$param = $content = $get = $lang = $transactionlang = $current_url = NULL;
		
		if ($_GET) $get = $_GET;
		
		$lang = Lang::get('common');
		$transactionlang = Lang::get('client/transaction');
		$current_url = current_url();
		// debug($transactionlang,1);
		
		$param['get'] = $get;
		$param['lang'] = $lang;
		$param['transactionlang'] = $transactionlang;
		$param['PAGE_TITLE'] = $transactionlang['module'];
		$param['MODULE'] = $transactionlang['module'];
		
		if (isset($get['do']) && ($get['do'] == 'insert' || $get['do'] == 'edit' && isset($get['transaction_id']))) {
			if ($get['do'] == 'insert') { 
				$param['ACTION'] = $lang['insert'];
				$param['form_url'] = $current_url.DS.'insert';
			} else if($get['do'] == 'edit') {
				$param['ACTION'] = $lang['edit'];
				$param['form_url'] = $current_url.DS.'update';
			}
			
			$viewtarget = 'client.transaction_form';
		} else {
			$param['ACTION'] = $lang['list'];
			$viewtarget = 'client.transaction_list';
		}
		
		$param['PAGE_HEADER'] = $param['ACTION'] . ' ' . $transactionlang['module'];
		
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
			// $param['transaction_token'] = env('API_KEY');
			
			$api_url = env('API_URL').'transaction';
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
	
	public function update()
	{
		$post = $message = $url_back = NULL;
		$message = 'No data update';
		$url_back = Request::segment(1).DS.Request::segment(2);
		if ($_POST)
		{
			$post = $_POST;
			unset($post['_token']);
			
            // Do validation here with model
            if (! isset($post['transaction_id'])) {
                $message = 'transaction_id not exist';
                return redirect($url_back)->with('message', print_message($message));
            } 
			
			// Action start here
			$param = NULL;
			$param = $post;
			$param['updated_at'] = get_datetime();
			$param['updated_by'] = 1;
			$param['updated_ip'] = get_ip();
			
			$api_url = env('API_URL').'transaction';
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
            if (! isset($get['transaction_id'])) {
                $message = 'transaction_id not exist';
                return redirect($url_back)->with('message', print_message($message));
            } 
			
			// Action start here
			$param = NULL;
			$param['transaction_id'] = $get['transaction_id'];
			$param['status'] = -1;
			$param['updated_at'] = get_datetime();
			$param['updated_by'] = 1;
			$param['updated_ip'] = get_ip();
			
			$api_url = env('API_URL').'transaction';
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
			// $param['transaction_token'] = env('API_KEY');
			
			$api_url = env('API_URL').'transaction';
			$api_method = 'put';
			
			// $api_header['debug'] = 1;
			$api_header['token'] = env('API_KEY');

			$save = curl_api_liquid($api_url, $api_method, $api_header, $param);
			
			if (isset($save)) {
				$save = json_decode($save,1);
				
				if ($save['is_success']) $message = 'Save success';
				else $message = 'Save failed';
				
				// return redirect('transaction')->with('message', print_message($message));
			}
			
			$message = 'Bulk action success';
		}
		return redirect('transaction')->with('message', print_message($message));
	}
}
