<?php

namespace Patriot\Http\Controllers\Modular;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Patriot\Http\Controllers\Controller;

use Cookie;
use Exception;

class ModularController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	
	public function index()
	{	
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
		
		// try{
			// // try code
			// $ma ="-2(-10)";
			// $p = eval('return '.$ma.';');
		// } 
		// catch(\Exception $e){
			// // catch code
			// debug($e->getMessage,1);
		// }
		// debug($p,1);
		
		$param = NULL;
		$param['PAGE_TITLE'] = 'Halaman Modular index';
		$param['BS_TEMPLATE'] = TRUE;
		$param['CONTENT'] = view('modular.index',$param);
		return view('template.general.index',$param);
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
	
	// public function login()
	// {	
		// $param = NULL;
		// $param['PAGE_TITLE'] = 'Halaman login';
		// $param['content'] = view('modular.login',$param);
		// return view('template.general.index',$param);
	// }
	
	public function welcome()
	{
		return "halo welcome";
		
		// \Session::flash('message', 'no data selected');
		
		//redirect to index
		// return Redirect::action('Master\TipeArtefakController@index');
	}
	
	public function about()
	{
		return "halo about";
		// die;
	}
}
