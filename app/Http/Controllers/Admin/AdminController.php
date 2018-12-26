<?php

namespace Patriot\Http\Controllers\Admin;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Patriot\Http\Controllers\Controller;

class AdminController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	
	public function index()
	{
		echo "dari index";
		die;
		
		$param = NULL;
		$param['data'] = 'Selamat datang di index';
		return view('index',$param);
	}
	
	public function welcome()
	{
		return "halo admin welcome";
		
		// \Session::flash('message', 'no data selected');
		
		//redirect to index
		// return Redirect::action('Master\TipeArtefakController@index');
	}
	
	public function about()
	{
		return "halo admin about";
		// die;
	}
}
