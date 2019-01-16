<?php

namespace Patriot\Http\Controllers\Modular;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Patriot\Http\Controllers\Controller;

use Cookie;
use Exception;
use Lang;
// use Redirect;
use Illuminate\Support\Facades\Redirect;

// define('GET','Getois');

class ModularController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	
	public function index()
	{	
		// Check if not login then show else show 
		if (is_member()) {
			return redirect('member/home');
		} else {
			return redirect('login');
		}
		
		// echo "wkwk<hr/>";
		// $url = 'http://localhost/patriot/public/api/v1/article/get?token=95948463848313&format=json';
		// $url = 'http://172.16.52.145/patriot/public/api/v1/article/get?token=95948463848313&format=json';
		// phpinfo();
// die
		// $data = curl($url);
		// $data = json_decode($data,1);
		// $data['id'] = 1;
		// debug($data);
		// die;
		// $cookie = $_COOKIE;
		// $cookie = Cookie::queue(Cookie::forget('tokenhash'));
		// debug('gokil<hr/>');
		// debug($cookie,1);
		
		// $param = NULL;
		// $param['PAGE_TITLE'] = 'Halaman Modular index';
		// $param['BS_TEMPLATE'] = TRUE;
		// $param['CONTENT'] = view('modular.index',$param);
		// return view('template.general.index',$param);
	}

	public function test_curl()
	{
		$url = 'http://localhost/patriot/public/api/v1/article/get?token=95948463848313&format=json';
		// $url = 'http://172.16.52.145/patriot/public/api/v1/article/get?token=95948463848313&format=json';
		// phpinfo();
// die
		$data = curl($url);
		$data = json_decode($data,1);
		// $data['id'] = 1;
		debug($data);
		die;
		
	}
	
	public function welcome()
	{
		return "halo welcome";
		
		// \Session::flash('message', 'no data selected');
		
		//redirect to index
		// return Redirect::action('Master\TipeArtefakController@index');
	}
	
	public function about()
	{
		$param = NULL;
		$param['PAGE_TITLE'] = 'Halaman About';
		$param['CONTENT'] = view('modular.about',$param);
		return view('template.general.index',$param);
	}
	
	public function article_vue()
	{
	
		$api_param = NULL;

		$api['url'] = env('API_URL').'article/get';
		// $api['method'] = Config::get();
		$api['param'] = $api_param;
		// $api['debug'] = 1;
			
		// $obj = curl_api_liquid($url);
		$obj = curl_api_grevia($api['url'],$api,$api_param);
		// debug($api_param,1);
		// debug($obj,1);
		
		$param = NULL;
		$param['api'] = $api;
		$param['data'] = $obj;
		$param['message'] = Lang::get('common.message');
		$param['PAGE_TITLE'] = 'Halaman Artikel Vue';
		$param['CONTENT'] = view('modular.article_vue',$param);
		return view('template.general.index',$param);
	}
}
