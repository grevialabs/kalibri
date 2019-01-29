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
		$param = $content = $get = $commonlang = $companylang = NULL;
		
		if ($_GET) $get = $_GET;
		
		$commonlang = Lang::get('common');
		$companylang = Lang::get('modular/company');
		
		$param['commonlang'] = $commonlang;
		$param['companylang'] = $companylang;
		$param['PAGE_TITLE'] = 'Halaman ' . $companylang['module'];
		
		if (isset($get['do']) && $get['do'] == 'insert') {
			$content = view('modular.company_form',$param);
			// // $content = view('modular.company_list',$param);	
		} else {
			$content = view('modular.company_list',$param);	
		}
			
		
		$param['CONTENT'] = $content;
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
	
	public function insert()
	{
		$post = NULL;
		if ($_POST)
		{
			$post = $_POST;
			
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
				
				return redirect('company')->with('message', print_message($message));
			}
		}
	}
	
	public function update()
	{
		
	}
}
