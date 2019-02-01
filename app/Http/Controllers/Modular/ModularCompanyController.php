<?php

namespace Patriot\Http\Controllers\Modular;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Pagination\LengthAwarePaginator;

use Patriot\Http\Controllers\Controller;
use Patriot\Http\Controllers\Modular\ModularController;

use Cookie;
use Lang;
use Request;

class ModularCompanyController extends ModularController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	
	public function company()
	{
		$param = $content = $get = $lang = $companylang = NULL;
		
		if ($_GET) $get = $_GET;
		
		$lang = Lang::get('common');
		$companylang = Lang::get('modular/company');
		
		$param['get'] = $get;
		$param['lang'] = $lang;
		$param['companylang'] = $companylang;
		$param['PAGE_HEADER'] = 'Halaman ' . $companylang['module'];
		$param['PAGE_TITLE'] = 'Halaman ' . $companylang['module'];
		
		if (isset($get['do']) && ($get['do'] == 'insert' || $get['do'] == 'edit' && isset($get['company_id']))) {
			if ($get['do'] == 'insert') { 
				$param['PAGE_HEADER'] = $lang['add'] . ' ' . $lang['page'] . ' ' . $companylang['module'];
				$param['form_url'] = base_url().Request::segment(1).DS.'insert';
			} 
			else if($get['do'] == 'edit') { 
				$param['PAGE_HEADER'] = $lang['edit'] . ' ' . $lang['page'] . ' ' . $companylang['module'];
				$param['form_url'] = base_url().Request::segment(1).DS.'update';
			}
			
			$content = view('modular.company_form',$param);
		} else {
			$content = view('modular.company_list',$param);	
		}
		
		$param['CONTENT'] = $content;
		return view('template.' . env('THEMES','general') . '.index',$param);
		// return view('template.firered.index',$param);
	}
	
	// GAPAKE LAGI
	// public function company_list()
	// {		
		// // $api_param = NULL;
		// // // $api_param['secretkey'] = env('API_KEY');
		// // $api_param['token'] = env('API_KEY');
		// // // $api_param['offset'] = OFFSET;
		// // $api_param['perpage'] = 1;
		
		// // $api_url = env('API_URL').'company/get_list';
		// // $api_method = 'get';
		// // // $api_header['debug'] = 1;
		
		// // // debug($api_method,1);
		// // $data = curl_api_liquid($api_url, $api_method, NULL, $api_param);
		// // debug($data,1);
		
		// $param = NULL;
		// // $param['api'] = $api;
		// // $param['data'] = $data;
		// $param['message'] = Lang::get('common.message');
		// $param['PAGE_TITLE'] = 'Halaman Company';
		// $param['CONTENT'] = view('modular.company_list',$param);
		// return view('template.general.index',$param);
	// }
	
	// public function company_form()
	// {		
		// $param = NULL;
		// $param['message'] = Lang::get('common.message');
		// $param['PAGE_TITLE'] = 'Halaman Company';
		// $param['CONTENT'] = view('modular.company_form',$param);
		// return view('template.general.index',$param);
	// }
	
}
