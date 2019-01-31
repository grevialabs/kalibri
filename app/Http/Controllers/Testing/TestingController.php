<?php

namespace Patriot\Http\Controllers\Testing;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Patriot\Http\Controllers\Controller;

use Patriot\Http\Controllers\Modular\ModularController;

use Cookie;
use Lang;
use Request;

class TestingController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	
	public function index()
	{
		echo "dari index";
		die;
		
		// $param = NULL;
		// $param['data'] = 'Selamat datang di client index';
		// return view('index',$param);
	}
	
	public function welcome()
	{
		return "halo admin welcome";
		
		// \Session::flash('message', 'no data selected');
		
		//redirect to index
		// return Redirect::action('Master\TipeArtefakController@index');
	}
	
	public function sample()
	{
		return view('testing.sample');
	}
	
	public function matrix()
	{
		return view('testing.matrix');
	}
	
}
