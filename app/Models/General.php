<?php

namespace Patriot\Models;

use Illuminate\Database\Eloquent\Model;

use Request;

class General extends Model
{
    // getorder_allowed_list
	public static function getorder_allowed_list()
    {
       static $str = array('company_id','company_name','company_phone','company_address','company_pic');
       return $str;
    }
	
	// getorderby_allowed_list
	public static function getorderby_allowed_list()
    {
       static $str = array('desc','asc');
       return $str;
    }
	
	// $perpage_allowed = array(2,40,60)
	public static function perpage_allowed()
    {
       static $str = array(2,40,60);
       return $str;
    }
	
	// @get = fill with $_GET
	// @getorder = 
	// @getorderby = 
	// @getorder_allowed_list
	public function arrsort($get,$getorder,$getorderby,$getorder_allowed_list)
	{
		$arrsort = NULL;
		$arrsort = $getorder_allowed_list;
		// $arrsort = array();
		if (! empty($getorder_allowed_list))
		{
			foreach ($getorder_allowed_list as $k => $rso) {
				$icon = '<i class="fa fa-arrow-down"></i>';
				$tmporderby = '';
				$tmpget = NULL;
				$tmpget = $get;
				
				$arrsort[$rso]['class'] = 'text-info b';
				
				if (isset($getorder) && $getorder == $rso) {
					
					$arrsort[$rso]['class'] = 'text-danger b';
					if ($getorderby == ASC) {
						$icon = '<i class="fa fa-arrow-down"></i>';
						$tmpget['orderby'] = DESC;
					} elseif ($getorderby == DESC) {
						$icon = '<i class="fa fa-arrow-up"></i>';
						$tmpget['orderby'] = ASC;
					}
				} else {
					$tmpget['orderby'] = DESC;
					$icon = '<i class="fa fa-arrow-down"></i>';
				}
				$tmpget['order'] = $rso;
				$arrsort[$rso]['url'] = current_url().'?'.http_build_query($tmpget);
				$arrsort[$rso]['icon'] = $icon;
				$arrsort[$rso]['title'] = 'Sort by ' . $rso . ' '. $tmpget['orderby'];
				// debug($arrsort,1);
			}
		}
		return $arrsort;
	}
	
	public function show_record_status($status)
	{
		// $str = '<div class="btn-sm"><i class="fa fa-minus-circle clrRed" alt="Unpublish" title="Unpublish"></i></div>';
		if ($status == 0) $str = '<div class="btn-sm"><i class="fa fa-check-circle clrBlk" alt="Inactive" title="Inactive"></i> </div>';
		if ($status == 1) $str = '<div class="btn-sm"><i class="fa fa-check-circle clrBlu" alt="Active" title="Active"></i> </div>';
		if ($status == -1) $str = '<div class="btn-sm"><i class="fa fa-check-circle clrRed" alt="Deleted" title="Deleted"></i> </div>';
		return $str;
	}
	
	public function insert_log($attr)
	{
		$message = $url_back = $post = NULL;
		
		$message = 'No data insert';
		// debug($message,1);
		$url_back = 'test';
		$url_back = Request::segment(1).DS.Request::segment(2);
		if (! empty($attr))
		{
			$post = $attr;
			unset($post['_token']);
			
            // Do validation here with model
            // if (! isset($post['company_id'])) {
                // $message = 'company_id not exist';
                // return redirect($url_back)->with('message', print_message($message));
            // }
			
			// Action start here
			$param = NULL;			
			$param['name'] = $post['name'];
			$param['url'] = $post['url'];
			$param['data'] = $post['data'];
			$param['json'] = $post['json'];
			$param['created_at'] = get_datetime();
			$param['created_by'] = 'BOT'; // session user
			$param['created_ip'] = get_ip();
			
			$api_url = env('API_URL').'log';
			$api_method = 'post';
			
			// $api_header['debug'] = 1;
			$api_header['token'] = env('API_KEY');

			$save = curl_api_liquid($api_url, $api_method, $api_header, $param);
			debug($save,1);
			if (isset($save)) {
				$save = json_decode($save,1);
				
				if (isset($save['is_success'])) $message = 'Update success';
				else $message = 'Update failed. Please try again';

			}
		}
		
		// return redirect($url_back)->with('message', print_message($message));
		echo json_encode($message);
		die;
	}
	
}
