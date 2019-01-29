<?php

namespace Patriot\Http\Controllers\Modular;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Pagination\LengthAwarePaginator;

use Patriot\Http\Controllers\Controller;
use Patriot\Http\Controllers\Modular\ModularController;

// use Patriot\Models\General as GeneralModel;
// use Patriot\Models\CompanyModel;

use Cookie;
use Lang;
use Request;

class ModularCompanyController extends ModularController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	
	public function company()
	{
		// Redirect guest to login
		// if (is_member()) {
		// 	$url = base_url().'member/home';
		// 	// return redirect($url);
		// 	debug('valid member<hr/>');
		// } else 
		// {
		// 	debug('invalid member<hr/>');
		// }
		
		$api_param = NULL;
		$api_param['secretkey'] = env('API_KEY');
		
		$api['url'] = env('API_URL').'company/get_list';
		$api['secretkey'] = env('API_SECRETKEY');
		$api['method'] = 'get';
		$api['param'] = $api_param;
		$api['debug'] = '1';
			
		$obj = curl_api_liquid($url);
		// debug($obj,1);
		// $obj = curl_api_grevia($api['url']);
		
		if ($_POST) 
		{
			$post = NULL;
			$post = $_POST;
			
			if (! isset($post['email'])) {
				$message = 'Email harus diisi';
				return redirect('login')->with('message', print_message($message));
			}
			
			if (! isset($post['password'])) {
				$message = 'Password harus diisi';
				return redirect('login')->with('message', print_message($message));
			}
			
			// $url = 'http://www.grevia.com/api/member';
			// $url = env('API_URL').'company/get_list';
			
			// $obj = curl_api_lumen($url);
			// debug($obj,1);

			if (! empty($obj))
			{
				$obj = json_decode($obj,1);
				if (isset($obj['is_error']))
				{
					$message = 'Mohon maaf, terjadi kesalahan';
					return redirect('login')->with('message', print_message($message));
				}
				
				// valid
				if (isset($obj['password']) && dodecrypt($obj['password']) == $post['password'])
				{
					// check if uri last page exist
					// create cookie or session 
					$cname = $cvalue = $cminutes = NULL;
					$cname = 'tokenhash';
					// $tokenhash = $obj['member_id'].'||'.$obj['name'].'||'.$obj['email'];
					$cvalue = $obj['member_id'].'||'.$obj['name'].'||'.$obj['email'];
					$cminutes = 24 * 60;
					Cookie::queue($cname, $cvalue, $cminutes);
					
					// cookie available on next request;
					
					// redirect to member 
					return redirect('member/home');
					
				}
				else 
				{
					$message = 'Email / Password tidak sesuai';
					return redirect('login')->with('message', print_message($message));
				}
			}
			else 
			{
				// $message = 'Mohon maaf terjadi kesalahan. Silakan coba lagi';
				$message = 'Data anda tidak ditemukan';
				return redirect('login')->with('message', print_message($message));
			}
		}
		
		$param = NULL;
		$param['api'] = $api;
		$param['data'] = $obj;
		$param['message'] = Lang::get('common.message');
		$param['PAGE_TITLE'] = 'Halaman Company';
		$param['CONTENT'] = view('modular.company',$param);
		return view('template.general.index',$param);
	}
	
	public function company_list()
	{		
		// $api_param = NULL;
		// // $api_param['secretkey'] = env('API_KEY');
		// $api_param['token'] = env('API_KEY');
		// // $api_param['offset'] = OFFSET;
		// $api_param['perpage'] = 1;
		
		// $api_url = env('API_URL').'company/get_list';
		// $api_method = 'get';
		// // $api_header['debug'] = 1;
		
		// // debug($api_method,1);
		// $data = curl_api_liquid($api_url, $api_method, NULL, $api_param);
		// debug($data,1);
		
		$param = NULL;
		// $param['api'] = $api;
		// $param['data'] = $data;
		$param['message'] = Lang::get('common.message');
		$param['PAGE_TITLE'] = 'Halaman Company';
		$param['CONTENT'] = view('modular.company_list',$param);
		return view('template.general.index',$param);
	}
	
	public function company_form()
	{		
		$param = NULL;
		$param['message'] = Lang::get('common.message');
		$param['PAGE_TITLE'] = 'Halaman Company';
		$param['CONTENT'] = view('modular.company_form',$param);
		return view('template.general.index',$param);
	}
}
