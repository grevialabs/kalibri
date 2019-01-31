<?php

namespace Patriot\Http\Controllers\Client;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Patriot\Http\Controllers\Controller;

use Patriot\Http\Controllers\Modular\ModularController;

use Cookie;
use Lang;
use Request;

class ClientController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	
	public function __construct()
	{
		$this->themes = env('THEMES','general');
		// $this->themes = env('THEMES','general');
	}
	
	public function index()
	{
		// echo "Client index";
		return redirect('client/company');
	}
	
	public function login()
	{
		// return view('template.' . $this->themes . '.login');
		// or
		return view('client.login');
	}
	
	public function company()
	{
		$param = $content = $get = $lang = $companylang = NULL;
		
		if ($_GET) $get = $_GET;
		
		$lang = Lang::get('common');
		$companylang = Lang::get('modular/company');
		// debug($companylang,1);
		
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
			
			$content = view('client.company_form',$param);
		} else {
			$content = view('client.company_list',$param);	
		}
		$themes = env('THEMES','general');
		$param['CONTENT'] = $content;
		// return view('template.' . env('THEMES','general') . '.index',$param);
		return view('template.' . $themes . '.index',$param);
		die;
	}
}
